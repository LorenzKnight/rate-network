<form action="start_be.php" method="post" name="formcomments" id="formcomments">
    <div class="comment_field">
        <input type="text" id="comment" name="comment" class="cfield"> 
        <span><input id="submit_comment" type="button" class="cbutton submit_comments" value="Send" /></span>
        <input type="hidden" name="postId" id="postId" value="<?= $post['postId']; ?>"/>
        <input type="hidden" name="MM_insert" id="MM_insert" value="formcomments" />
    </div>
</form>