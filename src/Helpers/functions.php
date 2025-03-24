<?php

if (! function_exists('getStringAfterIsForEnumName')) {
    /**
     * Get the string after the given string.
     */
    function getStringAfterIsForEnumName(string $string): ?string
    {
        if (str_starts_with($string, 'is')) {
            return substr($string, 2);
        }

        return null;
    }
}
