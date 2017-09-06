<?php
/**
 * Registers the skillbar shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_skillbar extends WPBakeryShortCode {
	protected function content( $atts, $content = null ) {
		ob_start();
		include( locate_template( 'vcex_templates/vcex_skillbar.php' ) );
		return ob_get_clean();
	}
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_skillbar_shortcode_vc_map' ) ) {
	function vcex_skillbar_shortcode_vc_map() {
		vc_map( array(
			'name'                  => __( 'Skill Bar', 'athen_transl' ),
			'description'           => __( 'Animated skill bar', 'athen_transl' ),
			'base'                  => 'vcex_skillbar',
			'category'              => ATHEN_NAME_THEME,
			'icon'                  => 'vcex-skill-bar',
			'params'                => array(

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
					'type'          => 'textfield',
					'heading'       => __( 'Title', 'athen_transl' ),
					'param_name'    => 'title',
					'admin_label'   => true,
					'value'         => 'Web Design',
				),
				array(
					'type'          => 'textfield',
					'heading'       => __( 'Percentage', 'athen_transl' ),
					'param_name'    => 'percentage',
					'value'         => '70',
				),
				array(
					'type'          => 'dropdown',
					'heading'       => __( 'Display % Number', 'athen_transl' ),
					'param_name'    => 'show_percent',
					'value'         => array(
						__( 'Yes', 'athen_transl' )	=> '',
						__( 'No', 'athen_transl' )	=> 'false',
					),
				),

				// Icon
				array(
					'type'          => 'dropdown',
					'heading'       => __( 'Display Icon', 'athen_transl' ),
					'param_name'    => 'show_icon',
					'value'         => array(
						__( 'Yes', 'athen_transl' )	=> '',
						__( 'No', 'athen_transl' )	=> 'false',
					),
					'group'			=> __( 'Icon', 'athen_transl' ),
				),
				array(
					'type'          => 'dropdown',
					'heading'       => __( 'Icon library', 'athen_transl' ),
					'param_name'    => 'icon_type',
					'description'   => __( 'Select icon library.', 'athen_transl' ),
					'value'         => array(
						__( 'Font Awesome', 'athen_transl' ) => 'fontawesome',
						__( 'Open Iconic', 'athen_transl' )  => 'openiconic',
						__( 'Typicons', 'athen_transl' )     => 'typicons',
						__( 'Entypo', 'athen_transl' )       => 'entypo',
						__( 'Linecons', 'athen_transl' )     => 'linecons',
						__( 'Pixel', 'athen_transl' )        => 'pixelicons',
					),
					'group'			=> __( 'Icon', 'athen_transl' ),
				),
				array(
					'type'          => 'iconpicker',
					'heading'       => __( 'Icon', 'athen_transl' ),
					'param_name'    => 'icon',
					'settings'      => array(
						'emptyIcon'		=> true,
						'iconsPerPage'	=> 200,
					),
					'dependency'    => array(
						'element'   => 'icon_type',
						'value'     => 'fontawesome',
					),
					'group'			=> __( 'Icon', 'athen_transl' ),
				),
				array(
					'type'          => 'iconpicker',
					'heading'       => __( 'Icon', 'athen_transl' ),
					'param_name'    => 'icon_openiconic',
					'settings'      => array(
						'emptyIcon'		=> true,
						'iconsPerPage'	=> 200,
						'type'			=> 'openiconic',
					),
					'dependency'    => array(
						'element'   => 'icon_type',
						'value'     => 'openiconic',
					),
					'group'			=> __( 'Icon', 'athen_transl' ),
				),
				array(
					'type'          => 'iconpicker',
					'heading'       => __( 'Icon', 'athen_transl' ),
					'param_name'    => 'icon_typicons',
					'settings'      => array(
						'emptyIcon'		=> true,
						'iconsPerPage'	=> 200,
						'type'          => 'typicons',
					),
					'dependency'    => array(
						'element'   => 'icon_type',
						'value'     => 'typicons',
					),
					'group'			=> __( 'Icon', 'athen_transl' ),
				),
				array(
					'type'          => 'iconpicker',
					'heading'       => __( 'Icon', 'athen_transl' ),
					'param_name'    => 'icon_entypo',
					'settings'      => array(
						'emptyIcon'     => false,
						'type'          => 'entypo',
						'iconsPerPage'  => 300,
					),
					'dependency'    => array(
						'element'   => 'icon_type',
						'value'     => 'entypo',
					),
					'group'			=> __( 'Icon', 'athen_transl' ),
				),
				array(
					'type'          => 'iconpicker',
					'heading'       => __( 'Icon', 'athen_transl' ),
					'param_name'    => 'icon_linecons',
					'settings'      => array(
						'emptyIcon'		=> true,
						'iconsPerPage'	=> 200,
						'type'          => 'linecons',
					),
					'dependency'    => array(
						'element'   => 'icon_type',
						'value'     => 'linecons',
					),
					'group'			=> __( 'Icon', 'athen_transl' ),
				),
				array(
					'type'          => 'iconpicker',
					'heading'       => __( 'Icon', 'athen_transl' ),
					'param_name'    => 'icon_pixelicons',
					'settings'      => array(
						'emptyIcon'		=> true,
						'iconsPerPage'	=> 200,
						'type'      	=> 'pixelicons',
						'source'    	=> vcex_pixel_icons(),
					),
					'dependency'    => array(
						'element'   => 'icon_type',
						'value'     => 'pixelicons',
					),
					'group'			=> __( 'Icon', 'athen_transl' ),
				),

				// Design
					array(
					'type'			=> 'colorpicker',
					'heading'		=> __( 'Container Background', 'athen_transl' ),
					'param_name'	=> 'background',
					'group'			=> __( 'Design', 'athen_transl' ),
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> __( 'Container Inset Shadow', 'athen_transl' ),
					'param_name'	=> 'box_shadow',
					'value'			=> array(
						__( 'Yes', 'athen_transl' )	=> '',
						__( 'No', 'athen_transl' )	=> 'false',
					),
					'group'			=> __( 'Design', 'athen_transl' ),
				),
				array(
					'type'			=> 'colorpicker',
					'heading'		=> __( 'Skill Bar Color', 'athen_transl' ),
					'param_name'	=> 'color',
					'group'			=> __( 'Design', 'athen_transl' ),
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> __( 'Container Height', 'athen_transl' ),
					'param_name'	=> 'container_height',
					'description'	=> __( 'Please enter a px value.', 'athen_transl' ),
					'group'			=> __( 'Design', 'athen_transl' ),
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> __( 'Font Size', 'athen_transl' ),
					'param_name'	=> 'font_size',
					'description'	=> __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
					'group'			=> __( 'Design', 'athen_transl' ),
				),

			)
		) );
	}
}
add_action( 'vc_before_init', 'vcex_skillbar_shortcode_vc_map' );