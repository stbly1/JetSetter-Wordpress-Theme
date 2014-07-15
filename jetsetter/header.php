<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage JetSetter
 * @since JetSetter 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
	<script src='<?php bloginfo("template_url"); ?>/js/jquery-1.10.2.min.js' type="text/javascript"></script>
	<script src='<?php bloginfo("template_url"); ?>/js/jquery.easing.1.3.min.js' type="text/javascript"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script src="http://jquery-textfill.github.io/jquery-textfill/jquery.textfill.min.js"></script>
	<script src='<?php bloginfo("template_url"); ?>/js/header.js' type="text/javascript"></script>
    <?php if(is_front_page()) {
		?>
		<script src='<?php bloginfo("template_url"); ?>/js/detectmobilebrowser.js' type="text/javascript"></script>
		<script src='<?php bloginfo("template_url"); ?>/js/jetsetter.js' type="text/javascript"></script>
	    <?php
	}?>
	<?php if(is_single()) {
		if(is_singular('galleries')){
			?>
				<script src='<?php bloginfo("template_url"); ?>/js/jquery.touchSwipe.min.js' type="text/javascript"></script>
				<script src='<?php bloginfo("template_url"); ?>/js/jetsetterGallery.js' type="text/javascript"></script>
			<?php
		}else{
			?>
				<script src='<?php bloginfo("template_url"); ?>/js/jetsetterPost.js' type="text/javascript"></script>
		    <?php
		}
	}?>
	<?php if(is_archive() || is_search() || is_page() || is_404() ) {
		?>
		<script src='<?php bloginfo("template_url"); ?>/js/jetsetterPage.js' type="text/javascript"></script>
	    <?php
	}?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<div class='preloader'>
		<?php if ( get_header_image() ) : ?>
			<img src="<?php bloginfo("template_url"); ?>/images/preloader.gif" width="<?php echo get_custom_header()->width; ?>" alt="">
		<?php else : ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php endif; ?>
	</div>
	<?php
	if(!is_singular('galleries')){
	?>
	<header id="masthead" class="site-header" role="banner">
		<div class="header-main">

			<?php if ( get_header_image() ) : ?>
			<div id="header-image" style='max-width:<?php echo get_custom_header()->width;?>px'>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" alt="" id='header-image-display'>
					<img src="<?php bloginfo("template_url"); ?>/images/ad-logo-rollover.gif" id='header-image-rollover'>
					<h2 id='tagline'><span><?php bloginfo('description'); ?></span></h2>
				</a>
			</div>
			<?php else : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

			<?php endif;
			?>

			
			<!--
			<div class="search-toggle">
				<a href="#search-container" class="screen-reader-text"><?php _e( 'Search', 'twentyfourteen' ); ?></a>
			</div>

			<nav id="primary-navigation" class="site-navigation primary-navigation" role="navigation">
				<button class="menu-toggle"><?php _e( 'Primary Menu', 'twentyfourteen' ); ?></button>
				<a class="screen-reader-text skip-link" href="#content"><?php _e( 'Skip to content', 'twentyfourteen' ); ?></a>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
			</nav>
			-->
		</div>
		<!--
		<div id="search-container" class="search-box-wrapper hide">
			<div class="search-box">
				<?php get_search_form(); ?>
			</div>
		</div>
		-->
	</header><!-- #masthead -->
	<?php 
	}
	?>
	<div id="main" class="site-main">
