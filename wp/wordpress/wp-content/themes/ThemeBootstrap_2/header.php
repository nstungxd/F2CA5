<!DOCTYPE html> 
<html <?php language_attributes(); ?>> 
	<head> 
		<meta charset="<?php bloginfo('charset'); ?>" /> 
		<!--Thiết lập title--> 
		<title><?php wp_title('|',true,'right'); ?><?php bloginfo('name'); ?></title> 
		<link rel="profile" href="http://gmpg.org/xgn/11" /> 
		<!--Chèn CSS và JS cần thiết--> 
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" /> 
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory');?>/css/bootstrap.min.css" /> 
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory');?>/css/bootstrap-responsive.min.css" /> 
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	<?php wp_head();?>
	</head><!-- /head -->
	<body>
      <div id="container">
		<div class="row">
			<div id="header">
				<div id="logoBlock">
					<div class="pageWidth">
						<div class="pageContent">						
							<div id="logo">
								<a href="<?php bloginfo('home'); ?>">								
									<img alt="<?php bloginfo('name'); ?>" src="<?php bloginfo('template_url'); ?>/img/logo.png">
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="navbar">
					<div class="navbar-inner">
						<div class="container">
							<a class="btn btn-navbar" data-toggle="collapse"
								data-target=".navbar-responsive-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span
								class="icon-bar"></span>
							<div class="nav-collapse collapse navbar-responsive-collapse pageWidth">
								<ul class="nav">
								<?php
									$args = array(
										'theme_location' => 'main_top',
										'depth'		 => 0,
										'container'	 => false,
										'menu_class'	 => 'nav',
										'items_wrap' => '<ul class="nav"><li class="active"><a href="/"><i class="icon-home"></i></a></li>%3$s</ul>',
										'walker'	 => new BootstrapNavMenuWalker()
									);
									wp_nav_menu($args);
									?>
								</ul>
								<form class="navbar-search pull-right" action="/">
									<input type="text" class="search-query span2" id="s" name="s"
										placeholder="Search">
								</form>
							</div>
							<!-- /.nav-collapse -->
						</div>
					</div>
					<!-- /navbar-inner -->
				</div>
			   </div><!-- /#header -->