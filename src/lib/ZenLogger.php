<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

Class ZenLogger 
{

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
    $this->log->addWarning($warning);
  }

  public function addError($error) 
  {
    $this->log->addError($erro);
  }

  private function isHandlerAvailable($args) 
  {
    if (is_array($args) && array_key_exists('logging', $args)) {
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
      $file = (isset($loggingObj['file'])) ? $loggingObj['file'] : '/tmp/zenPrint.log';
  }
}
