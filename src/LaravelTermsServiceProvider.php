<?php

namespace Nowendwell\LaravelTerms;

use Illuminate\Support\Str;
use Illuminate\Routing\Router;
use Illuminate\Support\Collection;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Nowendwell\LaravelTerms\Contracts\Term;
use Nowendwell\LaravelTerms\Http\Middleware\AcceptedTerms;

class LaravelTermsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(Filesystem $filesystem)
    {
        /*
         * Optional methods to load your package assets
         */
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('terms.php'),
            ], 'config');

            // Publishing the views.
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/terms'),
            ], 'views');

            // Publishing the translation files.
            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/terms'),
            ], 'lang');

            // Publish migration files.
            $this->publishes([
                __DIR__.'/../database/migrations/create_terms_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_terms_table'),
                __DIR__.'/../database/migrations/create_user_terms_table.php.stub' => $this->getMigrationFileName($filesystem, 'create_user_terms_table'),
            ], 'migrations');
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
        $this->app->singleton('laravel-terms', function ($app) {
            return new LaravelTerms($app['config']['terms']);
        });

        // Register the main class to use with the facade
        $this->app->singleton(LaravelTerms::class, function ($app) {
            return new LaravelTerms($app['config']['terms']);
        });

        // Bind the contract to model implementation
        $this->app->bind(Term::class, fn($app) => new $app['config']['model']);
    }

    /**
     * Returns existing migration file if found, else uses the current timestamp.
     *
     * @param Filesystem $filesystem
     * @return string
     */
    protected function getMigrationFileName(Filesystem $filesystem, $filename): string
    {
        $timestamp = date('Y_m_d_His');

        return Collection::make($this->app->databasePath().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR)
            ->flatMap(function ($path) use ($filesystem, $filename) {
                return $filesystem->glob($path."*_{$filename}.php");
            })->push($this->app->databasePath()."/migrations/{$timestamp}_{$filename}.php")
            ->first();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            LaravelTerms::class,
            Term::class,
        ];
    }
}
