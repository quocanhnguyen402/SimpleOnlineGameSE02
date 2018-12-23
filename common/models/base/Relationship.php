<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "relationship".
 *
 * @property int $id
 * @property int $user_id
 * @property int $other_id
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 */
class Relationship extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'relationship';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'other_id', 'status'], 'required'],
            [['user_id', 'other_id', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('vi', 'ID'),
            'user_id' => Yii::t('vi', 'User ID'),
            'other_id' => Yii::t('vi', 'Other ID'),
            'status' => Yii::t('vi', 'Status'),
            'created_at' => Yii::t('vi', 'Created At'),
            'updated_at' => Yii::t('vi', 'Updated At'),
        ];
    }

}
