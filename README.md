# Laravel 5.6 MailJet Transport

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mahi-mahi/mail-transport.svg?style=flat-square)](https://packagist.org/packages/mahi-mahi/mail-transport)
[![Total Downloads](https://img.shields.io/packagist/dt/mahi-mahi/mail-transport.svg?style=flat-square)](https://packagist.org/packages/mahi-mahi/mail-transport)

The `mahi-mahi/mail-transport` package provides easy to way to use [MailJet](https://www.mailjet.com/) service for all outgoing emails.

## Installation

You can install the package via composer:

``` bash
composer require mahi-mahi/mail-transport
```

The package will automatically register itself.

You can publish the migration with:
```bash
php artisan vendor:publish --provider="MahiMahi\MailjetTransport\MailjetTransportServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
return [
    'public_key' => env('MAILJET_APIKEY_PUBLIC'),
    'private_key' => env('MAILJET_APIKEY_PRIVATE'),
];
```
