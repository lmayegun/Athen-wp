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

// Return dummy image if no featured image is defined
if ( ! has_post_thumbnail() ) {
    athen_woo_placeholder_img();
    return;
}

// Get global product data
global $product;

// Get gallery images and exclude featured image incase it's added in the gallery as well
$attachment_id      = get_post_thumbnail_id();
$attachment_ids     = $product->get_gallery_attachment_ids();
$attachment_ids[]   = $attachment_id;
$attachment_ids     = array_unique( $attachment_ids );

// Slider data attributes
$data_atributes                                 = array();
$data_atributes['fade']                         = 'true';
$data_atributes['auto-play']                    = 'false';
$data_atributes['height-animation-duration']    = '0.0';
$data_atributes['loop']                         = 'false';
$data_atributes                                 = apply_filters( 'athen_shop_catalog_slider_data', $data_atributes );
$data_atributes_html                            = '';
foreach ( $data_atributes as $key => $val ) {
    $data_atributes_html .= ' data-'. $key .'="'. $val .'"';
}

// If there are attachments display slider
if ( $attachment_ids ) : ?>

    <div class="woo-product-entry-slider wpex-slider pro-slider"<?php echo $data_atributes_html; ?>>

        <div class="wpex-slider-slides sp-slides">

            <?php
            // Define counter variable
            $count=0; ?>

            <?php
            // Loop through images
            foreach ( $attachment_ids as $attachment_id ) : ?>

                <?php
                // Add to counter
                $count++; ?>

                <?php
                // Only display the first 5 images
                if ( $count < 5 ) : ?>

                    <?php
                    // Get thumbnail
                    $thumbnail = athen_get_post_thumbnail( array(
                        'attachment'    => $attachment_id,
                        'size'          => 'shop_catalog',
                    ) ); ?>

                    <?php
                    // Display thumbnail if there is one
                    if ( $thumbnail ) : ?>

                        <div class="wpex-slider-slide sp-slide">
                            <?php echo $thumbnail; ?>
                        </div><!-- .wpex-slider-slide -->

                    <?php endif; ?>

                <?php endif; ?>

            <?php endforeach; ?>
        </div><!-- .wpex-slider-slides -->

    </div><!-- .woo-product-entry-slider -->

<?php

// There aren't any images so lets display the featured image
else : ?>

    <?php wc_get_template(  'loop/thumbnail/'. $style .'.php' ); ;?>

<?php endif; ?>