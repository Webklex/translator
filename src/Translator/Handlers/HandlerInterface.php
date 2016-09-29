<?php
/*
* File:     HandlerInterface.php
* Category: Interface
* Author:   M. Goldenbaum
* Created:  24.09.16 22:36
* Updated:  -
*
* Description:
*  -
*/

namespace Webklex\Translator\Handlers;

interface HandlerInterface
{
    /**
     * Load the messages for the given locale.
     *
     * @param  string  $locale
     * @return array
     */
    public function load($locale);

    /**
     * saves the messages for the given locale.
     *
     * @param  array   $aLanguage
     * @param  string  $locale
     * @return array
     */
    public function save($aLanguage, $locale);
}
