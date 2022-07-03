<?php require_once('connections/conexion.php');?>

<html>
<head>
<meta charset="iso-8859-1">
<title><?php echo $pageName; ?></title>
<!-- <link rel="shortcut icon" href="favicon-32x32.png"> -->
<link href="css/index.css" rel="stylesheet" type="text/css"  media="all" />

</head>
<body style="background-color:#F0F0F0;">
    <?php echo $_SESSION['MM_Username']; ?>
</body>
</html>