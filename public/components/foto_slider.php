<div class="slideshow-container">
<?php
    $images_list = show_post_images($post['postId']);

    foreach($images_list as $pic_data)
    {
?>
    <div class="mySlides fade">
        <img src="images/<?= $pic_data['name']; ?>" class="slider_foto" onclick="showcomments(<?= $post['postId']; ?>)">
    </div>
<?php
    }
?>

    <a class="prev" data-direction="-1">&#10094;</a>
<?php
    if($pic_data['total_pic'] > 1) {
?>
    <a class="next" data-direction="1">&#10095;</a>
<?php
    }
?>

    <div style="text-align:center; margin-top: 5px;">
    <?php
        foreach($images_list as $pic_data)
        {
    ?>
        <span class="dot"></span>
    <?php
        }
    ?>
    </div>
</div>
<br>

