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
    * @dataProvider optProvider
    */
    public function testOptHit($key, $value) 
    {
        $array = Array('1' => 'One');
        $response = u::opt($array, '2', 'Two');
        $this->assertEquals(count($array), 2);
        $this->assertEquals($array['2'], 'Two');
    }

    public function testOptMiss() 
    {
        $array = Array('1' => 'One');
        $response = u::opt($array, '1', null);
        $this->assertEquals(count($array), 1);
        $this->assertEquals($array['1'], 'One');
    }

    /**
    * @dataProvider mixedOptErrorProvider
    * @expectedException        Assert\InvalidArgumentException
    */

    public function testOptErrors($array, $key) 
    {
        u::set($array, $key, null);
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

    public function mixedOptErrorProvider()
    {
        return array(
          array([], 5),
          array("key", "key"),
        );
    }

    public function optProvider()
    {
        return array(
          array('2', 'Two'),
          array('Empty', ''),
        );
    }
}
