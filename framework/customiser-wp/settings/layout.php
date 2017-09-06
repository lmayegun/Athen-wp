<?php
/**
 * Description : Bunch of wp->customise methods to customise layout panel
 * 
 * @package     Athen
 * @subpackage  Closer - Controller/Model
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/*-----------------------------------------------------------------------------------*/
/*  - General
/*-----------------------------------------------------------------------------------*/

// Define General Section
$wp_customize->add_section( 'athen_layout_general' , array(
    'title'     => __( 'General', 'athen_transl' ),
    'priority'  => 1,
    'panel'     => 'athen_layout',
) );

// Layout Style
$wp_customize->add_setting( 'main_layout_style', array(
    'type'      => 'theme_mod',
    'default'   => 'layout-one',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'main_layout_style', array(
    'label'     => __( 'Layout Style', 'athen_transl' ),
    'section'   => 'athen_layout_general',
    'settings'  => 'main_layout_style',
    'priority'  => 1,
    'type'      => 'select',
    'choices'   => array(
		'layout-one'			=> __( 'Full Width', 'athen_transl' ), 
        'layout-two'				=> __( 'Boxed Padding / No Full-Screen', 'athen_transl' ),
        'layout-three'			=> __( 'Boxed', 'athen_transl' ),	
    ),
) );

// Enable Responsiveness
$wp_customize->add_setting( 'responsive', array(
    'type'      => 'theme_mod',
    'default'   => '1',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'responsive', array(
    'label'         => __( 'Responsiveness', 'athen_transl' ),
    'section'       => 'athen_layout_general',
    'settings'      => 'responsive',
    'priority'      => 2,
    'type'          => 'checkbox',
    'description'   => __( 'If you are using the Visual Composer plugin, make sure to enable/disable the responsive settings at Settings->Visual composer as well.', 'athen_transl' ),
) );

// Enable Bootstrap Container 
$wp_customize->add_setting( 'athen_bootstrap_container', array(
   'type'       => 'theme_mod',
    'default'   => '1',
    'sanitize_callback' => false,
));
$wp_customize->add_control( 'athen_bootstrap_container', array(
   'label'      => __('Bootstrap Container', 'athen_transl'),
    'section'   => 'athen_layout_general',
    'settings'  => 'athen_bootstrap_container',
    'priority'  => 3,
    'type'      => 'checkbox',
    'description' => __('Enable bootstrap css container', 'athen_transl'),
));

// Enable Header Top Container 
$wp_customize->add_setting( 'athen_header_top_container', array(
   'type'       => 'theme_mod',
    'default'   => '0',
    'sanitize_callback' => false,
));
$wp_customize->add_control( 'athen_header_top_container', array(
   'label'      => __('Bootstrap Header Top Container', 'athen_transl'),
    'section'   => 'athen_layout_general',
    'settings'  => 'athen_header_top_container',
    'priority'  => 3,
    'type'      => 'checkbox',
    'description' => __('Enable bootstrap css container', 'athen_transl'),
));

// Enable Header Main Container 
$wp_customize->add_setting( 'athen_header_main_container', array(
   'type'       => 'theme_mod',
    'default'   => '0',
    'sanitize_callback' => false,
));
$wp_customize->add_control( 'athen_header_main_container', array(
   'label'      => __('Bootstrap Header Main Container', 'athen_transl'),
    'section'   => 'athen_layout_general',
    'settings'  => 'athen_header_main_container',
    'priority'  => 3,
    'type'      => 'checkbox',
    'description' => __('Enable bootstrap css container', 'athen_transl'),
));

// Enable Header Main Container 
$wp_customize->add_setting( 'athen_header_bottom_container', array(
   'type'       => 'theme_mod',
    'default'   => '0',
    'sanitize_callback' => false,
));
$wp_customize->add_control( 'athen_header_bottom_container', array(
   'label'      => __('Bootstrap Header Bottom Container', 'athen_transl'),
    'section'   => 'athen_layout_general',
    'settings'  => 'athen_header_bottom_container',
    'priority'  => 3,
    'type'      => 'checkbox',
    'description' => __('Enable bootstrap css container', 'athen_transl'),
));

// Enable Header Main Container 
$wp_customize->add_setting( 'athen_page_header_container', array(
   'type'       => 'theme_mod',
    'default'   => '0',
    'sanitize_callback' => false,
));
$wp_customize->add_control( 'athen_page_header_container', array(
   'label'      => __('Bootstrap Page Header Container', 'athen_transl'),
    'section'   => 'athen_layout_general',
    'settings'  => 'athen_page_header_container',
    'priority'  => 3,
    'type'      => 'checkbox',
    'description' => __('Enable bootstrap css container', 'athen_transl'),
));

// Enable Header Main Container 
$wp_customize->add_setting( 'athen_content_sidebar_container', array(
   'type'       => 'theme_mod',
    'default'   => '0',
    'sanitize_callback' => false,
));
$wp_customize->add_control( 'athen_content_sidebar_container', array(
   'label'      => __('Bootstrap Content & SIdebar Container', 'athen_transl'),
    'section'   => 'athen_layout_general',
    'settings'  => 'athen_content_sidebar_container',
    'priority'  => 3,
    'type'      => 'checkbox',
    'description' => __('Enable bootstrap css container', 'athen_transl'),
));

// Enable Header Main Container 
$wp_customize->add_setting( 'athen_footer_main_container', array(
   'type'       => 'theme_mod',
    'default'   => '0',
    'sanitize_callback' => false,
));
$wp_customize->add_control( 'athen_footer_main_container', array(
   'label'      => __('Bootstrap Footer Main Container', 'athen_transl'),
    'section'   => 'athen_layout_general',
    'settings'  => 'athen_footer_main_container',
    'priority'  => 3,
    'type'      => 'checkbox',
    'description' => __('Enable bootstrap css container', 'athen_transl'),
));
/*-----------------------------------------------------------------------------------*/
/*  - Boxed Layout
/*-----------------------------------------------------------------------------------*/

// Define Boxed Section
$wp_customize->add_section( 'athen_layout_boxed' , array(
    'title'         => __( 'Boxed Layout', 'athen_transl' ),
    'priority'      => 2,
    'panel'         => 'athen_layout',
) );

// Boxed Layout DropShadow
$wp_customize->add_setting( 'boxed_dropdshadow', array(
    'type'      => 'theme_mod',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'boxed_dropdshadow', array(
    'label'     => __( 'Boxed Layout Drop-Shadow', 'athen_transl' ),
    'section'   => 'athen_layout_boxed',
    'settings'  => 'boxed_dropdshadow',
    'priority'  => 1,
    'type'      => 'checkbox',
) );


/*-----------------------------------------------------------------------------------*/
/*  - Desktop Widths
/*-----------------------------------------------------------------------------------*/

// Define Desktop Layout Section
$wp_customize->add_section( 'athen_layout_desktop_widths' , array(
    'title'         => __( 'Desktop Widths', 'athen_transl' ),
    'priority'      => 3,
    'panel'         => 'athen_layout',
    'description'   => __( 'For screens greater than or equal to 1281px. Accepts both pixels or percentage values.', 'athen_transl' )
) );

// Main Container Width
$wp_customize->add_setting( 'main_wrap_width', array(
    'type'      => 'theme_mod',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'main_wrap_width', array(
    'label'         => __( 'Main Container Width', 'athen_transl' ),
    'section'       => 'athen_layout_desktop_widths',
    'settings'      => 'main_wrap_width',
    'priority'      => 1,
    'type'          => 'text',
    'description'   => _x( 'Default:', 'athen_transl', 'Customizer' ) .' 1100px',
) );

// Section Width - Content & Sidebar Combined
$wp_customize->add_setting( 'section_width', array(
    'type'      => 'theme_mod',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'section_width', array(
    'label'     => __( 'Section Width', 'athen_transl'),
    'section'   => 'athen_layout_desktop_widths',
    'settings'  => 'section_width',
    'priority'  => 2,
    'type'      => 'text',
    'description'   => _x( 'Default:', 'athen_transl', 'Customizer') .'Content area and Sidebar width combined',
));

// Content Width
$wp_customize->add_setting( 'content_width', array(
    'type'      => 'theme_mod',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'content_width', array(
    'label'         => __( 'Content Width', 'athen_transl' ),
    'section'       => 'athen_layout_desktop_widths',
    'settings'      => 'content_width',
    'priority'      => 3,
    'type'          => 'text',
    'default'       => '100',
    'description'   => _x( 'Default:', 'athen_transl', 'Customizer' ) .' 100%',
) );

// Post Box Width
$wp_customize->add_setting( 'posts_box_width', array(
    'type'      => 'theme_mod',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'posts_box_width', array(
    'label'         => __( 'Posts Box Width', 'athen_transl' ),
    'section'       => 'athen_layout_desktop_widths',
    'settings'      => 'posts_box_width',
    'priority'      => 3,
    'type'          => 'text',
    'default'       => '70',
    'description'   => _x( 'Default:', 'athen_transl', 'Customizer' ) .' 70%',
) );

// Sidebar Width
$wp_customize->add_setting( 'sidebar_width', array(
    'type'      => 'theme_mod',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'sidebar_width', array(
    'label'         => __( 'Sidebar Width', 'athen_transl' ),
    'section'       => 'athen_layout_desktop_widths',
    'settings'      => 'sidebar_width',
    'priority'      => 4,
    'type'          => 'text',
    'description'   => _x( 'Default:', 'athen_transl', 'Customizer' ) .' 250px',
) );

// Footer Width
$wp_customize->add_setting( 'footer_width', array(
    'type'      => 'theme_mod',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'footer_width', array(
    'label'         => __( 'Footer Width', 'athen_transl' ),
    'section'       => 'athen_layout_desktop_widths',
    'settings'      => 'footer_width',
    'priority'      => 4,
    'type'          => 'text',
    'description'   => _x( 'Default:', 'athen_transl', 'Customizer' ) .' 100%',
) );

// Footer Bottom Width
$wp_customize->add_setting( 'footer_bottom_width', array(
    'type'      => 'theme_mod',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'footer_bootom_width', array(
    'label'         => __( 'Footer Bottom Width', 'athen_transl' ),
    'section'       => 'athen_layout_desktop_widths',
    'settings'      => 'footer_bottom_width',
    'priority'      => 4,
    'type'          => 'text',
    'description'   => _x( 'Default:', 'athen_transl', 'Customizer' ) .' 100%',
) );



/*-----------------------------------------------------------------------------------*/
/*  - Medium Screen Widths
/*-----------------------------------------------------------------------------------*/

// Define Medium Screen Layout Section
$wp_customize->add_section( 'athen_layout_medium_widths' , array(
    'title'         => __( 'Medium Screens Widths', 'athen_transl' ),
    'priority'      => 4,
    'panel'         => 'athen_layout',
    'description'   => __( 'For screens between 960px - 1280px. Such as landscape tablets and small monitors/laptops. Accepts both pixels or percentage values.', 'athen_transl' )
) );

// Main Container Width
$wp_customize->add_setting( 'main_wrap_medium_width', array(
    'type'      => 'theme_mod',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'main_wrap_medium_width', array(
    'label'         => __( 'Main Container Width', 'athen_transl' ),
    'section'       => 'athen_layout_medium_widths',
    'settings'      => 'main_wrap_medium_width',
    'priority'      => 1,
    'type'          => 'text',
    'description'   => _x( 'Default:', 'athen_transl', 'Customizer' ) .' 1100px',
) );

// Section Width - Content & Sidebar Combined
$wp_customize->add_setting( 'section_medium_width', array(
    'type'      => 'theme_mod',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'section_medium_width', array(
    'label'     => __( 'Section Width', 'athen_transl'),
    'section'   => 'athen_layout_medium_widths',
    'settings'  => 'section_medium_width',
    'priority'  => 2,
    'type'      => 'text',
    'description'   => _x( 'Default:', 'athen_transl', 'Customizer') .'Content area and Sidebar width combined',
));

// Content Width
$wp_customize->add_setting( 'content_medium_width', array(
    'type'      => 'theme_mod',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'content_medium_width', array(
    'label'         => __( 'Content Width', 'athen_transl' ),
    'section'       => 'athen_layout_medium_widths',
    'settings'      => 'content_medium_width',
    'priority'      => 3,
    'type'          => 'text',
    'default'       => '100',
    'description'   => _x( 'Default:', 'athen_transl', 'Customizer' ) .' 100%',
) );

// Post Box Width
$wp_customize->add_setting( 'posts_box_medium_width', array(
    'type'      => 'theme_mod',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'posts_box_medium_width', array(
    'label'         => __( 'Posts Box Width', 'athen_transl' ),
    'section'       => 'athen_layout_medium_widths',
    'settings'      => 'posts_box_medium_width',
    'priority'      => 3,
    'type'          => 'text',
    'default'       => '70',
    'description'   => _x( 'Default:', 'athen_transl', 'Customizer' ) .' 70%',
) );

// Sidebar Width
$wp_customize->add_setting( 'sidebar_medium_width', array(
    'type'      => 'theme_mod',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'sidebar_medium_width', array(
    'label'         => __( 'Sidebar Width', 'athen_transl' ),
    'section'       => 'athen_layout_medium_widths',
    'settings'      => 'sidebar_medium_width',
    'priority'      => 4,
    'type'          => 'text',
    'description'   => _x( 'Default:', 'athen_transl', 'Customizer' ) .' 250px',
) );

// Footer Width
$wp_customize->add_setting( 'footer_medium_width', array(
    'type'      => 'theme_mod',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'footer_medium_width', array(
    'label'         => __( 'Footer Width', 'athen_transl' ),
    'section'       => 'athen_layout_medium_widths',
    'settings'      => 'footer_medium_width',
    'priority'      => 4,
    'type'          => 'text',
    'description'   => _x( 'Default:', 'athen_transl', 'Customizer' ) .' 100%',
) );

// Footer Bottom Width
$wp_customize->add_setting( 'footer_bottom_medium_width', array(
    'type'      => 'theme_mod',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'footer_bootom_medium_width', array(
    'label'         => __( 'Footer Bottom Width', 'athen_transl' ),
    'section'       => 'athen_layout_medium_widths',
    'settings'      => 'footer_bottom_medium_width',
    'priority'      => 4,
    'type'          => 'text',
    'description'   => _x( 'Default:', 'athen_transl', 'Customizer' ) .' 100%',
) );


/*-----------------------------------------------------------------------------------*/
/*  - Tablet Portrait Widths
/*-----------------------------------------------------------------------------------*/

// Define Tablet Layout Section
$wp_customize->add_section( 'athen_layout_tablet_widths' , array(
    'title'         => __( 'Tablet Widths', 'athen_transl' ),
    'priority'      => 5,
    'panel'         => 'athen_layout',
    'description'   => __( 'For screens between 768px - 959px. Such as portrait tablet. Accepts both pixels or percentage values.', 'athen_transl' )
) );

// Main Container Width
$wp_customize->add_setting( 'main_wrap_tablet_width', array(
    'type'      => 'theme_mod',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'main_wrap_tablet_width', array(
    'label'         => __( 'Main Container Width', 'athen_transl' ),
    'section'       => 'athen_layout_tablet_widths',
    'settings'      => 'main_wrap_tablet_width',
    'priority'      => 1,
    'type'          => 'text',
    'description'   => _x( 'Default:', 'athen_transl', 'Customizer' ) .' 1100px',
) );

// Section Width - Content & Sidebar Combined
$wp_customize->add_setting( 'section_tablet_width', array(
    'type'      => 'theme_mod',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'section_tablet_width', array(
    'label'     => __( 'Section Width', 'athen_transl'),
    'section'   => 'athen_layout_tablet_widths',
    'settings'  => 'section_tablet_width',
    'priority'  => 2,
    'type'      => 'text',
    'description'   => _x( 'Default:', 'athen_transl', 'Customizer') .'Content area and Sidebar width combined',
));

// Content Width
$wp_customize->add_setting( 'content_tablet_width', array(
    'type'      => 'theme_mod',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'content_tablet_width', array(
    'label'         => __( 'Content Width', 'athen_transl' ),
    'section'       => 'athen_layout_tablet_widths',
    'settings'      => 'content_tablet_width',
    'priority'      => 3,
    'type'          => 'text',
    'default'       => '100',
    'description'   => _x( 'Default:', 'athen_transl', 'Customizer' ) .' 100%',
) );

// Post Box Width
$wp_customize->add_setting( 'posts_box_tablet_width', array(
    'type'      => 'theme_mod',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'posts_box_tablet_width', array(
    'label'         => __( 'Posts Box Width', 'athen_transl' ),
    'section'       => 'athen_layout_tablet_widths',
    'settings'      => 'posts_box_tablet_width',
    'priority'      => 3,
    'type'          => 'text',
    'default'       => '70',
    'description'   => _x( 'Default:', 'athen_transl', 'Customizer' ) .' 70%',
) );

// Sidebar Width
$wp_customize->add_setting( 'sidebar_tablet_width', array(
    'type'      => 'theme_mod',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'sidebar_tablet_width', array(
    'label'         => __( 'Sidebar Width', 'athen_transl' ),
    'section'       => 'athen_layout_tablet_widths',
    'settings'      => 'sidebar_tablet_width',
    'priority'      => 4,
    'type'          => 'text',
    'description'   => _x( 'Default:', 'athen_transl', 'Customizer' ) .' 250px',
) );

// Footer Width
$wp_customize->add_setting( 'footer_tablet_width', array(
    'type'      => 'theme_mod',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'footer_tablet_width', array(
    'label'         => __( 'Footer Width', 'athen_transl' ),
    'section'       => 'athen_layout_tablet_widths',
    'settings'      => 'footer_tablet_width',
    'priority'      => 4,
    'type'          => 'text',
    'description'   => _x( 'Default:', 'athen_transl', 'Customizer' ) .' 100%',
) );

// Footer Bottom Width
$wp_customize->add_setting( 'footer_bottom_tablet_width', array(
    'type'      => 'theme_mod',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'footer_bootom_tablet_width', array(
    'label'         => __( 'Footer Bottom Width', 'athen_transl' ),
    'section'       => 'athen_layout_tablet_widths',
    'settings'      => 'footer_bottom_tablet_width',
    'priority'      => 4,
    'type'          => 'text',
    'description'   => _x( 'Default:', 'athen_transl', 'Customizer' ) .' 100%',
) );

/*-----------------------------------------------------------------------------------*/
/*  - Mobile Phone Widths
/*-----------------------------------------------------------------------------------*/

// Define Mobile Phone Layout Section
$wp_customize->add_section( 'athen_layout_phone_widths' , array(
    'title'         => __( 'Mobile Phone Widths', 'athen_transl' ),
    'priority'      => 6,
    'panel'         => 'athen_layout',
    'description'   => __( 'For screens between 0 - 767px. Accepts both pixels or percentage values.', 'athen_transl' )
) );

// Main Container Width
$wp_customize->add_setting( 'main_wrap_phone_width', array(
    'type'      => 'theme_mod',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'main_wrap_phone_width', array(
    'label'         => __( 'Main Container Width', 'athen_transl' ),
    'section'       => 'athen_layout_phone_widths',
    'settings'      => 'main_wrap_phone_width',
    'priority'      => 1,
    'type'          => 'text',
    'description'   => _x( 'Default:', 'athen_transl', 'Customizer' ) .' 1100px',
) );

// Section Width - Content & Sidebar Combined
$wp_customize->add_setting( 'section_phone_width', array(
    'type'      => 'theme_mod',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'section_phone_width', array(
    'label'     => __( 'Section Width', 'athen_transl'),
    'section'   => 'athen_layout_phone_widths',
    'settings'  => 'section_phone_width',
    'priority'  => 2,
    'type'      => 'text',
    'description'   => _x( 'Default:', 'athen_transl', 'Customizer') .'Content area and Sidebar width combined',
));

// Content Width
$wp_customize->add_setting( 'content_phone_width', array(
    'type'      => 'theme_mod',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'content_phone_width', array(
    'label'         => __( 'Content Width', 'athen_transl' ),
    'section'       => 'athen_layout_phone_widths',
    'settings'      => 'content_phone_width',
    'priority'      => 3,
    'type'          => 'text',
    'default'       => '100',
    'description'   => _x( 'Default:', 'athen_transl', 'Customizer' ) .' 100%',
) );

// Post Box Width
$wp_customize->add_setting( 'posts_box_phone_width', array(
    'type'      => 'theme_mod',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'posts_box_phone_width', array(
    'label'         => __( 'Posts Box Width', 'athen_transl' ),
    'section'       => 'athen_layout_phone_widths',
    'settings'      => 'posts_box_phone_width',
    'priority'      => 3,
    'type'          => 'text',
    'default'       => '70',
    'description'   => _x( 'Default:', 'athen_transl', 'Customizer' ) .' 70%',
) );

// Sidebar Width
$wp_customize->add_setting( 'sidebar_phone_width', array(
    'type'      => 'theme_mod',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'sidebar_phone_width', array(
    'label'         => __( 'Sidebar Width', 'athen_transl' ),
    'section'       => 'athen_layout_phone_widths',
    'settings'      => 'sidebar_phone_width',
    'priority'      => 4,
    'type'          => 'text',
    'description'   => _x( 'Default:', 'athen_transl', 'Customizer' ) .' 250px',
) );

// Footer Width
$wp_customize->add_setting( 'footer_phone_width', array(
    'type'      => 'theme_mod',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'footer_phone_width', array(
    'label'         => __( 'Footer Width', 'athen_transl' ),
    'section'       => 'athen_layout_phone_widths',
    'settings'      => 'footer_phone_width',
    'priority'      => 4,
    'type'          => 'text',
    'description'   => _x( 'Default:', 'athen_transl', 'Customizer' ) .' 100%',
) );

// Footer Bottom Width
$wp_customize->add_setting( 'footer_bottom_phone_width', array(
    'type'      => 'theme_mod',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'footer_bootom_phone_width', array(
    'label'         => __( 'Footer Bottom Width', 'athen_transl' ),
    'section'       => 'athen_layout_phone_widths',
    'settings'      => 'footer_bottom_phone_width',
    'priority'      => 4,
    'type'          => 'text',
    'description'   => _x( 'Default:', 'athen_transl', 'Customizer' ) .' 100%',
) );