<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerCss(
"#login-button{
        border-radius: 3px;
        background-color: #f26565;
        border: 0;
        color: #fff;
        font-size: 13px;
        font-weight: bold;
        margin: 15px 0;
        padding: 10px 20px;
        text-align: center;
        width: 100%;
        white-space: normal;
    }
    .padding-top{
        width:300px; 
        margin:10px auto; 
        text-align:left;
        font-size:11px;
    }
    "
);
?>

<!-- modal dialog for display pop up login -->
<div class="modal-dialog" style="width: 440px; height: 420px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" ><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title" id="myModalLabel">Login</h3>
        </div>
        <div class="modal-body">
            <!-- start ActiveForm -->
            <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableAjaxValidation' => true,]); ?>

            <div class="row padding-top" style="">
                <div class="col-md-12">
                    <div class="row"><label class="control-label" for="loginform-username">Username</label></div>
                    <div class="row">
                        <?= $form->field($model, 'username')->textInput(['autofocus' => false])->label(false) ?>
                    </div>

                    <div class="row"><label class="control-label" for="loginform-password">Password</label></div>
                    <div class="row">
                        <?= $form->field($model, 'password')->passwordInput()->label(false) ?>
                    </div>

                    <div class="row">
                        <?= Html::a('Forget password?', ['site/request-password-reset'], ['style'=>['float'=>'right']]) ?>
                        <?= $form->field($model, 'rememberMe')->checkbox() ?>
                    </div>

                    <div class="row">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'id' => 'login-button']) ?>
                    </div>
                </div>
            </div>

           <?php ActiveForm::end(); ?>

    </div>

    <div class="modal-footer">
        <p class="text-left" style="font-size: 11px">
            Don't have an account? <?= Html::a("Create an account", "javascript:void(0);",['onclick'=>"$('#loginModal').modal('hide');signup();return false;"])?>
        </p>
    </div>
</div>