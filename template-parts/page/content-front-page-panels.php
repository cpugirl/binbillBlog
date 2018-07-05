<?php
/**
 * Template part for displaying pages on front page
 *
 * @package WordPress
 * @subpackage Bin_Bill
 * @since 1.0
 * @version 1.0
 */

global $binbillcounter;

?>

<article id="panel<?php echo $binbillcounter; ?>" <?php post_class( 'binbill-panel ' ); ?> >
	<div class="panel-content">
			<div class="entry-content">
				<?php
					/* translators: %s: Name of current post */
					the_content( sprintf(
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'binbill' ),
						get_the_title()
					) );
				?>
			</div><!-- .entry-content -->

			<?php
			// Show recent blog posts if is blog posts page (Note that get_option returns a string, so we're casting the result as an int).
			if ( get_the_ID() === (int) get_option( 'page_for_posts' )  ) : ?>

				<?php // Show four most recent posts.

				$recent_posts = new WP_Query( array(
					'posts_per_page'      => 5,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
					'no_found_rows'       => true
				) );
				?>

		 		<?php if ( $recent_posts->have_posts() ) : ?>

					<div class="recent-posts">
						<?php
						$postCount = 1;
						
						while ( $recent_posts->have_posts() ) : $recent_posts->the_post();
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
						endwhile;?>
						<div class="pagination-wrap">
							<a class="viewall" href="/blog/recent">
								View all Posts
							</a>
						</div>
						<?php wp_reset_postdata();
						?>
					</div><!-- .recent-posts -->
				<?php endif; ?>
			<?php endif; ?>
	</div><!-- .panel-content -->

</article><!-- #post-## -->
