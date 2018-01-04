<?php

namespace backend\models;

use Yii; //
use backend\models\Post; //

/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property integer $frequency
 * @property string $name
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['frequency'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'frequency' => 'Frequency',
            'name' => 'Name',
        ];
    }

    /**
     * Связываем таблицу tag с таблицей post через связывающую таблицу post_tag
     * (в контроллере можем использовать как array $tag->posts, где $tag = Tag::findOne($id); )
     *
     * @return $this
     */
    public function getPosts()
    {
        return $this
            ->hasMany(Post::className(), ['id' => 'post_id'])
            ->viaTable('post_tag', ['tag_id' => 'id']);
    }
}
