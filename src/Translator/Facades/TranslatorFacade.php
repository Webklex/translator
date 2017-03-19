<?php
/*
* File:     TranslatorFacade.php
* Category: Facade
* Author:   M. Goldenbaum
* Created:  24.09.16 22:36
* Updated:  -
*
* Description:
*  -
*/

namespace Webklex\Translator\Facades;

use \Illuminate\Support\Facades\Facade;

/**
 * @see \Illuminate\Translation\Translator
 */
class TranslatorFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'webklex.translator';
    }
}
