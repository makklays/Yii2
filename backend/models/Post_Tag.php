<?php

namespace backend\models;

use Yii; //
use common\models\User; //
use backend\models\Category; //
use yii\db\ActiveRecord;
use backend\models\Tag; //

class Post_Tag extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_tag';
    }

    public function getTags()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }

    public function getPosts()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }
}
