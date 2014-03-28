<?php

use RESTful\RESTful;
use Assert\Assertion;

Class Customer 
{
    private $resource;
    private $id = null;
    private $email = null;
    private $firstName = null;
    private $lastName = null;

    function __construct($token, $customerId, $customerArray) 
    {
        Assertion::integer($customerId);
        Assertion::isArray($customerArray);
        $this->resource = new RESTful('http://api.zenprint.com/api/rest/v1.0', $token);
        $this->parseCustomer($customerId, $customerArray);
    }

    public function getId() {
        return $this->id;
    }

    public function setId($customerId) {
        $this->id = $customerId;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function toJson() {
        return json_encode (
            $this->toArray()
        );
    }

    public function toArray() {
        return array (
            'email' => $this->getEmail(),
            'firstname' => $this->getFirstName(),
            'lastname' => $this->getLastName()
        );
    }

    public function getCustomerBalance()
    {
        return new CustomerBalance (
            json_decode((string) $this->resource->get("customers/{$this->getId()}/balance"), true)
        );
    }

    public function getCustomerShareBalance()
    {
        return new CustomerShareBalance();
    }

    public function setCustomerShareBalance($customerShareBalance)
    {
        Assertion::isInstanceOf($customerShareBalance, 'CustomerShareBalance');
        $customerShareBalance->restValidation();
        $data = $customerShareBalance->toArray();
        /**
        * What does it return?
        */
        return $this->resource->put("customers/{$this->getId()}/balance", $data);
    }

    private function parseCustomer($customerId, $customerArray) {
       $this->setId($customerId);
       $this->setEmail($customerArray['email']);
       $this->setFirstName($customerArray['firstname']);
       $this->setLastName($customerArray['lastname']);
    }
}
