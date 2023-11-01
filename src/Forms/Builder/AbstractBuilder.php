<?php

declare(strict_types = 1);

/**
 * Caldera Forms
 * Form builder, part of Vecode Caldera
 * @author  biohzrdmx <github.com/biohzrdmx>
 * @copyright Copyright (c) 2023 Vecode. All rights reserved
 */

namespace Caldera\Forms\Builder;

use Closure;

use Caldera\Forms\Html\Button;
use Caldera\Forms\Html\ButtonTypes;
use Caldera\Forms\Html\Element;
use Caldera\Forms\Html\Form;
use Caldera\Forms\Html\FormElement;
use Caldera\Forms\Html\Input;
use Caldera\Forms\Html\InputTypes;
use Caldera\Forms\Html\Select;
use Caldera\Forms\Html\TextArea;

abstract class AbstractBuilder implements BuilderInterface {

    /**
     * Form element
     */
    protected Form $form;

    /**
     * Group class
     */
    protected string $group_class = '';

    /**
     * Label class
     */
    protected string $label_class = '';

    /**
     * Constructor
     */
    public function __construct() {
        $this->form = new Form();
    }

    /**
     * @inheritdoc
     */
    public function addField(string $tag, string $name, string $label = '', ?Closure $callback = null): Element {
        # Create field element
        $field = FormElement::createElement($tag);
        $this->addFieldToForm($field, $name, $label, $callback);
        return $field;
    }

    /**
     * @inheritdoc
     */
    public function addButton(string $name = '', string $label = '', ButtonTypes $type = ButtonTypes::Button, ?Closure $callback = null): Button {
        $field = Button::createElement('button')
            ->setType($type)
            ->setContent('Send message');
        $this->addFieldToForm($field, $name, '', $callback);
        return $field;
    }

    /**
     * @inheritdoc
     */
    public function addInput(string $name, string $label = '', InputTypes $type = InputTypes::Text, ?Closure $callback = null): Input {
        $field = Input::createElement('input')
            ->setType($type);
        $this->addFieldToForm($field, $name, $label, $callback);
        return $field;
    }

    /**
     * @inheritdoc
     */
    public function addSelect(string $name, string $label = '', ?Closure $callback = null): Select {
        $field = Select::createElement('select');
        $this->addFieldToForm($field, $name, $label, $callback);
        return $field;
    }

    /**
     * @inheritdoc
     */
    public function addTextArea(string $name, string $label = '', ?Closure $callback = null): TextArea {
        $field = TextArea::createElement('textarea');
        $this->addFieldToForm($field, $name, $label, $callback);
        return $field;
    }

    /**
     * @inheritdoc
     */
    public function getForm(): Form {
        return $this->form;
    }

    /**
     * @inheritdoc
     */
    public function getHtml(): string {
        return $this->form->getContent();
    }

    /**
     * @inheritdoc
     */
    public function showHtml(): void {
        echo $this->getHtml();
    }

    protected function addFieldToForm(FormElement $field, string $name = '', string $label = '', ?Closure $callback = null) {
        # Set field name
        $field->setId($name)
            ->setName($name);
        # Now create the group
        $group = Element::createElement('div')
            ->setClass($this->group_class);
        # Add the field to the group
        $group->append($field);
        # Add the label, if set
        if ($label) {
            $field_label = Element::createElement('label')
                ->setAttribute('for', $name)
                ->setClass($this->label_class)
                ->setContent($label);
            $group->prepend($field_label);
            $field->onAttributeChanged('id', function($value) use ($field_label) {
                $field_label->setAttribute('for', $value);
            });
        }
        # Apply the callback, if any
        if ($callback) $callback($field, $group);
        # Finally append the group to the form
        $this->form->append($group);
        return $field;
    }
}
