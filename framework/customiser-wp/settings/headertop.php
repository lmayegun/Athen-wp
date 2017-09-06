<?php
/**
 * Description : Bunch of wp->customise methods to customise topbar
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
$wp_customize->add_section( 'athen_headertop_general' , array(
	'title'			=> __( 'General', 'athen_transl' ),
	'priority'		=> 1,
	'panel'			=> 'athen_headertop',
) );

// Enable Top bar
$wp_customize->add_setting( 'athen_headertop_enable_topbar', array(
	'type'		=> 'theme_mod',
	'default'	=> '1',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'athen_headertop_enable_topbar', array(
	'label'	=> __( 'Enable', 'athen_transl' ),
	'section'	=> 'athen_headertop_general',
	'settings'	=> 'athen_headertop_enable_topbar',
	'priority'	=> 1,
	'type'		=> 'checkbox',
) );

// Enable sticky Topbar
$wp_customize->add_setting ( 'athen_headertop_sticky', array (
	'type'		=> 'theme_mod',
	'default' 	=> '1',
	'sanitize_callback' => false,
) );

$wp_customize->add_control ( 'athen_headertop_sticky', array (
	'label' 	=> __( 'Sticky Topbar Enable', 'athen_transl' ),
	'section'	=> 'athen_headertop_general',
	'settings'	=> 'athen_headertop_sticky',
	'priority'	=> 1,
	'type'		=> 'checkbox',
) );

// Visibility
$wp_customize->add_setting( 'athen_headertop_visibility', array(
	'type'		=> 'theme_mod',
	'default'	=> 'always-visible',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'athen_headertop_visibility', array(
	'label'		=> __( 'Visibility', 'athen_transl' ),
	'section'	=> 'athen_headertop_general',
	'settings'	=> 'athen_headertop_visibility',
	'priority'	=> 99,
	'type'		=> 'select',
	'choices'	=> athen_visibility(),
) );

/*-----------------------------------------------------------------------------------*/
/*	- Top Header Logo
/*-----------------------------------------------------------------------------------*/

// Define Logo Section
$wp_customize->add_section( 'athen_headertop_logo_section' , array(
	'title'		=> __( 'Logo', 'athen_transl' ),
	'priority'	=> 2,
	'panel'		=> 'athen_headertop',
) );

// Logo Image
$wp_customize->add_setting( 'athen_headertop_custom_logo', array(
	'type'		=> 'theme_mod',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,  'athen_headertop_custom_logo', array(
	'label'		=> __( 'Image Logo', 'athen_transl' ),
	'section'	=> 'athen_headertop_logo_section',
	'settings'	=> 'athen_headertop_custom_logo',
	'priority'	=> 4,
) ) );

// Desktop Logo max Width
$wp_customize->add_setting( 'athen_headertop_maxwidth_logo', array(
	'type'		=> 'theme_mod',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'athen_headertop_maxwidth_logo', array(
	'label'			=> __( 'Logo Max Width: Desktop', 'athen_transl' ),
	'section'		=> 'athen_headertop_logo_section',
	'settings'		=> 'athen_headertop_maxwidth_logo',
	'priority'		=> 7,
	'type'			=> 'text',
	'description'	=> __( 'Screens 960px wide and greater.', 'athen_transl' ),
) );

// Tablet Portrait Logo max Width
$wp_customize->add_setting( 'athen_headertop_maxwidth_logotablet', array(
	'type'		=> 'theme_mod',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'athen_headertop_maxwidth_logotablet', array(
	'label'			=> __( 'Logo Max Width: Tablet Portrait', 'athen_transl' ),
	'section'		=> 'athen_headertop_logo_section',
	'settings'		=> 'athen_headertop_maxwidth_logotablet',
	'priority'		=> 8,
	'type'			=> 'text',
	'description'	=> __( 'Screens 768px-959px wide.', 'athen_transl' ),
) );

// Phone Portrait Logo max Width
$wp_customize->add_setting( 'athen_headertop_maxwidth_logophone', array(
	'type'		=> 'theme_mod',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'athen_headertop_maxwidth_logophone', array(
	'label'			=> __( 'Logo Max Width: Phone', 'athen_transl' ),
	'section'		=> 'athen_headertop_logo_section',
	'settings'		=> 'athen_headertop_maxwidth_logophone',
	'priority'		=> 9,
	'type'			=> 'text',
	'description'	=> __( 'Screens smaller then 767px wide.', 'athen_transl' ),
) );

// Logo Top Margin
$wp_customize->add_setting( 'athen_headertop_topmargin_logo', array(
	'type'		=> 'theme_mod',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'athen_headertop_topmargin_logo', array(
	'label'			=> __( 'Logo Top Margin', 'athen_transl' ),
	'section'		=> 'athen_headertop_logo_section',
	'settings'		=> 'athen_headertop_topmargin_logo',
	'priority'		=> 10,
	'type'			=> 'text',
	'description'	=> __( 'Will only work with the "Custom Header Height" option is left empty', 'athen_transl' ),
) );

// Logo Bottom Margin
$wp_customize->add_setting( 'athen_headertop_bottommargin_logo', array(
	'type'		=> 'theme_mod',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'athen_headertop_bottommargin_logo', array(
	'label'			=> __( 'Logo Bottom Margin', 'athen_transl' ),
	'section'		=> 'athen_headertop_logo_section',
	'settings'		=> 'athen_headertop_bottommargin_logo',
	'priority'		=> 11,
	'type'			=> 'text',
	'description'	=> __( 'Will only work with the "Custom Header Height" option is left empty', 'athen_transl' ),
) );

// Logo Left Margin
$wp_customize->add_setting( 'athen_headertop_leftmargin_logo', array(
	'type'		=> 'theme_mod',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'athen_headertop_leftmargin_logo', array(
	'label'			=> __( 'Logo Left Margin', 'athen_transl' ),
	'section'		=> 'athen_headertop_logo_section',
	'settings'		=> 'athen_headertop_leftmargin_logo',
	'priority'		=> 11,
	'type'			=> 'text',
	'description'	=> __( 'Will only work with the "Custom Header Height" option is left empty', 'athen_transl' ),
) );

// Logo Left Margin
$wp_customize->add_setting( 'athen_headertop_rightmargin_logo', array(
	'type'		=> 'theme_mod',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'athen_headertop_rightmargin_logo', array(
	'label'			=> __( 'Logo Right Margin', 'athen_transl' ),
	'section'		=> 'athen_headertop_logo_section',
	'settings'		=> 'athen_headertop_rightmargin_logo',
	'priority'		=> 11,
	'type'			=> 'text',
	'description'	=> __( 'Will only work with the "Custom Header Height" option is left empty', 'athen_transl' ),
) );

/*-----------------------------------------------------------------------------------*/
/*	- Aside
/*-----------------------------------------------------------------------------------*/

// Define Section
$wp_customize->add_section( 'athen_headertop_aside_section' , array(
	'title'			=> __( 'Aside Content', 'athen_transl' ),
	'priority'		=> 5,
	'panel'			=> 'athen_headertop',
	'description'	=> __( 'The "aside" content for the header is displayed in various header styles, but not all of them.'),
) );

// Content
$wp_customize->add_setting( 'athen_headertop_aside_content', array(
	'type'		=> 'theme_mod',
	'default'	=> '[font_awesome icon="phone" margin_right="5px"] 1-800-987-654 [font_awesome icon="envelope" margin_right="5px" margin_left="20px" ] admin@total.com [font_awesome icon="user" margin_right="5px" margin_left="20px" ] [wp_login_url text="User Login" logout_text="Logout"]',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'athen_headertop_aside_content', array(
	'label'		=> __( 'Content', 'athen_transl' ),
	'section'	=> 'athen_headertop_aside_section',
	'settings'	=> 'athen_headertop_aside_content',
	'priority'	=> 2,
	'type'		=> 'textarea',
) );