# HtmlModel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/league/:package_name.svg?style=flat-square)](https://packagist.org/packages/league/:package_name)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/thephpleague/:package_name/master.svg?style=flat-square)](https://travis-ci.org/thephpleague/:package_name)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/thephpleague/:package_name.svg?style=flat-square)](https://scrutinizer-ci.com/g/thephpleague/:package_name/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/thephpleague/:package_name.svg?style=flat-square)](https://scrutinizer-ci.com/g/thephpleague/:package_name)
[![Total Downloads](https://img.shields.io/packagist/dt/league/:package_name.svg?style=flat-square)](https://packagist.org/packages/league/:package_name)

HtmlModel is exactly what it sounds like.  It is a series of value objects intended
to model an HTML page.  It does not attempt to model every element in HTML (that 
would be silly), but just the key aspects of it.  In a sense, it seeks to provide
an HTML equivalent of RESTful domain models such as HAL or Atom.

Inspired by PSR-7, all objects are immutable.  They may be maniplated with with*()
methods, which return new value object instances.  The Link handling is inspired
by discussions with Evert Pot and Matthew O'Phinney, and in particular this
research by Evert Pot: http://evertpot.com/whats-in-a-link/.

Hopefully at some point in the future LinkInterface will become a FIG recommendation,
at which point the interfaces here will be removed in favor of the FIG standard.

This approach was inspired by, and evolved from, similar code that exited in
Drupal 8 during development but was later removed.

This package is still very much an early Work-In-Progress.

## Install

Via Composer

``` bash
$ composer require crell/htmlmodel
```

## Usage

``` php

```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email the author instead of using the issue tracker.

## Credits

- [Larry Garfield](https://github.com/Crell)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
