# HtmlModel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/crell/htmlmodel.svg?style=flat-square)](https://packagist.org/packages/crell/htmlmodel)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://travis-ci.org/Crell/HtmlModel.svg?branch=master)](https://travis-ci.org/Crell/HtmlModel.svg?branch=master)
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

## Install

Via Composer

``` bash
$ composer require crell/htmlmodel
```

## Usage

If you've used a PSR-7 Request or Response object, HtmlModel should be quite similar. Most of the time you'll be interacting with either an HtmlFragment or an HtmlPage.

``` php
// Create an HtmlFragment object.
$fragment = new HtmlFragment();

// Set the fragment body, which is simply an arbitrary HTML string.
$fragment = $fragment->withContent('<aside>Immutable objects are easier than you think.</aside>');

// Populate its metadata; the metadata won't be rendered with this
// fragment but can be transferred to an aggregating page, or a JSON
// instruction in response to an Ajax call.
$fragment = $fragment
  ->withHeadElement(new MetaRefreshElement(3, 'http://www.google/com'))
  ->withHeadElement(new LinkElement('canonical', 'http://www.example.com/'))
  ->withStyleLink(new StyleLinkElement('css.css'))
;
```

```php
// Create an HtmlPage object.
$html = new HtmlPage();

// Populate it with various elements and body contents.
$html = $html
  ->withTitle('Test page')
  ->withHtmlAttribute('manifest', 'example.appcache')
  ->withBodyAttribute('foo', 'bar')
  ->withBase(new BaseElement('http://www.example.com/'))
  ->withHeadElement(new MetaRefreshElement(3, 'http://www.google.com'))
  ->withHeadElement(new LinkElement('canonical', 'http://www.example.com/'))
  ->withScript(new ScriptElement('header.js'))
  ->withScript(new ScriptElement('footer.js'), 'footer')
  ->withStyleLink(new StyleLinkElement('css.css'))
  ->withInlineStyle(new StyleElement('CSS here'))
  ->withContent('Body here')
;

// Simply casting the page object to a string will produce the corresponding markup.
$output = (string)$html;
```

The HtmlPage can even contain an HTTP status code.  Although it won't get rendered it can be transferred to a Response object, allowing the page creator to specify the type of response through a straightforward domain object.

The cool part, though, is when you can aggregate multiple fragments into a page cleanly.  That lets you build multiple portions of a page in parallel, even asynchronously, even caching some portions of the page but not others, and then fold them together into a single page.

```php

// Create an HtmlFragment (or return one from some lower-level routine)
$src = new HtmlFragment();
$src = $src
  ->withHeadElement(new MetaRefreshElement(3, 'http://www.google.com'))
  ->withHeadElement(new LinkElement('canonical', 'http://www.example.com/'))
  ->withScript(new ScriptElement('js.js'))
  ->withScript(new ScriptElement('footer.js'), 'footer')
  ->withScript($inline_script)
  ->withStyleLink(new StyleLinkElement('css.css'))
  ->withInlineStyle(new StyleElement('CSS here'))
  ->withContent('Body here')
;

// Now make an HtmlPage.
$dest = new HtmlPage();

// Now shuffle the metadata from the fragment to the page.

$transferer = new AggregateMetadataTransferer([
  StyleContainerInterface::class => new StyleTransferer(),
  ScriptContainerInterface::class => new ScriptTransferer(),
  StatusCodeContainerInterface::class => new StatusCodeTransferer(),
  HeadElementContainerInterface::class => new HeadElementTransferer(),
]);

$html = $transferer->transfer($src, $dest);

// Now take other fragments and transfer their metadata to the page, aggregating them together!
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
