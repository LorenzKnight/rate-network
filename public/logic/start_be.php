<?php 
    require_once('./connections/conexion.php');

    $publications   = post_wall_profile();
    // echo json_encode($publications);

    if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formcomments")) {
        $userId             = $_SESSION['rt_UserId'];
        $comments           = $_POST['comments'];
        $postId             = $_POST['postId'];

        // echo 'aqui '.$comments.' '.$postId;
    }
?>