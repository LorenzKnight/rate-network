<div class="bg_popup" id="bg_popup" data-postID='<?= $post['postId']; ?>'>
    <div class="bg_container" id="bg_container">
        <!-- zoon comments -->
        <div class="comment_fotos_popup" id="comment_fotos_popup">
            <div class="fotos_content">
                <?php //include('components/foto_slider.php'); ?>
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
        <div class="post_form" id="post_form">
            <?php include('components/modal_create_post.php'); ?>
        </div>
    </div>
</div>