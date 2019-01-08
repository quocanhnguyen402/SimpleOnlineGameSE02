<?php
namespace frontend\controllers;

use common\models\Relationship;
use frontend\models\ProfileForm;
use Yii;
use yii\helpers\Html;
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
        if($identify == 0) {
            $identify = Yii::$app->user->identity->getId();
        }
        $user = $this->findModel($identify);
        $model = new ProfileForm();
        $model->id       = $user->id;
        if(!empty($user->nickname)) {
            $model->nickname = $user->nickname;
        } else {
            $model->nickname = $user->username;
        }
        $model->birthday = $user->birthday;
        $model->sex      = $user->sex;
        if ($model->sex == 1) {
            $model->sex_string = Yii::t('vi', 'Nữ');
        } else {
            $model->sex_string = Yii::t('vi', 'Nam');
        }
        $model->email    = $user->email;

        if(Yii::$app->request->isAjax){
            return $this->renderAjax('_form_info_basic', [
                'model' => $model,
            ]);
        }

        if ($model->load(Yii::$app->request->post())) {
            if(!$model->update()) {
                Yii::$app->session->setFlash('profile-error', Html::errorSummary($model, ['header' => '<i class="icon fa fa-times-circle"></i>' . Yii::t("vi", "Lỗi") . ': ']));
            } else {
                Yii::$app->session->setFlash('profile-success', '<ul><li>' . Yii::t('vi','Lưu thông tin cá nhân thành công') . '</li></ul>');
            }
            return $this->redirect('profile');
        }

        $friendArea = [
            'friend'  => $this->getList('friend'),
            'request' => $this->getList('request'),
            'block'   => $this->getList('block'),
        ];

        return $this->render('index', [
            'model' => $model,
            'friendArea' => $friendArea,
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

    private function getList($listType) {
        $listFriend = [];

        if($listType == 'friend') {
            $arrFriend = Relationship::getFriendsList();
        } elseif ($listType == 'request') {
            $arrFriend = Relationship::getFriendsRequest();
        } elseif ($listType == 'block') {
            $arrFriend = Relationship::getBlackList();
        } else {
            $arrFriend = [];
        }

        foreach ($arrFriend as $friend) {
            $friendId = $friend->other_id;
            if( ($model = User::findOne( ['id' => $friendId] )) !== null ) {
                if ( !empty($model->nickname) ) {
                    $friendName = $model->nickname;
                } else {
                    $friendName = $model->username;
                }
                $friendAvatar = $model->avatar_part;
                $friendItem = [
                    'id'   => $friendId,
                    'name' => $friendName,
                    'part' => $friendAvatar
                ];
                $listFriend[] = $friendItem;
            }
        }

        return $listFriend;
    }
}
