<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * Class Currency
 *
 * @property integer $id
 * @property integer $r030
 * @property string $title
 * @property string $short_title
 * @property float $rate
 * @property string $exchangedate
 *
 */
class Currency extends ActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * @inheritdoc
     * @return array|void
     */
    public function rules()
    {
        return [
            [['r030'], 'integer'],
            [['rate'], 'safe'],
            [['title', 'short_title'], 'string', 'max' => 255],
            [['exchangedate'], 'safe'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            ['r030' => 'r030'],
            ['title' => 'Title'],
            ['short_title' => 'Short title'],
            ['rate' => 'Rate'],
            ['exchangedate' => 'Date of exchange'],
        ];
    }
}
