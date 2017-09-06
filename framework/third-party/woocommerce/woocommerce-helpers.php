<?php
/**
 * WooCommerce helper functions
 * This functions only load if WooCommerce is enabled because
 * they should be used within Woo loops only.
 *
 * @package     Total
 * @subpackage  Framework/WooCommerce
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
 * @version     2.0.0
 */

/**
 * Outputs placeholder image
 *
 * @since   Total 1.0.0
 * @return  string
 */
function athen_woo_placeholder_img() {
    if ( function_exists( 'wc_placeholder_img_src' ) && wc_placeholder_img_src() ) {
        $placeholder = '<img src="'. wc_placeholder_img_src() .'" alt="'. __( 'Placeholder Image', 'athen_transl' ) .'" class="woo-entry-image-main" />';
        $placeholder = apply_filters( 'athen_woo_placeholder_img_html', $placeholder );
        if ( $placeholder ) {
            echo $placeholder;
        }
    }
}

/**
 * Check if product is in stock
 *
 * @since Total 1.0.0
 */
function athen_woo_product_instock( $post_id = '' ) {
    global $post;
    $post_id        = $post_id ? $post_id : $post->ID;
    $stock_status   = get_post_meta( $post_id, '_stock_status', true );
    if ( 'instock' == $stock_status ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Outputs product price
 *
 * @since   Total 1.0.0
 * @return  string
 */
function athen_woo_product_price( $post_id = '' ) {
    echo athen_get_woo_product_price( $post_id );
}

/**
 * Returns product price
 *
 * @since   Total 1.0.0
 * @return  string
 */
function athen_get_woo_product_price( $post_id = '' ) {
    $post_id    = $post_id ? $post_id : get_the_ID();
    $product    = get_product( $post_id );
    $price      = $product->get_price_html();
    if ( $price ) {
        return $price;
    }
}