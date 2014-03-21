<?php

Class RestHandlers extends OAuth1 {
  function __construct($oauth_token, $oauth_token_secret, $args = null) {
    parent::__construct($oauth_token, $oauth_token_secret, $args);
  }
}
