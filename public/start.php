<?php require_once('logic/start_be.php');?>

<html>
<head>
<meta charset="iso-8859-1">
<title><?php echo $pageName; ?></title>
<!-- <link rel="shortcut icon" href="favicon-32x32.png"> -->
<link href="css/styles.css" rel="stylesheet" type="text/css"  media="all" />
<link href="css/components.css" rel="stylesheet" type="text/css"  media="all" />
<script defer src="js/header.js"></script>
<!-- <script defer src="js/start_page.js"></script> -->
<!-- <script src="js/jquery.taconite.js"></script> -->
<script src="js/jquery-1.11.3.min.js"></script>

</head>
<body onload="">
    <div class="container" style="padding-top: 2em;">
        <div class="wrap">
            <?php include("components/header.php"); ?>
            <div class="nav_bar">
            </div>
            <div class="the_wall" id="content">
                <!-- start of public wall -->
                <?php include('components/post_in_wall.php'); ?>
                <!-- end of public wall -->
            </div>
        </div>
        <div class="sidebar">
            <button class="button_form1" onclick="location.href='logout.php'" type="button">Log out</button>
        </div>
    </div>
</body>
</html>