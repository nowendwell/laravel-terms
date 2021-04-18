<?php

use Nowendwell\LaravelTerms\Models\Term;

return [

    /*
    |--------------------------------------------------------------------------
    | Terms: Model
    |--------------------------------------------------------------------------
    |
    | The default is `Nowendwell\LaravelTerms\Models\Term`.
    |
    | You are likely to extend the class or replace it with your implementation:
    | Model must implement `Nowendwell\LaravelTerms\Contracts\Term`
    |
    */

    'model' => Term::class,

    /*
    |--------------------------------------------------------------------------
    | Terms: Middleware check
    |--------------------------------------------------------------------------
    |
    | Paths to exclude from the global 'AcceptedTerms' middleware check
    |
    */
    'excluded_paths' => [
        'logout',
    ],
];
