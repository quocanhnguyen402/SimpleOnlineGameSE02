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
        $error = 1;
        if (Yii::$app->request->isAjax) {
            if( isset(Yii::$app->request->post()['value']) ) {
                $id = Yii::$app->request->post()['value'];
                if(Relationship::addFriendRequest($id)) {
                    $error = 0;
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
        $error = 1;
        if (Yii::$app->request->isAjax) {
            if( isset(Yii::$app->request->post()['value']) ) {
                $id = Yii::$app->request->post()['value'];
                if(!is_array($id)) {
                    $error = 0;
                }
                if(!Relationship::unfriend($id)){
                    $error = 1;
                }
            }
        }
        if( $error == 1 ) {
            Yii::$app->session->setFlash('friend-error', '<ul><li>Oops! Có lỗi xảy ra, hãy thử lại</li></ul>');
        } else {
            Yii::$app->session->setFlash('friend-success', '<ul><li>Hủy kết bạn thành công</li></ul>');
        }
        return $this->redirect('/profile/index');
    }

    public function actionBlock(){
        $error = 1;
        if (Yii::$app->request->isAjax) {
            if( isset(Yii::$app->request->post()['value']) ) {
                $id = Yii::$app->request->post()['value'];
                if(!is_array($id)) {
                    $error = 0;
                }
                if(!Relationship::block($id)){
                    $error = 1;
                }
            }
        }
        if( $error == 1 ) {
            Yii::$app->session->setFlash('friend-error', '<ul><li>Oops! Có lỗi xảy ra, hãy thử lại</li></ul>');
        } else {
            Yii::$app->session->setFlash('friend-success', '<ul><li>Chặn thành công</li></ul>');
        }
        return $this->redirect('/profile/index');
    }

    public function actionUnBlock(){
        $error = 1;
        if (Yii::$app->request->isAjax) {
            if( isset(Yii::$app->request->post()['value']) ) {
                $id = Yii::$app->request->post()['value'];
                if(!is_array($id)) {
                    $error = 0;
                }
                if(!Relationship::unblock($id)){
                    $error = 1;
                }
            }
        }
        if( $error == 1 ) {
            Yii::$app->session->setFlash('friend-error', '<ul><li>Oops! Có lỗi xảy ra, hãy thử lại</li></ul>');
        } else {
            Yii::$app->session->setFlash('friend-success', '<ul><li>Hủy chặn thành công</li></ul>');
        }
        return $this->redirect('/profile/index');
    }

    public function actionGetFriendSearch() {
        $error = 1;
        if(Yii::$app->request->isAjax) {
            if( isset(Yii::$app->request->post()['value']) ) {
                $text = Yii::$app->request->post()['value'];
                if(!is_array($text)) {
//                    $text = 'adm';
                    $error = 0;
                    if( ($model = User::find()->where(['like', 'username', $text])->asArray()->all()) !== null ) {
                        return $this->renderAjax('/profile/_list_search', ['listFriend' => $model]);
                    }
                }
            }
        }
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
