<?php
/**
 * Adds the staff social shortcode to the Visual Composer
 *
 * @package		Total
 * @subpackage	Framework/Visual Composer
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		Total 1.4.1
 * @version     2.0.0
 */

// Return if post type is disabled
if ( ! ATHEN_CHECK_STAFF ) {
    return;
}

if ( ! function_exists( 'vcex_staff_social_vc_map' ) ) {
	function vcex_staff_social_vc_map() {
		vc_map( array(
			'name'			=> __( 'Staff Social Links', 'athen_transl' ),
			'description'	=> __( 'Single staff social links', 'athen_transl' ),
			'base'			=> 'staff_social',
			'category'		=> ATHEN_NAME_THEME,
			'icon'			=> 'vcex-staff-social',
			'params'		=> array(
				array(
					'type'			=> 'dropdown',
					'class'			=> '',
					'heading'		=> __( 'Link Target', 'athen_transl' ),
					'param_name'	=> 'link_target',
					'value'			=> array(
						__( 'Self', 'athen_transl')		=> 'self',
						__( 'Blank', 'athen_transl' )	=> 'blank',
					),
					'description'	=> __( 'Select to open your social links in the same or new tab.', 'athen_transl')
				),
			)
		) );
	}
}
add_action( 'vc_before_init', 'vcex_staff_social_vc_map' );