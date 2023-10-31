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

class Button extends AbstractField {

    /**
     * Constructor
     * @param Form        $form Form instance
     * @param string      $name Button name
     * @param ButtonTypes $type Button type
     */
    public function __construct(Form $form, string $name, ButtonTypes $type = ButtonTypes::Submit) {
        parent::__construct($form, $name);
        $this->setAttribute('type', $type->value);
    }

    /**
     * @inheritdoc
     */
    public function render(): void {
        $this->form->getRenderer()->renderButton($this);
    }
}
