<?php

namespace backend\models;

use app\interfaces\Fruit;

/**
 * Class Creator
 *
 * @package backend\models
 */
abstract class Creator
{
    abstract public function createFruit(int $count): Fruit;

    abstract public function generate();

}
