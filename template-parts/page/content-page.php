<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Bin_Bill
 * @since 1.0
 * @version 1.0
 */

?>
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">
							<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
							<?php binbill_edit_link( get_the_ID() ); ?>
						</header><!-- .entry-header -->
						<div class="entry-content">
							<?php
								the_content();

								wp_link_pages( array(
									'before' => '<div class="page-links">' . __( 'Pages:', 'binbill' ),
									'after'  => '</div>',
								) );
							?>
						</div><!-- .entry-content -->
			</article><!-- #post-## -->
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->
