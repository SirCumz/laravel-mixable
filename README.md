Laravel Mixable!
===================
[![Latest Stable Version](https://poser.pugx.org/sircumz/laravel-mixable/v/stable)](https://packagist.org/packages/sircumz/laravel-mixable) [![Total Downloads](https://poser.pugx.org/sircumz/laravel-mixable/downloads)](https://packagist.org/packages/sircumz/laravel-mixable) [![Latest Unstable Version](https://poser.pugx.org/sircumz/laravel-mixable/v/unstable)](https://packagist.org/packages/sircumz/laravel-mixable) [![License](https://poser.pugx.org/sircumz/laravel-mixable/license)](https://packagist.org/packages/sircumz/laravel-mixable)

A Laravel 5.4+ package for mixing Laravel packages.

----------

Installing Laravel Mixable
-------
The preferred way of installing is through composer

    composer require sircumz/laravel-mixable

Add the service provider to config/app.php:

    SirCumz\LaravelMixable\LaravelMixableServiceProvider::class


Compiling Assets with Laravel Mix
-------
Add the following code to the top of "webpack.mix.js" if you want to enable asset compiling with Mixable.

    const mix = require('./vendor/sircumz/laravel-mixable/mixable.js');

 instruct Mixable what to mix. You can use almost every function that Laravel Mix has to offer in their API.

    public function boot() {
        $this->app['mixable']->mix( function($mix) {
            $mix->sass( __DIR__ . '/assets/css/style.css', 'public/mypackage/css/style.css' )
                ->version();
        } );
    }

 Run the Laravel Mix commands in your terminal as you normally would do.

    npm run watch

Enjoy!
