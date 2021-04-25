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

    /*
    |--------------------------------------------------------------------------
    | Terms: Controller paths to use
    |--------------------------------------------------------------------------
    |
    | Paths for showing and accepting the terms. Prefixed by /terms
    |
    */
    'paths' => [
        // The path to show the latest terms (default: latest)
        'latest_path' => '/latest',

        // The path to post the agreement to (default: agree)
        'agree_path' => '/agree',
    ],
];
