<?php

namespace Nowendwell\LaravelTerms\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Nowendwell\LaravelTerms\LaravelTerms;

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
     * @return bool
     */
    public function hasAcceptedTerms(): bool
    {
        return $this->terms->contains(LaravelTerms::current());
    }
}
