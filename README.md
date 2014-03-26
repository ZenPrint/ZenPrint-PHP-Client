ZenPrint-PHP-Client
===================

ZenPrint PHP Client

A php interface to interact with the ZenPrint API
Based on the ZenPrint REST API: https://developers.zenprint.com

How to install the ZenPrint library
===================================

Composer
--------
The ZenPrint Library uses Composer for installation (https://getcomposer.org/doc/01-basic-usage.md)

```
$ curl -sS https://getcomposer.org/installer | php
$ php composer.phar install
```

Example Usage
-------------

Iterate through customers
```
$zenPrint = new ZenPrint(<oauth_token>, <oauth_token_secret>, <args>);

$customers = $zenPrint->getCustomers();

foreach ($customers as $customer) {
  $customer->getFirstName();
}
```

Create a new customer
```
$customer = new Customer();
$customer->email = "customer@company.com";
$customer->firstName = "First Name";
$customer->lastName = "Last Name";

$zenPrint->createCustomer($customer);
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
$ phpunit 
```

Test Groups
-----------
```
$ phpunit --group <groupName> 
```

Single Test 
-----------
```
$ phpunit tests/unit/<file_name.php>
```

Developer Information
---------------------

The ZenPrint PHP Client uses PHP’s autoloading feature to include classes as they’re needed. (See src/AutoLoader.php)
Note: This requires a certain file-name convention of files. The filename should be the same as the class name (with the .php extension)
