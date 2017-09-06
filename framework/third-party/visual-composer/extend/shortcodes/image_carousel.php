<?php
/**
 * Registers the Image Carousel shortcode and adds it to the Visual Composer
 *
 * @package     Total
 * @subpackage  Framework/Visual Composer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       1.4.1
 * @version     2.1.0
 */

/**
 * Register shortcode with VC Composer
 *
 * @since 2.0.0
 */
class WPBakeryShortCode_vcex_image_carousel extends WPBakeryShortCode {
	protected function content( $atts, $content = null ) {
		ob_start();
		include( locate_template( 'vcex_templates/vcex_image_carousel.php' ) );
		return ob_get_clean();
	}
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_image_carousel_shortcode_vc_map' ) ) {
	function vcex_image_carousel_shortcode_vc_map() {
	$vc_img_rendering_url = 'https://developer.mozilla.org/en-US/docs/Web/CSS/image-rendering';
		vc_map( array(
			'name'                  => __( 'Image Carousel', 'athen_transl' ),
			'description'           => __( 'Image based jQuery carousel', 'athen_transl' ),
			'base'                  => 'vcex_image_carousel',
			'category'              => ATHEN_NAME_THEME,
			'icon'                  => 'vcex-image-carousel',
			'params'                => array(

				// Gallery
				array(
					'type'          => 'attach_images',
					'admin_label'   => true,
					'heading'       => __( 'Attach Images', 'athen_transl' ),
					'param_name'    => 'image_ids',
					'group'         => __( 'Images', 'athen_transl' ),
				),
				array(
					'type'          => 'dropdown',
					'heading'       => __( 'Post Gallery', 'athen_transl' ),
					'param_name'    => 'post_gallery',
					'group'         => __( 'Images', 'athen_transl' ),
					'description'   => __( 'Enable to display images from the current post "Image Gallery".', 'athen_transl' ),
					'value'         => array(
						__( 'No', 'athen_transl' )     => '',
						__( 'Yes', 'athen_transl' )  => 'true',
					),
				),
				array(
					'type'          => 'dropdown',
					'admin_label'   => true,
					'heading'       => __( 'Randomize Images', 'athen_transl' ),
					'param_name'    => 'randomize_images',
					'value'         => array(
						__( 'False', 'athen_transl' )   => '',
						__( 'True', 'athen_transl' )    => 'true',
					),
					'group'         => __( 'Images', 'athen_transl' ),
				),

				// General
				array(
					'type'          => 'textfield',
					'heading'       => __( 'Unique Id', 'athen_transl' ),
					'description'   => __( 'Give your main element a unique ID.', 'athen_transl' ),
					'param_name'    => 'unique_id',
				),
				array(
					'type'          => 'textfield',
					'heading'       => __( 'Custom Classes', 'athen_transl' ),
					'description'   => __( 'Add additonal classes to the main element.', 'athen_transl' ),
					'param_name'    => 'classes',
				),
				array(
					'type'              => 'dropdown',
					'heading'           => __( 'Style', 'athen_transl' ),
					'param_name'        => 'style',
					'value'             => array(
						__( 'Default', 'athen_transl' )     => '',
						__( 'No Margins', 'athen_transl' )  => 'no-margins',
					),
					'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
				),
				array(
					'type'             => 'dropdown',
					'heading'          => __( 'Arrows?', 'athen_transl' ),
					'param_name'       => 'arrows',
					'value'            => array(
						__( 'True', 'athen_transl' )  => 'true',
						__( 'False', 'athen_transl' ) => 'false',
					),
					'edit_field_class' => 'vc_col-sm-4 vc_column',
				),
				array(
					'type'              => 'dropdown',
					'heading'           => __( 'Dots?', 'athen_transl' ),
					'param_name'        => 'dots',
					'value'             => array(
						__( 'False', 'athen_transl' )   => 'false',
						__( 'True', 'athen_transl' )    => 'true',
					),
					'edit_field_class'  => 'vc_col-sm-4 vc_column',
				),
				array(
					'type'              => 'textfield',
					'heading'           => __( 'Items To Display', 'athen_transl' ),
					'param_name'        => 'items',
					'value'             => '4',
					'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
				),
				array(
					'type'              => 'textfield',
					'heading'           => __( 'Items To Scrollby', 'athen_transl' ),
					'param_name'        => 'items_scroll',
					'value'             => '',
					'edit_field_class'  => 'vc_col-sm-4 vc_column',
				),
				array(
					'type'              => 'textfield',
					'heading'           => __( 'Margin Between Items', 'athen_transl' ),
					'param_name'        => 'items_margin',
					'value'             => '15',
					'edit_field_class'  => 'vc_col-sm-4 vc_column',
				),
				array(
					'type'              => 'dropdown',
					'heading'           => __( 'Auto Play', 'athen_transl' ),
					'param_name'        => 'auto_play',
					'value'             => array(
						__( 'True', 'athen_transl' )    => 'true',
						__( 'False', 'athen_transl' )   => 'false',
					),
					'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
				),
				array(
					'type'              => 'dropdown',
					'heading'           => __( 'Infinite Loop', 'athen_transl' ),
					'param_name'        => 'infinite_loop',
					'value'             => array(
						__( 'True', 'athen_transl' )    => 'true',
						__( 'False', 'athen_transl' )   => 'false',
					),
					'edit_field_class'  => 'vc_col-sm-4 vc_column',
				),
				array(
					'type'              => 'dropdown',
					'heading'           => __( 'Center Item', 'athen_transl' ),
					'param_name'        => 'center',
					'value'             => array(
						__( 'False', 'athen_transl' )   => 'false',
						__( 'True', 'athen_transl' )    => 'true',
					),
					'edit_field_class'  => 'vc_col-sm-4 vc_column',
				),
				array(
					'type'          => 'textfield',
					'heading'       => __( 'Timeout Duration in milliseconds', 'athen_transl' ),
					'param_name'    => 'timeout_duration',
					'value'         => '5000',
					'dependency'    => Array(
						'element'   => 'auto_play',
						'value'     => 'true'
					),
				),
				array(
					'type'          => 'textfield',
					'heading'       => __( 'Tablet: Items To Display', 'athen_transl' ),
					'param_name'    => 'tablet_items',
					'value'         => '3',
				),
				array(
					'type'          => 'textfield',
					'heading'       => __( 'Mobile Landscape: Items To Display', 'athen_transl' ),
					'param_name'    => 'mobile_landscape_items',
					'value'         => '2',
				),
				array(
					'type'          => 'textfield',
					'heading'       => __( 'Mobile Portrait: Items To Display', 'athen_transl' ),
					'param_name'    => 'mobile_portrait_items',
					'value'         => '1',
				),

				// Title
				array(
					'type'          => 'dropdown',
					'heading'       => __( 'Display Title?', 'athen_transl' ),
					'param_name'    => 'title',
					'value'         => Array(
						__( 'False', 'athen_transl' )   => '',
						__( 'True', 'athen_transl' )    => 'yes',
					),
					'group'         => __( 'Title', 'athen_transl' ),
				),
				array(
					'type'          => 'dropdown',
					'heading'       => __( 'Title Based On Image', 'athen_transl' ),
					'param_name'    => 'title_type',
					'value'         => array(
						__( 'Default', 'athen_transl' )     => '',
						__( 'Title', 'athen_transl' )       => 'title',
						__( 'Alt', 'athen_transl' )         => 'alt',
					),
					'group'         => __( 'Title', 'athen_transl' ),
					'dependency'    => Array(
						'element'   => 'title',
						'value'     => array( 'yes' )
					),
				),
				array(
					'type'          => 'colorpicker',
					'heading'       => __( 'Title Text Color', 'athen_transl' ),
					'param_name'    => 'content_heading_color',
					'group'         => __( 'Title', 'athen_transl' ),
					'dependency'    => Array(
						'element'   => 'title',
						'value'     => array( 'yes' )
					),
				),
				array(
					'type'              => 'dropdown',
					'heading'           => __( 'Title Font Weight', 'athen_transl' ),
					'param_name'        => 'content_heading_weight',
					'description'       => __( 'Note: Not all font families support every font weight.', 'athen_transl' ),
					'std'           => '',
					'value'         => vcex_font_weights(),
					'group'             => __( 'Title', 'athen_transl' ),
					'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
					'dependency'    => Array(
						'element'   => 'title',
						'value'     => array( 'yes' )
					),
				),
				array(
					'type'              => 'dropdown',
					'heading'           => __( 'Title Text Transform', 'athen_transl' ),
					'param_name'        => 'content_heading_transform',
					'value'             => vcex_text_transforms(),
					'group'             => __( 'Title', 'athen_transl' ),
					'description'       => __( 'Select a custom text transform to override the default.', 'athen_transl' ),
					'edit_field_class'  => 'vc_col-sm-6 vc_column',
					'dependency'    => Array(
						'element'   => 'title',
						'value'     => array( 'yes' )
					),
				),
				array(
					'type'              => 'textfield',
					'heading'           => __( 'Title Font Size', 'athen_transl' ),
					'param_name'        => 'content_heading_size',
					'description'       => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
					'group'             => __( 'Title', 'athen_transl' ),
					'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
					'dependency'    => Array(
						'element'   => 'title',
						'value'     => array( 'yes' )
					),
				),
				array(
					'type'              => 'textfield',
					'heading'           => __( 'Title Margin', 'athen_transl' ),
					'param_name'        => 'content_heading_margin',
					'description'       => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
					'group'             => __( 'Title', 'athen_transl' ),
					'edit_field_class'  => 'vc_col-sm-6 vc_column',
					'dependency'    => Array(
						'element'   => 'title',
						'value'     => array( 'yes' )
					),
				),

				// Caption
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Display Caption', 'athen_transl' ),
					'param_name' => 'caption',
					'value'      => Array(
						__( 'False', 'athen_transl' ) => 'false',
						__( 'True', 'athen_transl' )  => 'yes',
					),
					'group'      => __( 'Caption', 'athen_transl' ),
				),
				array(
					'type'          => 'colorpicker',
					'heading'       => __( 'Caption Text Color', 'athen_transl' ),
					'param_name'    => 'content_color',
					'group'         => __( 'Caption', 'athen_transl' ),
				),
				array(
					'type'          => 'textfield',
					'heading'       => __( 'Caption Font Size', 'athen_transl' ),
					'param_name'    => 'content_font_size',
					'description'   => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
					'group'         => __( 'Caption', 'athen_transl' ),
				),

				// Links
				array(
					'type'          => 'dropdown',
					'heading'       => __( 'Image Link', 'athen_transl' ),
					'param_name'    => 'thumbnail_link',
					'value'         => array(
						__( 'None', 'athen_transl' )            => 'none',
						__( 'Lightbox', 'athen_transl' )        => 'lightbox',
						__( 'Custom Links', 'athen_transl' )    => 'custom_link',
					),
					'group'         => __( 'Links', 'athen_transl' ),
				),
				/*array(
					'type'          => 'dropdown',
					'heading'       => __( 'Gallery Lightbox', 'athen_transl' ),
					'param_name'    => 'gallery_lightbox',
					'value'         => array(
						__( 'False', 'athen_transl' )   => '',
						__( 'True', 'athen_transl' )    => true,
					),
					'dependency'    => Array(
						'element'   => 'thumbnail_link',
						'value'     => array( 'lightbox' )
					),
					'group'         => __( 'Links', 'athen_transl' ),
				),*/
				array(
					'type'          => 'exploded_textarea',
					'heading'       => __( 'Custom links', 'athen_transl' ),
					'param_name'    => 'custom_links',
					'description'   => __( 'Enter links for each slide here. Divide links with linebreaks (Enter). For images without a link enter a # symbol. And don\'t forget to include the http:// at the front.', 'athen_transl'),
					'dependency'    => Array(
						'element'   => 'thumbnail_link',
						'value'     => array( 'custom_link' )
					),
					'group'         => __( 'Links', 'athen_transl' ),
				),
				array(
					'type'              => 'dropdown',
					'heading'           => __( 'Custom link target', 'athen_transl' ),
					'param_name'        => 'custom_links_target',
					'description'       => __( 'Select where to open custom links.', 'athen_transl'),
					'dependency'        => Array(
						'element'   => 'thumbnail_link',
						'value'     => 'custom_link',
					),
					'value'             => array(
							__( 'Same window', 'athen_transl' ) => '',
							__( 'New window', 'athen_transl' )  => '_blank'
						),
					'group'         => __( 'Links', 'athen_transl' ),
				),
				array(
					'type'          => 'dropdown',
					'heading'       => __( 'Lightbox Skin', 'athen_transl' ),
					'param_name'    => 'lightbox_skin',
					'std'           => '',
					'value'         => vcex_ilightbox_skins(),
					'group'         => __( 'Links', 'athen_transl' ),
					'dependency'    => Array(
						'element'   => 'thumbnail_link',
						'value'     => 'lightbox',
					),
				),

				// Image
				array(
					'type'          => 'dropdown',
					'heading'       => __( 'Image Size', 'athen_transl' ),
					'param_name'    => 'img_size',
					'std'           => 'athen_custom',
					'value'         => vcex_image_sizes(),
					'group'         => __( 'Image', 'athen_transl' ),
				),
				array(
					'type'          => 'dropdown',
					'heading'       => __( 'Image Crop Location', 'athen_transl' ),
					'param_name'    => 'img_crop',
					'std'           => 'center-center',
					'value'         => vcex_image_crop_locations(),
					'dependency'    => array(
						'element'   => 'img_size',
						'value'     => 'athen_custom',
					),
					'group'         => __( 'Image', 'athen_transl' ),
				),
				array(
					'type'              => 'textfield',
					'heading'           => __( 'Image Crop Width', 'athen_transl' ),
					'param_name'        => 'img_width',
					'dependency'        => array(
						'element'   => 'img_size',
						'value'     => 'athen_custom',
					),
					'description'       => __( 'Enter a width in pixels.', 'athen_transl' ),
					'group'             => __( 'Image', 'athen_transl' ),
					'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
				),
				array(
					'type'              => 'textfield',
					'heading'           => __( 'Image Crop Height', 'athen_transl' ),
					'param_name'        => 'img_height',
					'dependency'        => array(
						'element'   => 'img_size',
						'value'     => 'athen_custom',
					),
					'description'       => __( 'Enter a height in pixels. Leave empty to disable vertical cropping and keep image proportions.', 'athen_transl' ),
					'group'             => __( 'Image', 'athen_transl' ),
					'edit_field_class'  => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'              => 'dropdown',
					'heading'           => __( 'Rounded Image?', 'athen_transl' ),
					'param_name'        => 'rounded_image',
					'value'             => Array(
						__( 'No', 'athen_transl' )  => '',
						__( 'Yes', 'athen_transl' ) => 'yes'
					),
					'group'             => __( 'Image', 'athen_transl' ),
					'edit_field_class'  => 'vc_col-sm-3 vc_column clr',
				),
				array(
					'type'              => 'dropdown',
					'heading'           => __( 'Image Filter', 'athen_transl' ),
					'param_name'        => 'img_filter',
					'value'             => vcex_image_filters(),
					'group'             => __( 'Image', 'athen_transl' ),
					'edit_field_class'  => 'vc_col-sm-3 vc_column',
				),
				array(
					'type'              => 'dropdown',
					'heading'           => __( 'CSS3 Image Hover', 'athen_transl' ),
					'param_name'        => 'img_hover_style',
					'value'             => vcex_image_hovers(),
					'group'             => __( 'Image', 'athen_transl' ),
					'edit_field_class'  => 'vc_col-sm-3 vc_column',
				),
				array(
					'type'              => 'dropdown',
					'heading'           => __( 'Image Rendering', 'athen_transl' ),
					'param_name'        => 'img_rendering',
					'value'             => vcex_image_rendering(),
					'group'             => __( 'Image', 'athen_transl' ),
					'edit_field_class'  => 'vc_col-sm-3 vc_column',
				),

				// Design
				array(
					'type'          => 'colorpicker',
					'heading'       => __( 'Content Background', 'athen_transl' ),
					'param_name'    => 'content_background',
					'group'         => __( 'Design', 'athen_transl' ),
				),
				array(
					'type'          => 'dropdown',
					'heading'       => __( 'Content Alignment', 'athen_transl' ),
					'param_name'    => 'content_alignment',
					'value'         => array(
						__( 'Default', 'athen_transl' ) => '',
						__( 'Left', 'athen_transl' )    => 'left',
						__( 'Right', 'athen_transl' )   => 'right',
						__( 'Center', 'athen_transl')   => 'center',
					),
					'group'         => __( 'Design', 'athen_transl' ),
				),
				array(
					'type'              => 'textfield',
					'heading'           => __( 'Content Margin', 'athen_transl' ),
					'param_name'        => 'content_margin',
					'description'       => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
					'group'             => __( 'Design', 'athen_transl' ),
					'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
				),
				array(
					'type'              => 'textfield',
					'heading'           => __( 'Content Padding', 'athen_transl' ),
					'param_name'        => 'content_padding',
					'description'       => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
					'group'             => __( 'Design', 'athen_transl' ),
					'edit_field_class'  => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'              => 'textfield',
					'heading'           => __( 'Content Border', 'athen_transl' ),
					'param_name'        => 'content_border',
					'description'       => __( 'Please use the shorthand format: width style color. Enter 0px or "none" to disable border.', 'athen_transl' ),
					'group'             => __( 'Design', 'athen_transl' ),
					'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
				),
				array(
					'type'              => 'textfield',
					'heading'           => __( 'Content Opacity', 'athen_transl' ),
					'param_name'        => 'content_opacity',
					'group'             => __( 'Design', 'athen_transl' ),
					'edit_field_class'  => 'vc_col-sm-6 vc_column',
					'description'       => __( 'Enter a value between "0" and "1".', 'athen_transl' ),
				),

			),

		) );
	}
}
add_action( 'vc_before_init', 'vcex_image_carousel_shortcode_vc_map' );