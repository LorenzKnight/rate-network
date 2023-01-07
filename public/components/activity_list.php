<div class="activity_list" id="activity_list">
    <div class="activity_title">
        Notifications
    </div>
    <div class="activity_container">
        <ul>
        <?php
            $requestLogData['to_userid'] = $_SESSION['rt_UserId'];
            $requestLogData['checked'] = 2;
            $logs = read_log('*', $requestLogData);

            foreach($logs as $log) {

                $requestFromUserId['user_id'] = $log['fromUserId'];
                $profilePic = u_all_info('*', $requestFromUserId)['image'] == null || u_all_info('*', $requestFromUserId)['image'] == '' ? 'blank_profile_picture.jpg' : u_all_info('*', $requestFromUserId)['image'];
                $requestDataIds['comment_id'] = $log['objId'];

                $requestDataComment['comment_id'] = (int)$log['objId'];
        
                switch ($log['action']) {
                    case 'rate-post':
                        $notice_array = [
                            u_all_info('*', $requestFromUserId)['username'].' rated '.$log['commentary'].' your post', 
                            '<div class="frame_activity_preview"><img src="images/' .brind_post_preview($log['objId'])['preview'].'" class="activity_preview"></div>'
                        ];
                        break;
                    case 'rate-comment':
                        $notice_array = [
                            u_all_info('*', $requestFromUserId)['username'].' rated '.$log['commentary'].' your comment "'.comment_in_post('*', $requestDataIds)[0]['comment'].'"', 
                            '<div class="frame_activity_preview"><img src="images/' .brind_post_preview( comment_in_post('*', $requestDataIds)['0']['postId'] )['preview'].'" class="activity_preview"></div>'
                        ];
                        break;
                    case 'follow-request':
                        if(following_control($log['fromUserId'], $_SESSION['rt_UserId'])['accepted']) {
                            $messageSeccion = 'have started following you';
                            $actionSeccion = '<input type="button" class="access_button" id="" value="follow back" onclick="follow('. $_SESSION['rt_UserId'].' ,'. $log['fromUserId'].')">';
                        } else {
                            $messageSeccion = 'sent a request';
                            $actionSeccion = '<input type="button" class="access_button button_blue" id="" value="Confirm" onclick="follow_confirm('. $_SESSION['rt_UserId'].' ,'. $log['fromUserId'].')"> <input type="button" class="access_button" id="" value="Remove" onclick="remove_request('. $_SESSION['rt_UserId'].' ,'. $log['fromUserId'].')">';
                        }
                        $notice_array = [
                            u_all_info('*', $requestFromUserId)['username'].' '.$messageSeccion, 
                            $actionSeccion
                        ];
                        break;
                    case 'follow':
                        $notice_array = [
                            u_all_info('*', $requestFromUserId)['username'].' has started following you', 
                            '<input type="button" class="access_button button_blue" id="follow" value="Follow" onclick="follow('. $_SESSION['rt_UserId'].' ,'. $log['fromUserId'].')">'
                        ];
                        break;
                    case 'comment':
                        $notice_array = [
                            u_all_info('*', $requestFromUserId)['username'].' has commented on your post: "'.comment_in_post('*', $requestDataComment)[0]['comment'].'"', 
                            '<div class="frame_activity_preview"><img src="images/' .brind_post_preview(comment_in_post('*', $requestDataComment)[0]['postId'])['preview'].'" class="activity_preview"></div>'
                        ];
                        break;
                    case 'answer-comment':
                        $notice_array = [
                            "3", 
                            0
                        ];
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
</div>