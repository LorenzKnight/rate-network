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
                <?php //echo $_SESSION['rt_UserId']; ?>
                <!-- Currently working<br>
                at Hoddicker -->
            </div>
        </div>
    </div>
    <div class="profile_access">
        <div class="access_button_container">
            <?php
            if ($_SESSION['get_user'] != $_SESSION['rt_UserId']) {
            ?>
                <input type="button" class="access_button" value="Follow" onclick="">
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
            <span style="font-weight: 600;">100</span> followers
            <span style="font-weight: 600; margin-left:50px;">100</span> follow
        </div>
    </div>
</div>