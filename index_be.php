<?php require_once('connections/conexion.php');?>
<!-- Login -->
<?php
    if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formsignin")) 
    {
        if (!isset($_SESSION)) 
        {
            session_start();
        }

        $loginFormAction = $_SERVER['PHP_SELF'];
        if (isset($_GET['accesscheck'])) 
        {
            $_SESSION['PrevUrl'] = $_GET['accesscheck'];
        }

        function mysqli_result($res, $row, $field=0) 
        { 
            $res->data_seek($row); 
            $datarow = $res->fetch_array(); 
            return $datarow[$field]; 
        }

        if (isset($_POST['email'])) 
        {
            $loginUsername=$_POST['email'];
            //ATENCIÓN USAMOS MD5 para guardar la contraseña.
            $password=md5($_POST['password']);
            $MM_fldUserAuthorization = "rank";
            $MM_redirectLoginSuccess = "start.php";
            $MM_redirectLoginFailed = "error.php?error=2";
            $MM_redirecttoReferrer = false;
            
                
            $LoginRS__query=sprintf("SELECT id_user, email, password, rank FROM users WHERE email=%s AND password=%s AND status=1",
            GetSQLValueString($loginUsername, "text"),
            GetSQLValueString($password, "text")); 
            
            $LoginRS = mysqli_query($con,  $LoginRS__query) or die(mysqli_error($con));
            $loginFoundUser = mysqli_num_rows($LoginRS);
            if ($loginFoundUser) 
            {
                $loginStrGroup  = mysqli_result($LoginRS,0,'rank');
                if (PHP_VERSION >= 5.1) 
                {
                    session_regenerate_id(true);
                } 
                else 
                {
                    session_regenerate_id();
                }
                //declare two session variables and assign them
                $_SESSION['MM_Username'] = $loginUsername;
                $_SESSION['MM_UserGroup'] = $loginStrGroup;	 
                $_SESSION['tks_UserId'] = mysqli_result($LoginRS,0,'id_user');
                $_SESSION['tks_Mail'] = mysqli_result($LoginRS,0,'email');
                $_SESSION['tks_Nivel'] = mysqli_result($LoginRS,0,'rank');
                //ContabilizarAcceso($_SESSION['vpt_UserId']);
                
                /* DESCOMENTAR SOLO SI SE USA EL CHECK DE RECORDAR CONTRASEÑA, HABRÁ QUE USAR LA FUNCIÓN generar_cookie()
                if ((isset($_POST["CAMPORECUERDA"])) && ($_POST["CAMPORECUERDA"]=="1"))
                generar_cookie($_SESSION['NOMBREWEB_UserId']);
                */	     

                if (isset($_SESSION['PrevUrl']) && false) 
                {
                    $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
                }
                header("Location: " . $MM_redirectLoginSuccess );
            }
            else 
            {
                header("Location: ". $MM_redirectLoginFailed );
            }
        }
    }
?>
<!-- Sign up with log in -->
<?php
    $editFormAction = $_SERVER['PHP_SELF'];
    if (isset($_SERVER['QUERY_STRING']))
    {
        $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
    }

    $password=md5($_POST["password"]);

    if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formsignup")) 
    {

        if (comprobaremailunico($_POST["email"]))
        {
            $insertSQL = sprintf("INSERT INTO users(email, password, rank, acount_no, status) VALUES (%s, %s, %s, %s, %s)",
                                GetSQLValueString($_POST["email"], "text"),
                                GetSQLValueString($password, "text"),
                                GetSQLValueString($_POST["rank"], "int"),
                                GetSQLValueString($_POST["acount_no"], "int"),
                                GetSQLValueString($_POST["status"], "int"));

        
            $Result1 = mysqli_query($con,  $insertSQL) or die(mysqli_error($con));
            
            
            $insertGoTo1 = "manage.php";
            if (isset($_SERVER['QUERY_STRING'])) 
            {
                $insertGoTo1 .= (strpos($insertGoTo1, '?')) ? "&" : "?";
                $insertGoTo1 .= $_SERVER['QUERY_STRING'];
            }
            header(sprintf("Location: %s", $insertGoTo1));

        }
        else if (!isset($_SESSION)) 
        {
            session_start();
        }

        $loginFormAction = $_SERVER['PHP_SELF'];
        if (isset($_GET['accesscheck'])) 
        {
            $_SESSION['PrevUrl'] = $_GET['accesscheck'];
        }

        function mysqli_result($res, $row, $field=0) 
        { 
            $res->data_seek($row); 
            $datarow = $res->fetch_array(); 
            return $datarow[$field]; 
        }

        if (isset($_POST['email'])) 
        {
            $loginUsername=$_POST['email'];
            //ATENCIÓN USAMOS MD5 para guardar la contraseña.
            //$password=$_POST['password'];
            $MM_fldUserAuthorization = "rank";
            $MM_redirectLoginSuccess = "index.php?complete=1";
            $MM_redirectLoginFailed = "error.php?error=3";
            $MM_redirecttoReferrer = false;

            $LoginRS__query=sprintf("SELECT id_user, email, password, rank FROM users WHERE email=%s AND password=%s AND status=1",
            GetSQLValueString($loginUsername, "text"),
            GetSQLValueString($password, "text")); 
            
            $LoginRS = mysqli_query($con,  $LoginRS__query) or die(mysqli_error($con));
            $loginFoundUser = mysqli_num_rows($LoginRS);
            if ($loginFoundUser) 
            {
                $loginStrGroup  = mysqli_result($LoginRS,0,'rank');
                if (PHP_VERSION >= 5.1) 
                {
                    session_regenerate_id(true);
                } 
                else 
                {
                    session_regenerate_id();
                }
                //declare two session variables and assign them
                $_SESSION['MM_Username'] = $loginUsername;
                $_SESSION['MM_UserGroup'] = $loginStrGroup;	 
                $_SESSION['tks_UserId'] = mysqli_result($LoginRS,0,'id_user');
                $_SESSION['tks_Mail'] = mysqli_result($LoginRS,0,'email');
                $_SESSION['tks_Nivel'] = mysqli_result($LoginRS,0,'rank');
                //ContabilizarAcceso($_SESSION['tks_UserId']);
                
                /* DESCOMENTAR SOLO SI SE USA EL CHECK DE RECORDAR CONTRASEÑA, HABRÁ QUE USAR LA FUNCIÓN generar_cookie()
                if ((isset($_POST["CAMPORECUERDA"])) && ($_POST["CAMPORECUERDA"]=="1"))
                generar_cookie($_SESSION['NOMBREWEB_UserId']);*/	 

                if (isset($_SESSION['PrevUrl']) && false) 
                {
                    $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
                }
                header("Location: " . $MM_redirectLoginSuccess );
            }
            else 
            {
                header("Location: ". $MM_redirectLoginFailed );
            }
        }
    }
?>