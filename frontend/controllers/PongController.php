<?php

namespace frontend\controllers;

use yii\web\Controller;

class PongController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}