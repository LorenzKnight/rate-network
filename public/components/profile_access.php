<div class="profile_access">
    <div class="access_button_container">
        <?php
        if ($_SESSION['get_user'] != $_SESSION['rt_UserId']) {

            if (!following_control($_SESSION['rt_UserId'], $_SESSION['get_user'])['existing']) {
            ?>
                <input type="button" class="access_button button_blue" id="follow" value="Follow" onclick="follow(<?= $_SESSION['rt_UserId'].' ,'.$_SESSION['get_user']; ?>, 1)">
                
            <?php
            } else if (!following_control($_SESSION['rt_UserId'], $_SESSION['get_user'])['accepted']) {
            ?>
                <input type="button" class="access_button" id=""  value="pending" onclick="undo_follow_request()">
            <?php
            } else {
            ?>
                <input type="button" class="access_button" id="unfollow"  value="Unfollow" onclick="unfollow(<?= $_SESSION['rt_UserId'].' ,'. $_SESSION['get_user']; ?>, 1)">
            <?php
            }
            ?>
                <input type="button" class="access_button" value="Message" onclick="">
                <input type="button" class="access_button" value="o o o" onclick="">
            <?php
        } else {
        ?>
            <input type="button" class="access_button" value="Edit profile" onclick="">
            <input type="button" class="access_button" value="o o o" onclick="">
        <?php
        }
        ?>
    </div>
    <!-- <?php // var_dump(cipherSimplifyer($following['followers'])); ?> -->
    <div class="follower_container">
        <?php //var_dump($postcount['allpost']); ?>
        <span id="posts" style="font-weight: 600;"><?= $postcount['allpost'] ?? ''; ?></span> posts
        <a href="#" onclick="followers()"><span id="followers" style="font-weight: 600; margin-left: 50px;"><?= cipherSimplifyer($following['followers'] ?? ''); ?></span> followers</a>
        <a href="#" onclick="i_follow()"><span id="following" style="font-weight: 600; margin-left: 50px;"><?= cipherSimplifyer($following['following'] ?? ''); ?></span> follow</a>
    </div>
</div>