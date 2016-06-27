<?php
session_start();
require_once '../class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

if($_GET['status'] == 'success') {
	$msg = "<div class='alert alert-success' align='text-center'>
                        <button class='close' data-dismiss='alert'>&times;</button>
                        <strong>Congrats!!</strong> The product prices has been updated. 
                    </div>";
}

$sth = $user_home->runQuery("SELECT * FROM tbl_orders ORDER BY tdate DESC");
$sth->execute();

$sth1 = $user_home->runQuery("SELECT * FROM tbl_product_prices");
$sth1->execute();

$sth2 = $user_home->runQuery("SELECT * FROM tbl_orders ORDER BY tdate DESC");
$sth2->execute();

while ($rows = $sth1->fetch(PDO::FETCH_ASSOC)) {
    $gas_unit_price = $rows['gas_unit_price'];
    $vat_percent = $rows['vat_percent'];
    $shipping_cost = $rows['shipping_cost'];
}

?>

<!doctype html>
<html ng-app="storeApp">
	<head>
		<title>GasMarket.In</title>
		<meta charset="utf-8">
		<meta name="description" content="Order Commercial Gas Online">
		<meta name="author" content="Abhishek Kumar">
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
					<a href="#home">
						<!-- <img id="navlogo" src="../img/navlogo-green.png" alt="microstore" width="122" height="45"> -->
						<h1><span style="color: #FF1744;">Gas</span><span style="color: #18ba9b;">Market</span></h1>
					</a>

				</div>
				<div class="collapse navbar-collapse">
					<ul id="navigation" class="nav navbar-nav navbar-right text-center">
						<li><a href="#order-history">All Orders</a></li>
						<li><a href="#update-prices">Update Prices</a></li>
					</ul>
				</div>
			</div>
		</div>

		<section id="hero" class="light-typo ">
			<div class="container welcome-content">
				<div class="row">
					<div class="col-lg-5 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12 text-center wow fadeInUp">
						<!-- <img id="logo" src="../img/logo-green.png" class="img-responsive text-center" alt="shop logo" width="300"> -->
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
	            <div class="headline-center margin-bottom-60">
	                <h2>Order History</h2>
	            </div>
				<form method="post" novalidate id="order-form">
					<div class="row">
						<div class="col-sm-12 col-md-12">
						<table class="table">
						  <thead>
							<tr>
							  <th class="text-center col-sm-3">Order ID</th>
							  <th class="text-center col-sm-3">Order Date</th>
							  <th class="text-center col-sm-3">No. Of Cylinders</th>
							  <th class="col-sm-3"><th>
							</tr>
						  </thead>
						  <tbody>
						  	<?php
								while ($rows = $sth->fetch(PDO::FETCH_ASSOC)) {
									$dateString = substr($rows["tdate"],0, 10);
									$myDateTime = DateTime::createFromFormat('Y-m-d', $dateString);
									$newDateString = $myDateTime->format('d/m/Y');

									printf("<tr><td class='text-center vert-align col-sm-3'>%s</td><td class='text-center vert-align col-sm-3'>%s</td><td class='text-center vert-align col-sm-3'>%s</td><td class='text-center vert-align col-sm-3'><button type='button' class='btn btn-primary btn-lg' data-toggle='modal' data-target='%s'>View Details</button></td></tr>", $rows["tid"], $newDateString, $rows["quantity"], '#'.$rows['tid']);
								}
							?>

							<tr>
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

		<?php
			while ($rowss = $sth2->fetch(PDO::FETCH_ASSOC)) {
				$dateString = substr($rowss["tdate"],0, 10);
				$myDateTime = DateTime::createFromFormat('Y-m-d', $dateString);
				$newDateString = $myDateTime->format('d/m/Y');

				$contactPerson = $rowss["tperson"];
				$addr1 = $rowss["addr1"];
				$addr2 = $rowss["addr2"];
				$city = $rowss["city"];
				$pincode = $rowss["pincode"];
				$contactNum = $rowss["contactNum"];
				$deliveryAddress = $contactPerson."<br>".$addr1."<br>".$addr2."<br>".$city."<br>".$pincode."<br>Phone: ".$contactNum;

				printf('<div class="modal fade" id="%s" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog modal-lg" role="document">
						    <div class="modal-content">
						      <div class="modal-body">
						      	<table class="table table-bordered">
								  <thead>
									<tr>
									  <th class="text-center">Order Id</th>
									  <th class="text-center">Order Date</th>
									  <th class="text-center">Delivery Location</th>
									  <th class="text-center">No. Of Cylinders</th>
									  <th class="text-center">Cost/Unit</th>
									  <th class="text-center">VAT</th>
									  <th class="text-center">Shipping</th>
									  <th class="text-center">Total Amount</th>
									</tr>
								  </thead>
								  <tbody>
							        <tr><td class="text-center vert-align">%s</td><td class="text-center vert-align">%s</td><td class="text-center vert-align">%s</td><td class="text-center vert-align">%s</td><td class="text-center vert-align">%s</td><td class="text-center vert-align">%s</td><td class="text-center vert-align">%s</td><td class="text-center vert-align">%s</td></tr>
							        </tbody>
						        </table>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						      </div>
						    </div>
						  </div>
						</div>', $rowss["tid"], $rowss["tid"], $newDateString, $deliveryAddress, $rowss["quantity"],  $rowss["unitPrice"], $rowss["vatAmount"], $rowss["shippingAmount"], $rowss["finalprice"]
				);
			}
		?>

		<div class="margin-bottom-30" id="update-prices">
			<div class="container">
	            <div class="headline-center margin-bottom-60">
	                <h2>Update Prices</h2>
	            </div>
	            <?php if(isset($msg)) echo $msg;  ?>
	            <form method="POST" action="update-price.php">
	            	<p>LPG Unit Price :</p>
	            	<input type="text" class="form-control margin-bottom-30" placeholder="LPG Unit Price" value="<?php echo $gas_unit_price ?>" name="txtlpgprice" required>
	            	<p>Vat Percentage :</p>
	            	<input type="text" class="form-control margin-bottom-30" placeholder="VAT Percentage" value="<?php echo $vat_percent ?>" name="txtVatPercentage" class="form-control" required>
	            	<p> Shipping Cost :</p>
	            	<input type="text" class="form-control margin-bottom-30" placeholder="Shipping Charge" value="<?php echo $shipping_cost ?>" name="txtShippingCost" class="form-control" required>
	            	<button type="submit" class="btn-u btn-block" name="btn-update-lpg">Update Price</button>
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