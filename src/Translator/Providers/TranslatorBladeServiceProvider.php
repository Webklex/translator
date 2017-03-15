<?php
/*
* File:     TranslatorBladeServiceProvider.php
* Category: Provider
* Author:   M. Goldenbaum
* Created:  24.09.16 22:36
* Updated:  -
*
* Description:
*  -
*/

namespace Webklex\Translator\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class TranslatorBladeServiceProvider extends ServiceProvider
{
    /**
     * Boot a new instance
     */
    public function boot()
    {
        Blade::directive('t', function ($expression) {
            //Backward compatibality test
            if(substr($expression, 0, 1) == '(') $expression = substr($expression, 1, -1);

            //Translate the given string
            return "<?php echo Webklex\\Translator\\Facades\\TranslatorFacade::get(with({$expression})); ?>";
        });
    }

    /**
     * Dummy
     */
    public function register() {}
}