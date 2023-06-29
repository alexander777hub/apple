<?php

namespace backend\models;

use backend\interfaces\Fruit;

/**
 * Class Creator
 *
 * @package backend\models
 */
abstract class Creator
{
    abstract public function createFruit(): Fruit;

    abstract public function generate();

}
