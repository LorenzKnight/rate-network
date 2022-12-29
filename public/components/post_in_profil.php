<!-- <a href="#" onclick="addpost()"><div class="add_button">+</div></a> -->
<div class="activity_list">
    <div class="activity_title">
        Notifications
    </div>
    <ul>
    <?php
        $requestLogData['to_userid'] = $_SESSION['rt_UserId'];
        $logs = read_log('*', $requestLogData);

        foreach($logs as $log) {

            $requestFromUserId['user_id'] = $log['fromUserId'];
            $profilePic = u_all_info('*', $requestFromUserId)['image'] == null || u_all_info('*', $requestFromUserId)['image'] == '' ? 'blank_profile_picture.jpg' : u_all_info('*', $requestFromUserId)['image'];
            $requestData['comment_id'] = $log['objId'];

            $requestDataComment['comment_id'] = $log['objId'];
    
            switch ($log['action']) {
                case 'rate-post':
                    $notice_array = [u_all_info('*', $requestFromUserId)['username'].' rated '.$log['commentary'].' your post', '<div class="frame_activity_preview"><img src="images/' .brind_post_preview($log['objId'])['preview'].'" class="activity_preview"></div>'];
                    break;
                case 'rate-comment':
                    // var_dump(brind_post_preview( comment_in_post('*', $requestData)['0']['postId'] )['preview']);
                    $notice_array = [u_all_info('*', $requestFromUserId)['username'].' rated '.$log['commentary'].' your comment "'.comment_in_post('*', $requestData)['0']['comment'].'"', '<div class="frame_activity_preview"><img src="images/' .brind_post_preview( comment_in_post('*', $requestData)['0']['postId'] )['preview'].'" class="activity_preview"></div>'];
                    break;
                case 'follow-request':
                    $notice_array = [u_all_info('*', $requestFromUserId)['username'].' sent a request', '<input type="button" class="access_button button_blue" id="follow" value="Confirm" onclick="follow('. $_SESSION['rt_UserId'].' ,'. $log['fromUserId'].')"> <input type="button" class="access_button" id="follow" value="Remove" onclick="follow('. $_SESSION['rt_UserId'].' ,'. $log['fromUserId'].')">'];
                    break;
                case 'follow':
                    $notice_array = [u_all_info('*', $requestFromUserId)['username'].' has started following you', '<input type="button" class="access_button button_blue" id="follow" value="Follow" onclick="follow('. $_SESSION['rt_UserId'].' ,'. $log['fromUserId'].')">'];
                    break;
                case 'comment':
                    $options['order'] = 'desc';
                    $notice_array = [u_all_info('*', $requestFromUserId)['username'].' has commented on your post: "comment"', '<div class="frame_activity_preview"><img src="images/' .brind_post_preview($log['objId'])['preview'].'" class="activity_preview"></div>'];
                    break;
                case 'answer-comment':
                    $notice_array = ["3", 0];
                    break;
            }
    ?>
        <li>
            <div class="x_small_profile_sphere">
                <img src="pic/<?= $profilePic; ?>" class="x_small_profile_pic">
            </div>
            <div class="activity_desc">
                <?= $notice_array[0]; ?>
            </div>
            <div class="activity_action">
                <?= $notice_array[1]; ?>
            </div>
        </li>
    <?php
        }
    ?>
    </ul>
</div>




<?php
// var_dump(following_control($_SESSION['rt_UserId'], $_SESSION['get_user'])['accepted']);
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