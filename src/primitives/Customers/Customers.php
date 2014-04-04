<?php

use Assert\Assertion;

Class Customers 
{
    private $resource;
    private $customers = [];
    private $token;

    function __construct($token) 
    {
        $this->token = $token;
        $this->resource = new RESTfulWrapper('http://api.zenprint.com/api/rest/v1.0', $this->token);
    }

    public function getCustomers() 
    {
        $customers = json_decode((string) $this->resource->get('customers'), true);
        if ($this->resource->isSuccess()) {
            foreach($customers as $customerId => $customer) {
                array_push($this->customers, new Customer($this->token, $customerId, $customer));
            }
        } else {
            throw new Exception(
                sprintf("An Error Occurred.\n%s",
                    $this->resource->getResponseBody()
                )
            );
        }

        return $this->customers;
    }

    public function getNewCustomer() 
    {
        return new Customer($this->token, 0);
    }

    public function createCustomer($customer)
    {
        Assertion::isInstanceOf($customer, 'Customer');
        $customer->restValidation(false);
        $data = $customer->toArray();
        $this->resource->post("customers", $data);

        if ($this->resource->isSuccess()) {
            $customer->setId($this->parseCustomerIdFromHeaderLocation());
        } else {
            throw new Exception(
                sprintf("An Error Occurred.\n%s",
                    $this->resource->getResponseBody()
                )
            );
        }

        return $customer;
    }

    public function getCustomer($customerId)
    {
        Assertion::integer($customerId);
        return new Customer(
            $this->token,
            $customerId, 
            json_decode((string) $this->resource->get("customers/$customerId"), true)
        );
    }

    public function updateCustomer($customer)
    {
        Assertion::isInstanceOf($customer, 'Customer');
        $customer->restValidation(true);
        $data = $customer->toArray();
        /**
        * What does it return?
        */
        $this->resource->put("customers/{$customer->getId()}", $data);
        return $customer;
    }

    public function deleteCustomer($customer)
    {
        Assertion::isInstanceOf($customer, 'Customer');
        /**
        * What does it return?
        */
        return $this->resource->delete("customers/{$customer->getId()}");
    }

    private function parseCustomerIdFromHeaderLocation()
    {
        $location = $this->resource->getHeaderLocation();
        preg_match("/.*\/(\d+)$/", $location, $userId);
        if(count($userId) === 2) { 
            return $userId[1];
        } else {
            throw new Exception(
                sprintf("An Error Occurred.\n%s",
                    "No userId was returned"
                )
            );
        }
    }
}
