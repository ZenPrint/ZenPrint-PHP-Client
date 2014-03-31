<?php

namespace Monolog
{
    class Logger
    {
        const DEBUG = 1;
        const WARNING = 1;

        function __construct()
        {

        }

        function pushHandler() 
        {

        }

        function addWarning($warning)
        {
            \PHPUnit_Framework_TestCase::assertEquals($warning, "You have been warned");
        }

        function addError($error)
        {
            \PHPUnit_Framework_TestCase::assertEquals($error, "Ooops -- error!");
        }
    }

    class ZenLoggerTest extends \PHPUnit_Framework_TestCase 
    {

        /**
        * @dataProvider             argsErrorProvider
        * @expectedException        Assert\InvalidArgumentException
        */
        public function testInstantiationErrorHandling($args) 
        {
            $this->_zenLogger = new \ZenLogger($args);
        }

        public function testInstantiationStreamHandlerFalseHandling() 
        {
            $args = array('logging'=>array());
            $this->_zenLogger = new \ZenLogger($args);
        }

        public function testAddWarningErrorHandling() 
        {
            $this->_zenLogger = new \ZenLogger([]);
            $this->_zenLogger->addWarning("a");
        }

        public function testAddWarning() 
        {
            $this->_zenLogger = new \ZenLogger($this->getLoggerArgs());
            $this->_zenLogger->addWarning("You have been warned");
        }

        public function testAddErrorErrorHandling() 
        {
            $this->_zenLogger = new \ZenLogger([]);
            $this->_zenLogger->addError("a");
        }

        public function testAddError() 
        {
            $this->_zenLogger = new \ZenLogger($this->getLoggerArgs());
            $this->_zenLogger->addError("Ooops -- error!");
        }

        private function getLoggerArgs()
        {
            return Array(
                'logging' => Array(
                    'handler' => 'StreamHandler',
                    'name' => 'Nate',
                    'file' => 'Jensen'
                )
            );
        }

        /**
        * ++++++++++ Error Providers ++++++++++
        */

        public function argsErrorProvider()
        {
            return array(
                array(array('logging'=>'a')),
            );
        }
    }
}
