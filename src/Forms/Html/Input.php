<?php

declare(strict_types = 1);

/**
 * Caldera Forms
 * Form builder, part of Vecode Caldera
 * @author  biohzrdmx <github.com/biohzrdmx>
 * @copyright Copyright (c) 2023 Vecode. All rights reserved
 */

namespace Caldera\Forms\Html;

class Input extends FormElement {

    /**
     * Set type attribute
     * @param  InputTypes $type Attribute value
     * @return $this
     */
    public function setType(InputTypes $type): self {
        $this->setAttribute('type', $type->value);
        return $this;
    }
}
