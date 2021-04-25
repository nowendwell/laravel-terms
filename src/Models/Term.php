<?php

namespace Nowendwell\LaravelTerms\Models;

use Illuminate\Database\Eloquent\Model;
use Nowendwell\LaravelTerms\Contracts\Term as TermContract;

class Term extends Model implements TermContract
{
    use Concerns\HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'terms',
    ];
}
