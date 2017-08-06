<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv=’cache-control’ content=’no-cache’>
		<meta http-equiv=’expires’ content=’0′>
		<meta http-equiv=’pragma’ content=’no-cache’>

        <title>Genererate a website</title>

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
		<!-- Farbastic -->
		<script type="text/javascript" src="plugins/farbastic/src/farbtastic.js"></script>

		<!-- Worthy core CSS file -->
		<link href="css/template/stylevitrine.css" rel="stylesheet">

		
	<!-- PLUGINS-->
		<!-- jQuery-->
		<script type="text/javascript" src="./plugins/jquery-1.11.2.min.js"></script>
		<!-- CLEditor -->
		 <link rel="stylesheet" type="text/css" href="./plugins/CLEditor1_4_5/jquery.cleditor.css" />
		 <script type="text/javascript" src="./plugins/CLEditor1_4_5/jquery.cleditor.min.js"></script>
		 <script type="text/javascript">      
			$(document).ready(function() {  $(".textSec").cleditor(); 
			});  
			$(".textSec").css('height','100px');

		</script>

			<script type="text/javascript" charset="utf-8">
			 /*$(function () {
			   $('#colorpicker1').farbtastic('#color1');
			 });*/
			</script>
		
		<!-- CLEditor extimage plugin -->
		<script src="./plugins/CLEditor1_4_5/jquery.cleditor.js" type="text/javascript"></script>
		<script src="./plugins/CLEditor1_4_5/jquery.cleditor.extimage.js" type="text/javascript"></script>
		<script type="text/javascript">
			$.cleditor.buttons.image.uploadUrl = 'webservices/imageUploader.php';
		</script>
		
		<!-- Bootstrap -->
		<link href="./plugins/bootstrap-3.1.1-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="./plugins/bootstrap-3.1.1-dist/js/bootstrap.js"></script>
 
	<!-- JS -->
		<script type="text/javascript" src="./js/script.js"></script>
	<!-- CSS -->
				<!-- My CSS -->
		<link href="css/styleeditor.css" rel="stylesheet">
		
		<?php
			echo templateName( $idtpl );
		?>

		<?php
			session_start();
		?>
		<script type="text/javascript">
			loadPreview();
		</script>

   </head>

  <body>
		<!-- header start -->
		<!-- ================ --> 
		<header class="header fixed ">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<!-- header-left start -->
						<!-- ================ -->
						<div class="header-left clearfix">
							<!-- logo -->
							<div class="logo smooth-scroll">
								<a href="index.php"><img id="logo" src="images/logo.png" alt="Worthy"></a>
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
												<li><a href="index.php">Home</a></li>
												<li><a href="#banner">My account</a></li>
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


		<!-- Preview -->
		<div id="globaleditor">
			<div class="">
				<div id="preview" class="" style="text-align:center">
				
				</div>
			</div>

			<div id="editor">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-8">
							<!-- Editeur de texte, Gauche -->
							<p><span style="color:white;font-style:italic;">Title :</span> <INPUT TYPE="text" id="titleTpl" VALUE="Your title here"></p>
							
							<div id="champsSections">
								<span class="sectionform">
									<p style="color:white;font-size:20px;">Section 1</p>
									<p><span style="color:white;font-style:italic;">Title of section :</span> <INPUT TYPE="text" id="titles1" VALUE="t1" class="titleSec"> </p>
									<p ><textarea TYPE="text" id="texts1" class="textSec">1st section text here</textarea></p>
								

									<div class="colorpicker">
									  <div id="colorpicker1"></div>
									  <form><input type="text" id="color1" /></form>
									</div>

								</span>
							</div>
						</div>

						<div class="col-md-4">
							<!-- Boutons d'interaction -->
							<div class="row">
							<div class="col-md-6">
		                    <div class="keys" id="type_perp" onclick="addSection();" >
		                        <h2><span class="fa fa-plus-square"></span> <a href="javascript:void(0);" style="color:white;font-size:18px;">Add a section</a></h2>
		                    </div>
		                    </div>

		                    <div class="col-md-6">
							<div class="keys" id="type_perp" onclick="removeSection();">
		                        <h2><span class="fa fa-minus-square"></span> <a href="javascript:void(0);" style="color:white;font-size:18px;">Delete a section</a></h2>
		                    </div>
		                    </div>
		                    </div>

		                    <div class="row">
							<div class="col-md-6">
							<div class="keys" id="type_perp" onclick="genererLien();">
		                        <h2><span class="fa fa-download"></span> <span id="linkTpl"><a href="javascript:void(0);" style="color:white;font-size:18px;">Download</a></span></h2>
		                    </div>		
		                    </div>		

		                    <div class="col-md-6">
		                    <div class="keys" id="type_perp" onclick="loadPreview();">
		                        <h2><span class="fa fa-download"></span> <a href="javascript:void(0);" style="color:white;font-size:18px;">Preview the site</a></h2>
		                    </div>					
		                    </div>					
		                    </div>					

		                    <div class="row">
							<div class="col-md-6">
		                    <div class="keys" id="type_perp" onclick="saveDraft();">
		                        <h2><span class="fa fa-floppy-o"></span> <span id="linkDraft"><a href="javascript:void(0);" style="color:white;font-size:18px;">Save a draft</a></span></h2>
		                    </div>
		                    </div>

		                    <div class="col-md-6">
		                    <div class="keys" id="type_perp" onclick="chooseDraft();">
		                        <h2><span class="fa fa-folder-open-o "></span> <a href="javascript:void(0);" style="color:white;font-size:18px;">Load a draft</a></h2>
		                    </div>
		                    </div>
		                    <div id="chooseDraft"></div>
		                    </div>

						</div>
					</div>
				</div>

				

				<!--<ul>
					<!--<li><a href="index.php">Accueil</a>
						<p>
							<!--<a class="tplUnselected" id="prevtpl1" href="javascript:void(0);" onclick="selectTemplate('tpl1');"><img class="preview" src="images/previewTpl1.png"></a>
							<a class="tplUnselected" id="prevstartbootstrap-grayscale-1.0.3" href="javascript:void(0);" onclick="selectTemplate('startbootstrap-grayscale-1.0.3');"><img class="preview" src="images/previewGrayscale.png"></a>-->
							<?php
								//echo previewTpl( $idtpl );
							?>
						<!--</p>
					</li>-->
				
				
				<!--index.php?objet=home&action=download&tpl=tpl1-->
			</div>
		</div>
	
  </body>
  
</html>