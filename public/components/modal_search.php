<!-- <button class="button_form1" onclick="location.href='logout.php'" type="button">Log out</button> -->
<!-- <form action="start_be.php" method="post" name="formcomments" id="formcomments"> -->
    <!-- search<br> -->
    <div class="comment_field">
        <input type="text" id="comment" name="comment" class="search_field" placeholder="Search" >
        <input type="hidden" name="postId" id="postId" value="<?= $post['postId']; ?>"/>
        <input type="hidden" name="MM_insert" id="MM_insert" value="formcomments" />
    </div>
<!-- </form> -->