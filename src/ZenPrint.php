<?php

include_once join('/', array(__DIR__, 'AutoLoader.php'));

Class ZenPrint extends RestHandlers { 
  function __construct($oauth_token, $oauth_token_secret, $args = null) {
    parent::__construct($oauth_token, $oauth_token_secret, $args);
  }
}

