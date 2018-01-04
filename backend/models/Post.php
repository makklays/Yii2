<?php

namespace backend\models;

use Yii;
use common\models\User;
use backend\models\Category;
use backend\models\Tag;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $short_descr
 * @property string $description
 * @property string $imgs
 * @property integer $added
 * @property integer $modified
 * @property integer $category_id
 * @property string $is_active
 */
class Post extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['short_descr'], 'string'],
            [['description'], 'string'],
            //[['added'], 'string'],
            [['modified'], 'string'],
            //[['imgs'], 'file', 'maxFiles' => 4],
            [['title'], 'string', 'max' => 255],
            [['is_active'], 'safe'],
            [['category_id'], 'integer'],
            [['username'], 'safe'],
            [['tags'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Categoty ID',
            'title' => 'Title',
            'short_descr' => 'Short description',
            'description' => 'Description',
            'imgs' => 'Upload images',
            //'added' => 'Added',
            'modified' => 'Date modified',
            'is_active' => 'Active',
            'username' => 'Login',
            'tags' => 'Tags',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']); //, ['username']);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /*public function getPost_Tag() //
    {
        return $this->hasMany(\backend\models\Post_Tag::className(), ['post_id' => 'id']);
        //->hasOne(Tag::className(), ['id' => 'tag_id']);
    }*/

    public function getTags()
    {
        return $this
            ->hasMany(Tag::className(), ['id' => 'tag_id'])
            ->viaTable('post_tag', ['post_id' => 'id']);
    }
}
