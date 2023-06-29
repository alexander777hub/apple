<?php

namespace backend\models;

use app\models\Apple;
use backend\interfaces\Fruit;

/**
 * Class AppleCreator
 *
 * @package backend\models
 */
class AppleCreator extends Creator
{
    public static $colors = [
        'White',
        'Yellow',
        'Orange',
        'Green',
    ];

    public function createFruit(): Fruit
    {
        $rand = mt_rand(0, 3);
        $color = array_search(self::$colors[$rand], self::$colors);
        $apple = new Apple();
        $apple->color = $color;
        $rand_date = date('Y-m-d-h-i-s', strtotime('-'.mt_rand(0, 2).' days'));

        $apple->date_appear = $rand_date;

        $apple->save(false);
        return $apple;
    }

    public function generate()
    {
        $creator = new self();
        $rand = mt_rand(0, 10);
        for ($i = 0; $i<$rand; $i++) {
            $creator->createFruit();
        }
    }

}
