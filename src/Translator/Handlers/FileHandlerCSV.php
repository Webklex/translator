<?php
/*
* File:     FileHandlerCSV.php
* Category: Handler
* Author:   M. Goldenbaum
* Created:  24.09.16 22:36
* Updated:  -
*
* Description:
*  -
*/

namespace Webklex\Translator\Handlers;

class FileHandlerCSV extends FileHandler
{

    /**
     * Load a locale from a given path.
     *
     * @param  string $locale
     * @return array
     */
    public function load($locale)
    {
        if ($this->files->exists($full = "{$this->path}/{$locale}/default.csv")) {
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
    public function save($aLanguage, $locale)
    {
        return $this->saveFileData($aLanguage, $this->path."/".$locale."/default.csv");
    }

    /**
     * Parses the Language File
     *
     * @param  string $fileData
     * @return array
     */
    protected function loadFileData($fileData)
    {
        $language = array();
        $fileData = explode("\n", $fileData);
        for ($i = 1; $i < count($fileData); $i++) {
            $fileData[$i] = explode(';', $fileData[$i]);
            if (count($fileData[$i]) > 1) {
                $language[$fileData[$i][0]] = array(
                    "value" => $fileData[$i][1],
                    "missing" => isset($fileData[$i][2]) ? $fileData[$i][2] : ""
                );
            }
        }
        return $language;
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
        ksort($aLanguage);
        $content = "Key;Value;Missing\n";
        foreach($aLanguage as $key => $val ) {
            $content .= "{$key};{$val["value"]};{$val["missing"]}\n";
        }
        $this->files->put($filename, $content);
        return $aLanguage;
    }


}
