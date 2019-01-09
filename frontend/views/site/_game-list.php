<?php

/* @var $model common\models\Games */
?>

<div id="g-<?php echo $model->id ?>" class="item grid-item game-item">
    <div class="game-thumbnail">
        <div class="roll"><span class="roll-content game-title"><?php echo $model->game_name ?></span></div>
        <img class="img" src="<?php echo $model->img_thumbnail ?>">
    </div>
</div>
