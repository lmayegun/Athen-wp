<?php
/**
 * Registers the pricing shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_pricing extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_pricing.php' ) );
        return ob_get_clean();
    }
}

/**
 * Parse shortcode attributes and set correct values
 *
 * @since 2.0.0
 */
function parse_vcex_pricing_atts( $atts ) {

    // Convert textfield link to vc_link
    if ( ! empty( $atts['button_url'] ) && false === strpos( $atts['button_url'], 'url:' ) ) {
        $url                = 'url:'. $atts['button_url'] .'|';
        $atts['button_url'] = $url;
    }

    // Return $atts
    return $atts;
}
add_filter( 'vc_edit_form_fields_attributes_vcex_pricing', 'parse_vcex_pricing_atts' );

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_pricing_shortcode_vc_map' ) ) {
    function vcex_pricing_shortcode_vc_map() {

        vc_map( array(
            'name'                  => __( 'Pricing Table', 'athen_transl' ),
            'description'           => __( 'Insert a pricing column', 'athen_transl' ),
            'base'                  => 'vcex_pricing',
            'category'              => ATHEN_NAME_THEME,
            'icon'                  => 'vcex-pricing',
            'admin_enqueue_css'     => athen_font_awesome_css_url(),
            'front_enqueue_css'     => athen_font_awesome_css_url(),
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
                    'heading'       => __( 'Classes', 'athen_transl' ),
                    'param_name'    => 'el_class',
                    'description'   => __( 'Add additonal classes to the main element.', 'athen_transl' ),
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

                // Plan
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Featured', 'athen_transl' ),
                    'param_name'    => 'featured',
                    'value'         => array(
                        __( 'No', 'athen_transl' )  => 'no',
                        __( 'Yes', 'athen_transl')  => 'yes',
                    ),
                    'group'         => __( 'Plan', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Plan', 'athen_transl' ),
                    'param_name'    => 'plan',
                    'group'         => __( 'Plan', 'athen_transl' ),
                    'std'           => __( 'Basic', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Plan Background Color', 'athen_transl' ),
                    'param_name'    => 'plan_background',
                    'group'         => __( 'Plan', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'plan',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Plan Font Color', 'athen_transl' ),
                    'param_name'    => 'plan_color',
                    'group'         => __( 'Plan', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'plan',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Plan Font Weight', 'athen_transl' ),
                    'param_name'    => 'plan_weight',
                    'description'   => __( 'Note: Not all font families support every font weight.', 'athen_transl' ),
                    'std'           => '',
                    'value'         => vcex_font_weights(),
                    'group'         => __( 'Plan', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'plan',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Plan Text Transform', 'athen_transl' ),
                    'param_name'    => 'plan_text_transform',
                    'std'           => '',
                    'value'         => vcex_text_transforms(),
                    'group'         => __( 'Plan', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'plan',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Plan Font Size', 'athen_transl' ),
                    'param_name'        => 'plan_size',
                    'description'       => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
                    'group'             => __( 'Plan', 'athen_transl' ),
                    'dependency'        => Array(
                        'element'   => 'plan',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Plan Letter Spacing', 'athen_transl' ),
                    'param_name'        => 'plan_letter_spacing',
                    'group'             => __( 'Plan', 'athen_transl' ),
                    'dependency'        => Array(
                        'element'   => 'plan',
                        'not_empty' => true,
                    ),
                    'description'       => __( 'Please enter a px value.', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Plan Padding', 'athen_transl' ),
                    'param_name'        => 'plan_padding',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
                    'group'             => __( 'Plan', 'athen_transl' ),
                    'dependency'        => Array(
                        'element'   => 'plan',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Plan Margin', 'athen_transl' ),
                    'param_name'    => 'plan_margin',
                    'description'   => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
                    'group'         => __( 'Plan', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'plan',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Plan Border', 'athen_transl' ),
                    'param_name'    => 'plan_border',
                    'description'   => __( 'Please use the shorthand format: width style color. Enter 0px or "none" to disable border.', 'athen_transl' ),
                    'group'         => __( 'Plan', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'plan',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),

                // Cost
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Cost', 'athen_transl' ),
                    'param_name'    => 'cost',
                    'group'         => __( 'Cost', 'athen_transl' ),
                    'std'           => '$20',
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Cost Background Color', 'athen_transl' ),
                    'param_name'    => 'cost_background',
                    'group'         => __( 'Cost', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'cost',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Cost Font Color', 'athen_transl' ),
                    'param_name'    => 'cost_color',
                    'group'         => __( 'Cost', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'cost',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Cost Font Weight', 'athen_transl' ),
                    'param_name'    => 'cost_weight',
                    'description'   => __( 'Note: Not all font families support every font weight.', 'athen_transl' ),
                    'std'           => '',
                    'value'         => vcex_font_weights(),
                    'group'         => __( 'Cost', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'cost',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Cost Font Size', 'athen_transl' ),
                    'param_name'    => 'cost_size',
                    'description'   => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
                    'group'         => __( 'Cost', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'cost',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Cost Padding', 'athen_transl' ),
                    'param_name'        => 'cost_padding',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
                    'group'             => __( 'Cost', 'athen_transl' ),
                    'dependency'        => Array(
                        'element'   => 'cost',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Cost Border', 'athen_transl' ),
                    'param_name'        => 'cost_border',
                    'description'       => __( 'Please use the shorthand format: width style color. Enter 0px or "none" to disable border.', 'athen_transl' ),
                    'group'             => __( 'Cost', 'athen_transl' ),
                    'dependency'        => Array(
                        'element'   => 'cost',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),

                // Per
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Per', 'athen_transl' ),
                    'param_name'    => 'per',
                    'group'         => __( 'Per', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Per Display', 'athen_transl' ),
                    'param_name'    => 'per_display',
                    'value'         => array(
                        __( 'Default', 'athen_transl' )         => '',
                        __( 'Inline', 'athen_transl' )          => 'inline',
                        __( 'Block', 'athen_transl' )           => 'block',
                        __( 'Inline-Block', 'athen_transl' )    => 'inline-block',
                    ),
                    'group'         => __( 'Per', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'per',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Per Font Color', 'athen_transl' ),
                    'param_name'    => 'per_color',
                    'group'         => __( 'Per', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'per',
                        'not_empty' => true,
                    ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Per Font Weight', 'athen_transl' ),
                    'param_name'        => 'per_weight',
                    'description'       => __( 'Note: Not all font families support every font weight.', 'athen_transl' ),
                    'std'               => '',
                    'value'             => vcex_font_weights(),
                    'group'             => __( 'Per', 'athen_transl' ),
                    'dependency'        => Array(
                        'element'   => 'per',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Per Text Transform', 'athen_transl' ),
                    'param_name'        => 'per_transform',
                    'group'             => __( 'Per', 'athen_transl' ),
                    'value'             => vcex_text_transforms(),
                    'dependency'        => Array(
                        'element'   => 'per',
                        'not_empty' => true,
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Per Font Size', 'athen_transl' ),
                    'param_name'    => 'per_size',
                    'description'   => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
                    'group'         => __( 'Per', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'per',
                        'not_empty' => true,
                    ),
                ),

                // Features
                array(
                    'type'          => 'textarea_html',
                    'heading'       => __( 'Features', 'athen_transl' ),
                    'param_name'    => 'content',
                    'value'         => '<ul>
                                            <li>30GB Storage</li>
                                            <li>512MB Ram</li>
                                            <li>10 databases</li>
                                            <li>1,000 Emails</li>
                                            <li>25GB Bandwidth</li>
                                        </ul>',
                    'description'   => __('Enter your pricing content. You can use a UL list as shown by default but anything would really work!','athen_transl'),
                    'group'         => __( 'Features', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Features Font Color', 'athen_transl' ),
                    'param_name'    => 'font_color',
                    'group'         => __( 'Features', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Features Background', 'athen_transl' ),
                    'param_name'    => 'features_bg',
                    'group'         => __( 'Features', 'athen_transl' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Features Font Size', 'athen_transl' ),
                    'param_name'        => 'font_size',
                    'description'       => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
                    'group'             => __( 'Features', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Features Padding', 'athen_transl' ),
                    'param_name'        => 'features_padding',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
                    'group'             => __( 'Features', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Features Border', 'athen_transl' ),
                    'param_name'        => 'features_border',
                    'description'       => __( 'Please use the shorthand format: width style color. Enter 0px or "none" to disable border.', 'athen_transl' ),
                    'group'             => __( 'Features', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),

                // Button
                array(
                    'type'          => 'vc_link',
                    'heading'       => __( 'Button URL', 'athen_transl' ),
                    'param_name'    => 'button_url',
                    'group'         => __( 'Button', 'athen_transl' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Button Text', 'athen_transl' ),
                    'param_name'        => 'button_text',
                    'group'             => __( 'Button', 'athen_transl' ),
                ),
                array(
                    'type'              => 'colorpicker',
                    'heading'           => __( 'Button Area Background', 'athen_transl' ),
                    'param_name'        => 'button_wrap_bg',
                    'group'             => __( 'Button', 'athen_transl' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Button Area Padding', 'athen_transl' ),
                    'param_name'        => 'button_wrap_padding',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
                    'group'             => __( 'Button', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Button Area Border', 'athen_transl' ),
                    'param_name'        => 'button_wrap_border',
                    'description'       => __( 'Please use the shorthand format: width style color. Enter 0px or "none" to disable border.', 'athen_transl' ),
                    'group'             => __( 'Button', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Button Style', 'athen_transl' ),
                    'param_name'        => 'button_style',
                    'value'             => vcex_button_styles(),
                    'group'             => __( 'Button', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Button Color', 'athen_transl' ),
                    'param_name'        => 'button_style_color',
                    'value'             => vcex_button_colors(),
                    'group'             => __( 'Button', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'colorpicker',
                    'heading'           => __( 'Button Background Color', 'athen_transl' ),
                    'param_name'        => 'button_bg_color',
                    'group'             => __( 'Button', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Button Background Hover Color', 'athen_transl' ),
                    'param_name'    => 'button_hover_bg_color',
                    'group'         => __( 'Button', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Button Text Color', 'athen_transl' ),
                    'param_name'    => 'button_color',
                    'group'         => __( 'Button', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Button Text Hover Color', 'athen_transl' ),
                    'param_name'    => 'button_hover_color',
                    'group'         => __( 'Button', 'athen_transl' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Button Text Size', 'athen_transl' ),
                    'param_name'        => 'button_size',
                    'group'             => __( 'Button', 'athen_transl' ),
                    'description'       => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Button Border Radius', 'athen_transl' ),
                    'param_name'        => 'button_border_radius',
                    'group'             => __( 'Button', 'athen_transl' ),
                    'description'       => __( 'Please enter a px value.', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Button Letter Spacing', 'athen_transl' ),
                    'param_name'        => 'button_letter_spacing',
                    'group'             => __( 'Button', 'athen_transl' ),
                    'description'       => __( 'Please enter a px value.', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Button Padding', 'athen_transl' ),
                    'param_name'        => 'button_padding',
                    'description'       => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
                    'group'             => __( 'Button', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Button Font Weight', 'athen_transl' ),
                    'param_name'        => 'button_weight',
                    'description'       => __( 'Note: Not all font families support every font weight.', 'athen_transl' ),
                    'std'               => '',
                    'value'             => vcex_font_weights(),
                    'group'             => __( 'Button', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Button Text Transform', 'athen_transl' ),
                    'param_name'        => 'button_transform',
                    'group'             => __( 'Button', 'athen_transl' ),
                    'value'             => vcex_text_transforms(),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'          => 'textarea_raw_html',
                    'heading'       => __( 'Custom Button HTML', 'athen_transl' ),
                    'param_name'    => 'custom_button',
                    'description'   => __( 'Enter your custom button HTML, such as your paypal button code.', 'athen_transl' ),
                    'group'         => __( 'Button', 'athen_transl' ),
                ),

                //Icons
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Icon library', 'athen_transl' ),
                    'param_name'    => 'icon_type',
                    'description'   => __( 'Select icon library.', 'athen_transl' ),
                    'std'           => 'fontawesome',
                    'value'         => array(
                        __( 'Font Awesome', 'athen_transl' ) => 'fontawesome',
                        __( 'Open Iconic', 'athen_transl' )  => 'openiconic',
                        __( 'Typicons', 'athen_transl' )     => 'typicons',
                        __( 'Entypo', 'athen_transl' )       => 'entypo',
                        __( 'Linecons', 'athen_transl' )     => 'linecons',
                        __( 'Pixel', 'athen_transl' )        => 'pixelicons',
                    ),
                    'group'         => __( 'Icons', 'athen_transl' ),
                ),

                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Left', 'athen_transl' ),
                    'param_name'    => 'button_icon_left',
                    'admin_label'   => true,
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'fontawesome',
                    ),
                    'group'         => __( 'Icons', 'athen_transl' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Left', 'athen_transl' ),
                    'param_name'    => 'button_icon_left_openiconic',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'openiconic',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'openiconic',
                    ),
                    'group'         => __( 'Icons', 'athen_transl' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Left', 'athen_transl' ),
                    'param_name'    => 'button_icon_left_typicons',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'typicons',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'typicons',
                    ),
                    'group'         => __( 'Icons', 'athen_transl' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Left', 'athen_transl' ),
                    'param_name'    => 'button_icon_left_entypo',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'entypo',
                        'iconsPerPage'  => 300,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'entypo',
                    ),
                    'group'         => __( 'Icons', 'athen_transl' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Left', 'athen_transl' ),
                    'param_name'    => 'button_icon_left_linecons',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'linecons',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'linecons',
                    ),
                    'group'         => __( 'Icons', 'athen_transl' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Left', 'athen_transl' ),
                    'param_name'    => 'button_icon_left_pixelicons',
                    'settings'      => array(
                        'emptyIcon' => false,
                        'type'      => 'pixelicons',
                        'source'    => vcex_pixel_icons(),
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'pixelicons',
                    ),
                    'group'         => __( 'Icons', 'athen_transl' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Right', 'athen_transl' ),
                    'param_name'    => 'button_icon_right',
                    'admin_label'   => true,
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'fontawesome',
                    ),
                    'group'         => __( 'Icons', 'athen_transl' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Right', 'athen_transl' ),
                    'param_name'    => 'button_icon_right_openiconic',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'openiconic',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'openiconic',
                    ),
                    'group'         => __( 'Icons', 'athen_transl' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Right', 'athen_transl' ),
                    'param_name'    => 'button_icon_right_typicons',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'typicons',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'typicons',
                    ),
                    'group'         => __( 'Icons', 'athen_transl' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Right', 'athen_transl' ),
                    'param_name'    => 'button_icon_right_entypo',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'entypo',
                        'iconsPerPage'  => 300,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'entypo',
                    ),
                    'group'         => __( 'Icons', 'athen_transl' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Right', 'athen_transl' ),
                    'param_name'    => 'button_icon_right_linecons',
                    'settings'      => array(
                        'emptyIcon'     => true,
                        'type'          => 'linecons',
                        'iconsPerPage'  => 200,
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'linecons',
                    ),
                    'group'         => __( 'Icons', 'athen_transl' ),
                ),
                array(
                    'type'          => 'iconpicker',
                    'heading'       => __( 'Icon Right', 'athen_transl' ),
                    'param_name'    => 'button_icon_right_pixelicons',
                    'settings'      => array(
                        'emptyIcon' => false,
                        'type'      => 'pixelicons',
                        'source'    => vcex_pixel_icons(),
                    ),
                    'dependency'    => array(
                        'element'   => 'icon_type',
                        'value'     => 'pixelicons',
                    ),
                    'group'         => __( 'Icons', 'athen_transl' ),
                ),
            )
        ) );

    }
}
add_action( 'vc_before_init', 'vcex_pricing_shortcode_vc_map' );