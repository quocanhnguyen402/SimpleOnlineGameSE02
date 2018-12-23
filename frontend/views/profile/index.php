<?php
/* @var $model \common\models\User */

$this->registerCssFile('@web/css/profile.css', ['depends' => [common\assets\AdminLte::className()]]);
?>

<div class="profile-body">
    <div class="profile-container">
        <div class="row">
            <div class="col-md-7">
                <?php echo $this->render( '_info_basic', ['model' => $model] ) ?>
                <?php echo $this->render( '_info_score' ) ?>
            </div>
            <div class="col-md-5">
                <?php echo $this->render( '_info_friend_request' ) ?>
            </div>
        </div>
    </div>
</div>
