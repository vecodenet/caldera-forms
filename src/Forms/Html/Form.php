<?php

declare(strict_types = 1);

/**
 * Caldera Forms
 * Form builder, part of Vecode Caldera
 * @author  biohzrdmx <github.com/biohzrdmx>
 * @copyright Copyright (c) 2023 Vecode. All rights reserved
 */

namespace Caldera\Forms\Html;

use InvalidArgumentException;

use Caldera\Forms\Html\FormEncTypes;
use Caldera\Forms\Html\FormMethods;

class Form extends Element {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct('form');
    }

    /**
     * Static factory function
     * @param string $type Element tag
     */
    public static function createElement(string $tag = 'form') {
        if ($tag !== 'form' ) {
            throw new InvalidArgumentException("Element tag must be equal to 'form'");
        }
        return new static();
    }

    /**
     * Set form action
     * @param  string $action Form action
     * @return $this
     */
    public function setAction(string $action): self {
        $this->setAttribute('action', $action);
        return $this;
    }

    /**
     * Set form method
     * @param  FormMethods $method Form method
     * @return $this
     */
    public function setMethod(FormMethods $method): self {
        $this->setAttribute('method', $method->value);
        return $this;
    }

    /**
     * Set form enctype
     * @param  FormMethods $enctype Form enctype
     * @return $this
     */
    public function setEnctype(FormEncTypes $enctype): self {
        $this->setAttribute('enctype', $enctype->value);
        return $this;
    }
}
