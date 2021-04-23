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
            ->hasRoute('web')
            ->hasTranslations()
            ->hasViews();

        $this->publishMiddleware();
        $this->updateConfig();
    }

    /**
     * Run after package is booted
     *
     * @return void
     */
    public function packageBooted()
    {
        tap($this->app->make(Router::class), function ($router) {
            return $router->pushMiddlewareToGroup('web', \App\Http\Middleware\AcceptedTerms::class);
        });
    }

    /**
     * Run after package is registered
     *
     * @return void
     */
    public function packageRegistered()
    {
        $this->app->singleton('laravel-terms', function () {
            return new LaravelTerms();
        });
    }

    public function publishMiddleware()
    {
        $this->publishes([
            $this->package->basePath('/../src/Http/Middleware/AcceptedTerms.php.stub') =>
            app_path("Http/Middleware/AcceptedTerms.php"),
        ], "{$this->package->shortName()}-middleware");
    }

    public function updateConfig()
    {
        // Add terms paths to the excluded_paths key
        $existing_paths = config('terms.excluded_paths', []);

        $new_paths = [];
        foreach (config('terms.paths', []) as $path) {
            $new_paths[] = 'terms/' . ltrim($path, '/');
        }

        $paths = array_merge($existing_paths, $new_paths);

        config(['terms.excluded_paths' => $paths]);
    }
}
