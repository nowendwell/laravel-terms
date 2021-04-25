<?php

namespace Nowendwell\LaravelTerms\Tests;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Foundation\Exceptions\Handler;
use Nowendwell\LaravelTerms\LaravelTermsServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Throwable;

abstract class TestCase extends OrchestraTestCase
{
    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase();
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [
            LaravelTermsServiceProvider::class,
        ];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    /**
     * @return void
     */
    protected function setUpDatabase(): void
    {
        include_once __DIR__.'/../database/migrations/create_terms_table.php.stub';
        include_once __DIR__.'/../database/migrations/create_user_terms_table.php.stub';

        (new \CreateTermsTable())->up();
        (new \CreateUserTermsTable())->up();
    }

    /**
     * Disable Exception Handling.
     *
     * @return void
     */
    protected function disableExceptionHandling(): void
    {
        $this->app->instance(
            ExceptionHandler::class, new class extends Handler {
                public function __construct()
                {
                }

                public function report(Throwable $e)
                {
                }

                public function render($request, Throwable $exception)
                {
                    throw $exception;
                }
            }
        );
    }
}
