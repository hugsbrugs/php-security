# php-security

This library allows

[![Build Status](https://travis-ci.org/hugsbrugs/php-security.svg?branch=master)](https://travis-ci.org/hugsbrugs/php-security)
[![Coverage Status](https://coveralls.io/repos/github/hugsbrugs/php-security/badge.svg?branch=master)](https://coveralls.io/github/hugsbrugs/php-security?branch=master)

## Install

Install package with composer
```
composer require hugsbrugs/php-security
```

In your PHP code, load library
```php
require_once __DIR__ . '/../vendor/autoload.php';
use Hug\Security\Security as Security;
```

Get Paylod for JWT authentication
```php
Security::get_payload($url, $uid, $role, $demo = false);
```

Clean HTML input from scripts, style, meta, tags
```php
Security::clean_input($input);
```

Clean input received by HTML forms to prevent injection
```php
Security::sanitize($input);
```

Generates random password
```php
Security::password($length = 15, $simple = false);
```

## Unit Tests

```
composer exec phpunit
```

## Author

Hugo Maugey [visit my website ;)](https://hugo.maugey.fr)
