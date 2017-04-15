# Translator (CSV File based)

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Total Downloads][ico-downloads]][link-downloads]

This is a translator package provides everything you need to get started with a quiet fast CSV file based translation service.

## Install

Via Composer

``` bash
$ composer require webklex/translator
```

## Setup

Add the service provider to the providers array in `config/app.php`.

``` php
'providers' => [
    Webklex\Translator\Providers\TranslatorServiceProvider::class,
    Webklex\Translator\Providers\TranslatorBladeServiceProvider::class,
];
```

## Middleware

You may want to use the middleware in order to control the global language setup inside `app/Http/Kernel.php`.

``` php
protected $routeMiddleware = [
    'translator' => Webklex\Translator\Middleware\TranslatorMiddleware::class,
];
```

## Routes and language switching

If you want to change the system language by clicking on a link, you could use something like this:


Inside your controller:
``` php
/**
 * Change the current language
 *
 * @param string $locale
 * @return \Illuminate\Http\RedirectResponse
 */
public function changeLanguage($locale){
    if(in_array($locale, config('translator.available'))){
        Session::put('locale', $locale);
        Session::save();
        app()->setLocale($locale);
    }

    return redirect()->back();
}
```

Inside your routing file:
``` php
Route::get('/language/{locale}', 'YourControllerName@changeLanguage');
```

## Publishing

You can publish everything at once

``` php
php artisan vendor:publish --provider="Webklex\Translator\Providers\TranslatorServiceProvider"
```

or you can publish groups individually.

``` php
php artisan vendor:publish --provider="Webklex\Translator\Providers\TranslatorServiceProvider" --tag="config"
```

## Usage

This is a translator package provides everything you need to get started with a quiet fast CSV file based translation service.
Your translation files will be stored by default in `resources/lang/` your language code (e.g. `en`) `/default.csv`.

Access Translator by its Facade (Webklex\Translator\Facades\TranslatorFacade). 
Therefor you might want to add an alias to the aliases array within the `config/app.php` file.

``` php
'aliases' => [
    'Lang' => Webklex\Translator\Facades\TranslatorFacade::class
];
```

You registered the TranslatorBladeServiceProvider you can even use this easy shorthand directive.

``` html
@t('My translation')
@t('My translation', 'en')
```

If you are using something like my other package `webklex/helpers` you can use a helper function to make the access even easier.

Therefor create a new helper: `php artisan make:helper translator` and edit the `app/Helpers/translator.php`.
``` php
if (!function_exists('_t')) {

    /**
     * Shorthand translation
     * @param string $string
     * @param string $locale
     *
     * @return string
     */
    function _t($string, $locale = null)
    {
        return Webklex\Translator\Facades\TranslatorFacade::get($string, $locale);
    }
}
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email github@webklex.com instead of using the issue tracker.

## Credits

- [Webklex][link-author]
- All Contributors

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/Webklex/Translator.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/Webklex/translator/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/Webklex/Translator.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/Webklex/Translator.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/Webklex/Translator.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/Webklex/Translator
[link-travis]: https://travis-ci.org/Webklex/Translator
[link-scrutinizer]: https://scrutinizer-ci.com/g/Webklex/Translator/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/Webklex/Translator
[link-downloads]: https://packagist.org/packages/Webklex/Translator
[link-author]: https://github.com/webklex