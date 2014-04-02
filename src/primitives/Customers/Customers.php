<?php

use RESTful\RESTful;
use Assert\Assertion;

Class Customers 
{
    private $resource;
    private $customers = [];
    private $token;

    function __construct($token) 
    {
        $this->token = $token;
        $this->resource = new RESTful('http://api.zenprint.com/api/rest/v1.0', $this->token);
    }

    public function getCustomers() 
    {
        $customers = json_decode((string) $this->resource->get('customers'), true);
        if ($this->resource->getHeaderResponseCode() === "200") {
            foreach($customers as $customerId => $customer) {
                array_push($this->customers, new Customer($this->token, $customerId, $customer));
            }
        } else {
            throw new Exception('An Error Occurred.');
        }

        return $this->customers;
    }

    public function getNewCustomer() 
    {
        return new Customer($this->token, 0);
    }

    public function createCustomer($customer)
    {
        /**
        * Todo Add the id when it returns
        */
        Assertion::isInstanceOf($customer, 'Customer');
        $customer->restValidation(false);
        $data = $customer->toArray();
        $this->resource->post("customers", $data);
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
        return $this->resource->delete("customers/{$customer->getId()}");
    }
}
