<?php

use RESTful\RESTful;

class CustomerPrimitiveTest extends \PHPUnit_Framework_TestCase 
{

    const OAUTH_HASH = '22';
    const EMAIL = 'dave@zenprint.com';
    const FIRST_NAME = 'Dave';
    const LAST_NAME = 'Boyce';
    const CUSTOMER_ID = 22;
    const PASSWORD = 'ab345ef';
    const CUSTOMER_JSON = '{"email":"dave@zenprint.com","firstname":"Dave","lastname":"Boyce","password":"ab345ef"}';
    const CUSTOMER_BALANCE_CREDIT_TOTAL = 101.56;

    protected $_customerArray = array ( 
        'email' => self::EMAIL,
        'firstname' => self::FIRST_NAME,
        'lastname' => self::LAST_NAME,
        'password' => self::PASSWORD
    );


    public function setUp() 
    {
        $this->customer = new \Customer(self::OAUTH_HASH, self::CUSTOMER_ID, $this->_customerArray);
    }

    /**
    * @dataProvider integerErrorProvider
    * @expectedException        Assert\InvalidArgumentException
    */
    public function testCustomerErrors($customerId) 
    {
        new \Customer(self::OAUTH_HASH, $customerId);
    }

    public function testGetCustomerId() 
    {
        $this->assertEquals($this->customer->getId(), self::CUSTOMER_ID);
    }

    public function testSetCustomerId() 
    {
        $customerId = 23;
        $this->customer->setId($customerId);
        $this->assertEquals($this->customer->getId(), $customerId);
    }

    public function testGetCustomerEmail() 
    {
        $this->assertEquals($this->customer->getEmail(), self::EMAIL);
    }

    public function testSetCustomerEmail() 
    {
        $customerEmail = 'brian@howdy.com';
        $this->customer->setEmail($customerEmail);
        $this->assertEquals($this->customer->getEmail(), $customerEmail);
    }

    /**
    * @expectedException        Assert\InvalidArgumentException
    */
    public function testSetCustomerEmailError() 
    {
        $customerEmail = 'brian@howdy';
        $this->customer->setEmail($customerEmail);
    }

    public function testGetCustomerFirstName() 
    {
        $this->assertEquals($this->customer->getFirstName(), self::FIRST_NAME);
    }

    public function testSetCustomerFirstName() 
    {
        $customerName = 'Jimbo';
        $this->customer->setFirstName($customerName);
        $this->assertEquals($this->customer->getFirstName(), $customerName);
    }

    /**
    * @expectedException        Assert\InvalidArgumentException
    */
    public function testSetCustomerFirstNameError() 
    {
        $customerName = 5;
        $this->customer->setFirstName($customerName);
    }

    public function testGetCustomerLastName() 
    {
        $this->assertEquals($this->customer->getLastName(), self::LAST_NAME);
    }

    public function testSetCustomerLastName() 
    {
        $customerName = 'Coxson';
        $this->customer->setLastName($customerName);
        $this->assertEquals($this->customer->getLastName(), $customerName);
    }

    /**
    * @expectedException        Assert\InvalidArgumentException
    */
    public function testSetCustomerLastNameError() 
    {
        $customerLastName = "";
        $this->customer->setLastName($customerLastName);
    }

    public function testGetCustomerPassword() 
    {
        $this->assertEquals($this->customer->getPassword(), self::PASSWORD);
    }

    public function testSetCustomerPassword() 
    {
        $password = '7654321';
        $this->customer->setPassword($password);
        $this->assertEquals($this->customer->getPassword(), $password);
    }

    /**
    * @dataProvider passwordErrorProvider
    * @expectedException        Assert\InvalidArgumentException
    */
    public function testSetCustomerPasswordErrors($password) 
    {
        $this->customer->setPassword($password);
    }

    public function testCustomerToJson() 
    {
        $jsonResponse = $this->customer->toJson();
        $this->assertEquals($jsonResponse, self::CUSTOMER_JSON);
    }

    public function testCustomerToArray() 
    {
        $arrayResponse = $this->customer->toArray();
        $this->assertEquals(count($arrayResponse), 4);
        $this->assertEquals($arrayResponse['email'], $this->_customerArray['email']);
        $this->assertEquals($arrayResponse['firstname'], $this->_customerArray['firstname']);
        $this->assertEquals($arrayResponse['lastname'], $this->_customerArray['lastname']);
        $this->assertEquals($arrayResponse['password'], $this->_customerArray['password']);
    }

    /**
    * ++++++++++ getCustomerBalance ++++++++++
    */

    public function testGetCustomerBalance() 
    {
        $customerBalance = $this->customer->getCustomerBalance();
        $this->assertEquals($customerBalance->getCreditTotal(), self::CUSTOMER_BALANCE_CREDIT_TOTAL);
    }

    /**
    * ++++++++++ CustomerShareBalance ++++++++++
    */

    public function testGetCustomerShareBalance() 
    {
        $customerShareBalance = $this->customer->getCustomerShareBalance();
        $this->assertInstanceOf("CustomerShareBalance", $customerShareBalance);
    }

    /**
    * @dataProvider jsonErrorProvider
    * @expectedException        Assert\InvalidArgumentException
    */
    public function testSetCustomerShareBalanceErrors($customerShareBalance) 
    {
        $this->customer->setCustomerShareBalance($customerShareBalance);
    }

    /**
    * @dataProvider customerShareBalanceErrorProvider
    * @expectedException        Assert\InvalidArgumentException
    */
    public function testSetCustomerShareBalanceInstantiatedErrors($shareToUser, $creditsToShare) 
    {
        $customerShareBalance = $this->customer->getCustomerShareBalance();
        $customerShareBalance->setShareToUser($shareToUser);
        $customerShareBalance->setCreditsToShare($creditsToShare);

        $this->customer->setCustomerShareBalance($customerShareBalance);
    }

    public function testSetCustomerShareBalance() 
    {
        $customerId = self::CUSTOMER_ID;
        $customerShareBalance = $this->customer->getCustomerShareBalance();
        $customerShareBalance->setShareToUser(15);
        $customerShareBalance->setCreditsToShare(150);

        $response = $this->customer->setCustomerShareBalance($customerShareBalance);
        $this->assertEquals($response['resource'], "customers/$customerId/balance");
        $this->assertEquals(count($response['data']), 3);
    }

    /**
    * ++++++++++ Error Providers ++++++++++
    */

    public function integerErrorProvider()
    {
        return array(
          array("5"),
          array(5.1),
          array([]),
          array(null),
        );
    }

    /**
    * ++++++++++ JSON Providers ++++++++++
    */

    public function jsonErrorProvider()
    {
        return array(
          array("5,"),
          array("5:"),
          array('"5" : "22"')
        );
    }

    /**
    * ++++++++++ Password Providers ++++++++++
    */

    public function passwordErrorProvider()
    {
        return array(
          array("123456"),
          array(123456),
          array(null),
          array(""),
        );
    }

    /**
    * ++++++++++ CustomerShareBalance Providers ++++++++++
    */

    public function customerShareBalanceErrorProvider()
    {
        return array(
          array(5, null),
          array(5, ""),
          array(null, 5),
          array("a", 5),
        );
    }

}