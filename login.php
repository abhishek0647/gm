<?php
session_start();
require_once 'class.user.php';
$user_login = new USER();

if($user_login->is_logged_in()!="")
{
    $user_login->redirect('dashboard.php');
}

if(isset($_POST['btn-login']))
{
    $email = trim($_POST['txtemail']);
    $upass = trim($_POST['txtupass']);
    
    if($user_login->login($email,$upass))
    {
        $user_login->redirect('dashboard.php');
    }
}
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <title>Login - GasMarket.In</title>

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
    <link rel="stylesheet" href="css/animate-unify.css">
    <link rel="stylesheet" href="css/line-icons.css">
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">

    <!-- CSS Page Style -->
    <link rel="stylesheet" href="css/page_log_reg_v2.css">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/app-unify.css">
</head>

<body>
<!--=== Content Part ===-->
<div class="container">
    <!--Reg Block-->
    <div class="reg-block-signin">
        <div class="reg-block-header">
            <h2>Sign In</h2>
            <p>Don't Have Account? Click <a class="color-green" href="registration.php">Sign Up</a> to register.</p>
        </div>

        <?php 
        if(isset($_GET['inactive']))
        {
            ?>
            <div class='alert alert-error'>
                <button class='close' data-dismiss='alert'>&times;</button>
                <strong>Sorry!</strong> This Account is not Activated Go to your Inbox and Activate it. 
            </div>
            <?php
        }
        ?>
        
        <?php
        if(isset($_GET['error']))
        {
            ?>
            <div class='alert alert-success'>
                <button class='close' data-dismiss='alert'>&times;</button>
                <strong>Wrong Details!</strong> 
            </div>
            <?php
        }
        ?>

        <form method="POST">
            <div class="input-group margin-bottom-20">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" class="form-control" placeholder="Email" name="txtemail" required>
                <h2 id="resultEmail"></h2>
            </div>
            <div class="input-group margin-bottom-20">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control" placeholder="Password" name="txtupass" required>
            </div>
            <!-- <hr> -->

            <div class="checkbox">
                <label>
                    <input type="checkbox">
                    <p>Stay Signed In</p>
                </label>
            </div>

            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <button type="submit" class="btn-u btn-block" name="btn-login">Log In</button>
                </div>
            </div>
        </form>

        <hr>
        <h4>Forget your Password ?</h4>
        <p>No worries! <a class="color-green" href="#">Click here</a> to reset your password.</p>
        
    </div>
    <!--End Reg Block-->
</div><!--/container-->
<!--=== End Content Part ===-->

<!-- JS Global Compulsory -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-migrate.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!-- JS Implementing Plugins -->
<script type="text/javascript" src="js/back-to-top.js"></script>
<script type="text/javascript" src="js/jquery.backstretch.min.js"></script>
<!-- JS Customization -->
<script type="text/javascript" src="js/custom.js"></script>
<!-- JS Page Level -->
<script type="text/javascript" src="js/app.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        App.init();
    });
</script>
<script type="text/javascript">
    $.backstretch([
      "img/login_1.jpg",
      "img/login_2.jpg",
      ], {
        fade: 1000,
        duration: 7000
    });
</script>
<script type="text/javascript">
    function validateEmail(emailField){
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+(\.([A-Za-z]{2,4}))+$/;

        if (reg.test(emailField.value) == false) {
            alert('Invalid Email Address');
            return false;
        }

        return true;
    }
</script>

<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->

</body>
</html>