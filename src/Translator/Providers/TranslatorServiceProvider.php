<?php
/*
* File:     TranslatorServiceProvider.php
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
use Webklex\Translator\Handlers\FileHandlerCSV;
use Webklex\Translator\Translator;

class TranslatorServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerLoader();

        $this->app->singleton('webklex.translator', function ($app) {
            return new Translator($app['webklex.translator.loader'], $app->getLocale());
        });
    }

    /**
     * Register the translation line loader.
     *
     * @return void
     */
    protected function registerLoader()
    {
        $this->app->singleton('webklex.translator.loader', function ($app) {
            return new FileHandlerCSV($app['files'], $app['path.lang']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['webklex.translator', 'webklex.translator.loader'];
    }
}