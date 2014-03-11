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

$calc = new Calculator();
$calc->('Nome', 'Cognome', 'M', new \DateTime('1992-03-06') 'F205O');
```

Testing
-------

The library is fully tested with PHPUnit.

Go to the base library folder and install the dev dependencies with composer, and then run the phpunit test suite

``` bash
$ composer --dev install
$ ./vendor/bin/phpunit
```
