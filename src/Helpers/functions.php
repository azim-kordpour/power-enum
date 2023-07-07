<?php

function getStringAfterIs(string $string): string|null
{
    $pos = stripos($string, 'is');

    return $pos !== false ? substr($string, $pos + 2) : null;
}