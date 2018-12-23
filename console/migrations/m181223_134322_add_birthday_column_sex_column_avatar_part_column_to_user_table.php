<?php

use yii\db\Migration;

/**
 * Handles adding birthday to table `user`.
 */
class m181223_134322_add_birthday_column_sex_column_avatar_part_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'birthday', 'date AFTER username');
        $this->addColumn('user', 'sex', 'varchar(3) AFTER username');
        $this->addColumn('user', 'avatar_part', 'text AFTER username');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'birthday');
        $this->dropColumn('user', 'sex');
        $this->dropColumn('user', 'avatar_part');
    }
}
