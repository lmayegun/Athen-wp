<?php
/**
 * Add Menu Cart to menu
 *
 * @package		Total
 * @subpackage	Framework/WooCommerce
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		1.0.0
 * @version		2.1.0
 */

add_filter( 'wp_nav_menu_items', 'athen_add_itemcart_to_menu' , 10, 2 );
add_filter( 'add_to_cart_fragments', 'athen_wcmenucart_add_to_cart_fragment' );
		
/**
 * Add the WooCommerce cart item to th enav
 *
 * @since Total 1.0
 */
if ( ! function_exists( 'athen_add_itemcart_to_menu' ) ) {
	function athen_add_itemcart_to_menu( $items, $args ) {
		
		// Add to main menu only
		if ( 'main_menu' == $args->theme_location ) {

			// Toggle class
			$toggle_class = 'toggle-cart-widget';

			// Define classes to add to li element
			$classes = array( 'woo-menu-icon' );

			// Get style from theme mod
			$style = athen_get_mod( 'woo_menu_icon_style', 'drop-down' );
			
			// Add style class
			$classes[] = 'wcmenucart-toggle-'. $style;

			// Prevent clicking on cart and checkout
			if ( ( is_cart() || is_checkout() ) && 'custom-link' != $style ) {
				$classes[] = 'nav-no-click';
			}

			// Add toggle class
			else {
				$classes[] = $toggle_class;
			}

			// Turn classes into string
			$classes = implode( ' ', $classes );
			
			// Add cart link to menu items
			$items .= '<li class="'. $classes .'">' . athen_wcmenucart_menu_item() .'</li>';
		}
		
		// Return menu items
		return $items;
	}
	
}

/**
 * WooFragments update the shop menu icon when the cart is updated via ajax
 *
 * @since Total 1.0
 */
if ( ! function_exists( 'athen_wcmenucart_add_to_cart_fragment' ) ) {
	function athen_wcmenucart_add_to_cart_fragment( $fragments ) {
		$fragments['.wcmenucart'] = athen_wcmenucart_menu_item();
		return $fragments;
	}
}

/**
 * Creates the WooCommerce link for the navbar
 *
 * @since Total 1.0
 */
if ( ! function_exists( 'athen_wcmenucart_menu_item' ) ) {
	function athen_wcmenucart_menu_item() {
		
		// Vars
		global $woocommerce;
		$icon_style		= athen_get_mod( 'woo_menu_icon_style', 'drop-down' );
		$custom_link	= athen_get_mod( 'woo_menu_icon_custom_link' );

		// URL
		if ( 'custom-link' == $icon_style && $custom_link ) {
			$url = esc_url( $custom_link );
		} else {
			$cart_id = woocommerce_get_page_id( 'cart' );
			if ( function_exists( 'icl_object_id' ) ) {
				$cart_id = icl_object_id( $cart_id, 'page' );
			}
			$url = get_permalink( $cart_id );
		}
		
		// Cart total
		if ( athen_get_mod( 'woo_menu_icon_amount' ) ) {
			$cart_total = $woocommerce->cart->get_cart_total();
			$cart_total = str_replace( 'amount', 'wcmenucart-amount', $cart_total );
		} else {
			$cart_total = '';
		}

		// Cart Icon
		$cart_icon = '<span class="fa fa-shopping-cart"></span>';
		$cart_icon = apply_filters( 'athen_menu_cart_icon_html', $cart_icon );

		ob_start(); ?>
			<a href="<?php echo $url; ?>" class="wcmenucart" title="<?php _e('Your Cart','athen_transl'); ?>">
				<span class="link-inner">
					<span class="wcmenucart-count"><?php echo $cart_icon; ?><?php echo $cart_total; ?></span>
				</span>
			</a>
		<?php
		return ob_get_clean();
	}
}