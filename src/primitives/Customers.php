<?php

use RESTful\RESTful;

use Assert\Assertion;

Class Customers 
{
    private $restHandle;

    function __construct($token) 
    {
        $this->restHandle = new RESTful('http://api.zenprint.com/api/rest/v1.0', $token);
    }

    public function getCustomers() 
    {
        return json_decode($this->restHandle->get('customers'), true);
    }

    public function createCustomer($customer)
    {
        Assertion::isJsonString($customer);
        $data = json_encode($customer);
        return $this->restHandle->post("customers", $data);
    }

    public function getCustomer($customerId)
    {
        Assertion::integer($customerId);
        return json_decode($this->restHandle->get("customers/$customerId"), true);
    }

    public function updateCustomer($customerId, $customer)
    {
        Assertion::integer($customerId);
        Assertion::isJsonString($customer);
        $data = json_encode($customer);
        return $this->restHandle->put("customers/$customerId", $data);
    }

    public function deleteCustomer($customerId)
    {
        Assertion::integer($customerId);
        return $this->restHandle->delete("customers/$customerId");
    }
}
