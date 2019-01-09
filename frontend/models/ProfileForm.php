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
            [['birthday'], 'safe'],
            [['sex'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'nickname'   => Yii::t('vi', 'Tên'),
            'birthday'   => Yii::t('vi', 'Ngày sinh'),
            'sex'        => Yii::t('vi', 'Giới tính'),
            'sex_string' => Yii::t('vi', 'Giới tính'),
            'email'      => Yii::t('vi', 'Email')
        ];
    }


    public function update() {
        if ( !$this->validate() ) {
            return false;
        }

        $this->updateUser();

        return true;
    }

    private function updateUser()
    {
        $model = $this->findModel($this->id);
        $model->nickname = $this->nickname;
        $model->birthday = $this->birthday;
        if ($this->sex == 0 || $this->sex == 1) {
            $model->sex = $this->sex;
        } else {
            $model->sex = 0;
        }

        $model->save();

        return $model;
    }

    protected function findModel( $id ) {
        if ( ( $model = User::findOne( $id ) ) !== null ) {
            return $model;
        } else {
            throw new NotFoundHttpException( 'The requested page does not exist.' );
        }
    }
}