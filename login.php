<?php
require_once("connection.php");

// Our Foods
$query_sel_our_food = "SELECT * FROM food";
$our_food_stmt = $pdo->prepare($query_sel_our_food);
$our_food_stmt->execute();
$our_food_num = $our_food_stmt->rowCount();
$our_food_rows = $our_food_stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Login | Yummy</title>
<!-- custom-theme -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Food Chef Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript">
	addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
	function hideURLbar() {
		window.scrollTo(0,1);
	}
</script>

<link rel="stylesheet" href="css/lightbox.css">

<!-- //custom-theme files-->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/aos.css" rel="stylesheet" type="text/css" media="all" /><!-- //animation effects-css-->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- //custom-theme files-->

<!-- font-awesome-icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome-icons -->

<!-- googlefonts -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&amp;subset=latin-ext" rel="stylesheet">
<!-- //googlefonts -->

<style>
.foods_category a {
	color: rgb(66, 64, 64);
}
</style>
</head>
<body>

<!-- banner -->
<?php require_once("banner.php"); ?>
<!-- //banner --> 

<!-- header -->
<div class="header-w3layouts"> 
			<!-- Navigation -->
			<nav class="navbar navbar-default navbar-fixed-top">
				<div class="container">
					<div class="navbar-header page-scroll">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
							<span class="sr-only">Yummy</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<h1><a class="navbar-brand" href="index.php"><span>Yummy</span>RESTAURANT</a></h1>
					</div> 
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-ex1-collapse">
						<ul class="nav navbar-nav navbar-right">
							<!-- Hidden li included to remove active class from about link when scrolled up past about section -->
							<li class="hidden"><a class="page-scroll scroll" href="#page-top"></a>	</li>
							<li><a class="page-scroll scroll" href="index.php#home" onclick="window.location='index.php'">Home</a></li>
							<li><a class="page-scroll scroll" href="index.php#about" onclick="window.location='index.php'">Category</a></li>
							<li><a class="page-scroll scroll" href="#services">Services</a></li>
							<!-- <li><a class="page-scroll scroll" href="#team">Team</a></li> -->
							<li><a class="page-scroll scroll" href="#food">Our Food</a></li>
							<!-- <li><a class="page-scroll scroll" href="#testimonials">Testimonials</a></li> -->
							<li><a class="page-scroll scroll" href="#contact">Contact</a></li>
							<li><a href="#" class="menu__link" data-toggle="modal" data-target="#loginModal">Login</a></li>
							<li><a href="#" class="menu__link" data-toggle="modal" data-target="#signupModal">Sign Up</a></li>
							<?php if (isset($_SESSION["logged_in"])) { ?>
								<li><a href="myOrders.php">MyOrders</a></li>
							<?php } ?>
						</ul>
					</div>
					<!-- /.navbar-collapse -->
				</div>
				<!-- /.container -->
			</nav>  
</div>	
<!-- //header -->

<!-- about -->
<div class="about" id="about">
	<div class="container">
		<div class="heading">
			<h3 data-aos="zoom-in">Login</h3>
		</div>
		<div class="row foods_category">
			<div class="col-md-3 padding-5"></div>
			<div data-aos="zoom-in" class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading text-center">Login Form</div>
					<div class="panel-body">
						<?php
							if (isset($_SESSION["logged_in"])) {
								echo "You are Successfully Logged in <a href='logout.php' class='btn btn-danger'>Logout</a>";
							} else {
						?>
								<form action="#" method="post">
									<input type="text" placeholder="Email" name="email" required="" class="form-control" style="margin-bottom:6px;">
									<input type="password" placeholder="Password" name="password" required="" class="form-control" style="margin-bottom:6px;">
									<input type="submit" value="Login" name="user_got_login" class="btn btn-block btn-success" style="margin-bottom:6px;">
								</form>
						<?php
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- //about -->

<!-- testimonial -->
<!--
<div class="testimonial" id="testimonials">
	<div class="container">
		<div class="heading">
			<h3 data-aos="zoom-in" >Testimonials</h3>
		</div>
			<div class="agileits-w3layouts-info">
				<div class="testimonial-grid">
					<div class="slider">
							<div class="callbacks_container">
								<ul class="rslides" id="slider3">
									<li>
										<div data-aos="flip-down" class="col-md-6 testimonial-top">
											<i class="fa fa-quote-right" aria-hidden="true"></i>
											<p>Donec feugiat tellus sem, laoreet iaculis orci lobortis vel.Sed sed luctus elit vitae, 
												Sed sed luctus orci, at lacinia risus. Ut porttitor ante ac tincidunt elementum.
												Curabitur ex dolor,condi mentum vitae nunc vel.</p>
											<h5>John Smith <span>- Visitor</span></h5>
										</div>
										<div data-aos="flip-down" class="col-md-6 testimonial-top">
											<i class="fa fa-quote-right" aria-hidden="true"></i>
											<p>Donec feugiat tellus sem, laoreet iaculis orci lobortis vel. Sed sed luctus orci, elit vitae, 
												at lacinia risus. Ut porttitor ante ac tincidunt elementum. Curabitur ex dolor,
												condimentum vitae nunc vel, pulvinar semper justo..</p>
											<h5>John Smith <span>- Visitor</span></h5>
										</div>
									<div class="clearfix"></div>
									</li>
									<li>
										<div data-aos="flip-up" class="col-md-6 testimonial-top">
											<i class="fa fa-quote-right" aria-hidden="true"></i>
											<p>Pellentesque urna ex, ultricies a nunc at, pretium maximus nisi. Vestibulum non 
												auctor diam. Mauris eget consectetur mauris. Aenean leo elit, accumsan vel elit vitae, 
												mattis ultricies lacus. Cras consectetur justo lorem.</p>
											<h5>Divid Rule <span>- Visitor</span></h5>
										</div>
										<div data-aos="flip-up" class="col-md-6 testimonial-top">
											<i class="fa fa-quote-right" aria-hidden="true"></i>
											<p>Pellentesque urna ex, ultricies a nunc at, pretium maximus nisi. Vestibulum non 
												auctor diam. Mauris eget consectetur mauris. Aenean leo elit, accumsan vel elit vitae, 
												mattis ultricies lacus. Cras consectetur justo lorem.</p>
											<h5>Divid Rule <span>- Visitor</span></h5>
										</div>
									<div class="clearfix"></div>
									</li>
								</ul>
							</div> -->
							<script>
								// You can also use "$(window).load(function() {"
								// $(function () {
								  // Slideshow 4
								//   $("#slider3").responsiveSlides({
									// auto: true,
									// pager:true,
									// nav:false,
									// speed: 500,
									// namespace: "callbacks",
								// 	before: function () {
								// 	  $('.events').append("<li>before event fired.</li>");
								// 	},
								// 	after: function () {
								// 	  $('.events').append("<li>after event fired.</li>");
								// 	}
								//   });
							
								// });
							 </script>
							<!--banner Slider starts Here-->
							<!--
					</div>
				</div>
			</div>
		</div>
</div>
-->
<!-- //testimonial -->


<!-- services -->
<div class="services" id="services">
		<div class="container">
		<div class="heading">
			<h3 data-aos="zoom-in" >Our Services</h3>
		</div>
			<div class="w3-agileits-services-grids">
				<div data-aos="fade-down" class="col-md-6 agile-services-left">
					<div class="agile-services-left-grid">
						<div class="services-icon">
							<div class="col-md-4 services-icon-info">
								<i class="fa fa-glass" aria-hidden="true"></i>
							</div>
							<div class="col-md-8 services-icon-text">
								<p>Yummy Restaurant Provides</p>
								<p>Best Drinks</p>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="services-icon">
							<div class="col-md-4 services-icon-info">
								<i class="fa fa-cutlery" aria-hidden="true"></i>
							</div>
							<div class="col-md-8 services-icon-text">
								<p>Yummy Restaurant Provides</p>
								<p>Best Delicious Foods</p>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="services-icon">
							<div class="col-md-4 services-icon-info">
								<i class="fa fa-spoon" aria-hidden="true"></i>
							</div>
							<div class="col-md-8 services-icon-text">
								<p>Yummy Restaurant Provides</p>
								<p>Free Delivery</p>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div class="col-md-6 w3-agile-services-right">
					<div data-aos="zoom-in" class="col-md-6 service1">
						<img src="images/c1.png" alt="" />
					</div>
					<div data-aos="zoom-in" class="col-md-6 serviceimg">
						<img src="images/service1.jpg" alt="" />
						<img src="images/service2.jpg" alt="" />
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
</div>
<!-- //services -->

<!-- team -->
<!--
		<div class="team" id="team">
			<div class="container">
				<div class="heading">
					<h3 data-aos="zoom-in" >Recommended Foods</h3>
				</div>
				<div class="agile_team_grids">
					<div data-aos="fade-up" class="col-md-3 agile_team_grid">
						<div class="ih-item circle effect1">
							<div class="spinner"></div>
							<div class="img"><img src="images/food1.jpg" alt=" " class="img-responsive" /></div>
							<div class="info">
								<div class="info-back">
								  <h4>Food Title</h4>
								  <p>Price: [123]</p>
								  <p>Location: Kabul, afg</p>
								</div>
							</div>
						</div>
						<h4>James Roy</h4>
						<p>Fusce eu semper lacus, sodales id elit a, feugiat porttitor nulla lacinia.</p>
						<div class="social-icons team-icons">
							<a href="" class="btn btn-block">Order Now <i class="fa fa-shopping-cart"></i></a>
						</div> 
					</div>
					<div data-aos="slide-up" class="col-md-3 agile_team_grid">
						<div class="ih-item circle effect1">
							<div class="spinner"></div>
							<div class="img"><img src="images/team2.jpg" alt=" " class="img-responsive" /></div>
							<div class="info">
								<div class="info-back">
								  <h4>Restaurant Representative</h4>
								  <p>loremdolor</p>
								</div>
							</div>
						</div>
						<h4>John Deol</h4>
						<p>Fusce eu semper lacus, sodales id elit a, feugiat porttitor nulla lacinia.</p>
						<div class="social-icons team-icons">
							<ul>
								<li><a href="#" class="fa fa-facebook"> </a></li>
								<li><a href="#" class="fa fa-twitter"> </a></li>
								<li><a href="#" class="fa fa-google"> </a></li>
							</ul>
						</div> 
					</div>
					<div data-aos="slide-up" class="col-md-3 agile_team_grid t3">
						<div class="ih-item circle effect1">
							<div class="spinner"></div>
							<div class="img"><img src="images/team3.jpg" alt=" " class="img-responsive" /></div>
							<div class="info">
								<div class="info-back">
								  <h4>Restaurant  co-ordinator</h4>
								  <p>loremdolor</p>
								</div>
							</div>
						</div>
						<h4>Edward Cren</h4>
						<p>Fusce eu semper lacus, sodales id elit a, feugiat porttitor nulla lacinia.</p>
						<div class="social-icons team-icons">
							<ul>
								<li><a href="#" class="fa fa-facebook"> </a></li>
								<li><a href="#" class="fa fa-twitter"> </a></li>
								<li><a href="#" class="fa fa-google"> </a></li>
							</ul>
						</div> 
					</div>
					<div data-aos="fade-up" class="col-md-3 agile_team_grid t4">
						<div class="ih-item circle effect1">
							<div class="spinner"></div>
							<div class="img"><img src="images/team4.jpg" alt=" " class="img-responsive" /></div>
							<div class="info">
								<div class="info-back">
								  <h4>Restaurant staff</h4>
								  <p>loremdolor</p>
								</div>
							</div>
						</div>
						<h4>Lisaen Eddy</h4>
						<p>Fusce eu semper lacus, sodales id elit a, feugiat porttitor nulla lacinia.</p>
						<div class="social-icons team-icons">
							<ul>
								<li><a href="#" class="fa fa-facebook"> </a></li>
								<li><a href="#" class="fa fa-twitter"> </a></li>
								<li><a href="#" class="fa fa-google"> </a></li>
							</ul>
						</div> 
					</div>
					<div class="clearfix"> </div> 
				</div>
			</div>
		</div>
-->
<!--//team-->

<!-- gallery -->
	<div class="gallery" id="food">
		<div class="heading">
			<h3 data-aos="zoom-in" >Our Food</h3>
		</div>
			<div class="gallery-grids">
				<?php foreach ($our_food_rows as $our_food_row) { ?>
					<?php
					$query_sel_food_cat = "SELECT * FROM category WHERE cat_id=:cat_id";
					$food_cat_stmt = $pdo->prepare($query_sel_food_cat);
					$food_cat_stmt->execute(["cat_id"=>$our_food_row->cat_id]);
					$food_cat = $food_cat_stmt->fetch();
					?>
					<div data-aos="flip-right" class="col-md-3 gallery-grid">
						<div class="grid">
							<figure class="effect-roxy">
								<a class="example-image-link" href="food_details.php?id=<?= $our_food_row->food_id; ?>">
									<img src="<?= $our_food_row->photo; ?>" alt="" />
									<figcaption>
										<h3><?= $food_cat->title; ?> <span><?= $our_food_row->title; ?></span></h3>
										<p>Price: [<?= $our_food_row->price; ?>]</p>
										<p>Location: <?= $our_food_row->food_location; ?></p>
										<p>Condition: <?= $our_food_row->food_cond; ?></p>
										<p>Brand: <?= $our_food_row->brand; ?></p>
									</figcaption>	
								</a>
							</figure>
						</div>
					</div>
				<?php } ?>
				<div class="clearfix"> </div>
			</div>
	</div>
<!-- //gallery -->


<!-- contact -->
	<div class="contact" id="contact">
		<div class="container">
			<div class="heading">
				<h3 data-aos="zoom-in" >Get In Touch</h3>
			</div>
		</div>
			<div class="w3layouts-grids">
				<div data-aos="flip-left" class="col-md-6 contact-left">
					<h3 data-aos="zoom-in" >Contact information</h3>
					<div class="contact-info">
						<div class="contact-info-left">
							<i class="fa fa-map-marker" aria-hidden="true"></i>
						</div>
						<div class="contact-info-right">
							<h5>Address</h5>
							<p>Karte-e-4<br>
								<span>Yummy Restaurant</span>
								Kabul Afghanistan
							</p>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="contact-info">
						<div class="contact-info-left">
							<i class="fa fa-phone" aria-hidden="true"></i>
						</div>
						<div class="contact-info-right">
							<h5>Mobile</h5>
							<ul>
								<li>+93(0) 787 112 112</li>
							</ul>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="contact-info">
						<div class="contact-info-left">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</div>
						<div class="contact-info-right">
							<h5>E-Mail</h5>
							<ul>
								<li><a href="mailto:info@yummy.af">info@yummy.af</a></li>
							</ul>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				<div data-aos="flip-right" class="col-md-6 contact-form">
					<form action="#" method="post">
						<input type="text" name="Name" placeholder="Name" required="" style="color:white;">
						<input type="email" class="email" name="Email" placeholder="Email" required="" style="color:white;">
						<div class="clearfix"> </div>
						<input type="text" class="phone" name="phone" placeholder="Phone Number" required="" style="color:white;">
						<textarea placeholder="Message" name="Message" required="" style="color:white;"></textarea>
						<input type="submit" value="SUBMIT">
					</form>
				</div>
				<div class="clearfix"> </div>
			</div>
	</div>
<!-- //contact -->

<!-- map -->
<!--
<div class="map">
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d99285.8587671662!2d-94.77019988161892!3d38.95406778222139!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x87c0ec985fa46073%3A0x178f7880c66a7a55!2sExtended+Stay+America+Hotel+Kansas+City+-+Lenexa+-+87th+St.!5e0!3m2!1sen!2sin!4v1494659289602"></iframe>
</div>
-->
<!-- //map -->

<!-- subscribe -->
<!--
<div class="agileits_w3layouts_banner_info">
	<div class="container">
		<div data-aos="flip-right" class="col-md-7 subscribe-left">
			<h3>Subscribe to get the latest updates right to your inbox</h3>
		</div>
		<div data-aos="flip-left" class="col-md-5 subscribe-right">
			<form action="#" method="post"> 
				<input type="email" name="email" placeholder="Enter your Email..." required="">
				<input type="submit" value="Subscribe">
			</form>
		</div>
	</div>
</div>
-->
<!-- subscribe -->

<!-- copyright -->
<div class="copyright">
	<div class="copyrighttop">
		
		<ul>
			<li><h4>Follow us on:</h4></li>
			<li><a class="facebook" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
			<li><a class="facebook" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
			<li><a class="facebook" href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
			<li><a class="facebook" href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
		</ul>
	</div>
	<div class="copyrightbottom">
		<p>© 2019 Yummy. All rights reserved | Design by Ashraf Gardizy</p>
	</div>
	<div class="clearfix"></div>
</div>
<!-- //copyright -->

<!-- bootstrap-modal-pop-up -->
	<div class="modal video-modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					Yummy Restaurant 
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
				</div>
					<div class="modal-body">
						<img src="images/food3.jpg" alt=" " class="img-responsive" />
						<p style="padding-bottom:20px;">
							Yummy Fast Food offers a very good place for adults to quietly enjoy their food, and a family lounge with play place for children. we try to use as much organic and fresh supply as available. our location is close to main shopping and business areas in town.
						</p>
					</div>
			</div>
		</div>
	</div>
<!-- //bootstrap-modal-pop-up --> 

<!-- bootstrap-modal-pop-up (Sign UP) -->
<div class="modal video-modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					Sign Up
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
				</div>
				<div class="modal-body" style="padding:10px;">
				<form action="#" method="post">
					<input type="text" placeholder="Firstname" name="firstname" required="" class="form-control" style="margin-bottom:6px;">
					<input type="text" placeholder="Lastname" name="lastname" required="" class="form-control" style="margin-bottom:6px;">
					<input type="text" placeholder="Phone No" name="phone_no" required="" class="form-control" style="margin-bottom:6px;">
					<label>Year of Birth:</label>
					<select name="dob_y" id="" name="dob_y" class="form-control" style="margin-bottom:6px;">
						<?php $year = 1990; while ($year <= 2019) { ?>
							<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
						<?php $year++; } ?>
					</select>
					<textarea name="address" placeholder="Address" id="" cols="30" rows="4" required="" class="form-control" style="margin-bottom:6px;"></textarea>
					<input type="text" placeholder="Email" name="email" required="" class="form-control" style="margin-bottom:6px;">
					<input type="password" placeholder="Password" name="password" required="" class="form-control" style="margin-bottom:6px;">
					<input type="submit" value="Sign Up" name="user_got_signup" class="btn btn-block btn-success" style="margin-bottom:6px;">
				</form>
			</div>
			</div>
		</div>
	</div>
<!-- //bootstrap-modal-pop-up (Sign UP) -->

<!-- bootstrap-modal-pop-up (Login) -->
<div class="modal video-modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					Login
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
				</div>
				<div class="modal-body" style="padding:10px;">
					<form action="#">
						<input type="text" name="email" placeholder="Email" required="" class="form-control" style="margin-bottom:6px;">
						<input type="password" name="password" placeholder="Password" required="" class="form-control" style="margin-bottom:6px;">
						<input type="submit" value="Login" name="user_got_login" class="btn btn-block btn-success" style="margin-bottom:6px;">
					</form>
				</div>
			</div>
		</div>
	</div>
<!-- //bootstrap-modal-pop-up (Login) --> 

<script src="js/lightbox-plus-jquery.min.js"> </script><!-- for gallery js -->
 
<!-- js -->
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<!-- for bootstrap working -->
	<script src="js/bootstrap.js"></script>
	<!-- //for bootstrap working -->
<!-- //js -->

 <!-- /Responsive slides js -->
						<script src="js/responsiveslides.min.js"></script>
			<script>
						// You can also use "$(window).load(function() {"
						$(function () {
						  // Slideshow 4
						  $("#slider4").responsiveSlides({
							auto: true,
							pager:true,
							nav:false,
							speed: 500,
							namespace: "callbacks",
							before: function () {
							  $('.events').append("<li>before event fired.</li>");
							},
							after: function () {
							  $('.events').append("<li>after event fired.</li>");
							}
						  });
					
						});
			</script>
			<script>
								// You can also use "$(window).load(function() {"
								$(function () {
								  // Slideshow 4
								  $("#slider3").responsiveSlides({
									auto: true,
									pager:false,
									nav:true,
									speed: 500,
									namespace: "callbacks",
									before: function () {
									  $('.events').append("<li>before event fired.</li>");
									},
									after: function () {
									  $('.events').append("<li>after event fired.</li>");
									}
								  });
							
								});
							 </script>

 <!-- Responsive slides js -->
 
<!-- animation effects-js files-->
	<script src="js/aos.js"></script><!-- //animation effects-js-->
	<script src="js/aos1.js"></script><!-- //animation effects-js-->
<!-- animation effects-js files-->

<!-- //here starts scrolling icon -->
<script src="js/SmoothScroll.min.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<!-- here stars scrolling script -->
	<script type="text/javascript">
		$(document).ready(function() {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
	<!-- //here ends scrolling script -->
<!-- //here ends scrolling icon -->

<!-- scrolling script -->
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script> 
<!-- //scrolling script -->

</body>
</html>