<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $short_descr
 * @property string $description
 * @property string $imgs
 * @property integer $views
 * @property integer $category_id
 * @property integer $is_active
 * @property string $slug
 * @property integer $added
 * @property integer $modified
 */
class Post extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'post';
    }

    public function behaviors()
    {
        /*return [
            'slug' => [
                'class' => 'common\behaviors\Slug',
                'in_attribute' => 'title',
                'out_attribute' => 'slug',
                'translit' => true,
            ]
        ];*/

        return [
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
            ],
        ];
    }

    public function rules()
    {
        return [
            //[['id'], 'integer'],
            //[['user_id'], 'integer'],
            [['title', 'slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['short_descr'], 'string'],
            [['description'], 'string'],
            [['is_active'], 'string'],
            [['category_id'], 'integer'],
            //[['added'], 'string'],
            [['modified'], 'string'],
            //[['imgs'], 'file', 'maxFiles' => 4],

        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'ID User',
            'title' => Yii::t('main', 'Title'),
            'slug' => Yii::t('main', 'Slug'),
            'short_descr' => Yii::t('main', 'Short Description'),
            'description' => Yii::t('main', 'Description'),
            'imgs' => Yii::t('main','Upload images'),
            'views' => Yii::t('main','Views'),
            'is_active' => Yii::t('main','Active'),
            'category_id' => Yii::t('main','Category'),
            //'added' => 'Added',
            'modified' => Yii::t('main','Date'),
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}
