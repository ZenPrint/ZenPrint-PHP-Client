<?php

use RESTful\RESTful;
use Assert\Assertion;

Class Customer
{
    private $id = null;
    private $email = null;
    private $firstName = null;
    private $lastName = null;

    function __construct($customerId, $customerArray) 
    {
        Assertion::integer($customerId);
        Assertion::isArray($customerArray);
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

    private function parseCustomer($customerId, $customerArray) {
       $this->setId($customerId);
       $this->setEmail($customerArray['email']);
       $this->setFirstName($customerArray['firstname']);
       $this->setLastName($customerArray['lastname']);
    }
}
