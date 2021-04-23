<?php

namespace Nowendwell\LaravelTerms;

use Illuminate\Routing\Router;
use Nowendwell\LaravelTerms\Http\Middleware\AcceptedTerms;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelTermsServiceProvider extends PackageServiceProvider
{
    /**
     * Configure Package.
     *
     * @param  \Spatie\LaravelPackageTools\Package $package
     * @return void
     */
    public function configurePackage(Package $package): void
    {
        $package
            ->name('terms')
            ->hasConfigFile()
            ->hasMigrations([
                'create_terms_table',
                'create_user_terms_table',
            ])
            ->hasRoute('web.php')
            ->hasTranslations()
            ->hasViews();
    }

    /**
     * Run after package is booted
     *
     * @return void
     */
    public function packageBooted()
    {
        tap($this->app->make(Router::class), fn($router)=>$router->pushMiddlewareToGroup('web', AcceptedTerms::class));
    }

    /**
     * Run after package is registered
     *
     * @return void
     */
    public function packageRegistered()
    {
        $this->app->singleton('laravel-terms', function () {
            return new LaravelTerms;
        });
    }
}
