<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\SignupForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerCss(
"#signup-button{
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
            <h3 class="modal-title" id="myModalLabel">Signup</h3>
        </div>
        <div class="modal-body">
            <!-- start ActiveForm -->
            <?php $form = ActiveForm::begin(['id' => 'form-signup', 'enableAjaxValidation' => true,]); ?>

            <div class="row padding-top" style="">
                <div class="col-md-12">
                    <div class="row"><label class="control-label" for="signupform-username">Username</label></div>
                    <div class="row">
                        <?= $form->field($model, 'username')->textInput(['autofocus' => false])->label(false) ?>
                    </div>

                    <div class="row"><label class="control-label" for="signupform-email">Email</label></div>
                    <div class="row">
                        <?= $form->field($model, 'email')->label(false) ?>
                    </div>

                    <div class="row"><label class="control-label" for="signupform-password">Password</label></div>
                    <div class="row">
                        <?= $form->field($model, 'password')->passwordInput()->label(false) ?>
                    </div>

                    <div class="row">
                        <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'id' => 'signup-button']) ?>
                    </div>
                </div>
            </div>

           <?php ActiveForm::end(); ?>

    </div>

    <div class="modal-footer">
        <p class="text-left" style="font-size: 11px">
            Already have an account? <?= Html::a("Login", "javascript:void(0);",['onclick'=>"$('#signupModal').modal('hide'); login(); return false;"])?>
        </p>
    </div>
</div>