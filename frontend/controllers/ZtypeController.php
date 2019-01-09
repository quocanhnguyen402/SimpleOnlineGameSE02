<?php

namespace frontend\controllers;

use yii\web\Controller;

class ZtypeController extends Controller{
    public function actionIndex(){
        return $this->render('index');
    }
}