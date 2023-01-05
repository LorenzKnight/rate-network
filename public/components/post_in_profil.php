<?php //include("components/activity_list.php"); ?>

<?php
if (following_control($_SESSION['rt_UserId'], $_SESSION['get_user'])['accepted'] || $_SESSION['get_user'] == $_SESSION['rt_UserId']) {
    foreach($postOnProfil as $post)
    {
?>
    <div class='post_on_profil'>
        <?= $post['postId']; ?>
    </div>
<?php
    }
} else {
?>
    <div class=""></div>
    <div class="message_in_wall">
        <p>This account is private <br/>
        follow to view photos and videos.</p>
    </div>
<?php
}
?>