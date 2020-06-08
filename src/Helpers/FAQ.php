<?php


namespace AloiaCms\GUI\Helpers;

class FAQ
{
    public static function isValid(?string $faq_string): bool
    {
        if (empty($faq_string)) {
            return false;
        }

        $faq = json_decode($faq_string);

        if ($faq === false) {
            return false;
        }

        if (count($faq) === 0) {
            return false;
        }

        return true;
    }

    public static function format(string $faq_string): array
    {
        return json_decode($faq_string, true);
    }
}
