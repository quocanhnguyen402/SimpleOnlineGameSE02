<?php
/* @var $model \frontend\models\ProfileForm */

use yii\helpers\Html;
?>
<div class="col-md-12 table-responsive info-basic">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="pull-left">
                <i class="fa fa-info-circle text-success"></i>
                &nbsp;<?php echo Yii::t('vi', 'Thông tin cơ bản') ?>
            </h3>
            <h3 class="pull-right">
                <?php echo Html::Button(Yii::t('vi', 'Chỉnh sửa thông tin'), ['class' => 'btn btn-primary btn-change-request']) ?>
            </h3>
        </div>

        <?php if ( Yii::$app->session->hasFlash( 'profile-error' ) ): ?>
            <div class="alert flash-error">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <?php echo Yii::$app->session->getFlash( 'profile-error' ) ?>
            </div>
        <?php endif; ?>
        <?php if ( Yii::$app->session->hasFlash( 'profile-success' ) ): ?>
            <div class="alert flash-success">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <?php echo Yii::$app->session->getFlash( 'profile-success' ) ?>
            </div>
        <?php endif; ?>

        <div class="box-body">
            <div class="col-md-12 basic-info">
                <div class="profile-avatar w3-center">
                    <img class="img" src="https://png.pngtree.com/svg/20161027/service_default_avatar_182956.png">
                    <?php echo Html::button(Yii::t('vi', 'Đổi ảnh đại diện'), ['class' => 'btn btn-default btn-avatar']) ?>
                </div>

                <div class="profile-info">
                    <div class="table">
                        <div class="table-row">
                            <div class="table-cell"><?php echo Yii::t('vi', 'Tên') ?></div>
                            <div class="table-cell">: <?php echo $model->nickname ?></div>
                        </div>
                        <div class="table-row">
                            <div class="table-cell"><?php echo Yii::t('vi', 'Ngày sinh') ?></div>
                            <div class="table-cell">: <?php echo $model->birthday ?></div>
                        </div>
                        <div class="table-row">
                            <div class="table-cell"><?php echo Yii::t('vi', 'Giới tính') ?></div>
                            <div class="table-cell">: <?php echo $model->sex_string ?></div>
                        </div>
                        <div class="table-row">
                            <div class="table-cell"><?php echo Yii::t('vi', 'Email') ?></div>
                            <div class="table-cell">: <?php echo $model->email ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
