<?php
/**
 * Description : Bunch of wp->customise methods to customise portfolio panel
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

// Return if portfolio is disabled
if ( ! ATHEN_CHECK_PORTFOLIO ) {
    return;
}

/*-----------------------------------------------------------------------------------*/
/*  - General
/*-----------------------------------------------------------------------------------*/
$wp_customize->add_section( 'athen_portfolio_general' , array(
    'title'     => __( 'General', 'athen_transl' ),
    'priority'  => 1,
    'panel'     => 'athen_portfolio',
) );

$wp_customize->add_setting( 'portfolio_page', array(
    'type'      => 'theme_mod',
    'default'   => '',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'portfolio_page', array(
    'label'         => __( 'Main Page', 'athen_transl' ),
    'section'       => 'athen_portfolio_general',
    'settings'      => 'portfolio_page',
    'priority'      => 2,
    'type'          => 'dropdown-pages',
    'description'   => __( 'Used for breadcrumbs.', 'athen_transl' ),
) );

$wp_customize->add_setting( 'portfolio_custom_sidebar', array(
    'type'      => 'theme_mod',
    'default'   => '1',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'portfolio_custom_sidebar', array(
    'label'         => __( 'Custom Post Type Sidebar', 'athen_transl' ),
    'section'       => 'athen_portfolio_general',
    'settings'      => 'portfolio_custom_sidebar',
    'priority'      => 3,
    'type'          => 'checkbox',
) );

$wp_customize->add_setting( 'breadcrumbs_portfolio_cat', array(
    'type'      => 'theme_mod',
    'default'   => '1',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'breadcrumbs_portfolio_cat', array(
    'label'         => __( 'Display Category In Breadcrumbs', 'athen_transl' ),
    'section'       => 'athen_portfolio_general',
    'settings'      => 'breadcrumbs_portfolio_cat',
    'priority'      => 4,
    'type'          => 'checkbox',
) );

$wp_customize->add_setting( 'portfolio_search', array(
    'type'      => 'theme_mod',
    'default'   => '1',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'portfolio_search', array(
    'label'         => __( 'Include In Search', 'athen_transl' ),
    'section'       => 'athen_portfolio_general',
    'settings'      => 'portfolio_search',
    'priority'      => 5,
    'type'          => 'checkbox',
) );

$wp_customize->add_setting( 'portfolio_entry_excerpt_length', array(
    'type'      => 'theme_mod',
    'default'   => '20',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'portfolio_entry_excerpt_length', array(
    'label'     => __( 'Archives Entry: Excerpt Length', 'athen_transl' ), 
    'section'   => 'athen_portfolio_general',
    'settings'  => 'portfolio_entry_excerpt_length',
    'priority'  => 6,
    'type'      => 'text',
) );

/*-----------------------------------------------------------------------------------*/
/*  - Archives
/*-----------------------------------------------------------------------------------*/
$wp_customize->add_section( 'athen_portfolio_archives' , array(
    'title'         => __( 'Archives & Entries', 'athen_transl' ),
    'priority'      => 2,
    'panel'         => 'athen_portfolio',
    'description'   => __( 'The following options are for the post type category and tag archives.', 'athen_transl' ),
) );

$wp_customize->add_setting( 'portfolio_archive_layout', array(
    'type'      => 'theme_mod',
    'default'   => 'full-width',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'portfolio_archive_layout', array(
    'label'     => __( 'Layout', 'athen_transl' ),
    'section'   => 'athen_portfolio_archives',
    'settings'  => 'portfolio_archive_layout',
    'priority'  => 1,
    'type'      => 'select',
    'choices'   => array(
        'right-sidebar' => __( 'Right Sidebar','athen_transl' ),
        'left-sidebar'  => __( 'Left Sidebar','athen_transl' ),
        'full-width'    => __( 'No Sidebar','athen_transl' ),
    ),
) );

$wp_customize->add_setting( 'portfolio_archive_grid_style', array(
    'type'      => 'theme_mod',
    'default'   => 'fit-rows',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'portfolio_archive_grid_style', array(
    'label'     => __( 'Grid Style', 'athen_transl' ),
    'section'   => 'athen_portfolio_archives',
    'settings'  => 'portfolio_archive_grid_style',
    'priority'  => 2,
    'type'      => 'select',
    'choices'   => array(
        'fit-rows'      => __( 'Fit Rows','athen_transl' ),
        'masonry'       => __( 'Masonry','athen_transl' ),
        'no-margins'    => __( 'No Margins','athen_transl' )
    ),
) );

$wp_customize->add_setting( 'portfolio_archive_grid_equal_heights', array(
    'type'      => 'theme_mod',
    'default'   => '',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'portfolio_archive_grid_equal_heights', array(
    'label'         => __( 'Equal Heights', 'athen_transl' ),
    'section'       => 'athen_portfolio_archives',
    'settings'      => 'portfolio_archive_grid_equal_heights',
    'priority'      => 3,
    'type'          => 'checkbox',
    'description'   => __( 'Displays the content containers (with the title and excerpt) in equal heights. Will NOT work with the "Masonry" layouts.', 'athen_transl' ),
) );

$wp_customize->add_setting( 'portfolio_entry_columns', array(
    'type'      => 'theme_mod',
    'default'   => '4',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'portfolio_entry_columns', array(
    'label'     => __( 'Columns', 'athen_transl' ), 
    'section'   => 'athen_portfolio_archives',
    'settings'  => 'portfolio_entry_columns',
    'priority'  => 4,
    'type'      => 'select',
    'choices'   => athen_grid_columns(),
) );

$wp_customize->add_setting( 'portfolio_archive_posts_per_page', array(
    'type'      => 'theme_mod',
    'default'   => '12',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'portfolio_archive_posts_per_page', array(
    'label'     => __( 'Posts Per Page', 'athen_transl' ), 
    'section'   => 'athen_portfolio_archives',
    'settings'  => 'portfolio_archive_posts_per_page',
    'priority'  => 5,
    'type'      => 'text'
) );

$wp_customize->add_setting( 'portfolio_entry_overlay_style', array(
    'type'      => 'theme_mod',
    'default'   => 'none',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'portfolio_entry_overlay_style', array(
    'label'     => __( 'Archives Entry: Overlay Style', 'athen_transl' ), 
    'section'   => 'athen_portfolio_archives',
    'settings'  => 'portfolio_entry_overlay_style',
    'priority'  => 6,
    'type'      => 'select',
    'choices'   => athen_overlay_styles_array()
) );

$wp_customize->add_setting( 'portfolio_entry_details', array(
    'type'      => 'theme_mod',
    'default'   => '1',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'portfolio_entry_details', array(
    'label'     => __( 'Archives Entry: Details', 'athen_transl' ), 
    'section'   => 'athen_portfolio_archives',
    'settings'  => 'portfolio_entry_details',
    'priority'  => 7,
    'type'      => 'checkbox',
) );

$wp_customize->add_setting( 'portfolio_entry_details', array(
    'type'      => 'theme_mod',
    'default'   => '1',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'portfolio_entry_details', array(
    'label'     => __( 'Archives Entry: Details', 'athen_transl' ), 
    'section'   => 'athen_portfolio_archives',
    'settings'  => 'portfolio_entry_details',
    'priority'  => 7,
    'type'      => 'checkbox',
) );

$wp_customize->add_setting( 'portfolio_entry_excerpt_length', array(
    'type'      => 'theme_mod',
    'default'   => '20',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'portfolio_entry_excerpt_length', array(
    'label'     => __( 'Archives Entry: Excerpt Length', 'athen_transl' ), 
    'section'   => 'athen_portfolio_archives',
    'settings'  => 'portfolio_entry_excerpt_length',
    'priority'  => 8,
    'type'      => 'text',
) );


/*-----------------------------------------------------------------------------------*/
/*  - Single
/*-----------------------------------------------------------------------------------*/
$wp_customize->add_section( 'athen_portfolio_single' , array(
    'title'     => __( 'Single', 'athen_transl' ),
    'priority'  => 3,
    'panel'     => 'athen_portfolio',
) );

$wp_customize->add_setting( 'portfolio_single_layout', array(
    'type'      => 'theme_mod',
    'default'   => 'full-width',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'portfolio_single_layout', array(
    'label'     => __( 'Layout', 'athen_transl' ), 
    'section'   => 'athen_portfolio_single',
    'settings'  => 'portfolio_single_layout',
    'priority'  => 1,
    'type'      => 'select',
    'choices'   => array(
        'right-sidebar' => __( 'Right Sidebar','athen_transl' ),
        'left-sidebar'  => __( 'Left Sidebar','athen_transl' ),
        'full-width'    => __( 'No Sidebar','athen_transl' ),
    ),
) );

$wp_customize->add_setting( 'portfolio_next_prev', array(
    'type'      => 'theme_mod',
    'default'   => '1',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'portfolio_next_prev', array(
    'label'     => __( 'Next & Previous Links', 'athen_transl' ),
    'section'   => 'athen_portfolio_single',
    'settings'  => 'portfolio_next_prev',
    'priority'  => 3,
    'type'      => 'checkbox',
) );

$wp_customize->add_setting( 'portfolio_related_title', array(
    'type'      => 'theme_mod',
    'default'   => __( 'Related Projects', 'athen_transl' ),
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'portfolio_related_title', array(
    'label'     => __( 'Related Posts Title', 'athen_transl' ),
    'section'   => 'athen_portfolio_single',
    'settings'  => 'portfolio_related_title',
    'priority'  => 5,
    'type'      => 'text',
) );

$wp_customize->add_setting( 'portfolio_related_count', array(
    'type'      => 'theme_mod',
    'default'   => 4,
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'portfolio_related_count', array(
    'label'     => __( 'Related Posts Count', 'athen_transl' ),
    'section'   => 'athen_portfolio_single',
    'settings'  => 'portfolio_related_count',
    'priority'  => 6,
    'type'      => 'number',
) );

$wp_customize->add_setting( 'portfolio_related_columns', array(
    'type'      => 'theme_mod',
    'default'   => '4',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'portfolio_related_columns', array(
    'label'     => __( 'Related Posts Columns', 'athen_transl' ), 
    'section'   => 'athen_portfolio_single',
    'settings'  => 'portfolio_related_columns',
    'priority'  => 7,
    'type'      => 'select',
    'choices'   => athen_grid_columns(),
) );

$wp_customize->add_setting( 'portfolio_related_excerpts', array(
    'type'      => 'theme_mod',
    'default'   => '1',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'portfolio_related_excerpts', array(
    'label'     => __( 'Related Posts Content', 'athen_transl' ),
    'section'   => 'athen_portfolio_single',
    'settings'  => 'portfolio_related_excerpts',
    'priority'  => 8,
    'type'      => 'checkbox',
) );

/*-----------------------------------------------------------------------------------*/
/*  - Single Blocks
/*-----------------------------------------------------------------------------------*/
$wp_customize->add_section( 'athen_portfolio_single_builder' , array(
    'title'     => __( 'Single Builder', 'athen_transl' ),
    'priority'  => 3,
    'panel'     => 'athen_portfolio',
) );

$blocks = array (
    'title'    => __( 'Post Title', 'athen_transl' ),
    'media'    => __( 'Media', 'athen_transl' ),
    'content'  => __( 'Content', 'athen_transl' ),
    'share'    => __( 'Social Share', 'athen_transl' ),
    'comments' => __( 'Comments', 'athen_transl' ),
    'related'  => __( 'Related Posts', 'athen_transl' ),
);
$blocks = apply_filters( 'athen_portfolio_single_blocks', $blocks );

$wp_customize->add_setting( 'portfolio_post_composer', array(
    'type'              => 'theme_mod',
    'default'           => 'content,share,related',
    'sanitize_callback' => false,
) );
$wp_customize->add_control( new WPEX_Customize_Control_Sorter( $wp_customize, 'portfolio_post_composer', array(
    'label'   => __( 'Post Layout Elements', 'athen_transl' ),
    'type'    => 'wpex-sortable',
    'section' => 'athen_portfolio_single_builder',
    'choices' => $blocks,
    'desc'    => __( 'Click and drag and drop elements to re-order them. Click the "x" to disable any element. You can not disable all elements, if you do so it will display them all', 'athen_transl' ),
) ) );

/*-----------------------------------------------------------------------------------*/
/*  - Extras - These options hook into other sections
/*-----------------------------------------------------------------------------------*/

// Social Sharing
$wp_customize->add_setting( 'social_share_portfolio', array(
    'type'      => 'theme_mod',
    'default'   => false,
    'sanitize_callback' => false,
) );
$wp_customize->add_control( 'social_share_portfolio', array(
    'label'     =>  __( 'Portfolio: Social Share', 'athen_transl' ),
    'section'   => 'athen_social_sharing',
    'settings'  => 'social_share_portfolio',
    'priority'  => 8,
    'type'      => 'checkbox',
) );