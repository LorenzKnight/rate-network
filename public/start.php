<?php require_once('logic/start_be.php');?>

<html>
<head>
<meta charset="iso-8859-1">
<title><?php echo $pageName; ?></title>
<!-- <link rel="shortcut icon" href="favicon-32x32.png"> -->
<link href="css/styles.css" rel="stylesheet" type="text/css"  media="all" />
<link href="css/components.css" rel="stylesheet" type="text/css"  media="all" />
<script defer src="js/header.js"></script>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
<script defer src="js/start_page.js"></script>
<script defer src="js/search.js"></script>

</head>
<body onload="">
    <div class="container" style="padding-top: 0.5em;">
        <div class="wrap">
            <?php include("components/header.php"); ?>
            <div class="nav_bar">
                <?php include("components/nav_bar.php"); ?>
                <!-- <div id="aqui"></div> -->
            </div>
            <div class="the_wall" id="content">
                <?php 
                if (!isset($_GET['userID'])) {
                    include("components/post_in_wall.php"); 
                } else {
                    include("components/post_in_profil.php");
                }
                ?>
            </div>
        </div>
        <div class="sidebar">
            <?php include("components/modal_search.php"); ?>
            <div style="background-color: #999; width: 100%; height: 20px; margin-top: 60px;">

            </div>
        </div>
    </div>
    <?php include("components/popup_bg.php"); ?>
</body>
</html>