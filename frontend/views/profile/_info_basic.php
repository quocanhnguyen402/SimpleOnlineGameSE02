<?php
/* @var $model \common\models\User */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="col-md-12 table-responsive">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="pull-left">
                <i class="fa fa-info-circle text-success"></i>
                &nbsp;<?php echo Yii::t('vi', 'Thông tin cơ bản') ?>
            </h3>
            <h3 class="pull-right">
                <?php echo Html::Button(Yii::t('vi', 'Chỉnh sửa thông tin'), ['class' => 'btn btn-primary btn-change-request']) ?>
                <?php echo Html::submitButton(Yii::t('vi', 'Lưu thông tin'), ['class' => 'btn btn-danger btn-save']) ?>
            </h3>
        </div>

        <div class="box-body">
            <div class="col-md-12 basic-info">
                <div class="profile-avatar w3-center">
                    <img class="img" src="https://png.pngtree.com/svg/20161027/service_default_avatar_182956.png">
                    <?php echo Html::button(Yii::t('vi', 'Đổi ảnh đại diện'), ['class' => 'btn btn-default btn-avatar']) ?>
                </div>
                <div class="profile-info">
                    <div class="table">
                        <div class="table-row">
                            <div class="table-cell"><?php echo Yii::t('vi', 'Username') ?></div>
                            <div class="table-cell"><?php echo $form->field($model, 'username')->textInput()->label(false) ?></div>
                        </div>
                        <div class="table-row">
                            <div class="table-cell"><?php echo Yii::t('vi', 'Ngày sinh') ?></div>
                            <div class="table-cell"><?php echo $form->field($model, 'birthday')->textInput()->label(false) ?></div>
                        </div>
                        <div class="table-row">
                            <div class="table-cell"><?php echo Yii::t('vi', 'Giới tính') ?></div>
                            <div class="table-cell"><?php echo $form->field($model, 'sex')->textInput()->label(false) ?></div>
                        </div>
                        <div class="table-row">
                            <div class="table-cell"><?php echo Yii::t('vi', 'Email') ?></div>
                            <div class="table-cell"><?php echo $form->field($model, 'email')->textInput()->label(false) ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
