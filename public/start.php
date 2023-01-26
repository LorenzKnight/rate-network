<?php require_once('logic/start_be.php');?>

<html>
<head>
<meta charset="iso-8859-1">
<title><?php echo $pageName; ?></title>
<!-- <link rel="shortcut icon" href="favicon-32x32.png"> -->
<link href="css/styles.css" rel="stylesheet" type="text/css"  media="all" />
<link href="css/components.css" rel="stylesheet" type="text/css"  media="all" />
<script defer src="js/header.js"></script>
<script defer src="js/start_page.js"></script>
<script defer src="js/search.js"></script>

</head>
<body onload="">
    <div class="container" style="padding-top: 0.5em;">
        <div class="wrap">
            <?php include("components/header.php"); ?>
            <div class="nav_bar">
                <?php include("components/nav_bar.php"); ?>
            </div>
            <div class="the_wall" id="content">
                <a href="#" onclick="addpost()"><div class="add_button">+</div></a>
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
            
            <?php include("components/modal_suggestions.php"); ?>
        </div>
    </div>
    <?php include("components/popup_bg.php"); ?>
</body>
</html>