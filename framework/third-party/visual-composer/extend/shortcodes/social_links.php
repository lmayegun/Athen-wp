<?php
/**
 * Registers the social links shortcode and adds it to the Visual Composer
 *
 * @package     Total
 * @subpackage  Framework/Visual Composer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
 * @version     1.0.0
 */

/**
 * Register shortcode with VC Composer
 *
 * @since 2.0.0
 */
class WPBakeryShortCode_vcex_social_links extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_social_links.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since 2.0.0
 */
if ( ! function_exists( 'vcex_social_links_shortcode_vc_map' ) ) {
    function vcex_social_links_shortcode_vc_map() {

        // Define params var
        $params = array(
            array(
                'type'          => 'textfield',
                'heading'       => __( 'Unique Id', 'athen_transl' ),
                'description'   => __( 'Give your main element a unique ID.', 'athen_transl' ),
                'param_name'    => 'unique_id',
            ),
            array(
                'type'          => 'textfield',
                'heading'       => __( 'Classes', 'athen_transl' ),
                'param_name'    => 'classes',
                'description'   => __( 'Add extra classnames to the wrapper.', 'athen_transl' ),
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
        );

        // Get array of social links to loop through
        $social_links = vcex_social_links_profiles();

        // Loop through social links and add to params
        foreach ( $social_links as $key => $val ) {

            $desc = ( 'email' == $key ) ? __( 'Format: mailto:email@site.com', 'athen_transl' ) : '';

            $params[] = array(
                'type'          => 'textfield',
                'heading'       => $val['label'],
                'param_name'    => $key,
                'group'         => __( 'Profiles', 'athen_transl' ),
                'description'   => $desc,
            );

        }

        // Add CSS option
        $params[] = array(
            'type'          => 'css_editor',
            'heading'       => __( 'CSS', 'athen_transl' ),
            'param_name'    => 'css',
            'group'         => __( 'Design', 'athen_transl' ),
        );

        $params[] = array(
            'type'          => 'dropdown',
            'heading'       => __( 'Align', 'athen_transl' ),
            'param_name'    => 'align',
            'value'         => vcex_alignments(),
            'group'         => __( 'Design', 'athen_transl' ),
        );

        $params[] = array(
            'type'          => 'textfield',
            'heading'       => __( 'Size', 'athen_transl' ),
            'param_name'    => 'size',
            'group'         => __( 'Design', 'athen_transl' ),
            'description'   => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
        );

         $params[] = array(
            'type'          => 'textfield',
            'heading'       => __( 'Border Radius', 'athen_transl' ),
            'param_name'    => 'border_radius',
            'group'         => __( 'Design', 'athen_transl' ),
            'description'   => __( 'Please enter a px value.', 'athen_transl' ),
        );

        $params[] = array(
            'type'          => 'colorpicker',
            'heading'       => __( 'Color', 'athen_transl' ),
            'param_name'    => 'color',
            'group'         => __( 'Design', 'athen_transl' ),
        );

        $params[] = array(
            'type'          => 'colorpicker',
            'heading'       => __( 'Hover Background', 'athen_transl' ),
            'param_name'    => 'hover_bg',
            'group'         => __( 'Design', 'athen_transl' ),
        );

        $params[] = array(
            'type'          => 'colorpicker',
            'heading'       => __( 'Hover Color', 'athen_transl' ),
            'param_name'    => 'hover_color',
            'group'         => __( 'Design', 'athen_transl' ),
        );

        // Add to VC
        vc_map( array(
            'name'                  => __( 'Social Links', 'athen_transl' ),
            'description'           => __( 'Display social links using icon fonts', 'athen_transl' ),
            'base'                  => 'vcex_social_links',
            'category'              => ATHEN_NAME_THEME,
            'icon'                  => 'vcex-social-links',
            'params'                => $params,
        ) );
    }
}
add_action( 'vc_before_init', 'vcex_social_links_shortcode_vc_map' );