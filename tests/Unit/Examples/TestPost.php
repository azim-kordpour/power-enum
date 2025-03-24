<?php

namespace Tests\Unit\Examples;

use AzimKordpour\PowerEnum\Traits\PowerEnum;

/**
 * @method bool isActive()
 * @method bool isInactive()
 */
enum TestPost: string
{
    use PowerEnum;

    case Active = 'active';
    case Inactive = 'inactive';
}
