<?php
/**
 * Description : Bunch of wp->customise methods to customise toggle-bar panel
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
$wp_customize->add_section( 'athen_togglebar_general' , array(
	'title'			=> __( 'General', 'athen_transl' ),
	'priority'		=> 1,
	'panel'			=> 'athen_togglebar',
) );

// Enable Toggle bar
$wp_customize->add_setting( 'toggle_bar', array(
	'type'		=> 'theme_mod',
	'default'	=> '',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'toggle_bar', array(
	'label'		=> __( 'Enable', 'athen_transl' ),
	'section'	=> 'athen_togglebar_general',
	'settings'	=> 'toggle_bar',
	'priority'	=> 1,
	'type'		=> 'checkbox',
) );

// Toggle bar content
$wp_customize->add_setting( 'toggle_bar_page', array(
	'type'		=> 'theme_mod',
	'default'	=> '',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'toggle_bar_page', array(
	'label'		=> __( 'Content', 'athen_transl' ),
	'section'	=> 'athen_togglebar_general',
	'settings'	=> 'toggle_bar_page',
	'priority'	=> 2,
	'type'		=> 'dropdown-pages',
) );

// Visibility
$wp_customize->add_setting( 'toggle_bar_visibility', array(
	'type'		=> 'theme_mod',
	'default'	=> 'hidden-phone',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'toggle_bar_visibility', array(
	'label'		=> __( 'Visibility', 'athen_transl' ),
	'section'	=> 'athen_togglebar_general',
	'settings'	=> 'toggle_bar_visibility',
	'priority'	=> 3,
	'type'		=> 'select',
	'choices'	=> athen_visibility(),
) );

// Animation
$wp_customize->add_setting( 'toggle_bar_animation', array(
	'type'		=> 'theme_mod',
	'default'	=> 'fade',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'toggle_bar_animation', array(
	'label'		=> __( 'Toggle Bar Animation', 'athen_transl' ),
	'section'	=> 'athen_togglebar_general',
	'settings'	=> 'toggle_bar_animation',
	'priority'	=> 4,
	'type'		=> 'select',
	'choices'	=> array(
		'fade'			=> __( 'Fade', 'athen_transl' ),
		'fade-slide'	=> __( 'Fade & Slide Down', 'athen_transl' ),
	)
) );