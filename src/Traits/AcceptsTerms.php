<?php

namespace Nowendwell\LaravelTerms\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Nowendwell\LaravelTerms\LaravelTerms;
use Nowendwell\LaravelTerms\Models\Term;

trait AcceptsTerms
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function terms(): BelongsToMany
    {
        return $this->belongsToMany(LaravelTerms::model(), 'user_terms')->withTimestamps();
    }

    /**
     * @return Boolean
     */
    public function hasAcceptedTerms(): bool
    {
        return $this->terms->contains(LaravelTerms::current());
    }
}
