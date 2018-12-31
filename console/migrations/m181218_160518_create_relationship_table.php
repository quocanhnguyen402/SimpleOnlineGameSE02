<?php

use yii\db\Migration;

/**
 * Handles the creation of table `relationship`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `user`
 */
class m181218_160518_create_relationship_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('relationship', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->notNull(),
            'other_id' => $this->integer(11)->notNull(),
            'status' => $this->smallInteger(5)->notNull(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-relationship-user_id',
            'relationship',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-relationship-user_id',
            'relationship',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `other_id`
        $this->createIndex(
            'idx-relationship-other_id',
            'relationship',
            'other_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-relationship-other_id',
            'relationship',
            'other_id',
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
            'fk-relationship-user_id',
            'relationship'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-relationship-user_id',
            'relationship'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-relationship-other_id',
            'relationship'
        );

        // drops index for column `other_id`
        $this->dropIndex(
            'idx-relationship-other_id',
            'relationship'
        );

        $this->dropTable('relationship');
    }
}
