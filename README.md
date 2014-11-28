CodiceFiscale
==============

A library to calculate and check the validity of the italian fiscal code (codice fiscale).

[![Build Status](https://travis-ci.org/andreausu/CodiceFiscale.png?branch=master)](https://travis-ci.org/andreausu/CodiceFiscale) [![Latest Stable Version](https://poser.pugx.org/usu/codice-fiscale/v/stable.svg)](https://packagist.org/packages/usu/codice-fiscale) [![Total Downloads](https://poser.pugx.org/usu/codice-fiscale/downloads.svg)](https://packagist.org/packages/usu/codice-fiscale) [![License](https://poser.pugx.org/usu/codice-fiscale/license.svg)](https://packagist.org/packages/usu/codice-fiscale)

Requirements
------------

- php >= 5.4

Installation
------------

Create a composer.json file with the following content:

``` json
{
    "require": {
        "usu/codice-fiscale": "1.0.*"
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
$calc->calcola('Nome', 'Cognome', 'M', new \DateTime('1992-03-06'), 'F205');

$chk = new Checker();
if ($chk->isFormallyCorrect('RSSMRA79S18F205J')) {
    print('Codice Fiscale formally correct');
    printf('Birth Day: %s',     $chk->getDayBirth());
    printf('Birth Month: %s',   $chk->getMonthBirth());
    printf('Birth Year: %s',    $chk->getYearBirth());
    printf('Birth Country: %s', $chk->getCountryBirth());
    printf('Sex: %s',           $chk->getSex());
} else {
    print('Codice Fiscale wrong');
}
```

Testing
-------

The library is fully tested with PHPUnit.

Go to the root folder, install the dev dependencies with composer, and then run the phpunit test suite

``` bash
$ composer --dev install
$ ./vendor/bin/phpunit
```
