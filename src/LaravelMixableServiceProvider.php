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
        $this->commands([
            Console\MixableCommand::class
        ]);
    }
}
