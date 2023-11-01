<?php

declare(strict_types = 1);

/**
 * Caldera Forms
 * Form builder, part of Vecode Caldera
 * @author  biohzrdmx <github.com/biohzrdmx>
 * @copyright Copyright (c) 2023 Vecode. All rights reserved
 */

namespace Caldera\Forms\Html;

class Button extends FormElement {

    /**
     * Set type attribute
     * @param  ButtonTypes $type Attribute value
     * @return $this
     */
    public function setType(ButtonTypes $type): self {
        $this->setAttribute('type', $type->value);
        return $this;
    }
}
