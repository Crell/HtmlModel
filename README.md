# HtmlModel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/crell/htmlmodel.svg?style=flat-square)](https://packagist.org/packages/crell/htmlmodel)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://travis-ci.org/Crell/HtmlModel.svg)](https://travis-ci.org/Crell/HtmlModel)
[![Code Climate](https://codeclimate.com/github/Crell/HtmlModel/badges/gpa.svg)](https://codeclimate.com/github/Crell/HtmlModel)
[![Total Downloads](https://img.shields.io/packagist/dt/crell/htmlmodel.svg?style=flat-square)](https://packagist.org/packages/crell/htmlmodel)

HtmlModel is exactly what it sounds like.  It is a series of value objects intended
to model an HTML page.  It does not attempt to model every element in HTML (that 
would be silly), but just the key aspects of it.  In a sense, it seeks to provide
an HTML equivalent of RESTful domain models such as HAL or Atom.

Inspired by PSR-7, all objects are immutable.  They may be maniplated with with*()
methods, which return new value object instances.  Link handling is based on the PSR-13
hyperlink specification.

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
