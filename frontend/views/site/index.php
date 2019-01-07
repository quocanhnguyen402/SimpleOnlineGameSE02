<?php

/* @var $this yii\web\View */

$this->registerJsFile("/socket.io/socket.io.js", [
        'position' => \yii\web\View::POS_END
]);

$this->registerJsFile("/js/game.js", [
    'position' => \yii\web\View::POS_END
]);

?>


<div class="site-body">
    <div class="container">

        <?php echo  $this->render('_game-list') ?>

    </div>
</div>
