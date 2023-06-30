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
 * @property float $initial_size
 */
class Apple extends \yii\db\ActiveRecord implements \app\interfaces\Fruit
{
    public string $spent_value = '';
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

    public function beforeValidate()
    {
        $this->spent_value = str_replace(',', '.', $this->spent_value);
        return parent::beforeValidate();
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
            [['spent'], 'integer', 'min' => 0, 'max' => 100],
            [['date_appear', 'date_fall'], 'safe'],
            [['size'], 'number', 'numberPattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/',],
            [['initial_size'], 'number', 'numberPattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            [['spent_value'], 'number', 'numberPattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/', 'min' => 0.01, 'max' => 1.00],
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

    public function eat(): bool
    {
        $percent = $this->spent_value;
        if ($this->status == self::getStatusList()[self::STATUS_ON]) {
            $this->addError('status', 'On the tree');
        }
        if ($this->status == self::getStatusList()[self::STATUS_SPOILED]) {
            $this->addError('status', 'Apple is spoiled');
        }

        if (!$this->getErrors()) {
            $this->size = $this->getSize() - $percent;
            if ($this->getSize() <= 0) {
                return false;
            }
            $diff = $this->initial_size - $this->getSize();
            $this->spent = round(($diff / $this->initial_size) * 100);
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
            $this->date_fall = gmdate('Y-m-d-h-i-s');

            $this->date_fall = gmdate('Y-m-d-h-i-s');
            return true;
        }

    }
}
