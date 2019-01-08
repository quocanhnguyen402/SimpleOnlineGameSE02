<?php

/* @var $this yii\web\View */

$this->registerCssFile("/css/chess/chessboard-0.3.0.min.css");
// $this->registerCssFile("/css/chess/chess_game_page.css");

$this->registerJsFile("/js/chess/chess.js", [
    'position' => yii\web\View::POS_END
]);

$this->registerJsFile("/js/chess/chessboard-0.3.0.min.js", [
    'position' => yii\web\View::POS_END
]);

$this->registerJsFile("/js/jquery.min.js", [
    'position' => yii\web\View::POS_END
]);

$this->registerJsFile("/js/socket.io.js", [
    'position' => yii\web\View::POS_END
]);

$this->registerJsFile("/js/chess/chess_game_page.js", [
    'position' => yii\web\View::POS_END
]);

?>

<div style="margin: 0 auto;">
    <div id="create_or_join_game">
        <div style="margin: 0 auto;">
            <button id="btn_create">Create a room</button>
            <button id="btn_show_join_form">Join a room</button>
        </div>
        <div hidden id="join_form">
            <input type="text" id="room_id">
            <button id="btn_join">Join</button>
        </div>
    </div>
    <div id="room_info"></div>
    <div id="gameboard" hidden></div>
</div>