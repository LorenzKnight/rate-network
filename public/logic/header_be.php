<?php
    require_once('../connections/conexion.php');

    $requestUserData['user_id'] = $_SESSION['get_user'];

    $current_user   = u_all_info('*', $requestUserData);
    $following      = get_followers_and_following($current_user['user_id']);

    $current_user = array_merge($current_user, $following);

    echo json_encode($current_user);
?>