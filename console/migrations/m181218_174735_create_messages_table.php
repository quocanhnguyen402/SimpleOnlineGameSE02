<?php

use yii\db\Migration;

/**
 * Handles the creation of table `messages`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `user`
 */
class m181218_174735_create_messages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('messages', [
            'id' => $this->primaryKey(),
            'from_id' => $this->integer(11)->notNull(),
            'to_id' => $this->integer(11)->notNull(),
            'message_body' => $this->text()->notNull(),
            'created_at' => $this->dateTime(),
        ]);

        // creates index for column `from_id`
        $this->createIndex(
            'idx-messages-from_id',
            'messages',
            'from_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-messages-from_id',
            'messages',
            'from_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `to_id`
        $this->createIndex(
            'idx-messages-to_id',
            'messages',
            'to_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-messages-to_id',
            'messages',
            'to_id',
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
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-messages-from_id',
            'messages'
        );

        // drops index for column `from_id`
        $this->dropIndex(
            'idx-messages-from_id',
            'messages'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-messages-to_id',
            'messages'
        );

        // drops index for column `to_id`
        $this->dropIndex(
            'idx-messages-to_id',
            'messages'
        );

        $this->dropTable('messages');
    }
}
