<?php

declare(strict_types = 1);

/**
 * Caldera Forms
 * Form builder, part of Vecode Caldera
 * @author  biohzrdmx <github.com/biohzrdmx>
 * @copyright Copyright (c) 2023 Vecode. All rights reserved
 */

namespace Caldera\Tests\Forms;

use InvalidArgumentException;

use PHPUnit\Framework\TestCase;

use Caldera\Forms\Html\Form;
use Caldera\Forms\Html\FormEncTypes;
use Caldera\Forms\Html\FormMethods;

class FormTest extends TestCase {

    public function testFormInvalidTag() {
        $this->expectException(InvalidArgumentException::class);
        Form::createElement('p');
    }

    public function testFormTags() {
        $form = Form::createElement();
        $this->assertEquals('<form></form>', $form->getContent());
    }

    public function testFormAttributes() {
        $form = Form::createElement()
            ->setMethod(FormMethods::Post)
            ->setEnctype(FormEncTypes::Multipart)
            ->setAction('submit.php');
        $this->assertEquals(['action' => 'submit.php', 'enctype' => 'multipart/form-data', 'method' => 'post'], $form->getAttributes());
    }

    public function testFormTagsWithAttributes() {
        $form = Form::createElement()
            ->setMethod(FormMethods::Post)
            ->setEnctype(FormEncTypes::Multipart)
            ->setAction('submit.php')
            ->setClass('form-base')
            ->setAttribute('novalidate', true)
            ->setAttribute('target', '_blank')
            ->setId('form-test');
        $this->assertEquals('<form action="submit.php" class="form-base" enctype="multipart/form-data" id="form-test" method="post" novalidate target="_blank"></form>', $form->getContent());
    }

    // public function testFormSelect() {
    //     $renderer = new BaseRenderer();
    //     $form = new Form($renderer);
    //     $form->setMethod(FormMethods::Post)
    //         ->setAction('filter.php');
    //     $this->expectOutputString('<form action="filter.php" method="post"><select id="status" name="status"><option value="All" selected>All</option><option value="Draft">Draft</option><option value="Published">Published</option></select><button type="submit">Submit</button></form>');
    //     $form->open();
    //     $form->select('status')
    //         ->options([
    //             'All',
    //             'Draft',
    //             'Published'
    //         ])
    //         ->setValue('All')
    //         ->render();
    //     $form->submit()->setLabel('Submit')->render();
    //     $form->close();
    // }

    // public function testFormSelectAssoc() {
    //     $renderer = new BaseRenderer();
    //     $form = new Form($renderer);
    //     $form->setMethod(FormMethods::Post)
    //         ->setAction('filter.php');
    //     $this->expectOutputString('<form action="filter.php" method="post"><select id="status" name="status"><option value="all" selected>All</option><option value="draft">Draft</option><option value="published">Published</option></select><button type="submit">Submit</button></form>');
    //     $form->open();
    //     $form->select('status')
    //         ->options([
    //             'all' => 'All',
    //             'draft' => 'Draft',
    //             'published' => 'Published'
    //         ])
    //         ->setValue('all')
    //         ->render();
    //     $form->submit()->setLabel('Submit')->render();
    //     $form->close();
    // }

    // public function testFormDisabledInput() {
    //     $renderer = new BaseRenderer();
    //     $form = new Form($renderer);
    //     $this->expectOutputString('<form><input disabled id="test" name="test" type="text"></form>');
    //     $form->open();
    //     $form->text('test')->setDisabled()->render();
    //     $form->close();
    // }

    // public function testFormReadonlyInput() {
    //     $renderer = new BaseRenderer();
    //     $form = new Form($renderer);
    //     $this->expectOutputString('<form><input id="test" name="test" readonly type="text"></form>');
    //     $form->open();
    //     $form->text('test')->setReadonly()->render();
    //     $form->close();
    // }

    // public function testFormCheckboxInput() {
    //     $renderer = new BaseRenderer();
    //     $form = new Form($renderer);
    //     $this->expectOutputString('<form><label for="test"><input id="test" name="test" type="checkbox"> Test</label></form>');
    //     $form->open();
    //     $form->checkbox('test')->setLabel('Test')->render();
    //     $form->close();
    // }

    // public function testFormColorInput() {
    //     $renderer = new BaseRenderer();
    //     $form = new Form($renderer);
    //     $this->expectOutputString('<form><input id="test" name="test" type="color"></form>');
    //     $form->open();
    //     $form->color('test')->render();
    //     $form->close();
    // }

    // public function testFormDateInput() {
    //     $renderer = new BaseRenderer();
    //     $form = new Form($renderer);
    //     $this->expectOutputString('<form><input id="test" name="test" type="date"></form>');
    //     $form->open();
    //     $form->date('test')->render();
    //     $form->close();
    // }

    // public function testFormDatetimeLocalInput() {
    //     $renderer = new BaseRenderer();
    //     $form = new Form($renderer);
    //     $this->expectOutputString('<form><input id="test" name="test" type="datetime-local"></form>');
    //     $form->open();
    //     $form->datetimelocal('test')->render();
    //     $form->close();
    // }

    // public function testFormEmailInput() {
    //     $renderer = new BaseRenderer();
    //     $form = new Form($renderer);
    //     $this->expectOutputString('<form><input id="test" name="test" type="email"></form>');
    //     $form->open();
    //     $form->email('test')->render();
    //     $form->close();
    // }

    // public function testFormFileInput() {
    //     $renderer = new BaseRenderer();
    //     $form = new Form($renderer);
    //     $this->expectOutputString('<form><input id="test" name="test" type="file"></form>');
    //     $form->open();
    //     $form->file('test')->render();
    //     $form->close();
    // }

    // public function testFormHiddenInput() {
    //     $renderer = new BaseRenderer();
    //     $form = new Form($renderer);
    //     $this->expectOutputString('<form><input id="test" name="test" type="hidden"></form>');
    //     $form->open();
    //     $form->hidden('test')->render();
    //     $form->close();
    // }

    // public function testFormImageInput() {
    //     $renderer = new BaseRenderer();
    //     $form = new Form($renderer);
    //     $this->expectOutputString('<form><input id="test" name="test" type="image"></form>');
    //     $form->open();
    //     $form->image('test')->render();
    //     $form->close();
    // }

    // public function testFormMonthInput() {
    //     $renderer = new BaseRenderer();
    //     $form = new Form($renderer);
    //     $this->expectOutputString('<form><input id="test" name="test" type="month"></form>');
    //     $form->open();
    //     $form->month('test')->render();
    //     $form->close();
    // }

    // public function testFormNumberInput() {
    //     $renderer = new BaseRenderer();
    //     $form = new Form($renderer);
    //     $this->expectOutputString('<form><input id="test" name="test" type="number"></form>');
    //     $form->open();
    //     $form->number('test')->render();
    //     $form->close();
    // }

    // public function testFormPasswordInput() {
    //     $renderer = new BaseRenderer();
    //     $form = new Form($renderer);
    //     $this->expectOutputString('<form><input id="test" name="test" type="password"></form>');
    //     $form->open();
    //     $form->password('test')->render();
    //     $form->close();
    // }

    // public function testFormRadioInput() {
    //     $renderer = new BaseRenderer();
    //     $form = new Form($renderer);
    //     $this->expectOutputString('<form><label for="test"><input id="test" name="test" type="radio"> Test</label></form>');
    //     $form->open();
    //     $form->radio('test')->setLabel('Test')->render();
    //     $form->close();
    // }

    // public function testFormRangeInput() {
    //     $renderer = new BaseRenderer();
    //     $form = new Form($renderer);
    //     $this->expectOutputString('<form><input id="test" name="test" type="range"></form>');
    //     $form->open();
    //     $form->range('test')->render();
    //     $form->close();
    // }

    // public function testFormResetInput() {
    //     $renderer = new BaseRenderer();
    //     $form = new Form($renderer);
    //     $this->expectOutputString('<form><input id="test" name="test" type="reset"></form>');
    //     $form->open();
    //     $form->reset('test')->render();
    //     $form->close();
    // }

    // public function testFormSearchInput() {
    //     $renderer = new BaseRenderer();
    //     $form = new Form($renderer);
    //     $this->expectOutputString('<form><input id="test" name="test" type="search"></form>');
    //     $form->open();
    //     $form->search('test')->render();
    //     $form->close();
    // }

    // public function testFormTelInput() {
    //     $renderer = new BaseRenderer();
    //     $form = new Form($renderer);
    //     $this->expectOutputString('<form><input id="test" name="test" type="tel"></form>');
    //     $form->open();
    //     $form->tel('test')->render();
    //     $form->close();
    // }

    // public function testFormTextInput() {
    //     $renderer = new BaseRenderer();
    //     $form = new Form($renderer);
    //     $this->expectOutputString('<form><input id="test" name="test" type="text"></form>');
    //     $form->open();
    //     $form->text('test')->render();
    //     $form->close();
    // }

    // public function testFormTimeInput() {
    //     $renderer = new BaseRenderer();
    //     $form = new Form($renderer);
    //     $this->expectOutputString('<form><input id="test" name="test" type="time"></form>');
    //     $form->open();
    //     $form->time('test')->render();
    //     $form->close();
    // }

    // public function testFormUrlInput() {
    //     $renderer = new BaseRenderer();
    //     $form = new Form($renderer);
    //     $this->expectOutputString('<form><input id="test" name="test" type="url"></form>');
    //     $form->open();
    //     $form->url('test')->render();
    //     $form->close();
    // }

    // public function testFormWeekInput() {
    //     $renderer = new BaseRenderer();
    //     $form = new Form($renderer);
    //     $this->expectOutputString('<form><input id="test" name="test" type="week"></form>');
    //     $form->open();
    //     $form->week('test')->render();
    //     $form->close();
    // }

    // public function testFormLogin() {
    //     $renderer = new BaseRenderer();
    //     $form = new Form($renderer);
    //     $form->setMethod(FormMethods::Post)
    //         ->setAction('login.php');
    //     $this->expectOutputString('<form action="login.php" method="post"><input id="user" name="user" placeholder="User" required type="email"><input id="password" name="password" placeholder="Password" required type="password"><button type="submit">Submit</button></form>');
    //     $form->open();
    //     $form->email('user')
    //         ->placeholder('User')
    //         ->setRequired()
    //         ->render();
    //     $form->password('password')
    //         ->placeholder('Password')
    //         ->setRequired()
    //         ->render();
    //     $form->submit()
    //         ->setLabel('Submit')
    //         ->render();
    //     $form->close();
    // }

    // public function testFormContact() {
    //     $renderer = new BaseRenderer();
    //     $form = new Form($renderer);
    //     $form->setMethod(FormMethods::Post)
    //         ->setAction('contact.php');
    //     $this->expectOutputString('<form action="contact.php" method="post"><input id="csrf" name="csrf" type="hidden" value="47ea619425bf6d4a1322ec0cf59fd01b"><label for="email">Email address</label><input id="email" name="email" required type="email"><label for="subject">Subject</label><input id="subject" name="subject" required type="text"><label for="message">Your message</label><textarea id="message" name="message" required></textarea><label for="privacy"><input id="privacy" name="privacy" required type="checkbox"> I have read and agree with privacy policy</label><button type="submit">Submit</button></form>');
    //     $form->open();
    //     $form->hidden('csrf')
    //         ->setValue('47ea619425bf6d4a1322ec0cf59fd01b')
    //         ->render();
    //     $form->email('email')
    //         ->setRequired()
    //         ->setLabel('Email address')
    //         ->render();
    //     $form->text('subject')
    //         ->setRequired()
    //         ->setLabel('Subject')
    //         ->render();
    //     $form->textarea('message')
    //         ->setRequired()
    //         ->setLabel('Your message')
    //         ->render();
    //     $form->input('privacy', InputTypes::Checkbox)
    //         ->setRequired()
    //         ->setLabel('I have read and agree with privacy policy')
    //         ->render();
    //     $form->submit()
    //         ->setLabel('Submit')
    //         ->render();
    //     $form->close();
    // }
}
