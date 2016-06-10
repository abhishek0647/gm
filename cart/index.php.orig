<?php

error_reporting(0);
session_start();
require_once '../class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
    $user_home->redirect('../index.html');
}

$filterCondition = $_SESSION['userSession'];
$strFilter = strval($filterCondition);

$sth = $user_home->runQuery("SELECT gas_unit_price, vat_percent FROM tbl_product_prices");
$sth->execute();

while ($rows = $sth->fetch(PDO::FETCH_ASSOC)) {
    $gas_unit_price = $rows['gas_unit_price'];
    $vat_percent = $rows['vat_percent'];
    $vat_amount = $gas_unit_price * $vat_percent / 100;
    $total_amount = $gas_unit_price + $vat_amount;
}

$filterCondition = $_SESSION['userSession'];
$strFilter = strval($filterCondition);

// public function placeOrder($uid, $unitPrice, $quantity, $vatAmount, $finalprice, $firstname, $lastname, $tperson, $contactNum, $addr1, $addr2, $city, $pincode) 

if(isset($_POST['btn-place-order']))
{
    $uid = trim($strFilter);
    $unitPrice = trim($gas_unit_price);

    $quantity = intval($_POST['qty1-name']);
    $vatAmount = floatval($_POST['vatAmount-name']);
    $finalprice = floatval($_POST['final-price-name']);

    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $tperson = trim($_POST['contactPerson']);
    $contactNum = intval(trim($_POST['phone']));
    $addr1 = trim($_POST['address1']);
    $addr2 = trim($_POST['address2']);
    $city = trim($_POST['city']);
    $pincode = intval(trim($_POST['zip']));

    $user_home->placeOrder($uid, $unitPrice, $quantity, $vatAmount, $finalprice, $firstname, $lastname, $tperson, $contactNum, $addr1, $addr2, $city, $pincode);
    
    $user_home->redirect('../dashboard.php#orderform');
           
}
?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title>GasMarket.In</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Web Fonts -->
    <link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>

    <link rel="stylesheet" href="css/superslides.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/icons.css">
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/green.css" class="colors">

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/shop.style.css">
    
    <!-- CSS Header and Footer -->
    
    <link rel="stylesheet" href="css/footer-v1.css">
    <link rel="stylesheet" href="css/footer-v7.css">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="assets/plugins/animate.css">    
    <link rel="stylesheet" href="assets/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/plugins/jquery-steps/css/custom-jquery.steps.css">
    <link rel="stylesheet" href="assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
    
    <!-- Style Switcher -->
    <link rel="stylesheet" href="assets/css/plugins/style-switcher.css">

    <!-- CSS Theme -->
    <link rel="stylesheet" href="assets/css/theme-colors/default.css" id="style_color">
    
    <!-- CSS Customization -->
    <link rel="stylesheet" href="assets/css/custom.css">

<<<<<<< HEAD
</head>	
=======
</head> 
>>>>>>> 312cff3c1fc1f7d96ec6abd9cf626400568c2e6e
<body id="home" onload="javascript:updateReviewOrder();">
    <div id="main-nav" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <img id="navlogo" src="img/navlogo-green.png" alt="microstore" width="122" height="45">
                </a>

            </div>
            <div class="collapse navbar-collapse">
                <ul id="navigation" class="nav navbar-nav navbar-right text-center">
                    <li><a href="../logout.php">Logout</a>
                </ul>
            </div>

        </div>
    </div>
<div class="wrapper">
    <!--=== Content Medium Part ===-->
    <div class="content-md margin-bottom-30">
        <div class="container">
            <form method="POST" class="shopping-cart" action="#">
                <div>
                    <div class="header-tags">            
                        <div class="overflow-h">
                            <h2>Shopping Cart</h2>
                            <p>Review &amp; edit your product</p>
                            <i class="rounded-x fa fa-shopping-cart"></i>
                        </div>    
                    </div>
                    <section>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price (Rs)</th>
                                        <th>Qty</th>
                                        <th>Total (Rs)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="product-in-table">
                                            <img class="img-responsive" src="../img/supergas_logo.png" alt="">
                                            <div class="product-it-in">
                                                <h3>17 Kg Cylinder</h3>
                                            </div>    
                                        </td>
                                        <td>
                                            <span id="unit-price" ><?php echo $gas_unit_price ?></span>
                                        </td>
                                        <td>
                                            <button type='button' class="quantity-button" name='subtract' onclick='javascript: subtractQty1();' id='subtract' value='-'>-</button>
                                            <input type='text' class="quantity-field" value="1" id='qty1' disabled />
                                            <input type='hidden' class="quantity-field" name='qty1-name' value="1" id='qty1-hidden' />
                                            <button type='button' class="quantity-button" name='add' onclick='javascript: addQty1();' value='+'>+</button>
                                        </td>
                                        <td class="shop-red">
                                            <span class="shop-red" id="total-price" ><?php echo $gas_unit_price ?></span>
                                            <input type="hidden" name="total-price-name" id="total-price-input" value=<?php echo $gas_unit_price ?> />
                                        </td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                    
                    <div class="header-tags">
                        <div class="overflow-h">
                            <h2>Billing info</h2>
                            <p>Shipping and address info</p>
                            <i class="rounded-x fa fa-home"></i>
                        </div>    
                    </div>
                    <section class="billing-info">
                        <div class="row">
                            <div class="col-md-12 md-margin-bottom-40">
                                <h2 class="title-type">Billing Address</h2>
                                <div class="billing-info-inputs checkbox-list">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input id="name" type="text" placeholder="First Name" name="firstname" class="form-control required">
                                            <input id="surname" type="text" placeholder="Last Name" name="lastname" class="form-control required">
                                        </div>
                                        <div class="col-sm-6">
                                            <input id="contactPerson" type="text" placeholder="Contact Person" name="contactPerson" class="form-control required">
                                            <input id="phone" type="tel" placeholder="Phone" name="phone" class="form-control required">
                                        </div>
                                    </div>
                                    <input id="billingAddress" type="text" placeholder="Address Line 1" name="address1" class="form-control required">
                                    <input id="billingAddress2" type="text" placeholder="Address Line 2" name="address2" class="form-control required">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input id="city" type="text" placeholder="City" name="city" class="form-control required">
                                        </div>
                                        <div class="col-sm-6">
                                            <input id="zip" type="text" placeholder="Zip/Postal Code" name="zip" class="form-control required">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>       
                    </section>
                        
                    <div class="header-tags">
                        <div class="overflow-h">
                            <h2>Order Confirmation</h2>
                            <p>Please confirm your purchase</p>
                            <i class="rounded-x fa fa-check"></i>
                        </div>    
                    </div>

                    <section>
                        <div class="container" id="our-vision">
                            <div class="headline-center margin-bottom-60">
                                <h2>Order Review</h2>
                                <h3 id="order-review"><b>Thank you for using GasMarket. We have received the order</b></h3>
                            </div><!--/end Headline Center-->
                        </div>
                    </section>

                    <div class="coupon-code">
                        <div class="row">
                            <div class="col-sm-3 col-sm-offset-9">
                                <ul class="list-inline total-result">
                                    <li>
                                        <h4>Subtotal (Rs):</h4>
                                        <div class="total-result-in">
                                            <span id="subtotal"><?php echo $gas_unit_price ?></span>
                                            <input type="hidden" name="subtotal" id="subtotal-input" value=<?php echo $gas_unit_price ?> /">
                                        </div>    
                                    </li>
                                    <li>
                                        <h4>VAT (Rs):</h4>
                                        <div class="total-result-in">
                                            <span id="vat" ><?php echo $vat_amount ?></span>
                                            <input id="vat-input" type="hidden" value=<?php echo $vat_amount ?> name="vatAmount-name" />
                                        </div>    
                                    </li>    
                                    <li>
                                        <h4>Shipping:</h4>
                                        <div class="total-result-in">
                                            <span class="text-right">- - - -</span>
                                        </div>
                                    </li>
                                    <li class="total-price">
                                        <h4>Total (Rs):</h4>
                                        <div class="total-result-in">
                                            <span id="final-price" ><?php echo $total_amount ?></span>
                                            <input type="hidden" name="final-price-name" id="final-price-input" value=<?php echo $total_amount ?> /">
                                        </div>
                                    </li>
                                    <li class="divider"></li>
                                </ul>
                            </div>
                        </div>
                    </div>    
                </div>
            </form>
        </div><!--/end container-->
    </div>
    <!--=== End Content Medium Part ===-->     

    <!-- Contact Section -->
    <section id="contact" class="contacts-section">
        <div class="container content-lg">
            <div class="title-v1">
                <h2>Contact Us</h2>
                <p>Our support team is always by your side for any eventuality or support that you may require.</p>
            </div>

            <div class="row contacts-in">
                <div class="col-md-6 md-margin-bottom-40">
                    <ul class="list-unstyled">
                        <li><i class="fa fa-phone"></i> (+91) 98452 85084</li>
                        <li><i class="fa fa-envelope"></i> <a href="abhishek@mktplace.in">abhishek@mktplace.in</a></li>
                        <li><i class="fa fa-globe"></i> <a href="#">www.gasmarket.in</a></li>
                    </ul>
                </div>

                <div class="col-md-6">
                    <form action="#" method="post" id="sky-form3" class="sky-form contact-style">
                        <fieldset>
                            <label>Name <span class="color-red">*</span></label>
                            <div class="row">
                                <div class="col-md-7 margin-bottom-20 col-md-offset-0">
                                    <div>
                                        <input type="text" name="name" id="name" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <label>Email <span class="color-red">*</span></label>
                            <div class="row">
                                <div class="col-md-7 margin-bottom-20 col-md-offset-0">
                                    <div>
                                        <input type="text" name="email" id="email" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <label>Message <span class="color-red">*</span></label>
                            <div class="row">
                                <div class="col-md-11 margin-bottom-20 col-md-offset-0">
                                    <div>
                                        <textarea rows="8" name="message" id="message" class="form-control" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <p><button type="submit" class="btn-u btn-brd btn-brd-hover btn-u-dark">Send Message</button></p>
                        </fieldset>

                        <div class="message">
                            <i class="rounded-x fa fa-check"></i>
                            <p>Your message was successfully sent!</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End Contact Section -->

</div><!--/wrapper-->

<!-- JS Global Compulsory -->           
<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/jquery/jquery-migrate.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- JS Implementing Plugins -->
<script src="assets/plugins/back-to-top.js"></script>
<script src="assets/plugins/smoothScroll.js"></script>
<script src="assets/plugins/jquery-steps/build/jquery.steps.js"></script>
<script src="assets/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="assets/plugins/sky-forms-pro/skyforms/js/jquery.validate.min.js"></script>
<!-- JS Customization -->
<script src="assets/js/custom.js"></script>
<!-- JS Page Level -->           
<script src="assets/js/shop.app.js"></script>
<script src="assets/js/forms/page_login.js"></script>
<script src="assets/js/plugins/stepWizard.js"></script>
<script src="assets/js/forms/product-quantity.js"></script>

<script type="text/javascript" src="js/angular.min.js"></script>
<script type="text/javascript" src="js/jquery.superslides.min.js"></script>
<script type="text/javascript" src="js/jquery.singlePageNav.min.js"></script>
<script type="text/javascript" src="js/jquery.countdown.min.js"></script>
<script type="text/javascript" src="js/wow.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/app.js"></script>
<script type="text/javascript" src="js/custom-unify.js"></script>
<script type="text/javascript" src="js/app-unify.js"></script>
<script>
    jQuery(document).ready(function() {
        App.init();
        Login.initLogin();
        App.initScrollBar();        
        StepWizard.initStepWizard();
        StyleSwitcher.initStyleSwitcher();      
    });
</script>

<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/plugins/sky-forms-pro/skyforms/js/sky-forms-ie8.js"></script>
<![endif]-->
<!--[if lt IE 10]>
    <script src="assets/plugins/sky-forms-pro/skyforms/js/jquery.placeholder.min.js"></script>
<![endif]-->

</body>
</html> 