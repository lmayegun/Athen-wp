<?php
/**
 * Adds custom CSS to the site to tweak the main accent colors
 * Description : Class use to change the accent color of theme - achieved by adding custom css to page head..
 *               It targets certain Html element class or ID. 
 * 
 * @package     Athen
 * @subpackage  Closer - View
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 * Dependent : http://codex.wordpress.org/Template_Hierarchy
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Start Class
if ( ! class_exists( 'Athen_Accent_Color' ) ) {
    
    class Athen_Accent_Color {

        /**
         * Main constructor
         *
         * @access public
         * @since  2.0.0
         */
        public function __construct() {
           
            // Define a default accent color
            $this->default_accent = '#3b86b0'; // Needs to be filterable via skin?

            // Add custom CSS for the accent
            add_filter( 'athen_head_css', array( &$this, 'generate' ), 1 );

        }

        /**
         * Generates arrays of elements to target
         *
         * @access public
         * @since  2.0.0
         */
        public function arrays( $return ) {

            // Texts
            $texts = array(
                'a',
                '.navbar-style-one .dropdown-menu a:hover',
                '.navbar-style-one .dropdown-menu > .current-menu-item > a',
                '.navbar-style-one .dropdown-menu > .current-menu-parent > a',
                'h1 a:hover',
                'h2 a:hover',
                'a:hover h2',
                'h3 a:hover',
                'h4 a:hover',
                'h5 a:hover',
                'h6 a:hover',
                '.wpex-carousel-entry-title a:hover',
                '.navbar-style-one .dropdown-menu ul a:hover',
                '.navbar-style-two .dropdown-menu a:hover',
                '.navbar-style-two .dropdown-menu > .current-menu-item > a',
                '.navbar-style-two .dropdown-menu ul a:hover',
                '.navbar-style-three .dropdown-menu > .current-menu-item > a',
                '.navbar-style-three .dropdown-menu a:hover',
                '.navbar-style-three .dropdown-menu ul a:hover',
                '.navbar-style-four .dropdown-menu > .current-menu-item > a',
                '.navbar-style-four .dropdown-menu a:hover',
                '.navbar-style-four .dropdown-menu ul a:hover',
                '.modern-menu-widget a:hover',
            );
            $texts = apply_filters( 'athen_accent_texts', $texts );

            // Backgrounds
            $backgrounds = array(

                // #4a97c2
                '.background-highlight',
                'input[type="submit"]',
                '.theme-button',
                'button',
                '#main .tagcloud a:hover',
                '.post-tags a:hover',
                '.wpex-carousel .owl-dot.active',
                '.navbar-style-one .menu-button > a > span.link-inner',
                '.wpex-carousel .owl-prev',
                '.wpex-carousel .owl-next',

                // #3b86b0
                '.modern-menu-widget li.current-menu-item a',
                '#wp-calendar caption',
                '#site-scroll-top:hover',
                'input[type="submit"]:hover',
                '.theme-button:hover',
                'button:hover',
                '.wpex-carousel .owl-prev:hover',
                '.wpex-carousel .owl-next:hover',
                '.navbar-style-one .menu-button > a > span.link-inner:hover',

            );
            $backgrounds = apply_filters( 'athen_accent_backgrounds', $backgrounds );

            // Borders
            $borders = array(
                '#searchform-dropdown',
                '.toggle-bar-btn:hover' => array( 'top', 'right' ),
                'body #site-navigation-wrap.nav-dropdown-top-border .dropdown-menu > li > ul' => array( 'top' ),
            );
            $borders = apply_filters( 'athen_accent_borders', $borders );

            // Return array
            if ( 'texts' == $return ) {
                return $texts;
            } elseif ( 'backgrounds' == $return ) {
                return $backgrounds;
            } elseif ( 'borders' == $return ) {
                return $borders;
            }


        }

        /**
         * Generates the CSS output
         *
         * @access public
         * @since  2.0.0
         */
        public function generate( $output ) {

            // Get custom accent
            $custom_accent = athen_get_mod( 'accent_color' );

            // Return if accent color is empty or equal to default
            if ( ! $custom_accent || ( $this->default_accent == $custom_accent ) ) {
                return $output;
            }

            // Define css var
            $css = '';

            // Get arrays
            $texts       = $this->arrays( 'texts' );
            $backgrounds = $this->arrays( 'backgrounds' );
            $borders     = $this->arrays( 'borders' );

            // Texts
            if ( ! empty( $texts ) ) {
                $css .= implode( ',', $texts ) .'{color:'. $custom_accent .';}';
            }

            // Backgrounds
            if ( ! empty( $backgrounds ) ) {
                $css .= implode( ',', $backgrounds ) .'{background-color:'. $custom_accent .';}';
            }

            // Borders
            if ( ! empty( $borders ) ) {
                foreach ( $borders as $key => $val ) {
                    if ( is_array( $val ) ) {
                        $css .= $key .'{';
                        foreach ( $val as $key => $val ) {
                            $css .= 'border-'. $val .'-color:'. $custom_accent .';';
                        }
                        $css .= '}'; 
                    } else {
                        $css .= $val .'{border-color:'. $custom_accent .';}';
                    }
                }
            }
            
            // Return CSS
            if ( ! empty( $css ) ) {
                $output .= '/*ACCENT COLOR*/'. $css;
            }

            // Return output css
            return $output;

        }

    }

}
new Athen_Accent_Color();