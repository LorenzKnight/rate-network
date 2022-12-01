<?php 
    require_once __DIR__ .'/../connections/conexion.php';

    $followers_list = followers_list($_SESSION['rt_UserId']);
    $followers_list[] = (int)$_SESSION['rt_UserId'];
    $userList = json_encode($followers_list);
   
    $publications   = post_wall_profile($userList);
    
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
        $htmlResult .= '<input type="hidden" name="post_id" id="postId" value="'.$postId.'"/>';
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

        $requestData['post_id'] = $postId;

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

    if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formnewpost")) {
        $userId         = $_SESSION['rt_UserId'];
        $postContent    = $_POST['post_content'];
        $picNames       = json_decode($_POST['pic_name'], true);
        $mediaDate      = date("Y-m-d H:i:s");

        $postId = create_new_post($userId, $postContent, 1);
        
        $insertValues = [];

        foreach($picNames as $item)
        {
            $insertValues[] = ['userId' => $userId, 'postId' => $postId, 'name' => "$item", 'mediaDate' => "$mediaDate"];
        }
        
        add_post_media($insertValues);

        $publications   = post_wall_profile($userList);

        include('../components/post_in_wall.php');

        // foreach($publications as $post)
        // {
        //     $u_info = u_all_info($post['userId']);

        // $htmlNewPost = "<div class='public_post_in_wall'>";
        //     $htmlNewPost .="<div class='post_profil'>";
        //         $htmlNewPost .="<div class='small_profile_sphere'>";
        //             $htmlNewPost .='<img src="pic/'. $u_info["image"] != null ? $u_info['image'] : 'blank_profile_picture.jpg' .'" class="small_porfile_pic">';
        //         $htmlNewPost .='</div>';
        //         $htmlNewPost .='<div class="post_profile_desc" id="post_profile_desc">';
        //             $htmlNewPost .= $u_info['name'].' '.$u_info['surname'].' <span style="font-size: 1.3em">'. substr($u_info['rate'], 0, 3).'</span></br>';
        //             $htmlNewPost .='<span style="font-weight: 400; font-size: 1.1em;">'.$post['content'].'</span>';
        //         $htmlNewPost .='</div>';
        //     $htmlNewPost .='</div>';
        //     $htmlNewPost .='<div class="content post_container">';
        //         $htmlNewPost .='<div class="post_fotos_coments" id="post_fotos_coments">';
        //             $htmlNewPost .='<div class="post_fotos">';
        //                 $htmlNewPost .=include('../components/foto_slider.php');
        //             $htmlNewPost .='</div>';
        //             $htmlNewPost .='<div class="post_options">';
        //                                 $requestData['post_id'] = $post['postId'];
        //                 $htmlNewPost .='<a href="#" onclick="showcomments('. $post['postId'].')"><span id="num_comments">'. count_comments("*", $requestData).'</span> comments</a>';
        //                 $htmlNewPost .='<input type="hidden" name="post_id" id="post_id" value="'.$post['postId'].'"/>';
        //                 $htmlNewPost .= include('../components/modal_add_rate.php'); 
        //             $htmlNewPost .='</div>';
        //             $htmlNewPost .= include('../components/modal_comment_field.php');
        //             $htmlNewPost .='<div class="last_comment">';

        //             $htmlNewPost .='</div>';
        //         $htmlNewPost .='</div>';

        //         $htmlNewPost .='<div class="post_rates" id="post_rates">';
                    
        //             $requestData['post_id'] = $post['postId'];

        //             $post_rates = rate_in_post('*', $requestData, array('order' => 'rate_id desc'));
                    
        //         $htmlNewPost .='<span class="fa fa-star"></span> <span id="num_rate">'. count_rates("*", $requestData).'</span> people rate your picture(s)';
        //         $htmlNewPost .='<div class="post_rate_list" id="post_rate_list">';
                        
        //                     foreach($post_rates as $rateData)
        //                     {
        //                         $user_data = u_all_info($rateData['userId']);
                        
        //                         $htmlNewPost .='<div class="post_user_rate">';
        //                             $htmlNewPost .='<div class="x_small_profile_sphere">';
        //                                 $htmlNewPost .='<img src="pic/'.$user_data['image'] != null ? $user_data['image'] : 'blank_profile_picture.jpg'.'" class="x_small_porfile_pic">';
        //                             $htmlNewPost .='</div>';
        //                             $htmlNewPost .='<div class="post_rates_info">';
        //                             $htmlNewPost .= $user_data["name"].' '.$user_data["surname"].' <br>';
        //                             $htmlNewPost .= substr($user_data['rate'], 0, 3).' <br>';
        //                             $htmlNewPost .= '<span class="fa fa-star'. $rateData["stars"] >= 1 ? 'star_checked' : '' .'" style="font-size: 22px;"></span>';
        //                             $htmlNewPost .= '<span class="fa fa-star'. $rateData["stars"] >= 2 ? 'star_checked' : '' .'" style="font-size: 22px;"></span>';
        //                             $htmlNewPost .= '<span class="fa fa-star'. $rateData["stars"] >= 3 ? 'star_checked' : '' .'" style="font-size: 22px;"></span>';
        //                             $htmlNewPost .= '<span class="fa fa-star'. $rateData["stars"] >= 4 ? 'star_checked' : '' .'" style="font-size: 22px;"></span>';
        //                             $htmlNewPost .= '<span class="fa fa-star'. $rateData["stars"] == 5 ? 'star_checked' : '' .'" style="font-size: 22px;"></span>';
        //                         $htmlNewPost .= '</div>';
        //                     $htmlNewPost .= '</div>';
        //                 }
        //             $htmlNewPost .='</div>';
        //         $htmlNewPost .='</div>';
        //     $htmlNewPost .='</div>';
        // $htmlNewPost .='</div>';
        // }

    }
?>