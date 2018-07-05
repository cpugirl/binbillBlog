<?php
/**
 * Template part for displaying posts with first post
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
<?php 
    $categories_list = get_the_category_list( " " );
?>
<div class="featured-list-blog-wrap">
    <div class="featured-list-thumbnail">
        <?php if ( has_post_thumbnail() ) :?>
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail( 'binbill-featured-image' ); ?>
            </a>
        <?php endif; ?>
    </div>
    <div class="featured-list-post-detail">
    <div class="featured-list-post-category"><?php echo $categories_list; ?></div>
    <h2 class="featured-list-post-title">
        <?php 
            the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' );
        ?>
    </h2>
    <!--<div class="featured-list-blog-date"><?php //echo binbill_time_link();?></div>-->
    </div>
</div>