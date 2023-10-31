<?php

declare(strict_types = 1);

/**
 * Caldera Forms
 * Form builder, part of Vecode Caldera
 * @author  biohzrdmx <github.com/biohzrdmx>
 * @copyright Copyright (c) 2023 Vecode. All rights reserved
 */

namespace Caldera\Forms\Fields;

class Select extends AbstractField {

    /**
     * Options array
     */
    protected array $options = [];

    /**
     * Add option
     * @param  string $value Option value
     * @param  string $label Option label
     * @return $this
     */
    public function option(string $value, string $label = ''): self {
        $label = $label ?: $value;
        $this->options[$value] = $label;
        return $this;
    }

    /**
     * Set options
     * @param  array  $options Options array
     * @return $this
     */
    public function options(array $options): self {
        foreach ($options as $value => $label) {
            $this->option(is_string($value) ? $value : $label, $label);
        }
        return $this;
    }

    /**
     * Build options
     */
    public function buildOptions(): string {
        $options = array_unique($this->options);
        $options = array_map(function($value, $label) {
            $selected = $this->value === $value ? ' selected' : '';
            return sprintf('<option value="%s"%s>%s</option>', $value, $selected, $label);
        }, array_keys($options), array_values($options));
        $options = implode('', $options);
        return $options;
    }

    /**
     * @inheritdoc
     */
    public function render(): void {
        $this->form->getRenderer()->renderSelect($this);
    }
}
