<span style='float: right;'>
    <div class="rate_buttom">
        <div class="rate_popup" id="rate_popup<?= $post['postId']; ?>">
            <?php
            for($i = 1; $i < 6; $i++) {
            ?>
                <span onmouseover="fyllUp(<?= $i; ?>)" onmouseout="fyllOut(<?= $i; ?>)" id="star_mo<?= $i; ?>" class="star_mo rating_star" data-rate="<?= $i; ?>">★</span>
            <?php
            }
            ?>
        </div>
    </div>
</span>