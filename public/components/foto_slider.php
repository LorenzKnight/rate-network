<!-- Slideshow container -->
<div class="slideshow-container">
<?php
    $images_list = post_images($post['postId']);

    foreach($images_list as $pic_data)
    {
?>
    <!-- Full-width images with number and caption text -->
    <div class="mySlides fade">
        <img src="images/<?= $pic_data['name']; ?>" class="slider_foto">
    </div>
<?php
    }
?>
    <!-- Next and previous buttons -->
    <a class="prev" data-direction="-1">&#10094;</a>
    <a class="next" data-direction="1">&#10095;</a>

    <!-- The dots/circles -->
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

