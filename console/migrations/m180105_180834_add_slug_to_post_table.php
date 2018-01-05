<?php

use yii\db\Migration;
use common\models\Post;

/**
 * Class m180105_180834_add_slug_to_post_table
 */
class m180105_180834_add_slug_to_post_table extends Migration
{
    /* // для транзакций (несколько запросов)
    public function safeUp()
    {
    }

    public function safeDown()
    {
        echo "m180105_180834_add_slug_to_post_table cannot be reverted.\n";
        return false;
    }*/

    // Use up()/down() to run migration code without a transaction.
    /**
     * @inheritdoc
     */
    public function up()
    {
        //$this->addColumn('post', 'slug', $this->string());

        Yii::$app->db
            ->createCommand('ALTER TABLE `post` ADD COLUMN `slug` VARCHAR(255) AFTER `title` ')
            ->execute();

        $posts = Yii::$app->db->createCommand('SELECT * FROM `post`')->queryAll();

        if (isset($posts) && !empty($posts)) {

            //Yii::$app->echo->pre($posts, 1);

            foreach($posts as $post) {
                Yii::$app->db
                    ->createCommand('UPDATE `post` SET `slug`="' . Yii::$app->slug->text($post['title']) . '" WHERE `id`=' . $post['id'])
                    ->execute();
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        echo "m180105_180834_add_slug_to_post_table cannot be reverted.\n";

        //$this->dropColumn('post', 'slug');

        Yii::$app->db
            ->createCommand('ALTER TABLE `post` DROP COLUMN `slug` ')
            ->execute();

        return false;
    }
}
