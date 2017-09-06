<?php
/**
 * Registers the feature shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_feature_box extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_feature_box.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_feature_box_shortcode_vc_map' ) ) {
    function vcex_feature_box_shortcode_vc_map() {
        vc_map( array(
            'name'                  => __( 'Feature Box', 'athen_transl' ),
            'description'           => __( 'A feature content box', 'athen_transl' ),
            'base'                  => 'vcex_feature_box',
            'category'              => ATHEN_NAME_THEME,
            'icon'                  => 'vcex-feature-box',
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
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',

                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Appear Animation', 'athen_transl'),
                    'param_name'        => 'css_animation',
                    'value'             => vcex_css_animations(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',

                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Style', 'athen_transl' ),
                    'param_name'    => 'style',
                    'value'         => array(
                        __( 'Left Content - Right Image', 'athen_transl' )  => 'left-content-right-image',
                        __( 'Left Image - Right Content', 'athen_transl' )  => 'left-image-right-content',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Alignment', 'athen_transl' ),
                    'param_name'    => 'text_align',
                    'value'         => array(
                        __( 'Default', 'athen_transl' ) => '',
                        __( 'Center', 'athen_transl' )  => 'center',
                        __( 'Left', 'athen_transl' )    => 'left',
                        __( 'Right', 'athen_transl' )   => 'right',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Padding', 'athen_transl' ),
                    'param_name'        => 'padding',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Border', 'athen_transl' ),
                    'description'       => __( 'Please use the shorthand format: width style color. Enter 0px or "none" to disable border.', 'athen_transl' ),
                    'param_name'        => 'border',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Background', 'athen_transl' ),
                    'param_name'    => 'background',
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
                        __( 'h2', 'athen_transl' )  => 'h2',
                        __( 'h3', 'athen_transl' )  => 'h3',
                        __( 'h4', 'athen_transl' )  => 'h4',
                        __( 'h5', 'athen_transl' )  => 'h5',
                        __( 'div', 'athen_transl' ) => 'div',
                    ),
                    'description'       => __( 'Select your heading type for SEO purposes.', 'athen_transl' ),
                    'group'             => __( 'Heading', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Heading Font Weight', 'athen_transl' ),
                    'param_name'        => 'heading_weight',
                    'description'       => __( 'Note: Not all font families support every font weight.', 'athen_transl' ),
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
                    'std'               => '',
                    'description'       => __( 'Select a custom text transform to override the default.', 'athen_transl' ),
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
                    'heading'           => __( 'Heading Margin', 'athen_transl' ),
                    'param_name'        => 'heading_margin',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
                    'group'             => __( 'Heading', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'          => 'vc_link',
                    'heading'       => __( 'Heading URL', 'athen_transl' ),
                    'param_name'    => 'heading_url',
                    'group'         => __( 'Heading', 'athen_transl' ),
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
                    'heading'       => __( 'Content Padding', 'athen_transl' ),
                    'param_name'    => 'content_padding',
                    'description'   => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
                    'group'         => __( 'Content', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Content Font Size', 'athen_transl' ),
                    'param_name'    => 'content_font_size',
                    'description'   => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
                    'group'         => __( 'Content', 'athen_transl' ),
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
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Content Background', 'athen_transl' ),
                    'param_name'    => 'content_background',
                    'group'         => __( 'Content', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Content Font Color', 'athen_transl' ),
                    'param_name'    => 'content_color',
                    'group'         => __( 'Content', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),

                // Image
                array(
                    'type'          => 'attach_image',
                    'heading'       => __( 'Image', 'athen_transl' ),
                    'param_name'    => 'image',
                    'group'         => __( 'Image', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Equal Heights?', 'athen_transl' ),
                    'param_name'    => 'equal_heights',
                    'value'         => array(
                        __( 'No', 'athen_transl' )  => '',
                        __( 'Yes', 'athen_transl' ) => 'true',
                    ),
                    'description'   => __( 'Keeps the image column the same height as your content.', 'athen_transl' ),
                    'group'         => __( 'Image', 'athen_transl' ),
                ),
                array(
                    'type'          => 'vc_link',
                    'heading'       => __( 'Image URL', 'athen_transl' ),
                    'param_name'    => 'image_url',
                    'group'         => __( 'Image', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Lightbox Type', 'athen_transl' ),
                    'param_name'    => 'image_lightbox',
                    'value'         => array(
                        __( 'None', 'athen_transl' )                => '',
                        __( 'Self', 'athen_transl' )                => 'image',
                        __( 'URL', 'athen_transl' )                 => 'url',
                        __( 'Auto Detect - slow', 'athen_transl' )  => 'auto-detect',
                        __( 'Video', 'athen_transl' )               => 'video_embed',
                        __( 'HTML5', 'athen_transl' )               => 'html5',
                        __( 'Quicktime', 'athen_transl' )           => 'quicktime',
                    ),
                    'group'         => __( 'Image', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Image Size', 'athen_transl' ),
                    'param_name'    => 'img_size',
                    'std'           => 'athen_custom',
                    'value'         => vcex_image_sizes(),
                    'group'         => __( 'Image', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Image Crop Location', 'athen_transl' ),
                    'param_name'    => 'img_crop',
                    'std'           => 'center-center',
                    'value'         => vcex_image_crop_locations(),
                    'dependency'    => array(
                        'element'   => 'img_size',
                        'value'     => 'athen_custom',
                    ),
                    'group'         => __( 'Image', 'athen_transl' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Image Width', 'athen_transl' ),
                    'param_name'        => 'img_width',
                    'description'       => __( 'Enter a width in pixels.', 'athen_transl' ),
                    'group'             => __( 'Image', 'athen_transl' ),
                    'dependency'        => array(
                        'element'   => 'img_size',
                        'value'     => 'athen_custom',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Image Height', 'athen_transl' ),
                    'param_name'        => 'img_height',
                    'description'       => __( 'Enter a height in pixels. Leave empty to disable vertical cropping and keep image proportions.', 'athen_transl' ),
                    'group'             => __( 'Image', 'athen_transl' ),
                    'dependency'        => array(
                        'element'   => 'img_size',
                        'value'     => 'athen_custom',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Border Radius', 'athen_transl' ),
                    'param_name'    => 'img_border_radius',
                    'description'   => __( 'Please enter a px value.', 'athen_transl' ),
                    'group'         => __( 'Image', 'athen_transl' ),
                    'dependency'    => array(
                        'element'   => 'image',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'CSS3 Image Hover', 'athen_transl' ),
                    'param_name'    => 'img_hover_style',
                    'value'         => vcex_image_hovers(),
                    'group'         => __( 'Image', 'athen_transl' ),
                    'dependency'    => array(
                        'element'   => 'image',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Image Filter', 'athen_transl' ),
                    'param_name'    => 'img_filter',
                    'value'         => vcex_image_filters(),
                    'group'         => __( 'Image', 'athen_transl' ),
                    'dependency'    => array(
                        'element'   => 'image',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Image Rendering', 'athen_transl' ),
                    'param_name'    => 'img_rendering',
                    'value'         => vcex_image_rendering(),
                    'group'         => __( 'Image', 'athen_transl' ),
                    'dependency'    => array(
                        'element'   => 'image',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),

                // Video
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Video link', 'athen_transl' ),
                    'param_name'    => 'video',
                    'description'   => __('Enter a URL that is compatible with WP\'s built-in oEmbed feature. ', 'athen_transl' ),
                    'group'         => __( 'Video', 'athen_transl' ),
                ),

                // Widths
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Content Width', 'athen_transl' ),
                    'param_name'    => 'content_width',
                    'value'         => '50%',
                    'group'         => __( 'Widths', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Image Width', 'athen_transl' ),
                    'param_name'    => 'media_width',
                    'value'         => '50%',
                    'group'         => __( 'Widths', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Tablet Widths', 'athen_transl' ),
                    'param_name'    => 'tablet_widths',
                    'value'         => array(
                        __( 'Inherit', 'athen_transl' )     => '',
                        __( 'Full-Width', 'athen_transl' )  => 'fullwidth',
                    ),
                    'group'         => __( 'Widths', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Phone Widths', 'athen_transl' ),
                    'param_name'    => 'phone_widths',
                    'value'         => array(
                        __( 'Inherit', 'athen_transl' )     => '',
                        __( 'Full-Width', 'athen_transl' )  => 'fullwidth',
                    ),
                    'group'         => __( 'Widths', 'athen_transl' ),
                ),

            )
        ) );
    }
}
add_action( 'vc_before_init', 'vcex_feature_box_shortcode_vc_map' );