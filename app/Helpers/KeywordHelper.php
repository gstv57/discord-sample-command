<?php

namespace App\Helpers;

class KeywordHelper
{
    public static function extractKeyword(string $content): string
    {
        $parts = explode(' ', $content);

        return implode(' ', array_slice($parts, 1));
    }
}
