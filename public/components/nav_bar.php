<?php 
    $requestData['user_id'] = $_SESSION['rt_UserId'];
    $userName = u_all_info('*', $requestData)['username'];

    $requestToHide['to_userid'] = $_SESSION['rt_UserId'];
    $requestToHide['checked'] = 0;
    $isChecked = read_log("checked", $requestToHide, ['count_query' => true])["count"] > 0;

    $requestRate['to_userid'] = $_SESSION['rt_UserId'];
    $requestRate['action'] = 'rate-post';
    $requestRate['checked'] = 0;
    $rates = read_log('*', $requestRate, ['count_query' => true])["count"];

    $requestFollow['to_userid'] = $_SESSION['rt_UserId'];
    $requestFollow['action'] = 'follow';
    $requestFollow['checked'] = 0;
    $follow = read_log('*', $requestFollow, ['count_query' => true])["count"];

    $followRequest['to_userid'] = $_SESSION['rt_UserId'];
    $followRequest['action'] = 'follow-request';
    $followRequest['checked'] = 0;
    $requests = read_log('*', $followRequest, ['count_query' => true])["count"];

    $allfollow = $follow + $requests;

    $requestComments['to_userid'] = $_SESSION['rt_UserId'];
    $requestComments['action'] = 'comment';
    $requestComments['checked'] = 0;
    $comments = read_log('*', $requestComments, ['count_query' => true])["count"];
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
            <div class="triangle_notices_list" id="triangle_notices_list"></div>
            <div class="notices_list" id="notices_list">
                <?php if($rates) { ?>
                    <div class="notices_icons"><span>R</span><?= $rates; ?></div>
                <?php 
                }
                if ($allfollow) {
                ?>
                    <div class="notices_icons"><span>F</span><?= $allfollow; ?></div>
                <?php 
                }
                if ($comments) {
                ?>
                    <div class="notices_icons"><span>C</span><?= $comments; ?></div>
                <?php } ?>
            </div>
        <?php } ?>
        </li>
        <li style="position: relative;"><a href="start.php?userID=<?= $userName; ?>">My Profile</a>
            <ul>
                <a href="#"><li style="border-radius: 4px 4px 0 0;">option 1</li></a>
                <a href="logout.php"><li style="color: red; border-radius: 0 0 4px 4px;">Log out</li></a>
            </ul>
        </li>
    </ul>
</div>