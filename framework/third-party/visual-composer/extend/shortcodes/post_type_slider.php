<?php
/**
 * Registers the post type slider shortcode and adds it to the Visual Composer
 *
 * @package     Total
 * @subpackage  Framework/Visual Composer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       1.4.1
 * @version     2.0.03
 */

/**
 * Register shortcode with VC Composer
 *
 * @since 2.0.0
 */
class WPBakeryShortCode_vcex_post_type_flexslider extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_post_type_flexslider.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since 1.4.1
 */
if ( ! function_exists( 'vcex_post_type_flexslider_vc_map' ) ) {
    function vcex_post_type_flexslider_vc_map() {

        // Get global vcex object
        global $vcex_global;

        // Get arrays
        $users_list      = $vcex_global->users_list;
        $taxonomies_list = $vcex_global->taxonomies;
        $terms_list      = $vcex_global->terms;

        // Add params
        vc_map( array(
            'name'                  => __( 'Post Types Slider', 'athen_transl' ),
            'description'           => __( 'Recent posts slider', 'athen_transl' ),
            'base'                  => 'vcex_post_type_flexslider',
            'category'              => ATHEN_NAME_THEME,
            'icon'                  => 'vcex-post-type-slider',
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
                    'type'          => 'dropdown',
                    'heading'       => __( 'Visibility', 'athen_transl' ),
                    'param_name'    => 'visibility',
                    'value'         => vcex_visibility(),
                    'group'         => __( 'General', 'athen_transl' ),
                ),

                // Slider Settings
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Randomize', 'athen_transl' ),
                    'param_name'    => 'randomize',
                    'value'         => array(
                        __( 'No', 'athen_transl' )  => '',
                        __( 'Yes', 'athen_transl' ) => 'true',
                    ),
                    'description'   => __( 'Randomize image order display on page load?', 'athen_transl' ),
                    'group'         => __( 'Slider Settings', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Animation', 'athen_transl' ),
                    'param_name'    => 'animation',
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
                        __( 'No', 'athen_transl' )   => '',
                        __( 'Yes', 'athen_transl' )    => 'true',
                    ),
                    'group'         => __( 'Slider Settings', 'athen_transl' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Auto Height Animation', 'athen_transl' ),
                    'std'               => '500',
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
                        __( 'Yes', 'athen_transl' ) => 'true',
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
                    'heading'           => __( 'Arrows', 'athen_transl' ),
                    'param_name'        => 'direction_nav',
                    'value'             => array(
                        __( 'Yes', 'athen_transl' ) => '',
                        __( 'No', 'athen_transl' )  => 'false',
                    ),
                    'group'             => __( 'Slider Settings', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Arrows on Hover', 'athen_transl' ),
                    'param_name'        => 'direction_nav_hover',
                    'value'             => array(
                        __( 'Yes', 'athen_transl' ) => '',
                        __( 'No', 'athen_transl' )  => 'false',
                    ),
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
                    'heading'           => __( 'Thumbnails', 'athen_transl' ),
                    'param_name'        => 'control_thumbs',
                    'value'             => array(
                        __( 'Yes', 'athen_transl' ) => 'true',
                        __( 'No', 'athen_transl' )  => 'false',
                    ),
                    'group'             => __( 'Slider Settings', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Thumbnails Pointer', 'athen_transl' ),
                    'param_name'        => 'control_thumbs_pointer',
                    'value'             => array(
                        __( 'No', 'athen_transl' )  => '',
                        __( 'Yes', 'athen_transl' ) => 'true',
                    ),
                    'group'             => __( 'Slider Settings', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Navigation Thumbnails Height', 'athen_transl' ),
                    'param_name'        => 'control_thumbs_height',
                    'std'               => '70',
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
                    'std'               => '70',
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
                    'heading'       => __( 'Posts Per Page', 'athen_transl' ),
                    'param_name'    => 'posts_per_page',
                    'value'         => '4',
                    'description'   => __( 'You can enter "-1" to display all posts.', 'athen_transl' ),
                    'group'         => __( 'Query', 'athen_transl' ),
                ),
                array(
                    'type'          => 'posttypes',
                    'heading'       => __( 'Post types', 'athen_transl' ),
                    'param_name'    => 'post_types',
                    'group'         => __( 'Query', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Limit By Post ID\'s', 'athen_transl' ),
                    'param_name'    => 'posts_in',
                    'group'         => __( 'Query', 'athen_transl' ),
                    'description'   => __( 'Seperate by a comma.', 'athen_transl' ),
                ),
                array(
                    'type'          => 'autocomplete',
                    'heading'       => __( 'Limit By Author', 'athen_transl' ),
                    'param_name'    => 'author_in',
                    'settings'              => array(
                        'multiple'          => true,
                        'min_length'        => 1,
                        'groups'            => false,
                        'unique_values'     => true,
                        'display_inline'    => true,
                        'delay'             => 0,
                        'auto_focus'        => true,
                        'values'            => $users_list,
                    ),
                    'group'         => __( 'Query', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Query by Taxonomy', 'athen_transl' ),
                    'param_name'    => 'tax_query',
                    'value'         => array(
                        __( 'No', 'athen_transl' )  => '',
                        __( 'Yes', 'athen_transl')  => 'true',
                    ),
                    'group'         => __( 'Query', 'athen_transl' ),
                ),
                array(
                    'type'          => 'autocomplete',
                    'heading'       => __( 'Taxonomy Name', 'athen_transl' ),
                    'param_name'    => 'tax_query_taxonomy',
                    'dependency'    => array(
                        'element'   => 'tax_query',
                        'value'     => 'true',
                    ),
                    'settings'              => array(
                        'multiple'          => false,
                        'min_length'        => 1,
                        'groups'            => false,
                        'unique_values'     => true,
                        'display_inline'    => true,
                        'delay'             => 0,
                        'auto_focus'        => true,
                        'values'            => $taxonomies_list,
                    ),
                    'group'         => __( 'Query', 'athen_transl' ),
                ),
                array(
                    'type'          => 'autocomplete',
                    'heading'       => __( 'Terms', 'athen_transl' ),
                    'param_name'    => 'tax_query_terms',
                    'dependency'    => array(
                        'element'   => 'tax_query',
                        'value'     => 'true',
                    ),
                    'settings'              => array(
                        'multiple'          => true,
                        'min_length'        => 1,
                        'groups'            => true,
                        'unique_values'     => true,
                        'display_inline'    => true,
                        'delay'             => 0,
                        'auto_focus'        => true,
                        'values'            => $terms_list,
                    ),
                    'group'         => __( 'Query', 'athen_transl' ),
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


                // Image
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
                    'description'       => __( 'Enter a height in pixels. Leave empty to disable vertical cropping and keep image proportions.', 'athen_transl' ),
                    'dependency'    => array(
                        'element'   => 'img_size',
                        'value'     => 'athen_custom',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'group'             => __( 'Image', 'athen_transl' )
                ),

                // Caption
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Caption', 'athen_transl' ),
                    'param_name'    => 'caption',
                    'value'         => array(
                        __( 'Yes', 'athen_transl' ) => 'true',
                        __( 'No', 'athen_transl' )  => 'false',
                    ),
                    'group'         => __( 'Caption', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Caption Visibility', 'athen_transl' ),
                    'param_name'    => 'caption_visibility',
                    'value'         => vcex_visibility(),
                    'group'         => __( 'Caption', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Caption Location', 'athen_transl' ),
                    'param_name'    => 'caption_location',
                    'value'         => array(
                        __( 'Over Image', 'athen_transl' )  => 'over-image',
                        __( 'Under Image', 'athen_transl' ) => 'under-image',
                    ),
                    'group'         => __( 'Caption', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Title', 'athen_transl' ),
                    'param_name'    => 'title',
                    'value'         => array(
                        __( 'Yes', 'athen_transl' ) => 'true',
                        __( 'No', 'athen_transl' )  => 'false',
                    ),
                    'group'         => __( 'Caption', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Excerpt', 'athen_transl' ),
                    'param_name'    => 'excerpt',
                    'value'         => array(
                        __( 'Yes', 'athen_transl' ) => 'true',
                        __( 'No', 'athen_transl' )  => 'false',
                    ),
                    'group'         => __( 'Caption', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Excerpt Length', 'athen_transl' ),
                    'param_name'    => 'excerpt_length',
                    'value'         => '40',
                    'group'         => __( 'Caption', 'athen_transl' ),
                ),

                // Design
                array(
                    'type'          => 'css_editor',
                    'heading'       => __( 'CSS', 'athen_transl' ),
                    'param_name'    => 'css',
                    'description'   => __( 'If any of these are defined it will add a new wrapper around your icon box with the custom CSS applied to it.', 'athen_transl' ),
                    'group'         => __( 'Design', 'athen_transl' ),
                ),

            ),
            
        ) );
    }
}
add_action( 'init', 'vcex_post_type_flexslider_vc_map' );