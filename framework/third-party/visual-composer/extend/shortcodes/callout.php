<?php
/**
 * Registers the callout shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_callout extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_callout.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_callout_shortcode_vc_map' ) ) {
    function vcex_callout_shortcode_vc_map() {
        vc_map( array(
            'name'          => __( 'Callout', 'athen_transl' ),
            'description'   => __( 'Call to action section with or without button', 'athen_transl' ),
            'base'          => 'vcex_callout',
            'icon'          => 'vcex-callout',
            'category'      => ATHEN_NAME_THEME,
            'params'        => array(
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
                    'value'             => vcex_visibility(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Appear Animation', 'athen_transl' ),
                    'param_name'        => 'css_animation',
                    'value'             => vcex_css_animations(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),

                // Content
                array(
                    'type'          => 'textarea_html',
                    'holder'        => 'div',
                    'class'         => 'vcex-callout',
                    'heading'       => __( 'Callout Content', 'athen_transl' ),
                    'param_name'    => 'content',
                    'value'         => __( 'Enter your content here.', 'athen_transl' ),
                    'group'         => __( 'Content', 'athen_transl' ),
                ),

                // Button
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Button: URL', 'athen_transl' ),
                    'param_name'    => 'button_url',
                    'group'         => __( 'Button', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Button: Text', 'athen_transl' ),
                    'param_name'    => 'button_text',
                    'group'         => __( 'Button', 'athen_transl' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Button Style', 'athen_transl' ),
                    'param_name'        => 'button_style',
                    'value'             => vcex_button_styles(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'group'             => __( 'Button', 'athen_transl' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Button: Color', 'athen_transl' ),
                    'param_name'        => 'button_color',
                    'std'               => '',
                    'value'             => vcex_button_colors(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'group'             => __( 'Button', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Button: Border Radius', 'athen_transl' ),
                    'param_name'    => 'button_border_radius',
                    'description'   => __( 'Please enter a px value.', 'athen_transl' ),
                    'group'         => __( 'Button', 'athen_transl' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Button: Link Target', 'athen_transl' ),
                    'param_name'        => 'button_target',
                    'value'             => array(
                        __( 'Self', 'athen_transl' )    => '',
                        __( 'Blank', 'athen_transl' )   => 'blank',
                    ),
                    'group'             => __( 'Button', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Button: Rel', 'athen_transl' ),
                    'param_name'        => 'button_rel',
                    'value'             => array(
                        __( 'None', 'athen_transl' )        => 'none',
                        __( 'Nofollow', 'athen_transl' )    => 'nofollow',
                    ),
                    'group'             => __( 'Button', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Button: Icon Left', 'athen_transl' ),
                    'param_name'        => 'button_icon_left',
                    'value'             => athen_get_awesome_icons(),
                    'group'             => __( 'Button', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Button: Icon Right', 'athen_transl' ),
                    'param_name'        => 'button_icon_right',
                    'value'             => athen_get_awesome_icons(),
                    'group'             => __( 'Button', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'          => 'css_editor',
                    'heading'       => __( 'CSS', 'athen_transl' ),
                    'param_name'    => 'css',
                    'group'         => __( 'Design options', 'athen_transl' ),
                ),
            )
        ) );
    }
}
add_action( 'vc_before_init', 'vcex_callout_shortcode_vc_map' );