<?php

class OAuth2Test extends PHPUnit_Framework_TestCase 
{

    const TOKEN_BEARER = 'ab3cd9j4ks73hf7g';
    const OAUTH_TYPE = 'OAuth2';

    public function setUp() 
    {
        $this->_OAuth2 = new OAuth2(self::TOKEN_BEARER);
    }

    public function testOAuthHash() {
        $response = $this->_OAuth2->getOAuthHash();
        $this->assertEquals(self::TOKEN_BEARER, $response);
    }

    /**
    * @dataProvider oauthErrorProvider
    * @expectedException        Assert\InvalidArgumentException
    */
    public function testOAuthHashErrors($token) 
    {
        new OAuth2($token);
    }

    public function testType() {
        $response = $this->_OAuth2->getType();
        $this->assertEquals(self::OAUTH_TYPE, $response);
    }

    /**
    * ++++++++++ Error Providers ++++++++++
    */

    public function oauthErrorProvider()
    {
        return array(
          array(5),
        );
    }
}
