<?php
    require_once('../connections/conexion.php');
    
    $current_user   = search_users();

    echo json_encode($current_user);
?>