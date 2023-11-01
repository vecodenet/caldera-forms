<?php

declare(strict_types = 1);

/**
 * Caldera Forms
 * Form builder, part of Vecode Caldera
 * @author  biohzrdmx <github.com/biohzrdmx>
 * @copyright Copyright (c) 2023 Vecode. All rights reserved
 */

namespace Caldera\Forms\Builder;

class BaseBuilder extends AbstractBuilder {

    /**
     * @inheritdoc
     */
    protected string $group_class = 'mb-3';

    /**
     * @inheritdoc
     */
    protected string $label_class = 'mb-1';
}
