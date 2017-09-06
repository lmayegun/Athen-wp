<?php
/**
 * Registers the newsletter form shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_newsletter_form extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_newsletter_form.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_newsletter_form_shortcode_vc_map' ) ) {
    function vcex_newsletter_form_shortcode_vc_map() {

        // VC Map
        vc_map( array(
            'name'                  => __( 'Mailchimp Form', 'athen_transl' ),
            'description'           => __( 'Newsletter subscription form', 'athen_transl' ),
            'base'                  => 'vcex_newsletter_form',
            'category'              => ATHEN_NAME_THEME,
            'icon'                  => 'vcex-newsletter',
            'params'                => array(

                // General
                array(
                    'type'          => 'textfield',
                    'admin_label'   => true,
                    'heading'       => __( 'Unique Id', 'athen_transl' ),
                    'description'   => __( 'Give your main element a unique ID.', 'athen_transl' ),
                    'param_name'    => 'unique_id',
                ),
                array(
                    'type'          => 'textfield',
                    'admin_label'   => true,
                    'heading'       => __( 'Classes', 'athen_transl' ),
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
                    'heading'           => __( 'CSS Animation', 'athen_transl' ),
                    'param_name'        => 'css_animation',
                    'value'             => vcex_css_animations(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Mailchimp Form Action', 'athen_transl' ),
                    'param_name'    => 'mailchimp_form_action',
                    'value'         => 'http://domain.us1.list-manage.com/subscribe/post?u=numbers_go_here',
                    'description'   => __( 'Enter the MailChimp form action URL.', 'athen_transl' ) .' <a href="http://docs.shopify.com/support/configuration/store-customization/where-do-i-get-my-mailchimp-form-action?ref=wpexplorer" target="_blank">'. __( 'Learn More', 'athen_transl' ) .' &rarr;</a>',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Placeholder Text', 'athen_transl' ),
                    'param_name'    => 'placeholder_text',
                    'std'           => __( 'Enter your email address','athen_transl'),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Submit Button Text', 'athen_transl' ),
                    'param_name'    => 'submit_text',
                    'std'           => __( 'Go', 'athen_transl' ),
                ),

                // Input
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Background', 'athen_transl' ),
                    'param_name'    => 'input_bg',
                    'dependency'    => Array(
                        'element'   => 'mailchimp_form_action',
                        'not_empty' => true
                    ),
                    'group'         => __( 'Input', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Color', 'athen_transl' ),
                    'param_name'    => 'input_color',
                    'group'         => __( 'Input', 'athen_transl' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Width', 'athen_transl' ),
                    'param_name'        => 'input_width',
                    'description'       => __( 'Enter a pixel or percentage value.', 'athen_transl' ),
                    'group'             => __( 'Input', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Height', 'athen_transl' ),
                    'param_name'        => 'input_height',
                    'description'       => __( 'Please enter a px value.', 'athen_transl' ),
                    'group'             => __( 'Input', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Padding', 'athen_transl' ),
                    'param_name'        => 'input_padding',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
                    'group'             => __( 'Input', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Border', 'athen_transl' ),
                    'param_name'        => 'input_border',
                    'description'       => __( 'Please use the shorthand format: width style color. Enter 0px or "none" to disable border.', 'athen_transl' ),
                    'group'             => __( 'Input', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Border Radius', 'athen_transl' ),
                    'param_name'        => 'input_border_radius',
                    'description'       => __( 'Please enter a px value.', 'athen_transl' ),
                    'group'             => __( 'Input', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Font Size', 'athen_transl' ),
                    'param_name'        => 'input_font_size',
                    'description'       => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
                    'group'             => __( 'Input', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Letter Spacing', 'athen_transl' ),
                    'param_name'        => 'input_letter_spacing',
                    'description'       => __( 'Please enter a px value.', 'athen_transl' ),
                    'group'             => __( 'Input', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Font Weight', 'athen_transl' ),
                    'param_name'        => 'input_weight',
                    'group'             => __( 'Input', 'athen_transl' ),
                    'std'               => '',
                    'description'       => __( 'Note: Not all font families support every font weight.', 'athen_transl' ),
                    'value'             => vcex_font_weights(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Text Transform', 'athen_transl' ),
                    'param_name'        => 'input_transform',
                    'group'             => __( 'Input', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'value'             => vcex_text_transforms(),
                ),

                // Submit
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Background', 'athen_transl' ),
                    'param_name'    => 'submit_bg',
                    'group'         => __( 'Submit', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Background: Hover', 'athen_transl' ),
                    'param_name'    => 'submit_hover_bg',
                    'group'         => __( 'Submit', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Color', 'athen_transl' ),
                    'param_name'    => 'submit_color',
                    'group'         => __( 'Submit', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Color: Hover', 'athen_transl' ),
                    'param_name'    => 'submit_hover_color',
                    'group'         => __( 'Submit', 'athen_transl' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Position Right', 'athen_transl' ),
                    'param_name'        => 'submit_position_right',
                    'std'               => '20px',
                    'group'             => __( 'Submit', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Height', 'athen_transl' ),
                    'param_name'        => 'submit_height',
                    'std'               => '30px',
                    'group'             => __( 'Submit', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Padding', 'athen_transl' ),
                    'param_name'        => 'submit_padding',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
                    'group'             => __( 'Submit', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Border', 'athen_transl' ),
                    'param_name'        => 'submit_border',
                    'description'       => __( 'Please use the shorthand format: width style color. Enter 0px or "none" to disable border.', 'athen_transl' ),
                    'group'             => __( 'Submit', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Border Radius', 'athen_transl' ),
                    'param_name'        => 'submit_border_radius',
                    'description'       => __( 'Please enter a px value.', 'athen_transl' ),
                    'group'             => __( 'Submit', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Font Size', 'athen_transl' ),
                    'param_name'        => 'submit_font_size',
                    'description'       => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
                    'group'             => __( 'Submit', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Letter Spacing', 'athen_transl' ),
                    'param_name'        => 'submit_letter_spacing',
                    'description'       => __( 'Please enter a px value.', 'athen_transl' ),
                    'group'             => __( 'Submit', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Font Weight', 'athen_transl' ),
                    'param_name'        => 'submit_weight',
                    'group'             => __( 'Submit', 'athen_transl' ),
                    'std'               => '',
                    'description'       => __( 'Note: Not all font families support every font weight.', 'athen_transl' ),
                    'value'             => vcex_font_weights(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Text Transform', 'athen_transl' ),
                    'param_name'        => 'submit_transform',
                    'group'             => __( 'Submit', 'athen_transl' ),
                    'std'               => '',
                    'value'             => vcex_text_transforms(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
            )

        ) );
    }
}
add_action( 'vc_before_init', 'vcex_newsletter_form_shortcode_vc_map' );