<?php

declare(strict_types = 1);

/**
 * Caldera Forms
 * Form builder, part of Vecode Caldera
 * @author  biohzrdmx <github.com/biohzrdmx>
 * @copyright Copyright (c) 2023 Vecode. All rights reserved
 */

namespace Caldera\Forms;

use Caldera\Forms\Fields\Button;
use Caldera\Forms\Fields\ButtonTypes;
use Caldera\Forms\Fields\Input;
use Caldera\Forms\Fields\InputTypes;
use Caldera\Forms\Fields\Select;
use Caldera\Forms\Fields\Textarea;
use Caldera\Forms\Renderer\RendererInterface;

class Form {

    use HasAttributes;

    /**
     * RendererInterface implementation
     */
    protected RendererInterface $renderer;

    /**
     * Constructor
     * @param RendererInterface $renderer RendererInterface implementation
     */
    public function __construct(RendererInterface $renderer) {
        $this->renderer = $renderer;
    }

    /**
     * Get form renderer
     */
    public function getRenderer(): RendererInterface {
        return $this->renderer;
    }

    /**
     * Set form action
     * @param  string $action Form action
     * @return $this
     */
    public function action(string $action): self {
        $this->setAttribute('action', $action);
        return $this;
    }

    /**
     * Set form method
     * @param  FormMethods $method Form method
     * @return $this
     */
    public function method(FormMethods $method): self {
        $this->setAttribute('method', $method->value);
        return $this;
    }

    /**
     * Set form enctype
     * @param  FormMethods $enctype Form enctype
     * @return $this
     */
    public function enctype(FormEncTypes $enctype): self {
        $this->setAttribute('enctype', $enctype->value);
        return $this;
    }

    /**
     * Open form tag
     */
    public function open(): void {
        $attributes = $this->buildAttributes();
        $tag = $attributes ? "<form {$attributes}>" : '<form>';
        echo $tag;
    }

    /**
     * Create a button
     * @param string      $name Button name
     * @param ButtonTypes $type Button type
     */
    public function button(string $name = '', ButtonTypes $type = ButtonTypes::Button): Button {
        $button = new Button($this, $name, $type);
        return $button;
    }

    /**
     * Create an input
     * @param string     $name Input name
     * @param InputTypes $type Input type
     */
    public function input(string $name = '', InputTypes $type = InputTypes::Text): Input {
        $input = new Input($this, $name, $type);
        return $input;
    }

    /**
     * Create a select
     * @param  string $name Select name
     */
    public function select(string $name = ''): Select {
        $select = new Select($this, $name);
        return $select;
    }

    /**
     * Create a textarea
     * @param  string $name Textarea name
     */
    public function textarea(string $name = ''): Textarea {
        $textarea = new Textarea($this, $name);
        return $textarea;
    }

    /**
     * Create a checkbox input
     * @param  string $name Input name
     */
    public function checkbox(string $name): Input {
        return $this->input($name, InputTypes::Checkbox);
    }

    /**
     * Create a color input
     * @param  string $name Input name
     */
    public function color(string $name): Input {
        return $this->input($name, InputTypes::Color);
    }

    /**
     * Create a date input
     * @param  string $name Input name
     */
    public function date(string $name): Input {
        return $this->input($name, InputTypes::Date);
    }

    /**
     * Create a datetimelocal input
     * @param  string $name Input name
     */
    public function dateTimeLocal(string $name): Input {
        return $this->input($name, InputTypes::DatetimeLocal);
    }

    /**
     * Create a email input
     * @param  string $name Input name
     */
    public function email(string $name): Input {
        return $this->input($name, InputTypes::Email);
    }

    /**
     * Create a file input
     * @param  string $name Input name
     */
    public function file(string $name): Input {
        return $this->input($name, InputTypes::File);
    }

    /**
     * Create a hidden input
     * @param  string $name Input name
     */
    public function hidden(string $name): Input {
        return $this->input($name, InputTypes::Hidden);
    }

    /**
     * Create a image input
     * @param  string $name Input name
     */
    public function image(string $name): Input {
        return $this->input($name, InputTypes::Image);
    }

    /**
     * Create a month input
     * @param  string $name Input name
     */
    public function month(string $name): Input {
        return $this->input($name, InputTypes::Month);
    }

    /**
     * Create a number input
     * @param  string $name Input name
     */
    public function number(string $name): Input {
        return $this->input($name, InputTypes::Number);
    }

    /**
     * Create a password input
     * @param  string $name Input name
     */
    public function password(string $name): Input {
        return $this->input($name, InputTypes::Password);
    }

    /**
     * Create a radio input
     * @param  string $name Input name
     */
    public function radio(string $name): Input {
        return $this->input($name, InputTypes::Radio);
    }

    /**
     * Create a range input
     * @param  string $name Input name
     */
    public function range(string $name): Input {
        return $this->input($name, InputTypes::Range);
    }

    /**
     * Create a reset input
     * @param  string $name Input name
     */
    public function reset(string $name): Input {
        return $this->input($name, InputTypes::Reset);
    }

    /**
     * Create a search input
     * @param  string $name Input name
     */
    public function search(string $name): Input {
        return $this->input($name, InputTypes::Search);
    }

    /**
     * Create a tel input
     * @param  string $name Input name
     */
    public function tel(string $name): Input {
        return $this->input($name, InputTypes::Tel);
    }

    /**
     * Create a text input
     * @param  string $name Input name
     */
    public function text(string $name): Input {
        return $this->input($name, InputTypes::Text);
    }

    /**
     * Create a time input
     * @param  string $name Input name
     */
    public function time(string $name): Input {
        return $this->input($name, InputTypes::Time);
    }

    /**
     * Create a url input
     * @param  string $name Input name
     */
    public function url(string $name): Input {
        return $this->input($name, InputTypes::Url);
    }

    /**
     * Create a week input
     * @param  string $name Input name
     */
    public function week(string $name): Input {
        return $this->input($name, InputTypes::Week);
    }

    /**
     * Create a submit button
     * @param  string $name Button name
     */
    public function submit(string $name = ''): Button {
        return $this->button($name, ButtonTypes::Submit);
    }

    /**
     * Close form tag
     */
    public function close(): void {
        $tag = '</form>';
        echo $tag;
    }
}
