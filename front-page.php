<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Bin_Bill
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php  //Show the selected frontpage content.
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/page/content', 'front-page' );
			endwhile;
		else : // I'm not sure it's possible to have no posts when this page is shown, but WTH.
			get_template_part( 'template-parts/post/content', 'none' );
		endif; ?>

	</main><!-- #main -->
</div><!-- #primary -->
<div class="home-section container">
	<div class="home-panel">
		<?php 
		// Get each of our panels and show the post data.
			if ( 0 !== binbill_panel_count() || is_customize_preview() ) : // If we have pages to show.

				/**
				 * Filter number of front page sections in Bin Bill.
				 *
				 * @since Bin Bill 1.0
				 *
				 * @param int $num_sections Number of front page sections.
				 */
				$num_sections = apply_filters( 'binbill_front_page_sections', 4 );
				global $binbillcounter;

				// Create a setting and control for each of the sections available in the theme.
				for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
					$binbillcounter = $i;
					binbill_front_page_section( null, $i );
				}

			endif; // The if ( 0 !== binbill_panel_count() ) ends here. ?>
	</div>
	<div class="home-sidebar">
		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer();
