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
$post_link = "#";
$thumbnail_link = "";
$categories_list = get_the_category_list( " " );
?>
<div class="featured-main">
	<div class="featured-title">
		TRENDING
	</div>
    <?php if ( has_post_thumbnail() ) :
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'binbill-featured-image' );
		// Calculate aspect ratio: h / w * 100%.
        $ratio = $thumbnail[2] / $thumbnail[1] * 100;
        
		?>
	<?php endif; ?>
   
    <div class="featured-first" style="background: url(<?php echo esc_url( $thumbnail[0] ); ?>) center no-repeat;">
        <div class="featured-first-details">
            <div class="onerow">
                <div class="fiveCol"> 
                    <div class="featured-first-category"><?php echo $categories_list; ?></div>
                </div>
            </div>
            <div class="onerow">
                <h2 class="featured-first-title">
                    <?php 
                        the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' );
                    ?>
                </h2>
            </div>
            <div class="onerow featured-first-meta">
                <!--<div class="featured-first-meta-date"><?php //echo binbill_time_link();?></div>-->
                <div class="featured-first-meta-date"><?php echo binbill_views_link();?></div>
                <div class="featured-first-meta-date"><?php echo binbill_comments_link();?></div>
            </div>
        </div>
    </div>
</div>