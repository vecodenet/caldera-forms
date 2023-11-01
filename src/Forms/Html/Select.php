<?php

declare(strict_types = 1);

/**
 * Caldera Forms
 * Form builder, part of Vecode Caldera
 * @author  biohzrdmx <github.com/biohzrdmx>
 * @copyright Copyright (c) 2023 Vecode. All rights reserved
 */

namespace Caldera\Forms\Html;

class Select extends FormElement {

    /**
     * Add option
     * @param string $value Option value
     * @param string $label Option label
     */
    public function addOption(string $value, string $label = '') {
        $label = $label ?: $value;
        $option = Element::createElement('option')
            ->setAttribute('value', $value)
            ->setContent($label);
        $this->append($option);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setValue(string $value): self {
        $child = $this->first_child;
        while($child) {
            if ( $child->getAttribute('value') === $value ) {
                $child->setAttribute('selected', true);
            }
            $child = $child->getNext();
        }
        return $this;
    }
}
