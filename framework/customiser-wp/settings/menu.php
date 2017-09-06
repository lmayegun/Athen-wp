<?php
/**
 * Description : Bunch of wp->customise methods to customise menu panel
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
/*	- General
/*-----------------------------------------------------------------------------------*/

// Define Section
$wp_customize->add_section( 'athen_menu_general' , array(
	'title'		=> __( 'General', 'athen_transl' ),
	'priority'	=> 1,
	'panel'		=> 'athen_menu',
) );

// Enable Icon Menu Bar
$wp_customize->add_setting ( 'athen_menu_bar', array (
	'type'		=> 'theme_mod',
	'default' 	=> '1',
	'sanitize_callback' => false,
) );

$wp_customize->add_control ( 'athen_menu_bar', array (
	'label' 	=> __( 'Menu Bar Icon', 'athen_transl' ),
	'section'	=> 'athen_menu_general',
	'settings'	=> 'athen_menu_bar',
	'priority'	=> 1,
	'type'		=> 'checkbox',
) );

// Enable Icon Menu Bar
$wp_customize->add_setting ( 'athen_menu_style', array (
	'type'		=> 'theme_mod',
	'default' 	=> 'one',
	'sanitize_callback' => false,
) );

$wp_customize->add_control ( 'athen_menu_style', array (
	'label' 	=> __( 'Menu Bar Icon', 'athen_transl' ),
	'section'	=> 'athen_menu_general',
	'settings'	=> 'athen_menu_style',
	'priority'	=> 1,
	'type'		=> 'select',
    'choices'   => array(
        'one'   => __( 'Style One', 'athen_transl'),
        'two'   => __( 'Style two', 'athen_transl'),
        'three' => __( 'Style three', 'athen_transl'),
    ),
) );

// Top Dropdown Icons
$wp_customize->add_setting( 'menu_arrow_down', array(
	'type'              => 'theme_mod',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'menu_arrow_down', array(
	'label'    => __( 'Top Level Dropdown Icon', 'athen_transl' ),
	'section'  => 'athen_menu_general',
	'settings' => 'menu_arrow_down',
	'priority' => 1,
	'type'     => 'checkbox',
) );

// Second+ Level Dropdown Icon
$wp_customize->add_setting( 'menu_arrow_side', array(
	'type'		=> 'theme_mod',
	'default'	=> '1',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'menu_arrow_side', array(
	'label'		=> __( 'Second+ Level Dropdown Icon', 'athen_transl' ),
	'section'	=> 'athen_menu_general',
	'settings'	=> 'menu_arrow_side',
	'priority'	=> 2,
	'type'		=> 'checkbox',
) );

// Dropdown Top Border
$wp_customize->add_setting( 'menu_dropdown_top_border', array(
	'type'		=> 'theme_mod',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'menu_dropdown_top_border', array(
	'label'		=> __( 'Dropdown Top Border', 'athen_transl' ),
	'section'	=> 'athen_menu_general',
	'settings'	=> 'menu_dropdown_top_border',
	'priority'	=> 3,
	'type'		=> 'checkbox',
) );

// Mobile Menu Icon
$wp_customize->add_setting( 'athen_mobile_menu_icon', array(
	'type'		=> 'theme_mod',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'athen_mobile_menu_icon', array(
	'label'		=> __( 'Dropdown Top Border', 'athen_transl' ),
	'section'	=> 'athen_menu_general',
	'settings'	=> 'athen_mobile_menu_icon',
	'priority'	=> 3,
    'type'			=> 'select',
   	'description'	=> __( 'Use this setting to define a fixed header height (Header Style One Only. Use this option ONLY if you want the navigation drop-downs to fall right under the header. Remove the default height (leave this field empty) if you want the header to auto expand depending on your logo height.', 'athen_transl' ),
	'choices'		=> array (
		'topbar_menu'	=> __( 'Top Header', 'athen_transl' ),
		'main_menu'	=> __( 'Main Header', 'athen_transl' ),
        'bottom_header_menu'	=> __( 'Bottom Header', 'athen_transl' ),
	),
) );

/*-----------------------------------------------------------------------------------*/
/*	- Mobile
/*-----------------------------------------------------------------------------------*/

// Define Section
$wp_customize->add_section( 'athen_menu_mobile' , array(
	'title'		=> __( 'Mobile', 'athen_transl' ),
	'priority'	=> 2,
	'panel'		=> 'athen_menu',
) );

// Mobile Menu Style
$wp_customize->add_setting( 'mobile_menu_style', array(
	'type'		=> 'theme_mod',
	'default'	=> 'sidr',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'mobile_menu_style', array(
	'label'		=> __( 'Mobile Menu Style', 'athen_transl' ),
	'section'	=> 'athen_menu_mobile',
	'settings'	=> 'mobile_menu_style',
	'priority'	=> 1,
	'type'		=> 'select',
	'choices'	=> array(
		'sidr'      => __( 'Sidebar', 'athen_transl' ),
		'toggle'    => __( 'Toggle', 'athen_transl' ),
		'disabled'  => __( 'Disabled', 'athen_transl' ),
	),
) );

// Sidr Direction
$wp_customize->add_setting( 'mobile_menu_sidr_direction', array(
	'type'		=> 'theme_mod',
	'default'	=> 'left',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'mobile_menu_sidr_direction', array(
	'label'		=> __( 'Sidebar Mobile Menu Direction', 'athen_transl' ),
	'section'	=> 'athen_menu_mobile',
	'settings'	=> 'mobile_menu_sidr_direction',
	'priority'	=> 1,
	'type'		=> 'select',
	'choices'	=> array(
		'left'	=> __( 'Left', 'athen_transl' ),
		'right'	=> __( 'Right', 'athen_transl' ),
	),
) );

/*-------------------------------------------------------------------------------------------------
		MegaMenu - Width - Background Image
---------------------------------------------------------------------------------------------------*/
// Define MegaMenu Section
$wp_customize->add_section( 'athen_mega_menu', array(
	'title' 	=> __( 'Mega Menu', 'athen_transl' ), 
	'priority' 	=> 3,
	'panel'	=> 'athen_menu',
));

// Mega Menu Width
$wp_customize->add_setting( 'mega_menu_width', array(
	'type'		=> 'theme_mod',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'mega_menu_width', array(
	'label'		=> __( 'Mega Menu Width', 'athen_transl' ),
	'section'	=> 'athen_mega_menu',
	'settings'	=> 'mega_menu_width',
	'priority'	=> 1,
	'type'		=> 'text',
) );

// Background Megamenu Image
$wp_customize->add_setting( 'mega_menu_bkg_img', array(
	'type'		=> 'theme_mod',
	'sanitize_callback' 	=> false,
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'mega_menu_bkg_img', array(
	'label'	=> __( 'Mega Menu Background Image', 'athen_transl' ),
	'section' 	=> 'athen_mega_menu',
	'settings'  => 'mega_menu_bkg_img',
	'priority'	=> 2,
)));

