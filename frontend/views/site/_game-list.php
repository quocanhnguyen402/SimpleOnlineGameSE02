<?php

/* @var $model common\models\Games */
?>

<div id="g-<?php echo $model->id ?>" class="item grid-item game-item">
    <div class="game-thumbnail">
        <div class="roll"><span class="roll-content game-title">
                <p><?php echo $model->game_name ?></p>
                <p class="text-small">Xem chi tiết</p>
            </span></div>
        <img class="img" src="<?php echo $model->img_thumbnail ?>">
    </div>
    <button type="button" class="flat-btn play-game">PLAY&nbsp;&nbsp;<span class="fa fa-play"></span></button>
</div>
