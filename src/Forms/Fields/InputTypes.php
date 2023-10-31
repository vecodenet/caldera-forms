<?php

declare(strict_types = 1);

/**
 * Caldera Forms
 * Form builder, part of Vecode Caldera
 * @author  biohzrdmx <github.com/biohzrdmx>
 * @copyright Copyright (c) 2023 Vecode. All rights reserved
 */

namespace Caldera\Forms\Fields;

enum InputTypes: string {
    case Button = 'button';
    case Checkbox = 'checkbox';
    case Color = 'color';
    case Date = 'date';
    case DatetimeLocal = 'datetime-local';
    case Email = 'email';
    case File = 'file';
    case Hidden = 'hidden';
    case Image = 'image';
    case Month = 'month';
    case Number = 'number';
    case Password = 'password';
    case Radio = 'radio';
    case Range = 'range';
    case Reset = 'reset';
    case Search = 'search';
    case Submit = 'submit';
    case Tel = 'tel';
    case Text = 'text';
    case Time = 'time';
    case Url = 'url';
    case Week = 'week';
}
