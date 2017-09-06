<?php
/**
 * Registers the list item shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_list_item extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_list_item.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_list_item_shortcode_vc_map' ) ) {
    function vcex_list_item_shortcode_vc_map() {
        vc_map( array(
            'name'                  => __( 'List Item', 'athen_transl' ),
            'description'           => __( 'Font Icon list item', 'athen_transl' ),
            'base'                  => 'vcex_list_item',
            'icon'                  => 'vcex-list-item',
            'category'              => ATHEN_NAME_THEME,
            'params'                => array(

                // General
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Unique Id', 'athen_transl' ),
                    'description'   => __( 'Give your main element a unique ID.', 'athen_transl' ),
                    'param_name'    => 'unique_id',
                    'group'         => __( 'General', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Custom Classes', 'athen_transl' ),
                    'description'   => __( 'Add additonal classes to the main element.', 'athen_transl' ),
                    'param_name'    => 'classes',
                    'group'         => __( 'General', 'athen_transl' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Visibility', 'athen_transl' ),
                    'param_name'        => 'visibility',
                    'value'             => vcex_visibility(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                    'group'             => __( 'General', 'athen_transl' ),

                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Appear Animation', 'athen_transl' ),
                    'param_name'        => 'css_animation',
                    'value'             => vcex_css_animations(),
                    'group'             => __( 'General', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'group'             => __( 'General', 'athen_transl' ),

                ),

                // Text
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Content', 'athen_transl' ),
                    'param_name'    => 'content',
                    'admin_label'   => true,
                    'value'         => __( 'This is a pretty list item', 'athen_transl' ),
                    'group'         => __( 'Text', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Font Color', 'athen_transl' ),
                    'param_name'    => 'font_color',
                    'group'         => __( 'Text', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Custom Font Size', 'athen_transl' ),
                    'param_name'    => 'font_size',
                    'group'         => __( 'Text', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Text Align', 'athen_transl' ),
                    'param_name'    => 'text_align',
                    'value'         => vcex_alignments(),
                    'group'         => __( 'Text', 'athen_transl' ),
                ),

                // Icon
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
                    'group'         => __( 'Icon', 'athen_transl' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon', 'athen_transl' ),
                    'param_name'    => 'icon',
                    'value'         => 'fa fa-info-circle',
                    'settings'      => array(
                        'emptyIcon'     => true,
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
                    'type'          => 'textfield',
                    'heading'       => __( 'Icon Right Margin', 'athen_transl' ),
                    'param_name'    => 'margin_right',
                    'group'         => __( 'Icon', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Icon Color', 'athen_transl' ),
                    'param_name'    => 'color',
                    'group'         => __( 'Icon', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Icon Background', 'athen_transl' ),
                    'param_name'    => 'icon_background',
                    'group'         => __( 'Icon', 'athen_transl' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Icon Size In Pixels', 'athen_transl' ),
                    'param_name'        => 'icon_size',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                    'group'             => __( 'Icon', 'athen_transl' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Icon Border Radius', 'athen_transl' ),
                    'param_name'        => 'icon_border_radius',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'group'             => __( 'Icon', 'athen_transl' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Icon Width', 'athen_transl' ),
                    'param_name'        => 'icon_width',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                    'group'             => __( 'Icon', 'athen_transl' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Icon Height', 'athen_transl' ),
                    'param_name'        => 'icon_height',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'group'             => __( 'Icon', 'athen_transl' ),
                ),

                // Link
                array(
                    'type'          => 'vc_link',
                    'heading'       => __( 'Link', 'athen_transl' ),
                    'param_name'    => 'link',
                    'group'         => __( 'Link', 'athen_transl' ),
                ),

                // Design
                array(
                    'type'          => 'css_editor',
                    'heading'       => __( 'CSS', 'athen_transl' ),
                    'param_name'    => 'css',
                    'description'   => __( 'If any of these are defined it will add a new wrapper around your icon box with the custom CSS applied to it.', 'athen_transl' ),
                    'group'         => __( 'Design', 'athen_transl' ),
                ),

            )
        ) );
    }
}
add_action( 'vc_before_init', 'vcex_list_item_shortcode_vc_map' );