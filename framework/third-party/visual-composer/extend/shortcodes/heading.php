<?php
/**
 * Registers the bullets shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_heading extends WPBakeryShortCode {
	protected function content( $atts, $content = null ) {
		ob_start();
		include( locate_template( 'vcex_templates/vcex_heading.php' ) );
		return ob_get_clean();
	}
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_heading_shortcode_vc_map' ) ) {
	function vcex_heading_shortcode_vc_map() {

		// Register to VC
		vc_map( array(
			'name'        => __( 'Heading', 'athen_transl' ),
			'description' => __( 'A better heading module', 'athen_transl' ),
			'base'        => 'vcex_heading',
			'category'    => ATHEN_NAME_THEME,
			'icon'        => 'vcex-heading',
			'params'      => array(

				// General 
				array(
					'type'        => 'textarea',
					'heading'     => __( 'Text', 'athen_transl' ),
					'param_name'  => 'text',
					'admin_label' => true,
				),
				array(
					'type'        => 'dropdown',
					'heading'     => __( 'Font Family', 'athen_transl' ),
					'param_name'  => 'font_family',
					'std'         => '',
					'value'       => vcex_fonts_array(),
					'description' => __( 'After selecting a font click on the save changes button to preview your font.', 'athen_transl' ),
				),
				array(
					'type'              => 'dropdown',
					'heading'           => __( 'Tag', 'athen_transl' ),
					'param_name'        => 'tag',
					'value'     => array(
						__( 'Default', 'athen_transl' ) => '',
						'h1'                    => 'h1',
						'h2'                    => 'h2',
						'h3'                    => 'h3',
						'h4'                    => 'h4',
						'h5'                    => 'h5',
						'div'                   => 'div',
						'span'                  => 'span',
					),
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Font Size', 'athen_transl' ),
					'param_name'  => 'font_size',
					'description' => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
				),
				array(
					'type'        => 'textfield',
					'heading'     => __( 'Letter Spacing', 'athen_transl' ),
					'param_name'  => 'letter_spacing',
					'description' => __( 'Please enter a px value.', 'athen_transl' ),
				),
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Font Weight', 'athen_transl' ),
					'param_name' => 'font_weight',
					'value'      => vcex_font_weights(),
					'std'        => '',
				),
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Text Align', 'athen_transl' ),
					'param_name' => 'text_align',
					'value'      => vcex_alignments(),
					'std'        => '',
				),
				array(
					'type'		 => 'dropdown',
					'heading'	 => __( 'Appear Animation', 'athen_transl' ),
					'param_name' => 'css_animation',
					'value'		 => vcex_css_animations(),
					'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
				),
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Color', 'athen_transl' ),
					'param_name'  => 'color',
				),
				array(
					'type'        => 'colorpicker',
					'heading'     => __( 'Color: Hover', 'athen_transl' ),
					'param_name'  => 'color_hover',
				),


				// Link
				array(
					'type'       => 'vc_link',
					'heading'    => __( 'URL', 'athen_transl' ),
					'param_name' => 'link',
					'group'      => __( 'Link', 'athen_transl' ),
				),
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Link: Local Scroll', 'athen_transl' ),
					'param_name' => 'link_local_scroll',
					'value'      => array(
						__( 'False', 'athen_transl' ) => '',
						__( 'True', 'athen_transl' )  => 'true',
					),
					'group'      => __( 'Link', 'athen_transl' ),
				),

				// Design
				array(
					'type'       => 'css_editor',
					'heading'    => __( 'Design', 'athen_transl' ),
					'param_name' => 'css',
					'group'      => __( 'Design', 'athen_transl' ),
				),
				array(
					'type'       => 'colorpicker',
					'heading'    => __( 'Background: Hover', 'athen_transl' ),
					'param_name' => 'background_hover',
					'group'      => __( 'Design', 'athen_transl' ),
				),

			)
		) );
	}
}
add_action( 'vc_before_init', 'vcex_heading_shortcode_vc_map' );