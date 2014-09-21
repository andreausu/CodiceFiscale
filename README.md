CodiceFiscale
==============

A library to calculate the italian fiscal code (codice fiscale).

[![Build Status](https://travis-ci.org/andreausu/CodiceFiscale.png?branch=master)](https://travis-ci.org/andreausu/CodiceFiscale)

Requirements
------------

- php >= 5.4

Installation
------------

Create a composer.json file with the following content:

``` json
{
    "require": {
        "usu/codice-fiscale": "0.2.*"
    }
}
```

Then run

``` bash
$ curl -s https://getcomposer.org/installer | php
$ php composer.phar install
```

You should now have CodiceFiscale installed inside your vendor folder: *vendor/usu/codice-fiscale*

And an handy autoload file to include in you project: *vendor/autoload.php*

How to use
----------

``` php
<?php
require_once __DIR__ . '/vendor/autoload.php';

use CodiceFiscale\Calculator;
use CodiceFiscale\Checker;

$calc = new Calculator();
$calc->('Nome', 'Cognome', 'M', new \DateTime('1992-03-06') 'F205');

$chk = new Checker();
if( $chk->isFormallyCorrect('RSSMRA79S18F205J') ){
    print('Codice Fiscale formally correct');
    printf('<p>Birth Day: %s</p>',     $chk->GetDayBirth());
    printf('<p>Birth Month: %s</p>',   $chk->GetMonthBirth());
    printf('<p>Birth Year: %s</p>',    $chk->GetYearBirth());
    printf('<p>Birth Country: %s</p>', $chk->GetCountryBirth());
    printf('<p>Sex: %s</p>',           $chk->GetSex());
} else {
    print('Codice Fiscale wrong');
}
```

Testing
-------

The library is fully tested with PHPUnit.

Go to the base library folder and install the dev dependencies with composer, and then run the phpunit test suite

``` bash
$ composer --dev install
$ ./vendor/bin/phpunit
```
