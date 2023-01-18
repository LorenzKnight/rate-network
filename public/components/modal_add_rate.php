<span style='float: right;'>
    <div class="rate_buttom">
        <div class="rate_popup" id="rate_popup<?= $post['postId']; ?>">
            <?php
            $requestRated['post_id'] = $post['postId'];
            $post_rated = rate_in_post('*', $requestRated, array('order' => 'rate_id desc'));
            // var_dump($post_rated);
            if(!empty($post_rated)) {
                for($i = 1; $i < 6; $i++) {
            ?>
                    <span class=" <?= $post_rated[0]['stars'] >= $i ? 'star_checked' : '' ?>" style="font-size: 18px;">★</span>
            <?php
                }
            }
            else
            {
                for($i = 1; $i < 6; $i++) {
            ?>
                    <span onmouseover="fyllUp(<?= $i; ?>)" onmouseout="fyllOut(<?= $i; ?>)" id="star_mo<?= $i; ?>" class="star_mo rating_star" data-rate="<?= $i; ?>">★</span>
            <?php
                }
            }
            ?>
        </div>
    </div>
</span>