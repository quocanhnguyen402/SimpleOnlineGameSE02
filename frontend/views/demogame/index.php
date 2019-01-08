<?php

    /* @var $this yii\web\View */

    $this->registerJsFile("/js/jquery.min.js", [
        'position' => yii\web\View::POS_END
    ]);

    $this->registerJsFile( "/js/socket.io.js",[
        'position' => yii\web\View::POS_END
    ]);

    $this->registerJsFile("/js/ztype/ztype_page.js", [
        'position' => yii\web\View::POS_END
    ]);

    $this->registerJsFile("/js/ztype/ZType.js", [
        'position' => yii\web\View::POS_END
    ]);

    $this->registerJsFile("/js/ztype/Asteroid.js", [
        'position' => yii\web\View::POS_END
    ]);
?>

<body>
    <div style="margin: auto auto;width: 1000px;">
        <table style="border: none">
            <tr>
                <td style="margin-left:40px" rowspan="2">
                    <div id="play_ground"></div>
                </td>
                <td style="height: 350px;width: 500px;text-align: center">
                    <b>Leader Board</b><br>
                    <table id="leaderboard" style="width: 50%;border: 1px solid;margin-left: 25%">
                    </table>
                </td>
            </tr>
            <tr>
                <td style="text-align: center">
                    <input type="button" name="" id="start" value="Start">
                    <div id="name_input" hidden>
                        <input type="text" placeholder="Enter your name" id="player_name">
                        <button id="submit_player">Submit</button>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>