<?php
/**
 * Registers the login form shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_login_form extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_login_form.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_login_form_shortcode_vc_map' ) ) {
    function vcex_login_form_shortcode_vc_map() {
        vc_map( array(
            'name'                  => __( 'Login Form', 'athen_transl' ),
            'description'           => __( 'Adds a WordPress login form', 'athen_transl' ),
            'base'                  => 'vcex_login_form',
            'category'              => ATHEN_NAME_THEME,
            'icon'                  => 'vcex-login-form',
            'params'                => array(
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
                    'type'          => 'dropdown',
                    'heading'       => __( 'CSS Animation', 'athen_transl' ),
                    'param_name'    => 'css_animation',
                    'value'         => array(
                        __( 'No', 'athen_transl')                   => '',
                        __( 'Top to bottom', 'athen_transl' )       => 'top-to-bottom',
                        __( 'Bottom to top', 'athen_transl' )       => 'bottom-to-top',
                        __( 'Left to right', 'athen_transl' )       => 'left-to-right',
                        __( 'Right to left', 'athen_transl' )       => 'right-to-left',
                        __( 'Appear from center', 'athen_transl' )  => 'appear',
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Redirect', 'athen_transl' ),
                    'param_name'    => 'redirect',
                    'description'   => __( 'Enter a URL to redirect the user after they successfully log in. Leave blank to redirect to the current page.','athen_transl'),
                ),
                array(
                    'type'          => 'textarea_html',
                    'heading'       => __( 'Logged in Content', 'athen_transl' ),
                    'param_name'    => 'content',
                    'value'         => __('You are currently logged in','athen_transl'),
                    'description'   => __( 'The content to displayed for logged in users.','athen_transl'),
                ),
            )
        ) );
    }
}
add_action( 'vc_before_init', 'vcex_login_form_shortcode_vc_map' );