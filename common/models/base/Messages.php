<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "messages".
 *
 * @property int $id
 * @property int $from_id
 * @property int $to_id
 * @property string $message_body
 * @property string $created_at
 */
class Messages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'messages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['from_id', 'to_id', 'message_body'], 'required'],
            [['from_id', 'to_id'], 'integer'],
            [['message_body'], 'string'],
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
            'from_id' => Yii::t('vi', 'From ID'),
            'to_id' => Yii::t('vi', 'To ID'),
            'message_body' => Yii::t('vi', 'Message Body'),
            'created_at' => Yii::t('vi', 'Created At'),
        ];
    }

}
