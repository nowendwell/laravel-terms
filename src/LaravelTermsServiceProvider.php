<?php

namespace Nowendwell\LaravelTerms;

use Illuminate\Routing\Router;
use Nowendwell\LaravelTerms\Contracts\Term;
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
            ->hasConfigFile('terms')
            ->hasMigrations([
                'create_terms_table',
                'create_user_terms_table',
            ])
            ->hasRoute('web')
            ->hasTranslations()
            ->hasViews();
    }

    /**
     * Run after package is booted.
     *
     * @return void
     */
    public function packageBooted()
    {
        tap($this->app->make(Router::class), function ($router) {
            return $router->pushMiddlewareToGroup('web', \App\Http\Middleware\AcceptedTerms::class);
        });
        // Bind the contract to model implementation
        $this->app->bind(Term::class, fn ($app) => $app->make(LaravelTerms::model()));
        // Add publishable middleware
        $this->publishMiddleware();
        // Make sure the latest and agree routes are not behind middleware
        $this->updateConfig();
    }

    /**
     * Register singleton.
     *
     * @return void
     */
    public function packageRegistered()
    {
        // use both classname and string interchangeably
        $this->app->alias(LaravelTerms::class, 'laravel-terms');
        // register singleton
        $this->app->singleton(LaravelTerms::class, function ($app) {
            // resolve config
            $config = $app['config']->get('terms');
            // create LaravelTerms
            return new LaravelTerms($config);
        });
    }

    /**
     * @return void
     */
    public function publishMiddleware()
    {
        $this->publishes([
            $this->package->basePath('/../src/Http/Middleware/AcceptedTerms.php.stub') => app_path('Http/Middleware/AcceptedTerms.php'),
        ], "{$this->package->shortName()}-middleware");
    }

    /**
     * @return void
     */
    public function updateConfig()
    {
        // Add terms paths to the excluded_paths key
        $existing_paths = config('terms.excluded_paths', []);

        $new_paths = [];

        foreach (config('terms.paths', []) as $path) {
            $new_paths[] = 'terms/'.ltrim($path, '/');
        }

        $paths = array_merge($existing_paths, $new_paths);

        config(['terms.excluded_paths' => $paths]);
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
