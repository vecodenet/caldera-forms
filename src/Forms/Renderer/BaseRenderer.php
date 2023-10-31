<?php

declare(strict_types = 1);

/**
 * Caldera Forms
 * Form builder, part of Vecode Caldera
 * @author  biohzrdmx <github.com/biohzrdmx>
 * @copyright Copyright (c) 2023 Vecode. All rights reserved
 */

namespace Caldera\Forms\Renderer;

use Caldera\Forms\Fields\AbstractField;
use Caldera\Forms\Fields\Button;
use Caldera\Forms\Fields\Input;
use Caldera\Forms\Fields\InputTypes;
use Caldera\Forms\Fields\Select;
use Caldera\Forms\Fields\Textarea;

class BaseRenderer implements RendererInterface {

    /**
     * @inheritdoc
     */
    public function renderButton(Button $button): void {
        $label = $button->getLabel();
        $value = $button->getValue();
        $attributes = $button->buildAttributes(['value' => $value]);
        $tag = $attributes ? "<button {$attributes}>{$label}</button>" : "<button>{$label}</button>";
        echo $tag;
    }

    /**
     * @inheritdoc
     */
    public function renderInput(Input $input): void {
        $label = $input->getLabel();
        $value = $input->getValue();
        $attributes = $input->buildAttributes(['value' => $value]);
        switch ( $input->getAttribute('type') ) {
            case InputTypes::Checkbox->value:
            case InputTypes::Radio->value:
                $for = $input->hasAttribute('id') ? sprintf(' for="%s"', $input->getAttribute('id') ) : '';;
                $tag = $attributes ? "<label{$for}><input {$attributes}> {$label}</label>" : "<label{$for}><input> {$label}</label>";
            break;
            default:
                $tag = $attributes ? "<input {$attributes}>" : '<input>';
                $this->renderLabel($input);
        }
        echo $tag;
    }

    /**
     * @inheritdoc
     */
    public function renderSelect(Select $select): void {
        $options = $select->buildOptions();
        $attributes = $select->buildAttributes();
        $tag = $attributes ? "<select {$attributes}>{$options}</select>" : "<select>{$options}</select>";
        $this->renderLabel($select);
        echo $tag;
    }

    /**
     * @inheritdoc
     */
    public function renderTextarea(Textarea $textarea): void {
        $value = $textarea->getValue();
        $attributes = $textarea->buildAttributes();
        $tag = $attributes ? "<textarea {$attributes}>{$value}</textarea>" : "<textarea>{$value}</textarea>";
        $this->renderLabel($textarea);
        echo $tag;
    }

    /**
     * Render a label element
     * @param  AbstractField $field AbstractField element
     */
    protected function renderLabel(AbstractField $field): void {
        $label = $field->getLabel();
        if ($label) {
            $for = $field->hasAttribute('id') ? sprintf('for="%s"', $field->getAttribute('id') ) : '';
            $tag = $for ? "<label {$for}>{$label}</label>" : "<label>{$label}</label>";
            echo $tag;
        }
    }
}
