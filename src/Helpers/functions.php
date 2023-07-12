<?php

if (!function_exists('getStringAfterIsForEnumName')) {
    /**
     * Get the string after the given string.
     */
    function getStringAfterIsForEnumName(string $string): string|null
    {
        $pos = stripos($string, 'is');

        if (!$pos && substr($string, $pos, 2) === 'is') {
            return substr($string, $pos + 2);
        }

        if (!$pos && substr($string, $pos, 2) === 'iS' || !$pos && substr($string, $pos, 2) === 'Is') {
            throw new BadMethodCallException("'is' should be lower case.");
        }

        return null;
    }
}
