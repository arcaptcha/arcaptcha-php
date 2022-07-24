# PHP ArCaptcha Library

[![Latest Stable Version](http://poser.pugx.org/arcaptcha/arcaptcha-php/v)](https://packagist.org/packages/arcaptcha/arcaptcha-php)
[![Total Downloads](http://poser.pugx.org/arcaptcha/arcaptcha-php/downloads)](https://packagist.org/packages/arcaptcha/arcaptcha-php)
[![Latest Unstable Version](http://poser.pugx.org/arcaptcha/arcaptcha-php/v/unstable)](https://packagist.org/packages/arcaptcha/arcaptcha-php) [![License](http://poser.pugx.org/arcaptcha/arcaptcha-php/license)](https://packagist.org/packages/arcaptcha/arcaptcha-php)
[![PHP Version Require](http://poser.pugx.org/arcaptcha/arcaptcha-php/require/php)](https://packagist.org/packages/arcaptcha/arcaptcha-php)

PHP library for ArCaptcha.
This package supports `PHP 7.3+`.

# List of contents

- [PHP ArCaptcha Library](#PHP-ArCaptcha-Library)
- [List of contents](#list-of-contents)
  - [Installation](#Installation)
  - [Configuration](#Configuration)
  - [How to use](#how-to-use)
    - [Widget usage](#Widget-usage)
    - [Verifying a response](#Verifying-a-response)
  - [Credits](#credits)
  - [License](#license)

## Installation

Require this package with composer:

```bash
composer require mohammadv184/arcaptcha
```

## Configuration

You can create a new instance by passing the SiteKey and SecretKey from your API.
You can get that at https://arcaptcha.ir/dashboard

```php
use Mohammadv184\ArCaptcha\ArCaptcha;

$ArCaptcha = new ArCaptcha($siteKey, $secretKey);

// To set options like color,lang,...
$ArCaptcha = new ArCaptcha($siteKey, $secretKey,['lang'=>'en','theme'=>'dark']);

```

_To see available options on widget see [here](https://docs.arcaptcha.ir/docs/configuration#arcaptcha-container-configuration)_

## How to use

How to use ArCaptcha.

### Widget usage

To show the ArCaptcha on a form, use the class to render the script tag and the widget.

```php
<?php echo $ArCaptcha->getScript() ?>
<form method="POST">
    <?php echo $ArCaptcha->getWidget() ?>
    <input type="submit" value="Submit" />
</form>
```

_Note: You can pass available widget options like color,lang,... into getWidget function_

### Verifying a response

After the post, use the class to verify the response.
You get true or false back:

```php
if ($ArCaptcha->verify($_POST["arcaptcha-response"])) {
    echo "OK!";
} else {
    echo "FAILED!";
}
```

### Invisible mode

To see how invisible mode is working in this library see this [example](https://github.com/arcaptcha/arcaptcha-php-example/blob/main/without-composer/index-invisible.php)

## Credits

- [Mohammad Abbasi](https://github.com/mohammadv184)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
