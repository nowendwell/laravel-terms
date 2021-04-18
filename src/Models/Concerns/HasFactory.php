<?php

namespace Nowendwell\LaravelTerms\Models\Concerns;

use Illuminate\Database\Eloquent\Factories\HasFactory as BaseHasFactory;

trait HasFactory
{
    use BaseHasFactory;

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return new LaravelTermsFactory;
    }
}
