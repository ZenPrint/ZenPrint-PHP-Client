ZenPrint-PHP-Client
=======

ZenPrint PHP Client

A php interface to interact with the ZenPrint API
Based on the ZenPrint REST API: https://developer.zenprint.com

How to install the ZenPrint library
===================================

Composer
-------
The ZenPrint Library uses Composer for installation (https://getcomposer.org/doc/01-basic-usage.md)

```
$ curl -sS https://getcomposer.org/installer | php
$ php composer.phar install
```

Example Usage
-------------

```
$zenprint = new ZenPrint(<oauth_token>, <oauth_token_secret>, <args>);
```


How to Run the Unit Tests
-------------------------

```
Please install phpunit
```

The unit tests are in the `/tests` directory.

All Tests
---------

```
$ phpunit --bootstrap tests/bootstrap.php --configuration tests/phpunit.xml --testsuite zenprint
```

Test Groups
-----------
```
$ phpunit --bootstrap tests/bootstrap.php --configuration tests/phpunit.xml --group <groupName> 
```

Single Test 
-----------
```
$ phpunit --bootstrap tests/bootstrap.php --configuration tests/phpunit.xml tests/unit/<file_name.php>
```

Developer Information
---------------------

The ZenPrint SDK uses PHP’s autoloading feature to include classes as they’re needed. (See src/AutoLoader.php)
Note: This requires a certain file-name convention of files. The filename should be the same as the class name (with the .php extension)
