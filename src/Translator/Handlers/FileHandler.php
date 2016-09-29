<?php
/*
* File:     translator.php
* Category: Handler
* Author:   M. Goldenbaum
* Created:  24.09.16 22:36
* Updated:  -
*
* Description:
*  -
*/

namespace Webklex\Translator\Handlers;

use Illuminate\Filesystem\Filesystem;

class FileHandler implements HandlerInterface
{
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * The default path for the loader.
     *
     * @var string
     */
    protected $path;

    /**
     * Create a new file loader instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem $files
     * @param  string $path
     */
    public function __construct(Filesystem $files, $path)
    {
        $this->path  = $path;
        $this->files = $files;
    }

    /**
     * Load the messages for the given locale.
     *
     * @param  string $locale
     * @return array
     */
    public function load($locale)
    {
        if ($this->files->exists($full = $this->path."/".$locale.".lang")) {
            return $this->loadFileData($this->files->get($full));
        }
        return [];
    }

    /**
     * Saves the messages for the given locale.
     *
     * @param  array $aLanguage
     * @param  string $locale
     * @return array
     */
    public function save($aLanguage,$locale)
    {
        return $this->saveFileData($aLanguage, $this->path."/".$locale.".lang");
    }

    /**
     * Parses the Language File
     *
     * @param  string $filedata
     * @return array
     */
    protected function loadFileData($filedata)
    {
        return [];
    }

    /**
     * Saves the Language File
     *
     * @param  array  $aLanguage
     * @param  string $filename
     * @return array
     */
    protected function saveFileData($aLanguage, $filename)
    {
        return [];
    }


}
