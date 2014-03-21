<?php

Class OAuth1 extends ZenLogger {

  function __construct($oauth_token, $oauth_token_secret, $args=null) {
    parent::__construct($args);
    $this->oauth_token = $oauth_token;
    $this->oauth_token_secret = $oauth_token_secret;
  }

  public function getOAuthHash() {
    //Nate do some magic here
    return 22;  
  }
}
