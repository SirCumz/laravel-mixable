<?php

namespace SirCumz\LaravelMixable;

use Illuminate\Support\ServiceProvider;

class LaravelMixableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->alias('mixable', Mixable::class);

        $this->app->singleton('mixable', function ($app) {

            $mixable = new Mixable($app['files']);

            return $mixable;
        });

        $this->commands([
            Console\ManifestCommand::class
        ]);
    }
}
