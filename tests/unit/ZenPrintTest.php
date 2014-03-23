<?php

class ZenPrintTest extends PHPUnit_Framework_TestCase 
{
    //const DEFAULT_LOGGING_ARGS = null;
    protected $_args = array( 'logging' => array ( 'handler' => 'StreamHandler'));

    const TOKEN = 22;
    const OAUTH_TOKEN = 'ab3cd9j4ks73hf7g';
    const OAUTH_TOKEN_SECRET = 'xyz4992k83j47x0b';

    /**
    * @dataProvider newErrorProvider
    * @expectedException        Exception
    */
    public function testConstructErrors($token, $secret, $args) 
    {
        new ZenPrint($token, $secret, $args);
    }

    /**
    * @dataProvider newProvider
    */
    public function testConstruct($token, $secret, $args) 
    {
        $zenPrint = new ZenPrint($token, $secret, $args);
        $this->assertNotNull($zenPrint);
    }

    public function testOAuth2() 
    {
        $zenPrint = new ZenPrint(
            self::OAUTH_TOKEN
        );

        $this->assertNotNull($zenPrint);
    }

    /**
    * ++++++++++ Providers ++++++++++
    */

    public function newProvider()
    {
        return array(
          array(self::OAUTH_TOKEN, null, null),
          array(self::OAUTH_TOKEN, ARRAY(), null),
          array(self::OAUTH_TOKEN, self::OAUTH_TOKEN_SECRET, null),
          array(self::OAUTH_TOKEN, self::OAUTH_TOKEN_SECRET, ARRAY()),
        );
    }

    /**
    * ++++++++++ Error Providers ++++++++++
    */

    public function newErrorProvider()
    {
        return array(
          array(5, 5, 1),
          array("5", 5, 1),
          array("5", "5", 1),
          array("5", array('2')),
        );
    }
}
