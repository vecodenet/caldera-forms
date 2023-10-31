<?php

declare(strict_types = 1);

/**
 * Caldera Forms
 * Form builder, part of Vecode Caldera
 * @author  biohzrdmx <github.com/biohzrdmx>
 * @copyright Copyright (c) 2023 Vecode. All rights reserved
 */

namespace Caldera\Forms;

trait HasAttributes {

    /**
     * Attributes array
     */
    protected array $attributes = [];

    /**
     * Set class attribute
     * @param  string $class Class attribute value
     * @return $this
     */
    public function class(string $class): self {
        $this->setAttribute('class', $class);
        return $this;
    }

    /**
     * Set disabled attribute
     * @param  bool $disabled Disabled attribute value
     * @return $this
     */
    public function disabled(bool $disabled = true): self {
        $this->setAttribute('disabled', $disabled);
        return $this;
    }

    /**
     * Set id attribute
     * @param  string $id ID attribute value
     * @return $this
     */
    public function id(string $id): self {
        $this->setAttribute('id', $id);
        return $this;
    }

    /**
     * Set readonly attribute
     * @param  bool $readonly Required attribute value
     * @return $this
     */
    public function readonly(bool $readonly = true): self {
        $this->setAttribute('readonly', $readonly);
        return $this;
    }

    /**
     * Set required attribute
     * @param  bool $required Required attribute value
     * @return $this
     */
    public function required(bool $required = true): self {
        $this->setAttribute('required', $required);
        return $this;
    }

    /**
     * Add attribute
     * @param string      $name  Attribute name
     * @param string|bool $value Attribute value
     */
    public function setAttribute(string $name, string|bool $value): self {
        if (! $value ) {
            unset( $this->attributes[$name] );
        }
        $this->attributes[$name] = $value;
        return $this;
    }

    /**
     * Get attribute
     * @param string      $name    Attribute name
     * @param string|bool $default Default value
     */
    public function getAttribute(string $name, string|bool $default = ''): string|bool {
        return $this->attributes[$name] ?? $default;
    }

    /**
     * Get attributes
     */
    public function getAttributes(): array {
        return $this->attributes;
    }

    /**
     * Check if attribute is set
     * @param string $name Attribute name
     */
    public function hasAttribute(string $name): bool {
        return isset( $this->attributes[$name] );
    }

    /**
     * Build attributes
     */
    public function buildAttributes(array $extra = []): string {
        $attributes = array_merge($this->attributes, $extra);
        $attributes = array_filter($attributes);
        ksort($attributes);
        return join(' ', array_map(function($key) use ($attributes){
            if ( is_bool( $attributes[$key] ) ){
                return $attributes[$key] ? $key : '';
            }
            return sprintf('%s="%s"', $key, $attributes[$key]);
        }, array_keys($attributes)));
    }
}
