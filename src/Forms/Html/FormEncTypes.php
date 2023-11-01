<?php

declare(strict_types = 1);

/**
 * Caldera Forms
 * Form builder, part of Vecode Caldera
 * @author  biohzrdmx <github.com/biohzrdmx>
 * @copyright Copyright (c) 2023 Vecode. All rights reserved
 */

namespace Caldera\Forms\Html;

enum FormEncTypes: string {
    case UrlEncoded = 'application/x-www-form-urlencoded';
    case Multipart = 'multipart/form-data';
    case Plain = 'text/plain';
}
