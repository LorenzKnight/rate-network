<?php require_once('logic/start_be.php');?>

<html>
<head>
<meta charset="iso-8859-1">
<title><?php echo $pageName; ?></title>
<!-- <link rel="shortcut icon" href="favicon-32x32.png"> -->
<link href="css/styles.css" rel="stylesheet" type="text/css"  media="all" />
<link href="css/components.css" rel="stylesheet" type="text/css"  media="all" />
<link href="css/post_wall_profile.css" rel="stylesheet" type="text/css"  media="all" />
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
                <div class='public_post_in_wall'>
                    <div class='post_profil'>
                        <div class='small_profile_sphere'>
                            
                        </div>
                        <div class='post_profile_desc' id='post_profile_desc'>
                            
                        </div>
                    </div>
                    <div class='content'>
                        <div class='post_fotos'>
                        </div>
                        <div class='post_comments'>
                            <?= $publication['content']; ?>
                        </div>
                    </div>
                </div>
                <!-- end of public wall -->
            </div>
        </div>
        <div class="sidebar">
            <button class="button_form1" onclick="location.href='logout.php'" type="button">Log out</button>
        </div>
    </div>
</body>
</html>