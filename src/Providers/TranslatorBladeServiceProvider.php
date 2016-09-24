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

namespace webklex\translator\Providers;

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
            return "<?php echo webklex\\translator\\Facades\\TranslatorFacade::get(with{$expression}); ?>";
        });
    }

    /**
     * Dummy
     */
    public function register() {}
}