<?php 
    require_once('./connections/conexion.php');

    if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formsignin")) {
        if (!isset($_SESSION)) {
            session_start();
        }

        $loginFormAction = $_SERVER['PHP_SELF'];
        if (isset($_GET['accesscheck'])) {
            $_SESSION['PrevUrl'] = $_GET['accesscheck'];
        }

        $email                      = $_POST['email'];
        $password                   = $_POST['password'];
        $MM_redirectLoginSuccess    = "start.php";
        $MM_redirectLoginFailed     = "index.php?error=1";

        $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $sql = pg_query($query);
        $totalRow_query = pg_num_rows($sql);

        if($totalRow_query > 0)
        {
            $row_query = pg_fetch_assoc($sql);
 
            $_SESSION['rt_UserId'] = $row_query['user_id'];
            $_SESSION['rt_Mail'] = $row_query['email'];
            $_SESSION['rt_Nivel'] = $row_query['rank'];

            if (isset($_SESSION['PrevUrl']) && false) {
                $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
            }
            header("Location: " . $MM_redirectLoginSuccess );
        }
        else
        {
            header("Location: " . $MM_redirectLoginFailed );
        }
    }
?>