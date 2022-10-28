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
            </div>
            
            <div class='post_rates'>
            </div>
        </div>
    </div>
<?php
}
?>