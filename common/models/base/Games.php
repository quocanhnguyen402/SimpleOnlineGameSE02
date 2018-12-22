<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "games".
 *
 * @property int $id
 * @property string $game_name
 * @property string $game_description
 * @property string $game_path
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 */
class Games extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'games';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['game_name', 'status'], 'required'],
            [['game_description'], 'string'],
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['game_name'], 'string', 'max' => 50],
            [['game_path'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common\messages\vi', 'ID'),
            'game_name' => Yii::t('common\messages\vi', 'Game Name'),
            'game_description' => Yii::t('common\messages\vi', 'Game Description'),
            'game_path' => Yii::t('common\messages\vi', 'Game Path'),
            'status' => Yii::t('common\messages\vi', 'Status'),
            'created_at' => Yii::t('common\messages\vi', 'Created At'),
            'updated_at' => Yii::t('common\messages\vi', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\base\GamesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\base\GamesQuery(get_called_class());
    }
}
