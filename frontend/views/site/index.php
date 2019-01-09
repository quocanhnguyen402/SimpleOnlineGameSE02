<?php
use yii\widgets\ListView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$showGameDetail = <<< SCRIPT
var sleep;
$('#modal').on('hidden.bs.modal', function(hideEvt) {
    $(".modal-body").html("");
})
$('.play-game').on('click', function(play){
    var value = $(this).parent().attr('id').replace('g-','');
    location.replace('/games/play?game=' + value);
})
$('.game-thumbnail').on('click', function(e) {
    var value = $(this).parent().attr('id').replace('g-','');
    $.ajax({
        type: "POST",
        data: {value:value},
        url: "/games/show-detail",
        success: function(data){
            if(data != '') {
                $(".modal-body").html(data);
                $('#modal').modal('show');
            } else {
                $(".modal-body").html("<h3>Oops! something went wrong</h3>");
                $('#modal').modal('show');
                sleep = setTimeout(function(){
                    $('#modal').modal("hide");
                }, 1000);
            }
        },
        error: function(data){
            $(".modal-body").html("<h3>Oops! something went wrong</h3>");
            $('#modal').modal('show');
            sleep = setTimeout(function(){
                $('#modal').modal("hide");
            }, 1000);
        }
    });
})
$(document).on('hidden.bs.modal','#modal', function () {
    clearTimeout(sleep);
})
SCRIPT;


$this->registerJsFile("/js/socket.io.js", [
        'position' => \yii\web\View::POS_END
]);

$this->registerJsFile("/js/game.js", [
    'position' => \yii\web\View::POS_END
]);
$this->registerJs($showGameDetail, \yii\web\View::POS_END);

?>

<div class="site-body">
    <div class="container">

        <?php echo ListView::widget([
            'dataProvider'  => $dataProvider,
            'itemView'      => '_game-list'
        ]); ?>

    </div>
</div>

<?php Modal::begin([
    'closeButton' => false,
    'size'        => 'modal-lg',
    'id'          => 'modal',
]) ?>
<?php Modal::end(); ?>