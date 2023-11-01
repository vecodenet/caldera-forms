<?php

declare(strict_types = 1);

/**
 * Caldera Forms
 * Form builder, part of Vecode Caldera
 * @author  biohzrdmx <github.com/biohzrdmx>
 * @copyright Copyright (c) 2023 Vecode. All rights reserved
 */

namespace Caldera\Forms\Html;

use Closure;

trait HasAttributes {

    /**
     * Attributes array
     */
    protected array $attributes = [];

    /**
     * Callbacks array
     */
    protected array $callbacks = [];

    /**
     * Add attribute
     * @param string      $name  Attribute name
     * @param string|bool $value Attribute value
     */
    public function setAttribute(string $name, string|bool $value): self {
        $old = $this->attributes[$name] ?? null;
        if ( $value === false ) {
            unset( $this->attributes[$name] );
        } else {
            $this->attributes[$name] = $value;
        }
        if ( isset( $this->callbacks[$name] ) ) {
            foreach ($this->callbacks[$name] as $callback) {
                $callback($value, $old);
            }
        }
        return $this;
    }

    /**
     * Set attributes
     * @param array $attributes Attributes array
     */
    public function setAttributes(array $attributes): self {
        if ( $attributes ) {
            foreach($attributes as $name => $value) {
                $this->setAttribute($name, $value);
            }
        }
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
        $attributes = array_replace($extra, $this->attributes);
        $attributes = array_filter($attributes);
        ksort($attributes);
        return join(' ', array_map(function($key) use ($attributes){
            if ( is_bool( $attributes[$key] ) ){
                return $attributes[$key] ? $key : '';
            }
            return sprintf('%s="%s"', $key, $attributes[$key]);
        }, array_keys($attributes)));
    }

    /**
     * On attribute change event handler
     * @param  string  $name     Attribute name
     * @param  Closure $callback Callback
     * @return $this
     */
    public function onAttributeChanged(string $name, Closure $callback): self {
        if (! isset( $this->callbacks[$name] ) ) {
            $this->callbacks[$name] = [];
        }
        $this->callbacks[$name][] = $callback;
        return $this;
    }
}
