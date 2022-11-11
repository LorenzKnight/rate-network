<?php 
foreach($publications as $post)
{
    $u_info = u_all_info($post['userId']);
?>
    <div class='public_post_in_wall'>
        <div class='post_profil'>
            <div class='small_profile_sphere'>
                <img src='pic/<?= $u_info['image'] != null ? $u_info['image'] : 'blank_profile_picture.jpg' ; ?>' class='small_porfile_pic'>
            </div>
            <div class='post_profile_desc' id='post_profile_desc'>
                <?= $u_info['name'].' '.$u_info['surname']; ?> <span style="font-size: 1.3em"><?= substr($u_info['rate'], 0, 3); ?></span></br>
                <span style="font-weight: 400; font-size: 1.1em;"><?= $post['content']; ?></span>
            </div>
        </div>
        <div class='content post_container'>
            <div class='post_fotos_coments' id="post_fotos_coments">
                <div class='post_fotos'>
                </div>
                <div class='post_options'>
                    <?php
                        $requestData['post_id'] = $post['postId'];
                    ?>
                    <a href="#" onclick="showcomments(<?= $post['postId']; ?>)"><span id="num_comments"><?= count_comments('*', $requestData); ?></span> comments</a>
                    <input type="hidden" name="post_id" id="post_id" value="<?= $post['postId']; ?>"/>
                    <span style='float: right;'>
                        <!-- <form action="start_be.php" method="post" name="formrate" id="formrate"> -->
                        <div class="rate_buttom">
                            <div class="rate_popup" id="rate_popup<?= $post['postId']; ?>">
                                <span onmouseover="fyllUp(1)" onmouseout="fyllOut(1)" id="star_mo1" class="fa fa-star rating_star" style="font-size: 18px;" data-rate="1"></span>
                                <span onmouseover="fyllUp(2)" onmouseout="fyllOut(2)" id="star_mo2" class="fa fa-star rating_star" style="font-size: 18px;" data-rate="2"></span>
                                <span onmouseover="fyllUp(3)" onmouseout="fyllOut(3)" id="star_mo3" class="fa fa-star rating_star" style="font-size: 18px;" data-rate="3"></span>
                                <span onmouseover="fyllUp(4)" onmouseout="fyllOut(4)" id="star_mo4" class="fa fa-star rating_star" style="font-size: 18px;" data-rate="4"></span>
                                <span onmouseover="fyllUp(5)" onmouseout="fyllOut(5)" id="star_mo5" class="fa fa-star rating_star" style="font-size: 18px;" data-rate="5"></span>
                            </div>
                            <!-- <input type="hidden" name="postId" id="postId" value="<?= $post['postId']; ?>"/> -->
                            <!-- <input type="hidden" name="MM_insert" id="MM_insert" value="formrate" /> -->
                            <!-- <a href="#" onclick="showrate(<?= $post['postId']; ?>)">Rate it</a> -->
                        </div>
                        <!-- </form> -->
                    </span>
                </div>
                <?php include('components/modal_comment_field.php'); ?>
                <div class="last_comment">

                </div>
            </div>

            <div class='post_rates' id='post_rates'>
                <?php
                    $requestData['post_id'] = $post['postId'];

                    $post_rates = rate_in_post('*', $requestData, array('order' => 'rate_id desc'));
                ?>
                <span class="fa fa-star"></span> <span id="num_rate"><?= count_rates('*', $requestData); ?></span> people rate your picture(s)
                <div class="post_rate_list" id="post_rate_list">
                    <?php
                        foreach($post_rates as $rateData)
                        {
                            $user_data = u_all_info($rateData['userId'])
                    ?>
                    <div class="post_user_rate">
                        <div class='x_small_profile_sphere'>
                            <img src='pic/<?= $user_data['image'] != null ? $user_data['image'] : 'blank_profile_picture.jpg' ; ?>' class='x_small_porfile_pic'>
                        </div>
                        <div class="post_rates_info">
                            <?= $user_data['name'].' '.$user_data['surname']; ?><br>
                            <?= substr($user_data['rate'], 0, 3); ?><br>
                            <span class="fa fa-star <?= $rateData['stars'] >= 1 ? 'star_checked' : '' ?>" style="font-size: 22px;"></span>
                            <span class="fa fa-star <?= $rateData['stars'] >= 2 ? 'star_checked' : '' ?>" style="font-size: 22px;"></span>
                            <span class="fa fa-star <?= $rateData['stars'] >= 3 ? 'star_checked' : '' ?>" style="font-size: 22px;"></span>
                            <span class="fa fa-star <?= $rateData['stars'] >= 4 ? 'star_checked' : '' ?>" style="font-size: 22px;"></span>
                            <span class="fa fa-star <?= $rateData['stars'] == 5 ? 'star_checked' : '' ?>" style="font-size: 22px;"></span>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>