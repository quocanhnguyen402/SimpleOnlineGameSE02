<?php
namespace frontend\models;

use Yii;
use yii\web\NotFoundHttpException;
use yii\base\Model;
use common\models\User;

/**
 * User model
 *
 * @property integer $id
 * @property string $nickname
 * @property integer $sex
 * @property string $sex_string
 * @property string $birthday
 * @property string $email
 */

class ProfileForm extends Model
{
    public $id;
    public $nickname;
    public $birthday;
    public $sex;
    public $sex_string;
    public $email;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['nickname', 'email'], 'required'],
            [['nickname', 'email'], 'filter', 'filter' => 'trim' ],
            [['nickname', 'email'], 'string', 'max' => 255],
            [['nickname', 'email'], 'unique'],
            [['birthday'], 'safe'],
            [['sex'], 'integer'],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [

        ];
    }


    public function update() {
        $model = $this->findModel($this->id);
        $model->nickname = $this->nickname;
        $model->birthday = $this->birthday;
        if ($this->sex == 0 || $this->sex == 1) {
            $model->sex = $this->sex;
        } else {
            $model->sex = 0;
        }
        $model->email    = $this->email;

        $model->save();
    }

    protected function findModel( $id ) {
        if ( ( $model = User::findOne( $id ) ) !== null ) {
            return $model;
        } else {
            throw new NotFoundHttpException( 'The requested page does not exist.' );
        }
    }
}