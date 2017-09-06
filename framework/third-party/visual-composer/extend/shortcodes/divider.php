<?php
/**
 * Registers the divider shortcode and adds it to the Visual Composer
 *
 * @package     Total
 * @subpackage  Framework/Visual Composer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       1.4.1
 * @version     2.0.0
 */

/**
 * Register shortcode with VC Composer
 *
 * @since 2.0.0
 */
class WPBakeryShortCode_vcex_divider extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_divider.php' ) );
        return ob_get_clean();
    }
}

/**
 * Parse shortcode attributes and set correct values
 *
 * @since 2.0.0
 */
function parse_vcex_divider_atts( $atts ) {

    // Set font family if icon is defined
    if ( isset( $atts['icon'] ) && empty( $atts['icon_type'] ) ) {
        $atts['icon_type']  = 'fontawesome';
        $atts['icon']       = 'fa fa-'. $atts['icon'];
    }

    // Return $atts
    return $atts;
}
add_filter( 'vc_edit_form_fields_attributes_vcex_divider', 'parse_vcex_divider_atts' );

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_divider_shortcode_vc_map' ) ) {
    function vcex_divider_shortcode_vc_map() {
        vc_map( array(
            'name'                  => __( 'Divider', 'athen_transl' ),
            'description'           => __( 'Line seperator', 'athen_transl' ),
            'base'                  => 'vcex_divider',
            'icon'                  => 'vcex-divider',
            'category'              => ATHEN_NAME_THEME,
            'params'                => array(

                // General
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Classes', 'athen_transl' ),
                    'param_name'    => 'el_class',
                    'description'   => __( 'Add additonal classes to the main element.', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Appear Animation', 'athen_transl' ),
                    'param_name'    => 'css_animation',
                    'value'         => array(
                        __( 'No', 'athen_transl' )                  => '',
                        __( 'Top to bottom', 'athen_transl' )       => 'top-to-bottom',
                        __( 'Bottom to top', 'athen_transl' )       => 'bottom-to-top',
                        __( 'Left to right', 'athen_transl' )       => 'left-to-right',
                        __( 'Right to left', 'athen_transl' )       => 'right-to-left',
                        __( 'Appear from center', 'athen_transl' )  => 'appear'
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Visibility', 'athen_transl' ),
                    'param_name'    => 'visibility',
                    'value'         => vcex_visibility(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'          => 'dropdown',
                    'admin_label'   => true,
                    'heading'       => __( 'Style', 'athen_transl' ),
                    'param_name'    => 'style',
                    'value'         => array(
                        __( 'Solid', 'athen_transl')    => 'solid',
                        __( 'Dashed', 'athen_transl' )  => 'dashed',
                        __( 'Dotted', 'athen_transl' )  => 'dotted',
                        __( 'Double', 'athen_transl' )  => 'double',
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Width', 'athen_transl' ),
                    'param_name'    => 'width',
                    'description'   => __( 'Enter a pixel or percentage value.', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Height', 'athen_transl' ),
                    'param_name'    => 'height',
                    'description'   => __( 'Please enter a px value.', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'style',
                        'value'     => array( 'solid', 'dashed', 'double' ),
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Height', 'athen_transl' ),
                    'param_name'    => 'dotted_height',
                    'description'   => __( 'Please enter a px value.', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'style',
                        'value'     => 'dotted',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Color', 'athen_transl' ),
                    'param_name'    => 'color',
                    'value'         => '',
                    'dependency'    => Array(
                        'element'   => 'style',
                        'value'     => array( 'solid', 'dashed', 'double' ),
                    ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Margin Top', 'athen_transl' ),
                    'param_name'        => 'margin_top',
                    'description'       => __( 'Please enter a px value.', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Margin Bottom', 'athen_transl' ),
                    'description'       => __( 'Please enter a px value.', 'athen_transl' ),
                    'param_name'        => 'margin_bottom',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),

                // Icon
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Icon library', 'athen_transl' ),
                    'param_name'    => 'icon_type',
                    'description'   => __( 'Select icon library.', 'athen_transl' ),
                    'value'         => array(
                        __( 'Font Awesome', 'athen_transl' )    => 'fontawesome',
                        __( 'Open Iconic', 'athen_transl' )     => 'openiconic',
                        __( 'Typicons', 'athen_transl' )        => 'typicons',
                        __( 'Entypo', 'athen_transl' )          => 'entypo',
                        __( 'Linecons', 'athen_transl' )        => 'linecons',
                        __( 'Pixel', 'athen_transl' )           => 'pixelicons',
                    ),
                    'group'         => __( 'Icon', 'athen_transl' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon', 'athen_transl' ),
                    'param_name'    => 'icon',
                    'std'           => '',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'fontawesome',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'fontawesome',
                    ),
                    'group'         => __( 'Icon', 'athen_transl' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon', 'athen_transl' ),
                    'param_name'    => 'icon_openiconic',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'openiconic',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'openiconic',
                    ),
                    'group'         => __( 'Icon', 'athen_transl' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon', 'athen_transl' ),
                    'param_name'    => 'icon_typicons',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'typicons',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'typicons',
                    ),
                    'group'         => __( 'Icon', 'athen_transl' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon', 'athen_transl' ),
                    'param_name'    => 'icon_entypo',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'entypo',
                        'iconsPerPage'  => 300,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'entypo',
                    ),
                    'group'         => __( 'Icon', 'athen_transl' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon', 'athen_transl' ),
                    'param_name'    => 'icon_linecons',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'linecons',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'linecons',
                    ),
                    'group'         => __( 'Icon', 'athen_transl' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon', 'athen_transl' ),
                    'param_name'    => 'icon_pixelicons',
                    'settings'      => array(
                        'emptyIcon' => true,
                        'type'      => 'pixelicons',
                        'source'    => vcex_pixel_icons(),
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'pixelicons',
                    ),
                    'group'         => __( 'Icon', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Icon Color', 'athen_transl' ),
                    'param_name'    => 'icon_color',
                    'group'         => __( 'Icon', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Icon Background', 'athen_transl' ),
                    'param_name'    => 'icon_bg',
                    'group'         => __( 'Icon', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Icon Size', 'athen_transl' ),
                    'param_name'    => 'icon_size',
                    'description'   => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                    'group'         => __( 'Icon', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Icon Height', 'athen_transl' ),
                    'param_name'    => 'icon_height',
                    'description'   => __( 'Please enter a px value.', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                    'group'         => __( 'Icon', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Icon Width', 'athen_transl' ),
                    'param_name'    => 'icon_width',
                    'description'   => __( 'Please enter a px value.', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                    'group'         => __( 'Icon', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Icon Padding', 'athen_transl' ),
                    'param_name'    => 'icon_padding',
                    'description'   => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                    'group'         => __( 'Icon', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Icon Border Radius', 'athen_transl' ),
                    'param_name'    => 'icon_border_radius',
                    'description'   => __( 'Please enter a px value. Or enter 100% for a circle.', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'group'         => __( 'Icon', 'athen_transl' ),
                ),
            )
        ) );
    }
}
add_action( 'vc_before_init', 'vcex_divider_shortcode_vc_map' );