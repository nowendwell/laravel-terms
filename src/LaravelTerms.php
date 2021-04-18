<?php

namespace Nowendwell\LaravelTerms;

use Nowendwell\LaravelTerms\Contracts\Term;

class LaravelTerms
{
    /**
     * Name of the model.
     *
     * @var  string
     */
    protected string $model;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->model = $config['model'];
    }

    /**
     * @return string
     */
    protected function model(): string
    {
        return $this->model;
    }

    /**
     * @return Nowendwell\LaravelTerms\Contracts\Term|null
     */
    protected function current(): ?Term
    {
        // create an instance
        $model = app($this->model());
        // return an ordered
        return $model->latest($model->getKeyName())->first();
    }

    /**
     * Handle dynamic static method calls into the method.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->$method(...$parameters);
    }

    /**
     * Handle dynamic static method calls into the method.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        return app(self::class)->$method(...$parameters);
    }
}
