<?php
session_start();
require_once '../class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

$sth = $user_home->runQuery("SELECT unitPrice, quantity, finalprice, tdate FROM tbl_orders");
$sth->execute();

// if(isset($_POST['btn-update-lpg-price']))
// {
// 	$lpgCylinderPrice = trim($_POST['lpg-cylinder-price']);

// 	$lpgUpdate = $user_home->runQuery("UPDATE `tbl_product_prices` SET `gas_unit_price`=$lpgCylinderPrice WHERE 1");
// 	$lpgUpdate->execute();

// 	$user_home->redirect('dashboard.php');
// }

// if(isset($_POST('btn-update-vat-percentage'))) {
// 	$vatPercentage = trim($_POST['vat-percentage']);

// 	$vatPercentageUpdate = $user_home->runQuery("UPDATE `tbl_product_prices` SET `vat_percent`=$vatPercentage WHERE 1");
// 	$vatPercentageUpdate->execute();

// 	$user_home->redirect('dashboard.php');
// }

?>

<!doctype html>
<html ng-app="storeApp">
	<head>
		<title>GasMarket.In</title>
		<meta charset="utf-8">
		<meta name="description" content="Gas market online gas delivery portal">
		<meta name="author" content="GasMarket Team">
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

	    <!-- Web Fonts -->
	    <!--<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>
		-->
		<link rel="stylesheet" href="../css/bootstrap.min.css">

		
	    <!-- CSS Footer -->
	    <link rel="stylesheet" href="../css/footer-v7.css">

	    <!-- CSS Implementing Plugins -->
	    <link rel="stylesheet" href="../css/animate-unify.css">
	    <link rel="stylesheet" href="../css/style-unify.css">
	    <link rel="stylesheet" href="../css/line-icons/line-icons.css">
	    <link rel="stylesheet" href="../css/font-awesome/css/font-awesome.min.css">
	    <link rel="stylesheet" href="../css/parallax-slider/css/parallax-slider.css">
	    <link rel="stylesheet" href="../css/fancybox/source/jquery.fancybox.css">
	    <link rel="stylesheet" href="../css/owl-carousel/owl-carousel/owl.carousel.css">
    	<link rel="stylesheet" href="../css/shop.style.css">
    	<link rel="stylesheet" href="../css/jquery.mCustomScrollbar.css">
		
		<link rel="stylesheet" href="../css/superslides.css">
		<link rel="stylesheet" href="../css/style.css">
		<link rel="stylesheet" href="../css/icons.css">
		<link rel="stylesheet" href="../css/animate.min.css">
		<link rel="stylesheet" href="../css/green.css" class="colors">

		<link rel="shortcut icon" href="../img/ico/32.png" sizes="32x32" type="image/png"/>
		<link rel="apple-touch-icon-precomposed" href="../img/ico/60.png" type="image/png"/>
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../img/ico/72.png" type="image/png"/>
		<link rel="apple-touch-icon-precomposed" sizes="120x120" href="../img/ico/120.png" type="image/png"/>
		<link rel="apple-touch-icon-precomposed" sizes="152x152" href="../img/ico/152.png" type="image/png"/>

	    <!-- CSS Global Compulsory -->
	    <link rel="stylesheet" href="../css/bootstrap.min.css">

	    <link rel="stylesheet" href="../css/footer-v1.css">


	    <!-- CSS Customization -->
	    <link rel="stylesheet" href="assets/css/custom.css">


		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body id="home">
		<div id="main-nav" class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#home">
						<img id="navlogo" src="../img/navlogo-green.png" alt="microstore" width="122" height="45">
					</a>

				</div>
				<div class="collapse navbar-collapse">
					<ul id="navigation" class="nav navbar-nav navbar-right text-center">
						<li><a href="#order-history">All Orders</a></li>
					</ul>
				</div>
			</div>
		</div>

		<section id="hero" class="light-typo ">
			<div class="container welcome-content">
				<div class="row">
					<div class="col-lg-5 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12 text-center wow fadeInUp">
						<img id="logo" src="../img/logo-green.png" class="img-responsive text-center" alt="shop logo" width="300">
						<h1>Welcome to <span style="color: #FF1744;">Gas</span><span style="color: #18ba9b;">Market</span></h1>
						<h2>Order Commercial LPG Online</h2><h3>No Deposit | Lower Prices | Lower Gas Consumption | Hassle Free</h3>

						<a class="btn btn-store smooth-scrool" href="logout.php">Logout</a>
					</div>
				</div>
			</div>
			<div class="overlay-bg"></div>
			<div id="hero-slides">
				<div class="slides-container">
					<img src="../img/home_carousel_bg1.jpg" alt="">
					<img src="../img/home_carousel_bg3.jpg" alt="">
					<img src="../img/home_carousel_bg2.jpg" alt="">
				</div>
			</div>
		</section>


	    <div class="margin-bottom-30" id="order-history">
	        <section id="orderform" class="gray-bg padding-top-bottom" ng-controller="orderController">
			<div class="container">
	            <div class="headline-center margin-bottom-60" id="order-history">
	                <h2>Order History</h2>
	            </div>
				<form method="post" novalidate id="order-form">
					<div class="row">
						<div class="col-sm-12 col-md-12">
						<table class="table">
						  <thead>
							<tr>
							  <th class="text-left">Product</th>
							  <th>
							  	<span class="text-left hidden-xs">Unit Cost (Rs)</span>
							  	<span class="text-left visible-xs">Cost(Rs)</span>
							  </th>
							  <th class="text-left">
							  <span class="hidden-xs">Quantity</span>
							  <span class="visible-xs">QNT</span>
							  </th>
							  <th class="text-left">Total</th>
							  <th class="text-left">Purchase Date</th>
							</tr>
						  </thead>
						  <tbody>
						  	<?php
								while ($rows = $sth->fetch(PDO::FETCH_ASSOC)) {
									printf("<tr><td class='text-left vert-align'>17 Kg Cylinder</td><td class='text-left vert-align'>%s</td><td class='text-left vert-align'>%s</td><td class='text-left vert-align'>%s</td><td class='text-left vert-align'>%s</td></tr>", $rows["unitPrice"], $rows["quantity"], $rows["finalprice"], substr($rows["tdate"],0, 10));
								}
							?>

							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						  </tbody>
						</table>
					</div>	
				</div>
				</form>
			</div>
			</section>
		</div>

		<div class="margin-bottom-30" id="order-history">
	        <section id="orderform" class="gray-bg padding-top-bottom" ng-controller="orderController">
			<div class="container">
	            <div class="headline-center margin-bottom-60" id="order-history">
	                <h2>Update Prices</h2>
	            </div>
				<form method="post">
					<div class="row col-sm-12 col-md-6" style="margin-bottom: 50px;">
						<div class="col-sm-9">
							<input type="text" name="lpg-cylinder-price" placeholder="LPG Unit Cost" class="form-control" required>
						</div>
						<div class="col-sm-3">
							<button type='submit' class='btn-u btn-block' name='btn-update-lpg-price' style='width:125px;'>Update LPG</button>
						</div>
					</div>
				</form>


				<form method="post">
					<div class="row col-sm-12 col-md-6" style="margin-bottom: 50px;">
						<div class="col-sm-9">
							<input type="text" name="vat-percentage" placeholder="VAT Percentage" class="form-control" required>
						</div>
						<div class="col-sm-3">
							<button type='submit' class='btn-u btn-block' name='btn-update-vat-percentage' style='width:150px;'>Update VAT</button>
						</div>
					</div>
				</form>
			</div>
			</section>
		</div>

		<script type="text/javascript" src="../js/jquery.min.js"></script>
		<script type="text/javascript" src="../js/angular.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../js/jquery.singlePageNav.min.js"></script>
		<script type="text/javascript" src="../js/jquery.superslides.min.js"></script>
		<script type="text/javascript" src="../js/jquery.countdown.min.js"></script>
		<script type="text/javascript" src="../js/wow.min.js"></script>
		<script type="text/javascript" src="../js/custom.js"></script>
		<script type="text/javascript" src="../js/app.js"></script>
		<script type="text/javascript" src="../js/custom-unify.js"></script>
		<script type="text/javascript" src="../js/app-unify.js"></script>
	</body>
</html>