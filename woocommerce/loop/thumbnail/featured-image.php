<?php
/**
 * Image Swap style thumbnail
 *
 * @package     Total
 * @subpackage  Templates/WooCommerce
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.0.0
 * @version     2.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Return placeholder if there isn't a thumbnail defined.
if ( ! has_post_thumbnail() ) {
    athen_woo_placeholder_img();
    return;
}

// Get featured image
$attachment = get_post_thumbnail_id();

// Display featured image if defined
if ( $attachment ) {

    athen_post_thumbnail( array(
        'attachment'    => $attachment,
        'size'          => 'shop_catalog',
        'alt'           => athen_get_esc_title(),
        'class'         => 'woo-entry-image-main',
    ) );

}

// Display placeholder
else {

    echo '<img src="'. wc_placeholder_img_src() .'" alt="'. __( 'Placeholder Image', 'athen_transl' ) .'" class="woo-entry-image-main" />';

} ?>