<?php
use frontend\controllers\ProfileController;

/* @var $model common\models\Relationship */
$listFriend = ProfileController::getList('friend');
?>

<?php foreach ($listFriend as $friend) { ?>
<div class="bar-item w3-border-bottom">
    <div class="friend-avatar">
        <img class="img" src="https://png.pngtree.com/svg/20161027/service_default_avatar_182956.png">
    </div>
    <div class="friend-name"><?php echo $friend['name'] ?></div>
</div>
<?php } ?>