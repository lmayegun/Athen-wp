<?php
/**
 * Description : Adds custom styles to the tinymce editor "Formats" dropdown. 
 * 
 * @package     Athen
 * @subpackage  Closer - View
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 * @see : http://codex.wordpress.org/Template_Hierarchy
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Only needed in admin
if ( ! is_admin() ) {
    return;
}

// Start Class
if ( ! class_exists( 'Athen_Editor_Formats' ) ) {
    
    class Athen_Editor_Formats {

        /**
         * Main constructor
         *
         * @access public
         * @since  2.1.0
         */
        public function __construct() {
            add_filter( 'tiny_mce_before_init', array( $this, 'settings' ) );
        }

        /**
         * Adds custom styles to the formats dropdown by altering the $settings
         *
         * @access public
         * @since  2.1.0
         */
        public function settings( $settings ) {

            // General
            $items = array(
                array(
                    'title'     => __( 'Theme Button', 'athen_transl' ),
                    'selector'  => 'a',
                    'classes'   => 'theme-button',
                ),
                array(
                    'title'     => __( 'Highlight', 'athen_transl' ),
                    'inline'    => 'span',
                    'classes'   => 'text-highlight',
                ),
                array(
                    'title'     => __( 'Thin Font', 'athen_transl' ),
                    'inline'    => 'span',
                    'classes'   => 'thin-font'
                ),
                array(
                    'title'     => __( 'White Text', 'athen_transl' ),
                    'inline'    => 'span',
                    'classes'   => 'white-text'
                ),
                array(
                    'title'     => __( 'Check List', 'athen_transl' ),
                    'selector'  => 'ul',
                    'classes'   => 'check-list'
                ),
            );

            $items = apply_filters( 'athen_tiny_mce_formats_items', $items );

            // Dropcaps
            $dropcaps = array(
                array(
                    'title'   => __( 'Dropcap', 'athen_transl' ),
                    'inline'  => 'span',
                    'classes' => 'dropcap',
                ),
                array(
                    'title'   => __( 'Boxed Dropcap', 'athen_transl' ),
                    'inline'  => 'span',
                    'classes' => 'dropcap boxed',
                ),
            );

            $dropcaps = apply_filters( 'athen_tiny_mce_formats_dropcaps', $dropcaps );

            // Color buttons
            $color_buttons = array(
                array(
                    'title'     => __( 'Blue', 'athen_transl' ),
                    'selector'  => 'a',
                    'classes'   => 'color-button blue',
                ),
                array(
                    'title'     => __( 'Black', 'athen_transl' ),
                    'selector'  => 'a',
                    'classes'   => 'color-button black',
                ),
                array(
                    'title'     => __( 'Red', 'athen_transl' ),
                    'selector'  => 'a',
                    'classes'   => 'color-button red',
                ),
                array(
                    'title'     => __( 'Orange', 'athen_transl' ),
                    'selector'  => 'a',
                    'classes'   => 'color-button orange',
                ),
                array(
                    'title'     => __( 'Green', 'athen_transl' ),
                    'selector'  => 'a',
                    'classes'   => 'color-button green',
                ),
                array(
                    'title'     => __( 'Gold', 'athen_transl' ),
                    'selector'  => 'a',
                    'classes'   => 'color-button gold',
                ),
                array(
                    'title'     => __( 'Teal', 'athen_transl' ),
                    'selector'  => 'a',
                    'classes'   => 'color-button teal',
                ),
                array(
                    'title'     => __( 'Purple', 'athen_transl' ),
                    'selector'  => 'a',
                    'classes'   => 'color-button purple',
                ),
                array(
                    'title'     => __( 'Pink', 'athen_transl' ),
                    'selector'  => 'a',
                    'classes'   => 'color-button pink',
                ),
                array(
                    'title'     => __( 'Brown', 'athen_transl' ),
                    'selector'  => 'a',
                    'classes'   => 'color-button brown',
                ),
                array(
                    'title'     => __( 'Rosy', 'athen_transl' ),
                    'selector'  => 'a',
                    'classes'   => 'color-button rosy',
                ),
                array(
                    'title'     => __( 'White', 'athen_transl' ),
                    'selector'  => 'a',
                    'classes'   => 'color-button white',
                ),
            );

            $color_buttons = apply_filters( 'athen_tiny_mce_formats_color_buttons', $color_buttons );

            // Create array of formats
            $new_formats = array(
                // Total Buttons
                array(
                    'title' => ATHEN_NAME_THEME .' '. __( 'Styles', 'athen_transl' ),
                    'items' => $items,
                ),
                array(
                    'title' => __( 'Dropcaps', 'athen_transl' ),
                    'items' => $dropcaps,
                ),
                array(
                    'title' =>  __( 'Color Buttons', 'athen_transl' ),
                    'items' => $color_buttons,
                ),
            );

            // Merge Formats
            $settings['style_formats_merge'] = true;

            // Add new formats
            $settings['style_formats'] = json_encode( $new_formats );

            // Return New Settings
            return $settings;

        }

    }

}
new Athen_Editor_Formats();