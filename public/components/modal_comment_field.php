<form action="start.php" method="post" name="formcomments" id="formcomments">
    <div class="comment_field">
        <input type="text" id="comments" name="comments" class="cfield"> <span><input type="submit" class="cbutton" value="Send" /></span>
        <input type="hidden" name="postId" id="postId" value="<?= $card['rId']; ?>"/>
        <input type="hidden" name="MM_insert" id="MM_insert" value="formcomments" />
    </div>
</form>