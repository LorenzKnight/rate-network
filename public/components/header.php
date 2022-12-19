<div class="header">
    <div class="profile_pic">
        <div class="profile_sphere" id="profile_sphere">
        </div>
    </div>
    <div class="profile_desc">
        <div class="name" id="names">
        </div>
        <div class="rank_title">
            <div class="rank" id="rank">
            </div>
            <div class="title" id="title">
                <!-- Currently working<br>
                at Hoddicker -->
            </div>
        </div>
    </div>
    <div class="profile_access">
        <div class="access_button_container">
            <?php
            if ($_SESSION['get_user'] != $_SESSION['rt_UserId']) {
                // var_dump(following_control($_SESSION['get_user'], $_SESSION['rt_UserId']));

                if (!following_control($_SESSION['rt_UserId'], $_SESSION['get_user'])['existing']) {
                ?>
                    <input type="button" class="access_button button_blue" id="follow" value="Follow" onclick="">
                    
                <?php
                } else if (!following_control($_SESSION['rt_UserId'], $_SESSION['get_user'])['accepted']) {
                ?>
                    <input type="button" class="access_button" id=""  value="pending" onclick="">
                <?php
                } else {
                ?>
                    <input type="button" class="access_button" id="unfollow"  value="Unfollow" onclick="">
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
        <div class="follower_container">
            <span id="followers" style="font-weight: 600;"></span> followers
            <span id="following" style="font-weight: 600; margin-left:50px;"></span> follow
        </div>
    </div>
</div>