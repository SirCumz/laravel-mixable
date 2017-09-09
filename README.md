laravel-modular!
===================
[![Latest Stable Version](https://poser.pugx.org/SirCumz/laravel-mixable/v/stable)](https://packagist.org/packages/SirCumz/laravel-mixable) [![Total Downloads](https://poser.pugx.org/SirCumz/laravel-mixable/downloads)](https://packagist.org/packages/SirCumz/laravel-mixable) [![Latest Unstable Version](https://poser.pugx.org/SirCumz/laravel-mixable/v/unstable)](https://packagist.org/packages/SirCumz/laravel-mixable) [![License](https://poser.pugx.org/SirCumz/laravel-mixable/license)](https://packagist.org/packages/SirCumz/laravel-mixable)

A Laravel 5.4+ package for mixing laravel packages

----------

Install
-------
The preferred way of installing is through composer

    composer require SirCumz/laravel-mixable

Add the service provider to config/app.php:

    SirCumz\LaravelModular\LaravelMixableServiceProvider::class


Compiling Module Assets with laravel Mix
-------
Add the following code to the top of "webpack.mix.js" if you want to enable asset compiling for modules.

    
    const mix = require('./vendor/sircumz/laravel-mixable/mixable.js');

