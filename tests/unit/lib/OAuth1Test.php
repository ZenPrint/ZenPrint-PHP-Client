<?php

class OAuth1Test extends PHPUnit_Framework_TestCase 
{

    const OAUTH_TOKEN = 'ab3cd9j4ks73hf7g';
    const OAUTH_TOKEN_SECRET = 'xyz4992k83j47x0b';
    const OAUTH_HASH = 'token=22&secret=23';
    const OAUTH_TYPE = 'OAuth1';

    public function setUp() 
    {
        $this->_OAuth1 = new OAuth1(self::OAUTH_TOKEN, self::OAUTH_TOKEN_SECRET);
    }

    public function testOAuthHash() 
    {
        $response = $this->_OAuth1->getOAuthHash();
        $this->assertEquals(self::OAUTH_HASH, $response);
    }

    /**
    * @dataProvider oauthErrorProvider
    * @expectedException        Assert\InvalidArgumentException
    */
    public function testOAuthHashErrors($token, $secret) 
    {
        new OAuth1($token, $secret);
    }

    public function testType() {
        $response = $this->_OAuth1->getType();
        $this->assertEquals(self::OAUTH_TYPE, $response);
    }

    /**
    * ++++++++++ Error Providers ++++++++++
    */

    public function oauthErrorProvider()
    {
        return array(
          array("5", 22),
          array(5, "22"),
        );
    }
}
