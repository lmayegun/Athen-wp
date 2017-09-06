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

// Get social options
$social_options = athen_topbar_social_options();

// Define Section
$wp_customize->add_section( 'athen_social_general' , array(
	'title'			=> __( 'General', 'athen_transl' ),
	'priority'		=> 7,
	'panel'			=> 'athen_socials',
) );

// Header Placement
$wp_customize->add_setting( 'athen_social_header_placement', array(
	'type'		=> 'theme_mod',
	'default'	=> 'header_top',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'athen_social_header_placement', array(
	'label'			=> __( 'Social Header Placement', 'athen_transl' ),
	'section'		=> 'athen_social_general',
	'settings'		=> 'athen_social_header_placement',
	'priority'		=> 2,
	'type'			=> 'select',
   	'description'	=> __( 'Use this setting to define a fixed header height (Header Style One Only. Use this option ONLY if you want the navigation drop-downs to fall right under the header. Remove the default height (leave this field empty) if you want the header to auto expand depending on your logo height.', 'athen_transl' ),
	'choices'		=> array (
		'header_top'	=> __( 'Top Header', 'athen_transl' ),
		'header_main'	=> __( 'Main Header', 'athen_transl' ),
        'header_bottom'	=> __( 'Bottom Header', 'athen_transl' ),
	),
) );
	
// Link Target
$wp_customize->add_setting( 'athen_social_target', array(
	'type'		=> 'theme_mod',
	'default'	=> 'blank',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'athen_social_target', array(
	'label'			=> __( 'Social Link Target', 'athen_transl' ),
	'section'		=> 'athen_social_general',
	'settings'		=> 'athen_social_target',
	'priority'		=> 3,
	'type'			=> 'select',
	'choices'		=> array (
		'blank'	=> __( 'New Window', 'athen_transl' ),
		'self'	=> __( 'Same Window', 'athen_transl' ),
	),
) );

// Top Social Style
$wp_customize->add_setting( 'athen_social_style', array(
	'type'		=> 'theme_mod',
	'default'	=> 'font_icons',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'athen_social_style', array(
	'label'			=> __( 'Social Style', 'athen_transl' ),
	'section'		=> 'athen_social_general',
	'settings'		=> 'athen_social_style',
	'priority'		=> 3,
	'type'			=> 'select',
	'choices'		=> array (
		'font_icons'	=> __( 'Font Icons', 'athen_transl' ),
		'colored-icons'	=> __( 'Colored Image Icons', 'athen_transl' )
	),
) );
// Social Options
$social_count = '4';
foreach ( $social_options as $key => $val ) {
	$social_count++;
	if ( in_array( $key, array( 'twitter', 'facebook', 'pinterest', 'linkedin', 'instagram', 'googleplus', 'rss' ) ) ) {
		$default = '#';
	} else {
		$default = '';
	}
	$wp_customize->add_setting( 'athen_social_profiles[' . $key .']', array(
		'type'		=> 'theme_mod',
		'default'	=> $default,
		'sanitize_callback' => false,
	) );
	$wp_customize->add_control( 'athen_social_profiles[' . $key .']', array(
		'label'			=> __( $val['label'], 'athen_transl' ),
		'section'		=> 'athen_social_general',
		'settings'		=> 'athen_social_profiles[' . $key .']',
		'priority'		=> $social_count,
		'type'			=> 'text',
	) );
}

// Social Alternative
$wp_customize->add_setting( 'header_social_txt', array(
	'type'		=> 'theme_mod',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'header_social_txt', array(
	'label'			=> __( 'Social Alternative', 'athen_transl' ),
	'section'		=> 'athen_social_general',
	'settings'		=> 'header_social_txt',
	'priority'		=> 99,
	'type'			=> 'textarea',
) );
