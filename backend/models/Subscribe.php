<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "subscribe".
 *
 * @property integer $id
 * @property string $uname
 * @property string $email
 * @property integer $is_subscribe
 * @property integer $added
 * @property string $ip
 */
class Subscribe extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subscribe';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['added'], 'safe'],
            [['is_subscribe', 'added'], 'integer'],
            [['uname'], 'string', 'max' => 255],
            [['ip'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uname' => 'Name',
            'email' => 'E-mail',
            'is_subscribe' => 'Is Subscribe',
            'added' => 'Date',
            'ip' => 'IP',
        ];
    }
}
