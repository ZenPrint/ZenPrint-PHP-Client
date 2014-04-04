<?php

class CustomersPrimitiveTest extends \PHPUnit_Framework_TestCase 
{

    const OAUTH_HASH = '22';
    const CUSTOMER_ID = 23;
    const EMAIL = 'dave@zenprint.com';
    const FIRST_NAME = 'Dave';
    const MIDDLE_NAME= 'Da Man';
    const LAST_NAME = 'Boyce';
    const PASSWORD = 'ab345ef';
    const PREFIX = 'Exalted Ruler';
    const SUFFIX = 'III';
    const TAXVAT = 'GB888 7777 62';
    const CUSTOMER_JSON = '{"email":"dave@zenprint.com","firstname":"Dave","lastname":"Boyce","password":"ab34d5e","middlename":"Da Man","prefix":"Mr.","suffix":"Sr","taxvat":"GB999 9999 73"}';

    protected $_customerArray = array ( 
        'email' => self::EMAIL,
        'firstname' => self::FIRST_NAME,
        'middlename' => self::MIDDLE_NAME,
        'lastname' => self::LAST_NAME,
        'password' => self::PASSWORD,
        'prefix' => self::PREFIX,
        'suffix' => self::SUFFIX,
        'taxvat' => self::TAXVAT
    );

    public function setUp() 
    {
        $this->_Customers = new \Customers(self::OAUTH_HASH);
    }

    public function testGetCustomers() 
    {
        $customers = $this->_Customers->getCustomers();
        $this->assertEquals(count($customers), 1);
        foreach ($customers as $customer) {
            $this->assertEquals($customer->getEmail(), "nate@zenprint.com");
            $this->assertEquals($customer->getFirstName(), "Nate");
            $this->assertEquals($customer->getLastName(), "Jensen");
            $this->assertEquals($customer->getPassword(), "1234567");
        }
    }

    /**
    * @expectedException        Exception
    */
    public function testGetCustomersError() 
    {
        $GLOBALS['headerResponseCode'] = 403;
        $customers = $this->_Customers->getCustomers();
    }

    /**
    * ++++++++++ getCustomer ++++++++++
    */

    public function testGetNewCustomer() 
    {
        $this->assertInstanceOf('Customer', $this->_Customers->getNewCustomer());
    }

    /**
    * @dataProvider integerErrorProvider
    * @expectedException        Assert\InvalidArgumentException
    */
    public function testGetCustomerErrors($customerId) 
    {
        $this->_Customers->getCustomer($customerId);
    }

    public function testGetCustomer() 
    {
        $customerId = self::CUSTOMER_ID;
        $customer = $this->_Customers->getCustomer($customerId);
        $this->assertEquals($customer->toJson(), self::CUSTOMER_JSON);
    }
    
    /**
    * ++++++++++ Update Customer ++++++++++
    */

    /**
    * @dataProvider jsonErrorProvider
    * @expectedException        Assert\InvalidArgumentException
    */
    public function testUpdateCustomerErrors($customer) 
    {
        $response = $this->_Customers->updateCustomer($customer);
    }

    public function testUpdateCustomer() 
    {
        $customerId = self::CUSTOMER_ID;
        $customer = new \Customer(self::OAUTH_HASH, self::CUSTOMER_ID, $this->_customerArray);
        $response = $this->_Customers->updateCustomer($customer);
        $this->assertInstanceOf("Customer", $response);
    }

    /**
    * ++++++++++ Create Customer ++++++++++
    */

    /**
    * @dataProvider jsonErrorProvider
    * @expectedException        Assert\InvalidArgumentException
    */
    public function testCreateCustomerErrors($customer) 
    {
        $this->_Customers->createCustomer($customer);
    }

    /**
    * @expectedException        Exception
    */
    public function testCreateCustomers403Error() 
    {
        $customer = new \Customer(self::OAUTH_HASH, 0, $this->_customerArray);
        $GLOBALS['headerResponseCode'] = 403;
        $this->_Customers->createCustomer($customer);
    }

    /**
    * @expectedException        Exception
    */
    public function testCreateCustomersBadHeaderLocationError() 
    {
        $customer = new \Customer(self::OAUTH_HASH, 0, $this->_customerArray);
        $GLOBALS['headerLocation'] = '/this/is/not/correct';
        $this->_Customers->createCustomer($customer);
    }

    public function testCreateCustomer() 
    {
        $customer = new \Customer(self::OAUTH_HASH, 0, $this->_customerArray);
        $response = $this->_Customers->createCustomer($customer);
        $this->assertInstanceOf("Customer", $response);
        $this->assertEquals($response->getId(), '032578');
    }

    /**
    * ++++++++++ deleteCustomer ++++++++++
    */

    /**
    * @dataProvider integerErrorProvider
    * @expectedException        Assert\InvalidArgumentException
    */
    public function testDeleteCustomerErrors($customer) 
    {
        $this->_Customers->deleteCustomer($customer);
    }

    public function testDeleteCustomer() 
    {
        $customer = new \Customer(self::OAUTH_HASH, self::CUSTOMER_ID, $this->_customerArray);
        $response = $this->_Customers->deleteCustomer($customer);
        $this->assertEquals($response['resource'], "customers/" . self::CUSTOMER_ID);
    }

    /**
    * ++++++++++ Error Providers ++++++++++
    */

    /**
    * ++++++++++ Integer Providers ++++++++++
    */

    public function integerErrorProvider()
    {
        return array(
          array("5"),
          array(5.1),
          array(""),
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
}
