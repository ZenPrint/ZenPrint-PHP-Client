<?php

class RESTFulWrapperTest extends PHPUnit_Framework_TestCase 
{
    public function setUp()
    {
        $this->_RESTfulWrapper = new RESTfulWrapper('http://url', '22');
    }

    public function testIsSuccess() 
    {
        $this->assertTrue($this->_RESTfulWrapper->isSuccess());
    }

    public function testIsSuccessError() 
    {
        $GLOBALS['headerResponseCode'] = '404';
        $this->assertFalse($this->_RESTfulWrapper->isSuccess());
    }
}
