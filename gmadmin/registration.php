<?php
error_reporting(0);

session_start();
require_once '../class.user.php';

$reg_user = new USER();

if(isset($_POST['btn-signup']))
{
    $uname = trim($_POST['txtuname']);
    $email = trim($_POST['txtemail']);
    $upass = trim($_POST['txtpass']);
    $mobnum = trim($_POST['txtmobnum']);
    $code = md5(uniqid(rand()));
    
    $stmt = $reg_user->runQuery("SELECT * FROM tbl_admin WHERE userEmail=:email_id OR userName=:user_name");
    $stmt->execute(array(":email_id"=>$email, ":user_name"=>$uname));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    
    if($stmt->rowCount() > 0)
    {
        $msg = "
              <div class='alert alert-error' align='text-center'>
                <!-- <button class='close' data-dismiss='alert'>&times;</button> -->
                    <strong>Sorry !</strong> Username/Email already exists, please try another one
              </div>
              ";
    }
    else
    {
        if($reg_user->registerAdmin($uname,$email,$upass,$code,$mobnum))
        {           
            $id = $reg_user->lasdID();      
            $key = base64_encode($id);
            $id = $key;
            
            $message = "                    
                        Hello $uname,
                        <br /><br />
                        Welcome to GasMarket.In!<br/>
                        To complete your registration  please , just click following link<br/>
                        <br /><br />
                        <a href='http://localhost/x/verify.php?id=$id&code=$code'>Click HERE to Activate :)</a>
                        <br /><br />
                        Thanks,";
                        
            $subject = "Confirm Registration";
                        
            $reg_user->send_mail($email,$message,$subject); 
            $msg = "
                    <div class='alert alert-success' align='text-center'>
                        <!-- <button class='close' data-dismiss='alert'>&times;</button> -->
                        <strong>Congrats!!</strong> Your admin account has been created. 
                    </div>
                    ";
        }
        else
        {
            echo "sorry , Query could no execute...";
        }       
    }
}
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <title>Register - GasMarket.In</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Web Fonts -->
    <link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style-unify.css">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/line-icons.css">
    <link rel="stylesheet" href="../css/font-awesome/css/font-awesome.min.css">

    <!-- CSS Page Style -->
    <link rel="stylesheet" href="../css/page_log_reg_v2.css">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="../css/custom.css">
</head>

<body>
<!--=== Content Part ===-->
<div class="container">
    <!--Reg Block-->
    <div class="reg-block-signup">

        <div class="reg-block-header">
            <h2>Sign Up</h2>
            <p>Already Signed Up? Click <a class="color-green" href="index.php">Sign In</a> to login your account.</p>
        </div>


        <?php if(isset($msg)) echo $msg;  ?>
        <form method="POST">
            <div class="input-group margin-bottom-20">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control" placeholder="Username" name="txtuname" required>
            </div>
            <div class="input-group margin-bottom-20">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" class="form-control" placeholder="Email" name="txtemail" onblur="javascript: validateEmail();" required>
                <span id="email-correct" class="input-group-addon" style="display: none;"><i class="fa fa-check" style="color:green;"></i></span>
                <span id="email-wrong" class="input-group-addon" style="display: none;"><i class="fa fa-close" style="color:red;"></i></span>
            </div>
            <div class="input-group margin-bottom-20">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control" placeholder="Password" name="txtpass" onblur="javascript: validatePassword();" required>
            </div>
            <div class="input-group margin-bottom-20">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="password" class="form-control" placeholder="Confirm Password" name="txtconfirmpass" onblur="javascript: validatePassword();" required>
                <span id="confirm-password-correct" class="input-group-addon" style="display: none;"><i class="fa fa-check" style="color:green;"></i></span>
                <span id="confirm-password-wrong" class="input-group-addon" style="display: none;"><i class="fa fa-close" style="color:red;"></i></span>
            </div>
            <div class="input-group margin-bottom-20">
                <span class="input-group-addon"><i class="fa fa-mobile"></i></span>
                <input type="text" class="form-control" placeholder="Mobile Number" name="txtmobnum" onblur="javascript: validatePhoneNumber();" required>
                <span id="phone-correct" class="input-group-addon" style="display: none;"><i class="fa fa-check" style="color:green;"></i></span>
                <span id="phone-wrong" class="input-group-addon" style="display: none;"><i class="fa fa-close" style="color:red;"></i></span>
            </div>
            <hr>

            <div class="checkbox">
                <label>
                    <input type="checkbox" required>
                    I accept the <a target="_blank" href="#">Terms and Conditions</a>
                </label>
            </div>

            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <button type="submit" class="btn-u btn-block" name="btn-signup" id="register-btn">Register</button>
                </div>
            </div>
        </form>
    </div>
    <!--End Reg Block-->
</div><!--/container-->
<!--=== End Content Part ===-->

<!-- JS Global Compulsory -->
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery-migrate.min.js"></script>
<script type="text/javascript" src="../js/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/myjs.js"></script>
<!-- JS Implementing Plugins -->
<script type="text/javascript" src="../js/jquery.backstretch.min.js"></script>
<!-- JS Customization -->
<script type="text/javascript" src="../js/custom.js"></script>
<!-- JS Page Level -->
<script type="text/javascript" src="../js/app.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {

        App.init();
        $('[data-toggle="tooltip"]').tooltip();


    });
</script>
<script type="text/javascript">
    $.backstretch([
      "../img/login_1.jpg",
      "../img/login_2.jpg",
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