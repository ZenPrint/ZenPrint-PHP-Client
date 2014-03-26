<?php

use RESTful\RESTful;
use Assert\Assertion;

Class CustomerBalance
{
    private $creditTotal = null;

    function __construct($customerBalanceArray) 
    {
        Assertion::isArray($customerBalanceArray);
        $this->parseCustomerBalance($customerBalanceArray);
    }

    public function getCreditTotal() {
        return $this->creditTotal;
    }

    private function setCreditTotal($creditTotal) {
        $this->creditTotal = $creditTotal;
    }

    private function parseCustomerBalance($customerBalanceArray) {
       $this->setCreditTotal($customerBalanceArray['credit_total']);
    }
}
