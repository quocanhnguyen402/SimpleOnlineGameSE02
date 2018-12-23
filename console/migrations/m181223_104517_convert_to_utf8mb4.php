<?php

use yii\db\Migration;

/**
 * Class m181223_104517_a
 */
class m181223_104517_convert_to_utf8mb4 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('ALTER TABLE games CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181223_104517_a cannot be reverted.\n";

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181223_104517_a cannot be reverted.\n";

        return false;
    }
    */
}
