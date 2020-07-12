<?php

namespace AloiaCms\GUI\Helpers;

class Json
{
    public static function isValid(string $value): bool
    {
        if (!empty($data)) {
            @json_decode($data);
            return (json_last_error() === JSON_ERROR_NONE);
        }

        return false;
    }
}
