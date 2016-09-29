<?php
/*
* File:     Translator.php
* Category: Translator
* Author:   M. Goldenbaum
* Created:  24.09.16 22:36
* Updated:  -
*
* Description:
*  -
*/

namespace Webklex\Translator;

use Webklex\Translator\Handlers\HandlerInterface;

class Translator
{
    /**
     * The handler implementation.
     *
     * @var HandlerInterface
     */
    protected $handler;

    /**
     * The default locale being used by the translator.
     *
     * @var string
     */
    protected $locale;

    /**
     * The array of loaded translation languages.
     *
     * @var array
     */
    protected $languages = [];

    /**
     * The array of changes (not Found / set ) for the languages.
     *
     * @var array
     */
    protected $languagesChanges = [];

    /**
     * Create a new translator instance.
     *
     * @param  HandlerInterface $handler
     * @param  string $locale
     */
    public function __construct(HandlerInterface $handler, $locale)
    {
        $this->handler = $handler;
        $this->locale = $locale;
    }

    public function __destruct(){
        foreach($this->languagesChanges as $locale => $language ) {
            $this->load($locale);
            $this->handler->save(array_merge($this->languages[$locale],$language),$locale);
        }
    }

    /**
     * Determine if a translation exists.
     *
     * @param  string $key
     * @param  string $locale
     * @return bool
     */
    public function has($key, $locale = null)
    {
        return $this->get($key, $locale) !== $key;
    }

    /**
     * Get the translation for the given key.
     *
     * @param  string $key
     * @param  string $locale
     * @return string
     */
    public function get($key, $locale = null)
    {
        if(!$locale){
            $locale = $this->getLocale();
        }

        if($locale == config('translator.default')){
            return $key;
        }

        $this->load($locale);

        if (!isset($this->languages[$locale][$key])){
            $this->setMissing($key, $locale);
            return $key;
        }
        
        return $this->languages[$locale][$key]["value"];
    }

    /**
     * Set the Part on Missing
     *
     * @param  string $key
     * @param  string $locale
     * @return string
     */
    public function setMissing($key, $locale)
    {
        return $this->set($key, $key, $locale, true);
    }

    /**
     * Get the translation for the given key.
     *
     * @param  string $key
     * @param  string $value
     * @param  string $locale
     * @param  boolean $missing
     * @return string
     */
    public function set($key, $value, $locale, $missing = false)
    {
        $this->languagesChanges[$locale][$key]["value"] = $value;
        if($missing){
            $this->languagesChanges[$locale][$key]["missing"] = 'x';
        }
        return true;
    }

    /**
     * Load the specified language .
     *
     * @param  string $locale
     * @return void
     */
    public function load($locale)
    {
        if ($this->isLoaded($locale)) {
            return;
        }
        $this->languages[$locale] = $this->handler->load($locale);
    }

    /**
     * Determine if the given group has been loaded.
     *
     * @param  string $locale
     * @return bool
     */
    protected function isLoaded( $locale)
    {
        return isset($this->languages[$locale]);
    }

    /**
     * Get the language line handler implementation.
     *
     * @return HandlerInterface
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * Get the default locale being used.
     *
     * @return string
     */
    public function locale()
    {
        return $this->getLocale();
    }

    /**
     * Get the default locale being used.
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set the default locale.
     *
     * @param  string $locale
     * @return void
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @return array
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * @param array $languages
     */
    public function setLanguages($languages)
    {
        $this->languages = $languages;
    }

    /**
     * @return array
     */
    public function getLanguagesChanges()
    {
        return $this->languagesChanges;
    }

    /**
     * @param array $languagesChanges
     */
    public function setLanguagesChanges($languagesChanges)
    {
        $this->languagesChanges = $languagesChanges;
    }

}
