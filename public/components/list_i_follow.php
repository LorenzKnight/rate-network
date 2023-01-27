<div class="list_i_follow" id="list_i_follow">
    <div class="list_i_follow_title">
        Follow
    </div>
    <div class="list_i_follow_container">
        <ul>
        <?php
            if (isset($_GET['userID'])) {
                $requestUser['username'] = $_GET['userID'];
                $get_userId = u_all_info('*', $requestUser)['user_id'];
                
                $followRequest['user_id'] = $get_userId;
            } else {
                $followRequest['user_id'] = $_SESSION['rt_UserId'];
            }
            $follow_list = followers('*', $followRequest);

            foreach($follow_list as $follow)
            {
                $userRequest['user_id'] = $follow['isFollowing'];
                $thisUser = u_all_info('*', $userRequest);
        ?>
            <li>
                <div class='x_small_profile_sphere'>
                    <?php $profilePic = $thisUser['image'] == null || $thisUser['image'] == '' ? 'blank_profile_picture.jpg' : $thisUser['image']; ?>
                    <img src='pic/<?= $profilePic; ?>' class='x_small_profile_pic'>
                </div>
                <div class='popup_profile_name'>
                    <a href='#' onclick="goToUser('<?= $thisUser['username']; ?>')">
                        <?= $thisUser['username']; ?>
                    </a>
                    </br>
                    <?= $thisUser['name'].' '.$thisUser['surname']; ?>
                </div>
                <div>
                    <input type="button" class="access_button" id="" value="follow" onclick="">
                </div>
            </li>
        <?php
            }
        ?>
        </ul>
    </div>
</div>