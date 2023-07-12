<?php

if (!function_exists('getStringAfterIsForEnumName')) {
    /**
     * Get the string after the given string.
     */
    function getStringAfterIsForEnumName(string $string): string|null
    {
        $pos = stripos($string, 'is');

        return $pos !== false && substr($string, $pos, 2) === 'is' ? substr($string, $pos + 2) : null;
    }
}
