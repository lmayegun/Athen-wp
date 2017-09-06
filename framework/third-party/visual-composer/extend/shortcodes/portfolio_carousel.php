<?php
/**
 * Registers the portfolio carousel shortcode and adds it to the Visual Composer
 *
 * @package     Total
 * @subpackage  Framework/Visual Composer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.4.1
 * @version     2.0.0
 */

// Return if post type is disabled
if ( ! ATHEN_CHECK_PORTFOLIO ) {
    return;
}

/**
 * Register shortcode with VC Composer
 *
 * @since 2.0.0
 */
class WPBakeryShortCode_vcex_portfolio_carousel extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_portfolio_carousel.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_portfolio_carousel_shortcode_vc_map' ) ) {
    function vcex_portfolio_carousel_shortcode_vc_map() {

        // Get list of taxonomies to narrow Query by
        $vc_taxonomies_types    = get_taxonomies( array( 'name' => 'portfolio_category' ), 'objects' );
        $vc_taxonomies          = get_terms( array_keys( $vc_taxonomies_types ), array( 'hide_empty' => false ) );
        $taxonomies_list        = array( 'portfolio_category' );
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
            'name'                  => __( 'Portfolio Carousel', 'athen_transl' ),
            'description'           => __( 'Recent portfolio posts carousel', 'athen_transl' ),
            'base'                  => 'vcex_portfolio_carousel',
            'category'              => ATHEN_NAME_THEME,
            'icon'                  => 'vcex-portfolio-carousel',
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
                    'type'             => 'dropdown',
                    'heading'          => __( 'Arrows?', 'athen_transl' ),
                    'param_name'       => 'arrows',
                    'value'            => array(
                        __( 'True', 'athen_transl' )  => 'true',
                        __( 'False', 'athen_transl' ) => 'false',
                    ),
                    'edit_field_class' => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Dots?', 'athen_transl' ),
                    'param_name'        => 'dots',
                    'value'             => array(
                        __( 'False', 'athen_transl' )   => 'false',
                        __( 'True', 'athen_transl' )    => 'true',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Items To Display', 'athen_transl' ),
                    'param_name'        => 'items',
                    'value'             => '4',
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Items To Scrollby', 'athen_transl' ),
                    'param_name'        => 'items_scroll',
                    'value'             => '1',
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Margin Between Items', 'athen_transl' ),
                    'param_name'        => 'items_margin',
                    'value'             => '15',
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Auto Play', 'athen_transl' ),
                    'param_name'        => 'auto_play',
                    'value'             => array(
                        __( 'True', 'athen_transl' )    => 'true',
                        __( 'False', 'athen_transl' )   => 'false',
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Infinite Loop', 'athen_transl' ),
                    'param_name'        => 'infinite_loop',
                    'value'             => array(
                        __( 'True', 'athen_transl' )    => 'true',
                        __( 'False', 'athen_transl' )   => 'false',
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Center Item', 'athen_transl' ),
                    'param_name'        => 'center',
                    'value'             => array(
                        __( 'False', 'athen_transl' )   => 'false',
                        __( 'True', 'athen_transl' )    => 'true',
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Timeout Duration in milliseconds', 'athen_transl' ),
                    'param_name'    => 'timeout_duration',
                    'value'         => '5000',
                    'dependency'    => Array(
                        'element'   => 'auto_play',
                        'value'     => 'true'
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Tablet: Items To Display', 'athen_transl' ),
                    'param_name'    => 'tablet_items',
                    'value'         => '3',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Mobile Landscape: Items To Display', 'athen_transl' ),
                    'param_name'    => 'mobile_landscape_items',
                    'value'         => '2',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Mobile Portrait: Items To Display', 'athen_transl' ),
                    'param_name'    => 'mobile_portrait_items',
                    'value'         => '1',
                ),
                
                // Query
                array(
                    'type'                  => 'autocomplete',
                    'heading'               => __( 'Include Categories', 'athen_transl' ),
                    'param_name'            => 'include_categories',
                    'param_holder_class'    => 'vc_not-for-custom',
                    'admin_label'           => true,
                    'settings'              => array(
                        'multiple'          => true,
                        'min_length'        => 1,
                        'groups'            => true,
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
                        'groups'            => true,
                        'unique_values'     => true,
                        'display_inline'    => true,
                        'delay'             => 0,
                        'auto_focus'        => true,
                        'values'            => $taxonomies_list,
                    ),
                    'group'                 => __( 'Query', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Post Count', 'athen_transl' ),
                    'param_name'    => 'count',
                    'value'         => '8',
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
                    'heading'       => __( 'Display Image', 'athen_transl' ),
                    'param_name'    => 'media',
                    'value'         => array(
                        __( 'Yes', 'athen_transl')  => '',
                        __( 'No', 'athen_transl' )  => 'false',
                    ),
                    'group'         => __( 'Image', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Image Links To', 'athen_transl' ),
                    'param_name'    => 'thumbnail_link',
                    'value'         => array(
                        __( 'Default', 'athen_transl')      => '',
                        __( 'Post', 'athen_transl')         => 'post',
                        __( 'Lightbox', 'athen_transl' )    => 'lightbox',
                        __( 'None', 'athen_transl' )        => 'none',
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
                    'type'          => 'textfield',
                    'heading'       => __( 'Image Crop Width', 'athen_transl' ),
                    'param_name'    => 'img_width',
                    'dependency'    => array(
                        'element'   => 'img_size',
                        'value'     => 'athen_custom',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'description'   => __( 'Enter a width in pixels.', 'athen_transl' ),
                    'group'         => __( 'Image', 'athen_transl' ),
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
                    'group'         => __( 'Image', 'athen_transl' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Image Overlay Style', 'athen_transl' ),
                    'param_name'        => 'overlay_style',
                    'value'             => vcex_image_overlays(),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                    'group'             => __( 'Image', 'athen_transl' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'CSS3 Image Link Hover', 'athen_transl' ),
                    'param_name'        => 'img_hover_style',
                    'value'             => vcex_image_hovers(),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                    'group'             => __( 'Image', 'athen_transl' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Image Rendering', 'athen_transl' ),
                    'param_name'        => 'img_rendering',
                    'value'             => vcex_image_rendering(),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                    'group'             => __( 'Image', 'athen_transl' ),
                ),

                // Title
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Display Title', 'athen_transl' ),
                    'param_name'    => 'title',
                    'value'         => array(
                        __( 'Yes', 'athen_transl')  => 'true',
                        __( 'No', 'athen_transl' )  => 'false',
                    ),
                    'group'         => __( 'Title', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Title Text Color', 'athen_transl' ),
                    'param_name'    => 'content_heading_color',
                    'group'         => __( 'Title', 'athen_transl' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Title Font Size', 'athen_transl' ),
                    'param_name'        => 'content_heading_size',
                    'description'       => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
                    'group'             => __( 'Title', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Title Margin', 'athen_transl' ),
                    'param_name'        => 'content_heading_margin',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
                    'group'             => __( 'Title', 'athen_transl' ),
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
                    'type'              => 'dropdown',
                    'heading'           => __( 'Title Font Weight', 'athen_transl' ),
                    'param_name'        => 'content_heading_weight',
                    'description'       => __( 'Note: Not all font families support every font weight.', 'athen_transl' ),
                    'std'               => '',
                    'value'             => vcex_font_weights(),
                    'group'             => __( 'Title', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Title Text Transform', 'athen_transl' ),
                    'param_name'        => 'content_heading_transform',
                    'value'             => vcex_text_transforms(),
                    'group'             => __( 'Title', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),

                // Excerpt
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Display Excerpt', 'athen_transl' ),
                    'param_name'    => 'excerpt',
                    'value'         => array(
                        __( 'Yes', 'athen_transl')  => 'true',
                        __( 'No', 'athen_transl' )  => 'false',
                    ),
                    'group'         => __( 'Excerpt', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Excerpt Length', 'athen_transl' ),
                    'param_name'    => 'excerpt_length',
                    'value'         => '30',
                    'description'   => __( 'Enter how many words to display for the excerpt. To display the full post content enter "9999".', 'athen_transl' ),
                    'group'         => __( 'Excerpt', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Excerpt Font Size', 'athen_transl' ),
                    'param_name'    => 'content_font_size',
                    'description'   => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
                    'group'         => __( 'Excerpt', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Excerpt Text Color', 'athen_transl' ),
                    'param_name'    => 'content_color',
                    'group'         => __( 'Excerpt', 'athen_transl' ),
                ),

                // Design
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Style', 'athen_transl' ),
                    'param_name'    => 'style',
                    'value'         => array(
                        __( 'Default', 'athen_transl')      => 'default',
                        __( 'No Margins', 'athen_transl' )  => 'no-margins',
                    ),
                    'group'         => __( 'Design', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Display Arrows?', 'athen_transl' ),
                    'param_name'    => 'arrows',
                    'value'         => array(
                        __( 'True', 'athen_transl' )    => 'true',
                        __( 'False', 'athen_transl' )   => 'false',
                    ),
                    'group'         => __( 'Design', 'athen_transl' ),
                ),
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
                    'heading'           => __( 'Content Opacity', 'athen_transl' ),
                    'param_name'        => 'content_opacity',
                    'description'       => __( 'Enter a value between "0" and "1".', 'athen_transl' ),
                    'group'             => __( 'Design', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Content Border', 'athen_transl' ),
                    'param_name'        => 'content_border',
                    'description'       => __( 'Please use the shorthand format: width style color. Enter 0px or "none" to disable border.', 'athen_transl' ),
                    'group'             => __( 'Design', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),

            ),
        ) );
    }
}
add_action( 'vc_before_init', 'vcex_portfolio_carousel_shortcode_vc_map' );