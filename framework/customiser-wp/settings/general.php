<?php
/**
 * Description : Bunch of array use modify customizer controller + model.
 *             : General panel, section, setting & control.
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
/*  - Accent Colors
/*-----------------------------------------------------------------------------------*/
$this->sections['athen_accent_colors'] = array(
	'title'    => __( 'Accent Colors', 'athen_transl' ),
	'panel'    => 'athen_general',
	'settings' => array(
		array(
			'id'        => 'accent_color',
			'default'   => '#3b86b0', // Needs to be filterable via skin?
			'control'   => array (
				'label' =>  __( 'Accent Color', 'athen_transl' ),
				'type'  => 'color',
			),
		),
	)
);


/*-----------------------------------------------------------------------------------*/
/*  - Page Transitions
/*-----------------------------------------------------------------------------------*/
$in_transitions  = Athen_Page_Animations::in_transitions();
$out_transitions = Athen_Page_Animations::out_transitions();
$this->sections['athen_page_animations'] = array(
	'title'    => __( 'Page Animations', 'athen_transl' ),
	'panel'    => 'athen_general',
	'desc'     => __( 'You must save your options and refresh your live site to preview changes to this setting.', 'athen_transl' ),
	'settings' => array(
		array(
			'id'        => 'page_animation_loading',
			'transport' => 'postMessage',
			'control'   => array (
				'label'   =>  __( 'Loading Text', 'athen_transl' ),
				'type'    => 'text',
			),
		),
		array(
			'id'        => 'page_animation_in',
			'transport' => 'postMessage',
			'control'   => array (
				'label'   =>  __( 'In Animation', 'athen_transl' ),
				'type'    => 'select',
				'choices' => $in_transitions,
			),
		),
		array(
			'id'        => 'page_animation_out',
			'transport' => 'postMessage',
			'control'   => array (
				'label'   =>  __( 'Out Animation', 'athen_transl' ),
				'type'    => 'select',
				'choices' => $out_transitions,
			),
		),
	)
);

/*-----------------------------------------------------------------------------------*/
/*  - Background
/*-----------------------------------------------------------------------------------*/
$patterns_url = get_template_directory_uri() .'/images/patterns/';
$this->sections['athen_background_background'] = array(
	'title'     => __( 'Site Background', 'athen_transl' ),
	'panel'     => 'athen_general',
	'desc'      => __( 'Here you can alter the global site background. It is highly recommended that you first set the site layout to "Boxed" at "Layout->General"', 'athen_transl' ),
	'settings'  => array(
		array(
			'id'        => 'background_color',
			'control'   => array (
				'label'     =>  __( 'Background Color', 'athen_transl' ),
				'type'      => 'color',
				'object'    => 'WP_Customize_Color_Control',
			),
		),
		array(
			'id'        => 'background_image',
			'control'   => array (
				'label'     =>  __( 'Custom Background Image', 'athen_transl' ),
				'type'      => 'image',
				'object'    => 'WP_Customize_Image_Control',
			),
		),
		array(
			'id'        => 'background_style',
			'default'   => 'stretched',
			'control'   => array (
				'label'     =>  __( 'Background Image Style', 'athen_transl' ),
				'type'      => 'image',
				'type'      => 'select',
				'choices'   => array(
					'stretched' => __( 'Stretched', 'athen_transl' ),
					'repeat'    => __( 'Repeat', 'athen_transl' ),
					'fixed'     => __( 'Center Fixed', 'athen_transl' ),
				),
			),
		),
		array(
			'id'        => 'background_pattern',
			'control'   => array (
				'label'     =>  __( 'Background Pattern', 'athen_transl' ),
				'type'      => 'image',
				'type'      => 'select',
				'choices'   => array(
					''                                  => __( 'None', 'athen_transl' ),
					$patterns_url .'dark_wood.png'      => __( 'Dark Wood', 'athen_transl' ),
					$patterns_url .'diagmonds.png'      => __( 'Diamonds', 'athen_transl' ),
					$patterns_url .'grilled.png'        => __( 'Grilled', 'athen_transl' ),
					$patterns_url .'lined_paper.png'    => __( 'Lined Paper', 'athen_transl' ),
					$patterns_url .'old_wall.png'       => __( 'Old Wall', 'athen_transl' ),
					$patterns_url .'ricepaper2.png'     => __( 'Rice Paper', 'athen_transl' ),
					$patterns_url .'tree_bark.png'      => __( 'Tree Bark', 'athen_transl' ),
					$patterns_url .'triangular.png'     => __( 'Triangular', 'athen_transl' ),
					$patterns_url .'white_plaster.png'  => __( 'White Plaster', 'athen_transl' ),
					$patterns_url .'wild_flowers.png'   => __( 'Wild Flowers', 'athen_transl' ),
					$patterns_url .'wood_pattern.png'   => __( 'Wood Pattern', 'athen_transl' ),
				),
			),
		),
	),
);

/*-----------------------------------------------------------------------------------*/
/*  - Social Sharing Section
/*-----------------------------------------------------------------------------------*/
$this->sections['athen_social_sharing'] = array(
	'title'     => __( 'Social Sharing', 'athen_transl' ),
	'panel'     => 'athen_general',
	'settings'  => array(
		array(
			'id'            => 'social_share_sites',
			'default'       => array( 'twitter', 'facebook', 'google_plus', 'pinterest', 'linkedin' ),
			'control'       => array (
				'label'     =>  __( 'Sites', 'athen_transl' ),
				'type'      => 'multiple-select',
				'object'    => 'WPEX_Customize_Multicheck_Control',
				'choices'   => array(
					'twitter'       => __( 'Twitter', 'athen_transl' ),
					'facebook'      => __( 'Facebook', 'athen_transl' ),
					'google_plus'   => __( 'Google Plus', 'athen_transl' ),
					'pinterest'     => __( 'Pinterest', 'athen_transl' ),
					'linkedin'      => __( 'LinkedIn', 'athen_transl' ),
				),
			),
		),
		array(
			'id'        => 'social_share_heading',
			'default'   => __( 'Share Post', 'athen_transl' ),
			'transport' => 'refresh',
			'control'   => array (
				'label' =>  __( 'Heading', 'athen_transl' ),
				'type'  => 'text',
			),
		),
		array(
			'id'        => 'social_share_style',
			'default'   => 'minimal',
			'control'   => array (
				'label' =>  __( 'Style', 'athen_transl' ),
				'type'  => 'select',
				'choices'   => array(
					'minimal'   => __( 'Minimal','athen_transl' ),
					'flat'      => __( 'Flat','athen_transl' ),
					'three-d'   => __( '3D','athen_transl' ),
				),
			),
		),
        array(
			'id'        => 'athen_social_share_animation',
			'default'   => 'static',
			'control'   => array (
				'label' =>  __( 'Animation', 'athen_transl' ),
				'type'  => 'select',
				'choices'   => array(
					'static'   => __( 'Static','athen_transl' ),
					'sliding'      => __( 'Sliding','athen_transl' ),
				),
			),
		),
		array(
			'id'        => 'social_share_blog_entries',
			'default'   => true,
			'control'   => array (
				'label' =>  __( 'Blog Entries: Social Share', 'athen_transl' ),
				'type'  => 'checkbox',
			),
		),
		array(
			'id'        => 'social_share_blog_posts',
			'default'   => true,
			'control'   => array (
				'label' =>  __( 'Blog Posts: Social Share', 'athen_transl' ),
				'type'  => 'checkbox',
			),
		),
		array(
			'id'        => 'social_share_pages',
			'default'   => false,
			'control'   => array (
				'label' =>  __( 'Pages: Social Share', 'athen_transl' ),
				'type'  => 'checkbox',
			),
		),
	)
);

/*-----------------------------------------------------------------------------------*/
/*  - Lightbox
/*-----------------------------------------------------------------------------------*/
$this->sections['athen_lightbox'] = array(
	'title'     => __( 'Lightbox', 'athen_transl' ),
	'panel'     => 'athen_general',
	'settings'  => array(
		array(
			'id'        => 'lightbox_skin',
			'control'   => array (
				'label' =>  __( 'Skin', 'athen_transl' ),
				'type'    => 'select',
				'choices' => athen_ilightbox_skins(),
			),
		),
		array(
			'id'        => 'lightbox_thumbnails',
			'default'   => true,
			'control'   => array (
				'label' =>  __( 'Gallery Thumbnails', 'athen_transl' ),
				'type'  => 'checkbox',
			),
		),
		array(
			'id'        => 'lightbox_arrows',
			'default'   => true,
			'control'   => array (
				'label' =>  __( 'Gallery Arrows', 'athen_transl' ),
				'type'  => 'checkbox',
			),
		),
		array(
			'id'        => 'lightbox_mousewheel',
			'default'   => false,
			'control'   => array (
				'label' =>  __( 'Gallery Mousewheel Scroll', 'athen_transl' ),
				'type'  => 'checkbox',
			),
		),
		array(
			'id'        => 'lightbox_titles',
			'default'   => true,
			'control'   => array (
				'label' =>  __( 'Titles', 'athen_transl' ),
				'type'  => 'checkbox',
			),
		),
		array(
			'id'        => 'lightbox_fullscreen',
			'default'   => true,
			'control'   => array (
				'label' =>  __( 'Fullscreen Button', 'athen_transl' ),
				'type'  => 'checkbox',
			),
		),
	)
);

/*-----------------------------------------------------------------------------------*/
/*  - Breadcrumbs
/*-----------------------------------------------------------------------------------*/
$this->sections['athen_breadcrumbs'] = array(
	'title'     => __( 'Breadcrumbs', 'athen_transl' ),
	'panel'     => 'athen_general',
	'settings'  => array(
		array(
			'id'        => 'breadcrumbs',
			'default'   => true,
			'control'   => array (
				'label' =>  __( 'Breadcrumbs', 'athen_transl' ),
				'type'  => 'checkbox',
			),
		),
		array(
			'id'        => 'breadcrumbs_position',
			'control'   => array (
				'label'     =>  __( 'Position', 'athen_transl' ),
				'type'      => 'select',
				'choices'   => array(
					''              => __( 'Absolute Right', 'athen_transl' ),
					'under-title'   => __( 'Under Title', 'athen_transl' ),
				),
			),
		),
		array(
			'id'        => 'breadcrumbs_home_title',
			'transport' => 'refresh',
			'control'   => array (
				'label' =>  __( 'Custom Home Title', 'athen_transl' ),
				'type'  => 'text',
			),
		),
		array(
			'id'        => 'breadcrumbs_title_trim',
			'default'   => '4',
			'control'   => array (
				'label' =>  __( 'Breadcrumbs: Title Trim Length', 'athen_transl' ),
				'type'  => 'text',
				'desc'  => __( 'Enter the max number of words to display for your breadcrumbs post title', 'athen_transl' ),
			),
		),
	),
);

/*-----------------------------------------------------------------------------------*/
/*  - Page Title
/*-----------------------------------------------------------------------------------*/
$this->sections['athen_page_header'] = array(
	'title'     => __( 'Page Title', 'athen_transl' ),
	'panel'     => 'athen_general',
	'desc'      => __( 'This is the area above posts and pages with the title and breadcrumbs', 'athen_transl' ),
	'settings'  => array(
		array(
			'id'        => 'page_header_style',
			'default'   => '',
			'control'   => array (
				'label'     =>  __( 'Page Header Style', 'athen_transl' ),
				'type'      => 'image',
				'type'      => 'select',
				'choices'   => array(
					''                  => __( 'Default','athen_transl' ),
					'centered'          => __( 'Centered', 'athen_transl' ),
					'centered-minimal'  => __( 'Centered Minimal', 'athen_transl' ),
					'hidden'            => __( 'Hidden', 'athen_transl' ),
				),
			),
		),
	),
);

/*-----------------------------------------------------------------------------------*/
/*  - Pages
/*-----------------------------------------------------------------------------------*/
$this->sections['athen_pages'] = array(
	'title'     => __( 'Pages', 'athen_transl' ),
	'panel'     => 'athen_general',
	'settings'  => array(
		array(
			'id'        => 'page_single_layout',
			'default'   => true,
			'default'   => 'right-sidebar',
			'control'   => array (
				'label' =>  __( 'Layout', 'athen_transl' ),
				'type'      => 'select',
				'choices'   => array(
					'right-sidebar' => __( 'Right Sidebar','athen_transl' ),
					'left-sidebar'  => __( 'Left Sidebar','athen_transl' ),
					'full-width'    => __( 'No Sidebar','athen_transl' ),
				),
			),
		),
		array(
			'id'        => 'pages_custom_sidebar',
			'default'   => true,
			'control'   => array (
				'label' =>  __( 'Custom Sidebar', 'athen_transl' ),
				'type'  => 'checkbox',
			),
		),
		array(
			'id'        => 'page_comments',
			'control'   => array (
				'label' =>  __( 'Comments on Pages', 'athen_transl' ),
				'type'  => 'checkbox',
			),
		),
		array(
			'id'        => 'page_featured_image',
			'control'   => array (
				'label' =>  __( 'Display Featured Images', 'athen_transl' ),
				'type'  => 'checkbox',
			),
		),
	),
);

/*-----------------------------------------------------------------------------------*/
/*  - Search
/*-----------------------------------------------------------------------------------*/
$this->sections['athen_search'] = array(
	'title'     => __( 'Search', 'athen_transl' ),
	'panel'     => 'athen_general',
	'settings'  => array(
		array(
			'id'        => 'search_custom_sidebar',
			'default'   => true,
			'control'   => array (
				'label' =>  __( 'Custom Sidebar', 'athen_transl' ),
				'type'  => 'checkbox',
			),
		),
		array(
			'id'        => 'search_posts_per_page',
			'default'   => '10',
			'control'   => array (
				'label' =>  __( 'Posts Per Page', 'athen_transl' ),
				'type'  => 'text',
			),
		),
	),
);