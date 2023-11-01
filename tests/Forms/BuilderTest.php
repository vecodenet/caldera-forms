<?php

declare(strict_types = 1);

/**
 * Caldera Forms
 * Form builder, part of Vecode Caldera
 * @author  biohzrdmx <github.com/biohzrdmx>
 * @copyright Copyright (c) 2023 Vecode. All rights reserved
 */

namespace Caldera\Tests\Forms;

use PHPUnit\Framework\TestCase;

use Caldera\Forms\Builder\BaseBuilder;
use Caldera\Forms\Html\ButtonTypes;
use Caldera\Forms\Html\Element;
use Caldera\Forms\Html\FormMethods;
use Caldera\Forms\Html\InputTypes;

class BuilderTest extends TestCase {

    public function testShowHtml() {
        $builder = new BaseBuilder();
        $this->expectOutputString('<form></form>');
        $builder->showHtml();
    }

    public function testBasicForm() {
        $builder = new BaseBuilder();
        $builder->getForm()
            ->setAction('contact.php')
            ->setMethod(FormMethods::Post);
        $builder->addField('input', 'email', 'Email address')
            ->setAttribute('type', 'email');
        $builder->addField('select', 'subject', 'Subject')
            ->append( Element::createElement('option')->setAttribute('value', 'Suggestion')->setContent('Suggestion') )
            ->append( Element::createElement('option')->setAttribute('value', 'Question')->setContent('Question') );
        $builder->addField('textarea', 'message', 'Message')
            ->setAttribute('rows', '10');
        $builder->addField('button', '')
            ->setContent('Send message')
            ->setAttribute('type', 'submit');
        $html = $builder->getHtml();
        $this->writeHtml($html);
        $this->assertEquals('<form action="contact.php" method="post"><div class="mb-3"><label class="mb-1" for="email">Email address</label><input id="email" name="email" type="email"></div><div class="mb-3"><label class="mb-1" for="subject">Subject</label><select id="subject" name="subject"><option value="Suggestion">Suggestion</option><option value="Question">Question</option></select></div><div class="mb-3"><label class="mb-1" for="message">Message</label><textarea id="message" name="message" rows="10"></textarea></div><div class="mb-3"><button type="submit">Send message</button></div></form>', $html);
    }

    public function testFormFieldTypes() {
        $builder = new BaseBuilder();
        $builder->getForm()
            ->setAction('contact.php')
            ->setMethod(FormMethods::Post);
        $builder->addInput('email', 'Email address', InputTypes::Email)
            ->setPlaceholder('email@example.com')
            ->setRequired(true);
        $builder->addInput('disabled', 'Disabled field', InputTypes::Email)
            ->setId('foo')
            ->setDisabled(true);
        $builder->addInput('readonly', 'Read-only field', InputTypes::Email)
            ->setValue('Lorem, ipsum dolor sit amet.')
            ->setReadOnly(true);
        $builder->addSelect('subject', 'Subject')
            ->addOption('Suggestion')
            ->addOption('Question')
            ->setValue('Question');
        $builder->addTextArea('message', 'Message')
            ->setCols(30)
            ->setRows(10)
            ->setValue('Hi!');
        $builder->addButton('', 'Send message', ButtonTypes::Submit);
        $html = $builder->getHtml();
        $this->writeHtml($html);
        $this->assertEquals('<form action="contact.php" method="post"><div class="mb-3"><label class="mb-1" for="email">Email address</label><input id="email" name="email" placeholder="email@example.com" required type="email"></div><div class="mb-3"><label class="mb-1" for="foo">Disabled field</label><input disabled id="foo" name="disabled" type="email"></div><div class="mb-3"><label class="mb-1" for="readonly">Read-only field</label><input id="readonly" name="readonly" readonly type="email" value="Lorem, ipsum dolor sit amet."></div><div class="mb-3"><label class="mb-1" for="subject">Subject</label><select id="subject" name="subject"><option value="Suggestion">Suggestion</option><option selected value="Question">Question</option></select></div><div class="mb-3"><label class="mb-1" for="message">Message</label><textarea cols="30" id="message" name="message" rows="10">Hi!</textarea></div><div class="mb-3"><button type="submit">Send message</button></div></form>', $html);
    }

    protected function writeHtml(string $html): void {
        file_put_contents(dirname(__DIR__) . '/output/simple.html', $html);
        file_put_contents(dirname(__DIR__) . '/output/test.html', '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Test</title></head><body>'.$html.'</body></html>');
    }
}
