<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html>
<!--<![endif]-->
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
		<title>HandyCom - Your website in a few clicks !</title>

		<!-- Mobile Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Favicon -->
		<link rel="shortcut icon" href="images/favicon.ico">

		<!-- Web Fonts -->
		<link href='css/template/font/openSansLight.css' rel='stylesheet' type='text/css'>
		<link href='css/template/font/raleway.css' rel='stylesheet' type='text/css'>

		<!-- Bootstrap core CSS -->
		<link href="css/template/bootstrap.min.css" rel="stylesheet">

		<!-- Font Awesome CSS -->
		<link href="fonts/font-awesome/css/font-awesome.css" rel="stylesheet">

		<!-- Plugins -->
		<link href="css/template/animations.css" rel="stylesheet">

		<!-- Worthy core CSS file -->
		<link href="css/template/stylevitrine.css" rel="stylesheet">
		
		<!-- My CSS -->
		<link href="css/style.css" rel="stylesheet">

	</head>

	<?php
	session_start();
	?>

	<body class="no-trans">
		<!-- scrollToTop -->
		<!-- ================ -->
		<div class="scrollToTop"><i class="icon-up-open-big"></i></div>

		<!-- header start -->
		<!-- ================ --> 
		<header class="header fixed clearfix navbar navbar-fixed-top">
			<div class="container">
				<div class="row">
					<div class="col-md-4">

						<!-- header-left start -->
						<!-- ================ -->
						<div class="header-left clearfix">

							<!-- logo -->
							<div class="logo smooth-scroll">
								<a href="#banner"><img id="logo" src="images/logo.png" alt="Worthy"></a>
							</div>

							<!-- name-and-slogan -->
							<div class="site-name-and-slogan smooth-scroll">
								<div class="site-name"><a href="#banner">HandyCom</a></div>
								<div class="site-slogan">Your website in a few clicks !</div>
							</div>

						</div>
						<!-- header-left end -->

					</div>
					<div class="col-md-8">

						<!-- header-right start -->
						<!-- ================ -->
						<div class="header-right clearfix">

							<!-- main-navigation start -->
							<!-- ================ -->
							<div class="main-navigation animated">

								<!-- navbar start -->
								<!-- ================ -->
								<nav class="navbar navbar-default" role="navigation">
									<div class="container-fluid">

										<!-- Toggle get grouped for better mobile display -->
										<div class="navbar-header">
											<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
												<span class="sr-only">Toggle navigation</span>
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
											</button>
										</div>

										<!-- Collect the nav links, forms, and other content for toggling -->
										<div class="collapse navbar-collapse scrollspy smooth-scroll" id="navbar-collapse-1">
											<ul class="nav navbar-nav navbar-right">
												<li class="active"><a href="#banner">Home</a></li>
												<li><a href="#services">How to</a></li>
												<li><a href="#about">About</a></li>
												<li><a href="#portfolio">Our templates</a></li>
												<li><a href="#clients">Clients</a></li>
												<li><a href="#contact">Contact</a></li>
											</ul>
										</div>

									</div>
								</nav>
								<!-- navbar end -->

							</div>
							<!-- main-navigation end -->

						</div>
						<!-- header-right end -->

					</div>
				</div>
			</div>
		</header>
		<!-- header end -->

		<!-- banner start -->
		<!-- ================ -->
		<div id="banner" class="banner">
			<div class="banner-image"></div>
			<div class="banner-caption">
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2 object-non-visible" data-animation-effect="fadeIn">
							<h1 class="text-center bigtitle"><span>HandyCom</span>, web becomes easier</h1>
							<p class="lead text-center"><a href="#portfolio" style="color:white">Create your website in a few clicks !</a></p>
							<p class="lead text-center"><span style="color:red"><b>You can test the website without registering by using this account : </b></span></p>
							<p class="lead text-center"><span style="color:red"><b>Login - demo | Password - demo</b></span></p>

							<?php

								require('Model/connectionChecker.php');
								if (isset($_SESSION['login']))
								{
									echo '<p style="text-align:center"><a id="deconnexion" class="lead" href="deconnexion.php">Disconnect</a></p>';
								}
								else
								{

									echo '
								<form class="navbar-form" id="loginForm" style="text-align:center" method="POST" role="form" onsubmit="return logUser();">
									<div class="form-group">
										<input class="form-control" type="text" name="login" placeholder="Login">
									</div>
									<div class="form-group">
										<input class="form-control" type="password" name="password" placeholder="Password">
									</div>
									<button class="btn btnconnect" type="submit">Connect</button>
									<!--<a class="btn btn-danger" href="index.php?objet=inscrire&action=loadinscrire">Register !</a>-->
								</form>
								<p style="text-align:center"><a class="" href="javascript:void(0);" onclick="loadInscription();">Now registered yet ?</a></p>
								';

	
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- banner end -->

		<!-- section start -->
		<!-- ================ -->
		<div class="section translucent-bg blue">
			<div class="container object-non-visible" data-animation-effect="fadeIn">
				<h1 id="services"  class="text-center title">How to</h1>
				<h4 class="text-center">HandyCom is an innovative service which allows you to create hight-quality websites without programming.</h4>
				<div class="space"></div>
				<div class="row">
					<div class="col-sm-4">
						<div class="media">
							<div class="media-body text-left">
								<h3 class="media-heading">Step 1</h3>
								<center>
									<img src="images/computerTemplate.png" alt="Téléchargez votre thème">
								</center>
								<h4>Choose your template</h4>
								<h6>Find the template which best fits your project (portfolio, startup, association, events, ...)</h6>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="media">
							<div class="media-body text-left">
								<h3 class="media-heading">Step 2</h3>
								<center>
									<img src="images/computerNeed.png" alt="Adaptez votre thème">
								</center>
								<h4>Customize your template</h4>
								<h6>Add the text and the images you want with our online editor.</h6>
							</div>
						</div>
					</div>
					<div class="space visible-xs"></div>
					<div class="col-sm-4">
						<div class="media">
							<div class="media-body">
								<h3 class="media-heading">Etape 3</h3>
								<center>
									<img src="images/computerDownload.png" alt="Téléchargez votre site web">
								</center>
								<h4>Download your website!</h4>
								<h6>You just have to download your website in a .zip file.</h6>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- section end -->

		<!-- section start -->
		<!-- ================ -->
		<div class="section clearfix object-non-visible" data-animation-effect="fadeIn">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1 id="about" class="title text-center">About <span>HandyCom</span></h1>
						<p class="lead text-center">With HandyCom, websites creation is very easy !</p>
						<div class="space"></div>
						<div class="row">
							<div class="col-md-6">
								<!--<iframe width="560" height="315" src="https://www.youtube.com/embed/R38odgVYRWE" frameborder="0" allowfullscreen></iframe>-->
								<div class="space"></div>
							</div>
							<div class="col-md-6" style="text-align:justify">
								<p>You can create a customized website without having to know any programming language.
								</p>						
								<p>A large variety of websites are possible, and really easily !</p>

								<br /> 
								
								<p>Two offers are available :</p>
								<ul class="list-unstyled">
									<li><i class="fa fa-caret-right pr-10 text-colored"></i> Websites creation from our service, with the possibilité of downloading the source code.</li>
									<li><i class="fa fa-caret-right pr-10 text-colored"></i> The hosting of the websites.</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- section end -->

		<!-- section start -->
		<!-- ================ -->
		<div class="default-bg space blue">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<h1 class="text-center">Let's work together !</h1>
					</div>
				</div>
			</div>
		</div>
		<!-- section end -->

		<!-- section start -->
		<!-- ================ -->
		<div class="section">
			<div class="container">
				<h1 class="text-center title" id="portfolio">Our different templates</h1>
				<div class="separator"></div>
				<p class="lead text-center">You can see below all the available templates.</p>
				<br>			
				<div class="row object-non-visible" data-animation-effect="fadeIn">
					<div class="col-md-12">

						<!-- isotope filters start -->
						<div class="filters text-center">
							<ul id="linksmenu" class="nav nav-pills">
								<!--<li class="active"><a href="#" data-filter="*">All</a></li>
								<li><a href="#" data-filter=".web-design">Web design</a></li>
								<li><a href="#" data-filter=".app-development">App development</a></li>
								<li><a href="#" data-filter=".site-building">Site building</a></li>-->
							</ul>
						</div>
						<!-- isotope filters end -->

						<!-- portfolio items start -->
						<div id="tplResults">
						
						</div>
						<!-- portfolio items end -->
					
					</div>
				</div>
			</div>
		</div>
		<!-- section end -->

		<!-- section start -->
		<!-- ================ -->
		<div class="section translucent-bg bg-image-2 pb-clear">
			<div class="container object-non-visible" data-animation-effect="fadeIn">
				<h1 id="clients" class="title text-center">Clients</h1>
				<div class="space"></div>
				<div class="row">
					<div class="col-md-4">
						<div class="media testimonial">
							<div class="media-left">
								<img src="images/testimonial-1.png" alt="">
							</div>
							<div class="media-body">
								<h3 class="media-heading">You are Amazing!</h3>
								<blockquote>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure aperiam consequatur quo.</p>
									<footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
								</blockquote>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="media testimonial">
							<div class="media-left">
								<img src="images/testimonial-2.png" alt="">
							</div>
							<div class="media-body">
								<h3 class="media-heading">Yeah!</h3>
								<blockquote>
									<p>Iure aperiam consequatur quo quis exercitationem reprehenderit dolor vel ducimus.</p>
									<footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
								</blockquote>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="media testimonial">
							<div class="media-left">
								<img src="images/testimonial-3.png" alt="">
							</div>
							<div class="media-body">
								<h3 class="media-heading">Thank You!</h3>
								<blockquote>
									<p>Aperiam consequatur quo quis exercitationem reprehenderit suscipit iste placeat.</p>
									<footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
								</blockquote>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="media testimonial">
							<div class="media-left">
								<img src="images/testimonial-2.png" alt="">
							</div>
							<div class="media-body">
								<h3 class="media-heading">Thank You!</h3>
								<blockquote>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure aperiam consequatur quo.</p>
									<footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
								</blockquote>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="media testimonial">
							<div class="media-left">
								<img src="images/testimonial-3.png" alt="">
							</div>
							<div class="media-body">
								<h3 class="media-heading">Amazing!</h3>
								<blockquote>
									<p>Iure aperiam consequatur quo quis exercitationem reprehenderit dolor vel ducimus.</p>
									<footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
								</blockquote>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="media testimonial">
							<div class="media-left">
								<img src="images/testimonial-1.png" alt="">
							</div>
							<div class="media-body">
								<h3 class="media-heading">Best!</h3>
								<blockquote>
									<p>Aperiam consequatur quo quis exercitationem reprehenderit suscipit iste placeat.</p>
									<footer>Someone famous in <cite title="Source Title">Source Title</cite></footer>
								</blockquote>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- section start -->
			<!-- ================ -->
			<div class="translucent-bg blue">
				<div class="container">
					<div class="list-horizontal">
						<div class="row">
							<div class="col-xs-2">
								<div class="list-horizontal-item">
									<img src="images/client-1.png" alt="client">
								</div>
							</div>
							<div class="col-xs-2">
								<div class="list-horizontal-item">
									<img src="images/client-2.png" alt="client">
								</div>
							</div>
							<div class="col-xs-2">
								<div class="list-horizontal-item">
									<img src="images/client-3.png" alt="client">
								</div>
							</div>
							<div class="col-xs-2">
								<div class="list-horizontal-item">
									<img src="images/client-4.png" alt="client">
								</div>
							</div>
							<div class="col-xs-2">
								<div class="list-horizontal-item">
									<img src="images/client-5.png" alt="client">
								</div>
							</div>
							<div class="col-xs-2">
								<div class="list-horizontal-item">
									<img src="images/client-6.png" alt="client">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- section end -->
		</div>
		<!-- section end -->

		<!-- section start -->
		<!-- ================ -->
		<div class="default-bg space">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<h1 class="text-center">10000+ Happy Clients!</h1>
					</div>
				</div>
			</div>
		</div>
		<!-- section end -->

		<!-- footer start -->
		<!-- ================ -->
		<footer id="footer">

			<!-- .footer start -->
			<!-- ================ -->
			<div class="footer section">
				<div class="container">
					<h1 class="title text-center" id="contact">Contact us</h1>
					<div class="space"></div>
					<div class="row">
						<div class="col-sm-6">
							<div class="footer-content">
								<p class="large">Question ? Suggestion ? Contact us !</p>
								<ul class="social-links">
									<li class="facebook"><a target="_blank" href="#"><i class="fa fa-facebook"></i></a></li>
									<li class="twitter"><a target="_blank" href="#"><i class="fa fa-twitter"></i></a></li>
									<li class="googleplus"><a target="_blank" href="#"><i class="fa fa-google-plus"></i></a></li>
									<li class="linkedin"><a target="_blank" href="#"><i class="fa fa-linkedin"></i></a></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="footer-content">
								<form role="form" id="footer-form">
									<div class="form-group has-feedback">
										<label class="sr-only" for="name2">Name</label>
										<input type="text" class="form-control" id="name2" placeholder="Nom" name="name2" required>
										<i class="fa fa-user form-control-feedback"></i>
									</div>
									<div class="form-group has-feedback">
										<label class="sr-only" for="email2">Email</label>
										<input type="email" class="form-control" id="email2" placeholder="Adresse email" name="email2" required>
										<i class="fa fa-envelope form-control-feedback"></i>
									</div>
									<div class="form-group has-feedback">
										<label class="sr-only" for="message2">Message</label>
										<textarea class="form-control" rows="8" id="message2" placeholder="Message" name="message2" required></textarea>
										<i class="fa fa-pencil form-control-feedback"></i>
									</div>
									<input type="submit" value="Envoyer" class="btn btn-default">
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- .footer end -->

			<!-- .subfooter start -->
			<!-- ================ -->
			<div class="subfooter">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<p class="text-center">Copyright © 2015 by <a target="_blank" href="#">HandyCom</a>.</p>
						</div>
					</div>
				</div>
			</div>
			<!-- .subfooter end -->

		</footer>
		<!-- footer end -->

		<!-- JavaScript files placed at the end of the document so the pages load faster
		================================================== -->
		<!-- Jquery and Bootstap core js files -->
		<script type="text/javascript" src="plugins/jquery.min.js"></script>
		<script type="text/javascript" src="js/template/bootstrap.min.js"></script>

		<!-- Modernizr javascript -->
		<script type="text/javascript" src="plugins/modernizr.js"></script>

		<!-- Isotope javascript -->
		<script type="text/javascript" src="plugins/isotope/isotope.pkgd.min.js"></script>
		
		<!-- Backstretch javascript -->
		<script type="text/javascript" src="plugins/jquery.backstretch.min.js"></script>

		<!-- Appear javascript -->
		<script type="text/javascript" src="plugins/jquery.appear.js"></script>

		<!-- Initialization of Plugins -->
		<script type="text/javascript" src="js/template/template.js"></script>

		<!-- Custom Scripts -->
		<script type="text/javascript" src="js/template/custom.js"></script>
		
		<!-- My JS -->
		<script type="text/javascript" src="js/homepage.js"></script>
		
		<!-- PLUGINS -->
		<!-- colorbox -->
		<script type="text/javascript" src="plugins/colorbox-master/jquery.colorbox-min.js"></script>
		<link href='plugins/colorbox-master/colorbox.css' rel='stylesheet' type='text/css'>

	</body>
</html>
