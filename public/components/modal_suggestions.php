<div class="suggestionslist">
    <p style="font-size: 14px; font-weight: 600;">Suggestions for you</p>
    <?php
    foreach($suggestions as $sugg)
    {
        $requestUserSugg['user_id'] = $sugg['userId'];
        $get_user = u_all_info('*', $requestUserSugg);
    ?>
        <ul>
            
                <li>
                    <div class='x_small_profile_sphere'>
                        <?php $profilePic = $get_user["image"] == null || $get_user["image"] == '' ? 'blank_profile_picture.jpg' : $get_user["image"] ; ?>
                        <img src='pic/<?= $profilePic; ?>' class='x_small_profile_pic'>
                    </div>
                    <div class='popup_profile_name'>
                        <a href='#' onclick="goToUser('<?= $get_user['username']; ?>')">
                            <?= $get_user['username']; ?> <!-- <a href='#'>follow</a> -->
                        </a>
                    </div>
                </li>
            
        </ul>
    <?php
    }
    ?>
</div>