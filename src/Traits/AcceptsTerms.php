<?php

namespace Nowendwell\LaravelTerms\Traits;

use Nowendwell\LaravelTerms\Models\Term;

trait AcceptsTerms
{
    public function terms()
    {
        return $this->belongsToMany(Term::class, 'user_terms')->withTimestamps();
    }

    public function hasAcceptedTerms()
    {
        return $this->terms->contains(Term::latest()->first()->id);
    }
}
