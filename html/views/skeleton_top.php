<!DOCTYPE HTML>
<!--
	Halcyonic by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title><?php echo $title; ?></title>
		<!--<base href="/phantase/">-->
		<base href="/">
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="og:type" content="summary" />
		<meta name="og:title" content="<?= $og_title ?>" />
		<meta name="og:description" content="<?= $og_description ?>" />
		<meta name="og:image" content="https://cdn.phantase.net/article/<?= $og_image ?>_cover.jpg" />
		<link rel="shortcut icon" href="favicon.ico" />
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
<?php if($page == 1 && $action == "home" ){ ?>
		<!-- Version complète de jssor quand DEV en cours -->
		<script type="text/javascript" src="js/jssor.js"></script>
		<script type="text/javascript" src="js/jssor.slider.js"></script>
		<!-- Version minifiée de jssor quand DEV fini -->
		<!--<script type="text/javascript" src="js/jssor.slider.mini.js"></script>-->
		<script src="js/init-home.js"></script>
<?php } else if($action == "preview" || $action == "article") { ?>
		<!-- Version complète quand DEV en cours -->
		<script src="js/imagelightbox.js"></script>
		<!-- Version minifiée quand DEV fini -->
		<!--<script src="js/imagelightbox.min.js"></script>-->
		<script src="js/init-article.js"></script>
		<link rel="stylesheet" href="css/imagelightbox.css" />
<?php } else if( $action == "login" ){ ?>
		<script src="js/init-login.js"></script>
<?php } else if( $action == "upload" ){ ?>
		<script src="js/init-upload.js"></script>
		<link rel="stylesheet" href="css/upload.css" />
<?php } else if( $action == "write" ){ ?>
		<script src="ckeditor/ckeditor.js"></script>
		<script src="js/init-write.js"></script>
<?php } else if( $action == "gallery" ){ ?>
		<script src="js/init-gallery.js"></script>
<?php } ?>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
                <script>
                    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

                    ga('create', 'UA-71957191-2', 'auto');
                    ga('send', 'pageview');
                </script>
	</head>
	<body>
		<!-- Header -->
			<div id="header-wrapper">
				<header id="header" class="container">
					<div class="row">
						<div class="12u">
							<!-- Logo -->
								<h1><a href="./" id="logo">Phantase</a></h1>
							<!-- Links to categories -->
<?php
	include_once('controllers/topcategories.php');
?>
						</div>
					</div>
				</header>
<?php 
if( $action != "error" && $action != "login" && $action != "admin" )
	include_once('controllers/banner.php');
?>
			</div>