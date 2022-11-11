<?php 
    require_once __DIR__ .'/../connections/conexion.php';

    $publications   = post_wall_profile();

    if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formcomments")) {
        $userId             = $_SESSION['rt_UserId'];
        $postId             = $_POST['postId'];
        $comment            = $_POST['comment'];
        $comment_date       = date("Y-m-d H:i:s");

        if(isset($comments) || $comment != '')
        {
            add_comments($userId, $postId, $comment, $comment_date);

            $requestData['post_id'] = $postId;

            $comment_user = u_all_info((int)$userId);
            $profile_pic = $comment_user["image"] != null ? $comment_user["image"] : 'blank_profile_picture.jpg';
        
            $htmlResult = '';

            $htmlResult .= '<div class="post_user_rate" style="background-color:red;">';
                $htmlResult .= '<div class="x_small_profile_sphere">';
                    $htmlResult .=' <img src="pic/'.$profile_pic.'" class="x_small_porfile_pic">';
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
        $post_all_data = post_all_data($postId);
        $userInfo = u_all_info((int)$post_all_data['userId']);

        $htmlPostProfile = '';
        $Postprofile_pic = $userInfo['image'] != null ? $userInfo['image'] : 'blank_profile_picture.jpg';

        $htmlPostProfile .= '<div class="popup_profile_items">';
            $htmlPostProfile .= '<div class="x_small_profile_sphere">';
                $htmlPostProfile .=' <img src="pic/'.$Postprofile_pic.'" class="x_small_porfile_pic">';
            $htmlPostProfile .= '</div>';
            $htmlPostProfile .= '<div class="popup_profile_name">';
                $htmlPostProfile .= $userInfo['name'].' '.$userInfo['surname'];
            $htmlPostProfile .= '</div>';
        $htmlPostProfile .= '</div>';


        // post comments list
        $htmlResult = '';
        $htmlResult .= '<div class="post_comments" id="post_comments">';
            
            $comment_list = comment_in_post($postId);
            
            foreach($comment_list as $comment)
            {
                $comment_user = u_all_info((int)$comment['userId']);
                $profile_pic = $comment_user["image"] != null ? $comment_user["image"] : 'blank_profile_picture.jpg';
            
                $htmlResult .= '<div class="post_user_rate" style="background-color:red;">';
                    $htmlResult .= '<div class="x_small_profile_sphere">';
                        $htmlResult .=' <img src="pic/'.$profile_pic.'" class="x_small_porfile_pic">';
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
            'comments_html'         => $htmlResult
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

            update_user_rate($stars, $returRateBonus, $postId);

            $requestRateData['post_id'] = $postId;
            $post_rates = rate_in_post('*', $requestRateData, array('order' => 'rate_id desc'));

            // post rates list
            $htmlRates = '';
            $htmlRates .= '<div class="post_rate_list" id="post_rate_list">';
            foreach($post_rates as $rateData)
            {
                $user_data = u_all_info($rateData['userId']);
                $profile_pic = $user_data["image"] != null ? $user_data["image"] : 'blank_profile_picture.jpg';

                $htmlRates .='<div class="post_user_rate">';
                    $htmlRates .='<div class="x_small_profile_sphere">';
                        $htmlRates .='<img src="pic/'.$profile_pic.'" class="x_small_porfile_pic">';
                    $htmlRates .='</div>';
                    $htmlRates .='<div class="post_rates_info">';
                        $htmlRates .= $user_data['name'].' '.$user_data['surname']; 
                        $htmlRates .='<br>';
                        $htmlRates .= substr($user_data['rate'], 0, 3);
                        $htmlRates .='<br>';
                        $htmlRates .='<span class="fa fa-star '. rate_star($rateData['stars'], 1).'" style="font-size: 22px;"></span> ';
                        $htmlRates .='<span class="fa fa-star '. rate_star($rateData['stars'], 2).'" style="font-size: 22px;"></span> ';
                        $htmlRates .='<span class="fa fa-star '. rate_star($rateData['stars'], 3).'" style="font-size: 22px;"></span> ';
                        $htmlRates .='<span class="fa fa-star '. rate_star($rateData['stars'], 4).'" style="font-size: 22px;"></span> ';
                        $htmlRates .='<span class="fa fa-star '. rate_star($rateData['stars'], 5).'" style="font-size: 22px;"></span> ';
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
?>