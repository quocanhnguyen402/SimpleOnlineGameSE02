<?php
use yii\helpers\Html;
/* @var $friendArea \frontend\controllers\ProfileController::actionIndex() */

$changeTab = <<< SCRIPT
$('.info-friend .tab').on('click', function(e){
    $('.info-friend-container .tab-content').css('display', 'none');
    $('.info-friend .tab').removeClass('w3-dark-grey');
    $(this).addClass('w3-dark-grey');
    var id = '#' + $(this).attr('id') + '-tab';
    $(id).css('display', 'block');
})
SCRIPT;
$searchFriendArea = <<< SCRIPT
$('.search input').on('keyup', function(e) {
    var input = $(this).val().toUpperCase();
    var list = $(this).parent().parent().find('.bar-item');
    for (i = 0; i < list.length; i++) {
        txtValue = list[i].textContent || list[i].innerText;
        if (txtValue.toUpperCase().indexOf(input) > -1) {
          list[i].style.display = "";
        } else {
          list[i].style.display = "none";
        }
    }
})
SCRIPT;
$option = <<< SCRIPT
$(document).on('click', function(e) {
	if(!e.target.matches('.bar-item') && !e.target.matches('.friend-avatar') && !e.target.matches('.friend-avatar img') && !e.target.matches('.friend-name')) {
	    $('.context-menu').remove();
	}
})
$('#friend-tab .bar-item').on('click', function(event) {
	var x = event.clientX - $(this).offset().left;
	var y = event.clientY - $(this).offset().top;
	$('.context-menu').remove();
	htmlString = '<div class="context-menu" style="display:none;left: ' + x + 'px; top: ' + y + 'px"><div class="context-menu-content" id="invite">Mời vào phòng</div><div class="context-menu-content" id="break">Hủy kết bạn</div><div class="context-menu-content" id="block">Chặn</div></div>';
	$(this).append(htmlString);
	if(($(this).width() - x) < $('.context-menu').width() + 10) {
	    $('.context-menu').css('left', x - $('.context-menu').width() + 'px');
	}
	if($('.list-friend').height() - (event.clientY - $('.list-friend').offset().top) < $('.context-menu').height() + 10) {
	    $('.context-menu').css('top', y - $('.context-menu').height() + 'px');
	}
	$('.context-menu').fadeIn(200);
})
SCRIPT;
$actionOption = <<< SCRIPT

SCRIPT;


$this->registerJs($changeTab, \yii\web\View::POS_END);
$this->registerJs($searchFriendArea, \yii\web\View::POS_END);
$this->registerJs($option, \yii\web\View::POS_END);
?>
<div class="col-md-12 table-responsive info-friend">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3>
                <i class="fa fa-users text-primary"></i>
                &nbsp;<?php echo Yii::t('vi', 'Bạn bè') ?>
                <a class="fa fa-external-link-square text-primary pull-right pointer"></a>
            </h3>
        </div>
        <div class="box-body">
            <div class="info-friend-container">
                <div class="w3-bar w3-border-bottom">
                    <a class="w3-bar-item w3-button tab w3-dark-grey" id="friend"><?= Yii::t('vi', 'Friend') ?></a>
                    <a class="w3-bar-item w3-button tab" id="request"><?= Yii::t('vi', 'Request') ?></a>
                    <a class="w3-bar-item w3-button tab" id="block"><?= Yii::t('vi', 'Block') ?></a>
                </div>
                <div id="friend-tab" class="w3-container tab-content w3-animate-opacity" style="display: block;">
                    <div class="list-friend list-area">
                        <?php if(empty($friendArea['friend'])) {?>
                            <p><?php echo Yii::t('vi', 'Danh sách bạn bè trống') ?></p>
                        <?php } ?>
                        <?php foreach ($friendArea['friend'] as $friend) { ?>
                            <div class="bar-item">
                                <div class="friend-avatar">
                                    <img class="img" src="https://png.pngtree.com/svg/20161027/service_default_avatar_182956.png">
<!--                                <img class="img" src="--><?php //echo $friend['part'] ?><!--">-->
                                </div>
                                <div class="friend-name"><?php echo $friend['name'] ?></div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="search">
                        <?php echo Html::input('text','search-box') ?>
                        <?php echo Html::tag('span', '', [ 'class' => 'fa fa-search' ]) ?>
                    </div>
                </div>
                <div id="request-tab" class="w3-container tab-content w3-animate-opacity" style="display: none;">
                    <div class="list-request list-area">
                        <?php if(empty($friendArea['request'])) {?>
                            <p><?php echo Yii::t('vi', 'Danh sách yêu cầu kết bạn trống') ?></p>
                        <?php } ?>
                        <?php foreach ($friendArea['request'] as $friend) { ?>
                            <div class="bar-item">
                                <div class="friend-avatar">
                                    <img class="img" src="https://png.pngtree.com/svg/20161027/service_default_avatar_182956.png">
<!--                                <img class="img" src="--><?php //echo $friend['part'] ?><!--">-->
                                </div>
                                <div class="friend-name"><?php echo $friend['name'] ?></div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="search">
                        <?php echo Html::input('text','search-box') ?>
                        <?php echo Html::tag('span', '', [ 'class' => 'fa fa-search' ]) ?>
                    </div>
                </div>
                <div id="block-tab" class="w3-container tab-content w3-animate-opacity" style="display: none;">
                    <div class="list-request list-area">
                        <?php if(empty($friendArea['block'])) {?>
                            <p><?php echo Yii::t('vi', 'Danh sách chặn trống') ?></p>
                        <?php } ?>
                        <?php foreach ($friendArea['block'] as $friend) { ?>
                            <div class="bar-item">
                                <div class="friend-avatar">
                                    <img class="img" src="https://png.pngtree.com/svg/20161027/service_default_avatar_182956.png">
<!--                                <img class="img" src="--><?php //echo $friend['part'] ?><!--">-->
                                </div>
                                <div class="friend-name"><?php echo $friend['name'] ?></div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="search">
                        <?php echo Html::input('text','search-box') ?>
                        <?php echo Html::tag('span', '', [ 'class' => 'fa fa-search' ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
