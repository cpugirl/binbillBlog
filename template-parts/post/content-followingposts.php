<?php
/**
 * Template part for displaying posts with following post
 *
 * Used in Search Results and for Recent Posts in Front Page panels.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Bin_Bill
 * @since 1.0
 * @version 1.2
 */

?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="first-post-wrap">
            <?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
                <div class="post-thumbnail">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail( 'binbill-featured-image' ); ?>
                    </a>
                </div><!-- .post-thumbnail -->
            <?php endif; ?>
            <div class="first-post-details">
                <div class="first-post-category"><?php echo get_the_category_list( " " );?></div>
                <div class="first-post-title">
                    <?php if ( is_front_page() && ! is_home() ) {

                        // The excerpt is being displayed within a front page section, so it's a lower hierarchy than h2.
                        the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
                        } else {
                        the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
                        } 
                    ?>
                </div>
                <div class="first-post-desc entry-summary">
                    <?php the_excerpt(); ?>
                </div><!-- .entry-summary -->
                <div class="first-post-meta">
                    <?php if ( 'post' === get_post_type() ) : ?>
                        <div class="entry-meta">
                            <?php
                            //echo binbill_time_link();
                            echo binbill_views_link();
                            echo binbill_comments_link();
                            echo binbill_share_link();
                            binbill_edit_link();
                            ?>
                        </div><!-- .entry-meta -->
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </article><!-- #post-## -->

