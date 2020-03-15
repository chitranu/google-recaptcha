# Google reCAPTCHA validater for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/chitranu/google-recaptcha.svg?style=flat-square)](https://packagist.org/packages/chitranu/google-recaptcha)
[![Build Status](https://img.shields.io/travis/chitranu/google-recaptcha/master.svg?style=flat-square)](https://travis-ci.org/chitranu/google-recaptcha)
[![Quality Score](https://img.shields.io/scrutinizer/g/chitranu/google-recaptcha.svg?style=flat-square)](https://scrutinizer-ci.com/g/chitranu/google-recaptcha)
[![Total Downloads](https://img.shields.io/packagist/dt/chitranu/google-recaptcha.svg?style=flat-square)](https://packagist.org/packages/chitranu/google-recaptcha)

This package is a wrapper around [Google's reCAPTCHA PHP client library](https://github.com/google/recaptcha). It provides a handy validation rule `recaptcha`, which can be used to validate the reCAPTCHA token in the form requests.

## Installation

You can install the package via composer:

```bash
composer require chitranu/google-recaptcha
```

## Usage
Get Google reCAPTCHA secret key for your application from [https://www.google.com/recaptcha/admin/](https://www.google.com/recaptcha/admin/) and place it inside `.env` file at the root like this.

```env
GOOGLE_RECAPTCHA_SECRETKEY=YOUR_RECAPTCHA_SECRET_KEY
```

After setting secret key, head over to your request validator, and add a field with rule the `recaptcha` like below to validate the token received in the form request.

``` php
$request->validate([
    '...' // other fields
    'recaptcha-token' => 'required|recaptcha'
]);
```


### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email `swapnil@chitranu.com` instead of using the issue tracker.

## Credits

- [Swapnil Bhavsar](https://github.com/iamswap)
- [Rajesh Dewle](https://github.com/rajeshdewle)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.