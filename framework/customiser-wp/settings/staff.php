<?php
/**
 * Description : Bunch of wp->customise methods to customise staff
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

// Return if post type is disabled
if ( ! ATHEN_CHECK_STAFF ) {
	return;
}

/*-----------------------------------------------------------------------------------*/
/*	- General
/*-----------------------------------------------------------------------------------*/
$wp_customize->add_section( 'athen_staff_general' , array(
	'title'		=> __( 'General', 'athen_transl' ),
	'priority'	=> 1,
	'panel'		=> 'athen_staff',
) );

$wp_customize->add_setting( 'staff_page', array(
	'type'		=> 'theme_mod',
	'default'	=> '',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_page', array(
	'label'			=> __( 'Main Page', 'athen_transl' ),
	'section'		=> 'athen_staff_general',
	'settings'		=> 'staff_page',
	'priority'		=> 2,
	'type'			=> 'dropdown-pages',
	'description'	=> __( 'Used for breadcrumbs.', 'athen_transl' ),
) );

$wp_customize->add_setting( 'staff_custom_sidebar', array(
	'type'		=> 'theme_mod',
	'default'	=> '1',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_custom_sidebar', array(
	'label'			=> __( 'Custom Post Type Sidebar', 'athen_transl' ),
	'section'		=> 'athen_staff_general',
	'settings'		=> 'staff_custom_sidebar',
	'priority'		=> 3,
	'type'			=> 'checkbox',
) );

$wp_customize->add_setting( 'breadcrumbs_staff_cat', array(
	'type'		=> 'theme_mod',
	'default'	=> '1',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'breadcrumbs_staff_cat', array(
	'label'			=> __( 'Display Category In Breadcrumbs', 'athen_transl' ),
	'section'		=> 'athen_staff_general',
	'settings'		=> 'breadcrumbs_staff_cat',
	'priority'		=> 4,
	'type'			=> 'checkbox',
) );

$wp_customize->add_setting( 'staff_search', array(
	'type'		=> 'theme_mod',
	'default'	=> '1',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_search', array(
	'label'			=> __( 'Include In Search', 'athen_transl' ),
	'section'		=> 'athen_staff_general',
	'settings'		=> 'staff_search',
	'priority'		=> 5,
	'type'			=> 'checkbox',
) );

/*-----------------------------------------------------------------------------------*/
/*	- Archives
/*-----------------------------------------------------------------------------------*/
$wp_customize->add_section( 'athen_staff_archives' , array(
	'title'			=> __( 'Archives', 'athen_transl' ),
	'priority'		=> 2,
	'panel'			=> 'athen_staff',
	'description'	=> __( 'The following options are for the post type category and tag archives.', 'athen_transl' ),
) );

$wp_customize->add_setting( 'staff_archive_layout', array(
	'type'		=> 'theme_mod',
	'default'	=> 'full-width',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_archive_layout', array(
	'label'		=> __( 'Layout', 'athen_transl' ),
	'section'	=> 'athen_staff_archives',
	'settings'	=> 'staff_archive_layout',
	'priority'	=> 1,
	'type'		=> 'select',
	'choices'	=> array(
		'right-sidebar'	=> __( 'Right Sidebar','athen_transl' ),
		'left-sidebar'	=> __( 'Left Sidebar','athen_transl' ),
		'full-width'	=> __( 'No Sidebar','athen_transl' ),
	),
) );

$wp_customize->add_setting( 'staff_archive_grid_style', array(
	'type'		=> 'theme_mod',
	'default'	=> 'fit-rows',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_archive_grid_style', array(
	'label'		=> __( 'Grid Style', 'athen_transl' ),
	'section'	=> 'athen_staff_archives',
	'settings'	=> 'staff_archive_grid_style',
	'priority'	=> 2,
	'type'		=> 'select',
	'choices'	=> array(
		'fit-rows'		=> __( 'Fit Rows','athen_transl' ),
		'masonry'		=> __( 'Masonry','athen_transl' ),
		'no-margins'	=> __( 'No Margins','athen_transl' )
	),
) );

$wp_customize->add_setting( 'staff_archive_grid_equal_heights', array(
	'type'		=> 'theme_mod',
	'default'	=> '',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_archive_grid_equal_heights', array(
	'label'		=> __( 'Equal Heights', 'athen_transl' ),
	'section'	=> 'athen_staff_archives',
	'settings'	=> 'staff_archive_grid_equal_heights',
	'priority'	=> 3,
	'description'   => __( 'Displays the content containers (with the title and excerpt) in equal heights. Will NOT work with the "Masonry" layouts.', 'athen_transl' ),
) );

$wp_customize->add_setting( 'staff_entry_columns', array(
	'type'		=> 'theme_mod',
	'default'	=> '3',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_entry_columns', array(
	'label'		=> __( 'Columns', 'athen_transl' ), 
	'section'	=> 'athen_staff_archives',
	'settings'	=> 'staff_entry_columns',
	'priority'	=> 4,
	'type'		=> 'select',
	'choices'	=> athen_grid_columns(),
) );

$wp_customize->add_setting( 'staff_archive_posts_per_page', array(
	'type'		=> 'theme_mod',
	'default'	=> '12',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_archive_posts_per_page', array(
	'label'		=> __( 'Posts Per Page', 'athen_transl' ), 
	'section'	=> 'athen_staff_archives',
	'settings'	=> 'staff_archive_posts_per_page',
	'priority'	=> 5,
	'type'		=> 'text'
) );

$wp_customize->add_setting( 'staff_entry_overlay_style', array(
	'type'		=> 'theme_mod',
	'default'	=> 'none',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_entry_overlay_style', array(
	'label'		=> __( 'Archives Entry: Overlay Style', 'athen_transl' ), 
	'section'	=> 'athen_staff_archives',
	'settings'	=> 'staff_entry_overlay_style',
	'priority'	=> 6,
	'type'		=> 'select',
	'choices'	=> athen_overlay_styles_array()
) );

$wp_customize->add_setting( 'staff_entry_details', array(
	'type'		=> 'theme_mod',
	'default'	=> '1',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_entry_details', array(
	'label'		=> __( 'Archives Entry: Details', 'athen_transl' ), 
	'section'	=> 'athen_staff_archives',
	'settings'	=> 'staff_entry_details',
	'priority'	=> 7,
	'type'		=> 'checkbox',
) );

$wp_customize->add_setting( 'staff_entry_position', array(
	'type'		=> 'theme_mod',
	'default'	=> '1',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_entry_position', array(
	'label'		=> __( 'Archives Entry: Position', 'athen_transl' ), 
	'section'	=> 'athen_staff_archives',
	'settings'	=> 'staff_entry_position',
	'priority'	=> 8,
	'type'		=> 'checkbox',
) );

$wp_customize->add_setting( 'staff_entry_excerpt_length', array(
	'type'		=> 'theme_mod',
	'default'	=> '20',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_entry_excerpt_length', array(
	'label'			=> __( 'Archives Entry: Excerpt Length', 'athen_transl' ), 
	'section'		=> 'athen_staff_archives',
	'settings'		=> 'staff_entry_excerpt_length',	 
	'priority'		=> 9,
	'type'			=> 'text',
	'description'	=> __( 'Enter 0 or leave blank to disable', 'athen_transl' ),
) );

$wp_customize->add_setting( 'staff_entry_social', array(
	'type'		=> 'theme_mod',
	'default'	=> '1',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_entry_social', array(
	'label'		=> __( 'Archives Entry: Social Links', 'athen_transl' ), 
	'section'	=> 'athen_staff_archives',
	'settings'	=> 'staff_entry_social',
	'priority'	=> 10,
	'type'		=> 'checkbox',
) );


/*-----------------------------------------------------------------------------------*/
/*	- Single
/*-----------------------------------------------------------------------------------*/
$wp_customize->add_section( 'athen_staff_single' , array(
	'title'		=> __( 'Single', 'athen_transl' ),
	'priority'	=> 3,
	'panel'		=> 'athen_staff',
) );

$wp_customize->add_setting( 'staff_single_layout', array(
	'type'		=> 'theme_mod',
	'default'	=> 'right-sidebar',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_single_layout', array(
	'label'		=> __( 'Layout', 'athen_transl' ), 
	'section'	=> 'athen_staff_single',
	'settings'	=> 'staff_single_layout',
	'priority'	=> 1,
	'type'		=> 'select',
	'choices'	=> array(
		'right-sidebar'	=> __( 'Right Sidebar','athen_transl' ),
		'left-sidebar'	=> __( 'Left Sidebar','athen_transl' ),
		'full-width'	=> __( 'No Sidebar','athen_transl' ),
	),
) );

$wp_customize->add_setting( 'staff_next_prev', array(
	'type'		=> 'theme_mod',
	'default'	=> '1',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_next_prev', array(
	'label'		=> __( 'Next & Previous Links', 'athen_transl' ),
	'section'	=> 'athen_staff_single',
	'settings'	=> 'staff_next_prev',
	'priority'	=> 3,
	'type'		=> 'checkbox',
) );

$wp_customize->add_setting( 'staff_related_title', array(
	'type'		=> 'theme_mod',
	'default'	=> '',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_related_title', array(
	'label'		=> __( 'Related Posts Title', 'athen_transl' ),
	'section'	=> 'athen_staff_single',
	'settings'	=> 'staff_related_title',
	'priority'	=> 5,
	'type'		=> 'text',
) );

$wp_customize->add_setting( 'staff_related_count', array(
	'type'		=> 'theme_mod',
	'default'	=> '3',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_related_count', array(
	'label'		=> __( 'Related Posts Count', 'athen_transl' ),
	'section'	=> 'athen_staff_single',
	'settings'	=> 'staff_related_count',
	'priority'	=> 6,
	'type'		=> 'text',
) );

$wp_customize->add_setting( 'staff_related_columns', array(
	'type'		=> 'theme_mod',
	'default'	=> '3',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_related_columns', array(
	'label'		=> __( 'Related Posts Columns', 'athen_transl' ), 
	'section'	=> 'athen_staff_single',
	'settings'	=> 'staff_related_columns',
	'priority'	=> 7,
	'type'		=> 'select',
	'choices'	=> athen_grid_columns(),
) );

$wp_customize->add_setting( 'staff_related_excerpts', array(
	'type'		=> 'theme_mod',
	'default'	=> '1',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'staff_related_excerpts', array(
	'label'		=> __( 'Related Posts Content', 'athen_transl' ),
	'section'	=> 'athen_staff_single',
	'settings'	=> 'staff_related_excerpts',
	'priority'	=> 8,
	'type'		=> 'checkbox',
) );

/*-----------------------------------------------------------------------------------*/
/*  - Single Blocks
/*-----------------------------------------------------------------------------------*/
$wp_customize->add_section( 'athen_staff_single_builder' , array(
    'title'     => __( 'Single Builder', 'athen_transl' ),
    'priority'  => 3,
    'panel'     => 'athen_staff',
) );

$blocks = array (
	'title'    => __( 'Post Title', 'athen_transl' ),
    'media'    => __( 'Media', 'athen_transl' ),
    'content'  => __( 'Content', 'athen_transl' ),
    'share'    => __( 'Social Share', 'athen_transl' ),
    'comments' => __( 'Comments', 'athen_transl' ),
    'related'  => __( 'Related Posts', 'athen_transl' ),
);
$blocks = apply_filters( 'athen_staff_single_blocks', $blocks );

$wp_customize->add_setting( 'staff_post_composer', array(
    'type'              => 'theme_mod',
    'default'           => 'content,related',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( new WPEX_Customize_Control_Sorter( $wp_customize, 'staff_post_composer', array(
    'label'   => __( 'Post Layout Elements', 'athen_transl' ),
    'type'    => 'wpex-sortable',
    'section' => 'athen_staff_single_builder',
    'choices' => $blocks,
    'desc'    => __( 'Click and drag and drop elements to re-order them. Click the "x" to disable any element. You can not disable all elements, if you do so it will display them all', 'athen_transl' ),
) ) );

/*-----------------------------------------------------------------------------------*/
/*	- Extras - These options hook into other sections
/*-----------------------------------------------------------------------------------*/

// Social Sharing
$wp_customize->add_setting( 'social_share_staff', array(
	'type'		=> 'theme_mod',
	'default'	=> false,
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'social_share_staff', array(
	'label'		=>  __( 'Staff: Social Share', 'athen_transl' ),
	'section'	=> 'athen_social_sharing',
	'settings'	=> 'social_share_staff',
	'priority'	=> 9,
	'type'		=> 'checkbox',
) );