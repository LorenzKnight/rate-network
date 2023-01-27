<div class="followers_list" id="followers_list">
    <div class="followers_title">
        Followers
    </div>
    <div class="followers_container">
        <ul>
        <?php
            if (isset($_GET['userID'])) {
                $requestUser['username'] = $_GET['userID'];
                $get_userId = u_all_info('*', $requestUser)['user_id'];
                
                $followersRequest['is_following'] = $get_userId;
            } else {
                $followersRequest['is_following'] = $_SESSION['rt_UserId'];
            }
            $followers_list = followers('*', $followersRequest);

            foreach($followers_list as $followers)
            {
                $userRequest['user_id'] = $followers['userId'];
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
                    <input type="button" class="access_button" id="" value="remove" onclick="">
                </div>
            </li>
        <?php
            }
        ?>
        </ul>
    </div>
</div>