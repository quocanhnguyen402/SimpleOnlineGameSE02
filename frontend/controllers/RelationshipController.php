<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use common\models\Relationship;
use common\models\User;

/**
 * Relationship controller
 */
class RelationshipController extends Controller
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
                    'add-friend-request' => ['POST'],
                    'accept-friend-request' => ['POST'],
                    'decline-friend-request' => ['POST'],
                    'un-friend' => ['POST'],
                    'block' => ['POST'],
                    'un-block' => ['POST'],
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

    public function actionAddFriendRequest(){
        if (Yii::$app->request->isAjax) {
            if( isset(Yii::$app->request->post()['value']) ) {
                $id = Yii::$app->request->post()['value'];
                if(is_array($id) || !Relationship::addFriendRequest($id)) {
                    // do something
                    return null;
                }
                return $this->redirect('/profile/index');
            }
            return null;
        }
        return null;
    }

    public function actionAcceptFriendRequest(){
        if (Yii::$app->request->isAjax) {
            if( isset(Yii::$app->request->post()['value']) ) {
                $id = Yii::$app->request->post()['value'];
                if(is_array($id) || !Relationship::acceptFriendRequest($id)) {
                    // do something
                    return null;
                }
                return $this->redirect('/profile/index');
            }
            return null;
        }
        return null;
    }

    public function actionDeclineFriendRequest(){
        if (Yii::$app->request->isAjax) {
            if( isset(Yii::$app->request->post()['value']) ) {
                $id = Yii::$app->request->post()['value'];
                if(is_array($id) || !Relationship::declineFriendRequest($id)) {
                    // do something
                    return null;
                }
                return $this->redirect('/profile/index');
            }
            return null;
        }
        return null;
    }

    public function actionUnFriend(){
        if (Yii::$app->request->isAjax) {
            if( isset(Yii::$app->request->post()['value']) ) {
                $id = Yii::$app->request->post()['value'];
                if(is_array($id) || !Relationship::unfriend($id)) {
                    // do something
                    return null;
                }
                return $this->redirect('/profile/index');
            }
            return null;
        }
        return null;
    }

    public function actionBlock(){
        if (Yii::$app->request->isAjax) {
            if( isset(Yii::$app->request->post()['value']) ) {
                $id = Yii::$app->request->post()['value'];
                if(is_array($id) || !Relationship::block($id)) {
                    // do something
                    return null;
                }
                return $this->redirect('/profile/index');
            }
            return null;
        }
        return null;
    }

    public function actionUnBlock(){
        if (Yii::$app->request->isAjax) {
            if( isset(Yii::$app->request->post()['value']) ) {
                $id = Yii::$app->request->post()['value'];
                if(is_array($id) || !Relationship::unblock($id)) {
                    // do something
                    return null;
                }
                return $this->redirect('/profile/index');
            }
            return null;
        }
        return null;
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
