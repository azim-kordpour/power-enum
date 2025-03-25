<?php

namespace Tests\Unit\Examples;

use AzimKordpour\PowerEnum\Traits\PowerEnum;

enum TestRole: string
{
    use PowerEnum;

    case Admin = 'admin';

    /**
     * Set the labels of all the cases.
     *
     * Keys are the values of the cases and the values are the labels.
     *
     * @return array<string, string>
     */
    protected static function setLabels(): array
    {
        return [
            self::Admin->value => 'Administrator',
        ];
    }
}
