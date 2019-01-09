<?php

use yii\db\Migration;

/**
 * Handles adding image to table `games`.
 */
class m190108_165323_add_image_column_to_games_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('games', 'img_thumbnail', 'TEXT AFTER game_path');
        $this->addColumn('games', 'img_icon', 'TEXT AFTER game_path');
        $this->addColumn('games', 'img_landscape', 'TEXT AFTER game_path');    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('games', 'img_thumbnail');
        $this->dropColumn('games', 'img_icon');
        $this->dropColumn('games', 'img_landscape');
    }
}
