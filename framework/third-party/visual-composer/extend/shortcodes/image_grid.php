<?php
/**
 * Registers the image grid shortcode and adds it to the Visual Composer
 *
 * @package     Total
 * @subpackage  Framework/Visual Composer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.4.1
 * @version     2.0.0
 */

/**
 * Register shortcode with VC Composer
 *
 * @since 2.0.0
 */
class WPBakeryShortCode_vcex_image_grid extends WPBakeryShortCode {
	protected function content( $atts, $content = null ) {
		ob_start();
		include( locate_template( 'vcex_templates/vcex_image_grid.php' ) );
		return ob_get_clean();
	}
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_image_grid_shortcode_vc_map' ) ) {
	function vcex_image_grid_shortcode_vc_map() {

		vc_map( array(
			'name'                  => __( 'Image Grid', 'athen_transl' ),
			'description'           => __( 'Responsive image gallery', 'athen_transl' ),
			'base'                  => 'vcex_image_grid',
			'icon'                  => 'vcex-image-grid',
			'category'              => ATHEN_NAME_THEME,
			'params'                => array(

				// Attach Images
				array(
					'type'          => 'attach_images',
					'admin_label'   => true,
					'heading'       => __( 'Attach Images', 'athen_transl' ),
					'param_name'    => 'image_ids',
					'group'         => __( 'Images', 'athen_transl' ),
					'description'   => __( 'Click the plus icon to add images to your gallery. Once images are added they can be drag and dropped for sorting.', 'athen_transl' ),
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
					'heading'           => __( 'Visibility', 'athen_transl' ),
					'param_name'        => 'visibility',
					'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
					'value'             => vcex_visibility(),
				),
				array(
					'type'              => 'dropdown',
					'heading'           => __( 'Appear Animation', 'athen_transl'),
					'param_name'        => 'css_animation',
					'edit_field_class'  => 'vc_col-sm-4 vc_column',
					'value'             => vcex_css_animations(),
				),
				array(
					'type'              => 'dropdown',
					'heading'           => __( 'Hover Animation', 'athen_transl'),
					'param_name'        => 'hover_animation',
					'edit_field_class'  => 'vc_col-sm-4 vc_column',
					'value'             => vcex_hover_animations(),
				),
				array(
					'type'          => 'dropdown',
					'heading'       => __( 'Grid Style', 'athen_transl' ),
					'param_name'    => 'grid_style',
					'value'         => array(
						__( 'Fit Rows', 'athen_transl' )    => 'default',
						__( 'Masonry', 'athen_transl' )     => 'masonry',
						__( 'No Margins', 'athen_transl' )  => 'no-margins',
					),
					'edit_field_class'  => 'vc_col-sm-3 vc_column clear',
				),
				array(
					'type'          => 'dropdown',
					'heading'       => __( 'Columns', 'athen_transl' ),
					'param_name'    => 'columns',
					'std'           => '4',
					'value'         => vcex_grid_columns(),
					'edit_field_class'  => 'vc_col-sm-3 vc_column',
				),
				array(
					'type'              => 'dropdown',
					'heading'           => __( 'Gap', 'athen_transl' ),
					'param_name'        => 'columns_gap',
					'value'             => vcex_column_gaps(),
					'std'               => '',
					'edit_field_class'  => 'vc_col-sm-3 vc_column',
				),
				array(
					'type'          => 'dropdown',
					'heading'       => __( 'Responsive', 'athen_transl' ),
					'param_name'    => 'responsive_columns',
					'std'           => '',
					'value'         => array(
						__( 'True', 'athen_transl' )    => '',
						__( 'False', 'athen_transl' )   => 'false',
					),
					'edit_field_class'  => 'vc_col-sm-3 vc_column',
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
				),
				array(
					'type'          => 'textfield',
					'admin_label'   => true,
					'heading'       => __( 'Images Per Page', 'athen_transl' ),
					'param_name'    => 'posts_per_page',
					'value'         => '-1',
					'description'   => __( 'This will enable pagination for your gallery. Enter -1 or leave blank to display all images without pagination.', 'athen_transl' ),
				),

				// Links
				array(
					'type'          => 'dropdown',
					'heading'       => __( 'Image Link', 'athen_transl' ),
					'param_name'    => 'thumbnail_link',
					'value'         => array(
						__( 'None', 'athen_transl' )            => 'none',
						__( 'Lightbox', 'athen_transl' )        => 'lightbox',
						__( 'Attachment Page', 'athen_transl' ) => 'attachment_page',
						__( 'Custom Links', 'athen_transl' )    => 'custom_link',
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
				array(
					'type'          => 'dropdown',
					'heading'       => __( 'Lightbox Thumbnails Placement', 'athen_transl' ),
					'param_name'    => 'lightbox_path',
					'value'         => array(
						__( 'Horizontal', 'athen_transl' )  => '',
						__( 'Vertical', 'athen_transl' )    => 'vertical',
					),
					'group'         => __( 'Links', 'athen_transl' ),
					'dependency'    => Array(
						'element'   => 'thumbnail_link',
						'value'     => 'lightbox',
					),
				),
				array(
					'type'          => 'dropdown',
					'heading'       => __( 'Lightbox Title', 'athen_transl' ),
					'param_name'    => 'lightbox_title',
					'value'         => array(
						__( 'Alt', 'athen_transl' )     => '',
						__( 'Title', 'athen_transl' )   => 'title',
						__( 'None', 'athen_transl' )    => 'false',
					),
					'group'         => __( 'Links', 'athen_transl' ),
					'dependency'    => Array(
						'element'   => 'thumbnail_link',
						'value'     => 'lightbox',
					),
				),
				array(
					'type'          => 'dropdown',
					'heading'       => __( 'Lightbox Caption', 'athen_transl' ),
					'param_name'    => 'lightbox_caption',
					'value'         => array(
						__( 'Enable', 'athen_transl' )      => 'true',
						__( 'Disable', 'athen_transl' )     => 'false',
					),
					'group'         => __( 'Links', 'athen_transl' ),
					'dependency'    => Array(
						'element'   => 'thumbnail_link',
						'value'     => 'lightbox',
					),
				),
				array(
					'type'          => 'exploded_textarea',
					'heading'       => __( 'Custom links', 'athen_transl' ),
					'param_name'    => 'custom_links',
					'description'   => __( 'Enter links for each slide here. Divide links with linebreaks (Enter). For images without a link enter a # symbol. And don\'t forget to include the http:// at the front.', 'athen_transl' ),
					'dependency'    => Array(
						'element'   => 'thumbnail_link',
						'value'     => array( 'custom_link' )
					),
					'group'         => __( 'Links', 'athen_transl' ),
				),
				array(
					'type'          => 'dropdown',
					'heading'       => __( 'Link Target', 'athen_transl' ),
					'param_name'    => 'custom_links_target',
					'group'         => __( 'Links', 'athen_transl' ),
					'value'         => array(
						__( 'Same window', 'athen_transl' ) => '_self',
						__( 'New window', 'athen_transl' )  => '_blank'
					),
					'dependency'    => Array(
						'element'   => 'thumbnail_link',
						'value'     => array( 'custom_link', 'attachment_page' ),
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
					'group'             => __( 'Image', 'athen_transl' ),
					'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
					'dependency'    => Array(
						'element'   => 'img_size',
						'value'     => 'athen_custom',
					),
					'description'       => __( 'Enter a width in pixels.', 'athen_transl' ),
				),
				array(
					'type'          => 'textfield',
					'heading'       => __( 'Image Crop Height', 'athen_transl' ),
					'param_name'    => 'img_height',
					'description'   => __( 'Enter a height in pixels. Leave empty to disable vertical cropping and keep image proportions.', 'athen_transl' ),
					'group'         => __( 'Image', 'athen_transl' ),
					'dependency'    => Array(
						'element'   => 'img_size',
						'value'     => 'athen_custom',
					),
					'edit_field_class'  => 'vc_col-sm-6 vc_column',
				),
				array(
					'type'              => 'dropdown',
					'heading'           => __( 'Rounded Image?', 'athen_transl' ),
					'param_name'        => 'rounded_image',
					'value'             => array(
						__( 'No', 'athen_transl' )  => '',
						__( 'Yes', 'athen_transl' ) => 'yes'
					),
					'edit_field_class'  => 'vc_col-sm-3 vc_column clear',
					'group'             => __( 'Image', 'athen_transl' ),
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

				// Title
				array(
					'type'          => 'dropdown',
					'heading'       => __( 'Display Title', 'athen_transl' ),
					'param_name'    => 'title',
					'std'           => '',
					'value'         => array(
						__( 'No', 'athen_transl' )  => '',
						__( 'Yes', 'athen_transl' ) => 'yes'
					),
					'group'         => __( 'Title', 'athen_transl' ),
				),
				array(
					'type'              => 'dropdown',
					'heading'           => __( 'Title Tag', 'athen_transl' ),
					'param_name'        => 'title_tag',
					'value'             => array(
						__( 'Default', 'athen_transl' ) => '',
						__( 'h2', 'athen_transl' )    => 'h2',
						__( 'h3', 'athen_transl' )    => 'h3',
						__( 'h4', 'athen_transl' )    => 'h4',
					),
					'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
					'dependency'        => Array(
						'element'   => 'title',
						'value'     => array( 'yes' )
					),
					'group'             => __( 'Title', 'athen_transl' ),
				),
				array(
					'type'              => 'dropdown',
					'heading'           => __( 'Title Based On Image', 'athen_transl' ),
					'param_name'        => 'title_type',
					'value'             => array(
						__( 'Default', 'athen_transl' )     => '',
						__( 'Title', 'athen_transl' )       => 'title',
						__( 'Alt', 'athen_transl' )         => 'alt',
						__( 'Caption', 'athen_transl' )     => 'caption',
						__( 'Description', 'athen_transl' ) => 'description',
					),
					'edit_field_class'  => 'vc_col-sm-6 vc_column',
					'group'             => __( 'Title', 'athen_transl' ),
					'dependency'        => Array(
						'element'   => 'title',
						'value'     => array( 'yes' )
					),
				),
				array(
					'type'          => 'colorpicker',
					'heading'       => __( 'Title Color', 'athen_transl' ),
					'param_name'    => 'title_color',
					'group'         => __( 'Title', 'athen_transl' ),
				),
				array(
					'type'              => 'textfield',
					'heading'           => __( 'Title Font Size', 'athen_transl' ),
					'param_name'        => 'title_size',
					'group'             => __( 'Title', 'athen_transl' ),
					'description'       => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
					'edit_field_class'  => 'vc_col-sm-4 vc_column',
				),
				array(
					'type'              => 'textfield',
					'heading'           => __( 'Title Line Height', 'athen_transl' ),
					'param_name'        => 'title_line_height',
					'description'       => __( 'Enter a numerical, pixel or percentage value.', 'athen_transl' ),
					'group'             => __( 'Title', 'athen_transl' ),
					'edit_field_class'  => 'vc_col-sm-4 vc_column',
				),
				array(
					'type'              => 'textfield',
					'heading'           => __( 'Title Margin', 'athen_transl' ),
					'param_name'        => 'title_margin',
					'group'             => __( 'Title', 'athen_transl' ),
					'description'       => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
					'edit_field_class'  => 'vc_col-sm-4 vc_column',
				),
				array(
					'type'              => 'dropdown',
					'heading'           => __( 'Title Font Weight', 'athen_transl' ),
					'param_name'        => 'title_weight',
					'group'             => __( 'Title', 'athen_transl' ),
					'description'       => __( 'Note: Not all font families support every font weight.', 'athen_transl' ),
					'std'               => '',
					'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
					'value'             => vcex_font_weights(),
				),
				array(
					'type'              => 'dropdown',
					'heading'           => __( 'Title Text Transform', 'athen_transl' ),
					'param_name'        => 'title_transform',
					'group'             => __( 'Title', 'athen_transl' ),
					'std'               => '',
					'description'       => __( 'Select a custom text transform to override the default.', 'athen_transl' ),
					'edit_field_class'  => 'vc_col-sm-6 vc_column',
					'value'             => vcex_text_transforms(),
				),

				// Design Options
				array(
					'type'          => 'css_editor',
					'heading'       => __( 'CSS', 'athen_transl' ),
					'param_name'    => 'css',
					'description'   => __( 'These settings are applied to the main wrapper and they will override any other styling options.', 'athen_transl' ),
					'group'         => __( 'Design options', 'athen_transl' ),
				),

			)
		) );
	}
}
add_action( 'vc_before_init', 'vcex_image_grid_shortcode_vc_map' );