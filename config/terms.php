<?php

return [

    /**
     * Paths to exclude from the global middleware check
     */
    'excluded_paths' => [
        'logout',
    ],

    /**
     * Paths for showing and accepting the terms. Prefixed by /terms
     */
    'paths' => [
        // The path to show the latest terms (default: latest)
        'latest_path' => '/latest',

        // The path to post the agreement to (default: agree)
        'agree_path' => '/agree',
    ],

    /**
     * The path to redirect to after accepting the terms
     */
    'redirect' => '/',
];
