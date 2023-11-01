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
use Caldera\Forms\Html\Input;
use Caldera\Forms\Html\InputTypes;
use Caldera\Forms\Html\Select;
use Caldera\Forms\Html\TextArea;

interface BuilderInterface {

    /**
     * Add form field
     * @param string  $tag      Field tag
     * @param string  $name     Field name
     * @param string  $label    Field label
     * @param Closure $callback Callback
     */
    public function addField(string $tag, string $name, string $label = '', ?Closure $callback = null): Element;

    /**
     * Add a Button element
     * @param string      $name  Button name
     * @param string      $label Button label
     * @param ButtonTypes $type  Button type
     * @param Closure     $callback Callback
     */
    public function addButton(string $name = '', string $label = '', ButtonTypes $type = ButtonTypes::Button, ?Closure $callback = null): Button;

    /**
     * Add an Input element
     * @param string    $name  Input name
     * @param string    $label Input label
     * @param InputType $type  Input type
     * @param Closure   $callback Callback
     */
    public function addInput(string $name, string $label = '', InputTypes $type = InputTypes::Text, ?Closure $callback = null): Input;

    /**
     * Add a Select element
     * @param string  $name  Select name
     * @param string  $label Select label
     * @param Closure $callback Callback
     */
    public function addSelect(string $name, string $label = '', ?Closure $callback = null): Select;

    /**
     * Add a TextArea element
     * @param string  $name  TextArea name
     * @param string  $label TextArea label
     * @param Closure $callback Callback
     */
    public function addTextArea(string $name, string $label = '', ?Closure $callback = null): TextArea;

    /**
     * Get Form element
     */
    public function getForm(): Form;

    /**
     * Get HTML code
     */
    public function getHtml(): string;

    /**
     * Show HTML code
     */
    public function showHtml(): void;
}
