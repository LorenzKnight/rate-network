<a href="#" onclick="addpost()"><div class="add_button">+</div></a>
<?php 
foreach($postOnProfil as $post)
{
?>
<div class='post_on_profil'>
    <?= $post['postId']; ?>
</div>
<?php
}
?>