<?php

namespace Nowendwell\LaravelTerms;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Nowendwell\LaravelTerms\Http\Middleware\AcceptedTerms;

class LaravelTermsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'terms');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'terms');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        if ($this->app->runningInConsole()) {

            // $this->publishes([
            //     __DIR__.'/../config/config.php' => config_path('terms.php'),
            // ], 'config');

            // Publishing the views.
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/terms'),
            ], 'views');

            // Publishing the translation files.
            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/terms'),
            ], 'lang');
        }

        $router = $this->app->make(Router::class);
        $router->pushMiddlewareToGroup('web', AcceptedTerms::class);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'terms');


        // Register the main class to use with the facade
        $this->app->singleton('laravel-terms', function () {
            return new LaravelTerms;
        });
    }
}
