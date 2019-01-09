<?php
/* @var $model \common\models\User */
/* @var $friendArea \frontend\controllers\ProfileController::actionIndex() */

use yii\bootstrap\Modal;

$this->registerCssFile('@web/css/profile.css', ['depends' => [common\assets\AdminLte::className()]]);
$this->registerCssFile('@web/css/beauty_textselect.css', ['depends' => [common\assets\AdminLte::className()]]);
$this->registerJsFile('@web/js/profile.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="profile-body">
    <div class="profile-container">
        <div class="row">
            <div class="col-md-7">
                <?php echo $this->render( '_info_basic', [ 'model' => $model ] ) ?>
                <?php echo $this->render( '_info_score' ) ?>
            </div>
            <div class="col-md-5">
                <?php echo $this->render( '_info_friend', [ 'friendArea' => $friendArea ] ) ?>
            </div>
        </div>
    </div>
</div>
<?php Modal::begin([
    'closeButton' => false,
    'size'        => 'modal-sm',
    'id'          => 'add-friend',
]) ?>
<div class="text-label">Thêm bạn:&nbsp;</div>
<div class="search">
    <input type="text" name="search-box">
    <span class="btn btn-add-friend fa fa-user-plus"></span>
</div>
<?php Modal::end(); ?>