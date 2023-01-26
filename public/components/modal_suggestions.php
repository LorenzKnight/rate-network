<div class="suggestionslist">
    <p style="font-size: 14px; font-weight: 600;">Suggestions for you</p>
    <?php
    foreach($suggestions as $sugg)
    {
        $requestUser['user_id'] = $sugg['userId'];
        $get_user = u_all_info('*', $requestUser);
    ?>
        <ul>
            <a href='#' onclick='goToUser("<?= $get_user["username"]; ?>")'>
                <li>
                    <div class='x_small_profile_sphere'>
                        <?php $profilePic = $get_user["image"] == null || $get_user["image"] == '' ? 'blank_profile_picture.jpg' : $get_user["image"] ; ?>
                        <img src='pic/<?= $profilePic; ?>' class='x_small_profile_pic'>
                    </div>
                    <div class='popup_profile_name'>
                        <?= $get_user['name'].' '.$get_user['surname']; ?>
                    </div>
                </li>
            </a>
        </ul>
    <?php
    }
    ?>
</div>