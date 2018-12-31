<?php
namespace frontend\controllers;

use frontend\models\ProfileForm;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use common\models\User;

/* @var $model User */

/**
 * Profile controller
 */
class ProfileController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // ...
                ],
                'denyCallback' => function () {
                    return Yii::$app->response->redirect(['site/login']);
                },
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'edit-profile'      => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays profile.
     *
     * @throws NotFoundHttpException if the model cannot be found
     * @return mixed
     */
    public function actionIndex($identify = 0)
    {
        $key = '';
        if($identify == 0) {
            $identify = Yii::$app->user->identity->getId();
        }
        $user = $this->findModel($identify);
        $model = new ProfileForm();
        $model->id       = $user->id;
        $model->username = $user->username;
        $model->birthday = $user->birthday;
        $model->sex      = $user->sex;
        if ($model->sex == 1) {
            $model->sex_string = Yii::t('vi', 'Nữ');
        } else {
            $model->sex_string = Yii::t('vi', 'Nam');
        }
        $model->email    = $user->email;

        if(Yii::$app->request->isAjax){
            $key = Yii::$app->request->post()['value'];
        }
        if($key == '10') {
            return $this->renderAjax('_form_info_basic', [
                'model' => $model,
            ]);
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->update();
            return $this->redirect('profile');
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
