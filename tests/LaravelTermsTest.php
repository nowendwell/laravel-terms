<?php

namespace Nowendwell\LaravelTerms\Tests;

use Nowendwell\LaravelTerms\Contracts\Term;
use Nowendwell\LaravelTerms\LaravelTerms;

class LaravelTermsTest extends TestCase
{
    /** @test */
    public function it_returns_model_name()
    {
        $value = config('terms.model');

        $this->assertEquals($value, LaravelTerms::model());
        $this->assertEquals($value, app(LaravelTerms::class)->model());
    }

    /** @test */
    public function it_resolves_model()
    {
        $model = LaravelTerms::model();

        $this->assertInstanceOf(Term::class, new $model);
    }

    /** @test */
    public function it_resolves_model_from_contract_for_dependency_injections()
    {
        $value = $this->app->make(Term::class);
        // assert contract
        $this->assertInstanceOf(Term::class, $value);
        // assert implementation
        $this->assertInstanceOf(LaravelTerms::model(), $value);
    }

    /**
     * @todo  if the migration is no automatic, adjust the test
     * @test
     */
    public function it_returns_current_terms()
    {
        $model = $this->model();

        $this->assertCount(1, $model->get());
        $this->assertTrue($model->latest()->first()->is(LaravelTerms::current()));

        $model::factory()->count(2)->create([]);

        $this->assertCount(3, $model->get());
        $this->assertEquals(3, LaravelTerms::current()->getKey());
        $this->assertTrue($model->latest($model->getKeyName())->first()->is(LaravelTerms::current()));
    }

    /**
     * @return \Nowendwell\LaravelTerms\Contracts\Term
     */
    protected function model(): Term
    {
        $model = LaravelTerms::model();

        return new $model;
    }
}
