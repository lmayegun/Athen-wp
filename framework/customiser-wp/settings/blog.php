<?php
/**
 * Description : Bunch of array use modify customizer controller + model.
 *             : Blog panel, section, setting & control.
 * 
 * @package     Athen
 * @subpackage  Closer - View/Model
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 * Dependent : customizer/customizer.php (Athen_Customizer class)
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*-----------------------------------------------------------------------------------*/
/*  - Useful vars
/*-----------------------------------------------------------------------------------*/
$entry_meta_defaults    = array( 'date', 'author', 'categories', 'comments' );
$entry_meta_choices     = array(
	'date'          => __( 'Date', 'athen_transl' ),
	'author'        => __( 'Author', 'athen_transl' ),
	'categories'    => __( 'Categories', 'athen_transl' ),
	'comments'      => __( 'Comments', 'athen_transl' ),
);

/*-----------------------------------------------------------------------------------*/
/*  - General
/*-----------------------------------------------------------------------------------*/
$this->sections['athen_blog_general'] = array(
	'title'     => __( 'General', 'athen_transl' ),
	'panel'     => 'athen_blog',
	'settings'  => array(
		array(
			'id'        => 'blog_page',
			'control'   => array (
				'label' => __( 'Main Page', 'athen_transl' ),
				'type'  => 'dropdown-pages',
			),
		),
		array(
			'id'        => 'blog_cats_exclude',
			'control'   => array (
				'label' => __( 'Exclude Categories From Blog', 'athen_transl' ),
				'type'  => 'text',
				'desc'  => __( 'Enter the ID\'s of categories to exclude from the blog template or homepage blog seperated by a comma (no spaces).' ),
			),
		),
	),
);

/*-----------------------------------------------------------------------------------*/
/*  - Archives
/*-----------------------------------------------------------------------------------*/
$this->sections['athen_blog_archives'] = array(
	'title'     => __( 'Archives & Entries', 'athen_transl' ),
	'panel'     => 'athen_blog',
	'settings'  => array(
		array(
			'id'            => 'blog_archives_layout',
			'default'       => 'right-sidebar',
			'control'       => array (
				'label'     => __( 'Layout', 'athen_transl' ),
				'type'      => 'select',
				'choices'   => array(
					'right-sidebar' => __( 'Right Sidebar','athen_transl' ),
					'left-sidebar'  => __( 'Left Sidebar','athen_transl' ),
					'full-width'    => __( 'No Sidebar','athen_transl' ),
				),
			),
		),
		array(
			'id'            => 'blog_style',
			'default'       => 'large-image-entry-style',
			'control'       => array (
				'label'     => __( 'Style', 'athen_transl' ),
				'type'      => 'select',
				'choices'   => array(
					'large-image-entry-style'   => __( 'Large Image','athen_transl' ),
					'thumbnail-entry-style'     => __( 'Left Thumbnail','athen_transl' ),
					'grid-entry-style'          => __( 'Grid','athen_transl' ),
				),
			),
		),
		array(
			'id'            => 'blog_grid_columns',
			'default'       => '3',
			'control'       => array (
				'label'     => __( 'Grid Columns', 'athen_transl' ),
				'type'      => 'select',
				'choices'   => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				),
			),
		),
		array(
			'id'            => 'blog_grid_style',
			'default'       => 'fit-rows',
			'control'       => array (
				'label'     => __( 'Grid Style', 'athen_transl' ),
				'type'      => 'select',
				'choices'   => array(
					'fit-rows'  => __( 'Fit Rows', 'athen_transl' ),
					'masonry'   => __( 'Masonry', 'athen_transl' ),
				),
			),
		),
		array(
			'id'            => 'blog_archive_grid_equal_heights',
			'control'       => array (
				'label'     => __( 'Equal Heights', 'athen_transl' ),
				'type'      => 'checkbox',
				'desc'      => __( 'Displays the content containers (with the title and excerpt) in equal heights. Will NOT work with the "Masonry" layouts.', 'athen_transl' ),
			),
		),
		array(
			'id'            => 'blog_pagination_style',
			'default'       => 'standard',
			'control'       => array (
				'label'     => __( 'Pagination Style', 'athen_transl' ),
				'type'      => 'select',
				'choices'   => array(
					'standard'          => __( 'Standard', 'athen_transl' ),
					'infinite_scroll'   => __( 'Infinite Scroll', 'athen_transl' ),
					'next_prev'         => __( 'Next/Prev', 'athen_transl' )
				),
			),
		),
		array(
			'id'        => 'category_descriptions',
			'default'   => 'on',
			'control'   => array (
				'label' => __( 'Category Descriptions', 'athen_transl' ),
				'type'  => 'checkbox',
			),
		),
		array(
			'id'        => 'category_description_position',
			'default'   => 'under_title',
			'control'   => array (
				'label' => __( 'Category Description Position', 'athen_transl' ),
				'type'      => 'select',
				'choices'   => array(
					'under_title'   => __( 'Under Title', 'athen_transl' ),
					'above_loop'    => __( 'Above Loop', 'athen_transl' ),
				),
			),
		),
		array(
			'id'        => 'blog_entry_image_lightbox',
			'control'   => array (
				'label' => __( 'Image Lightbox', 'athen_transl' ),
				'type'  => 'checkbox',
			),
		),
		array(
			'id'            => 'blog_entry_image_hover_animation',
			'control'       => array (
				'label'     => __( 'Image Hover Animation', 'athen_transl' ),
				'type'      => 'select',
				'choices'   => athen_image_hovers(),
			),
		),
		array(
			'id'        => 'blog_exceprt',
			'default'   => 'on',
			'control'   => array (
				'label' => __( 'Auto Excerpts', 'athen_transl' ),
				'type'  => 'checkbox',
			),
		),
		array(
			'id'        => 'blog_excerpt_length',
			'default'   => '40',
			'control'   => array (
				'label' => __( 'Excerpt length', 'athen_transl' ),
				'type'  => 'text',
			),
		),
		array(
			'id'        => 'blog_entry_readmore_text',
			'default'   => __( 'Read More', 'athen_transl' ),
			'control'   => array (
				'label' => __( 'Read More Button Text', 'athen_transl' ),
				'type'  => 'text',
			),
		),
		array(
			'id'        => 'blog_entry_author_avatar',
			'control'   => array (
				'label' => __( 'Author Avatar', 'athen_transl' ),
				'type'  => 'checkbox',
			),
		),
		array(
			'id'        => 'blog_entry_meta',
			'default'   => 'on',
			'control'   => array (
				'label' => __( 'Meta', 'athen_transl' ),
				'type'  => 'checkbox',
			),
		),
		array(
			'id'            => 'blog_entry_meta_sections',
			'default'       => $entry_meta_defaults,
			'control'       => array (
				'label'     => __( 'Entry Meta', 'athen_transl' ),
				'type'      => 'multiple-select',
				'object'    => 'WPEX_Customize_Multicheck_Control',
				'choices'   => $entry_meta_choices
			),
		),
	),
);

/*-----------------------------------------------------------------------------------*/
/*  - Entry Order
/*-----------------------------------------------------------------------------------*/
$blocks = array (
	'featured_media'    => __( 'Media', 'athen_transl' ),
	'post_title'        => __( 'Post Title', 'athen_transl' ),
	'post_meta' 		=> __( 'Post Meta', 'athen_transl'),
	'excerpt_content'   => __( 'Excerpt', 'athen_transl' ),
	'readmore'          => __( 'Read More', 'athen_transl' ),
    'social_share'      => __( 'Social Share', 'athen_transl'),
    'category_terms'    => __( 'Category Terms', 'athen_transl'),
    'tag_terms'         => __( 'Tag Terms', 'athen_transl'),
);
$blocks = apply_filters( 'athen_blog_entry_blocks', $blocks );
$this->sections['athen_blog_entry_composer'] = array(
	'title'     => __( 'Entry Builder', 'athen_transl' ),
	'panel'     => 'athen_blog',
	'settings'  => array(
		array(
			'id'            => 'blog_entry_composer',
			'default'       => 'featured_media,post_title,post_meta,title_meta,excerpt_content,social_share,category_terms,tag_terms,readmore',
			'control'       => array (
				'label'     => __( 'Entry Layout Elements', 'athen_transl' ),
				'type'      => 'wpex-sortable',
				'object'    => 'WPEX_Customize_Control_Sorter',
				'choices'   => $blocks,
				'desc'  => __( 'Click and drag and drop elements to re-order them. Click the "x" to disable any element. You can not disable all elements, if you do so it will display them all', 'athen_transl' ),
			),
		),
	),
);

/*-----------------------------------------------------------------------------------*/
/*  - Single
/*-----------------------------------------------------------------------------------*/
$this->sections['athen_blog_single'] = array(
	'title'     => __( 'Single', 'athen_transl' ),
	'panel'     => 'athen_blog',
	'settings'  => array(
		array(
			'id'        => 'blog_single_layout',
			'default'   => 'right-sidebar',
			'control'   => array (
				'label'     => __( 'Layout', 'athen_transl' ),
				'type'      => 'select',
				'choices'   => array(
					'right-sidebar' => __( 'Right Sidebar','athen_transl' ),
					'left-sidebar'  => __( 'Left Sidebar','athen_transl' ),
					'full-width'    => __( 'No Sidebar','athen_transl' ),
				),
			),
		),
		array(
			'id'        => 'blog_single_header',
			'default'   => 'custom_text',
			'control'   => array (
				'label'     => __( 'Header Displays', 'athen_transl' ),
				'type'      => 'select',
				'choices'   => array(
					'custom_text'   => __( 'Custom Text','athen_transl' ),
					'post_title'    => __( 'Post Title','athen_transl' ),
				),
			),
		),
		array(
			'id'        => 'blog_single_header_custom_text',
			'default'   => __( 'Blog', 'athen_transl' ),
			'control'   => array (
				'label' => __( 'Header Custom Text', 'athen_transl' ),
				'type'  => 'text',
			),
		),
		array(
			'id'        => 'blog_post_image_lightbox',
			'control'   => array (
				'label' => __( 'Featured Image Lightbox', 'athen_transl' ),
				'type'  => 'checkbox',
			),
		),
		array(
			'id'        => 'blog_thumbnail_caption',
			'control'   => array (
				'label' => __( 'Featured Image Caption', 'athen_transl' ),
				'type'  => 'checkbox',
			),
		),
		array(
			'id'        => 'breadcrumbs_blog_cat',
			'default'   => 'on',
			'control'   => array (
				'label' => __( 'Category In Breadcrumbs', 'athen_transl' ),
				'type'  => 'checkbox',
			),
		),
		array(
			'id'        => 'blog_post_meta',
			'default'   => 'on',
			'control'   => array (
				'label' => __( 'Meta', 'athen_transl' ),
				'type'  => 'checkbox',
			),
		),
		array(
			'id'            => 'blog_post_meta_sections',
			'default'       => $entry_meta_defaults,
			'control'       => array (
				'label'     => __( 'Entry Meta', 'athen_transl' ),
				'type'      => 'multiple-select',
				'object'    => 'WPEX_Customize_Multicheck_Control',
				'choices'   => $entry_meta_choices
			),
		),
	),
);

/*-----------------------------------------------------------------------------------*/
/*  - Single Order
/*-----------------------------------------------------------------------------------*/
$blocks = array (
	'featured_media'    => __( 'Featured Media','athen_transl' ),
	'title_meta'        => __( 'Title & Meta','athen_transl' ),
	'post_series'       => __( 'Post Series','athen_transl' ),
	'the_content'       => __( 'Content','athen_transl' ),
	'post_tags'         => __( 'Post Tags','athen_transl' ),
	'social_share'      => __( 'Social Share','athen_transl' ),
	'author_bio'        => __( 'Author Bio','athen_transl' ),
	'related_posts'     => __( 'Related Posts','athen_transl' ),
	'comments'          => __( 'Comments','athen_transl' ),
);
$blocks = apply_filters( 'athen_blog_single_blocks', $blocks );
$this->sections['athen_blog_single_builder'] = array(
	'title'     => __( 'Single Builder', 'athen_transl' ),
	'panel'     => 'athen_blog',
	'settings'  => array(
		array(
			'id'        => 'blog_single_composer',
			'default'   => 'featured_media,title_meta,post_series,the_content,post_tags,social_share,author_bio,related_posts,comments',
			'control'   => array (
				'label'     => __( 'Blog Entry Element\'s Order', 'athen_transl' ),
				'type'      => 'wpex-sortable',
				'object'    => 'WPEX_Customize_Control_Sorter',
				'choices'   => $blocks,
				'desc'      => __( 'Click and drag and drop elements to re-order them. Click the "x" to disable any element. You can not disable all elements, if you do so it will display them all', 'athen_transl' ),
			),
		),
	),
);

/*-----------------------------------------------------------------------------------*/
/*  - Related
/*-----------------------------------------------------------------------------------*/
$this->sections['athen_blog_related'] = array(
	'title'     => __( 'Related Posts', 'athen_transl' ),
	'panel'     => 'athen_blog',
	'settings'  => array(
		array(
			'id'        => 'blog_related_title',
			'control'   => array (
				'label'     => __( 'Title', 'athen_transl' ),
				'type'      => 'text',
			),
		),
		array(
			'id'        => 'blog_related_columns',
			'default'   => '3',
			'control'   => array (
				'label'     => __( 'Columns', 'athen_transl' ),
				'type'      => 'select',
				'choices'   => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				),
			),
		),
		array(
			'id'        => 'blog_related_count',
			'default'   => '3',
			'control'   => array (
				'label' => __( 'Count', 'athen_transl' ),
				'type'  => 'text',
			),
		),
		array(
			'id'        => 'blog_related_excerpt',
			'default'   => 'on',
			'control'   => array (
				'label' => __( 'Excerpt', 'athen_transl' ),
				'type'  => 'checkbox',
			),
		),
		array(
			'id'        => 'blog_related_excerpt_length',
			'default'   => '15',
			'control'   => array (
				'label' => __( 'Excerpt Length', 'athen_transl' ),
				'type'  => 'text',
			),
		),
	),
);

// Clear vars from memory
$blocks = $entry_meta_defaults = $entry_meta_choices = null;