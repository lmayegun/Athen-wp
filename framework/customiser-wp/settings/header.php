<?php
/**
 * Description : Bunch of wp->customise methods to customise header
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
$wp_customize->add_section( 'athen_header_general' , array(
	'title'		=> __( 'General', 'athen_transl' ),
	'priority'	=> 1,
	'panel'		=> 'athen_header',
) );

// Style
$wp_customize->add_setting( 'header_style', array(
	'type'		=> 'theme_mod',
	'default'	=> 'one',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'header_style', array(
	'label'		=> __( 'Header Style', 'athen_transl' ),
	'section'	=> 'athen_header_general',
	'settings'	=> 'header_style',
	'priority'	=> 1,
	'type'		=> 'select',
	'choices'	=> array(
		'one'	=> __( 'One','athen_transl' ),
		'two'	=> __( 'Two','athen_transl' ),
		'three'	=> __( 'Three','athen_transl' )
	),
) );

// Custom Height
$wp_customize->add_setting( 'header_height', array(
	'type'		=> 'theme_mod',
	'default'	=> '',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'header_height', array(
	'label'			=> __( 'Custom Header Height', 'athen_transl' ),
	'section'		=> 'athen_header_general',
	'settings'		=> 'header_height',
	'priority'		=> 2,
	'type'			=> 'text',
	'description'	=> __( 'Use this setting to define a fixed header height (Header Style One Only. Use this option ONLY if you want the navigation drop-downs to fall right under the header. Remove the default height (leave this field empty) if you want the header to auto expand depending on your logo height.', 'athen_transl' )
) );

/*-----------------------------------------------------------------------------------*/
/*	- Logo
/*-----------------------------------------------------------------------------------*/

// Define Logo Section
$wp_customize->add_section( 'athen_header_logo' , array(
	'title'		=> __( 'Logo', 'athen_transl' ),
	'priority'	=> 2,
	'panel'		=> 'athen_header',
) );

// Logo Icon
$wp_customize->add_setting( 'logo_icon', array(
	'type'		=> 'theme_mod',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'logo_icon', array(
	'label'		=> __( 'Text Logo Icon', 'athen_transl' ),
	'section'	=> 'athen_header_logo',
	'settings'	=> 'logo_icon',
	'priority'	=> 1,
	'type'		=> 'select',
	'choices'	=> athen_get_awesome_icons(),
) );

// Logo Image
$wp_customize->add_setting( 'custom_logo', array(
	'type'		=> 'theme_mod',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,  'custom_logo', array(
	'label'		=> __( 'Image Logo', 'athen_transl' ),
	'section'	=> 'athen_header_logo',
	'settings'	=> 'custom_logo',
	'priority'	=> 4,
) ) );

// Retina Logo Image
$wp_customize->add_setting( 'retina_logo', array(
	'type'		=> 'theme_mod',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,  'retina_logo', array(
	'label'		=> __( 'Retina Image Logo', 'athen_transl' ),
	'section'	=> 'athen_header_logo',
	'settings'	=> 'retina_logo',
	'priority'	=> 5,
) ) );

// Standard Logo height
$wp_customize->add_setting( 'retina_logo_height', array(
	'type'		=> 'theme_mod',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'retina_logo_height', array(
	'label'			=> __( 'Standard Retina Logo Height', 'athen_transl' ),
	'section'		=> 'athen_header_logo',
	'settings'		=> 'retina_logo_height',
	'priority'		=> 6,
	'type'			=> 'text',
	'description'	=> __( 'Enter the height in pixels of your standard logo size in order to mantain proportions for your retina logo.', 'athen_transl' ),
) );

// Desktop Logo max Width
$wp_customize->add_setting( 'logo_max_width', array(
	'type'		=> 'theme_mod',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'logo_max_width', array(
	'label'			=> __( 'Logo Max Width: Desktop', 'athen_transl' ),
	'section'		=> 'athen_header_logo',
	'settings'		=> 'logo_max_width',
	'priority'		=> 7,
	'type'			=> 'text',
	'description'	=> __( 'Screens 960px wide and greater.', 'athen_transl' ),
) );

// Tablet Portrait Logo max Width
$wp_customize->add_setting( 'logo_max_width_tablet_portrait', array(
	'type'		=> 'theme_mod',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'logo_max_width_tablet_portrait', array(
	'label'			=> __( 'Logo Max Width: Tablet Portrait', 'athen_transl' ),
	'section'		=> 'athen_header_logo',
	'settings'		=> 'logo_max_width_tablet_portrait',
	'priority'		=> 8,
	'type'			=> 'text',
	'description'	=> __( 'Screens 768px-959px wide.', 'athen_transl' ),
) );

// Phone Portrait Logo max Width
$wp_customize->add_setting( 'logo_max_width_phone', array(
	'type'		=> 'theme_mod',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'logo_max_width_phone', array(
	'label'			=> __( 'Logo Max Width: Phone', 'athen_transl' ),
	'section'		=> 'athen_header_logo',
	'settings'		=> 'logo_max_width_phone',
	'priority'		=> 9,
	'type'			=> 'text',
	'description'	=> __( 'Screens smaller then 767px wide.', 'athen_transl' ),
) );

// Logo Top Margin
$wp_customize->add_setting( 'logo_top_margin', array(
	'type'		=> 'theme_mod',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'logo_top_margin', array(
	'label'			=> __( 'Logo Top Margin', 'athen_transl' ),
	'section'		=> 'athen_header_logo',
	'settings'		=> 'logo_top_margin',
	'priority'		=> 10,
	'type'			=> 'text',
	'description'	=> __( 'Will only work with the "Custom Header Height" option is left empty', 'athen_transl' ),
) );

// Logo Bottom Margin
$wp_customize->add_setting( 'logo_bottom_margin', array(
	'type'		=> 'theme_mod',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'logo_bottom_margin', array(
	'label'			=> __( 'Logo Bottom Margin', 'athen_transl' ),
	'section'		=> 'athen_header_logo',
	'settings'		=> 'logo_bottom_margin',
	'priority'		=> 11,
	'type'			=> 'text',
	'description'	=> __( 'Will only work with the "Custom Header Height" option is left empty', 'athen_transl' ),
) );

/*-----------------------------------------------------------------------------------*/
/*	- Fixed On Scroll
/*-----------------------------------------------------------------------------------*/

// Define Section
$wp_customize->add_section( 'athen_header_fixed' , array(
	'title'			=> __( 'Fixed Header', 'athen_transl' ),
	'priority'		=> 3,
	'panel'			=> 'athen_header',
) );

// Fixed Header Logo
$wp_customize->add_setting( 'fixed_header_logo', array(
	'type'		=> 'theme_mod',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,  'fixed_header_logo', array(
	'label'		=> __( 'Fixed Header Custom Logo', 'athen_transl' ),
	'section'	=> 'athen_header_fixed',
	'settings'	=> 'fixed_header_logo',
	'priority'	=> 1,
) ) );

// Fixed Header
$wp_customize->add_setting( 'fixed_header', array(
	'type'				=> 'theme_mod',
	'default'			=> '1',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'fixed_header', array(
	'label'			=> __( 'Fixed Header on Scroll', 'athen_transl' ),
	'section'		=> 'athen_header_fixed',
	'settings'		=> 'fixed_header',
	'priority'		=> 2,
	'type'			=> 'checkbox',
	'description'	=> __( 'For some header styles the entire header will be fixed for others only the menu.', 'athen_transl' )
) );

// Shrink Fixed Header
$wp_customize->add_setting( 'shink_fixed_header', array(
	'type'				=> 'theme_mod',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'shink_fixed_header', array(
	'label'		=> __( 'Shrink Fixed Header', 'athen_transl' ),
	'section'	=> 'athen_header_fixed',
	'settings'	=> 'shink_fixed_header',
	'priority'	=> 3,
	'type'		=> 'checkbox',
) );

// Sticky header on mobile
$wp_customize->add_setting( 'fixed_header_mobile', array(
	'type'		=> 'theme_mod',
	'default'	=> false,
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'fixed_header_mobile', array(
	'label'			=> __( 'Fixed Header On Mobile', 'athen_transl' ),
	'section'		=> 'athen_header_fixed',
	'settings'		=> 'fixed_header_mobile',
	'priority'		=> 4,
	'type'			=> 'checkbox',
	'description'	=> __( 'For header style one only', 'athen_transl' ),
) );

/*-----------------------------------------------------------------------------------*/
/*	- Aside
/*-----------------------------------------------------------------------------------*/

// Define Section
$wp_customize->add_section( 'athen_header_aside' , array(
	'title'			=> __( 'Aside Content', 'athen_transl' ),
	'priority'		=> 5,
	'panel'			=> 'athen_header',
	'description'	=> __( 'The "aside" content for the header is displayed in various header styles, but not all of them.'),
) );

// Header aside content
$wp_customize->add_setting( 'header_aside', array(
	'type'		=> 'theme_mod',
	'default'	=> '[font_awesome icon="mobile" color="#000" font_size="40" margin_left=""20" margin_right="10"] + 097 637 293 [font_awesome icon="envelope" color="#000" font_size="40" margin_left="20" margin_right="10"] info@youremail.com',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'header_aside', array(
	'label'			=> __( 'Header Aside Content', 'athen_transl' ),
	'section'		=> 'athen_header_aside',
	'settings'		=> 'header_aside',
	'priority'		=> 1,
	'type'			=> 'textarea',
) );
