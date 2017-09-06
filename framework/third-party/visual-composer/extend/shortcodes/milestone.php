<?php
/**
 * Registers the Milestone shortcode and adds it to the Visual Composer
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
class WPBakeryShortCode_vcex_milestone extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_milestone.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_milestone_shortcode_vc_map' ) ) {
    function vcex_milestone_shortcode_vc_map() {
        vc_map( array(
            'name'                  => __( 'Milestone', 'athen_transl' ),
            'description'           => __( 'Animated counter', 'athen_transl' ),
            'base'                  => 'vcex_milestone',
            'icon'                  => 'vcex-milestone',
            'category'              => ATHEN_NAME_THEME,
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
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                    'value'             => vcex_visibility(),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Appear Animation', 'athen_transl' ),
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
                array(
                    'type'              => 'textfield',
                    'class'             => 'vcex-animated-counter-number',
                    'heading'           => __( 'Speed', 'athen_transl' ),
                    'param_name'        => 'speed',
                    'value'             => '2500',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                    'description'       => __('The number of milliseconds it should take to finish counting.','athen_transl'),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Refresh Interval', 'athen_transl' ),
                    'param_name'        => 'interval',
                    'value'             => '50',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'description'       => __('The number of milliseconds to wait between refreshing the counter.','athen_transl'),
                ),

                // Number
                array(
                    'type'          => 'textfield',
                    'admin_label'   => true,
                    'class'         => 'vcex-animated-counter-number',
                    'heading'       => __( 'Number', 'athen_transl' ),
                    'param_name'    => 'number',
                    'value'         => '45',
                    'description'   => __( 'Your Milestone.', 'athen_transl' ),
                    'group'         => __( 'Number', 'athen_transl' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Number Before', 'athen_transl' ),
                    'param_name'        => 'before',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                    'group'             => __( 'Number', 'athen_transl' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Number After', 'athen_transl' ),
                    'param_name'        => 'after',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'group'             => __( 'Number', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Number Color', 'athen_transl' ),
                    'param_name'    => 'number_color',
                    'group'         => __( 'Number', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Number Font Size', 'athen_transl' ),
                    'param_name'    => 'number_size',
                    'description'   => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
                    'group'         => __( 'Number', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Number Font Weight', 'athen_transl' ),
                    'param_name'    => 'number_weight',
                    'value'         => vcex_font_weights(),
                    'std'           => '',
                    'description'   => __( 'Note: Not all font families support every font weight.', 'athen_transl' ),
                    'group'         => __( 'Number', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Number Bottom Margin', 'athen_transl' ),
                    'param_name'    => 'number_bottom_margin',
                    'description'   => __( 'Please enter a px value.', 'athen_transl' ),
                    'group'         => __( 'Number', 'athen_transl' ),
                ),

                // caption
                array(
                    'type'          => 'textfield',
                    'class'         => 'vcex-animated-counter-caption',
                    'heading'       => __( 'Caption', 'athen_transl' ),
                    'param_name'    => 'caption',
                    'value'         => 'Awards Won',
                    'admin_label'   => true,
                    'description'   => __('Your milestone caption displays underneath the number.','athen_transl'),
                    'group'         => __( 'Caption', 'athen_transl' ),
                ),
                array(
                    'type'          => 'colorpicker',
                    'heading'       => __( 'Caption Color', 'athen_transl' ),
                    'param_name'    => 'caption_color',
                    'group'         => __( 'Caption', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Caption Font Size', 'athen_transl' ),
                    'param_name'    => 'caption_size',
                    'description'   => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
                    'group'         => __( 'Caption', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Caption Font Weight', 'athen_transl' ),
                    'param_name'    => 'caption_font',
                    'value'         => vcex_font_weights(),
                    'std'           => '',
                    'description'   => __( 'Note: Not all font families support every font weight.', 'athen_transl' ),
                    'group'         => __( 'Caption', 'athen_transl' ),
                ),

                // Link
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'URL', 'athen_transl' ),
                    'param_name'    => 'url',
                    'group'         => __( 'Link', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'URL Target', 'athen_transl' ),
                    'param_name'    => 'url_target',
                    'value'         => array(
                        __( 'Self', 'athen_transl')     => '',
                        __( 'Blank', 'athen_transl' )   => 'blank',
                    ),
                    'dependency'    => Array(
                        'element'   => 'url',
                        'not_empty' => true
                    ),
                    'group'         => __( 'Link', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'URl Rel', 'athen_transl' ),
                    'param_name'    => 'url_rel',
                    'value'         => array(
                        __( 'None', 'athen_transl')         => '',
                        __( 'Nofollow', 'athen_transl' )    => 'nofollow',
                    ),
                    'dependency'    => Array(
                        'element'   => 'url',
                        'not_empty' => true
                    ),
                    'group'         => __( 'Link', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Link Container Wrap', 'athen_transl' ),
                    'param_name'    => 'url_wrap',
                    'value'         => array(
                        __( 'Default', 'athen_transl' ) => '',
                        __( 'False', 'athen_transl' )   => 'false',
                        __( 'True', 'athen_transl' )    => 'true',
                    ),
                    'group'         => __( 'Link', 'athen_transl' ),
                    'description'   => __( 'Apply the link to the entire wrapper?', 'athen_transl' ),
                ),
                
                // CSS
                array(
                    'type'          => 'css_editor',
                    'heading'       => __( 'Design', 'athen_transl' ),
                    'param_name'    => 'css',
                    'group'         => __( 'Design options', 'athen_transl' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Width', 'athen_transl' ),
                    'param_name'        => 'width',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                    'group'             => __( 'Design options', 'athen_transl' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Border Radius', 'athen_transl' ),
                    'param_name'        => 'border_radius',
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'group'             => __( 'Design options', 'athen_transl' ),
                ),
            )
        ) );
    }
}
add_action( 'vc_before_init', 'vcex_milestone_shortcode_vc_map' );