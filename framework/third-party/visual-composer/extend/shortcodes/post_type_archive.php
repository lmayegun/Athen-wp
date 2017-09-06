<?php
/**
 * Registers the post type archive shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_post_type_archive extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_post_type_archive.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_post_type_archive_shortcode_vcmap' ) ) {
    function vcex_post_type_archive_shortcode_vcmap() {

        // Get global object
        global $vcex_global;

        // Get arrays
        $users_list      = $vcex_global->users_list;
        $taxonomies_list = $vcex_global->taxonomies;
        $terms_list      = $vcex_global->terms;

        // Add params
        vc_map( array(
            'name'                  => __( 'Post Types Archive', 'athen_transl' ),
            'description'           => __( 'Custom post type archive', 'athen_transl' ),
            'base'                  => 'vcex_post_type_archive',
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
                    'type'          => 'dropdown',
                    'heading'       => __( 'Post types', 'athen_transl' ),
                    'param_name'    => 'post_type',
                    'std'			=> '',
                    'value'			=> $vcex_global->post_types,
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

            )
        ) );
    }
}
add_action( 'init', 'vcex_post_type_archive_shortcode_vcmap' );