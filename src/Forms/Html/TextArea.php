<?php

declare(strict_types = 1);

/**
 * Caldera Forms
 * Form builder, part of Vecode Caldera
 * @author  biohzrdmx <github.com/biohzrdmx>
 * @copyright Copyright (c) 2023 Vecode. All rights reserved
 */

namespace Caldera\Forms\Html;

class TextArea extends FormElement {

    /**
     * Set rows attribute
     * @param  int $rows Attribute value
     * @return $this
     */
    public function setRows(int $rows): self {
        $this->setAttribute('rows', (string) $rows);
        return $this;
    }

    /**
     * Set cols attribute
     * @param  int $cols Attribute value
     * @return $this
     */
    public function setCols(int $cols): self {
        $this->setAttribute('cols', (string) $cols);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setValue(string $value): self {
        $this->setContent($value);
        return $this;
    }
}
