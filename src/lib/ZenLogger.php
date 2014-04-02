<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Assert\Assertion;

Class ZenLogger 
{
    private $log = null;
    private $loggingObj = null;

    function __construct($args) 
    {
        if ($this->isHandlerAvailable($args) ) {
            if ($this->isStreamHandler()) {
                $this->log = new Logger($this->getLoggerName());
                $this->log->pushHandler(new StreamHandler($this->getLoggerFile(), Logger::WARNING));
            }
        }
    }

    public function addWarning($warning) 
    {
        if (!is_null($this->log)) {
            $this->log->addWarning($warning);
        }
    }

    public function addError($error) 
    {
        if (!is_null($this->log)) {
            $this->log->addError($error);
        }
    }

    private function isHandlerAvailable($args) 
    {
        if (is_array($args) && array_key_exists('logging', $args)) {
            Assertion::isArray($args['logging'], "You must supply a hash for the logging args.");   
            $this->loggingObj = $args['logging'];
            return true;
        } else {
            return false;
        }
    }

    private function isStreamHandler() {
        if (isset($this->loggingObj['handler'])) {
            return $this->loggingObj['handler'] === 'StreamHandler';
        } else {
            return false;
        }
    }

    private function getLoggerName() {
      return (isset($loggingObj['name'])) ? $loggingObj['name'] : 'zenprint';
    }

    private function getLoggerFile() {
      return (isset($loggingObj['file'])) ? $loggingObj['file'] : '/tmp/zenPrint.log';
    }
}
