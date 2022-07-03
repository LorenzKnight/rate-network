<?php require_once('index_be.php');?>

<html>
<head>
<meta charset="iso-8859-1">
<title><?php echo $pageName; ?></title>
<!-- <link rel="shortcut icon" href="favicon-32x32.png"> -->
<link href="css/index.css" rel="stylesheet" type="text/css"  media="all" />

</head>
<body style="background-color:#F0F0F0;">
    <div class="container">
        <?php include("inc/header_front.php"); ?>
        <?php if ($_GET['signup'] == ""):?>
            <?php  if ($_GET['complete'] == ""): ?>
                <?php  if ($_GET['multicomplet'] == ""): ?>
                <div class="col_1">
                    <div class="lin_3">
                        <h1>
                            Rate
                        </h1>
                    </div>
                </div>
                <div class="col_2">
                    <div class="formular_front" style="">
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
                                        <input type="submit" class="button_form1" value="Log in" />
                                    </td>
                                </tr>
                                <tr valign="baseline" height="40">
                                    <td style="color: #999;" nowrap="nowrap" align="center" valign="middle">
                                        <p>- or -</p>
                                    </td>
                                </tr>
                                <tr valign="baseline" class="form_height">
                                    <td nowrap="nowrap" align="center" valign="middle">
                                        <button class="button_form1" onclick="location.href='index.php?signup=1'" type="button">Sign up</button>
                                    </td>
                                </tr>
                            </table>
                            <input type="hidden" name="status" id="status" value="1"/>
                            <input type="hidden" name="MM_insert" id="MM_insert" value="formsignin" />
                        </form>
                    </div>
                </div>
                <?php endif ?>
            <?php endif ?>
        <?php endif ?>

        <?php if ($_GET['signup'] != ""):?>
                <div class="col_3">
                    <div class="formular_front">
                        <?php $random_digit = rand(000000000,999999999); ?>
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
                            <input type="hidden" name="acount_no" id="acount_no" value="<?php echo $random_digit; ?>"/>
                            <input type="hidden" name="rank" id="rank" value="2"/>
                            <input type="hidden" name="status" id="status" value="1"/>
                            <input type="hidden" name="MM_insert" id="MM_insert" value="formsignup" />
                        </form>
                    </div>
                </div>
        <?php endif ?>

        <?php if ($_GET['complete'] != ""):?>
                <div class="col_3">
                    <div class="formular_front" style="margin: 10px auto;">
                        <form action="index.php" method="post" name="formcomplete" id="formcomplete">
                            <table width="80%" align="center" cellspacing="0">
                                <tr valign="baseline" height="40">
                                    <td colspan="6" align="center" valign="middle">
                                        <h1>Complete</h1>
                                    </td>      
                                </tr>
                                <tr valign="baseline" class="form_height">
                                    <td colspan="6" valign="middle" align="center">
                                        <input class="text_input_form1" type="text" name="name" id="name" placeholder="Enter your name..." value="<?php echo $row_DatosFees['name'];?>" required/>
                                    </td>
                                </tr>
                                <tr valign="baseline" class="form_height">
                                    <td colspan="6" valign="middle" align="center">
                                        <input class="text_input_form1" type="text" name="surname" id="surname" placeholder="Enter your surname..." value="<?php echo $row_DatosFees['surname'];?>" required/>
                                    </td>
                                </tr>
                                <tr valign="baseline" class="form_height">
                                    <td colspan="6" valign="middle" align="center">
                                        <input class="text_input_form1" type="text" minlength="10" maxlength="10" name="personal_number" id="personal_number" placeholder="Your Personal number (10 numbers)" value="<?php echo $row_DatosFees['personal_number'];?>" required/>
                                    </td>
                                </tr>
                                <tr valign="baseline" class="form_height">
                                    <td colspan="6" valign="middle" align="center">
                                        <input class="text_input_form1" type="text" name="phone" id="phone" placeholder="Enter your phone number..." value="<?php echo $row_DatosFees['phone'];?>" required/>
                                    </td>
                                </tr>
                                <tr valign="baseline" class="form_height">
                                    <td nowrap="nowrap" valign="middle" align="center">
                                        <input type="submit" class="button_form1" value="DONE" />
                                    </td>
                                </tr>
                            </table>
                            <input type="hidden" name="id_user" id="id_user" value="<?php echo $_SESSION['tks_UserId']; ?>"/>
                            <input type="hidden" name="MM_insert" id="MM_insert" value="formcomplete" />
                        </form>
                    </div>
                </div>
        <?php endif ?>
        <?php if ($_GET['multicomplet'] != ""):?>
            <?php if ($_GET['multicomplet'] == "done"):?>
                <div class="subform_cont1">
                    <div class="popup_multi">
                        <table width="100%" align="center" cellspacing="0" class="list" style="">
                            <tr valign="baseline" height="40">
                                <td style="" colspan="6" align="center" valign="middle">

                                </td>      
                            </tr>
                            <tr valign="baseline" height="40">
                                <td style="" colspan="6" align="center" valign="middle">
                                    <h4>Complete</h4>
                                </td>      
                            </tr>
                            <tr valign="baseline" height="130">
                                <td style="font-size:14px; color:#666;" colspan="6" align="center" valign="middle">
                                    <p>Updated information,<br/>
                                    click ok to redirect to the home page and enter the system</p>
                                </td>      
                            </tr>
                            <tr valign="baseline" height="53">
                                <td style="" colspan="6" align="center" valign="middle">
                                    <a href="index.php"><input class="button" style="width: 170px; padding: 20px 65px; text-align: center;" value="To Log in" /></a>
                                </td>      
                            </tr>
                        </table>
                    </div>
                </div>
            <?php endif ?>
                <div class="col_1">
                    <div class="lin_3" style="color: #FFF;">
                    <h1>Welcome</h1>
                    <h2>Complete the information form to access</h2>
                    </div>
                </div>
                <div class="col_2">
                    <div class="formular_multi" style="">
                        <form action="index.php" method="post" name="formmulticomplet" id="formmulticomplet">
                            <table width="85%" align="center" cellspacing="0" class="list">
                                <tr valign="baseline">
                                    <td style="" colspan="6" align="center" valign="middle"><h1>Information form.</h1></td>      
                                </tr>
                                <tr valign="baseline" class="form_height">
                                    <td colspan="6" valign="middle" align="center">
                                        <input class="text_input_form1" style="width:90%;" type="email" name="email" id="email" placeholder="Enter your E-Mail..." title="Enter a valid email" value="<?php echo ObtenerEmailUsuario($_GET['multicomplet']);?>" disabled/>
                                    </td>
                                </tr>
                                <tr valign="baseline" class="form_height">
                                    <td style="" colspan="6" valign="middle" align="center">
                                        <input class="text_input_form1" style="width:90%;" type="password" name="password" id="password" placeholder="Enter your Password *" required/>
                                    </td>
                                </tr>
                                <tr valign="baseline" class="form_height">
                                    <td colspan="6" valign="middle" align="center" style="border-top:1px solid #999;">
                                        <input class="text_input_form1" style="width:90%;" type="text" name="name" id="name" placeholder="Enter your name *" value="<?php echo $row_DatosFees['name'];?>" required/>
                                    </td>
                                </tr>
                                <tr valign="baseline" class="form_height">
                                    <td style="" colspan="6" valign="middle" align="center">
                                        <input class="text_input_form1" style="width:90%;" type="text" name="surname" id="surname" placeholder="Enter your surname *" value="<?php echo $row_DatosFees['surname'];?>" required/>
                                    </td>
                                </tr>
                                <!-- <tr valign="baseline" class="form_height">
                                    <td style="" colspan="6" valign="middle" align="center">
                                        <input class="text_input_form1" style="width:90%;" type="text" minlength="10" maxlength="10" name="personal_number" id="personal_number" placeholder='Your Personal number "10 digits" (Optional)' value="<?php echo $row_DatosFees['personal_number'];?>"/>
                                    </td>
                                </tr> -->
                                <tr valign="baseline" class="form_height">
                                    <td style="" colspan="6" valign="middle" align="center">
                                        <input class="text_input_form1" style="width:90%;" type="text" name="phone" id="phone" placeholder="Enter your phone number *" value="<?php echo $row_DatosFees['phone'];?>" required/>
                                    </td>
                                </tr>
                                <tr valign="baseline" class="form_height">
                                    <td style="padding-top:5px;" nowrap="nowrap" align="center">
                                        <input style="padding: 20px 125px;" type="submit" class="button" value="DONE" />
                                    </td>
                                </tr>
                            </table>
                            <input type="hidden" name="status" id="status" value="1"/>
                            <input type="hidden" name="id_user" id="id_user" value="<?php echo $_GET['multicomplet']; ?>"/>
                            <input type="hidden" name="MM_insert" id="MM_insert" value="formmulticomplet" />
                        </form>
                    </div>
                </div>
        <?php endif ?>
    </div>
</body>
</html>