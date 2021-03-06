<?php

namespace Ebanx\Woocommerce\Test;

use Faker;

use Ebanx\Woocommerce\Operator;

class BaseTest extends \PHPUnit_Extensions_Selenium2TestCase {
    protected
        $faker
        , $adminOperator
        , $ecommerceOperator
    ;

    protected function setUp() {
        date_default_timezone_set('Brazil/East');

        $this->faker = Faker\Factory::create('pt_BR');

        $this->adminOperator     = new Operator\Admin\AdminOperator($this);
        $this->ecommerceOperator = new Operator\Ecommerce\EcommerceOperator($this);

        $this->setHost('localhost');
        $this->setPort(4444);
        $this->setBrowserUrl('http://dev-checkout-woocommerce.ebanx.com/');
        $this->setBrowser('firefox');
    }
    public function tearDown() {
        $this->stop();
    }
}
