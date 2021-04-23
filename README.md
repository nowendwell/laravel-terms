# Laravel Terms

[![Latest Version on Packagist](https://img.shields.io/packagist/v/nowendwell/laravel-terms.svg?style=flat-square)](https://packagist.org/packages/nowendwell/laravel-terms)
[![Total Downloads](https://img.shields.io/packagist/dt/nowendwell/laravel-terms.svg?style=flat-square)](https://packagist.org/packages/nowendwell/laravel-terms)
[![Build Status](https://github.com/nowendwell/laravel-terms/actions/workflows/CI.yml/badge.svg)](https://github.com/nowendwell/laravel-terms/actions/workflows/CI.yml/badge.svg)
[![Quality Score](https://img.shields.io/scrutinizer/g/nowendwell/laravel-terms.svg?style=flat-square)](https://scrutinizer-ci.com/g/nowendwell/laravel-terms)
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/nowendwell/laravel-terms)
![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/nowendwell/laravel-terms)

Keep users up to date with your terms and conditions changes. This package provides middleware to intercept requests and redirect to the latest terms.

## Installation

You can install the package via composer:

```bash
composer require nowendwell/laravel-terms
php artisan vendor:publish --provider="Nowendwell\LaravelTerms\LaravelTermsServiceProvider"
php artisan migrate
```

## Usage

Add the AcceptsTerms trait to your user model and you're good to go!
``` php
<?php

use Nowendwell\LaravelTerms\Traits\AcceptsTerms;

class User
{
    use AcceptsTerms;
}
```

## Middleware

This package comes with middleware pre-configured for the happy path. It is up to you how your app should determine *who* needs to go through the middleware check. Below is an example of a User who requires Terms.

```php
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AcceptedTerms
{
    public function handle(Request $request, Closure $next)
    {
        if (
            auth()->check() &&
            ! auth()->user()->hasAcceptedTerms() &&
            ! in_array($request->path(), config('terms.excluded_paths'))
        ) {
            session(['url.intended' => $request->url()]);
            return redirect()->route('terms.show');
        }

        return $next($request);
    }
}
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email nowendwell@gmail.com instead of using the issue tracker.

## Credits

- [Ben Miller](https://github.com/nowendwell)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
