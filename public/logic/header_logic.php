<?php
    require_once('../connections/conexion.php');

    $user_id        = $_SESSION['rt_UserId'];
    $current_user   = u_all_info($user_id);

    echo json_encode($current_user);
?>