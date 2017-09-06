<?php
/**
 * Loads the required files to extend the Visual Composer plugin
 *
 * @package     Total
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       1.4.0
 * @version     2.1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Return if class not found
if ( ! class_exists( 'WPBakeryShortCode' ) ) {
    return;
}

/**
 * All custom shortcodes for use with the Visual Composer Extension
 *
 * @since Total 1.4.0
 */
$vcex_modules = array(
    'parallax_bg'           => ATHEN_VCEX_DIR . 'shortcodes/parallax_bg.php',
    'spacing'               => ATHEN_VCEX_DIR . 'shortcodes/spacing.php',
    'divider'               => ATHEN_VCEX_DIR . 'shortcodes/divider.php',
    'heading'               => ATHEN_VCEX_DIR . 'shortcodes/heading.php',
    'icon_box'              => ATHEN_VCEX_DIR . 'shortcodes/icon_box.php',
    'teaser'                => ATHEN_VCEX_DIR . 'shortcodes/teaser.php',
    'feature'               => ATHEN_VCEX_DIR . 'shortcodes/feature.php',
    'callout'               => ATHEN_VCEX_DIR . 'shortcodes/callout.php',
    'list_item'             => ATHEN_VCEX_DIR . 'shortcodes/list_item.php',
    'bullets'               => ATHEN_VCEX_DIR . 'shortcodes/bullets.php',
    'button'                => ATHEN_VCEX_DIR . 'shortcodes/button.php',
    'pricing'               => ATHEN_VCEX_DIR . 'shortcodes/pricing.php',
    'skillbar'              => ATHEN_VCEX_DIR . 'shortcodes/skillbar.php',
    'icon'                  => ATHEN_VCEX_DIR . 'shortcodes/icon.php',
    'milestone'             => ATHEN_VCEX_DIR . 'shortcodes/milestone.php',
    'social_links'          => ATHEN_VCEX_DIR . 'shortcodes/social_links.php',
    'navbar'                => ATHEN_VCEX_DIR . 'shortcodes/navbar.php',
    'searchbar'             => ATHEN_VCEX_DIR . 'shortcodes/searchbar.php',
    'image_swap'            => ATHEN_VCEX_DIR . 'shortcodes/image_swap.php',
    'image_galleryslider'   => ATHEN_VCEX_DIR . 'shortcodes/image_galleryslider.php',
    'image_flexslider'      => ATHEN_VCEX_DIR . 'shortcodes/image_flexslider.php',
    'image_carousel'        => ATHEN_VCEX_DIR . 'shortcodes/image_carousel.php',
    'image_grid'            => ATHEN_VCEX_DIR . 'shortcodes/image_grid.php',
    'recent_news'           => ATHEN_VCEX_DIR . 'shortcodes/recent_news.php',
    'blog_grid'             => ATHEN_VCEX_DIR . 'shortcodes/blog_grid.php',
    'blog_carousel'         => ATHEN_VCEX_DIR . 'shortcodes/blog_carousel.php',
    'post_type_grid'        => ATHEN_VCEX_DIR . 'shortcodes/post_type_grid.php',
    'post_type_archive'     => ATHEN_VCEX_DIR . 'shortcodes/post_type_archive.php',
    'post_type_slider'      => ATHEN_VCEX_DIR . 'shortcodes/post_type_slider.php',
    'testimonials_grid'     => ATHEN_VCEX_DIR . 'shortcodes/testimonials_grid.php',
    'testimonials_slider'   => ATHEN_VCEX_DIR . 'shortcodes/testimonials_slider.php',
    'portfolio_grid'        => ATHEN_VCEX_DIR . 'shortcodes/portfolio_grid.php',
    'portfolio_carousel'    => ATHEN_VCEX_DIR . 'shortcodes/portfolio_carousel.php',
    'staff_grid'            => ATHEN_VCEX_DIR . 'shortcodes/staff_grid.php',
    'staff_carousel'        => ATHEN_VCEX_DIR . 'shortcodes/staff_carousel.php',
    'staff_social'          => ATHEN_VCEX_DIR . 'shortcodes/staff_social.php',
    'login_form'            => ATHEN_VCEX_DIR . 'shortcodes/login_form.php',
    'newsletter_form'       => ATHEN_VCEX_DIR . 'shortcodes/newsletter_form.php',
    'layerslider'           => ATHEN_VCEX_DIR . 'shortcodes/layerslider.php',
    'woocommerce_carousel'  => ATHEN_VCEX_DIR . 'shortcodes/woocommerce_carousel.php',
    'terms_grid'            => ATHEN_VCEX_DIR . 'shortcodes/terms_grid.php',
);

// Apply filters so I can add new modules for specific post-types and add-ons
$vcex_modules = apply_filters( 'vcex_builder_modules', $vcex_modules );

// Load custom modules
if ( ! empty( $vcex_modules ) ) {
    foreach ( $vcex_modules as $key => $val ) {
        require_once( $val );
    }
}