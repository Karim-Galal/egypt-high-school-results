<?php

namespace App\Support;

class ArabicNormalizer
{
    public static function normalize(string $text): string
    {
        $text = trim($text);

        $text = preg_replace('/\s+/', ' ', $text);

        return str_replace(
            ['أ', 'إ', 'آ', 'ى'],
            ['ا', 'ا', 'ا', 'ي'],
            $text
        );
    }
}
