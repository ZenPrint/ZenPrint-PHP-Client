<?php

namespace RESTful 
{

    class RESTful 
    {
        private $returnValue = null;

        function __construct($a, $b) {  } 

        function get($resource) 
        {
            switch ($resource) {
                case "customers":
                    $this->returnValue = '{
                        "5": {
                            "email": "nate@zenprint.com",
                            "firstname": "Nate",
                            "lastname": "Jensen"
                        }
                    }';
                    break;
                case "customers/23":
                    $this->returnValue = '{
                            "email": "dave@zenprint.com",
                            "firstname": "Dave",
                            "lastname": "Boyce"
                        }';
                    break;
            }

            return $this->returnValue;
        }

        function put($resource, $data) 
        {
            return Array(
                'resource' => $resource,
                'data' => $data
            );
        }

        function post($resource, $data) 
        {
            return Array(
                'resource' => $resource,
                'data' => $data
            );
        }

        function delete($resource) 
        {
            return Array(
                'resource' => $resource
            );
        }
    }


    class CustomersPrimitiveTest extends \PHPUnit_Framework_TestCase 
    {

        const OAUTH_HASH = '22';
        const CUSTOMER_ID = 23;
        const EMAIL = 'dave@zenprint.com';
        const FIRST_NAME = 'Dave';
        const LAST_NAME = 'Boyce';
        const CUSTOMER_JSON = '{"id":23,"email":"dave@zenprint.com","firstname":"Dave","lastname":"Boyce"}';

        protected $_customerArray = array ( 
            'email' => self::EMAIL,
            'firstname' => self::FIRST_NAME,
            'lastname' => self::LAST_NAME
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
                $this->assertEquals($customer->getFirstname(), "Nate");
                $this->assertEquals($customer->getLastname(), "Jensen");
            }
        }

        /**
        * ++++++++++ getCustomer ++++++++++
        */

        /**
        * @dataProvider integerErrorProvider
        * @expectedException        Assert\InvalidArgumentException
        */
        public function testGetCustomerErrors($customerId) 
        {
            $response = $this->_Customers->getCustomer($customerId);
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
        * @dataProvider customerAndJSONErrorProvider
        * @expectedException        Assert\InvalidArgumentException
        */
        public function testUpdateCustomerErrors($customerId, $customer) 
        {
            $response = $this->_Customers->updateCustomer($customerId, $customer);
        }

        public function testUpdateCustomer() 
        {
            $customerId = self::CUSTOMER_ID;
            $customer = new \Customer(self::CUSTOMER_ID, $this->_customerArray);
            $response = $this->_Customers->updateCustomer($customerId, $customer);
            $this->assertEquals($response['resource'], "customers/$customerId");
            $this->assertEquals($response['data'], self::CUSTOMER_JSON);
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
            $response = $this->_Customers->createCustomer($customer);
        }

        public function testCreateCustomer() 
        {
            $customer = new \Customer(self::CUSTOMER_ID, $this->_customerArray);
            $response = $this->_Customers->createCustomer($customer);
            $this->assertEquals($response['resource'], "customers");
            $this->assertEquals($response['data'], self::CUSTOMER_JSON);
        }

        /**
        * ++++++++++ deleteCustomer ++++++++++
        */

        /**
        * @dataProvider integerErrorProvider
        * @expectedException        Assert\InvalidArgumentException
        */
        public function testDeleteCustomerErrors($customerId) 
        {
            $response = $this->_Customers->deleteCustomer($customerId);
        }

        public function testDeleteCustomer() 
        {
            $customerId = 5;
            $response = $this->_Customers->deleteCustomer($customerId);
            $this->assertEquals($response['resource'], "customers/$customerId");
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
              array(null)
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

        public function customerAndJSONErrorProvider()
        {
            return array(
              array("5", "5"),
              array(5, "5,"),
              array(5, "5:"),
              array(5, '"5" : "22"')
            );
        }
    }
}
