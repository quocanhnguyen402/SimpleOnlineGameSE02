<?php

use yii\db\Migration;

/**
 * Handles adding nickname to table `user`.
 */
class m190101_151639_add_nickname_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'nickname', 'string AFTER username');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'nickname');
    }
}
