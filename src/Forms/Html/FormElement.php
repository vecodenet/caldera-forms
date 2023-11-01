<?php

declare(strict_types = 1);

/**
 * Caldera Forms
 * Form builder, part of Vecode Caldera
 * @author  biohzrdmx <github.com/biohzrdmx>
 * @copyright Copyright (c) 2023 Vecode. All rights reserved
 */

namespace Caldera\Forms\Html;

class FormElement extends Element {

    /**
     * Set disabled attribute
     * @param  bool $disabled Attribute value
     * @return $this
     */
    public function setDisabled(bool $disabled): self {
        $this->setAttribute('disabled', $disabled);
        return $this;
    }

    /**
     * Set name attribute
     * @param  string $name Attribute value
     * @return $this
     */
    public function setName(string $name): self {
        $this->setAttribute('name', $name);
        return $this;
    }

    /**
     * Set placeholder attribute
     * @param  string $placeholder Attribute value
     * @return $this
     */
    public function setPlaceholder(string $placeholder): self {
        $this->setAttribute('placeholder', $placeholder);
        return $this;
    }

    /**
     * Set readonly attribute
     * @param  bool $readonly Attribute value
     * @return $this
     */
    public function setReadOnly(bool $readonly): self {
        $this->setAttribute('readonly', $readonly);
        return $this;
    }

    /**
     * Set required attribute
     * @param  bool $required Attribute value
     * @return $this
     */
    public function setRequired(bool $required): self {
        $this->setAttribute('required', $required);
        return $this;
    }

    /**
     * Set value attribute
     * @param  string $value Attribute value
     * @return $this
     */
    public function setValue(string $value): self {
        $this->setAttribute('value', $value);
        return $this;
    }
}
