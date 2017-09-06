<?php
/**
 * Registers the Terms Grid shortcode and adds it to the Visual Composer
 *
 * @package     Total
 * @subpackage  Framework/Visual Composer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       2.1.0
 * @version     1.0.0
 */

/**
 * Register shortcode with VC Composer
 *
 * @since 2.1.0
 */
class WPBakeryShortCode_vcex_terms_grid extends WPBakeryShortCode {
	protected function content( $atts, $content = null ) {
		ob_start();
		include( locate_template( 'vcex_templates/vcex_terms_grid.php' ) );
		return ob_get_clean();
	}
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since 2.1.0
 */
if ( ! function_exists( 'vcex_terms_grid_shortcode_vc_map' ) ) {
	function vcex_terms_grid_shortcode_vc_map() {

		// Get global vcex object
		global $vcex_global;

		// Get arrays
		$taxonomies_list = $vcex_global->taxonomies;
		/*$terms_list      = $vcex_global->terms;*/

		vc_map( array(
			'name'                  => __( 'Categories Grid', 'athen_transl' ),
			'description'           => __( 'Displays a grid of terms', 'athen_transl' ),
			'base'                  => 'vcex_terms_grid',
			'category'              => ATHEN_NAME_THEME,
			'icon'                  => 'vcex-terms-grid',
			'params'                => array(

				// General
				array(
					'type'          => 'autocomplete',
					'heading'       => __( 'Taxonomy', 'athen_transl' ),
					'param_name'    => 'taxonomy',
					'dependency'    => array(
						'element'   => 'tax_query',
						'value'     => 'true',
					),
					'std'           => 'category',
					'settings'              => array(
						'multiple'          => false,
						'min_length'        => 1,
						'groups'            => false,
						'unique_values'     => true,
						'display_inline'    => true,
						'delay'             => 0,
						'auto_focus'        => true,
						'values'            => $taxonomies_list,
					),
				),
				/*array(
					'type'          => 'autocomplete',
					'heading'       => __( 'Parent Term', 'athen_transl' ),
					'param_name'    => 'parent_term',
					'dependency'    => array(
						'element'   => 'tax_query',
						'value'     => 'true',
					),
					'settings'              => array(
						'multiple'          => false,
						'min_length'        => 1,
						'groups'            => true,
						'unique_values'     => true,
						'display_inline'    => true,
						'delay'             => 0,
						'auto_focus'        => true,
						'values'            => $terms_list,
					),
				),*/
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
					'type'          => 'dropdown',
					'heading'       => __( 'CSS Animation', 'athen_transl' ),
					'param_name'    => 'css_animation',
					'value'         => array(
						__( 'No', 'athen_transl' )                   => '',
						__( 'Top to bottom', 'athen_transl' )       => 'top-to-bottom',
						__( 'Bottom to top', 'athen_transl' )       => 'bottom-to-top',
						__( 'Left to right', 'athen_transl' )       => 'left-to-right',
						__( 'Right to left', 'athen_transl' )       => 'right-to-left',
						__( 'Appear from center', 'athen_transl' )  => 'appear' ),
				),
				array(
					'type'          => 'dropdown',
					'heading'       => __( 'Visibility', 'athen_transl' ),
					'param_name'    => 'visibility',
					'value'         => vcex_visibility(),
				),
				array(
					'type'              => 'dropdown',
					'heading'           => __( 'Columns', 'athen_transl' ),
					'param_name'        => 'columns',
					'value'             => vcex_grid_columns(),
					'std'               => '3',
					'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
				),
				array(
					'type'              => 'dropdown',
					'heading'           => __( 'Gap', 'athen_transl' ),
					'param_name'        => 'columns_gap',
					'value'             => vcex_column_gaps(),
					'edit_field_class'  => 'vc_col-sm-4 vc_column',
				),
				array(
					'type'              => 'dropdown',
					'heading'           => __( 'Responsive', 'athen_transl' ),
					'param_name'        => 'columns_responsive',
					'value'             => array(
						__( 'Yes', 'athen_transl' ) => '',
						__( 'No', 'athen_transl' )  => 'false',
					),
					'std'               => '',
					'edit_field_class'  => 'vc_col-sm-4 vc_column',
				),

				// Image
				array(
					'type'          => 'dropdown',
					'heading'       => __( 'Image Size', 'athen_transl' ),
					'param_name'    => 'img_size',
					'std'           => 'full',
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
					'type'          => 'textfield',
					'heading'       => __( 'Image Crop Width', 'athen_transl' ),
					'param_name'    => 'img_width',
					'dependency'    => array(
						'element'   => 'img_size',
						'value'     => 'athen_custom',
					),
					'edit_field_class'  => 'vc_col-sm-6 vc_column',
					'description'   => __( 'Enter a width in pixels.', 'athen_transl' ),
					'group'         => __( 'Image', 'athen_transl' ),
				),
				array(
					'type'          => 'textfield',
					'heading'       => __( 'Image Crop Height', 'athen_transl' ),
					'param_name'    => 'img_height',
					'edit_field_class'  => 'vc_col-sm-6 vc_column',
					'dependency'    => array(
						'element'   => 'img_size',
						'value'     => 'athen_custom',
					),
					'description'   => __( 'Enter a height in pixels. Leave empty to disable vertical cropping and keep image proportions.', 'athen_transl' ),
					'group'         => __( 'Image', 'athen_transl' ),
				),
				array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'CSS3 Image Link Hover', 'athen_transl' ),
                    'param_name'        => 'img_hover_style',
                    'value'             => vcex_image_hovers(),
                    'group'             => __( 'Image', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Image Filter', 'athen_transl' ),
                    'param_name'        => 'img_filter',
                    'value'             => vcex_image_filters(),
                    'group'             => __( 'Image', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),

				// Title
				array(
					'type'       => 'font_container',
					//'heading'    => __( 'Title Typography', 'athen_transl' ),
					'param_name' => 'title_typo',
					'group'      => __( 'Title', 'athen_transl' ),
					'settings'   => array(
						'fields' => array(
							'tag',
							//'text_align',
							'font_size',
							'line_height',
							'color',
							'font_style_italic',
							'font_style_bold',
							'font_family',
						),
					),
				),

				// Description
				array(
					'type'       => 'font_container',
					//'heading'    => __( 'Title Typography', 'athen_transl' ),
					'param_name' => 'description_typo',
					'group'      => __( 'Description', 'athen_transl' ),
					'settings'   => array(
						'fields' => array(
							'font_size',
							//'text_align',
							'line_height',
							'color',
							'font_style_italic',
							'font_style_bold',
							'font_family',
						),
					),
				),

			)

		) );
	}
}
add_action( 'vc_before_init', 'vcex_terms_grid_shortcode_vc_map' );