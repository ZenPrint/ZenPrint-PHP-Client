<?php
class OAuth1Test extends PHPUnit_Framework_TestCase {

  const OAUTH_TOKEN = 'ab3cd9j4ks73hf7g';
  const OAUTH_TOKEN_SECRET = 'xyz4992k83j47x0b';
  const OAUTH_HASH = '22';

  public function setUp() {
    $this->_OAuth1 = new OAuth1(self::OAUTH_TOKEN, self::OAUTH_TOKEN_SECRET);
  }

  public function testOAuthToken() {
    $this->assertEquals(self::OAUTH_TOKEN, $this->_OAuth1->oauth_token);
  }

  public function testOAuthTokenSecret() {
    $this->assertEquals(self::OAUTH_TOKEN_SECRET, $this->_OAuth1->oauth_token_secret);
  }

  public function testOAuthHash() {
    $response = $this->_OAuth1->getOAuthHash();
    $this->assertEquals(self::OAUTH_HASH, $response);
  }
}
