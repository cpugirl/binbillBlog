<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Bin_Bill
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link href="https://fonts.googleapis.com/css?family=Quicksand:400,500" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500" rel="stylesheet">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'binbill' ); ?></a>

	<header id="masthead" class="site-header" role="banner">

		<?php get_template_part( 'template-parts/header/header', 'image' ); ?>

		<?php if ( has_nav_menu( 'top' ) ) : ?>
			<div class="navigation-top">
				<div class="container">
					<?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
					<div class="nav-search">
						<div class="nav-search-box">Search</div>
						<div class="searchPop">
							<span class="topArrow"></span>
							<form id="nav-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
								<input type="text" id="nav-search-box" name="s"/>
								<input type="submit" id="nav-search-submit" value="Search"/>
							</form>
					</div>
					</div>
					
				</div><!-- .wrap -->
			</div><!-- .navigation-top -->
		<?php endif; ?>

	</header><!-- #masthead -->

	<?php

	/*
	 * If a regular post or page, and not the front page, show the featured image.
	 * Using get_queried_object_id() here since the $post global may not be set before a call to the_post().
	
	if ( ( is_single() || ( is_page() && ! binbill_is_frontpage() ) ) && has_post_thumbnail( get_queried_object_id() ) ) :
		echo '<div class="single-featured-image-header">';
		echo get_the_post_thumbnail( get_queried_object_id(), 'binbill-featured-image' );
		echo '</div><!-- .single-featured-image-header -->';
	endif;*/
	?>

	<div class="site-content-contain">
		<div id="content" class="site-content">
