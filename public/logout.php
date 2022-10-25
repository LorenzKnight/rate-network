<?php
    $_SESSION['MM_Username']="";
    $_SESSION['MM_UserGroup']="";
    $_SESSION['rt_UserId']="";
    $_SESSION['rt_Mail']="";
    $_SESSION['rt_Nivel']="";

    unset($_SESSION['MM_Username']);
    unset($_SESSION['MM_UserGroup']);
    unset($_SESSION['rt_UserId']);
    unset($_SESSION['rt_Mail']);
    unset($_SESSION['rt_Nivel']);
    session_start();
    session_destroy();

    header("Location: index.php");
    exit;
?>