<?php
/**
 * Registers the image swap shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_image_swap extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_image_swap.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_image_swap_shortcode_vc_map' ) ) {
    function vcex_image_swap_shortcode_vc_map() {
        $vc_img_rendering_url = 'https://developer.mozilla.org/en-US/docs/Web/CSS/image-rendering';
        vc_map( array(
            'name'                  => __( 'Image Swap', 'athen_transl' ),
            'description'           => __( 'Double Image Hover Effect', 'athen_transl' ),
            'base'                  => 'vcex_image_swap',
            'icon'                  => 'vcex-image-swap',
            'category'              => ATHEN_NAME_THEME,
            'params'                => array(

                // General
                array(
                    'type'              => 'attach_image',
                    'heading'           => __( 'Primary Image', 'athen_transl' ),
                    'param_name'        => 'primary_image',
                ),
                array(
                    'type'              => 'attach_image',
                    'heading'           => __( 'Secondary Image', 'athen_transl' ),
                    'param_name'        => 'secondary_image',
                ),
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
                    'heading'       => __( 'Appear Animation', 'athen_transl'),
                    'param_name'    => 'css_animation',
                    'value'         => vcex_css_animations(),
                    'description'   => __( 'If the "filter" is enabled animations will be disabled to prevent bugs.', 'athen_transl' ),
                ),
                
                // Image Cropping
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Container Width', 'athen_transl' ),
                    'param_name'    => 'container_width',
                    'group'         => __( 'Image', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Border Radius', 'athen_transl' ),
                    'param_name'    => 'border_radius',
                    'description'   => __( 'Please enter a px value.', 'athen_transl' ),
                    'group'         => __( 'Image', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Image Crop Width', 'athen_transl' ),
                    'param_name'    => 'img_width',
                    'description'   => __( 'Enter a width in pixels.', 'athen_transl' ),
                    'group'         => __( 'Image', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Image Crop Height', 'athen_transl' ),
                    'param_name'    => 'img_height',
                    'description'   => __( 'Enter a height in pixels. Leave empty to disable vertical cropping and keep image proportions.', 'athen_transl' ),
                    'group'         => __( 'Image', 'athen_transl' ),
                ),

                // Link
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Link', 'athen_transl' ),
                    'param_name'    => 'link',
                    'group'         => __( 'Link', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Link Title', 'athen_transl' ),
                    'param_name'    => 'link_title',
                    'group'         => __( 'Link', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Link Target', 'athen_transl' ),
                    'param_name'    => 'link_target',
                    'value'         => array(
                        __( 'Same window', 'athen_transl' ) => '',
                        __( 'New window', 'athen_transl' )  => '_blank'
                    ),
                    'group'         => __( 'Link', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Enable Tooltip?', 'athen_transl' ),
                    'param_name'    => 'link_tooltip',
                    'value'         => array(
                        __( 'No', 'athen_transl' )  => '',
                        __( 'Yes', 'athen_transl' ) => 'true'
                    ),
                    'group'         => __( 'Link', 'athen_transl' ),
                ),

                // Design Options
                array(
                    'type'          => 'css_editor',
                    'heading'       => __( 'CSS', 'athen_transl' ),
                    'param_name'    => 'css',
                    'description'   => __( 'These settings are applied to the main wrapper and they will override any other styling options.', 'athen_transl' ),
                    'group'         => __( 'Design options', 'athen_transl' ),
                ),

            )
        ) );
    }
}
add_action( 'vc_before_init', 'vcex_image_swap_shortcode_vc_map' );