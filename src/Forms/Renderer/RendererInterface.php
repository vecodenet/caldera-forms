<?php

declare(strict_types = 1);

/**
 * Caldera Forms
 * Form builder, part of Vecode Caldera
 * @author  biohzrdmx <github.com/biohzrdmx>
 * @copyright Copyright (c) 2023 Vecode. All rights reserved
 */

namespace Caldera\Forms\Renderer;

use Caldera\Forms\Fields\Button;
use Caldera\Forms\Fields\Input;
use Caldera\Forms\Fields\Select;
use Caldera\Forms\Fields\Textarea;

interface RendererInterface {

    /**
     * Render button
     * @param  Button $button Button element
     */
    public function renderButton(Button $button): void;

    /**
     * Render input
     * @param  Input  $input Input element
     */
    public function renderInput(Input $input): void;

    /**
     * Render select
     * @param  Select $select Select element
     */
    public function renderSelect(Select $select): void;

    /**
     * Render textarea
     * @param  Textarea $textarea Textarea element
     */
    public function renderTextarea(Textarea $textarea): void;
}
