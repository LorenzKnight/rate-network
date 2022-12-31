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

        $doIrate = count_rates($columns = "*", $requestData);

        if($doIrate < 1)
        {
            $returRateBonus = add_rate($userId, $stars, $postId);

            update_user_rate($stars, (float)$returRateBonus[0], $postId);

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
                'num_rate'   => count_rates('*', $requestRateNum)
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

        include('../components/post_in_wall.php');
    }

    if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formfollowrequest")) {
        $myId       = $_POST['my_Id'];
        $userId     = $_POST['user_Id'];

        $requestSent = follow_request($myId, $userId);

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

    if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formunfollowconfirm")) {
        $myId       = $_POST['my_Id'];
        $userId     = $_POST['user_Id'];

        if(following_control($userId, $myId)['existing']) {
            follow_confirm($myId, $userId);
        }
    }
?>