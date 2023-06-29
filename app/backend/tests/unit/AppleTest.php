<?php

namespace backend\tests\unit;

use app\models\Apple;

/**
 * Post model test
 */
class AppleTest extends \Codeception\Test\Unit
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;

    public function testValidationData()
    {
        $apple = new Apple();
        $apple->spent = 50;
        $apple->status = 1;
        $this->assertTrue($apple->validate());
        $apple = new Apple();
        $apple->spent = 'string';
        $apple->status = 'string';
        $this->assertFalse($apple->validate());
    }

    public function testGetSize()
    {
        $apple = new Apple();
        $apple->spent = 50;
        $apple->status = 2;
        $apple->size = 0.5;
        $this->assertTrue(is_float($apple->getSize()));
    }

    public function testPercentToDecimal()
    {
        $apple = new Apple();

        $this->assertTrue($apple->percentToDecimal(100) === 1.00);
        $this->assertTrue(is_float($apple->percentToDecimal(100)));
    }

    public function testEat()
    {
        $apple = new Apple();
        $apple->spent = 50;
        $apple->status = 2;
        $apple->size = 0.5;
        $apple->eat(25);
        $apple->status = 1;
        $apple->eat(25);
        $this->assertTrue(!empty($apple->getErrors()));
    }
}
