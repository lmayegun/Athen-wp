<?php
/**
 * Registers the testimonials grid shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_testimonials_grid extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_testimonials_grid.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the testimonials grid shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_testimonials_grid_shortcode_vc_map' ) ) {
    function vcex_testimonials_grid_shortcode_vc_map() {

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

        // Add VC params
        vc_map( array(
            'name'                  => __( 'Testimonials Grid', 'athen_transl' ),
            'description'           => __( 'Recent testimonials post grid', 'athen_transl' ),
            'base'                  => 'vcex_testimonials_grid',
            'category'              => ATHEN_NAME_THEME,
            'icon'                  => 'vcex-testimonials-grid',
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
                    'type'              => 'dropdown',
                    'heading'           => __( 'Grid Style', 'athen_transl' ),
                    'param_name'        => 'grid_style',
                    'value'             => array(
                        __( 'Fit Columns', 'athen_transl' ) => 'fit_columns',
                        __( 'Masonry', 'athen_transl' )     => 'masonry',
                    ),
                     'edit_field_class'  => 'vc_col-sm-3 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Columns', 'athen_transl' ),
                    'param_name'        => 'columns',
                    'value'             => vcex_grid_columns(),
                    'std'               => '3',
                    'edit_field_class'  => 'vc_col-sm-3 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Gap', 'athen_transl' ),
                    'param_name'        => 'columns_gap',
                    'value'             => vcex_column_gaps(),
                    'edit_field_class'  => 'vc_col-sm-3 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Responsive', 'athen_transl' ),
                    'param_name'        => 'columns_responsive',
                    'value'             => array(
                        __( 'Yes', 'athen_transl' ) => '',
                        __( 'No', 'athen_transl' )  => 'false',
                    ),
                    'std'               => '',
                    'edit_field_class'  => 'vc_col-sm-3 vc_column',
                ),
                
                // Query
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Posts Per Page', 'athen_transl' ),
                    'param_name'    => 'posts_per_page',
                    'value'         => '-1',
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
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Pagination', 'athen_transl' ),
                    'param_name'    => 'pagination',
                    'value'         => array(
                        __( 'No', 'athen_transl' )  => 'false',
                        __( 'Yes', 'athen_transl' ) => 'true',
                    ),
                    'description'   => __( 'Important: Pagination will not work on your homepage due to how WordPress Queries function.', 'athen_transl' ),
                    'group'         => __( 'Query', 'athen_transl' ),
                ),

                // Filter
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Category Filter', 'athen_transl' ),
                    'param_name'    => 'filter',
                    'value'         => array(
                        __( 'No', 'athen_transl' )  => '',
                        __( 'Yes', 'athen_transl' ) => 'true',
                    ),
                    'group'         => __( 'Filter', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Layout Mode', 'athen_transl' ),
                    'param_name'    => 'masonry_layout_mode',
                    'value'         => array(
                        __( 'Masonry', 'athen_transl' )     => 'masonry',
                        __( 'Fit Rows', 'athen_transl' )    => 'fitRows',
                    ),
                    'group'         => __( 'Filter', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Custom Filter Speed', 'athen_transl' ),
                    'param_name'    => 'filter_speed',
                    'description'   => __( 'Default is "0.4" seconds', 'athen_transl' ),
                    'group'         => __( 'Filter', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Center Filter Links', 'athen_transl' ),
                    'param_name'    => 'center_filter',
                    'value'         => array(
                        __( 'No', 'athen_transl' )  => 'no',
                        __( 'Yes', 'athen_transl' ) => 'yes',
                    ),
                    'group'         => __( 'Filter', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Custom Filter "All" Text', 'athen_transl' ),
                    'param_name'    => 'all_text',
                    'value'         => __( 'All', 'athen_transl' ),
                    'group'         => __( 'Filter', 'athen_transl' ),
                ),

                // Image
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

                // Excerpt
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Excerpt', 'athen_transl' ),
                    'param_name'    => 'excerpt',
                    'value'         => array(
                        __( 'No', 'athen_transl' )  => 'false',
                        __( 'Yes', 'athen_transl' ) => 'true',
                    ),
                     'group'         => __( 'Excerpt', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Excerpt Length', 'athen_transl' ),
                    'param_name'    => 'excerpt_length',
                    'value'         => '20',
                    'dependency'    => Array(
                        'element'   => 'excerpt',
                        'value'     => array( 'true' )
                    ),
                     'group'         => __( 'Excerpt', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Read More', 'athen_transl' ),
                    'param_name'    => 'read_more',
                    'value'         => array(
                        __( 'Yes', 'athen_transl' ) => 'true',
                        __( 'No', 'athen_transl' )  => 'false',
                    ),
                    'dependency'    => Array(
                        'element'   => 'excerpt',
                        'value'     => array( 'true' )
                    ),
                    'group'         => __( 'Excerpt', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Read More Text', 'athen_transl' ),
                    'param_name'    => 'read_more_text',
                    'dependency'    => Array(
                        'element'   => 'excerpt',
                        'value'     => array( 'true' )
                    ),
                    'dependency'    => Array(
                        'element'   => 'excerpt',
                        'value'     => array( 'true' )
                    ),
                    'group'         => __( 'Excerpt', 'athen_transl' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Read More Arrow', 'athen_transl' ),
                    'param_name'        => 'read_more_rarr',
                    'value'             => array(
                        __( 'Yes', 'athen_transl' ) => '',
                        __( 'No', 'athen_transl')   => 'false',
                    ),
                    'dependency'    => Array(
                        'element'   => 'excerpt',
                        'value'     => array( 'true' )
                    ),
                    'group'             => __( 'Excerpt', 'athen_transl' ),
                ),

            ),
        ) );
    }
}
add_action( 'vc_before_init', 'vcex_testimonials_grid_shortcode_vc_map' );