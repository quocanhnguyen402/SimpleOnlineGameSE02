<?php
?>

<?php foreach ($listFriend as $friend) { ?>
    <div class="bar-item w3-border-bottom search-friend">
        <div class="friend-avatar">
            <img class="img" src="https://png.pngtree.com/svg/20161027/service_default_avatar_182956.png">
        </div>
        <div class="friend-name" id="<?php echo $friend['id'] ?>"><?php echo $friend['username'] ?></div>
    </div>
<?php } ?>
