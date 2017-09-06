<?php
/**
 * Registers the recent news shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_recent_news extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_recent_news.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_news_shortcode_vc_map' ) ) {
    function vcex_news_shortcode_vc_map() {

        // Get list of taxonomies to narrow Query by
        $vc_taxonomies_types    = get_taxonomies( array( 'name' => 'category' ), 'objects' );
        $vc_taxonomies          = get_terms( array_keys( $vc_taxonomies_types ), array( 'hide_empty' => false ) );
        $taxonomies_list        = array();
        foreach ( $vc_taxonomies as $t ) {
            $taxonomies_list[] = array(
                'label' => $t->name,
                'value' => $t->term_id,
                'group' => __( 'Select', 'athen_transl' )
            );
        }

        // Add to VC
        vc_map( array(
            'name'                  => __( 'Recent News', 'athen_transl' ),
            'description'           => __( 'Recent blog posts', 'athen_transl' ),
            'base'                  => 'vcex_recent_news',
            'category'              => ATHEN_NAME_THEME,
            'icon'                  => 'vcex-recent-news',
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
                    'type'          => 'textfield',
                    'heading'       => __( 'Header', 'athen_transl' ),
                    'param_name'    => 'header',
                    'descrtiption'  => __( 'You can display a title above your recent posts.', 'athen_transl' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Columns', 'athen_transl' ),
                    'param_name'        => 'grid_columns',
                    'value'             => vcex_grid_columns(),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Visibility', 'athen_transl' ),
                    'param_name'        => 'visibility',
                    'value'             => vcex_visibility(),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Appear Animation', 'athen_transl'),
                    'param_name'        => 'css_animation',
                    'value'             => vcex_css_animations(),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),

                // Query
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Post Count', 'athen_transl' ),
                    'param_name'    => 'count',
                    'value'         => '3',
                    'descrtiption'  => __( 'How many posts do you wish to show.', 'athen_transl' ),
                    'group'         => __( 'Query', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Get Posts From', 'athen_transl' ),
                    'param_name'    => 'get_posts',
                    'group'         => __( 'Query', 'athen_transl' ),
                    'value'         => array(
                        __( 'Standard Posts','athen_transl' )       => 'standard_post_types',
                        __( 'Custom Post types','athen_transl' )    => 'custom_post_types',
                    ),
                ),
                array(
                    'type'          => 'posttypes',
                    'heading'       => __( 'Post types', 'athen_transl' ),
                    'param_name'    => 'post_types',
                    'group'         => __( 'Query', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'get_posts',
                        'value'     => 'custom_post_types'
                    ),
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
                    'dependency'    => Array(
                        'element'   => 'get_posts',
                        'value'     => 'standard_post_types'
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
                    'dependency'    => Array(
                        'element'   => 'get_posts',
                        'value'     => 'standard_post_types'
                    ),
                    'group'                 => __( 'Query', 'athen_transl' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Order', 'athen_transl' ),
                    'param_name'        => 'order',
                    'value'             => vcex_order_array(),
                    'group'             => __( 'Query', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Order By', 'athen_transl' ),
                    'param_name'        => 'orderby',
                    'value'             => vcex_orderby_array(),
                    'group'             => __( 'Query', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Ignore Sticky Posts', 'athen_transl' ),
                    'param_name'        => 'ignore_sticky_posts',
                    'value'             => array(
                        __( 'No', 'athen_transl' )  => '',
                        __( 'Yes', 'athen_transl' ) => 'true',
                    ),
                    'group'             => __( 'Query', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
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
                        __( 'No', 'athen_transl' )  => '',
                        __( 'Yes', 'athen_transl' ) => 'true',
                    ),
                    'description'   => __( 'Important: Pagination will not work on your homepage due to how WordPress Queries function.', 'athen_transl' ),
                    'group'         => __( 'Query', 'athen_transl' ),
                ),

                // Media
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Display Featured Media?', 'athen_transl' ),
                    'param_name'    => 'featured_image',
                    'value'         => array(
                        __( 'No', 'athen_transl' )  => '',
                        __( 'Yes', 'athen_transl' ) => 'true',
                    ),
                    'group'         => __( 'Media', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Display Featured Videos?', 'athen_transl' ),
                    'param_name'    => 'featured_video',
                    'value'         => array(
                        __( 'Yes', 'athen_transl' ) => '',
                        __( 'No', 'athen_transl' )  => 'false',
                    ),
                    'dependency'    => Array(
                        'element'   => 'featured_image',
                        'value'     => 'true'
                    ),
                    'group'         => __( 'Media', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Image Size', 'athen_transl' ),
                    'param_name'    => 'img_size',
                    'std'           => 'athen_custom',
                    'value'         => vcex_image_sizes(),
                    'group'         => __( 'Media', 'athen_transl' ),
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
                    'group'         => __( 'Media', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Image Crop Width', 'athen_transl' ),
                    'param_name'    => 'img_width',
                    'dependency'    => array(
                        'element'   => 'img_size',
                        'value'     => 'athen_custom',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'description'   => __( 'Enter a width in pixels.', 'athen_transl' ),
                    'group'         => __( 'Media', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Image Crop Height', 'athen_transl' ),
                    'param_name'    => 'img_height',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'dependency'    => array(
                        'element'   => 'img_size',
                        'value'     => 'athen_custom',
                    ),
                    'description'   => __( 'Enter a height in pixels. Leave empty to disable vertical cropping and keep image proportions.', 'athen_transl' ),
                    'group'         => __( 'Media', 'athen_transl' ),
                ),

                // Content
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Display Title?', 'athen_transl' ),
                    'param_name'    => 'title',
                    'value'         => array(
                        __( 'Yes', 'athen_transl' ) => '',
                        __( 'No', 'athen_transl' )  => 'false',
                    ),
                    'group'         => __( 'Title', 'athen_transl' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Title Font Weight', 'athen_transl' ),
                    'param_name'        => 'title_weight',
                    'group'             => __( 'Title', 'athen_transl' ),
                    'description'       => __( 'Note: Not all font families support every font weight.', 'athen_transl' ),
                    'std'               => '',
                    'value'             => vcex_font_weights(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Title Text Transform', 'athen_transl' ),
                    'param_name'        => 'title_transform',
                    'group'             => __( 'Title', 'athen_transl' ),
                    'std'               => '',
                    'description'       => __( 'Select a custom text transform to override the default.', 'athen_transl' ),
                    'value'             => vcex_text_transforms(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Title Font Size', 'athen_transl' ),
                    'param_name'        => 'title_size',
                    'description'       => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
                    'group'             => __( 'Title', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Title Line Height', 'athen_transl' ),
                    'param_name'        => 'title_line_height',
                    'description'       => __( 'Enter a numerical, pixel or percentage value.', 'athen_transl' ),
                    'group'             => __( 'Title', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Title Margin', 'athen_transl' ),
                    'param_name'        => 'title_margin',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
                    'group'             => __( 'Title', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),

                // Date
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Display Date?', 'athen_transl' ),
                    'param_name'    => 'date',
                    'value'         => array(
                        __( 'True','athen_transl' )     => '',
                        __( 'False','athen_transl' )    => 'false',
                    ),
                    'group'         => __( 'Date', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Month Background', 'athen_transl' ),
                    'param_name'    => 'month_background',
                    'group'         => __( 'Date', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Month Color', 'athen_transl' ),
                    'param_name'    => 'month_color',
                    'group'         => __( 'Date', 'athen_transl' ),
                ),

                // Excerpt
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Excerpt Length', 'athen_transl' ),
                    'param_name'    => 'excerpt_length',
                    'value'         => '30',
                    'description'   => __( 'Enter how many words to display for the excerpt. To display the full post content enter "-1". To display the full post content up to the "more" tag enter "9999".', 'athen_transl' ),
                    'group'         => __( 'Excerpt', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Excerpt Font Size', 'athen_transl' ),
                    'param_name'    => 'excerpt_font_size',
                    'description'   => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
                    'group'         => __( 'Excerpt', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Excerpt Color', 'athen_transl' ),
                    'param_name'    => 'excerpt_color',
                    'group'         => __( 'Excerpt', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Read More', 'athen_transl' ),
                    'param_name'    => 'read_more',
                    'value'         => array(
                        __( 'Yes', 'athen_transl')  => '',
                        __( 'No', 'athen_transl' )  => 'false',
                    ),
                    'group'         => __( 'Excerpt', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Read More Text', 'athen_transl' ),
                    'param_name'    => 'read_more_text',
                    'group'         => __( 'Excerpt', 'athen_transl' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Read More Style', 'athen_transl' ),
                    'param_name'        => 'readmore_style',
                    'value'             => vcex_button_styles(),
                    'group'             => __( 'Excerpt', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Read More Color', 'athen_transl' ),
                    'param_name'        => 'readmore_style_color',
                    'std'               => '',
                    'value'             => vcex_button_colors(),
                    'group'             => __( 'Excerpt', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Read More Arrow', 'athen_transl' ),
                    'param_name'        => 'readmore_rarr',
                    'value'             => array(
                        __( 'No', 'athen_transl' )  => '',
                        __( 'Yes', 'athen_transl')  => 'true',
                    ),
                    'group'             => __( 'Excerpt', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Read More Font Size', 'athen_transl' ),
                    'param_name'        => 'readmore_size',
                    'description'       => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
                    'group'             => __( 'Excerpt', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Read More Border Radius', 'athen_transl' ),
                    'param_name'        => 'readmore_border_radius',
                    'description'       => __( 'Please enter a px value.', 'athen_transl' ),
                    'group'             => __( 'Excerpt', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Read More Padding', 'athen_transl' ),
                    'param_name'        => 'readmore_padding',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
                    'group'             => __( 'Excerpt', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Read More Margin', 'athen_transl' ),
                    'param_name'        => 'readmore_margin',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
                    'group'             => __( 'Excerpt', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Read More Background', 'athen_transl' ),
                    'param_name'    => 'readmore_background',
                    'group'         => __( 'Excerpt', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Read More Color', 'athen_transl' ),
                    'param_name'    => 'readmore_color',
                    'group'         => __( 'Excerpt', 'athen_transl' ),
                ),

                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Read More Hover Background', 'athen_transl' ),
                    'param_name'    => 'readmore_hover_background',
                    'group'         => __( 'Excerpt', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Read More Hover Color', 'athen_transl' ),
                    'param_name'    => 'readmore_hover_color',
                    'group'         => __( 'Excerpt', 'athen_transl' ),
                ),

                // Design options
                array(
                    'type'          => 'css_editor',
                    'heading'       => __( 'CSS', 'athen_transl' ),
                    'param_name'    => 'css',
                    'description'   => __( 'If any of these are defined it will add a new wrapper around your icon box with the custom CSS applied to it.', 'athen_transl' ),
                    'group'         => __( 'Design options', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Article Bottom Border Color', 'athen_transl' ),
                    'param_name'    => 'entry_bottom_border_color',
                    'group'         => __( 'Design options', 'athen_transl' ),
                ),

            )
        ) );

    }
}
add_action( 'vc_before_init', 'vcex_news_shortcode_vc_map' );