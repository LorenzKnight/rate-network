<?php 
foreach($publication as $card)
{
    $u_info = u_all_info($card['user_id']);
?>
    <div class='public_post_in_wall'>
        <div class='post_profil'>
            <div class='small_profile_sphere'>
                <img src='img/<?= $u_info['image']; ?>' class='small_porfile_pic'>
            </div>
            <div class='post_profile_desc' id='post_profile_desc'>
                <?= $card['user_id']; ?>
                <?= $card['content']; ?>
            </div>
        </div>
        <div class='content'>
            <div class='post_fotos'>
            </div>
            <div class='post_comments'>
            </div>
        </div>
    </div>
<?php
}
?>