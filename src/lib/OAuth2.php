<?php

use Assert\Assertion;

Class OAuth2
{
    private $tokenBearer;

    function __construct($tokenBearer) 
    {
        Assertion::string($tokenBearer, "The Token Bearer must be a string.");

        $this->tokenBearer = $tokenBearer;
    }

    public function getOAuthHash() 
    {
        return $this->tokenBearer;
    }

    public function getType() 
    {
        return "OAuth2";
    }
}
