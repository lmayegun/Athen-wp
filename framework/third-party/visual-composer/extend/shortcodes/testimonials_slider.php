<?php
/**
 * Registers the testimonials slider shortcode and adds it to the Visual Composer
 *
 * @package     Total
 * @subpackage  Framework/Visual Composer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.4.1
 * @version     2.0.0
 */

// Return if testimonials are disabled
if ( ! ATHEN_CHECK_TESTIMONIALS ) {
    return;
}

/**
 * Register shortcode with VC Composer
 *
 * @since 2.0.0
 */
class WPBakeryShortCode_vcex_testimonials_slider extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_testimonials_slider.php' ) );
        return ob_get_clean();
    }
}

/**
 * Parse old shortcode attributes
 *
 * @since 2.0.0
 */
function parse_vcex_testimonials_slider_atts( $atts ) {

    // Update animation
    if ( ! empty( $atts['animation'] ) && 'fade' == $atts['animation'] ) {
        $atts['animation'] = 'fade_slides';
    }

    // Return $atts
    return $atts;
}
add_filter( 'vc_edit_form_fields_attributes_vcex_testimonials_slider', 'parse_vcex_testimonials_slider_atts' );

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_testimonials_slider_shortcode_vc_map' ) ) {
    function vcex_testimonials_slider_shortcode_vc_map() {

        // Get list of taxonomies to narrow Query by
        $vc_taxonomies_types    = get_taxonomies( array( 'name' => 'testimonials_category' ), 'objects' );
        $vc_taxonomies          = get_terms( array_keys( $vc_taxonomies_types ), array( 'hide_empty' => false ) );
        $taxonomies_list        = array( 'testimonials_category' );
        $taxonomies_list        = array();
        foreach ( $vc_taxonomies as $t ) {
            $taxonomies_list[] = array(
                'label' => $t->name,
                'value' => $t->term_id,
                'group' => __( 'Select', 'athen_transl' )
            );
        }

        // Add params
        vc_map( array(
            'name'                  => __( 'Testimonials Slider', 'athen_transl' ),
            'description'           => __( 'Recent testimonials slider', 'athen_transl' ),
            'base'                  => 'vcex_testimonials_slider',
            'category'              => ATHEN_NAME_THEME,
            'icon'                  => 'vcex-testimonials-slider',
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
                    'description'       => __( 'Choose when this module should display.', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Appear Animation', 'athen_transl'),
                    'param_name'        => 'css_animation',
                    'value'             => vcex_css_animations(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'description'       => __( 'If the "filter" is enabled animations will be disabled to prevent bugs.', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Display Author Avatar?', 'athen_transl' ),
                    'param_name'    => 'display_author_avatar',
                    'value'         => array(
                        __( 'Yes', 'athen_transl' ) => 'yes',
                        __( 'No', 'athen_transl' )  => '',
                    ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Display Author Name?', 'athen_transl' ),
                    'param_name'    => 'display_author_name',
                    'value'         => array(
                        __( 'Yes', 'athen_transl' ) => 'yes',
                        __( 'No', 'athen_transl' )  => 'no',
                    ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Display Author Company?', 'athen_transl' ),
                    'param_name'    => 'display_author_company',
                    'value'         => array(
                        __( 'No', 'athen_transl' )  => '',
                        __( 'Yes', 'athen_transl' ) => 'true',
                    ),
                ),

                // Slider Settings
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Animation', 'athen_transl' ),
                    'param_name'    => 'animation',
                    'std'           => 'fade_slides',
                    'value'         => array(
                        __( 'Fade', 'athen_transl' )    => 'fade_slides',
                        __( 'Slide', 'athen_transl' )   => 'slide',
                    ),
                    'group'         => __( 'Slider Settings', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Loop', 'athen_transl' ),
                    'param_name'    => 'loop',
                    'value'         => array(
                        __( 'Yes', 'athen_transl' ) => '',
                        __( 'No', 'athen_transl' )  => 'false',
                    ),
                    'group'         => __( 'Slider Settings', 'athen_transl' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Auto Height Animation', 'athen_transl' ),
                    'std'               => '400',
                    'param_name'        => 'height_animation',
                    'group'             => __( 'Slider Settings', 'athen_transl' ),
                    'description'       => __( 'You can enter "0.0" to disable the animation completely.', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Animation Speed', 'athen_transl' ),
                    'param_name'        => 'animation_speed',
                    'std'               => '600',
                    'description'       => __( 'Enter a value in milliseconds.', 'athen_transl' ),
                    'group'             => __( 'Slider Settings', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Auto Play', 'athen_transl' ),
                    'param_name'        => 'slideshow',
                    'value'             => array(
                        __( 'Yes', 'athen_transl' ) => '',
                        __( 'No', 'athen_transl' )  => 'false',
                    ),
                    'description'       => __( 'Enable automatic slideshow? Disabled in front-end composer to prevent page "jumping".', 'athen_transl' ),
                    'group'             => __( 'Slider Settings', 'athen_transl' ),
                     'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Auto Play Delay', 'athen_transl' ),
                    'param_name'        => 'slideshow_speed',
                    'std'               => '5000',
                    'description'       => __( 'Enter a value in milliseconds.', 'athen_transl' ),
                    'group'             => __( 'Slider Settings', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Dot Navigation', 'athen_transl' ),
                    'param_name'        => 'control_nav',
                    'value'             => array(
                        __( 'Yes', 'athen_transl' ) => '',
                        __( 'No', 'athen_transl' )  => 'false',
                    ),
                    'group'             => __( 'Slider Settings', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Arrows', 'athen_transl' ),
                    'param_name'        => 'direction_nav',
                    'value'             => array(
                        __( 'No', 'athen_transl' )  => '',
                        __( 'Yes', 'athen_transl' ) => 'true',
                    ),
                    'group'             => __( 'Slider Settings', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Thumbnails', 'athen_transl' ),
                    'param_name'        => 'control_thumbs',
                    'value'             => array(
                        __( 'No', 'athen_transl' )  => '',
                        __( 'Yes', 'athen_transl' ) => 'true'
                    ),
                    'group'             => __( 'Slider Settings', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Navigation Thumbnails Height', 'athen_transl' ),
                    'param_name'        => 'control_thumbs_height',
                    'std'               => '50',
                    'dependency'        => Array(
                        'element'   => 'control_thumbs',
                        'value'     => array( 'true' )
                    ),
                    'group'             => __( 'Slider Settings', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Navigation Thumbnails Width', 'athen_transl' ),
                    'param_name'        => 'control_thumbs_width',
                    'std'               => '50',
                    'dependency'        => Array(
                        'element'   => 'control_thumbs',
                        'value'     => array( 'true' )
                    ),
                    'group'             => __( 'Slider Settings', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),

                // Query
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Posts Count', 'athen_transl' ),
                    'param_name'    => 'count',
                    'value'         => '3',
                    'group'         => __( 'Query', 'athen_transl' ),
                ),
                array(
                    'type'                  => 'autocomplete',
                    'heading'               => __( 'Include Categories', 'athen_transl' ),
                    'param_name'            => 'include_categories',
                    'param_holder_class'    => 'vc_not-for-custom',
                    'admin_label'           => true,
                    'settings'              => array(
                        'multiple'          => true,
                        'min_length'        => 1,
                        'groups'            => false,
                        'unique_values'     => true,
                        'display_inline'    => true,
                        'delay'             => 0,
                        'auto_focus'        => true,
                        'values'            => $taxonomies_list,
                    ),
                    'group'                 => __( 'Query', 'athen_transl' ),
                ),
                array(
                    'type'          => 'autocomplete',
                    'heading'       => __( 'Exclude Categories', 'athen_transl' ),
                    'param_name'    => 'exclude_categories',
                    'param_holder_class'    => 'vc_not-for-custom',
                    'admin_label'           => true,
                    'settings'              => array(
                        'multiple'          => true,
                        'min_length'        => 1,
                        'groups'            => false,
                        'unique_values'     => true,
                        'display_inline'    => true,
                        'delay'             => 0,
                        'auto_focus'        => true,
                        'values'            => $taxonomies_list,
                    ),
                    'group'                 => __( 'Query', 'athen_transl' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Order', 'athen_transl' ),
                    'param_name'        => 'order',
                    'value'             => vcex_order_array(),
                    'group'             => __( 'Query', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Order By', 'athen_transl' ),
                    'param_name'        => 'orderby',
                    'value'             => vcex_orderby_array(),
                    'group'             => __( 'Query', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Orderby: Meta Key', 'athen_transl' ),
                    'param_name'    => 'orderby_meta_key',
                    'group'         => __( 'Query', 'athen_transl' ),
                    'dependency'    => array(
                        'element'   => 'orderby',
                        'value'     => array( 'meta_value_num', 'meta_value' ),
                    ),
                ),

                // Image sizes
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Image Border Radius', 'athen_transl' ),
                    'param_name'    => 'img_border_radius',
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
                    'heading'           => __( 'Image Crop Width', 'athen_transl' ),
                    'param_name'        => 'img_width',
                    'dependency'        => array(
                        'element'   => 'img_size',
                        'value'     => 'athen_custom',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'description'       => __( 'Enter a width in pixels.', 'athen_transl' ),
                    'group'             => __( 'Image', 'athen_transl' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Image Crop Height', 'athen_transl' ),
                    'param_name'        => 'img_height',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'dependency'        => array(
                        'element'   => 'img_size',
                        'value'     => 'athen_custom',
                    ),
                    'description'       => __( 'Enter a height in pixels. Leave empty to disable vertical cropping and keep image proportions.', 'athen_transl' ),
                    'group'             => __( 'Image', 'athen_transl' ),
                ),

                // Excerpts
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Excerpt', 'athen_transl' ),
                    'param_name'    => 'excerpt',
                    'value'         => array(
                        __( 'No', 'athen_transl' )  => '',
                        __( 'Yes', 'athen_transl' ) => 'true',
                    ),
                    'group'         => __( 'Excerpt', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Excerpt Length', 'athen_transl' ),
                    'param_name'    => 'excerpt_length',
                    'value'         => '20',
                    'description'   => __( 'Enter a custom excerpt length. Will trim the excerpt by this number of words. Enter "-1" to display the_content instead of the auto excerpt.', 'athen_transl' ),
                    'group'         => __( 'Excerpt', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'excerpt',
                        'value'     => array( 'true' )
                    ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Read More', 'athen_transl' ),
                    'param_name'    => 'read_more',
                    'value'         => array(
                        __( 'Yes', 'athen_transl' ) => 'true',
                        __( 'No', 'athen_transl' )  => 'false',
                    ),
                    'group'         => __( 'Excerpt', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'excerpt',
                        'value'     => array( 'true' )
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Read More Text', 'athen_transl' ),
                    'param_name'    => 'read_more_text',
                    'group'         => __( 'Excerpt', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'excerpt',
                        'value'     => array( 'true' )
                    ),
                ),

                // CSS
                array(
                    'type'          => 'css_editor',
                    'heading'       => __( 'CSS', 'athen_transl' ),
                    'param_name'    => 'css',
                    'group'         => __( 'Design', 'athen_transl' ),
                    'description'   => __( 'Important: These options will override any and all old styling settings.', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Skin', 'athen_transl' ),
                    'param_name'    => 'skin',
                    'value'     => array(
                        __( 'Dark Text', 'athen_transl' )   => 'dark',
                        __( 'Light Text', 'athen_transl' )  => 'light',
                    ),
                    'group'         => __( 'Design', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Font Size', 'athen_transl' ),
                    'param_name'    => 'font_size',
                    'group'         => __( 'Design', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Font Weight', 'athen_transl' ),
                    'param_name'    => 'font_weight',
                    'group'         => __( 'Design', 'athen_transl' ),
                    'description'       => __( 'Note: Not all font families support every font weight.', 'athen_transl' ),
                    'value'             => vcex_font_weights(),
                    'std'               => '',
                ),

            ),
        ) );
    }
}
add_action( 'vc_before_init', 'vcex_testimonials_slider_shortcode_vc_map' );