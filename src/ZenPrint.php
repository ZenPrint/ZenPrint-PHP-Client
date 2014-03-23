<?php

include_once join('/', array(__DIR__, 'AutoLoader.php'));

use Assert\Assertion;

Class ZenPrint extends ZenLogger { 

    private $customersObject = null;
    private $oAuthObject = null;

    function __construct($oAuthToken, $oAuthTokenSecret = null, $args = null) 
    {

        Assertion::string($oAuthToken, "You must supply an oAuth Token.");

        if (is_array($oAuthTokenSecret)) {
            $args = $oAuthTokenSecret;
        }

        if ($args) {
            Assertion::isArray($args, "You must supply an array for the args.");   
        }

        parent::__construct($args);

        if ($oAuthTokenSecret === null || is_array($oAuthTokenSecret)) {
            $this->instantiateOAuth2Object($oAuthToken);
        } else {
            $this->instantiateOAuth1Object($oAuthToken, $oAuthTokenSecret);
        }

        $this->instantiateCustomerObject();
    }

    /**
    * ++++++++++ Customers ++++++++++
    */

    public function getCustomers() 
    {
        return $this->customersObject->getCustomers();
    }

    public function createCustomer() 
    {
        return $this->customersObject->createCustomer(func_num_args());
    }

    public function getCustomer() 
    {
        return $this->customersObject->getCustomer(func_num_args());
    }

    public function updateCustomer() 
    {
        return $this->customersObject->updateCustomer(func_num_args());
    }

    public function deleteCustomer() 
    {
        return $this->customersObject->deleteCustomer();
    }

    /**
    * ++++++++++ Private Methods ++++++++++
    */

    private function getOAuthToken() {
        return $this->oAuthObject->getOAuthHash();
    }

    private function instantiateCustomerObject() {
        $this->customersObject = new Customers($this->oAuthObject->getOAuthHash());
    }

    private function instantiateOAuth1Object($oAuthToken, $oAuthSecret) {
        $this->oAuthObject = new OAuth1($oAuthToken, $oAuthSecret);
    }

    private function instantiateOAuth2Object($tokenBearer) {
        $this->oAuthObject = new OAuth2($tokenBearer);
    }
}

