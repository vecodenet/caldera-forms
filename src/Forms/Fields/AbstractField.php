<?php

declare(strict_types = 1);

/**
 * Caldera Forms
 * Form builder, part of Vecode Caldera
 * @author  biohzrdmx <github.com/biohzrdmx>
 * @copyright Copyright (c) 2023 Vecode. All rights reserved
 */

namespace Caldera\Forms\Fields;

use Caldera\Forms\Form;
use Caldera\Forms\HasAttributes;

abstract class AbstractField {

    use HasAttributes;

    /**
     * Form instance
     */
    protected Form $form;

    /**
     * Field label
     */
    protected string $label = '';

    /**
     * Field value
     */
    protected string $value = '';

    /**
     * Constructor
     * @param Form   $form Form instance
     * @param string $name Field name
     */
    public function __construct(Form $form, string $name = '') {
        $this->form = $form;
        $this->setAttribute('id', $name);
        $this->setAttribute('name', $name);
    }

    /**
     * Get field label
     */
    public function getLabel(): string {
        return $this->label;
    }

    /**
     * Get field value
     */
    public function getValue(): string {
        return $this->value;
    }

    /**
     * Set field label
     * @param string $label Field label
     */
    public function setLabel(string $label): self {
        $this->label = $label;
        return $this;
    }

    /**
     * Set field value
     * @param string $value Field value
     */
    public function setValue(string $value): self {
        $this->value = $value;
        return $this;
    }

    /**
     * Render field
     */
    public abstract function render(): void;
}
