<?php
/**
 * Description : Bunch of wp->customise methods to customise testimonial
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

// Return if testimonials post type isn't enabled
if ( ! ATHEN_CHECK_TESTIMONIALS ) {
	return;
}

/*-----------------------------------------------------------------------------------*/
/*	- General
/*-----------------------------------------------------------------------------------*/
$wp_customize->add_section( 'athen_testimonials_general' , array(
	'title'		=> __( 'General', 'athen_transl' ),
	'priority'	=> 1,
	'panel'		=> 'athen_testimonials',
) );

$wp_customize->add_setting( 'testimonials_page', array(
	'type'				=> 'theme_mod',
	'default'			=> '',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'testimonials_page', array(
	'label'			=> __( 'Testimonials Page', 'athen_transl' ),
	'section'		=> 'athen_testimonials_general',
	'settings'		=> 'testimonials_page',
	'priority'		=> 2,
	'type'			=> 'dropdown-pages',
	'description'	=> __( 'Used for breadcrumbs.', 'athen_transl' ),
) );

$wp_customize->add_setting( 'testimonials_custom_sidebar', array(
	'type'		=> 'theme_mod',
	'default'	=> 'on',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'testimonials_custom_sidebar', array(
	'label'			=> __( 'Custom Post Type Sidebar', 'athen_transl' ),
	'section'		=> 'athen_testimonials_general',
	'settings'		=> 'testimonials_custom_sidebar',
	'priority'		=> 3,
	'type'			=> 'checkbox',
) );

$wp_customize->add_setting( 'breadcrumbs_testimonials_cat', array(
	'type'		=> 'theme_mod',
	'default'	=> '1',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'breadcrumbs_testimonials_cat', array(
	'label'			=> __( 'Display Category In Breadcrumbs', 'athen_transl' ),
	'section'		=> 'athen_testimonials_general',
	'settings'		=> 'breadcrumbs_testimonials_cat',
	'priority'		=> 4,
	'type'			=> 'checkbox',
) );

$wp_customize->add_setting( 'testimonials_search', array(
	'type'		=> 'theme_mod',
	'default'	=> '1',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'testimonials_search', array(
	'label'			=> __( 'Include In Search', 'athen_transl' ),
	'section'		=> 'athen_testimonials_general',
	'settings'		=> 'testimonials_search',
	'priority'		=> 5,
	'type'			=> 'checkbox',
) );

/*-----------------------------------------------------------------------------------*/
/*	- Archives
/*-----------------------------------------------------------------------------------*/
$wp_customize->add_section( 'athen_testimonials_archives' , array(
	'title'		=> __( 'Archives', 'athen_transl' ),
	'priority'	=> 2,
	'panel'		=> 'athen_testimonials',
) );

$wp_customize->add_setting( 'testimonials_archive_layout', array(
	'type'		=> 'theme_mod',
	'default'	=> 'full-width',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'testimonials_archive_layout', array(
	'label'		=> __( 'Layout', 'athen_transl' ),
	'section'	=> 'athen_testimonials_archives',
	'settings'	=> 'testimonials_archive_layout',
	'priority'	=> 1,
	'type'		=> 'select',
	'choices'	=> array(
		'right-sidebar'	=> __( 'Right Sidebar','athen_transl' ),
		'left-sidebar'	=> __( 'Left Sidebar','athen_transl' ),
		'full-width'	=> __( 'No Sidebar','athen_transl' ),
	),
) );

$wp_customize->add_setting( 'testimonials_entry_columns', array(
	'type'		=> 'theme_mod',
	'default'	=> '4',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'testimonials_entry_columns', array(
	'label'		=> __( 'Columns', 'athen_transl' ), 
	'section'	=> 'athen_testimonials_archives',
	'settings'	=> 'testimonials_entry_columns',
	'priority'	=> 4,
	'type'		=> 'select',
	'choices'	=> athen_grid_columns(),
) );

$wp_customize->add_setting( 'testimonials_archive_posts_per_page', array(
	'type'		=> 'theme_mod',
	'default'	=> '12',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'testimonials_archive_posts_per_page', array(
	'label'		=> __( 'Posts Per Page', 'athen_transl' ), 
	'section'	=> 'athen_testimonials_archives',
	'settings'	=> 'testimonials_archive_posts_per_page',
	'priority'	=> 5,
	'type'		=> 'text'
) );


/*-----------------------------------------------------------------------------------*/
/*	- Single
/*-----------------------------------------------------------------------------------*/
$wp_customize->add_section( 'athen_testimonials_single' , array(
	'title'		=> __( 'Single', 'athen_transl' ),
	'priority'	=> 3,
	'panel'		=> 'athen_testimonials',
) );

$wp_customize->add_setting( 'testimonial_post_style', array(
	'type'		=> 'theme_mod',
	'default'	=> 'blockquote',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'testimonial_post_style', array(
	'label'		=> __( 'Post Style', 'athen_transl' ), 
	'section'	=> 'athen_testimonials_single',
	'settings'	=> 'testimonial_post_style',
	'priority'	=> 1,
	'type'		=> 'select',
	'choices'	=> array(
		'blockquote'	=> __( 'Blockquote', 'athen_transl' ),
		'standard'		=> __( 'Standard', 'athen_transl' ),
	),
) );

$wp_customize->add_setting( 'testimonials_single_layout', array(
	'type'		=> 'theme_mod',
	'default'	=> 'full-width',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'testimonials_single_layout', array(
	'label'		=> __( 'Layout', 'athen_transl' ), 
	'section'	=> 'athen_testimonials_single',
	'settings'	=> 'testimonials_single_layout',
	'priority'	=> 1,
	'type'		=> 'select',
	'choices'	=> array(
		'right-sidebar'	=> __( 'Right Sidebar','athen_transl' ),
		'left-sidebar'	=> __( 'Left Sidebar','athen_transl' ),
		'full-width'	=> __( 'No Sidebar','athen_transl' ),
	),
) );

$wp_customize->add_setting( 'testimonials_comments', array(
	'type'		=> 'theme_mod',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'testimonials_comments', array(
	'label'		=> __( 'Comments', 'athen_transl' ), 
	'section'	=> 'athen_testimonials_single',
	'settings'	=> 'testimonials_comments',
	'priority'	=> 2,
	'type'		=> 'checkbox',
) );

$wp_customize->add_setting( 'testimonials_next_prev', array(
	'type'		=> 'theme_mod',
	'default'	=> '1',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'testimonials_next_prev', array(
	'label'		=> __( 'Next & Previous Links', 'athen_transl' ),
	'section'	=> 'athen_testimonials_single',
	'settings'	=> 'testimonials_next_prev',
	'priority'	=> 3,
	'type'		=> 'checkbox',
) );