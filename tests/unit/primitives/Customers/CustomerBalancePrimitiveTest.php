<?php

class CustomerBalancePrimitiveTest extends PHPUnit_Framework_TestCase 
{

    const CREDIT_TOTAL = 101.25;

    protected $_customerBalanceArray = array ( 
        'credit_total' => self::CREDIT_TOTAL,
    );

    public function setUp() 
    {
        $this->customerBalance = new CustomerBalance($this->_customerBalanceArray);
    }

    /**
    * @dataProvider arrayErrorProvider
    * @expectedException        Assert\InvalidArgumentException
    */
    public function testCustomerBalanceErrors($customerBalanceArray) 
    {
        new CustomerBalance($customerBalanceArray);
    }

    public function testGetCreditTotal() 
    {
        $this->assertEquals($this->customerBalance->getCreditTotal(), self::CREDIT_TOTAL);
    }

    /**
    * ++++++++++ Error Providers ++++++++++
    */

    public function arrayErrorProvider()
    {
        return array(
          array("5"),
          array(5.1),
          array(""),
          array(null)
        );
    }
}
