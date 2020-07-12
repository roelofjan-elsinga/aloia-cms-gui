<?php

namespace AloiaCms\GUI\Helpers;

class Json
{
    public static function isValid(string $value): bool
    {
        if (!empty($value)) {
            @json_decode($value);
            return (json_last_error() === JSON_ERROR_NONE);
        }

        return false;
    }
}
