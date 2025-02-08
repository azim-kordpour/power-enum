<?php

namespace Tests\Unit\Examples;

use AzimKordpour\PowerEnum\Traits\PowerEnum;

enum TestComment: string
{
    use PowerEnum;

    case New = 'new';

    /**
     * Set the labels of all the cases.
     *
     * Keys are the values of the cases and the values are the labels.
     *
     * @return array<string, string>
     */
    public static function setLabels(): array
    {
        return [
            'old' => 'new comment'
        ];
    }
}