<?php

use yii\db\Migration;

/**
 * Class m190109_153743_convert_to_utf8
 */
class m190109_153743_convert_to_utf8 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('ALTER TABLE messages CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190109_153743_convert_to_utf8 cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190109_153743_convert_to_utf8 cannot be reverted.\n";

        return false;
    }
    */
}
