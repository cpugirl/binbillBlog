<?php
/**
 * Displays top navigation
 *
 * @package WordPress
 * @subpackage Bin_Bill
 * @since 1.0
 * @version 1.2
 */

?>
<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'binbill' ); ?>">
	<button class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
		<?php
		echo binbill_get_svg( array( 'icon' => 'bars' ) );
		echo binbill_get_svg( array( 'icon' => 'close' ) );
		_e( 'Menu', 'binbill' );
		?>
	</button>

	<?php wp_nav_menu( array(
		'theme_location' => 'top',
		'menu_id'        => 'top-menu',
	) ); ?>

</nav><!-- #site-navigation -->
