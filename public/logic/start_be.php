<?php 
    require_once __DIR__ .'/../connections/conexion.php';

    if (isset($_GET['userID'])) {
        if (!isset($_SESSION)) {
            session_start();
        }
        
        $requestUser['username'] = $_GET['userID'];
        $get_userId = u_all_info('*', $requestUser)['user_id'];
        
        $_SESSION['get_user'] = $get_userId;
    } else {
        $_SESSION['get_user'] = $_SESSION['rt_UserId'];
    }

    $followers_list = followers_list($_SESSION['rt_UserId']);
    $followers_list[] = (int)$_SESSION['rt_UserId'];
    
    $publications   = post_wall_profile($followers_list);

    $postOnProfil   = post_wall_profile($_SESSION['get_user']);

    
    if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formcomments")) {
        $userId             = $_SESSION['rt_UserId'];
        $postId             = $_POST['postId'];
        $comment            = $_POST['comment'];
        $comment_date       = date("Y-m-d H:i:s");

        if(isset($comments) || $comment != '')
        {
            add_comments($userId, $postId, $comment, $comment_date);

            $toUserid = (int)post_all_data($postId)['userId'];
            insert_log($userId, 'comment', $postId, $toUserid, null, 0);

            $requestData['post_id']         = $postId;
            $requestUserData['user_id']     = (int)$userId;

            $comment_user = u_all_info('*', $requestUserData);
            $profile_pic = $comment_user["image"] != null ? $comment_user["image"] : 'blank_profile_picture.jpg';
        
            $htmlResult = '';

            $htmlResult .= '<div class="post_user_rate" style="background-color:red;">';
                $htmlResult .= '<div class="x_small_profile_sphere">';
                    $htmlResult .=' <img src="pic/'.$profile_pic.'" class="x_small_profile_pic">';
                $htmlResult .= '</div>';
                $htmlResult .= '<div class="post_rates_info">';
                    $htmlResult .= $comment_user['name'].' '.$comment_user['surname']; 
                    $htmlResult .= '<br>';
                    $htmlResult .= '<p class="comment_font">'.$comment.'</P>';
                $htmlResult .= '</div>';
            $htmlResult .= '</div>';

            $result = [
                'post'          => $postId,
                'comment'       => $comment,
                'date'          => $comment_date,
                'last_comment'  => $htmlResult,
                'num_comments'  => count_comments('*', $requestData)
            ];

            echo json_encode($result);
        }
    }

    if (isset($_POST["show_comments"])) {
        $postId             = $_POST['postId'];
        
        // post author
        $requestUserData['user_id'] = (int)post_all_data($postId)['userId'];

        $userInfo = u_all_info('*', $requestUserData);

        $htmlPostProfile = '';
        $Postprofile_pic = $userInfo['image'] != null ? $userInfo['image'] : 'blank_profile_picture.jpg';

        $htmlPostProfile .= '<div class="popup_profile_items">';
            $htmlPostProfile .= '<div class="x_small_profile_sphere">';
                $htmlPostProfile .=' <img src="pic/'.$Postprofile_pic.'" class="x_small_profile_pic">';
            $htmlPostProfile .= '</div>';
            $htmlPostProfile .= '<div class="popup_profile_name">';
                $htmlPostProfile .= $userInfo['name'].' '.$userInfo['surname'];
            $htmlPostProfile .= '</div>';
        $htmlPostProfile .= '</div>';


        // post comments list
        $htmlResult = '';
        $htmlResult .= '<div class="post_comments" id="post_comments">';
        $htmlResult .= '<input type="hidden" name="post_id" id="postId" value="'.$postId.'"/>';

            $requestData['post_id'] = $postId;

            $comment_list = comment_in_post('*', $requestData);
            
            foreach($comment_list as $comment)
            {
                $requestUserData['user_id'] = (int)$comment['userId'];

                $comment_user = u_all_info('*', $requestUserData);
                $profile_pic = $comment_user["image"] != null ? $comment_user["image"] : 'blank_profile_picture.jpg';
            
                $htmlResult .= '<div class="post_user_rate" style="background-color:red;">';
                    $htmlResult .= '<div class="x_small_profile_sphere">';
                        $htmlResult .=' <img src="pic/'.$profile_pic.'" class="x_small_profile_pic">';
                    $htmlResult .= '</div>';
                    $htmlResult .= '<div class="post_rates_info">';
                        $htmlResult .= $comment_user['name'].' '.$comment_user['surname']; 
                        $htmlResult .= '<br>';
                        $htmlResult .= '<p class="comment_font">'.$comment["comment"].'</P>';
                    $htmlResult .= '</div>';
                $htmlResult .= '</div>';
            }
            
        $htmlResult .= '</div>';

        $result = [
            'post_author'           => $htmlPostProfile,
            'comments_html'         => $htmlResult,
            'num_comments'          => count_comments('*', $requestData)
        ];

        echo json_encode($result);
    }

    if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formrate")) {
        $userId             = $_SESSION['rt_UserId'];
        $stars              = $_POST['stars'];
        $postId             = $_POST['postId'];

        $requestData['user_id'] = $userId;
        $requestData['post_id'] = $postId;

        $doIrate = rate_in_post('*', $requestData, ['count_query' => true])["count"];

        if($doIrate < 1)
        {
            $returRateBonus = add_rate($userId, $stars, $postId);

            update_user_rate($stars, (float)$returRateBonus[0], $postId);

            $toUserid = (int)post_all_data($postId)['userId'];
            insert_log($userId, 'rate-post', $postId, $toUserid, $stars.' ★', 0);

            $requestRateData['post_id'] = $postId;
            $post_rates = rate_in_post('*', $requestRateData, array('order' => 'rate_id desc'));

            // post rates list
            $htmlRates = '';
            $htmlRates .= '<div class="post_rate_list" id="post_rate_list">';
            foreach($post_rates as $rateData)
            {
                $requestUserData['user_id'] = $rateData['userId'];

                $user_data = u_all_info('*', $requestUserData);
                $profile_pic = $user_data["image"] != null ? $user_data["image"] : 'blank_profile_picture.jpg';

                $htmlRates .='<div class="post_user_rate">';
                    $htmlRates .='<div class="x_small_profile_sphere">';
                        $htmlRates .='<img src="pic/'.$profile_pic.'" class="x_small_profile_pic">';
                    $htmlRates .='</div>';
                    $htmlRates .='<div class="post_rates_info">';
                        $htmlRates .= $user_data['name'].' '.$user_data['surname']; 
                        $htmlRates .='<br>';
                        $htmlRates .= substr($user_data['rate'], 0, 3);
                        $htmlRates .='<br>';
                        for($i = 1; $i < 6; $i++) {
                            $htmlRates .='<span class="fa fa-star '. rate_star($rateData['stars'], $i).'" style="font-size: 22px;">★</span> ';
                        }
                    $htmlRates .='</div>';
                $htmlRates .='</div>';
            }
            $htmlRates .='</div>';

            $requestRateNum['post_id'] = $postId;
            $result = [
                'all_rates'  => $htmlRates,
                'num_rate'   => rate_in_post('*', $requestRateNum, ['count_query' => true])["count"]
            ];

            echo json_encode($result);
        }
        // else
        // {
        //     $rateBonus = $stars;
        //     rate_update(array('stars' => $stars, 'rate_bonus' => $rateBonus), array('post_id' => $rankbooster_id), array('user_id' => $rankbooster_id));
        // }
    }

    if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formnewpost")) {
        $userId         = $_SESSION['rt_UserId'];
        $postContent    = $_POST['post_content'];
        $picNames       = json_decode($_POST['pic_name'], true);
        $mediaDate      = date("Y-m-d H:i:s");

        $postId = create_new_post($userId, $postContent, 1);
        
        $insertValues = [];

        foreach($picNames as $picName)
        {
            rename('../tmp_images/'.$picName, '../images/'.$picName);
            $insertValues[] = ['userId' => $userId, 'postId' => $postId, 'name' => "$picName", 'mediaDate' => "$mediaDate"];
        }
        
        add_post_media($insertValues);

        $publications   = post_wall_profile($followers_list);

        $test = include('../components/post_in_wall.php');
    }

    if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "getpostcount")) {
        $userId         = $_SESSION['rt_UserId'];
        $postcount  = count_posts($userId);

        echo $postcount['allpost'];
    }

    if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formfollowrequest")) {
        $myId       = $_POST['my_Id'];
        $userId     = $_POST['user_Id'];

        $requestSent = follow_request($myId, $userId);

        $requestData['user_id'] = $userId;

        if(u_all_info("*", $requestData)['status'] == 1) {
            insert_log($myId, 'follow', 0, $userId, null, 0);
        }
        else
        {
            insert_log($myId, 'follow-request', 0, $userId, null, 0);
        }

        $_SESSION['get_user'] = $userId;
        $following  = get_followers_and_following($userId);
        $postcount  = count_posts($userId);
        
        include('../components/profile_access.php');
    }

    if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formunfollow")) {
        $myId       = $_POST['my_Id'];
        $userId     = $_POST['user_Id'];

        $requestSent = unfollow($myId, $userId);

        $_SESSION['get_user'] = $userId;
        $following  = get_followers_and_following($userId);
        $postcount  = count_posts($userId);

        include('../components/profile_access.php');
    }

    if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formfollowconfirm")) {
        $myId       = $_POST['my_Id'];
        $userId     = $_POST['user_Id'];

        if(following_control($userId, $myId)['existing']) {
            follow_confirm($myId, $userId, 1);
        }

        include('../components/activity_list.php');
    }

    if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formrequestdelete")) {
        $myId       = $_POST['my_Id'];
        $userId     = $_POST['user_Id'];

        remove_request($myId, $userId);

        log_checked($myId, $userId, 2);
        
        include('../components/activity_list.php');
    }

    if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formchecknotices")) {
        $myId = $_SESSION['rt_UserId'];

        $requestData['to_userid'] = $myId;
        $requestData['checked'] = 0;

        $isChecked = read_log('*', $requestData, ['count_query' => true])["count"] > 0;

        if($isChecked) {
            // log_checked($myId, null, 1);
        }

        include('../components/nav_bar.php');
    }
?>