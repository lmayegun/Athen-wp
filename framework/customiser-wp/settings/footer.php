<?php
/**
 * Description : Bunch of wp->customise methods to customise woocommerce panel
 * 
 * @package     Athen
 * @subpackage  Closer - Controller/Model
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*-----------------------------------------------------------------------------------*/
/*	- General
/*-----------------------------------------------------------------------------------*/
$wp_customize->add_section( 'athen_footer_general' , array(
	'title'		=> __( 'General', 'athen_transl' ),
	'priority'	=> 1,
	'panel'		=> 'athen_footer',
) );

$wp_customize->add_setting( 'footer_reveal', array(
	'type'		=> 'theme_mod',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'footer_reveal', array(
	'label'			=> __( 'Footer Reveal', 'athen_transl' ),
	'section'		=> 'athen_footer_general',
	'settings'		=> 'footer_reveal',
	'priority'		=> 1,
	'type'			=> 'checkbox',
	'description'	=> __( 'Enable the footer reveal style. The footer will be placed in a fixed postion and display on scroll. This setting is for the "Full-Width" layout only and desktops only.', 'athen_transl' ),
) );

$wp_customize->add_setting( 'footer_widgets', array(
	'type'		=> 'theme_mod',
	'default'	=> '1',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'footer_widgets', array(
	'label'		=> __( 'Footer Widgets', 'athen_transl' ),
	'section'	=> 'athen_footer_general',
	'settings'	=> 'footer_widgets',
	'priority'	=> 2,
	'type'		=> 'checkbox',
) );

$wp_customize->add_setting( 'footer_headings', array(
	'type'		=> 'theme_mod',
	'default'	=> 'div',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'footer_headings', array(
	'label'		=> __( 'Footer Widget Title Headings', 'athen_transl' ),
	'section'	=> 'athen_footer_general',
	'settings'	=> 'footer_headings',
	'priority'	=> 3,
	'type'		=> 'select',
	'choices'	=> array(
		'h2'	=> 'h2',
		'h3'	=> 'h3',
		'h4'	=> 'h4',
		'h5'	=> 'h5',
		'h6'	=> 'h6',
		'span'	=> 'span',
		'div'	=> 'div',
	),
) );

$wp_customize->add_setting( 'footer_widgets_columns', array(
	'type'		=> 'theme_mod',
	'default'	=> '4',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'footer_widgets_columns', array(
	'label'		=> __( 'Footer Widgets', 'athen_transl' ),
	'section'	=> 'athen_footer_general',
	'settings'	=> 'footer_widgets_columns',
	'priority'	=> 4,
	'type'		=> 'select',
	'choices'	=> array(
		'5'	=> '5',
		'4'	=> '4',
		'3'	=> '3',
		'2'	=> '2',
		'1'	=> '1',
	),
) );

$wp_customize->add_setting( 'footer_widgets_gap', array(
	'type'		=> 'theme_mod',
	'default'	=> '1',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'footer_widgets_gap', array(
	'label'		=> __( 'Footer Widgets Gap', 'athen_transl' ),
	'section'	=> 'athen_footer_general',
	'settings'	=> 'footer_widgets_gap',
	'priority'	=> 5,
	'type'		=> 'select',
	'choices'	=> athen_column_gaps(),
) );

$wp_customize->add_setting( 'footer_bottom', array(
	'type'		=> 'theme_mod',
	'default'	=> '1',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'footer_bottom', array(
	'label'		=> __( 'Bottom Footer Area', 'athen_transl' ),
	'section'	=> 'athen_footer_general',
	'settings'	=> 'footer_bottom',
	'priority'	=> 6,
	'type'		=> 'checkbox',
) );

$wp_customize->add_setting( 'footer_copyright_text', array(
	'type'		=> 'theme_mod',
	'default'	=> 'Copyright <a href="#">Your Business LLC.</a> - All Rights Reserved',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'footer_copyright_text', array(
	'label'		=> __( 'Copyright', 'athen_transl' ),
	'section'	=> 'athen_footer_general',
	'settings'	=> 'footer_copyright_text',
	'priority'	=> 7,
	'type'		=> 'textarea',
) );

$wp_customize->add_setting( 'scroll_top', array(
	'type'		=> 'theme_mod',
	'default'	=> '1',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'scroll_top', array(
	'label'		=> __( 'Scroll Up Button', 'athen_transl' ),
	'section'	=> 'athen_footer_general',
	'settings'	=> 'scroll_top',
	'priority'	=> 8,
	'type'		=> 'checkbox',
) );