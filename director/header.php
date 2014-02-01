<!DOCTYPE HTML>
<html>
<head>
	<title><?php bloginfo('name'); ?> | <?php wp_title(); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<!--[if lt IE 9]> <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<?php wp_head(); ?>
	
</head>

<body>
	
	<div id="wrap">
		<div id="container" class="group">
			<!--Header - Name of Item Here-->
			<header class="group">
				<?php $logo= get_option('director_logo', IMAGES.'/logo.png'); ?>
				<h1><img src="<?php print $logo; ?>" alt="<?php bloginfo('name'); ?>" /></h1>
				
				<?php  get_search_form(); ?>
								
				<?php wp_nav_menu( array('menu' => 'Main', 'container' => 'nav' )); ?>
				
			</header>
			
			<!-- End Header -->
			<?php if(!is_front_page()) : ?> <hr/> <?php endif; ?>
			<!-- Main Area -->
			<div id="content" class="group">