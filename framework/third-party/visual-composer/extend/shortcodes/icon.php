<?php
/**
 * Registers the icon shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_icon extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_icon.php' ) );
        return ob_get_clean();
    }
}

/**
 * Parse shortcode attributes and set correct values
 *
 * @since 2.0.0
 */
function parse_vcex_icon_atts( $atts ) {

    // Convert textfield link to vc_link
    if ( ! empty( $atts['link_url'] ) && false === strpos( $atts['link_url'], 'url:' ) ) {
        $url                = 'url:'. $atts['link_url'] .'|';
        $link_title         = isset( $atts['link_title'] ) ? 'title:' . $atts['link_title'] .'|' : '|';
        $link_target        = ( isset( $atts['link_target'] ) && 'blank' == $atts['link_target'] ) ? 'target:_blank' : '';
        $atts['link_url']   = $url . $link_title . $link_target;
    }

    // Update link target
    if ( isset( $atts['link_target'] ) && 'local' == $atts['link_target'] ) {
        $atts['link_local_scroll'] = 'true';
    }

    // Return $atts
    return $atts;
}
add_filter( 'vc_edit_form_fields_attributes_vcex_icon', 'parse_vcex_icon_atts' );

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_icon_shortcode_vc_map' ) ) {
    function vcex_icon_shortcode_vc_map() {
        vc_map( array(
            'name'          => __( 'Font Icon', 'athen_transl' ),
            'description'   => __( 'Font Icon from various libraries', 'athen_transl' ),
            'base'          => 'vcex_icon',
            'icon'          => 'vcex-font-icon',
            'category'      => ATHEN_NAME_THEME,
            'params'        => array(

                // General
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Unique Id', 'athen_transl' ),
                    'description'   => __( 'Give your main element a unique ID.', 'athen_transl' ),
                    'param_name'    => 'unique_id',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Classes', 'athen_transl' ),
                    'param_name'    => 'el_class',
                    'description'   => __( 'Add extra classnames to the wrapper.', 'athen_transl' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Appear Animation', 'athen_transl'),
                    'param_name'        => 'css_animation',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'value'             => vcex_css_animations(),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Hover Animation', 'athen_transl'),
                    'param_name'        => 'hover_animation',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'value'             => vcex_hover_animations(),
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
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon', 'athen_transl' ),
                    'param_name'    => 'icon',
                    'admin_label'   => true,
                    'value'         => 'fa fa-info-circle',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'fontawesome',
                    ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon', 'athen_transl' ),
                    'param_name'    => 'icon_openiconic',
                    'std'           => '',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'openiconic',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'openiconic',
                    ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon', 'athen_transl' ),
                    'param_name'    => 'icon_typicons',
                    'std'           => '',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'typicons',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'typicons',
                    ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon', 'athen_transl' ),
                    'param_name'    => 'icon_entypo',
                    'std'           => '',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'entypo',
                        'iconsPerPage'  => 300,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'entypo',
                    ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon', 'athen_transl' ),
                    'param_name'    => 'icon_linecons',
                    'std'           => '',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'linecons',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'linecons',
                    ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon', 'athen_transl' ),
                    'param_name'    => 'icon_pixelicons',
                    'std'           => '',
                    'settings'      => array(
                        'emptyIcon' => true,
                        'type'      => 'pixelicons',
                        'source'    => vcex_pixel_icons(),
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'pixelicons',
                    ),
                ),

                // Icon Design
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Color', 'athen_transl' ),
                    'param_name'    => 'color',
                    'group'         => __( 'Icon Design', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Icon Hover Color', 'athen_transl' ),
                    'param_name'    => 'color_hover',
                    'group'         => __( 'Icon Design', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Background', 'athen_transl' ),
                    'param_name'    => 'background',
                    'group'         => __( 'Icon Design', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Background: Hover', 'athen_transl' ),
                    'param_name'    => 'background_hover',
                    'group'         => __( 'Icon Design', 'athen_transl' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Icon Size', 'athen_transl' ),
                    'param_name'        => 'size',
                    'std'               => 'normal',
                    'value'             => array(
                        __( 'Inherit', 'athen_transl' )     => '',
                        __( 'Extra Large', 'athen_transl' ) => 'xlarge',
                        __( 'Large', 'athen_transl' )       => 'large',
                        __( 'Normal', 'athen_transl' )      => 'normal',
                        __( 'Small', 'athen_transl')        => 'small',
                        __( 'Tiny', 'athen_transl' )        => 'tiny',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                    'group'             => __( 'Icon Design', 'athen_transl' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Position', 'athen_transl' ),
                    'param_name'        => 'float',
                    'value'             => vcex_alignments(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'group'             => __( 'Icon Design', 'athen_transl' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Custom Icon Size', 'athen_transl' ),
                    'param_name'        => 'custom_size',
                    'description'       => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
                    'group'             => __( 'Icon Design', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Border Radius', 'athen_transl' ),
                    'param_name'    => 'border_radius',
                    'description'   => __( 'Enter a pixel value for the border radius or enter 50% for a circle', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'group'         => __( 'Icon Design', 'athen_transl' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Width', 'athen_transl' ),
                    'param_name'        => 'width',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                    'description'       => __( 'Please enter a px value.', 'athen_transl' ),
                    'group'             => __( 'Icon Design', 'athen_transl' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Height', 'athen_transl' ),
                    'param_name'        => 'height',
                    'description'       => __( 'Please enter a px value.', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'group'             => __( 'Icon Design', 'athen_transl' ),
                ),

                // Link
                array(
                    'type'          => 'vc_link',
                    'heading'       => __( 'Link', 'athen_transl' ),
                    'param_name'    => 'link_url',
                    'group'         => __( 'Link', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Link: Local Scroll', 'athen_transl' ),
                    'param_name'    => 'link_local_scroll',
                    'value'         => array(
                        __( 'False', 'athen_transl' )   => '',
                        __( 'True', 'athen_transl' )    => 'true',
                    ),
                    'group'         => __( 'Link', 'athen_transl' ),
                ),

                // Design Options
                /*array(
                    'type'          => 'css_editor',
                    'heading'       => __( 'CSS', 'athen_transl' ),
                    'param_name'    => 'css',
                    'description'   => __( 'These settings are applied to the main wrapper and they will override any other styling options.', 'athen_transl' ),
                    'group'         => __( 'Wrapper Design', 'athen_transl' ),
                ),*/
            )
        ) );
    }
}
add_action( 'vc_before_init', 'vcex_icon_shortcode_vc_map' );