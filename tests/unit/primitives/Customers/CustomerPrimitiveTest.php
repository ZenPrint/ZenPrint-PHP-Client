<?php

class CustomerPrimitiveTest extends PHPUnit_Framework_TestCase 
{

    const EMAIL = 'dave@zenprint.com';
    const FIRST_NAME = 'Dave';
    const LAST_NAME = 'Boyce';
    const CUSTOMER_ID = 22;
    const CUSTOMER_JSON = '{"email":"dave@zenprint.com","firstname":"Dave","lastname":"Boyce"}';

    protected $_customerArray = array ( 
        'email' => self::EMAIL,
        'firstname' => self::FIRST_NAME,
        'lastname' => self::LAST_NAME
    );


    public function setUp() 
    {
        $this->customer = new Customer(self::CUSTOMER_ID, $this->_customerArray);
    }

    /**
    * @dataProvider integerAndArrayErrorProvider
    * @expectedException        Assert\InvalidArgumentException
    */
    public function testCustomerErrors($customerId, $customerArray) 
    {
        new Customer($customerId, $customerArray);
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

    public function testCustomerToJson() 
    {
        $jsonResponse = $this->customer->toJson();
        $this->assertEquals($jsonResponse, self::CUSTOMER_JSON);
    }

    public function testCustomerToArray() 
    {
        $arrayResponse = $this->customer->toArray();
        $this->assertEquals(count($arrayResponse), 3);
        $this->assertEquals($arrayResponse['email'], $this->_customerArray['email']);
        $this->assertEquals($arrayResponse['firstname'], $this->_customerArray['firstname']);
        $this->assertEquals($arrayResponse['lastname'], $this->_customerArray['lastname']);
    }

    /**
    * ++++++++++ Error Providers ++++++++++
    */

    public function integerAndArrayErrorProvider()
    {
        return array(
          array("5", "5"),
          array(5, 5.1),
          array("5", []),
          array(null, []),
          array(5, null) 
        );
    }
}
