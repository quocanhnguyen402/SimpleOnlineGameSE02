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
 * @property string $img_landscape
 * @property string $img_icon
 * @property string $img_thumbnail
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
            [['game_description', 'img_landscape', 'img_icon', 'img_thumbnail'], 'string'],
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
            'id' => Yii::t('app', 'ID'),
            'game_name' => Yii::t('app', 'Game Name'),
            'game_description' => Yii::t('app', 'Game Description'),
            'game_path' => Yii::t('app', 'Game Path'),
            'img_landscape' => Yii::t('app', 'Img Landscape'),
            'img_icon' => Yii::t('app', 'Img Icon'),
            'img_thumbnail' => Yii::t('app', 'Img Thumbnail'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
