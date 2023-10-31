<?php

declare(strict_types = 1);

/**
 * Caldera Forms
 * Form builder, part of Vecode Caldera
 * @author  biohzrdmx <github.com/biohzrdmx>
 * @copyright Copyright (c) 2023 Vecode. All rights reserved
 */

namespace Caldera\Forms\Fields;

class Textarea extends AbstractField {

    /**
     * @inheritdoc
     */
    public function render(): void {
        $this->form->getRenderer()->renderTextarea($this);
    }
}
