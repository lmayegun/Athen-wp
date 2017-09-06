<?php
/**
 * Visual Composer Row Configuration
 *
 * @package     Total
 * @subpackage  Visual Composer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
 * @version     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Start Class
if ( ! class_exists( 'WPEX_VC_Row_Config' ) ) {
    
    class WPEX_VC_Row_Config {

        /**
         * Main constructor
         *
         * @since   2.0.0
         * @access public
         */
        public function __construct() {

            // Check if row parallax is enabled
            $this->enable_row_parallax  = vcex_enable_row_parallax();
            $this->enable_row_video     = vcex_enable_row_video();

            // Add params
            add_filter( 'admin_init', array( &$this, 'add_params' ) );

            // Parse attributes
            add_filter( 'vc_edit_form_fields_attributes_vc_row', array( &$this, 'edit_form_fields') );

        }

        /**
         * Adds new params for the VC Rows
         *
         * @since   2.0.0
         * @access  public
         */
        public function add_params() {

            // General
            vc_add_param( 'vc_row', array(
                'type'          => 'textfield',
                'heading'       => __( 'Row ID', 'athen_transl' ),
                'param_name'    => 'id',
                'weight'        => 999,
            ) );
            vc_add_param( 'vc_row', array(
                'type'          => 'textfield',
                'heading'       => __( 'Minimum Height', 'athen_transl' ),
                'param_name'    => 'min_height',
            ) );
            vc_add_param( 'vc_row', array(
                'type'          => 'dropdown',
                'heading'       => __( 'Visibility', 'athen_transl' ),
                'param_name'    => 'visibility',
                'std'           => '',
                'value'         => vcex_visibility(),
            ) );
            vc_add_param( 'vc_row', array(
                'type'          => 'dropdown',
                'heading'       => __( 'Animation', 'athen_transl' ),
                'param_name'    => 'css_animation',
                'value'         => vcex_css_animations(),
            ) );
            vc_add_param( 'vc_row', array(
                'type'          => 'dropdown',
                'heading'       => __( 'Center Row Content', 'athen_transl' ),
                'param_name'    => 'center_row',
                'value'         => Array(
                    __( 'No', 'athen_transl' )  => '',
                    __( 'Yes', 'athen_transl' ) => 'yes',
                ),
                'description'   => __( 'Use this option to center the inner content (Horizontally). Only used for "Full Screen" layouts.', 'athen_transl' ),
            ) );
            vc_add_param( 'vc_row', array(
                'type'          => 'dropdown',
                'heading'       => __( 'Typography Style', 'athen_transl' ),
                'param_name'    => 'typography_style',
                'value'         => vcex_typography_styles(),
            ) );

            // Columns
            vc_add_param( 'vc_row', array(
                'type'          => 'dropdown',
                'heading'       => __( 'Spacing Between Columns', 'athen_transl' ),
                'param_name'    => 'column_spacing',
                'value'         => array(
                    __( 'Default', 'athen_transl' ) => '',
                    '0px'                   => '0px',
                    '20px'                  => '20',
                    '30px'                  => '30',
                    '40px'                  => '40',
                    '50px'                  => '50',
                    '60px'                  => '60',
                ),
            ) );

            vc_add_param( 'vc_row', array(
                'type'          => 'dropdown',
                'heading'       => __( 'Full-Width Columns On Tablets', 'athen_transl' ),
                'param_name'    => 'tablet_fullwidth_cols',
                'value'         => Array(
                    __( 'No', 'athen_transl' )  => '',
                    __( 'Yes', 'athen_transl' ) => 'yes',
                ),
                'description'   => __( 'Check this box to make all columns inside this row full-width for tablets.', 'athen_transl' ),
            ) );

            // Background
            vc_add_param( 'vc_row', array(
                'type'          => 'colorpicker',
                'heading'       => __( 'Background Color', 'athen_transl' ),
                'param_name'    => 'bg_color',
                'group'         => __( 'Background', 'athen_transl' ),
            ) );
            vc_add_param( 'vc_row', array(
                'type'          => 'attach_image',
                'heading'       => __( 'Background Image', 'athen_transl' ),
                'param_name'    => 'bg_image',
                'description'   => __( 'Select image from media library.', 'athen_transl' ),
                'group'         => __( 'Background', 'athen_transl' ),
            ) );
            vc_add_param( 'vc_row', array(
                'type'          => 'dropdown',
                'heading'       => __( 'Background Image Style', 'athen_transl' ),
                'param_name'    => 'bg_style',
                'value'         => array(
                    __( 'Default', 'athen_transl' )     => '',
                    __( 'Stretched', 'athen_transl' )   => 'stretch',
                    __( 'Fixed', 'athen_transl' )       => 'fixed',
                    __( 'Repeat', 'athen_transl' )      => 'repeat',
                ),
                'dependency'    => Array(
                    'element'   => 'background_image',
                    'not_empty' => true
                ),
                'group'         => __( 'Background', 'athen_transl' ),
            ) );

            // Parallax
            if ( $this->enable_row_parallax ) {
                vc_add_param( 'vc_row', array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Parallax', 'athen_transl' ),
                    'param_name'    => 'parallax',
                    'group'         => __( 'Parallax', 'athen_transl' ),
                    'value'         => array(
                        __( 'Disable', 'athen_transl' ) => '',
                        __( 'Enable', 'athen_transl' )  => 'true',
                    ),
                    'description'   => __( 'Enable a parallax affect for the row background. If you are using a 3rd party plugin for your parallax backgrounds please use the vcex_enable_row_parallax filter to completely disable these settings and prevent conflicts.', 'athen_transl' ),
                ) );
                vc_add_param( 'vc_row', array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Enable parallax for mobile devices', 'athen_transl' ),
                    'param_name'    => 'parallax_mobile',
                    'value'         => Array(
                        __( 'No', 'athen_transl' )  => '',
                        __( 'Yes', 'athen_transl' ) => 'on',
                    ),
                    'description'   => __( 'Parallax effects would most probably cause slowdowns when your site is viewed in mobile devices. By default it is disabled.', 'athen_transl' ),
                    'group'         => __( 'Parallax', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'parallax',
                        'value'     => 'true',
                    ),
                ) );
                vc_add_param( 'vc_row', array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Parallax Style', 'athen_transl' ),
                    'param_name'    => 'parallax_style',
                    'value'         => array(
                        __( 'Default', 'athen_transl' )             => '',
                        __( 'Fixed & Repeat', 'athen_transl' )      => 'fixed-repeat',
                        __( 'Fixed & No-Repeat', 'athen_transl' )   => 'fixed-no-repeat',
                    ),
                    'dependency'    => Array(
                        'element'   => 'parallax',
                        'value'     => 'true',
                    ),
                    'group'         => __( 'Parallax', 'athen_transl' ),
                ) );
                vc_add_param( 'vc_row', array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Parallax Direction', 'athen_transl' ),
                    'param_name'    => 'parallax_direction',
                    'value'         => array(
                        __( 'Up', 'athen_transl' )      => '',
                        __( 'Down', 'athen_transl' )    => 'down',
                        __( 'Left', 'athen_transl' )    => 'left',
                        __( 'Right', 'athen_transl' )   => 'right',
                    ),
                    'group'         => __( 'Parallax', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'parallax',
                        'value'     => 'true',
                    ),
                ) );
                vc_add_param( 'vc_row', array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Parallax Speed', 'athen_transl' ),
                    'param_name'    => 'parallax_speed',
                    'description'   => __( 'The movement speed, value should be between 0.1 and 1.0. A lower number means slower scrolling speed. Be mindful of the background size and the dimensions of your background image when setting this value. Faster scrolling means that the image will move faster, make sure that your background image has enough width or height for the offset.', 'athen_transl' ),
                    'group'         => __( 'Parallax', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'parallax',
                        'value'     => 'true',
                    ),
                ) );
            }

            // Video
            if ( $this->enable_row_video ) {
                vc_add_param( 'vc_row', array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Video Background?', 'athen_transl' ),
                    'param_name'    => 'video_bg',
                    'description'   => __( 'Check this box to enable the options for a self hosted video background.', 'athen_transl' ),
                    'value'         => Array(
                        __( 'None', 'athen_transl' )            => '',
                        __( 'Self Hosted', 'athen_transl' )     => 'self_hosted',
                        //__( 'Youtube', 'athen_transl' )         => 'youtube', // Not Ready Yet
                    ),
                    'group'         => __( 'Video', 'athen_transl' ),
                ) );
                vc_add_param( 'vc_row', array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Video Background Overlay', 'athen_transl' ),
                    'param_name'    => 'video_bg_overlay',
                    'value'         => array(
                        __( 'None', 'athen_transl' )            => '',
                        __( 'Dark', 'athen_transl' )            => 'dark',
                        __( 'Dotted', 'athen_transl' )          => 'dotted',
                        __( 'Diagonal Lines', 'athen_transl' )  => 'dashed',
                    ),
                    'dependency'    => Array(
                        'element'   => 'video_bg',
                        'not_empty' => true,
                    ),
                    'group'         => __( 'Video', 'athen_transl' ),
                ) );
                /*vc_add_param( 'vc_row', array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Youtube Embed URL', 'athen_transl' ),
                    'param_name'    => 'video_bg_youtube',
                    'dependency'    => Array(
                        'element'   => 'video_bg',
                        'value'     => 'youtube'
                    ),
                    'group'         => __( 'Video', 'athen_transl' ),
                ) );*/
                vc_add_param( 'vc_row', array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Video URL: MP4 URL', 'athen_transl' ),
                    'param_name'    => 'video_bg_mp4',
                    'dependency'    => Array(
                        'element'   => 'video_bg',
                        'value'     => 'self_hosted'
                    ),
                    'group'         => __( 'Video', 'athen_transl' ),
                ) );
                vc_add_param( 'vc_row', array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Video URL: WEBM URL', 'athen_transl' ),
                    'param_name'    => 'video_bg_webm',
                    'dependency'    => Array(
                        'element'   => 'video_bg',
                        'value'     => 'self_hosted'
                    ),
                    'group'         => __( 'Video', 'athen_transl' ),
                ) );
                vc_add_param( 'vc_row', array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Video URL: OGV URL', 'athen_transl' ),
                    'param_name'    => 'video_bg_ogv',
                    'dependency'    => Array(
                        'element'   => 'video_bg',
                        'value'     => 'self_hosted'
                    ),
                    'group'         => __( 'Video', 'athen_transl' ),
                ) );
            }

            // Border
            vc_add_param( 'vc_row', array(
                'type'          => 'dropdown',
                'heading'       => __( 'Border Style', 'athen_transl' ),
                'param_name'    => 'border_style',
                'std'           => '',
                'value'         => vcex_border_styles(),
                'group'         => __( 'Border', 'athen_transl' ),
            ) );
            vc_add_param( 'vc_row', array(
                'type'          => 'colorpicker',
                'heading'       => __( 'Border Color', 'athen_transl' ),
                'param_name'    => 'border_color',
                'group'         => __( 'Border', 'athen_transl' ),
            ) );
            vc_add_param( 'vc_row', array(
                'type'          => 'textfield',
                'heading'       => __( 'Border Width', 'athen_transl' ),
                'param_name'    => 'border_width',
                'group'         => __( 'Border', 'athen_transl' ),
                'description'   => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
            ) );

            // Margin
            vc_add_param( 'vc_row', array(
                'type'          => 'textfield',
                'heading'       => __( 'Margin Top', 'athen_transl' ),
                'param_name'    => 'margin_top',
                'group'         => __( 'Margin & Padding', 'athen_transl' ),
            ) );
            vc_add_param( 'vc_row', array(
                'type'          => 'textfield',
                'heading'       => __( 'Margin Bottom', 'athen_transl' ),
                'param_name'    => 'margin_bottom',
                'group'         => __( 'Margin & Padding', 'athen_transl' ),
            ) );
            vc_add_param( 'vc_row', array(
                'type'          => 'textfield',
                'heading'       => __( 'Margin Left', 'athen_transl' ),
                'param_name'    => 'margin_left',
                'group'         => __( 'Margin & Padding', 'athen_transl' ),
            ) );
            vc_add_param( 'vc_row', array(
                'type'          => 'textfield',
                'heading'       => __( 'Margin Right', 'athen_transl' ),
                'param_name'    => 'margin_right',
                'group'         => __( 'Margin & Padding', 'athen_transl' ),
            ) );

            // Padding
            vc_add_param( 'vc_row', array(
                'type'          => 'textfield',
                'heading'       => __( 'Padding Top', 'athen_transl' ),
                'param_name'    => 'padding_top',
                'group'         => __( 'Margin & Padding', 'athen_transl' ),
            ) );
            vc_add_param( 'vc_row', array(
                'type'          => 'textfield',
                'heading'       => __( 'Padding Bottom', 'athen_transl' ),
                'param_name'    => 'padding_bottom',
                'group'         => __( 'Margin & Padding', 'athen_transl' ),
            ) );
            vc_add_param( 'vc_row', array(
                'type'          => 'textfield',
                'heading'       => __( 'Padding Left', 'athen_transl' ),
                'param_name'    => 'padding_left',
                'group'         => __( 'Margin & Padding', 'athen_transl' ),
            ) );
            vc_add_param( 'vc_row', array(
                'type'          => 'textfield',
                'heading'       => __( 'Padding Right', 'athen_transl' ),
                'param_name'    => 'padding_right',
                'group'         => __( 'Margin & Padding', 'athen_transl' ),
            ) );

        }

        /**
         * Tweaks row attributes on edit
         *
         * @since   Total 2.0.2
         * @access  public
         */
        public function edit_form_fields( $atts ) {

            // Parse $style into $typography_style
            if ( empty( $atts['typography_style'] ) && ! empty( $atts['style'] ) ) {
                if ( in_array( $atts['style'], vcex_typography_styles() ) ) {
                    $atts['typography_style']   = $atts['style'];
                    $atts['style']              = '';
                }
            }

            // Parse parallax
            if ( $this->enable_row_parallax ) {
                if ( ! empty( $atts['parallax'] ) ) {
                    if ( in_array( $atts['parallax'], array( 'simple', 'advanced' ) ) ) {
                        $atts['parallax'] = 'true';
                    }
                } elseif ( empty( $atts['parallax'] ) && ! empty( $atts['bg_style'] ) ) {
                    if ( 'parallax' ==  $atts['bg_style'] || 'parallax-advanced' ==  $atts['bg_style'] ) {
                        $atts['parallax'] = 'true';
                    }
                }
            }

            // Parse video background
            if ( $this->enable_row_video ) {
                if ( ! empty( $atts['video_bg'] ) && 'yes' == $atts['video_bg'] ) {
                    $atts['video_bg'] = 'self_hosted';
                }
            }

            // Convert 'no-margins' to '0px' column_spacing
            if ( empty( $this->atts['column_spacing'] ) && ! empty( $atts['no_margins'] ) && 'true' == $atts['no_margins'] ) {
                $atts['column_spacing'] = '0px';
                $atts['no_margins']     = '';
            }

            // Return $atts
            return $atts;

        }

    }

}
new WPEX_VC_Row_Config();