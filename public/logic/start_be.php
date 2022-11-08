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
        
            $htmlResult = '<div class="post_user_rate" style="background-color:red;">';
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
                'post' => $postId,
                'comment' => $comment,
                'date' => $comment_date,
                'last_comment' => $htmlResult,
                'num_comments' => count_comments('*', $requestData)
            ];

            echo json_encode($result);
        }
    }

    if (isset($_POST["show_comments"])) {
        $userId             = $_SESSION['rt_UserId'];
        $postId             = $_POST['postId'];

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
            'comments_html' => $htmlResult
        ];

        echo json_encode($result);
    }
?>