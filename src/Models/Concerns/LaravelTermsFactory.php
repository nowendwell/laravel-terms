<?php

namespace Nowendwell\LaravelTerms\Models\Concerns;

use Illuminate\Database\Eloquent\Factories\Factory;
use Nowendwell\LaravelTerms\Models\Term;

class LaravelTermsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Term::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'terms' => $this->faker->sentence(),
        ];
    }
}
