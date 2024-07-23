<?php

namespace App\Helpers;

class Sanitize
{
    public static function htmlspecialchars(string $value): string
    {
        return htmlspecialchars($value);
    }

    public static function specialChars(string $value): string
    {
        return filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
    }

    public static function email(string $value): string
    {
        return filter_var($value, FILTER_SANITIZE_EMAIL);
    }
}
