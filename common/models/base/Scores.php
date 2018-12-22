<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "scores".
 *
 * @property int $id
 * @property int $game_id
 * @property int $user_id
 * @property int $score
 * @property int $status
 * @property string $created_at
 */
class Scores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'scores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['game_id', 'user_id', 'score', 'status'], 'required'],
            [['game_id', 'user_id', 'score', 'status'], 'integer'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common\messages\vi', 'ID'),
            'game_id' => Yii::t('common\messages\vi', 'Game ID'),
            'user_id' => Yii::t('common\messages\vi', 'User ID'),
            'score' => Yii::t('common\messages\vi', 'Score'),
            'status' => Yii::t('common\messages\vi', 'Status'),
            'created_at' => Yii::t('common\messages\vi', 'Created At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\base\ScoresQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\base\ScoresQuery(get_called_class());
    }
}
