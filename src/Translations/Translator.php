<?php


namespace AloiaCms\GUI\Translations;

use Illuminate\Support\Facades\Config;

class Translator
{

    /**
     * @var string $identifier
     */
    private $identifier;

    private function __construct(string $identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * Create a new instance for the given identifier
     *
     * @param string $identifier
     * @return Translator
     */
    public static function forIdentifier(string $identifier): Translator
    {
        return new static($identifier);
    }

    /**
     * Translate the identifier for the selected language
     *
     * @return string
     */
    public function translate(): string
    {
        $language = $this->getSelectedLanguage();

        $translations = $this->getTranslationsForLanguage($language);

        return $translations[$this->identifier] ?? $this->identifier;
    }

    /**
     * Get the translations for the given language
     *
     * @param string $language
     * @return array
     */
    private function getTranslationsForLanguage(string $language): array
    {
        try {
            return include("languages/{$language}.php");
        } catch (\ErrorException $exception) {
            return [];
        }
    }

    /**
     * Get the selected language from the configuration
     *
     * @return string
     */
    private function getSelectedLanguage(): string
    {
        return Config::get('aloiacmsgui.language');
    }
}
