<?php

namespace Nowendwell\LaravelTerms\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Nowendwell\LaravelTerms\Models\Term;

class AgreedToTerms
{
    use Dispatchable;
    use SerializesModels;

    public $user;
    public $term;

    public function __construct($user, Term $term)
    {
        $this->user = $user;
        $this->term = $term;
    }
}
