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
        <div class="friend-name" id="fr-<?php echo $friend['id'] ?>">
            <?php echo $friend['name'] ?>
            <?php if ($view == 1) { ?>
            <div class="pull-right">
                <span class="fa fa-check text-success btn accept" style="background-color: #f4f4f4;border-color: #ddd;"></span>
                <span class="fa fa-remove text-danger btn decline" style="background-color: #f4f4f4;border-color: #ddd;"></span>
            </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>