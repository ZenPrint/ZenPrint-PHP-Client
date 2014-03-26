<?php

use RESTful\RESTful;
use Assert\Assertion;

Class Customers 
{
    private $resource;
    private $customers = [];

    function __construct($token) 
    {
        $this->resource = new RESTful('http://api.zenprint.com/api/rest/v1.0', $token);
    }

    public function getCustomers() 
    {
        $customers = json_decode((string) $this->resource->get('customers'), true);
        foreach($customers as $customerId => $customer) {
            array_push($this->customers, new Customer($customerId, $customer));
        }

        return $this->customers;
    }

    public function createCustomer($customer)
    {
        Assertion::isInstanceOf($customer, 'Customer');
        $data = $customer->toArray();
        return $this->resource->post("customers", $data);
    }

    public function getCustomer($customerId)
    {
        Assertion::integer($customerId);
        return new Customer(
            $customerId, 
            json_decode((string) $this->resource->get("customers/$customerId"), true)
        );
    }

    public function updateCustomer($customerId, $customer)
    {
        Assertion::integer($customerId);
        Assertion::isInstanceOf($customer, 'Customer');
        $data = $customer->toArray();
        return $this->resource->put("customers/$customerId", $data);
    }

    public function deleteCustomer($customer)
    {
        Assertion::isInstanceOf($customer, 'Customer');
        return $this->resource->delete("customers/{$customer->getId()}");
    }

    public function getCustomerBalance($customerId)
    {
        Assertion::integer($customerId);
        return new CustomerBalance(
            json_decode((string) $this->resource->get("customers/$customerId/balance"), true)
        );
    }
}
