<?php
/** @var array $arrFriend */
?>

<?php if(empty($arrFriend)) {?>
    <p><?php echo Yii::t('vi', 'Danh sách trống') ?></p>
<?php } ?>
<?php foreach ($arrFriend as $friend) { ?>
    <div class="bar-item">
        <div class="friend-avatar">
            <img class="img" src="https://png.pngtree.com/svg/20161027/service_default_avatar_182956.png">
<!--        <img class="img" src="--><?php //echo $friend['part'] ?><!--">-->
        </div>
        <div class="friend-name" id="fr-<?php echo $friend['id'] ?>"><?php echo $friend['name'] ?></div>
    </div>
<?php } ?>