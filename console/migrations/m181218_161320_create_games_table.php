<?php

use yii\db\Migration;

/**
 * Handles the creation of table `games`.
 */
class m181218_161320_create_games_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('games', [
            'id' => $this->primaryKey(),
            'game_name' => $this->string(50)->notNull(),
            'game_description' => $this->text(),
            'game_path' => $this->string(1000),
            'status' => $this->smallInteger(5)->notNull(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('games');
    }
}
