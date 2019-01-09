<?php

namespace frontend\controllers;

use yii\web\Controller;

class ChessaiController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}