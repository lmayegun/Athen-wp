<?php
/**
 * Registers the bullets shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_bullets extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_bullets.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_bullets_shortcode_vc_map' ) ) {
    function vcex_bullets_shortcode_vc_map() {
        vc_map( array(
            'name'          => __( 'Bullets', 'athen_transl' ),
            'description'   => __( 'Styled bulleted lists', 'athen_transl' ),
            'base'          => 'vcex_bullets',
            'category'      => ATHEN_NAME_THEME,
            'icon'          => 'vcex-bullets',
            'params'        => array(
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Style', 'athen_transl' ),
                    'param_name'    => 'style',
                    'admin_label'   => true,
                    'value'         => array(
                        __( 'Check', 'athen_transl')    => 'check',
                        __( 'Blue', 'athen_transl' )    => 'blue',
                        __( 'Gray', 'athen_transl' )    => 'gray',
                        __( 'Purple', 'athen_transl' )  => 'purple',
                        __( 'Red', 'athen_transl' )     => 'red',
                    ),
                ),
                array(
                    'type'          => 'textarea_html',
                    'heading'       => __( 'Insert Unordered List', 'athen_transl' ),
                    'param_name'    => 'content',
                    'value'         => '<ul><li>List 1</li><li>List 2</li><li>List 3</li><li>List 4</li></ul>',
                ),
            )
        ) );
    }
}
add_action( 'vc_before_init', 'vcex_bullets_shortcode_vc_map' );