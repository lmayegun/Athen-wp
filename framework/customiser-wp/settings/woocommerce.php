<?php
/**
 * WooCommerce customizer options
 *
 * @package     Total
 * @subpackage  Customizer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       1.6.0
 */


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Return if the WooCommerce plugin isn't active
if ( ! ATHEN_CHECK_WOOCOMMERCE ) {
    return;
}

/*-----------------------------------------------------------------------------------*/
/*  - General
/*-----------------------------------------------------------------------------------*/
$this->sections['athen_woocommerce_general'] = array(
    'title'     => __( 'General', 'athen_transl' ),
    'panel'     => 'athen_woocommerce',
    'settings'  => array(
        array(
            'id'        => 'woo_custom_sidebar',
            'default'   => true,
            'control'   => array (
                'label' =>  __( 'Custom WooCommerce Sidebar', 'athen_transl' ),
                'type'  => 'checkbox',
            ),
        ),
        array(
            'id'        => 'woo_menu_icon',
            'default'   => true,
            'control'   => array (
                'label' =>  __( 'Menu Cart', 'athen_transl' ),
                'type'  => 'checkbox',
            ),
            'desc'  => __( 'You must save your options and refresh your live site to preview changes to this setting.', 'athen_transl' ),
        ),
        array(
            'id'        => 'woo_menu_icon_amount',
            'default'   => false,
            'transport' => 'refresh',
            'control'   => array (
                'label' =>  __( 'Menu Cart: Amount', 'athen_transl' ),
                'type'  => 'checkbox',
                'desc'  => __( 'You must save your options and refresh your live site to preview changes to this setting.', 'athen_transl' ),
            ),
        ),
        array(
            'id'        => 'woo_menu_icon_style',
            'default'   => 'drop-down',
            'control'   => array (
                'label' =>  __( 'Menu Cart: Style', 'athen_transl' ),
                'type'      => 'select',
                'choices'   => array(
                    'drop-down'     => __( 'Drop-Down','athen_transl' ),
                    'overlay'       => __( 'Open Cart Overlay','athen_transl' ),
                    'store'         => __( 'Go To Store','athen_transl' ),
                    'custom-link'   => __( 'Custom Link','athen_transl' ),
                ),
            ),
        ),
        array(
            'id'        => 'woo_menu_icon_custom_link',
            'control'   => array (
                'label' =>  __( 'Menu Cart: Custom Link', 'athen_transl' ),
                'type'  => 'text',
            ),
        ),
    )
);

/*-----------------------------------------------------------------------------------*/
/*  - Archives
/*-----------------------------------------------------------------------------------*/
$this->sections['athen_woocommerce_archives'] = array(
    'title'     => __( 'Archives', 'athen_transl' ),
    'panel'     => 'athen_woocommerce',
    'settings'  => array(
        array(
            'id'        => 'woo_shop_title',
            'default'   => 'on',
            'control'   => array (
                'label' => __( 'Shop Title', 'athen_transl' ),
                'type'  => 'checkbox',
            ),
        ),
        array(
            'id'        => 'woo_shop_slider',
            'control'   => array (
                'label' => __( 'Shop Slider', 'athen_transl' ),
                'type'  => 'text',
            ),
        ),
        array(
            'id'        => 'woo_shop_posts_per_page',
            'default'   => '12',
            'control'   => array (
                'label' => __( 'Shop Posts Per Page', 'athen_transl' ),
                'type'  => 'text',
                'desc'  => __( 'You must save your options and refresh your live site to preview changes to this setting.', 'athen_transl' ),
            ),
        ),
        array(
            'id'            => 'woo_shop_layout',
            'default'       => 'full-width',
            'control'       => array (
                'label'     => __( 'Layout', 'athen_transl' ),
                'type'      => 'select',
                'choices'   => array(
                    'full-width'    => __( 'No Sidebar','athen_transl' ),
                    'right-sidebar' => __( 'Right Sidebar','athen_transl' ),
                    'left-sidebar'  => __( 'Left Sidebar','athen_transl' ),
                ),
            ),
        ),
        array(
            'id'            => 'woocommerce_shop_columns',
            'default'       => '4',
            'control'       => array (
                'label'     => __( 'Shop Columns', 'athen_transl' ),
                'type'      => 'select',
                'choices'   => athen_grid_columns(),

            ),
        ),
        array(
            'id'            => 'woo_category_description_position',
            'default'       => 'under_title',
            'control'       => array (
                'label'     => __( 'Category Description Position', 'athen_transl' ),
                'type'      => 'select',
                'choices'   => array(
                    'under_title'   => __( 'Under Title', 'athen_transl' ),
                    'above_loop'    => __( 'Above Loop', 'athen_transl' ),
                ),

            ),
        ),
        array(
            'id'        => 'woo_shop_sort',
            'default'   => 'on',
            'control'   => array (
                'label' => __( 'Shop Sort', 'athen_transl' ),
                'type'  => 'checkbox',
                'desc'  => __( 'You must save your options and refresh your live site to preview changes to this setting.', 'athen_transl' ),
            ),
        ),
        array(
            'id'        => 'woo_shop_result_count',
            'default'   => 'on',
            'control'   => array (
                'label' => __( 'Shop Result Count', 'athen_transl' ),
                'type'  => 'checkbox',
                'desc'  => __( 'You must save your options and refresh your live site to preview changes to this setting.', 'athen_transl' ),
            ),
        ),
        array(
            'id'            => 'woo_product_entry_style',
            'default'       => 'image-swap',
            'control'       => array (
                'label'     => __( 'Product Entry Media', 'athen_transl' ),
                'type'      => 'select',
                'choices'   => array(
                    'featured-image'    => __( 'Featured Image','athen_transl' ),
                    'image-swap'        => __( 'Image Swap','athen_transl' ),
                    'gallery-slider'    => __( 'Gallery Slider','athen_transl' ),
                ),
            ),
        ),
    )
);


/*-----------------------------------------------------------------------------------*/
/*  - Single
/*-----------------------------------------------------------------------------------*/
$this->sections['athen_woocommerce_single'] = array(
    'title'     => __( 'Single', 'athen_transl' ),
    'panel'     => 'athen_woocommerce',
    'settings'  => array(
        array(
            'id'        => 'woo_shop_single_title',
            'default'   => __( 'Store', 'athen_transl' ),
            'control'   => array (
                'label' => __( 'Page Header Title', 'athen_transl' ),
                'type'  => 'text',
            ),
        ),
        array(
            'id'            => 'woo_product_layout',
            'default'       => 'full-width',
            'control'       => array (
                'label'     => __( 'Layout', 'athen_transl' ),
                'type'      => 'select',
                'choices'   => array(
                    'full-width'    => __( 'No Sidebar','athen_transl' ),
                    'right-sidebar' => __( 'Right Sidebar','athen_transl' ),
                    'left-sidebar'  => __( 'Left Sidebar','athen_transl' ),
                ),
            ),
        ),
        array(
            'id'        => 'woocommerce_upsells_count',
            'default'   => '4',
            'control'   => array (
                'label' => __( 'Up-Sells Count', 'athen_transl' ), 
                'type'  => 'text',
            ),
        ),
        array(
            'id'            => 'woocommerce_upsells_columns',
            'default'       => '4',
            'control'       => array (
                'label'     => __( 'Up-Sells Columns', 'athen_transl' ), 
                'type'      => 'select',
                'choices'   => athen_grid_columns(),
            ),
        ),
        array(
            'id'        => 'woocommerce_related_count',
            'default'   => '4',
            'control'   => array (
                'label' => __( 'Related Items Count', 'athen_transl' ), 
                'type'  => 'text',
            ),
        ),
        array(
            'id'            => 'woocommerce_related_columns',
            'default'       => '4',
            'control'       => array (
                'label'     => __( 'Related Products Columns', 'athen_transl' ),
                'type'      => 'select',
                'choices'   => athen_grid_columns(),
            ),
        ),
        array(
            'id'        => 'woo_product_meta',
            'default'   => 'on',
            'control'   => array (
                'label' => __( 'Product Meta', 'athen_transl' ),
                'type'  => 'checkbox',
                'desc'  => __( 'You must save your options and refresh your live site to preview changes to this setting.', 'athen_transl' ),
            ),
        ),
        array(
            'id'        => 'woo_next_prev',
            'default'   => 'on',
            'control'   => array (
                'label' => __( 'Next & Previous Links', 'athen_transl' ),
                'type'  => 'checkbox',
            ),
        ),
    ),
);

/*-----------------------------------------------------------------------------------*/
/*  - Single
/*-----------------------------------------------------------------------------------*/
$this->sections['athen_woocommerce_cart'] = array(
    'title'     => __( 'Cart', 'athen_transl' ),
    'panel'     => 'athen_woocommerce',
    'settings'  => array(
        array(
            'id'        => 'woocommerce_cross_sells_count',
            'default'   => '2',
            'control'   => array (
                'label' => __( 'Cross-Sells Count', 'athen_transl' ),
                'type'  => 'text',
            ),
        ),
        array(
            'id'            => 'woocommerce_cross_sells_columns',
            'default'       => '2',
            'control'       => array (
                'label'     => __( 'Cross-Sells Columns', 'athen_transl' ),
                'type'      => 'select',
                'choices'   => athen_grid_columns(),
            ),
        ),
    ),
);

/*-----------------------------------------------------------------------------------*/
/*  - Extras - These options hook into other sections
/*-----------------------------------------------------------------------------------*/

// Social Sharing
$wp_customize->add_setting( 'social_share_woo', array(
    'type'              => 'theme_mod',
    'default'           => false,
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'social_share_woo', array(
    'label'     =>  __( 'WooCommerce: Social Share', 'athen_transl' ),
    'section'   => 'athen_social_sharing',
    'settings'  => 'social_share_woo',
    'priority'  => 10,
    'type'      => 'checkbox',
) );