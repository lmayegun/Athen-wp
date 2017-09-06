<?php
/**
 * Visual Composer Single Image Configuration
 *
 * @package     Total
 * @subpackage  Visual Composer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 2.0.1
 * @version     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Start Class
if ( ! class_exists( 'WPEX_VC_Single_Image_Config' ) ) {
    
    class WPEX_VC_Single_Image_Config {

        /**
         * Main constructor
         *
         * @since 2.0.0
         */
        function __construct() {
            add_filter( 'admin_init', array( &$this, 'add_params' ) );
        }

        /**
         * Adds new params for the VC Single_Images
         *
         * @since 2.0.0
         */
        public static function add_params() {

            vc_add_param( 'vc_single_image', array(
                'type'          => 'dropdown',
                'heading'       => __( 'Image alignment', 'athen_transl' ),
                'param_name'    => 'alignment',
                'value'         => vcex_alignments(),
                'description'   => __( 'Select image alignment.', 'athen_transl' )
            ) );

            if ( function_exists( 'vcex_image_hovers' ) ) {
                vc_add_param( 'vc_single_image', array(
                    'type'          => 'dropdown',

                    'heading'       => __( 'CSS3 Image Link Hover', 'athen_transl' ),
                    'param_name'    => 'img_hover',
                    'value'         => vcex_image_hovers(),
                    'description'   => __( 'Select your preferred image hover effect. Please note this will only work if the image links to a URL or a large version of itself. Please note these effects may not work in all browsers.', 'athen_transl' ),
                ) );
            }

            if ( function_exists( 'vcex_image_filters' ) ) {
                vc_add_param( 'vc_single_image', array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Image Filter', 'athen_transl' ),
                    'param_name'    => 'img_filter',
                    'value'         => vcex_image_filters(),
                    'description'   => __( 'Select an image filter style.', 'athen_transl' ),
                ) );
            }

            vc_add_param( 'vc_single_image', array(
                'type'          => 'checkbox',
                'heading'       => __( 'Rounded Image?', 'athen_transl' ),
                'param_name'    => 'rounded_image',
                'value'         => Array(
                    __( 'Yes please.', 'athen_transl' ) => 'yes'
                ),
                'description'   => __( 'For truely rounded images make sure your images are cropped to the same width and height.', 'athen_transl' ),
            ) );

            vc_add_param( 'vc_single_image', array(
                'type'          => 'textfield',
                'heading'       => __( 'Image Link Caption', 'athen_transl' ),
                'param_name'    => 'img_caption',
                'description'   => __( 'Use this field to add a caption to any single image with a link.', 'athen_transl' ),
            ) );

            vc_add_param( 'vc_single_image', array(
                'type'          => 'textfield',
                'heading'       => __( 'Video, SWF, Flash, URL Lightbox', 'athen_transl' ),
                'param_name'    => 'lightbox_video',
                'description'   => __( 'Enter the URL to a video, SWF file, flash file or a website URL to open in lightbox.', 'athen_transl' ),
                'group'         => __( 'Custom Lightbox', 'athen_transl' ),
            ) );

            vc_add_param( 'vc_single_image', array(
                'type'          => 'dropdown',
                'heading'       => __( 'Lightbox Type', 'athen_transl' ),
                'param_name'    => 'lightbox_iframe_type',
                'value'         => array(
                    __( 'Auto Detect', 'athen_transl' )                     => '',
                    __( 'URL', 'athen_transl' )                             => 'url',
                    __( 'Youtube, Vimeo, Embed or Iframe', 'athen_transl' ) => 'video_embed',
                    __( 'HTML5', 'athen_transl' )                           => 'html5',
                    __( 'Quicktime', 'athen_transl' )                       => 'quicktime',
                ),
                'description'   => __( 'Auto detect depends on the iLightbox API, so by choosing your type it speeds things up and you also allows for HTTPS support.', 'athen_transl' ),
                'group'         => __( 'Custom Lightbox', 'athen_transl' ),
                'dependency'    => Array(
                    'element'   => 'lightbox_video',
                    'not_empty' => true,
                ),
            ) );

            vc_add_param( 'vc_single_image', array(
                'type'          => 'textfield',
                'heading'       => __( 'HTML5 Webm URL', 'athen_transl' ),
                'param_name'    => 'lightbox_video_html5_webm',
                'description'   => __( 'Enter the URL to a video, SWF file, flash file or a website URL to open in lightbox.', 'athen_transl' ),
                'group'         => __( 'Custom Lightbox', 'athen_transl' ),
                'dependency'    => Array(
                    'element'   => 'lightbox_iframe_type',
                    'value'     => 'html5',
                ),
            ) );

            vc_add_param( 'vc_single_image', array(
                'type'          => 'textfield',
                'heading'       => __( 'Lightbox Dimensions', 'athen_transl' ),
                'param_name'    => 'lightbox_dimensions',
                'description'   => __( 'Enter a custom width and height for your lightbox pop-up window. Use format widthxheight. Example: 900x600.', 'athen_transl' ),
                'group'         => __( 'Custom Lightbox', 'athen_transl' ),
            ) );

            vc_add_param( 'vc_single_image', array(
                'type'          => 'attach_image',
                'admin_label'   => false,
                'heading'       => __( 'Custom Image Lightbox', 'athen_transl' ),
                'param_name'    => 'lightbox_custom_img',
                'description'   => __( 'Select a custom image to open in lightbox format', 'athen_transl' ),
                'group'         => __( 'Custom Lightbox', 'athen_transl' ),
            ) );

            vc_add_param( 'vc_single_image', array(
                'type'          => 'attach_images',
                'admin_label'   => false,
                'heading'       => __( 'Gallery Lightbox', 'athen_transl' ),
                'param_name'    => 'lightbox_gallery',
                'description'   => __( 'Select images to create a lightbox Gallery.', 'athen_transl' ),
                'group'         => __( 'Custom Lightbox', 'athen_transl' ),
            ) );

        }

    }

}
new WPEX_VC_Single_Image_Config();