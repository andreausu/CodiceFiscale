CodiceFiscale
==============

A library to calculate and check the validity of the italian fiscal code (codice fiscale).

[![Build Status](https://travis-ci.org/andreausu/CodiceFiscale.png?branch=master)](https://travis-ci.org/andreausu/CodiceFiscale) [![Latest Stable Version](https://poser.pugx.org/usu/codice-fiscale/v/stable.svg)](https://packagist.org/packages/usu/codice-fiscale) [![Total Downloads](https://poser.pugx.org/usu/codice-fiscale/downloads.svg)](https://packagist.org/packages/usu/codice-fiscale) [![License](https://poser.pugx.org/usu/codice-fiscale/license.svg)](https://packagist.org/packages/usu/codice-fiscale)

Requirements
------------

- php >= 5.3

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
use CodiceFiscale\CodiciCatastali;

$calc = new Calculator();
$chk  = new Checker();
$cc   = new CodiciCatastali(__DIR__.'/data/CCList.txt');

$nome = 'Nome';
$cognome = 'Cognome';
$dataNascita = new \DateTime('1992-03-06');
$cCode = $cc->GetCodiceCatastale('Milano');
$sesso = 'M';

$CF = $calc->calcola($nome, $cognome, $sesso, $dataNascita, $cCode);

printf('<p>Codice Fiscale: %s</p>', $CF);

if ($chk->isFormallyCorrect($CF)) 
{
    printf('<p>Codice Fiscale %s formally correct</p>', $CF);
    printf('<p>Birth Day: %s</p>',     $chk->getDayBirth());
    printf('<p>Birth Month: %s</p>',   $chk->getMonthBirth());
    printf('<p>Birth Year: %s</p>',    $chk->getYearBirth());
    printf('<p>Birth Country: %s</p>', $cc->GetComune($chk->getCountryBirth()));
    printf('<p>Sex: %s</p>',           $chk->getSex());
} else {
    printf('<p>Codice Fiscale %s wrong</p>', $CF);
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
