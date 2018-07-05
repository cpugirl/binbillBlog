<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Bin_Bill
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>


<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="container blog-page">
			<div class="blog-section">
				<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();
						$ID = get_the_ID();
						binbill_set_post_views($ID);
						?>
						<div class="article-page-details">
							<?php get_template_part( 'template-parts/post/content', get_post_format() );?>
						</div>
						<div class="article-page-nextprev">
							<?php
								the_post_navigation( array(
									'prev_text' => '
									<span class="screen-reader-text">' 
										. __( 'Previous Post', 'binbill' ) . 
									'</span>
									<span aria-hidden="true" class="nav-subtitle">' 
										. __( 'Previous', 'binbill' ) . 
									'</span>
									<span class="nav-title">
										<span class="nav-title-icon-wrapper"><</span>%title</span>',
									'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'binbill' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'binbill' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">></span></span>',
								) );?>
						</div>
						<div class="article-page-comment">
							<?php
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
							?>
						</div>
						
						<?php
					endwhile; // End of the loop.
				?>
			</div>
			<div class="home-sidebar">
				<?php get_sidebar(); ?>
			</div>
		</div>

	</main><!-- #main -->
</div><!-- #primary -->


<?php get_footer();
