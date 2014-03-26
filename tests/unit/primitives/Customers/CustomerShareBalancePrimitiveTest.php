<?php

class CustomerShareBalancePrimitiveTest extends PHPUnit_Framework_TestCase 
{
    const SHARE_TO_USER = 2;
    const CREDITS_TO_SHARE = 92.50;
    const COMMENT = 'By Away';
    const CUSTOMER_SHARE_BALANCE_JSON = '{"share_to_user":2,"credits_to_share":92.5,"comment":"By Away"}';

    protected $_customerShareBalanceArray = array ( 
        'share_to_user' => self::SHARE_TO_USER,
        'credits_to_share' => self::CREDITS_TO_SHARE,
        'comment' => self::COMMENT
    );

    public function setUp() {
        $this->_customerShareBalance = new CustomerShareBalance();
    }

    public function testSetShareToUser() 
    {
        $customerShareBalance = new CustomerShareBalance();
        $customerShareBalance->setShareToUser(self::SHARE_TO_USER);
        $this->assertEquals($customerShareBalance->getShareToUser(), self::SHARE_TO_USER);

        return $customerShareBalance;
    }

    /**
    * @dataProvider integerErrorProvider
    * @expectedException        Assert\InvalidArgumentException
    */
    public function testShareToUserErrors($customerId) 
    {
        $this->_customerShareBalance->setShareToUser($customerId);
    }

    /**
    * @depends testSetShareToUser
    */
    public function testCreditsToShare(CustomerShareBalance $customerShareBalance) 
    {
        $customerShareBalance->setCreditsToShare(self::CREDITS_TO_SHARE);
        $this->assertEquals($customerShareBalance->getCreditsToShare(), self::CREDITS_TO_SHARE);

        return $customerShareBalance;
    }

    /**
    * @dataProvider floatErrorProvider
    * @expectedException        Assert\InvalidArgumentException
    */
    public function testCreditsToShareErrors($creditsToShare) 
    {
        $this->_customerShareBalance->setCreditsToShare($creditsToShare);
    }

    /**
    * @depends testCreditsToShare
    */
    public function testGetComment(CustomerShareBalance $customerShareBalance) 
    {
        $customerShareBalance->setComment(self::COMMENT);
        $this->assertEquals($customerShareBalance->getComment(), self::COMMENT);

        return $customerShareBalance;
    }

    /**
    * @dataProvider stringErrorProvider
    * @expectedException        Assert\InvalidArgumentException
    */
    public function testGetCommentsErrors($comment) 
    {
        $this->_customerShareBalance->setComment($comment);
    }

    /**
    * @depends testGetComment
    */
    public function testCustomerShareBalanceToJson(CustomerShareBalance $customerShareBalance) 
    {
        $jsonResponse = $customerShareBalance->toJson();
        $this->assertEquals($jsonResponse, self::CUSTOMER_SHARE_BALANCE_JSON);

        return $customerShareBalance;
    }

    /**
    * @depends testCustomerShareBalanceToJson
    */
    public function testCustomerShareBalanceToArray(CustomerShareBalance $customerShareBalance) 
    {
        $arrayResponse = $customerShareBalance->toArray();
        $this->assertEquals(count($arrayResponse), 3);
        $this->assertEquals($arrayResponse['share_to_user'], $customerShareBalance->getShareToUser());
        $this->assertEquals($arrayResponse['credits_to_share'], $customerShareBalance->getCreditsToShare());
        $this->assertEquals($arrayResponse['comment'], $customerShareBalance->getComment());
    }

    /**
    * ++++++++++ Error Providers ++++++++++
    */

    /**
    * ++++++++++ Integer Providers ++++++++++
    */

    public function integerErrorProvider()
    {
        return array(
          array("5"),
          array(5.1),
          array(""),
          array(null),
        );
    }

    /**
    * ++++++++++ Float Providers ++++++++++
    */

    public function floatErrorProvider()
    {
        return array(
          array("5"),
          array(5),
          array(""),
          array(null),
        );
    }

    /**
    * ++++++++++ String Providers ++++++++++
    */

    public function stringErrorProvider()
    {
        return array(
          array(5.1),
          array(5),
          array([]),
          array(true),
          array(null),
        );
    }
}
