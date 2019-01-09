<?php

/* @var $model common\models\Games */

$playBtn = <<< SCRIPT
$('.btn-play').on('click', function(play) {
    location.replace('/games/play?game=' + $(this).parent().parent().parent().attr("id"));
})
SCRIPT;
$this->registerJs($playBtn, yii\web\View::POS_END);
?>

<div class="game-description" id="<?php echo $model->id ?>">
    <div class="left-content">
        <div class="game-title-area">
            <div class="game-icon">
                <img src="<?php echo $model->img_icon ?>">
            </div>
            <div class="game-name">
                <div class="game-title"><?php echo $model->game_name ?></div>
            </div>
        </div>
        <div class="game-play-button">
            <button type="button" class="btn btn-default btn-play">PLAY&nbsp;&nbsp;<span class="fa fa-play"></span></button>
        </div>
    </div>
    <div class="right-content" style="background: url('<?php echo $model->img_landscape ?>')">
        <div class="a"></div>
        <div class="text-description"><?php echo $model->game_description ?></div>
    </div>
</div>