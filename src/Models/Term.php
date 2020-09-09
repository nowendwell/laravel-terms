<?php

namespace Nowendwell\LaravelTerms\Models;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "terms";

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $fillable = [
        'terms'
    ];
}
