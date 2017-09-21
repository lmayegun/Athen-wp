<?php
/**
 * Registers the teaser shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_teaser extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_teaser.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_teaser_shortcode_vc_map' ) ) {
    function vcex_teaser_shortcode_vc_map() {
        vc_map( array(
            'name'                  => __( 'Teaser Box', 'athen_transl' ),
            'description'           => __( 'A teaser content box', 'athen_transl' ),
            'base'                  => 'vcex_teaser',
            'category'              => ATHEN_NAME_THEME,
            'icon'                  => 'vcex-teaser',
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
                    'type'              => 'dropdown',
                    'heading'           => __( 'Visibility', 'athen_transl' ),
                    'param_name'        => 'visibility',
                    'value'             => vcex_visibility(),
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
                    'heading'       => __( 'Text Align', 'athen_transl' ),
                    'param_name'    => 'text_align',
                    'value'         => array(
                        __( 'Default', 'athen_transl' ) => '',
                        __( 'Center', 'athen_transl' )  => 'center',
                        __( 'Left', 'athen_transl' )    => 'left',
                        __( 'Right', 'athen_transl' )   => 'right',
                    ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Style', 'athen_transl' ),
                    'param_name'    => 'style',
                    'value'         => array(
                        __( 'Default', 'athen_transl' )             => '',
                        __( 'Plain', 'athen_transl' )               => 'one',
                        __( 'Boxed 1 - Legacy', 'athen_transl' )    => 'two',
                        __( 'Boxed 2 - Legacy', 'athen_transl' )    => 'three',
                        __( 'Outline - Legacy', 'athen_transl' )    => 'four',
                    ),
                    'description'   => __( 'For full control select the "Default" style then go to the "Design Options" tab to style the teaser box to your liking.', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Padding', 'athen_transl' ),
                    'param_name'    => 'padding',
                    'dependency'    => array(
                        'element'   => 'style',
                        'value'     => array( 'two' ),
                    ),
                    'description'   => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Background Color', 'athen_transl' ),
                    'param_name'    => 'background',
                    'dependency'    => array(
                        'element'   => 'style',
                        'value'     => array( 'two', 'three' ),
                    ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Border Color', 'athen_transl' ),
                    'param_name'    => 'border_color',
                    'dependency'    => array(
                        'element'   => 'style',
                        'value'     => array( 'two', 'three', 'four' ),
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Border Radius', 'athen_transl' ),
                    'param_name'    => 'border_radius',
                    'dependency'    => array(
                        'element'   => 'style',
                        'value'     => array( 'two', 'three', 'four' ),
                    ),
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
                    'heading'       => __( 'Heading Color', 'athen_transl' ),
                    'param_name'    => 'heading_color',
                    'group'         => __( 'Heading', 'athen_transl' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Heading Type', 'athen_transl' ),
                    'param_name'        => 'heading_type',
                     'value'            => array(
                        __( 'h2', 'athen_transl' )    => 'h2',
                        __( 'h3', 'athen_transl' )    => 'h3',
                        __( 'h4', 'athen_transl' )    => 'h4',
                        __( 'h5', 'athen_transl' )    => 'h5',
                    ),
                    'group'         => __( 'Heading', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Heading Font Weight', 'athen_transl' ),
                    'param_name'        => 'heading_weight',
                    'std'               => '',
                    'value'             => vcex_font_weights(),
                    'group'             => __( 'Heading', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Heading Text Transform', 'athen_transl' ),
                    'param_name'        => 'heading_transform',
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
                    'heading'           => __( 'Heading Margin', 'athen_transl' ),
                    'param_name'        => 'heading_margin',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
                    'group'             => __( 'Heading', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Heading Letter Spacing', 'athen_transl' ),
                    'param_name'        => 'heading_letter_spacing',
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
                    'value'         => __( 'Don\'t forget to change this dummy text in your page editor for this lovely teaser box.', 'athen_transl' ),
                    'group'         => __( 'Content', 'athen_transl' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Content Margin', 'athen_transl' ),
                    'param_name'        => 'content_margin',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
                    'group'             => __( 'Content', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Content Padding', 'athen_transl' ),
                    'param_name'        => 'content_padding',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
                    'group'             => __( 'Content', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Content Font Size', 'athen_transl' ),
                    'param_name'        => 'content_font_size',
                    'description'       => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
                    'group'             => __( 'Content', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Content Font Weight', 'athen_transl' ),
                    'param_name'    => 'content_font_weight',
                    'description'   => __( 'Note: Not all font families support every font weight.', 'athen_transl' ),
                    'std'           => '',
                    'value'         => vcex_font_weights(),
                    'group'         => __( 'Content', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Content Font Color', 'athen_transl' ),
                    'param_name'    => 'content_color',
                    'group'         => __( 'Content', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Content Background', 'athen_transl' ),
                    'param_name'    => 'content_background',
                    'group'         => __( 'Content', 'athen_transl' ),
                ),
                
                // Media
                array(
                    'type'          => 'attach_image',
                    'heading'       => __( 'Image', 'athen_transl' ),
                    'param_name'    => 'image',
                    'group'         => __( 'Media', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Video link', 'athen_transl' ),
                    'param_name'    => 'video',
                    'description'   => __( 'Enter in a video URL that is compatible with WordPress\'s built-in oEmbed feature.', 'athen_transl' ),
                    'group'         => __( 'Media', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Image Style', 'athen_transl' ),
                    'param_name'    => 'img_style',
                    'value'         => array(
                        __( 'Default', 'athen_transl' ) => '',
                        __( 'Stretch', 'athen_transl' ) => 'stretch',
                    ),
                    'group'         => __( 'Media', 'athen_transl' ),
                    'dependency'    => array(
                        'element'   => 'image',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Image Crop Width', 'athen_transl' ),
                    'param_name'        => 'img_width',
                    'group'             => __( 'Media', 'athen_transl' ),
                    'dependency'        => array(
                        'element'   => 'image',
                        'not_empty' => true,
                    ),
                    'description'       => __( 'Enter a width in pixels.', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Image Crop Height', 'athen_transl' ),
                    'param_name'        => 'img_height',
                    'description'       => __( 'Enter a height in pixels. Leave empty to disable vertical cropping and keep image proportions.', 'athen_transl' ),
                    'group'             => __( 'Media', 'athen_transl' ),
                    'dependency'        => array(
                        'element'   => 'image',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Image Filter', 'athen_transl' ),
                    'param_name'        => 'img_filter',
                    'value'             => vcex_image_filters(),
                    'group'             => __( 'Media', 'athen_transl' ),
                    'dependency'        => array(
                        'element'   => 'image',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'CSS3 Image Hover', 'athen_transl' ),
                    'param_name'        => 'img_hover_style',
                    'value'             => vcex_image_hovers(),
                    'group'             => __( 'Media', 'athen_transl' ),
                    'dependency'        => array(
                        'element'   => 'image',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Image Rendering', 'athen_transl' ),
                    'param_name'        => 'img_rendering',
                    'value'             => vcex_image_rendering(),
                    'group'             => __( 'Media', 'athen_transl' ),
                    'dependency'        => array(
                        'element'   => 'image',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),

                // Button 
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Heading', 'athen_transl'),
                    'param_name'        => 'teaser_button',
                    'description'       => '',
                    'value'             => 'Button',
                    'group'             => __( 'Button', 'athen_transl'),
                ),

                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Animation', 'athen_transl'), 
                    'param_name'        => 'button_teaser_animation',
                    'description'       => '',
                    'value'             => vcex_hover_animations(),
                    'group'             => __( 'Button', 'athen_transl'),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column', 
                ),

                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Transition', 'athen_transl'), 
                    'param_name'        => 'button_bg_transition',
                    'description'       => '',
                    'value'             => vcex_hover_animations(),
                    'group'             => __( 'Button', 'athen_transl'),
                    'edit_field_class'        => 'vc_col-sm-4 vc_column', 
                ),

                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Icon Animation', 'athen_transl'), 
                    'param_name'        => 'button_animation_icon',
                    'description'       => '',
                    'value'             => vcex_hover_animations(),
                    'group'             => __( 'Button', 'athen_transl'),
                    'edit_field_class'        => 'vc_col-sm-4 vc_column', 
                ),

                array(
                    'type'              => 'colorpicker',
                    'heading'           => __( 'Button Color', 'athen_transl'), 
                    'param_name'        => 'button_color', 
                    'group'             => __( 'Button', 'athen_transl'),
                ),
                 array(
                    'type'              => 'colorpicker',
                    'heading'           => __( 'Button Hover', 'athen_transl'), 
                    'param_name'        => 'button_color_hover', 
                    'group'             => __( 'Button', 'athen_transl'),
                ),

                // Link
                array(
                    'type'          => 'vc_link',
                    'heading'       => __( 'URL', 'athen_transl' ),
                    'param_name'    => 'url',
                    'group'         => __( 'Link', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Link: Local Scroll', 'athen_transl' ),
                    'param_name'    => 'url_local_scroll',
                    'value'         => array(
                        __( 'False', 'athen_transl' )   => '',
                        __( 'True', 'athen_transl' )    => 'true',
                    ),
                    'group'         => __( 'Link', 'athen_transl' ),
                ),

                // CSS
                array(
                    'type'          => 'css_editor',
                    'heading'       => __( 'CSS', 'athen_transl' ),
                    'param_name'    => 'css',
                    'group'         => __( 'Design Options', 'athen_transl' ),
                ),
            )
        ) );
    }
}
add_action( 'vc_before_init', 'vcex_teaser_shortcode_vc_map' );