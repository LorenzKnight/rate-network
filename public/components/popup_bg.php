<div class="bg_popup" id="bg_popup" data-postID='<?= $post['postId']; ?>'>
    <div class="bg_container" id="bg_container">
        <!-- follower list popup -->
        <?php include('components/follower_list.php'); ?>

        <!-- list i follow popup -->
        <?php include('components/list_i_follow.php'); ?>

        <!-- activity list popup -->
        <?php include('components/activity_list.php'); ?>

        <!-- pending menu -->
        <div class="pending_menu" id="pending_menu">
            <div class="pending_info">
                <?php
                    $requestUser['username'] = $_GET['userID'];
                    $get_user_info = u_all_info('*', $requestUser);
                ?>
                <div class="small_profile_sphere" style="margin: 0 auto;">
                    <img src="pic/<?= $get_user_info['image'] != null || $get_user_info['image'] != '' ? $get_user_info['image'] : 'blank_profile_picture.jpg' ; ?>" class="small_profile_pic">
                </div>
            </div>
            <ul>
                <li style="border: 0; display: flex; text-align: center;">
                    If you regret it, you must send a request<br/>
                    to follow <?= $get_user_info['username']; ?> again.
                </li>
                <a href="#" onclick="unfollow(<?= $_SESSION['rt_UserId'].', '.$get_user_info['user_id']; ?>)"><li style="color: red;">unfollow</li></a>
                <a href="#" onclick="close_popup()"><li>cancel</li></a>
            </ul>
        </div>

        <!-- zoon comments -->
        <div class="comment_fotos_popup" id="comment_fotos_popup">
            <div class="fotos_content">
                
            </div>
            <div class="comments_content post_container">
                <div class="popup_profile" id="popup_profile">
                    
                </div>
                <div class="comments_popup" id="comments_popup">
                
                </div>
                <div class="popup_opcions">
                    <span id="num_comments"></span> comments
                    <?php include('components/modal_add_rate.php'); ?>
                </div>
                <div class="popup_comment_area">
                    <?php include('components/modal_comment_field.php'); ?>
                </div>
            </div>
        </div>

        <!-- post form -->
        <?php include('components/modal_create_post.php'); ?>
    </div>
</div>