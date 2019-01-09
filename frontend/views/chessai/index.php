<?php

/* @var $this yii\web\View */

$this->registerCssFile("/css/chess/chessboard-0.3.0.min.css");
// $this->registerCssFile("/css/chess/chess_game_page.css");

$this->registerJsFile("/js/jquery.min.js", [
    'position' => yii\web\View::POS_END
]);

$this->registerJsFile("/js/chess/chess.js", [
    'position' => yii\web\View::POS_END
]);

$this->registerJsFile("/js/chess/chessboard-0.3.0.min.js", [
    'position' => yii\web\View::POS_END
]);

$this->registerJsFile("/js/chess/chess_ai.js", [
    'position' => yii\web\View::POS_END
]);

?>

<body>
    <div id="board" class="board" style="width: 400px;"></div>
    <div class="info">
        Độ khó:
        <select id="search-depth">
            <option value="1">Dễ nhất</option>
            <option value="2">Dễ</option>
            <option value="3" selected>Vừa</option>
            <option value="4">Khó</option>
            <option value="5">Khó nhất</option>
        </select>
    </div>
    <div hidden>
        <br>
        <span>Positions evaluated: <span id="position-count"></span></span>
        <br>
        <span>Time: <span id="time"></span></span>
        <br>
        <span>Positions/s: <span id="positions-per-s"></span> </span>
        <br>
        <br>
        <div id="move-history" class="move-history">
        </div>
    </div>
</body>