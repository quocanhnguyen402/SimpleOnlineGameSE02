<?php

use yii\db\Migration;

/**
 * Class m181231_170304_convert_sex_column_to_tinyint_from_user_table
 */
class m181231_170304_convert_sex_column_to_tinyint_from_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('user','sex','boolean');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'sex');
        $this->addColumn('user', 'sex', 'varchar(3) AFTER username');
    }
}
