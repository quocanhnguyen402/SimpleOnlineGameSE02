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
            'id' => Yii::t('vi', 'ID'),
            'game_name' => Yii::t('vi', 'Game Name'),
            'game_description' => Yii::t('vi', 'Game Description'),
            'game_path' => Yii::t('vi', 'Game Path'),
            'status' => Yii::t('vi', 'Status'),
            'created_at' => Yii::t('vi', 'Created At'),
            'updated_at' => Yii::t('vi', 'Updated At'),
        ];
    }

}
