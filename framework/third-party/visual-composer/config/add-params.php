<?php
/**
 * Add new params to Visual Composer modules
 *
 * @package     Total
 * @subpackage  Visual Composer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.0.0
 */

/*-----------------------------------------------------------------------------------*/
/*  - Seperator With Text
/*-----------------------------------------------------------------------------------*/
vc_add_param( 'vc_text_separator', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Element Type', 'athen_transl' ),
    'param_name'    => 'element_type',
    'value'         => array(
        'div'   => 'div',
        'h1'    => 'h1',
        'h2'    => 'h2',
        'h3'    => 'h3',
        'h4'    => 'h4',
        'h5'    => 'h5',
        'h6'    => 'h6',
    ),
) );

vc_add_param( 'vc_text_separator', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Style', 'athen_transl' ),
    'param_name'    => 'style',
    'value'         => array(
        __( 'Bottom Border', 'athen_transl' )               => 'one',
        __( 'Bottom Border With Color', 'athen_transl' )    => 'two',
        __( 'Line Through', 'athen_transl' )                => 'three',
        __( 'Double Line Through', 'athen_transl' )         => 'four',
        __( 'Dotted', 'athen_transl' )                      => 'five',
        __( 'Dashed', 'athen_transl' )                      => 'six',
        __( 'Top & Bottom Borders', 'athen_transl' )        => 'seven',
        __( 'Graphical', 'athen_transl' )                   => 'eight',
        __( 'Outlined', 'athen_transl' )                    => 'nine',
    ),
) );

vc_add_param( 'vc_text_separator', array(
    'type'          => 'colorpicker',
    'heading'       => __( 'Border Color', 'athen_transl' ),
    'param_name'    => 'border_color',
    'description'   => __( 'Select a custom color for your colored border under the title.', 'athen_transl' ),
    'dependency'    => Array(
        'element'   => 'style',
        'value'     => array( 'two' ),
    ),
) );

vc_add_param( 'vc_text_separator', array(
    'type'          => 'textfield',
    'heading'       => __( 'Font Size', 'athen_transl' ),
    'param_name'    => 'font_size',
    'description'   => __( 'You can use "em" or "px" values, but you must define them.', 'athen_transl' ),
) );

vc_add_param( 'vc_text_separator', array(
    'type'        => 'dropdown',
    'heading'     => __( 'Font Weight', 'athen_transl' ),
    'std'         => '',
    'param_name'  => 'font_weight',
    'description' => __( 'Note: Not all font families support every font weight.', 'athen_transl' ),
    'value'       => vcex_font_weights(),
) );

vc_add_param( 'vc_text_separator', array(
    'type'          => 'textfield',
    'heading'       => __( 'Bottom Margin', 'athen_transl' ),
    'param_name'    => 'margin_bottom',
    'description'   => __( 'Please enter a px value.', 'athen_transl' ),
) );

vc_add_param( 'vc_text_separator', array(
    'type'          => 'colorpicker',
    'heading'       => __( 'Background Color', 'athen_transl' ),
    'param_name'    => 'span_background',
    'dependency'    => Array(
        'element'   => 'style',
        'value'     => array( 'three', 'four', 'five', 'six' ),
    )
) );

vc_add_param( 'vc_text_separator', array(
    'type'          => 'colorpicker',
    'heading'       => __( 'Font Color', 'athen_transl' ),
    'param_name'    => 'span_color',
) );

/*-----------------------------------------------------------------------------------*/
/*  - Columns
/*-----------------------------------------------------------------------------------*/
vc_add_param( 'vc_column', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Style', 'athen_transl' ),
    'param_name'    => 'style',
    'value'         => array(
        __( 'Default', 'athen_transl' )     => '',
        __( 'Bordered', 'athen_transl' )    => 'bordered',
        __( 'Boxed', 'athen_transl' )       => 'boxed',
    ),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Visibility', 'athen_transl' ),
    'param_name'    => 'visibility',
    'std'           => '',
    'value'         => vcex_visibility(),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Animation', 'athen_transl' ),
    'param_name'    => 'css_animation',
    'value'         => vcex_css_animations(),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Typography Style', 'athen_transl' ),
    'param_name'    => 'typo_style',
    'value'         => array(
        __( 'Default', 'athen_transl' )     => '',
        __( 'White Text', 'athen_transl' )  => 'light',
    ),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'checkbox',
    'heading'       => __( 'Drop Shadow?', 'athen_transl' ),
    'param_name'    => 'drop_shadow',
    'value'         => Array(
        __( 'Yes please.', 'athen_transl' ) => 'yes'
    ),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'textfield',
    'heading'       => __( 'Minimum Height', 'athen_transl' ),
    'param_name'    => 'min_height',
    'description'   => __( 'You can enter a minimum height for this row.', 'athen_transl' ),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'colorpicker',
    'heading'       => __( 'Background Color', 'athen_transl' ),
    'param_name'    => 'bg_color',
    'group'         => __( 'Background', 'athen_transl' ),
) );


vc_add_param( 'vc_column', array(
    'type'          => 'attach_image',
    'heading'       => __( 'Background Image', 'athen_transl' ),
    'param_name'    => 'bg_image',
    'description'   => __( 'Select image from media library.', 'athen_transl' ),
    'group'         => __( 'Background', 'athen_transl' ),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Background Image Style', 'athen_transl' ),
    'param_name'    => 'bg_style',
    'value'         => array(
        __( 'Default', 'athen_transl' )     => '',
        __( 'Stretched', 'athen_transl' )   => 'stretch',
        __( 'Fixed', 'athen_transl' )       => 'fixed',
        __( 'Parallax', 'athen_transl' )    => 'parallax',
        __( 'Repeat', 'athen_transl' )      => 'repeat',
    ),
    'dependency' => Array(
        'element'   => 'background_image',
        'not_empty' => true
    ),
    'group'         => __( 'Background', 'athen_transl' ),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Border Style', 'athen_transl' ),
    'param_name'    => 'border_style',
    'value'         => vcex_border_styles(),
    'group'         => __( 'Border', 'athen_transl' ),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'colorpicker',
    'heading'       => __( 'Border Color', 'athen_transl' ),
    'param_name'    => 'border_color',
    'group'         => __( 'Border', 'athen_transl' ),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'textfield',
    'heading'       => __( 'Border Width', 'athen_transl' ),
    'param_name'    => 'border_width',
    'description'   => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
    'group'         => __( 'Border', 'athen_transl' ),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'textfield',
    'heading'       => __( 'Margin Top', 'athen_transl' ),
    'param_name'    => 'margin_top',
    'group'         => __( 'Margin & Padding', 'athen_transl' ),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'textfield',
    'heading'       => __( 'Margin Bottom', 'athen_transl' ),
    'param_name'    => 'margin_bottom',
    'group'         => __( 'Margin & Padding', 'athen_transl' ),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'textfield',
    'heading'       => __( 'Padding Top', 'athen_transl' ),
    'param_name'    => 'padding_top',
    'group'         => __( 'Margin & Padding', 'athen_transl' ),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'textfield',
    'heading'       => __( 'Padding Bottom', 'athen_transl' ),
    'param_name'    => 'padding_bottom',
    'group'         => __( 'Margin & Padding', 'athen_transl' ),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'textfield',
    'heading'       => __( 'Padding Left', 'athen_transl' ),
    'param_name'    => 'padding_left',
    'group'         => __( 'Margin & Padding', 'athen_transl' ),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'textfield',
    'heading'       => __( 'Padding Right', 'athen_transl' ),
    'param_name'    => 'padding_right',
    'group'         => __( 'Margin & Padding', 'athen_transl' ),
) );

/*-----------------------------------------------------------------------------------*/
/*  - Inner Columns
/*-----------------------------------------------------------------------------------*/
vc_add_param( 'vc_column_inner', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Style', 'athen_transl' ),
    'param_name'    => 'style',
    'value'         => array(
        __( 'Default', 'athen_transl' )     => 'default',
        __( 'Bordered', 'athen_transl' )    => 'bordered',
        __( 'Boxed', 'athen_transl' )       => 'boxed',
    ),
) );

vc_add_param( 'vc_column_inner', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Visibility', 'athen_transl' ),
    'param_name'    => 'visibility',
    'value'         => vcex_visibility(),
) );

vc_add_param( 'vc_column_inner', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Animation', 'athen_transl' ),
    'param_name'    => 'css_animation',
    'value'         => vcex_css_animations(),
) );

vc_add_param( 'vc_column_inner', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Typography Style', 'athen_transl' ),
    'param_name'    => 'typo_style',
    'value'         => array(
        __( 'Dark Text', 'athen_transl' )   => '',
        __( 'White Text', 'athen_transl' )  => 'light',
    ),
) );

vc_add_param( 'vc_column_inner', array(
    'type'          => 'checkbox',
    'heading'       => __( 'Drop Shadow?', 'athen_transl' ),
    'param_name'    => 'drop_shadow',
    'value'         => Array(
        __( 'Yes please.', 'athen_transl' ) => 'yes'
    ),
) );

vc_add_param( 'vc_column_inner', array(
    'type'          => 'colorpicker',
    'heading'       => __( 'Background Color', 'athen_transl' ),
    'param_name'    => 'bg_color',
    'group'         => __( 'Background', 'athen_transl' ),
) );


vc_add_param( 'vc_column_inner', array(
    'type'          => 'attach_image',
    'heading'       => __( 'Background Image', 'athen_transl' ),
    'param_name'    => 'bg_image',
    'description'   => __( 'Select image from media library.', 'athen_transl' ),
    'group'         => __( 'Background', 'athen_transl' ),
) );

vc_add_param( 'vc_column_inner', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Background Image Style', 'athen_transl' ),
    'param_name'    => 'bg_style',
    'value'         => array(
        __( 'Stretched', 'athen_transl' )   => 'stretch',
        __( 'Fixed', 'athen_transl' )       => 'fixed',
        __( 'Parallax', 'athen_transl' )    => 'parallax',
        __( 'Repeat', 'athen_transl' )      => 'repeat',
    ),
    'dependency'    => Array(
        'element'   => 'background_image',
        'not_empty' => true
    ),
    'group'         => __( 'Background', 'athen_transl' ),
) );

vc_add_param( 'vc_column_inner', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Border Style', 'athen_transl' ),
    'param_name'    => 'border_style',
    'value'         => vcex_border_styles(),
    'group'         => __( 'Border', 'athen_transl' ),
) );

vc_add_param( 'vc_column_inner', array(
    'type'          => 'colorpicker',
    'heading'       => __( 'Border Color', 'athen_transl' ),
    'param_name'    => 'border_color',
    'value'         => '',
    'group'         => __( 'Border', 'athen_transl' ),
) );

vc_add_param( 'vc_column_inner', array(
    'type'          => 'textfield',
    'heading'       => __( 'Border Width', 'athen_transl' ),
    'param_name'    => 'border_width',
    'description'   => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
    'group'         => __( 'Border', 'athen_transl' ),
) );

vc_add_param( 'vc_column_inner', array(
    'type'          => 'textfield',
    'heading'       => __( 'Margin Top', 'athen_transl' ),
    'param_name'    => 'margin_top',
    'group'         => __( 'Margin & Padding', 'athen_transl' ),
) );

vc_add_param( 'vc_column_inner', array(
    'type'          => 'textfield',
    'heading'       => __( 'Margin Bottom', 'athen_transl' ),
    'param_name'    => 'margin_bottom',
    'group'         => __( 'Margin & Padding', 'athen_transl' ),
) );

vc_add_param( 'vc_column_inner', array(
    'type'          => 'textfield',
    'heading'       => __( 'Padding Top', 'athen_transl' ),
    'param_name'    => 'padding_top',
    'group'         => __( 'Margin & Padding', 'athen_transl' ),
) );

vc_add_param( 'vc_column_inner', array(
    'type'          => 'textfield',
    'heading'       => __( 'Padding Bottom', 'athen_transl' ),
    'param_name'    => 'padding_bottom',
    'group'         => __( 'Margin & Padding', 'athen_transl' ),
) );

vc_add_param( 'vc_column_inner', array(
    'type'          => 'textfield',
    'heading'       => __( 'Padding Left', 'athen_transl' ),
    'param_name'    => 'padding_left',
    'group'         => __( 'Margin & Padding', 'athen_transl' ),
) );

vc_add_param( 'vc_column_inner', array(
    'type'          => 'textfield',
    'heading'       => __( 'Padding Right', 'athen_transl' ),
    'param_name'    => 'padding_right',
    'group'         => __( 'Margin & Padding', 'athen_transl' ),
) );


/*-----------------------------------------------------------------------------------*/
/*  - Tabs
/*-----------------------------------------------------------------------------------*/
vc_add_param( 'vc_tabs', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Style', 'athen_transl' ),
    'param_name'    => 'style',
    'value'         => array(
        __( 'Default', 'athen_transl' )         => 'default',
        __( 'Alternative #1', 'athen_transl' )  => 'alternative-one',
        __( 'Alternative #2', 'athen_transl' )  => 'alternative-two',
    ),  
) );

/*-----------------------------------------------------------------------------------*/
/*  - Tours
/*-----------------------------------------------------------------------------------*/
vc_add_param( 'vc_tour', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Style', 'athen_transl' ),
    'param_name'    => 'style',
    'value'         => array(
        __( 'Default', 'athen_transl' )         => 'default',
        __( 'Alternative #1', 'athen_transl' )  => 'alternative-one',
        __( 'Alternative #2', 'athen_transl' )  => 'alternative-two',
    ),
    
) );

/*-----------------------------------------------------------------------------------*/
/*  - Custom Heading
/*-----------------------------------------------------------------------------------*/
vc_add_param( 'vc_custom_heading', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Enqueue Font Style', 'athen_transl' ),
    'param_name'    => 'enqueue_font_style',
    'value'         => array(
        __( 'Yes', 'athen_transl' ) => '',
        __( 'No', 'athen_transl' )  => 'false',
    ),
    'descriptipn'   => __( 'If the Google Font you are using is already in use by the theme select No to prevent this font from loading again on the site.', 'athen_transl' ),
) );