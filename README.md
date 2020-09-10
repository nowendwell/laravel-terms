# Laravel Terms

[![Latest Version on Packagist](https://img.shields.io/packagist/v/nowendwell/laravel-terms.svg?style=flat-square)](https://packagist.org/packages/nowendwell/laravel-terms)
[![Build Status](https://img.shields.io/travis/nowendwell/laravel-terms/master.svg?style=flat-square)](https://travis-ci.org/nowendwell/laravel-terms)
[![Quality Score](https://img.shields.io/scrutinizer/g/nowendwell/laravel-terms.svg?style=flat-square)](https://scrutinizer-ci.com/g/nowendwell/laravel-terms)
[![Total Downloads](https://img.shields.io/packagist/dt/nowendwell/laravel-terms.svg?style=flat-square)](https://packagist.org/packages/nowendwell/laravel-terms)

Keep users up to date with your terms and conditions changes. This package provides middleware to intercept requests and redirect to the latest terms.

## Installation

You can install the package via composer:

```bash
composer require nowendwell/laravel-terms
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
