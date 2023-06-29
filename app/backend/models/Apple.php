<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "apple".
 *
 * @property int $id
 * @property int $color
 * @property string|null $date_appear
 * @property string|null $date_fall
 * @property int $status
 * @property int $spent
 * @property float $size
 */
class Apple extends \yii\db\ActiveRecord implements \backend\interfaces\Fruit
{
    public const STATUS_ON = 'On the tree' ;
    public const STATUS_FELL = 'fell' ;

    public const STATUS_SPOILED = 'spoiled' ;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apple';
    }

    /**
     * {@inheritdoc}
     */
    public static function getStatusList()
    {
        return [
            'On the tree' => 1,
            'fell' => 2,
            'spoiled' => 3,
        ];
    }

    public static function getStatusArray()
    {
        return [
            1 => 'On the tree',
            2 => 'fell',
            3 => 'spoiled',
        ];
    }



    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color', 'status'], 'integer'],
            [['spent'],'integer', 'min'=>0, 'max'=>100 ],
            [['date_appear', 'date_fall'], 'safe'],
            [['size'], 'number', 'numberPattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Color',
            'date_appear' => 'Date Appear',
            'date_fall' => 'Date Fall',
            'status' => 'Status',
            'spent' => 'Spent',
        ];
    }

    public function getSize(): float
    {
        return $this->size;
    }

    public function percentToDecimal($percent): float
    {
        return $percent / 100.00;
    }

    public function eat(int $percent)
    {
        if($this->status == self::getStatusList()[self::STATUS_ON]) {
            $this->addError('status', 'On the tree');
        }
        if($this->status == self::getStatusList()[self::STATUS_SPOILED]) {
            $this->addError('status', 'Apple is spoiled');
        }

        if(!$this->getErrors()) {
            $this->spent = $percent + $this->spent;

            if ($this->spent >= 100) {
                return false;
            } else {
                $spent_decimal = $this->percentToDecimal($percent);
                $this->size = $this->getSize() - $spent_decimal;
            }
        }
        return true;
    }


    public function fall()
    {
        if($this->status == self::getStatusList()[self::STATUS_FELL]) {
            $this->addError('status', 'Already fell');
            return false;
        } else {
            $this->status = Apple::getStatusList()[Apple::STATUS_FELL];
            $this->date_fall = date('Y-m-d-h-i-s');
            return true;
        }

    }
}
