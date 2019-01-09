<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\widgets\ListView;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
$this->title = 'SimpleGameOnline';
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    $logoArea = Html::a('SimpleGameOnline' . '<span class="dotcom">.com</span>', [Yii::$app->homeUrl], ['class' => 'logo']);
    $describe = Html::tag('div', 'Wish you have fun time!', ['class' => 'w3-right describe-hide-small w3-wide toptext']);
    echo Html::tag('div', $logoArea . $describe, ['class' => 'w3-container top']);
    ?>
    <?php
    NavBar::begin([
        'brandLabel' => '<span class="fa fa-home">&nbsp;Home Page</span>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'nav-custom w3-card-2',
        ],
    ]);
    if (Yii::$app->user->isGuest) {
//        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
//        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        $menuItems[] = '<li><a href="javascript:void(0);" onclick="signup();return false;">Signup</a></li>';
        $menuItems[] = '<li><a href="javascript:void(0);" onclick="login();return false;">Login</a></li>';
    } else {
        $menuItems[] = '<li>' . '<a class="no-padding" href="/profile"><div class="avatar"><img src="https://png.pngtree.com/svg/20161027/service_default_avatar_182956.png"></div>' . '</li></a>';
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <?php if (1 == 0) { ?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
    </div>
    <?php } ?>

    <?php if(!Yii::$app->user->isGuest) { ?>
    <div class="side-bar">
        <div class="title">
            <div class="expand">
                <div class="btn-expand">
                    <div class="btn-expand-content"></div>
                    <div class="btn-expand-content"></div>
                    <div class="btn-expand-content"></div>
                </div>
                <div class="side-bar-title">Danh sách Bạn bè</div>
            </div>
        </div>
        <div class="list">

            <?php echo  $this->render('_friend-list') ?>

        </div>
        <div class="side-bar-footer"></div>
    </div>
    <?php } ?>

    <?= $content ?>

    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true"></div>
    <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true"></div>
</div>

<?php $this->endBody() ?>
<script>
    function login(){
        $.ajax({
            type:'POST',
            url:'<?= Yii::$app->urlManager->createUrl(["site/login"]); ?>',
            success: function(data)
            {
                $('#loginModal').html(data);
                $('#loginModal').modal();
            }
        });
    }
    function signup(){
        $.ajax({
            type:'POST',
            url:'<?= Yii::$app->urlManager->createUrl(["site/signup"]); ?>',
            success: function(data)
            {
                $('#signupModal').html(data);
                $('#signupModal').modal();
            }
        });
    }
</script>
<script>
    $('.btn-expand').on('click', function (e) {
        $('side-bar').css('top', $(document).scroll())
        if($('.side-bar').css('width') != '280px') {
            $('.side-bar').css('width', '280px');
            // $('.site-body').css('margin-right', '280px');
        } else {
            $('.side-bar').css('width', '60px');
            // $('.site-body').css('margin-right', '60px');
        }
    })
    $('.list').css('height', ($('.side-bar').height() - 93 - 125) + 'px');
    if($(document).innerHeight() > window.innerHeight) {
        $('.side-bar').css('right','17px');
    }
    window.addEventListener('resize', function(event) {
        if($(document).innerHeight() > window.innerHeight) {
            $('.side-bar').css('right','17px');
        } else {
            $('.side-bar').css('right','');
        }
        if($('body').scrollTop() < 125) {
            $('.list').css('height', ($('.side-bar').height() - 93 - (125 - $('body').scrollTop())) + 'px');
        } else {
            $('.list').css('height', ($('.side-bar').height() - 93) + 'px');
        }
    });
    window.addEventListener('click', function(event) {
        if(!event.target.matches('#w0-collapse')){
            $('.navbar').attr('style', '');
        }
    });
    var lastScrollTop = 0;
    $('body').scroll(function(){
        var st = $(this).scrollTop();
        if(st < 125) {
            $('.navbar').attr('style', '');
            $('.side-bar').css('top', (125 - st) + 'px');
            $('.list').css('height', ($('.side-bar').height() - 93 - (125 - st)) + 'px');
        } else {
            if (st < lastScrollTop){
                // upscroll code
                $('.navbar').attr('style', 'top: 0; position: absolute');
            } else {
                // downscroll code
                $('.navbar').attr('style', '');
            }
            $('.side-bar').css('top', '0');
            $('.list').css('height', ($('.side-bar').height() - 93) + 'px');
        }
        lastScrollTop = st;
    });
</script>
<style>
    .modal-open {
        padding-right: 0px !important;
        overflow-y: auto;
    }
</style>
</body>
</html>
<?php $this->endPage() ?>
