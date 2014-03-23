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
                case "customers/5":
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

        public function setUp() 
        {
            $this->_Customers = new \Customers(self::OAUTH_HASH);
        }

        public function testGetCustomers() 
        {
            $response = $this->_Customers->getCustomers();
            $this->assertEquals(count($response), 1);
            $this->assertEquals($response[5]['email'], "nate@zenprint.com");
            $this->assertEquals($response[5]['firstname'], "Nate");
            $this->assertEquals($response[5]['lastname'], "Jensen");
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
            $customerId = 5;
            $response = $this->_Customers->getCustomer($customerId);
            $this->assertEquals(count($response), 3);
            $this->assertEquals($response['email'], "dave@zenprint.com");
            $this->assertEquals($response['firstname'], "Dave");
            $this->assertEquals($response['lastname'], "Boyce");
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
            $customerId = 5;
            $customer = "2";
            $response = $this->_Customers->updateCustomer($customerId, $customer);
            $this->assertEquals($response['resource'], "customers/$customerId");
            $this->assertEquals($response['data'], '"' . $customer . '"');
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
            $customer = "2";
            $response = $this->_Customers->createCustomer($customer);
            $this->assertEquals($response['resource'], "customers");
            $this->assertEquals($response['data'], '"' . $customer . '"');
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
