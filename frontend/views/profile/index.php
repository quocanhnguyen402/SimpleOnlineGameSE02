<?php
/* @var $model \common\models\User */

$this->registerCssFile('@web/css/profile.css', ['depends' => [common\assets\AdminLte::className()]]);
$this->registerCssFile('@web/css/beauty_textselect.css', ['depends' => [common\assets\AdminLte::className()]]);
$this->registerJsFile('@web/js/profile.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="profile-body">
    <div class="profile-container">
        <?php if ( Yii::$app->session->hasFlash( 'error' ) ): ?>
            <div class="alert flash-error">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <?php echo Yii::$app->session->getFlash( 'error' ) ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-7">
                <?php echo $this->render( '_info_basic', ['model' => $model] ) ?>
                <?php echo $this->render( '_info_score' ) ?>
            </div>
            <div class="col-md-5">
                <?php echo $this->render( '_info_friend' ) ?>
            </div>
        </div>
    </div>
</div>
