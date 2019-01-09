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
//                    'accept-friend-request' => ['POST'],
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
        $error = 1;
        if (Yii::$app->request->isAjax) {
            if( isset(Yii::$app->request->post()['value']) ) {
                $name = Yii::$app->request->post()['value'];
                if ( !is_array($name) && ($model = User::findOne([ 'username' => trim($name) ])) !== null ) {
                    $id = $model->id;
                    if(Relationship::addFriendRequest($id)) {
                        $error = 0;
                    }
                }
            }
        }
        if( $error == 1 ) {
            Yii::$app->session->setFlash('friend-error', '<ul><li>Người chơi không tồn tại</li></ul>');
        } else {
            Yii::$app->session->setFlash('friend-success', '<ul><li>Gửi yêu cầu kết bạn thành công</li></ul>');
        }
        return $this->redirect('/profile/index');
    }

    public function actionAcceptFriendRequest(){
        $error = 1;
        if (Yii::$app->request->isAjax) {
            if( isset(Yii::$app->request->post()['value']) ) {
                $id = Yii::$app->request->post()['value'];
                if(!is_array($id)) {
                    $error = 0;
                }
                if(!Relationship::acceptFriendRequest($id)){
                    $error = 1;
                }
            }
        }
        if( $error == 1 ) {
            Yii::$app->session->setFlash('friend-error', '<ul><li>Oops! Có lỗi xảy ra, hãy thử lại</li></ul>');
        } else {
            Yii::$app->session->setFlash('friend-success', '<ul><li>Kết bạn thành công</li></ul>');
        }
        return $this->redirect('/profile/index');
    }

    public function actionDeclineFriendRequest(){
        $error = 1;
        if (Yii::$app->request->isAjax) {
            if( isset(Yii::$app->request->post()['value']) ) {
                $id = Yii::$app->request->post()['value'];
                if(!is_array($id)) {
                    $error = 0;
                }
                if(!Relationship::declineFriendRequest($id)){
                    $error = 1;
                }
            }
        }
        if( $error == 1 ) {
            Yii::$app->session->setFlash('friend-error', '<ul><li>Oops! Có lỗi xảy ra, hãy thử lại</li></ul>');
        } else {
            Yii::$app->session->setFlash('friend-success', '<ul><li>Hủy yêu cầu kết bạn thành công</li></ul>');
        }
        return $this->redirect('/profile/index');
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
