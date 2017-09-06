<?php
/**
 * Registers the Icon Box shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_icon_box extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_icon_box.php' ) );
        return ob_get_clean();
    }
}

/**
 * Parse shortcode attributes and set correct values
 *
 * @since 2.0.0
 */
function parse_vcex_icon_box_atts( $atts ) {

    // Set font family if icon is defined
    if ( isset( $atts['icon'] ) && empty( $atts['icon_type'] ) ) {
        $atts['icon_type']  = 'fontawesome';
        $atts['icon']       = 'fa fa-'. $atts['icon'];
    }

    // Return $atts
    return $atts;
}
add_filter( 'vc_edit_form_fields_attributes_vcex_icon_box', 'parse_vcex_icon_box_atts' );

/**
 * Register the shortcode for use with the Visual Composer
 *
 * @link    https://wpbakery.atlassian.net/wiki/pages/viewpage.action?pageId=524332
 * @since   1.4.1
 */
if ( ! function_exists( 'vcex_icon_box_shortcode_vc_map' ) ) {
    function vcex_icon_box_shortcode_vc_map() {

        vc_map( array(
            'name'                  => __( 'Icon Box', 'athen_transl' ),
            'base'                  => 'vcex_icon_box',
            'category'              => ATHEN_NAME_THEME,
            'icon'                  => 'vcex-icon-box',
            'description'           => __( 'Content box with icon', 'athen_transl' ),
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
                    'heading'       => __( 'Classes', 'athen_transl' ),
                    'param_name'    => 'classes',
                    'description'   => __( 'Add additonal classes to the main element.', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Visibility', 'athen_transl' ),
                    'param_name'    => 'visibility',
                    'value'         => vcex_visibility(),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Appear Animation', 'athen_transl'),
                    'param_name'        => 'css_animation',
                    'value'             => vcex_css_animations(),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Hover Animation', 'athen_transl'),
                    'param_name'        => 'hover_animation',
                    'value'             => vcex_hover_animations(),
                    'std'               => '',
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Style', 'athen_transl' ),
                    'param_name'    => 'style',
                    'value'         => vcex_icon_box_styles(),
                    'description'   => __( 'For greater control select left, right or top icon styles then go to the "Design" tab to modify the icon box design.', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Alignment', 'athen_transl' ),
                    'param_name'    => 'alignment',
                    'dependency'    => Array(
                        'element'   => 'style',
                        'value'     => array( 'two' ),
                    ),
                    'value'         => array(
                        __( 'Default', 'athen_transl')  => '',
                        __( 'Center', 'athen_transl')   => 'center',
                        __( 'Left', 'athen_transl' )    => 'left',
                        __( 'Right', 'athen_transl' )   => 'right',
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Icon Bottom Margin', 'athen_transl' ),
                    'param_name'    => 'icon_bottom_margin',
                    'description'   => __( 'Please enter a px value.', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'style',
                        'value'     => array( 'two', 'three', 'four', 'five', 'six' ),
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Container Left Padding', 'athen_transl' ),
                    'param_name'    => 'container_left_padding',
                    'description'   => __( 'Please enter a px value.', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'style',
                        'value'     => array( 'one' )
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Container Right Padding', 'athen_transl' ),
                    'param_name'    => 'container_right_padding',
                    'description'   => __( 'Please enter a px value.', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'style',
                        'value'     => array( 'seven' )
                    ),
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
                        __( 'Entypo', 'athen_transl' )           => 'entypo',
                        __( 'Linecons', 'athen_transl' )        => 'linecons',
                        __( 'Pixel', 'athen_transl' )           => 'pixelicons',
                    ),
                    'group'         => __( 'Icon', 'athen_transl' ),
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
                    'heading'       => __( 'Icon Font Alternative Classes', 'athen_transl' ),
                    'param_name'    => 'icon_alternative_classes',
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
                    'param_name'    => 'icon_background',
                    'group'         => __( 'Icon', 'athen_transl' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Icon Size In Pixels', 'athen_transl' ),
                    'param_name'        => 'icon_size',
                    'group'             => __( 'Icon', 'athen_transl' ),
                    'description'       => __( 'Please enter a px value.', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Icon Border Radius', 'athen_transl' ),
                    'param_name'        => 'icon_border_radius',
                    'description'       => __( 'Please enter a px value.', 'athen_transl' ),
                    'group'             => __( 'Icon', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Fixed Icon Width', 'athen_transl' ),
                    'param_name'        => 'icon_width',
                    'description'       => __( 'Please enter a px value.', 'athen_transl' ),
                    'group'             => __( 'Icon', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Fixed Icon Height', 'athen_transl' ),
                    'param_name'        => 'icon_height',
                    'description'       => __( 'Please enter a px value.', 'athen_transl' ),
                    'group'             => __( 'Icon', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),

                // Icon
                array(
                    'type'          => 'attach_image',
                    'heading'       => __( 'Icon Image Alternative', 'athen_transl' ),
                    'param_name'    => 'image',
                    'group'         => __( 'Image', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Icon Image Alternative Width', 'athen_transl' ),
                    'param_name'    => 'image_width',
                    'description'   => __( 'Please enter a px value.', 'athen_transl' ),
                    'group'         => __( 'Image', 'athen_transl' ),
                ),

                // Heading
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Heading', 'athen_transl' ),
                    'param_name'    => 'heading',
                    'value'         => 'Sample Heading',
                    'group'         => __( 'Heading', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Heading Font Color', 'athen_transl' ),
                    'param_name'    => 'heading_color',
                    'group'         => __( 'Heading', 'athen_transl' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Heading Type', 'athen_transl' ),
                    'param_name'        => 'heading_type',
                    'value'     => array(
                        __( 'Default', 'athen_transl' ) => '',
                        'h2'                    => 'h2',
                        'h3'                    => 'h3',
                        'h4'                    => 'h4',
                        'h5'                    => 'h5',
                        'div'                   => 'div',
                        'span'                  => 'span',
                    ),
                    'group'             => __( 'Heading', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Heading Font Weight', 'athen_transl' ),
                    'param_name'        => 'heading_weight',
                    'value'             => vcex_font_weights(),
                    'std'               => '',
                    'group'             => __( 'Heading', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Heading Text Transform', 'athen_transl' ),
                    'param_name'        => 'heading_transform',
                    'std'               => '',
                    'group'             => __( 'Heading', 'athen_transl' ),
                    'value'             => vcex_text_transforms(),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Heading Font Size', 'athen_transl' ),
                    'param_name'        => 'heading_size',
                    'description'       => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
                    'group'             => __( 'Heading', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Heading Letter Spacing', 'athen_transl' ),
                    'param_name'        => 'heading_letter_spacing',
                    'description'       => __( 'Please enter a px value.', 'athen_transl' ),
                    'group'             => __( 'Heading', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Heading Bottom Margin', 'athen_transl' ),
                    'param_name'        => 'heading_bottom_margin',
                    'description'       => __( 'Please enter a px value.', 'athen_transl' ),
                    'group'             => __( 'Heading', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),


                // Content
                array(
                    'type'          => 'textarea_html',
                    'holder'        => 'div',
                    'heading'       => __( 'Content', 'athen_transl' ),
                    'param_name'    => 'content',
                    'value'         => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
                    'group'         => __( 'Content', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Content Font Size', 'athen_transl' ),
                    'param_name'    => 'font_size',
                    'description'   => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
                    'group'         => __( 'Content', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Content Color', 'athen_transl' ),
                    'param_name'    => 'font_color',
                    'group'         => __( 'Content', 'athen_transl' ),
                ),

                // URL
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'URL', 'athen_transl' ),
                    'param_name'    => 'url',
                    'group'         => __( 'URL', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'URL Target', 'athen_transl' ),
                    'param_name'    => 'url_target',
                     'value'        => array(
                        __( 'Self', 'athen_transl' )    => '',
                        __( 'Blank', 'athen_transl' )   => '_blank',
                        __( 'Local', 'athen_transl' )   => 'local',
                    ),
                    'group'         => __( 'URL', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'URL Rel', 'athen_transl' ),
                    'param_name'    => 'url_rel',
                    'value'         => array(
                        __( 'None', 'athen_transl' )        => '',
                        __( 'Nofollow', 'athen_transl' )    => 'nofollow',
                    ),
                    'group'         => __( 'URL', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Link Container Wrap', 'athen_transl' ),
                    'param_name'    => 'url_wrap',
                    'value'         => array(
                        __( 'Default', 'athen_transl' ) => '',
                        __( 'False', 'athen_transl' )   => 'false',
                        __( 'True', 'athen_transl' )    => 'true',
                    ),
                    'group'         => __( 'URL', 'athen_transl' ),
                    'description'   => __( 'Apply the link to the entire wrapper?', 'athen_transl' ),
                ),

                // Design
                array(
                    'type'          => 'css_editor',
                    'heading'       => __( 'CSS', 'athen_transl' ),
                    'param_name'    => 'css',
                    'description'   => __( 'If any of these are defined it will add a new wrapper around your icon box with the custom CSS applied to it.', 'athen_transl' ),
                    'group'         => __( 'Design', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Border Radius', 'athen_transl' ),
                    'param_name'    => 'border_radius',
                    'description'   => __( 'Please enter a px value.', 'athen_transl' ),
                    'group'         => __( 'Design', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Hover: background', 'athen_transl' ),
                    'param_name'    => 'hover_background',
                    'description'   => __( 'Will add a hover background color to your entire icon box or replace the current hover color for specific icon box styles.', 'athen_transl' ),
                    'group'         => __( 'Design', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'White Text On Hover', 'athen_transl' ),
                    'param_name'    => 'hover_white_text',
                    'value'         => array(
                        __( 'False', 'athen_transl' )   => '',
                        __( 'True', 'athen_transl' )    => 'true',
                    ),
                    'description'   => __( 'If enabled your heading, content and links within your content will all turn white on hover.', 'athen_transl' ),
                    'group'         => __( 'Design', 'athen_transl' ),
                ),
            )
        ) );

    }
}
add_action( 'vc_before_init', 'vcex_icon_box_shortcode_vc_map' );