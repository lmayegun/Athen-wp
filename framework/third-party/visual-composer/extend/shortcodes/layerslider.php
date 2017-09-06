<?php
/**
 * Registers the layerslider shortcode and adds it to the Visual Composer
 *
 * @package		Total
 * @subpackage	Framework/Visual Composer
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		Total 1.4.1
 * @version     2.0.0
 */

// Return if plugin is disabled
if ( ! ATHEN_CHECK_LAYERSLIDER ) {
	return;
}

if ( ! function_exists( 'vcex_layerslider_shortcode_vc_map' ) ) {
	function vcex_layerslider_shortcode_vc_map() {
		vc_map( array(
			'name'					=> __( 'LayerSlider', 'athen_transl' ),
			'description'			=> __( 'Insert a LayerSlider slider via ID', 'athen_transl' ),
			'base'					=> 'layerslider',
			'category'				=> ATHEN_NAME_THEME,
			'icon'					=> 'vcex-layerslider',
			'params'				=> array(
				array(
					'type'			=> 'textfield',
					'holder'		=> 'div',
					'heading'		=> __( 'Enter your slider ID', 'athen_transl' ),
					'param_name'	=> 'id',
					'std'			=> '1',
				),
			)
		) );
	}
}
add_action( 'vc_before_init', 'vcex_layerslider_shortcode_vc_map' );