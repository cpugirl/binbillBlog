<?php
/**
 * Displays content for front page
 *
 * @package WordPress
 * @subpackage Bin_Bill
 * @since 1.0
 * @version 1.0
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'binbill-panel ' ); ?> >
	<div class="panel-content">
		<div class="container">
			<div class="featured-section">
				<?php // Show four most recent posts.
					$top_posts = new WP_Query( array(
						'posts_per_page'      => 1,
						'post_status'         => 'publish',
						'ignore_sticky_posts' => true,
						'no_found_rows'       => true,
						'meta_key' 			  => 'post_views_count',
    					'orderby'             => 'meta_value_num',
    					'order' 			  => 'DESC'
					) );
					$recent_posts = new WP_Query( array(
						'posts_per_page'      => 4,
						'post_status'         => 'publish',
						'ignore_sticky_posts' => true,
						'no_found_rows'       => true,
						'offset'			  => 1,
						'meta_key' 			  => 'post_views_count',
    					'orderby'             => 'meta_value_num',
    					'order' 			  => 'DESC'
					) );
				?>
				<?php if ( $top_posts->have_posts() ) : ?>
						<?php
						while ( $top_posts->have_posts() ) : $top_posts->the_post();
							get_template_part( 'template-parts/post/content', 'trendingfirst' );
						endwhile;
						wp_reset_postdata();
				?>
				<?php endif; ?>
				<div class="featured-list">
					<div class="featured-list-heading">Trending Posts</div>
					<div class="featured-list-blog">
						<?php if ( $recent_posts->have_posts() ) : ?>
								<?php
								while ( $recent_posts->have_posts() ) : $recent_posts->the_post();
									get_template_part( 'template-parts/post/content', 'trendingfollowing' );
								endwhile;
								wp_reset_postdata();					
							?>
						<?php endif; ?>
					</div>
					<a href="/blog/trending" class="featured-lists-all">
							MORE TRENDING POSTS
							<span>></span>
					</a>
				</div>
			
			</div>

		</div><!-- .wrap -->
	</div><!-- .panel-content -->

</article><!-- #post-## -->
