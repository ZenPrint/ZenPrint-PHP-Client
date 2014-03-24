<?php

use Assert\Assertion;

Class OAuth1
{

    private $oAuthToken;
    private $oAuthTokenSecret;

    function __construct($oAuthToken, $oAuthTokenSecret) 
    {
        Assertion::string($oAuthToken, "oAuth Token must be a string.");
        Assertion::string($oAuthTokenSecret, "oAuth Secert must be a string.");

        $this->oAuthToken = $oAuthToken;
        $this->oAuthTokenSecret = $oAuthTokenSecret;
    }

    public function getOAuthHash() 
    {
        //Nate do some magic here
        return "token=22&secret=23";  
    }

    public function getType() 
    {
        return "OAuth1";
    }
}
