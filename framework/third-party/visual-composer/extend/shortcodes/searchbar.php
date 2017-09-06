<?php
/**
 * Registers the searchbar shortcode and adds it to the Visual Composer
 *
 * @package     Total
 * @subpackage  Framework/Visual Composer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       2.1.0
 * @version     2.1.0
 */

/**
 * Register shortcode with VC Composer
 *
 * @since Total 2.1.0
 */
class WPBakeryShortCode_vcex_searchbar extends WPBakeryShortCode {
	protected function content( $atts, $content = null ) {
		ob_start();
		include( locate_template( 'vcex_templates/vcex_searchbar.php' ) );
		return ob_get_clean();
	}
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 2.1.0
 */
if ( ! function_exists( 'vcex_searchbar_shortcode_vc_map' ) ) {
	function vcex_searchbar_shortcode_vc_map() {

		// Add new shortcode to the Visual Composer
		vc_map( array(
			'name'                  => __( 'Search Bar', 'athen_transl' ),
			'description'           => __( 'Custom search form', 'athen_transl' ),
			'base'                  => 'vcex_searchbar',
			'icon'                  => 'vcex-searchbar',
			'category'              => ATHEN_NAME_THEME,
			'params'                => array(

				// General
				array(
                    'type'          => 'textfield',
                    'admin_label'   => true,
                    'heading'       => __( 'Unique Id', 'athen_transl' ),
                    'description'   => __( 'Give your main element a unique ID.', 'athen_transl' ),
                    'param_name'    => 'unique_id',
                ),
                array(
                    'type'          => 'textfield',
                    'admin_label'   => true,
                    'heading'       => __( 'Classes', 'athen_transl' ),
                    'description'   => __( 'Add additonal classes to the main element.', 'athen_transl' ),
                    'param_name'    => 'classes',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Visibility', 'athen_transl' ),
                    'param_name'        => 'visibility',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                    'value'             => vcex_visibility(),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Appear Animation', 'athen_transl'),
                    'param_name'        => 'css_animation',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'value'             => vcex_css_animations(),
                ),
				array(
					'type'       => 'textfield',
					'heading'    => __( 'Placeholder', 'athen_transl' ),
					'param_name' => 'placeholder',
				),

				// Query
				array(
					'type'          => 'textfield',
					'heading'       => __( 'Advanced Search', 'athen_transl' ),
					'param_name'    => 'advanced_query',
					'group'         => __( 'Query', 'athen_transl' ),
					'description'	=> __( 'Example: ', 'athen_transl' ) . 'post_type=portfolio&taxonomy=portfolio_category&term=advertising',
				),

				// Widths
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Input Width', 'athen_transl' ),
					'param_name'  => 'input_width',
					'group'       => __( 'Widths', 'athen_transl' ),
					'description' => __( 'Default:', 'athen_transl' ) .'70%',
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Button Width', 'athen_transl' ),
					'param_name'  => 'button_width',
					'group'       => __( 'Widths', 'athen_transl' ),
					'description' => __( 'Default:', 'athen_transl' ) .'28%',
				),

				// Input
				array(
					'type'       => 'colorpicker',
					'heading'    => __( 'Color', 'athen_transl' ),
					'param_name' => 'input_color',
					'group'      => __( 'Input', 'athen_transl' ),
				),
				array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Font Size', 'athen_transl' ),
                    'param_name'        => 'input_font_size',
                    'description'       => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
                    'group'             => __( 'Input', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Letter Spacing', 'athen_transl' ),
                    'param_name'        => 'input_letter_spacing',
                    'description'       => __( 'Please enter a px value.', 'athen_transl' ),
                    'group'             => __( 'Input', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Text Transform', 'athen_transl' ),
                    'param_name'        => 'input_text_transform',
                    'group'             => __( 'Input', 'athen_transl' ),
                    'value'             => vcex_text_transforms(),
                    'std'               => '',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Font Weight', 'athen_transl' ),
                    'param_name'        => 'input_font_weight',
                    'value'             => vcex_font_weights(),
                    'std'               => '',
                    'group'             => __( 'Input', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
				array(
					'type'       => 'css_editor',
					'heading'    => __( 'Design', 'athen_transl' ),
					'param_name' => 'css',
					'group'      => __( 'Input', 'athen_transl' ),
				),

				// Submit
				array(
					'type'       => 'colorpicker',
					'heading'    => __( 'Background', 'athen_transl' ),
					'param_name' => 'button_bg',
					'group'      => __( 'Submit', 'athen_transl' ),
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => __( 'Background: Hover', 'athen_transl' ),
					'param_name' => 'button_bg_hover',
					'group'      => __( 'Submit', 'athen_transl' ),
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => __( 'Color', 'athen_transl' ),
					'param_name' => 'button_color',
					'group'      => __( 'Submit', 'athen_transl' ),
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => __( 'Color: Hover', 'athen_transl' ),
					'param_name' => 'button_color_hover',
					'group'      => __( 'Submit', 'athen_transl' ),
				),
				array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Font Size', 'athen_transl' ),
                    'param_name'        => 'button_font_size',
                    'description'       => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
                    'group'             => __( 'Submit', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Letter Spacing', 'athen_transl' ),
                    'param_name'        => 'button_letter_spacing',
                    'description'       => __( 'Please enter a px value.', 'athen_transl' ),
                    'group'             => __( 'Submit', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Text Transform', 'athen_transl' ),
                    'param_name'        => 'button_text_transform',
                    'group'             => __( 'Submit', 'athen_transl' ),
                    'value'             => vcex_text_transforms(),
                    'std'               => '',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Font Weight', 'athen_transl' ),
                    'param_name'        => 'button_font_weight',
                    'value'             => vcex_font_weights(),
                    'std'               => '',
                    'group'             => __( 'Submit', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
			)
		) );

	}
}
add_action( 'vc_before_init', 'vcex_searchbar_shortcode_vc_map' );