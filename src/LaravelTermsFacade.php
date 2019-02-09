<?php

namespace Nowendwell\LaravelTerms;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Nowendwell\LaravelTerms\Skeleton\SkeletonClass
 */
class LaravelTermsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-terms';
    }
}
