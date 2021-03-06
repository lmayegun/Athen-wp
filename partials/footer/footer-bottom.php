<?php
/**
 * Footer bottom content
 *
 * @package		Total
 * @subpackage	Partials/Footer
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		1.6.0
 * @version		2.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get copyright info
$copyright = athen_get_mod( 'footer_copyright_text', 'Copyright <a href="#">Your Business LLC.</a> - All Rights Reserved' );

// WPML translations
$copyright = athen_translate_theme_mod( 'footer_copyright_text', $copyright ); ?>

<div id="footer-bottom" class="footer-bottom <?php echo athen_wrap_classes('footer-bottom-wrap'); ?> clr">
 
	<div id="footer-bottom-inner" class="container clr">

		<?php
		// Display copyright info
		if ( $copyright ) : ?>

			<div id="copyright" class="clr" role="contentinfo">
				<?php echo do_shortcode( $copyright ); ?>
			</div><!-- #copyright -->

		<?php endif; ?>

		<?php
		// Get footer menu location and apply filters for child theming
		$menu_location = 'footer_menu';
		$menu_location = apply_filters( 'athen_footer_menu_location', $menu_location);

		// Display footer bottom menu if location is defined
		if ( has_nav_menu( $menu_location ) ) : ?>

			<div id="footer-bottom-menu" class=" clr">
				<?php
				// Display footer menu
				wp_nav_menu( array(
					'theme_location' => $menu_location,
					'sort_column'    => 'menu_order',
					'fallback_cb'    => false,
				) ); ?>

			</div><!-- #footer-bottom-menu -->

		<?php endif; ?>

	</div><!-- #footer-bottom-inner -->

</div><!-- #footer-bottom -->