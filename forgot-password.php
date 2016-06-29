<?php
error_reporting(0);

session_start();
require_once 'class.user.php';

$reg_user = new USER();

if($_GET['status'] == 'noUserFound') {
	$msg = "<div class='alert alert-error' align='text-center'>
            <strong>Oops!!</strong> This email Id does not exist in our database. <a href='registration.php'>Click here</a> to register.
            <button class='close' style='top: 0px; right: 0px;' data-dismiss='alert'>&times;</button>
          </div>";
}

if($_GET['status'] == 'success') {
	$msg = "<div class='alert alert-success' align='text-center'>
            <strong>Email Sent!!</strong> Please check your inbox. <a href='login.php'>Click here</a> to login.
            <button class='close' style='top: 0px; right: 0px;' data-dismiss='alert'>&times;</button>
          </div>";
}
?>


<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <title>Forgot Password - GasMarket.In</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Order Commercial Gas Online">
    <meta name="author" content="Abhishek Kumar">

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Web Fonts -->
    <link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style-unify.css">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/line-icons.css">
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">

    <!-- CSS Page Style -->
    <link rel="stylesheet" href="css/page_log_reg_v2.css">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="css/custom.css">
</head>

<body>
<!--=== Content Part ===-->
<div class="container">
    <!--Reg Block-->
    <div class="col-md-6 col-md-offset-3" style="background: #fff; padding: 20px; margin-top: 15%; position: absolute; left:0; right:0;">
        <div class="reg-block-header">
            <h2>Forgot Password</h2>
        </div>


        <?php if(isset($msg)) echo $msg;  ?>
        <form method="POST" action="send-mail-fp.php">
            <div class="input-group margin-bottom-20">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" class="form-control" placeholder="Email" name="txtemail" required>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <button type="submit" class="btn-u btn-block" name="btn-signup" id="register-btn">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <!--End Reg Block-->
</div><!--/container-->
<!--=== End Content Part ===-->

<!-- JS Global Compulsory -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-migrate.min.js"></script>
<script type="text/javascript" src="js/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/myjs.js"></script>
<!-- JS Implementing Plugins -->
<script type="text/javascript" src="js/jquery.backstretch.min.js"></script>
<!-- JS Customization -->
<script type="text/javascript" src="js/custom.js"></script>
<!-- JS Page Level -->
<script type="text/javascript" src="js/app.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {

        App.init();
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<script type="text/javascript">
    $.backstretch([
      "img/home_carousel_bg1.jpg",
      "img/home_carousel_bg3.jpg",
      "img/home_carousel_bg2.jpg",
      ], {
        fade: 1000,
        duration: 7000
    });
</script>

<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->

</body>
</html>