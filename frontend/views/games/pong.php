<?php

/* @var $this yii\web\View */

$this->registerJsFile("/js/jquery.min.js", [
    'position' => yii\web\View::POS_END
]);

$this->registerJsFile("/js/socket.io.js", [
    'position' => yii\web\View::POS_END
]);

$this->registerJsFile("/js/p5min.js", [
    'position' => yii\web\View::POS_END
]);

$this->registerJsFile("/js/pong/handle_room.js", [
    'position' => yii\web\View::POS_END
]);

$this->registerJsFile("/js/pong/pong_game_script.js", [
    'position' => yii\web\View::POS_END
]);

?>

<body>
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
        <div id="play_ground" style="width: 600px;" hidden></div>
    </div>
    </div>
</body>