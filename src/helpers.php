<?php

use FlatFileCms\GUI\Translations\Translator;
use FlatFileCms\GUI\User;


if(!function_exists('_translate')) {

    /**
     * Return the translation for the given identifier
     *
     * @param string $identifier
     * @return string
     */
    function _translate(string $identifier): string
    {
        return Translator::forIdentifier($identifier)->translate();
    }

}

if(!function_exists('_translate_dynamic')) {

    /**
     * Return the translation for the given identifier and replace the dnynamic aspect
     *
     * @param string $identifier
     * @param string $replacer
     * @return string
     */
    function _translate_dynamic(string $identifier, string $replacer): string
    {
        $translation = Translator::forIdentifier($identifier)->translate();

        return sprintf($translation, $replacer);
    }

}

if(!function_exists('user')) {

    /**
     * Get the user from the current request
     *
     * @return User|null
     */
    function user(): ?User
    {
        return User::fromRequest(request());
    }

}
