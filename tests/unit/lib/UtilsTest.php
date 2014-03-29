<?php

use Utils as u;

class UtilsTest extends PHPUnit_Framework_TestCase 
{

    public function testSetHit() 
    {
        $response = u::set("key", Array('key' => 'brian'));
        $this->assertEquals($response, 'brian');
    }

    public function testSetMiss() 
    {
        $response = u::set("nate", Array('key' => 'brian'));
        $this->assertNull($response);
    }

    /**
    * @dataProvider mixedErrorProvider
    * @expectedException        Assert\InvalidArgumentException
    */

    public function testSetErrors($key, $array) 
    {
        u::set($key, $array);
    }

    /**
    * ++++++++++ Error Providers ++++++++++
    */

    public function mixedErrorProvider()
    {
        return array(
          array(5, []),
          array("key", 5),
        );
    }
}
