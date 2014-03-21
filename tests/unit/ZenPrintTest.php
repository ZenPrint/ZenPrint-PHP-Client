<?php

class ZenPrintTest extends PHPUnit_Framework_TestCase {

  //const DEFAULT_LOGGING_ARGS = null;
  protected $_args = array( 'logging' => array ( 'handler' => 'StreamHandler'));

  public function setUp() {
    $this->_ZenPrint = new ZenPrint(1, 2, $this->_args);
  }

  public function testSomething() {
    $this->assertTrue(1 === 1);
  }
}
