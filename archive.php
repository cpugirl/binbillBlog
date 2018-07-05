<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Bin_Bill
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
	<div class="home-section container archive-page">
		<div class="home-panel">
			<?php if ( have_posts() ) : ?>
				<div class="archive-header">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
					?>
				</div><!-- .page-header -->
			<?php endif; ?>

			
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

				<?php
				if ( have_posts() ) : ?>

					<div class="recent-posts">
						<?php
						$postCount = 1;
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/*
							* Include the Post-Format-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Format name) and that will be used instead.
							*/

							$postClass = ($postCount%2===0)?"class='following-posts iseven'":"class='following-posts isodd'";
							if($postCount===1)
								get_template_part( 'template-parts/post/content', 'firstpost' );
							else{?>
									<div <?php echo $postClass ?>>
										<?php get_template_part( 'template-parts/post/content', 'followingposts' );?>
									</div>
								<?php
								}
								$postCount++;	
							//get_template_part( 'template-parts/post/content', get_post_format() );

						endwhile;?>
						<div class="pagination-wrap">
							<?php
								the_posts_pagination( array(
									'prev_text' => binbill_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'binbill' ) . '</span>',
									'next_text' => '<span class="pagination-next">NEXT <span>></span></span>',
									'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'binbill' ) . ' </span>',
								) );
							?>
						</div>
					</div>
				<?php
				else :

					get_template_part( 'template-parts/post/content', 'none' );
					
				endif; ?>

				</main><!-- #main -->
			</div><!-- #primary -->
		</div>
		<div class="home-sidebar">
			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer();
