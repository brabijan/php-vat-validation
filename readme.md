# VAT validation

## Instalation

The best way to install brabijan/vat-validation is using  [Composer](http://getcomposer.org/):


```sh
$ composer require brabijan/vat-validation:@dev
```

## Usage

```php
<?php

use Brabijan\VatValidation\ValidateVat;

$validator = new ValidateVat($vat_id);
// or
$validator = new ValidateVat($countryCode, $vatNumber);

if($validator->isValid()) {
	// ...
}

```
