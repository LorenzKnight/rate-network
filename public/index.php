<?php
    require_once('logic/index_be.php');
?>
<html>
<head>
<meta charset="iso-8859-1">
<title><?php echo $pageName; ?></title>
<link href="css/styles.css" rel="stylesheet" type="text/css"  media="all" />
<link href="css/components.css" rel="stylesheet" type="text/css"  media="all" />
<script src="js/jquery-1.11.3.min.js"></script>
<script defer src="js/index_page.js"></script>
</head>
<body>
    <div class="container">
        <div class="col_1">
            <div class="lin_3">
                <h1>
                    Rate
                </h1>
            </div>
        </div>
        <div class="col_2">
            <?php include("components/modal_login_signin.php"); ?>

            <!-- <div class="formular_front" style="">
            <form style="width:100%; text-align: center; margin: auto" method="post">
                <form action="index.php" method="post" name="formsignin" id="formsignin">
                    <table width="80%" align="center" cellspacing="0">
                        <tr valign="baseline">
                            <td style="" colspan="6" align="center" valign="middle">
                                
                            </td>      
                        </tr>
                        <tr valign="baseline" class="form_height">
                            <td colspan="6" align="center" valign="middle">
                                <input class="text_input_form1" type="email" name="email" id="email" placeholder="Enter your E-Mail..." title="Enter a valid email" required/>
                            </td>
                        </tr>
                        <tr valign="baseline" class="form_height">
                            <td style="" colspan="6" align="center" valign="middle">
                                <input class="text_input_form1" type="password" name="password" id="password" placeholder="Enter your Password..." required/>
                            </td>
                        </tr>
                        <tr valign="baseline" class="form_height">
                            <td nowrap="nowrap" align="center" valign="middle">
                                <input type="button" class="button_form1" id="login" value="Log in" />
                            </td>
                        </tr>
                        <tr valign="baseline" height="40">
                            <td style="color: #999;" nowrap="nowrap" align="center" valign="middle">
                                <p>- or -</p>
                            </td>
                        </tr>
                        <tr valign="baseline" class="form_height">
                            <td nowrap="nowrap" align="center" valign="middle">
                                <input type="button" class="button_form1" value="Sign up" />
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" name="status" id="status" value="1"/>
                </form>
            </div> -->
        </div>

        <!-- <div class="col_3">
            <div class="formular_front">
                <?php //$random_digit = rand(000000000,999999999); ?>
                <form action="index.php" method="post" name="formsignup" id="formsignup">
                    <table width="80%" align="center" cellspacing="0" class="list">
                        <tr valign="baseline" height="40">
                            <td colspan="6" align="center" valign="middle">
                                <h1>Create an account</h1>
                            </td>      
                        </tr>
                        <tr valign="baseline" class="form_height">
                            <td colspan="6" valign="middle" align="center">
                                <input class="text_input_form1" type="email" name="email" id="email" placeholder="Enter your E-Mail..." title="Enter a valid email" required/>
                            </td>
                        </tr>
                        <tr valign="baseline" class="form_height">
                            <td colspan="6" valign="middle" align="center">
                                <input class="text_input_form1" type="password" name="password" id="password" placeholder="Enter your Password..." required/>
                            </td>
                        </tr>
                        <tr valign="baseline" class="form_height">
                            <td nowrap="nowrap" valign="middle" align="center">
                                <input type="submit" class="button_form1" value="Create Account" />
                            </td>
                        </tr>
                        <tr valign="baseline" class="form_height">
                            <td nowrap="nowrap" valign="middle" align="center">
                                <a href="index.php">I already have an account</a>
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" name="acount_no" id="acount_no" value="<?php //echo $random_digit; ?>"/>
                    <input type="hidden" name="rank" id="rank" value="2"/>
                    <input type="hidden" name="status" id="status" value="1"/>
                    <input type="hidden" name="MM_insert" id="MM_insert" value="formsignup" />
                </form>
            </div>
        </div> -->
    </div>
</body>
</html>