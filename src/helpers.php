<?php

use FlatFileCms\GUI\Translations\Translator;
use FlatFileCms\GUI\User;

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

function user(): ?User
{
    return User::fromRequest(request());
}
