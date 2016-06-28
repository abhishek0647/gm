<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

if($_GET['status'] == 'success') {
	$msg = "<div class='alert alert-success' align='text-center'>
                <button class='close' style='top: 0px; right: 0px;' data-dismiss='alert'>&times;</button>
                <strong>Thank you for contacting us!!<br></strong> Our support team will get in touch with you at the earliest. 
            </div>";
}

if($_GET['status'] == 'order-placed') {
	$msg = "<div class='alert alert-success' align='text-center'>
                <button class='close' style='top: 0px; right: 0px;' data-dismiss='alert'>&times;</button>
                <strong>Your Order has been placed successfully!!<br></strong><a href='#orderform'>Click here</a> to view your order history.
            </div>";
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$filterCondition = $_SESSION['userSession'];
$strFilter = strval($filterCondition);

$sth = $user_home->runQuery("SELECT tid, unitPrice, quantity, finalprice, tdate FROM tbl_orders where uid =$strFilter ORDER BY tdate DESC");
$sth->execute();

$sth1 = $user_home->runQuery("SELECT * FROM tbl_orders where uid =$strFilter ORDER BY tdate DESC");
$sth1->execute();

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
		<link rel="stylesheet" href="css/bootstrap.min.css">

		
	    <!-- CSS Footer -->
	    <link rel="stylesheet" href="css/footer-v7.css">

	    <!-- CSS Implementing Plugins -->
	    <link rel="stylesheet" href="css/animate-unify.css">
	    <link rel="stylesheet" href="css/style-unify.css">
	    <link rel="stylesheet" href="css/line-icons/line-icons.css">
	    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
	    <link rel="stylesheet" href="css/parallax-slider/css/parallax-slider.css">
	    <link rel="stylesheet" href="css/fancybox/source/jquery.fancybox.css">
	    <link rel="stylesheet" href="css/owl-carousel/owl-carousel/owl.carousel.css">
    	<link rel="stylesheet" href="css/shop.style.css">
    	<link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
		
		<link rel="stylesheet" href="css/superslides.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/icons.css">
		<link rel="stylesheet" href="css/animate.min.css">
		<link rel="stylesheet" href="css/green.css" class="colors">

		<link rel="shortcut icon" href="img/ico/32.png" sizes="32x32" type="image/png"/>
		<link rel="apple-touch-icon-precomposed" href="img/ico/60.png" type="image/png"/>
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/ico/72.png" type="image/png"/>
		<link rel="apple-touch-icon-precomposed" sizes="120x120" href="img/ico/120.png" type="image/png"/>
		<link rel="apple-touch-icon-precomposed" sizes="152x152" href="img/ico/152.png" type="image/png"/>

	    <!-- CSS Global Compulsory -->
	    <link rel="stylesheet" href="css/bootstrap.min.css">

	    <link rel="stylesheet" href="css/footer-v1.css">


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
						<!-- <img id="navlogo" src="img/navlogo-green.png" alt="microstore" width="122" height="45"> -->
						<h1><span style="color: #FF1744;">Gas</span><span style="color: #18ba9b;">Market</span></h1>
					</a>
				</div>
				<div class="collapse navbar-collapse">
					<ul id="navigation" class="nav navbar-nav navbar-right text-center">
						<li><a href="#order-history">My Orders</a></li>
						<!-- <li><a href="#testimonial">Testimonials</a></li> -->
						<li><a href="#about-us">About Us</a></li>
						<li><a href="#how-it-works">How It Works</a></li>
						<li><a href="#faq">FAQs</a></li>
						<li><a href="#contact">Contact Us</a></li>
					</ul>
				</div>

			</div>
		</div>

		<section id="hero" class="light-typo ">
			<div class="container welcome-content">
				<div class="row">
					<div class="col-lg-5 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12 text-center wow fadeInUp">
						<?php if(isset($msg)) echo $msg;  ?>
						<!-- <img id="logo" src="img/logo-green.png" class="img-responsive text-center" alt="shop logo" width="300"> -->
						<h1>Welcome to <span style="color: #FF1744;">Gas</span><span style="color: #18ba9b;">Market</span></h1>
						<h2>Order Commercial LPG Online</h2><h3>No Deposit | Lower Prices | Lower Gas Consumption | Hassle Free</h3>

						<!-- <a class="btn btn-store smooth-scroll" href="#order-history">My Orders</a> -->
						<a class="btn btn-store smooth-scroll" href="cart/index.php">Order Now</a>
						<a class="btn btn-store smooth-scrool" href="logout.php">Logout</a>
					</div>
				</div>
			</div>
			<div class="overlay-bg"></div>
			<div id="hero-slides">
				<div class="slides-container">
					<img src="img/home_carousel_bg1.jpg" alt="">
					<img src="img/home_carousel_bg3.jpg" alt="">
					<img src="img/home_carousel_bg2.jpg" alt="">
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

		<?php
			while ($rowss = $sth1->fetch(PDO::FETCH_ASSOC)) {
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

		<hr>
	        <!-- Flat Testimonials -->
	        <!-- <div class="flat-testimonials bg-image-v1 parallaxBg1 margin-bottom-60" id="testimonial">
	            <div class="container">
	                <div class="headline-center headline-light margin-bottom-60">
	                    <h2>What People Are Saying</h2>
	                    <p>Integer odio ligula, tincidunt id volutpat et, imperdiet eget mi. Quisque laoreet porttitor turpis sed. Nullam sodales blandit nisi, tristique tempor nunc hendrerit at. Sed posuere mollis orci</p>
	                </div>

	                <div class="row">
	                    <div class="col-sm-4">
	                        <div class="flat-testimonials-in md-margin-bottom-50">
	                            <img class="rounded-x img-responsive" src="img/testimonial_user2.jpg" alt="">
	                            <h3>Anthony Connor</h3>
	                            <span class="color-green">Software Developer</span>
	                            <p>Proin et augue vel nisi rhoncus tincidunt. Cras venenatis, magna id sem ipsum mi interduml</p>
	                        </div>
	                    </div>
	                    <div class="col-sm-4">
	                        <div class="flat-testimonials-in md-margin-bottom-50">
	                            <img class="rounded-x img-responsive" src="img/testimonial_user1.jpg" alt="">
	                            <h3>Angela Danil</h3>
	                            <span class="color-green">Web Designer</span>
	                            <p>Proin et augue vel nisi rhoncus tincidunt. Cras venenatis, magna id sem ipsum mi interduml</p>
	                        </div>
	                    </div>
	                    <div class="col-sm-4">
	                        <div class="flat-testimonials-in">
	                            <img class="rounded-x img-responsive" src="img/testimonial_user3.jpg" alt="">
	                            <h3>Anthony Connor</h3>
	                            <span class="color-green">Software Developer</span>
	                            <p>Proin et augue vel nisi rhoncus tincidunt. Cras venenatis, magna id sem ipsum mi interduml</p>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div> -->
	        <!-- End Flat Testimonials -->


	        <div class="container" id="about-us">
	            <div class="headline-center margin-bottom-60">
	                <h2>About Us</h2>
	               </div>
	                <div class="row">
	                    <div class="banner-info green margin-bottom-10">
	                        <i class="rounded-x fa fa-bookmark-o"></i>
	                        <div class="overflow-h">
	                            <p>GasMarket is a part of ‘Mktplace Ecom’, a Bangalore based B2B E-Commerce Company. GasMarket is India’s 1st commercial gas ordering portal focused on supplying commercial cooking gas (LPG) to Foods & Beverages (F&B) businesses in a cost effective, energy efficient & reliable way.</p>
	                        </div>
	                    </div>
	                    <div class="banner-info green margin-bottom-10">
	                        <i class="rounded-x fa fa-bookmark-o"></i>
	                        <div class="overflow-h">
	                            <p>GasMarket currently operates in Bangalore & plans to soon expand to other parts of India to take its value proposition to maximum F&B and other businesses nationwide.</p>
	                        </div>
	                    </div>
	                    <div class="banner-info green margin-bottom-10">
	                        <i class="rounded-x fa fa-bookmark-o"></i>
	                        <div class="overflow-h">
	                            <p>GasMarket is backed by a team of seasoned entrepreneurs & hospitality industry professionals who have deep understanding of the pain points of managing the gambit of cooking gas; one of the biggest costs for any F&B business.</p>
	                        </div>
	                    </div>
	                    <div class="banner-info green margin-bottom-10">
	                        <i class="rounded-x fa fa-bookmark-o"></i>
	                        <div class="overflow-h">
	                            <p>Although our main focus is on F&B businesses, we remain committed to supplying commercial cooking gas to other business establishments consuming commercial cooking gas offering them the same value proposition.</p>
	                        </div>
	                    </div>
	                    <div class="margin-bottom-20"></div>
            		</div>
	            </div><!--/end Headline Center-->
	        </div>


	        <div class="flat-testimonials bg-image-v2 parallaxBg1 margin-bottom-60" id="how-it-works">
	            <div class="container">
	                <div class="headline-center headline-light margin-bottom-60">
	                    <h2>How It Works</h2>
	                    <p>GasMarket is a simple way for businesses to procure commercial LPG cooking gas online. Simple & painless:</p>
	                </div><!--/end Headline Center-->

			        <div class="container content-sm col-sm-offset-3 col-sm-6">
				        <div class="row">
				            <div class="col-sm-12 content-boxes-v3 sm-margin-bottom-30">
				                <div class="margin-bottom-30">
				                    <i class="icon-custom icon-md rounded-x icon-bg-u icon-line icon-trophy"></i>
				                    <div class="content-boxes-in-v3">
				                        <h2 class="heading-sm">Step 1: </h2>
				                        <p id="hiw-alink"><a href="registration.php">Register online</a> or simply call us to register yourself.</p>
				                    </div>
				                </div>
				            </div>
				            <div class="col-sm-12 content-boxes-v3">
				                <div class="clearfix margin-bottom-30">
				                    <i class="icon-custom icon-md rounded-x icon-bg-u icon-line icon-trophy"></i>
				                    <div class="content-boxes-in-v3">
				                        <h2 class="heading-sm">Step 2: </h2>
				                        <p>Our representatives will get in touch with-in 24 hours</p>
				                    </div>
				                </div>
				            </div>

				            <div class="col-sm-12 content-boxes-v3 sm-margin-bottom-30">
				                <div class="margin-bottom-30">
				                    <i class="icon-custom icon-md rounded-x icon-bg-u icon-line icon-trophy"></i>
				                    <div class="content-boxes-in-v3">
				                        <h2 class="heading-sm">Step 3: </h2>
				                        <p>Our representatives would discuss & access your requirements & offer you a free-of-cost assessment on optimizing & reducing your cooking gas costs</p>
				                    </div>
				                </div>
				            </div>
				            <div class="col-sm-12 content-boxes-v3">
				                <div class="clearfix margin-bottom-30">
				                    <i class="icon-custom icon-md rounded-x icon-bg-u icon-line icon-trophy"></i>
				                    <div class="content-boxes-in-v3">
				                        <h2 class="heading-sm">Step 4: </h2>
				                        <p>That’s it, you can start placing your orders online & see order history through your own personalized dashboard!</p>
				                    </div>
				                </div>
				            </div>
				        </div>
				    </div>
				 </div>
			</div>

	        <div class="container" id="faq">
	            <div class="headline-center margin-bottom-60">
	                <h2>Frequently Asked Questions</h2>
	            </div><!--/end Headline Center-->

			    <!-- FAQ Content -->
		        <div class="row">
		            <!-- Begin Tab v1 -->
		            <div class="col-md-8 col-md-offset-2">
		                <section>
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Accordion -->
                                <div class="accordion-v2 plus-toggle">
                                    <div class="panel-group" id="accordion-v2">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#accordion-v2" href="#collapseOne-v2">
                                                        What is GasMarket?
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne-v2" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    GasMarket enables the supply of commercial cooking LPG to F&B and other business establishments from reputed suppliers
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion-v2" href="#collapseTwo-v2">
                                                        Is GasMarket a ‘Gas Agency’?
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo-v2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    No, we are a B2B marketplace for procuring commercial LPG cooking gas    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion-v2" href="#collapseThree-v2">
                                                        Does GasMarket supply to individuals buyers?
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseThree-v2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    We supply only commercial cooking LPG to businesses establishments only.    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion-v2" href="#collapseFour-v2">
                                                        Are these Gas cylinders subsidized?
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseFour-v2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    GasMarket supplies only commercial non-subsidized LPG cooking gas.
                                                </div>
                                            </div>
                                        </div>


                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion-v2" href="#collapseFive-v2">
                                                        Does the cylinders meet all statutory requirements?
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseFive-v2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    Yes all cylinders comply to all statutory & safety requirement laid down by the competent Govt. authorities.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion-v2" href="#collapseSix-v2">
                                                        How do I register & place orders?
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseSix-v2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    Please visit our <a href="registration.php">register</a> to place orders
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion-v2" href="#collapseSeven-v2">
                                                        Can I place orders on the phone?
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseSeven-v2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    No problems with that. Please call us on +91 98452 85084 & we will let you know how.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion-v2" href="#collapseEight-v2">
                                                        What are the prices, payment & other commercial terms?
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseEight-v2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    Please <a href="registration.php">register</a> to know more on prices, payment options & other commercial terms and benefits or call us on +91 98452 85084 to know more.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion-v2" href="#collapseNine-v2">
                                                        When do I get my gas delivered?
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseNine-v2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    If you place the order before 12:00 PM you may get the delivery on the same day. Orders placed after 12:00 PM may be delivered the next day.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion-v2" href="#collapseTen-v2">
                                                        Which areas does GasMarket service?
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTen-v2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    We service most areas & pin codes of Bangalore. Please click here to know the pin codes serviced.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion-v2" href="#collapseEleven-v2">
                                                        Can I pay by credit or debit cards?
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseEleven-v2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    This facility will be made available soon.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion-v2" href="#collapseTwelve-v2">
                                                        What if my order is delayed?
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwelve-v2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    We are usually on top of your orders & ensure follow-up is done for timely delivery. However in the event your order is delayed, you could always contact GasMarket customer care for updates.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Accordion -->    
                            </div>
                        </div>
                    </section>
		            </div><!--/col-md-8-->
		            <!--End Tab v1-->
		        </div>
		        <!-- End FAQ Content -->
	        </div><!--/end container-->


	    </div>
	    <!--=== End Content ===-->

	    <!-- Contact Section -->
	    <section id="contact" class="contacts-section">
	        <div class="container content-lg">
	            <div class="title-v1">
	                <h2>Contact Us</h2>
	                <p>Our support team is always by your side for any eventuality or support that you may require. </p>
	            </div>

	            <div class="row contacts-in">
	                <div class="col-md-6 md-margin-bottom-40">
	                    <ul class="list-unstyled">
	                        <li><i class="fa fa-phone"></i> (+91) 98452 85084</li>
	                        <li><i class="fa fa-envelope"></i> <a href="mailto:abhishek@mktplace.in">abhishek@mktplace.in</a></li>
	                        <li><i class="fa fa-globe"></i> <a href="#">www.gasmarket.in</a></li>
	                    </ul>
	                </div>

	                <div class="col-md-6">
	                    <form action="send-mail.php" method="post" id="sky-form3" class="sky-form contact-style">
	                        <fieldset>
	                            <label>Name <span class="color-red">*</span></label>
	                            <div class="row">
	                                <div class="col-md-7 margin-bottom-20 col-md-offset-0">
	                                    <div>
	                                        <input type="text" name="contact-us-name" id="name" class="form-control" required>
	                                    </div>
	                                </div>
	                            </div>

	                            <label>Email <span class="color-red">*</span></label>
	                            <div class="row">
	                                <div class="col-md-7 margin-bottom-20 col-md-offset-0">
	                                    <div>
	                                        <input type="text" name="contact-us-email" id="email" class="form-control" required>
	                                    </div>
	                                </div>
	                            </div>

	                            <label>Message <span class="color-red">*</span></label>
	                            <div class="row">
	                                <div class="col-md-11 margin-bottom-20 col-md-offset-0">
	                                    <div>
	                                        <textarea rows="8" name="contact-us-message" id="message" class="form-control" required></textarea>
	                                    </div>
	                                </div>
	                            </div>

	                            <p><button type="submit" class="btn-u btn-brd btn-brd-hover btn-u-dark" name="btn-send-mail">Send Message</button></p>
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


		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/angular.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/jquery.singlePageNav.min.js"></script>
		<script type="text/javascript" src="js/jquery.superslides.min.js"></script>
		<script type="text/javascript" src="js/jquery.countdown.min.js"></script>
		<script type="text/javascript" src="js/wow.min.js"></script>
		<script type="text/javascript" src="js/custom.js"></script>
		<script type="text/javascript" src="js/app.js"></script>
		<script type="text/javascript" src="js/custom-unify.js"></script>
		<script type="text/javascript" src="js/app-unify.js"></script>
	</body>
</html>