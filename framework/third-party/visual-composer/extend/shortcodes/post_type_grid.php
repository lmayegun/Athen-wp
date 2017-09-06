<?php
/**
 * Registers the post type grid shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_post_type_grid extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_post_type_grid.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_post_type_grid_shortcode_vcmap' ) ) {
    function vcex_post_type_grid_shortcode_vcmap() {

        // Get global object
        global $vcex_global;

        // Get arrays
        $users_list      = $vcex_global->users_list;
        $taxonomies_list = $vcex_global->taxonomies;
        $terms_list      = $vcex_global->terms;

        // Add params
        vc_map( array(
            'name'                  => __( 'Post Types Grid', 'athen_transl' ),
            'description'           => __( 'Multiple post types posts grid', 'athen_transl' ),
            'base'                  => 'vcex_post_type_grid',
            'category'              => ATHEN_NAME_THEME,
            'icon'                  => 'vcex-post-type-grid',
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
                    'description'       => __( 'If the "filter" is enabled animations will be disabled to prevent bugs.', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Grid Style', 'athen_transl' ),
                    'param_name'    => 'grid_style',
                    'value'         => array(
                        __( 'Fit Columns', 'athen_transl' ) => 'fit_columns',
                        __( 'Masonry', 'athen_transl' )     => 'masonry',
                        __( 'No Margins', 'athen_transl' )  => 'no_margins',
                    ),
                     'edit_field_class'  => 'vc_col-sm-3 vc_column clear',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Columns', 'athen_transl' ),
                    'param_name'    => 'columns',
                    'value'         => vcex_grid_columns(),
                    'std'               => '4',
                    'edit_field_class'  => 'vc_col-sm-3 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Gap', 'athen_transl' ),
                    'param_name'        => 'columns_gap',
                    'value'             => vcex_column_gaps(),
                    'std'               => '20',
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
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( '1 Column Style', 'athen_transl' ),
                    'param_name'    => 'single_column_style',
                    'value'         => array(
                        __( 'Default', 'athen_transl')                      => '',
                        __( 'Left Image & Right Content', 'athen_transl' )  => 'left_thumbs',
                    ),
                    'dependency'    => array(
                        'element'   => 'columns',
                        'value' => '1',
                    ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Equal Heights?', 'athen_transl' ),
                    'param_name'    => 'equal_heights_grid',
                    'value'         => array(
                        __( 'No', 'athen_transl' )  => '',
                        __( 'Yes', 'athen_transl')  => 'true',
                    ),
                    'dependency'    => array(
                        'element'   => 'grid_style',
                        'value'     => 'fit_columns',
                    ),
                    'description'   => __( 'Adds equal heights for the entry content so entries on the same row are the same height. You must have equal sized images for this to work efficiently. Disabled for masonry style layouts and filterable layouts.', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Post Link Target', 'athen_transl' ),
                    'param_name'    => 'url_target',
                     'value'        => array(
                        __( 'Self', 'athen_transl')     => '',
                        __( 'Blank', 'athen_transl')    => '_blank',
                    ),
                ),

                // Query
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Posts Per Page', 'athen_transl' ),
                    'param_name'    => 'posts_per_page',
                    'value'         => '12',
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
                        //'unique_values'     => true,
                        'display_inline'    => true,
                        'delay'             => 0,
                        'auto_focus'        => true,
                        'values'            => $taxonomies_list,
                    ),
                    'group'         => __( 'Query', 'athen_transl' ),
                    'description'   => __( 'If you do not see your taxonomy in the dropdown you can still enter the taxonomy name manually.', 'athen_transl' ),
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
                        //'unique_values'     => true,
                        'display_inline'    => true,
                        'delay'             => 0,
                        'auto_focus'        => true,
                        'values'            => $terms_list,
                    ),
                    'group'         => __( 'Query', 'athen_transl' ),
                    'description'   => __( 'If you do not see your terms in the dropdown you can still enter the term slugs manually seperated by a space.', 'athen_transl' ),
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
                        __( 'False', 'athen_transl')    => '',
                        __( 'True', 'athen_transl' )    => 'true',
                    ),
                    'description'   => __( 'Important: Pagination will not work on your homepage due to how WordPress Queries function.', 'athen_transl' ),
                    'group'         => __( 'Query', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Post With Thumbnails Only', 'athen_transl' ),
                    'param_name'    => 'thumbnail_query',
                    'value'         => array(
                        __( 'No', 'athen_transl' )  => '',
                        __( 'Yes', 'athen_transl')  => 'true',
                    ),
                    'group'         => __( 'Query', 'athen_transl' ),
                ),

                // Filter
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Filter', 'athen_transl' ),
                    'param_name'    => 'filter',
                    'value'         => array(
                        __( 'No', 'athen_transl' )  => '',
                        __( 'Yes', 'athen_transl')  => 'true',
                    ),
                    'description'   => __( 'If more then one post type is selected it will display a post type filter, otherwise it will display the categories for the current post type.', 'athen_transl' ),
                    'group'         => __( 'Filter', 'athen_transl' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Filter What?', 'athen_transl' ),
                    'param_name'        => 'filter_type',
                    'value'             => array(
                        __( 'Post Types', 'athen_transl' )      => '',
                        __( 'Custom Taxonomy', 'athen_transl')  => 'taxonomy',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'group'             => __( 'Filter', 'athen_transl' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Layout Mode', 'athen_transl' ),
                    'param_name'        => 'masonry_layout_mode',
                    'value'             => array(
                        __( 'Masonry', 'athen_transl' )     => 'masonry',
                        __( 'Fit Rows', 'athen_transl' )    => 'fitRows',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'group'             => __( 'Filter', 'athen_transl' ),
                ),
                array(
                    'type'          => 'autocomplete',
                    'heading'       => __( 'Filter Taxonomy Name', 'athen_transl' ),
                    'param_name'    => 'filter_taxonomy',
                    'dependency'    => Array(
                        'element'   => 'filter_type',
                        'value'     => array( 'taxonomy' ),
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
                    'description'   => __( 'Enter the taxonomy name for the filter links.', 'athen_transl' ),
                    'group'         => __( 'Filter', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Custom Filter Speed', 'athen_transl' ),
                    'param_name'    => 'filter_speed',
                    'description'   => __( 'Default is "0.4" seconds. Enter "0.0" to disable.', 'athen_transl' ),
                    'group'         => __( 'Filter', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Center Filter Links', 'athen_transl' ),
                    'param_name'    => 'center_filter',
                    'value'         => array(
                        __( 'No', 'athen_transl' )  => '',
                        __( 'Yes', 'athen_transl' ) => 'yes',
                    ),
                    'group'         => __( 'Filter', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Custom Filter "All" Text', 'athen_transl' ),
                    'param_name'    => 'all_text',
                    'group'         => __( 'Filter', 'athen_transl' ),
                ),

                // Media
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Entry Media', 'athen_transl' ),
                    'param_name'    => 'entry_media',
                    'value'         => array(
                        __( 'Yes', 'athen_transl')  => '',
                        __( 'No', 'athen_transl' )  => 'false',
                    ),
                    'group'         => __( 'Media', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Display Featured Videos?', 'athen_transl' ),
                    'param_name'    => 'featured_video',
                    'value'         => array(
                        __( 'True', 'athen_transl')     => '',
                        __( 'False', 'athen_transl' )   => 'false',
                    ),
                    'group'         => __( 'Media', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Image Links To', 'athen_transl' ),
                    'param_name'    => 'thumb_link',
                    'value'         => array(
                        __( 'Default', 'athen_transl' )     => '',
                        __( 'Post', 'athen_transl' )        => 'post',
                        __( 'Lightbox', 'athen_transl' )    => 'lightbox',
                        __( 'Nowhere', 'athen_transl' )     => 'nowhere',
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
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Image Overlay Style', 'athen_transl' ),
                    'param_name'        => 'overlay_style',
                    'value'             => vcex_image_overlays(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                    'group'             => __( 'Media', 'athen_transl' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'CSS3 Image Link Hover', 'athen_transl' ),
                    'param_name'        => 'img_hover_style',
                    'value'             => vcex_image_hovers(),
                    'group'             => __( 'Media', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Image Filter', 'athen_transl' ),
                    'param_name'        => 'img_filter',
                    'value'             => vcex_image_filters(),
                    'group'             => __( 'Media', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Image Rendering', 'athen_transl' ),
                    'param_name'        => 'img_rendering',
                    'value'             => vcex_image_rendering(),
                    'group'             => __( 'Media', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),

                // Title
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Title', 'athen_transl' ),
                    'param_name'    => 'title',
                    'value'         => array(
                        __( 'Yes', 'athen_transl' )  => '',
                        __( 'No', 'athen_transl' )  => 'false',
                    ),
                    'group'         => __( 'Title', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Title Color', 'athen_transl' ),
                    'param_name'    => 'content_heading_color',
                    'group'         => __( 'Title', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Title Font Size', 'athen_transl' ),
                    'param_name'    => 'content_heading_size',
                    'group'         => __( 'Title', 'athen_transl' ),
                    'description'   => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Title Line Height', 'athen_transl' ),
                    'param_name'        => 'content_heading_line_height',
                    'description'       => __( 'Enter a numerical, pixel or percentage value.', 'athen_transl' ),
                    'group'             => __( 'Title', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Title Margin', 'athen_transl' ),
                    'param_name'    => 'content_heading_margin',
                    'group'         => __( 'Title', 'athen_transl' ),
                    'description'   => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Title Font Weight', 'athen_transl' ),
                    'param_name'        => 'content_heading_weight',
                    'group'             => __( 'Title', 'athen_transl' ),
                    'description'       => __( 'Note: Not all font families support every font weight.', 'athen_transl' ),
                    'std'               => '',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                    'value'             => vcex_font_weights(),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Title Text Transform', 'athen_transl' ),
                    'param_name'        => 'content_heading_transform',
                    'group'             => __( 'Title', 'athen_transl' ),
                    'std'               => '',
                    'description'       => __( 'Select a custom text transform to override the default.', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'value'             => vcex_text_transforms(),
                ),

                // Date
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Date', 'athen_transl' ),
                    'param_name'    => 'date',
                    'value'         => array(
                        __( 'Yes', 'athen_transl' ) => '',
                        __( 'No', 'athen_transl' )  => 'false',
                    ),
                    'group'         => __( 'Date', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Date Color', 'athen_transl' ),
                    'param_name'    => 'date_color',
                    'group'         => __( 'Date', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Date Font Size', 'athen_transl' ),
                    'param_name'    => 'date_font_size',
                    'description'   => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
                    'group'         => __( 'Date', 'athen_transl' ),
                ),

                // Excerpt
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Excerpt', 'athen_transl' ),
                    'param_name'    => 'excerpt',
                    'value'         => array(
                        __( 'Yes', 'athen_transl' )  => '',
                        __( 'No', 'athen_transl' )  => 'false',
                    ),
                    'group'         => __( 'Excerpt', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Custom Excerpt Length', 'athen_transl' ),
                    'param_name'    => 'excerpt_length',
                    'group'         => __( 'Excerpt', 'athen_transl' ),
                    'description'   => __( 'Enter how many words to display for the excerpt. To display the full post content enter "-1". To display the full post content up to the "more" tag enter "9999".', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Excerpt Font Size', 'athen_transl' ),
                    'param_name'    => 'content_font_size',
                    'description'   => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
                    'group'         => __( 'Excerpt', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Excerpt Color', 'athen_transl' ),
                    'param_name'    => 'content_color',
                    'group'         => __( 'Excerpt', 'athen_transl' ),
                ),

                // Readmore
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Read More', 'athen_transl' ),
                    'param_name'    => 'read_more',
                    'value'         => array(
                        __( 'Yes', 'athen_transl' )  => '',
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
                    'std'               => '',
                    'value'             => vcex_button_styles(),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                    'group'             => __( 'Excerpt', 'athen_transl' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Read More Color', 'athen_transl' ),
                    'param_name'        => 'readmore_style_color',
                    'std'               => '',
                    'value'             => vcex_button_colors(),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                    'group'             => __( 'Excerpt', 'athen_transl' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Read More Arrow', 'athen_transl' ),
                    'param_name'        => 'readmore_rarr',
                    'value'             => array(
                        __( 'No', 'athen_transl' )  => '',
                        __( 'Yes', 'athen_transl' ) => 'true',
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                    'group'             => __( 'Excerpt', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Read More Font Size', 'athen_transl' ),
                    'param_name'    => 'readmore_size',
                    'description'   => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                    'group'         => __( 'Excerpt', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Read More Border Radius', 'athen_transl' ),
                    'param_name'    => 'readmore_border_radius',
                    'description'   => __( 'Please enter a px value.', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'group'         => __( 'Excerpt', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Read More Padding', 'athen_transl' ),
                    'param_name'    => 'readmore_padding',
                    'description'   => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                    'group'         => __( 'Excerpt', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Read More Margin', 'athen_transl' ),
                    'param_name'    => 'readmore_margin',
                    'description'   => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'group'         => __( 'Excerpt', 'athen_transl' ),
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

                // Design
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Content Background', 'athen_transl' ),
                    'param_name'    => 'content_background',
                    'group'         => __( 'Design', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Content Alignment', 'athen_transl' ),
                    'param_name'    => 'content_alignment',
                    'value'         => vcex_alignments(),
                    'group'         => __( 'Design', 'athen_transl' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Content Margin', 'athen_transl' ),
                    'param_name'        => 'content_margin',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
                    'group'             => __( 'Design', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Content Padding', 'athen_transl' ),
                    'param_name'        => 'content_padding',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
                    'group'             => __( 'Design', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Content Border', 'athen_transl' ),
                    'param_name'        => 'content_border',
                    'description'       => __( 'Please use the shorthand format: width style color. Enter 0px or "none" to disable border.', 'athen_transl' ),
                    'group'             => __( 'Design', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Content Opacity', 'athen_transl' ),
                    'param_name'        => 'content_opacity',
                    'description'       => __( 'Enter a value between "0" and "1".', 'athen_transl' ),
                    'group'             => __( 'Design', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),

            )
        ) );
    }
}
add_action( 'init', 'vcex_post_type_grid_shortcode_vcmap' );