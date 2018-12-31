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
            'id' => Yii::t('vi', 'ID'),
            'game_id' => Yii::t('vi', 'Game ID'),
            'user_id' => Yii::t('vi', 'User ID'),
            'score' => Yii::t('vi', 'Score'),
            'status' => Yii::t('vi', 'Status'),
            'created_at' => Yii::t('vi', 'Created At'),
        ];
    }

}
