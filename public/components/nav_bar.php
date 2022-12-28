<?php 
    $requestData['user_id'] = $_SESSION['rt_UserId'];
?>
<div class="menu">
    <ul>
        <li><a href="start.php">Start</a></li>
        <li><a href="#">Moments</a></li>
        <li><a href="#">Rated</a></li>
        <li id="all_notices"><a href="#" style="position: relative;">Activity<span class="notices"></span></a>
            <div class="triangulo_notices_list" id="triangulo_notices_list"></div>
            <div class="notices_list" id="notices_list">

            </div>
        </li>
        <li><a href="start.php?userID=<?= u_all_info('*', $requestData)['username']; ?>">Profile</a></li>
    </ul>
</div>