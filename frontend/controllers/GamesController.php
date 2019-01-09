<?php

namespace frontend\controllers;

use Yii;
use common\models\Games;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GamesController implements the CRUD actions for Games model.
 */
class GamesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'show-detail' => ['POST'],
                ],
            ],
        ];
    }

    public function actionShowDetail(){
        $gameId = 0;
        if (Yii::$app->request->isAjax) {
            if( isset(Yii::$app->request->post()['value']) ) {
                $gameId = Yii::$app->request->post()['value'];
                if(is_array($gameId)) {
                    return null;
                }
                $model = $this->findModel($gameId);
                return $this->renderAjax( '_game_description', [ 'model' => $model ] );
            }
            return null;
        }
        return null;
    }

    public function actionPlay($game = 0){
        $model = $this->findModel($game);
        return $this->render($model->game_path);
    }

    protected function actionChess(){
        return $this->render('chess');
    }

    /**
     * Finds the Games model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Games the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Games::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
