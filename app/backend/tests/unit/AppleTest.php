<?php

namespace backend\tests\unit;

use app\models\Apple;
use backend\models\AppleCreator;

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

    public function testEat()
    {
        $apple = new Apple();
        $apple->initial_size = 1.00;
        $apple->spent = 50;
        $apple->status = 2;
        $apple->size = 0.5;
        $apple->spent_value = '0.25';
        $apple->eat();
        $this->assertTrue($apple->size === 0.25);
        $apple->status = 1;
        $apple->eat(25);
        $this->assertTrue(!empty($apple->getErrors()));
    }

    public function testCreateFruit()
    {
        $creator = new AppleCreator();
        $apple = $creator->createFruit(1);
        $this->assertTrue($apple instanceof Apple);
        $this->assertTrue($apple->size === 1.00);
    }
}
