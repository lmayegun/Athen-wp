<?php
/**
 * Registers the button shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_button extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_button.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_button_shortcode_vc_map' ) ) {
    function vcex_button_shortcode_vc_map() {

        vc_map( array(
            'name'                  => __( 'Total Button', 'athen_transl' ),
            'description'           => __( 'Eye catching button', 'athen_transl' ),
            'base'                  => 'vcex_button',
            'category'              => ATHEN_NAME_THEME,
            'icon'                  => 'vcex-total-button',
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
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                    'value'             => vcex_visibility(),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Appear Animation', 'athen_transl'),
                    'param_name'        => 'css_animation',
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                    'value'             => vcex_css_animations(),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Hover Animation', 'athen_transl'),
                    'param_name'        => 'hover_animation',
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                    'value'             => vcex_hover_animations(),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'URL', 'athen_transl' ),
                    'param_name'    => 'url',
                    'value'         => 'http://www.google.com/',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Text', 'athen_transl' ),
                    'param_name'    => 'content',
                    'admin_label'   => true,
                    'std'           => 'Button Text',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Link Title', 'athen_transl' ),
                    'param_name'    => 'title',
                    'value'         => 'Visit Site',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Link Target', 'athen_transl' ),
                    'param_name'    => 'target',
                    'value'         => array(
                        __( 'Self', 'athen_transl' )    => '',
                        __( 'Blank', 'athen_transl' )   => 'blank',
                        __( 'Local', 'athen_transl' )   => 'local',
                    ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Link Rel', 'athen_transl' ),
                    'param_name'    => 'rel',
                    'value'         => array(
                        __( 'None', 'athen_transl' )        => '',
                        __( 'Nofollow', 'athen_transl' )    => 'nofollow',
                    ),
                ),

                // Design
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Style', 'athen_transl' ),
                    'param_name'    => 'style',
                    'std'           => '',
                    'value'         => vcex_button_styles(),
                    'group'         => __( 'Design', 'athen_transl' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Layout', 'athen_transl' ),
                    'param_name'        => 'layout',
                    'value'             => array(
                        __( 'Inline', 'athen_transl' )                      => '',
                        __( 'Block', 'athen_transl' )                       => 'block',
                        __( 'Expanded (fit container)', 'athen_transl' )    => 'expanded',
                    ),
                    'group'             => __( 'Design', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Align', 'athen_transl' ),
                    'param_name'        => 'align',
                    'value'             => vcex_alignments(),
                    'group'             => __( 'Design', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Background', 'athen_transl' ),
                    'param_name'        => 'color',
                    'std'               => '',
                    'value'             => vcex_button_colors(),
                    'group'             => __( 'Design', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Background', 'athen_transl' ),
                    'param_name'    => 'custom_background',
                    'group'         => __( 'Design', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Background: Hover', 'athen_transl' ),
                    'param_name'    => 'custom_hover_background',
                    'group'         => __( 'Design', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Color', 'athen_transl' ),
                    'param_name'    => 'custom_color',
                    'group'         => __( 'Design', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Color: Hover', 'athen_transl' ),
                    'param_name'    => 'custom_hover_color',
                    'group'         => __( 'Design', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Size', 'athen_transl' ),
                    'param_name'    => 'size',
                    'std'           => '',
                    'value'         => array(
                        __( 'Default', 'athen_transl' ) => '',
                        __( 'Small', 'athen_transl' )   => 'small',
                        __( 'Medium', 'athen_transl' )  => 'medium',
                        __( 'Large', 'athen_transl' )   => 'large',
                    ),
                    'group'         => __( 'Design', 'athen_transl' ),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => __( 'Font Family', 'athen_transl' ),
                    'param_name'  => 'font_family',
                    'std'         => '',
                    'value'       => vcex_fonts_array(),
                    'description' => __( 'After selecting a font click on the save changes button to preview your font.', 'athen_transl' ),
                     'group'         => __( 'Design', 'athen_transl' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Font Size', 'athen_transl' ),
                    'param_name'        => 'font_size',
                    'description'       => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
                    'group'             => __( 'Design', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Letter Spacing', 'athen_transl' ),
                    'param_name'        => 'letter_spacing',
                    'description'       => __( 'Please enter a px value.', 'athen_transl' ),
                    'group'             => __( 'Design', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Text Transform', 'athen_transl' ),
                    'param_name'        => 'text_transform',
                    'group'             => __( 'Design', 'athen_transl' ),
                    'value'             => vcex_text_transforms(),
                    'std'               => '',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Font Weight', 'athen_transl' ),
                    'param_name'        => 'font_weight',
                    'description'       => __( 'Note: Not all font families support every font weight.', 'athen_transl' ),
                    'value'             => vcex_font_weights(),
                    'std'               => '',
                    'group'             => __( 'Design', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Custom Width', 'athen_transl' ),
                    'param_name'        => 'width',
                    'description'       => __( 'Please use a pixel or percentage value.', 'athen_transl' ),
                    'group'             => __( 'Design', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Border Radius', 'athen_transl' ),
                    'param_name'        => 'border_radius',
                    'description'       => __( 'Please enter a px value.', 'athen_transl' ),
                    'group'             => __( 'Design', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Padding', 'athen_transl' ),
                    'param_name'        => 'font_padding',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
                    'group'             => __( 'Design', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Margin', 'athen_transl' ),
                    'param_name'        => 'margin',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
                    'group'             => __( 'Design', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),

                // Lightbox
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Lightbox', 'athen_transl' ),
                    'param_name'    => 'lightbox',
                    'value'         => Array(
                        __( 'No', 'athen_transl' )  => '',
                        __( 'Yes', 'athen_transl' ) => 'true',
                    ),
                    'group'         => __( 'Lightbox', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Type', 'athen_transl' ),
                    'param_name'    => 'lightbox_type',
                    'value'         => array(
                        __( 'Auto Detect - slow', 'athen_transl' )  => '',
                        __( 'iFrame', 'athen_transl' )              => 'iframe',
                        __( 'Image', 'athen_transl' )               => 'image',
                        __( 'Video', 'athen_transl' )               => 'video_embed',
                        __( 'HTML5', 'athen_transl' )               => 'html5',
                        __( 'Quicktime', 'athen_transl' )           => 'quicktime',
                    ),
                    'description'   => __( 'Auto detect depends on the iLightbox API, so by choosing your type it speeds things up and you also allows for HTTPS support.', 'athen_transl' ),
                    'group'         => __( 'Lightbox', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'lightbox',
                        'value'     => 'true',
                    ),
                ),
                array(
                    'type'          => 'attach_image',
                    'heading'       => __( 'Lightbox Image', 'athen_transl' ),
                    'param_name'    => 'lightbox_image',
                    'dependency'    => Array(
                        'element'   => 'lightbox_type',
                        'value'     => 'image',
                    ),
                    'group'         => __( 'Lightbox', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'HTML5 Webm URL', 'athen_transl' ),
                    'param_name'    => 'lightbox_video_html5_webm',
                    'description'   => __( 'Enter the URL to a video, SWF file, flash file or a website URL to open in lightbox.', 'athen_transl' ),
                    'group'         => __( 'Lightbox', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'lightbox_type',
                        'value'     => 'html5',
                    ),
                ),
                array(
                    'type'          => 'attach_image',
                    'heading'       => __( 'Lightbox HTML5 Poster Image', 'athen_transl' ),
                    'param_name'    => 'lightbox_poster_image',
                    'dependency'    => Array(
                        'element'   => 'lightbox_type',
                        'value'     => 'html5',
                    ),
                    'group'         => __( 'Lightbox', 'athen_transl' ),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => __( 'Lightbox Dimensions', 'athen_transl' ),
                    'param_name'  => 'lightbox_dimensions',
                    'description' => __( 'Enter a custom width and height for your lightbox pop-up window. Use format widthxheight. Example: 900x600.', 'athen_transl' ),
                     'group'      => __( 'Lightbox', 'athen_transl' ),
                ),

                //Icons
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Icon library', 'athen_transl' ),
                    'param_name'    => 'icon_type',
                    'description'   => __( 'Select icon library.', 'athen_transl' ),
                    'std'           => 'fontawesome',
                    'value'         => array(
                        __( 'Font Awesome', 'athen_transl' ) => 'fontawesome',
                        __( 'Open Iconic', 'athen_transl' )  => 'openiconic',
                        __( 'Typicons', 'athen_transl' )     => 'typicons',
                        __( 'Entypo', 'athen_transl' )       => 'entypo',
                        __( 'Linecons', 'athen_transl' )     => 'linecons',
                        __( 'Pixel', 'athen_transl' )        => 'pixelicons',
                    ),
                    'group'         => __( 'Icons', 'athen_transl' ),
                ),

                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Left', 'athen_transl' ),
                    'param_name'    => 'icon_left',
                    'admin_label'   => true,
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'fontawesome',
                    ),
                    'group'         => __( 'Icons', 'athen_transl' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Left', 'athen_transl' ),
                    'param_name'    => 'icon_left_openiconic',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'openiconic',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'openiconic',
                    ),
                    'group'         => __( 'Icons', 'athen_transl' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Left', 'athen_transl' ),
                    'param_name'    => 'icon_left_typicons',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'typicons',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'typicons',
                    ),
                    'group'         => __( 'Icons', 'athen_transl' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Left', 'athen_transl' ),
                    'param_name'    => 'icon_left_entypo',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'entypo',
                        'iconsPerPage'  => 300,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'entypo',
                    ),
                    'group'         => __( 'Icons', 'athen_transl' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Left', 'athen_transl' ),
                    'param_name'    => 'icon_left_linecons',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'linecons',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'linecons',
                    ),
                    'group'         => __( 'Icons', 'athen_transl' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Left', 'athen_transl' ),
                    'param_name'    => 'icon_left_pixelicons',
                    'settings'      => array(
                        'emptyIcon' => true,
                        'type'      => 'pixelicons',
                        'source'    => vcex_pixel_icons(),
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'pixelicons',
                    ),
                    'group'         => __( 'Icons', 'athen_transl' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Right', 'athen_transl' ),
                    'param_name'    => 'icon_right',
                    'admin_label'   => true,
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'fontawesome',
                    ),
                    'group'         => __( 'Icons', 'athen_transl' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Right', 'athen_transl' ),
                    'param_name'    => 'icon_right_openiconic',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'openiconic',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'openiconic',
                    ),
                    'group'         => __( 'Icons', 'athen_transl' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Right', 'athen_transl' ),
                    'param_name'    => 'icon_right_typicons',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'typicons',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'typicons',
                    ),
                    'group'         => __( 'Icons', 'athen_transl' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Right', 'athen_transl' ),
                    'param_name'    => 'icon_right_entypo',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'entypo',
                        'iconsPerPage'  => 300,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'entypo',
                    ),
                    'group'         => __( 'Icons', 'athen_transl' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Right', 'athen_transl' ),
                    'param_name'    => 'icon_right_linecons',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'linecons',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'linecons',
                    ),
                    'group'         => __( 'Icons', 'athen_transl' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Right', 'athen_transl' ),
                    'param_name'    => 'icon_right_pixelicons',
                    'settings'      => array(
                        'emptyIcon' => true,
                        'type'      => 'pixelicons',
                        'source'    => vcex_pixel_icons(),
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'pixelicons',
                    ),
                    'group'         => __( 'Icons', 'athen_transl' ),
                ),


                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Left Icon: Right Padding', 'athen_transl' ),
                    'param_name'    => 'icon_left_padding',
                    'group'         => __( 'Icons', 'athen_transl' ),
                ),

                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Right Icon: Left Padding', 'athen_transl' ),
                    'param_name'    => 'icon_right_padding',
                    'group'         => __( 'Icons', 'athen_transl' ),
                ),
            )
        ) );
    }
}
add_action( 'vc_before_init', 'vcex_button_shortcode_vc_map' );