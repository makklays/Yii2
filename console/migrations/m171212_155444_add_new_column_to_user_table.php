<?php

use yii\db\Migration;

/**
 * Handles adding new columns to table `user`.
 * template: mdate_time_add_blabla_column_to_blabla_table
 */
class m171212_155444_add_new_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'firstname', $this->string());
        $this->addColumn('user', 'lastname', $this->string());
        $this->addColumn('user', 'phone', $this->string());
        $this->addColumn('user', 'gender', $this->string());
        $this->addColumn('user', 'birthday', $this->string());
        $this->addColumn('user', 'photo', $this->string());
        $this->addColumn('user', 'aboutme', $this->text());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'firstname');
        $this->dropColumn('user', 'lastname');
        $this->dropColumn('user', 'phone');
        $this->dropColumn('user', 'gender');
        $this->dropColumn('user', 'birthday');
        $this->dropColumn('user', 'photo');
        $this->dropColumn('user', 'aboutme');
    }
}
