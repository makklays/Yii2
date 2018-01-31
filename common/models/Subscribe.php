<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "subscribe".
 *
 * @property integer $id
 * @property string $uname
 * @property string $email
 * @property integer $is_subscribe
 * @property string $ip
 * @property string $added
 */
class Subscribe extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'subscribe';
    }

    public function rules()
    {
        return [
            [['uname'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 100],
            [['is_subscribe'], 'integer'],
            [['ip'], 'safe'],
            [['added'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uname' => 'User Name',
            'email' => 'E-mail',
            'is_subscribe' => 'Subscribe',
            'ip' => 'IP',
            'added' => 'Date',
        ];
    }
}
