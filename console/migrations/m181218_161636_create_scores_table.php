<?php

use yii\db\Migration;

/**
 * Handles the creation of table `scores`.
 * Has foreign keys to the tables:
 *
 * - `games`
 * - `user`
 */
class m181218_161636_create_scores_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('scores', [
            'id' => $this->primaryKey(),
            'game_id' => $this->integer(11)->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'score' => $this->integer(11)->notNull(),
            'status' => $this->smallInteger(5)->notNull(),
            'created_at' => $this->dateTime(),
        ]);

        // creates index for column `game_id`
        $this->createIndex(
            'idx-scores-game_id',
            'scores',
            'game_id'
        );

        // add foreign key for table `games`
        $this->addForeignKey(
            'fk-scores-game_id',
            'scores',
            'game_id',
            'games',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-scores-user_id',
            'scores',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-scores-user_id',
            'scores',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `games`
        $this->dropForeignKey(
            'fk-scores-game_id',
            'scores'
        );

        // drops index for column `game_id`
        $this->dropIndex(
            'idx-scores-game_id',
            'scores'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-scores-user_id',
            'scores'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-scores-user_id',
            'scores'
        );

        $this->dropTable('scores');
    }
}
