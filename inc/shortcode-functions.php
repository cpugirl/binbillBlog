<?php
/**
 * Additional features to allow styling of the templates
 *
 * @package WordPress
 * @subpackage Bin_Bill
 * @since 1.0
 */

/*Add social Links on Widget*/
function social_shortcode( $atts, $content = null ) {
	return '<span class="social-widget-wrap">' . do_shortcode($content) . '</span>';
}
add_shortcode( 'social', 'social_shortcode' );

/*Add social Item on Widget*/
function social_item_shortcode( $atts, $content = null ) {
    $themepath = get_template_directory_uri();
    $actiontest = $atts["actiontext"]?$atts["actiontext"]:"Follow Us";
    return '<a class="social-widget-list '.$atts["type"].'" href="'.$atts["link"].'" target="_blank">
                <div class="social-icon"><img src="'.$themepath.'/assets/images/'.$atts["type"].'-white.png"/></div>
                <div class="social-text">'.$atts["type"].'</div>
                <div class="social-action">'.$actiontest.'</div>
            </a>';
}
add_shortcode( 'socialitem', 'social_item_shortcode' );


/*Blog lists widget*/
function bloglist_widget_shortcode( $atts, $content = null ) {
    $count = $atts["count"]?$atts["count"]:4;
    $category = $atts["category"]?$atts["category"]:"";
    $tags = $atts["tag"]?$atts["tag"]:"";

    $category_posts =  get_posts( array(
        'posts_per_page'      => $count,
        'post_status'         => 'publish',
        'category_name'       =>  $category,
        'ignore_sticky_posts' => true,
        'no_found_rows'       => true,
        'tag'            =>  $tags
    ) );
    $postlist = '<div class="featured-list-blog">';
    //<div class="featured-list-blog-date">'. get_the_time("d M Y",$post->ID).'</div>
    foreach( $category_posts as $post ){
            $categories_list = get_the_category_list( " ","", $post->ID);
            $postlist.='<div class="featured-list-blog-wrap">
                            <div class="featured-list-thumbnail">
                                    <a href="' . get_permalink($post->ID) . '">'
                                        .get_the_post_thumbnail($post->ID, 'binbill-featured-image' ).
                                    '</a>
                            </div>
                            <div class="featured-list-post-detail">
                            <div class="featured-list-post-category">'.$categories_list.'</div>
                            <h2 class="featured-list-post-title"><a href="' . get_permalink($post->ID) . '">' . $post->post_title.'</a></h2>
                            
                            </div>
                        </div>';
   }
   
  
   $postlist.='</div>';
   if(isset($atts["showmorelink"])){
        $postlist.='<div class="featured-allpost-link"><a href="/blog/tag/'.$tags.'">More '.implode(explode("-",$tags)," ").'</a></div>';
   }

    return "{$postlist}";
}
add_shortcode( 'bloglist', 'bloglist_widget_shortcode' );

/*Subscribe on Widget*/
function subscribe_shortcode( $atts, $content = null ) {
    
    return '
            <div class="subs-wrap">
                <div class="subs-text">Sign up for the newsletter and receive email notification of every future post.</div>
                <div class="subs-input">
                    <input type="email" name="subsemail" id="subsemail" placeholder="Your e-mail address"/>
                </div>
                <div class="subs-submit">
                    <input type="button" id="subs-submit" value="SUBSCRIBE NOW">
                </div>
            </div>
            <div class="subs-thankyou"> 
                <div class="subs-check">&#x2713;</div>
                <br>
                Thank You for subscribing to us.
            </div>
    ';
}
add_shortcode( 'subscribe', 'subscribe_shortcode' );