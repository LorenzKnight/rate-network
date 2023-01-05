<?php 
    $requestData['user_id'] = $_SESSION['rt_UserId'];
    $requestToHide['to_userid'] = $_SESSION['rt_UserId'];
    $requestToHide['checked'] = 0;
    $isChecked = read_log("checked", $requestToHide, ['count_query' => true])["count"] > 0;
    // var_dump(read_log('*', $requestData, ['order' => 'log_id asc']));
?>
<div class="menu">
    <ul>
        <li><a href="start.php">Start</a></li>
        <li><a href="#">Moments</a></li>
        <li><a href="#">Rated</a></li>
        <li id="all_notices">
            <a href="#" style="position: relative;">
                Activity
            <?php if($isChecked) { ?> 
                <span class="notices"></span>
            <?php } ?>
            </a>
        <?php if($isChecked) { ?> 
            <div class="triangulo_notices_list" id="triangulo_notices_list"></div>
            <div class="notices_list" id="notices_list">

            </div>
        <?php } ?>
        </li>
        <li><a href="start.php?userID=<?= u_all_info('*', $requestData)['username']; ?>">Profile</a></li>
    </ul>
</div>