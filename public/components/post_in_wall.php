<?php 
foreach($publications as $card)
{
    $u_info = u_all_info($card['userId']);
?>
    <div class='public_post_in_wall'>
        <div class='post_profil'>
            <div class='small_profile_sphere'>
                <img src='pic/<?= $u_info['image'] != null ? $u_info['image'] : 'blank_profile_picture.jpg' ; ?>' class='small_porfile_pic'>
            </div>
            <div class='post_profile_desc' id='post_profile_desc'>
                <?= $u_info['name'].' '.$u_info['surname']; ?> <span style="font-size: 1.3em"><?= substr($u_info['rate'], 0, 3); ?></span></br>
                <span style="font-weight: 400; font-size: 1.1em;"><?= $card['content']; ?></span>
            </div>
        </div>
        <div class='content'>
            <div class='post_fotos_coments'>
                <div class='post_fotos'>
                </div>
                <div class='post_coments'>

                </div>
                <?php include('components/modal_comment_field.php'); ?>
            </div>
            
            <div class='post_rates'>
                <?php
                    $requestData['post_id'] = $card['rId'];

                    $post_rates = rate_in_post('*', $requestData, array('order' => 'rate_id desc'));
                ?>
                <span class="fa fa-star"></span> <?= count_rates('*', $requestData) ?> people rate your picture(s)
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
<?php
}
?>