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

class Input extends AbstractField {

    /**
     * Constructor
     * @param Form       $form Form instance
     * @param string     $name Input name
     * @param InputTypes $type Input type
     */
    public function __construct(Form $form, string $name, InputTypes $type = InputTypes::Text) {
        parent::__construct($form, $name);
        $this->setAttribute('type', $type->value);
    }

    /**
     * Set placeholder attribute
     * @param  string $placeholder Placeholder attribute value
     * @return $this
     */
    public function placeholder(string $placeholder): self {
        $this->setAttribute('placeholder', $placeholder);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function render(): void {
        $this->form->getRenderer()->renderInput($this);
    }
}
