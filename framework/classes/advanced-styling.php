<?php
/**
 * Used for generating custom layouts CSS
 * Description : Class use for tweaking theme style layout - custom css output to theme head. 
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
if ( ! class_exists( 'Athen_Advanced_Styling' ) ) {
    
    class Athen_Advanced_Styling {
        
        
        public $theme_name = ATHEN_NAME_THEME;

        /**
         * Main constructor
         *
         * @since 2.0.0
         */
        public function __construct() {

            add_filter( 'athen_head_css', array( $this, 'generate' ), 999 );

        }

        /**
         * Generates the CSS output
         *
         * @since 2.0.0
         */
        public function generate( $output ) {

            // Get global object
            $athen_std_theme = athen_global_obj();

            // Define main variables
            $css            = '';
            $add_css        = '';
            $header_height  = '';
            $post_id        = $athen_std_theme->post_id;

            /*-----------------------------------------------------------------------------------*/
            /*  - Fixed Header Height - Can't cache this code
            /*-----------------------------------------------------------------------------------*/
            if ( ! $athen_std_theme->has_overlay_header ) {
                if ( 'one' == $athen_std_theme->header_style ) {
                    $header_top_padding     = intval( athen_get_mod( 'header_top_padding' ) );
                    $header_bottom_padding  = intval( athen_get_mod( 'header_bottom_padding' ) );
                    $header_height          = intval( athen_get_mod( 'header_height' ) );
                    if ( $header_height && '0' != $header_height && 'auto' != $header_height ) {
                        if ( $header_top_padding || $header_bottom_padding ) {
                            $header_height_plus_padding = $header_height + $header_top_padding + $header_bottom_padding;
                        } else {
                            $header_height_plus_padding = $header_height + '60';
                        }
                        $css .= '.header-one #site-header {
                                    height: '. $header_height .'px;
                                }

                                .header-one #site-navigation-wrap,
                                .navbar-style-one .dropdown-menu > li > a {
                                    height:'. $header_height_plus_padding .'px
                                }

                                .navbar-style-one .dropdown-menu > li > a {
                                    line-height:'. $header_height_plus_padding .'px
                                }

                                .header-one #site-logo,
                                .header-one #site-logo a {
                                    height:'. $header_height .'px;line-height:'. $header_height .'px
                                }';
                    }
                }
            }

            /*-----------------------------------------------------------------------------------*/
            /*  - Logo
            /*-----------------------------------------------------------------------------------*/
            // Reset $add_css var
            $add_css = '';

            // Logo top/bottom margins only if custom header height is empty
            if ( ! $header_height ) {

                // Logo top margin
                $margin = intval( athen_get_mod( 'logo_top_margin' ) );
                if ( $margin && '0' != $margin ) {
                    if ( $header_height && '0' != $header_height && 'auto' != $header_height && $athen_std_theme->header_logo ) {
                        $add_css .= 'padding-top: '. $margin .'px;';
                    } else {
                        $add_css .= 'margin-top: '. $margin .'px;';
                    }
                }
                
                // Logo bottom margin
                $margin = intval( athen_get_mod( 'logo_bottom_margin' ) );
                if ( $margin ) {
                    if ( $header_height && 'auto' != $header_height && $athen_std_theme->header_logo ) {
                        $add_css .= 'padding-bottom: '. $margin .'px;';
                    } else {
                        $add_css .= 'margin-bottom: '. $margin .'px;';
                    }
                }

            }

            // #site-logo css
            if ( $add_css ) {
                $css .= '#site-logo {'. $add_css .'}';
                $add_css = '';
            }

            /*-----------------------------------------------------------------------------------*/
            /*  - Logo Max Widths
            /*-----------------------------------------------------------------------------------*/

            // Desktop
            if ( $width = athen_get_mod( 'logo_max_width' ) ) {
                $css .= '@media only screen and (min-width: 960px) {
                            #site-logo {
                                max-width: '. $width .';
                            }
                        }';
            }

            // Tablet Portrait
            if ( $width = athen_get_mod( 'logo_max_width_tablet_portrait' ) ) {
                $css .= '@media only screen and (min-width: 768px) and (max-width: 959px) {
                            #site-logo {
                                max-width: '. $width .';
                            }
                        }';
            }

            // Phone
            if ( $width = athen_get_mod( 'logo_max_width_phone' ) ) {
                $css .= '@media only screen and (max-width: 767px) {
                            #site-logo {
                                max-width: '. $width .';
                            }
                        }';
            }
            
            /*-----------------------------------------------------------------------------------*/
            /*  - Top Header Logo Max Widths
            /*-----------------------------------------------------------------------------------*/

            // Desktop
            if ( $width = athen_get_mod( 'athen_headertop_maxwidth_logo' ) ) {
                $css .= '@media only screen and (min-width: 960px) {
                            .'.$this->theme_name.'-header-top .site-branding {
                                max-width: '. $width .';
                            }
                        }';
            }

            // Tablet Portrait
            if ( $width = athen_get_mod( 'athen_headertop_maxwidth_logotablet' ) ) {
                $css .= '@media only screen and (min-width: 768px) and (max-width: 959px) {
                             .'.$this->theme_name.'-header-top .site-branding {
                                max-width: '. $width .';
                            }
                        }';
            }

            // Phone
            if ( $width = athen_get_mod( 'athen_headertop_maxwidth_logophone' ) ) {
                $css .= '@media only screen and (max-width: 767px) {
                             .'.$this->theme_name.'-header-top .site-branding {
                                max-width: '. $width .';
                            }
                        }';
            }
            
            /*-----------------------------------------------------------------------------------*/
            /*  - Top Header Logo Margins
            /*-----------------------------------------------------------------------------------*/

            // Margin Top
            if ( $width = athen_get_mod( 'athen_headertop_topmargin_logo' ) ) {
                $css .= ' .'.$this->theme_name.'-header-top .site-branding {
                                margin-top: '. $width .';
                            }
                        ';
            }
            
             // Margin Bottom
            if ( $width = athen_get_mod( 'athen_headertop_bottommargin_logo' ) ) {
                $css .= ' .'.$this->theme_name.'-header-top .site-branding {
                                margin-bottom: '. $width .';
                            }
                        ';
            }
            
             // Margin Left
            if ( $width = athen_get_mod( 'athen_headertop_leftmargin_logo' ) ) {
                $css .= ' .'.$this->theme_name.'-header-top .site-branding {
                                margin-left: '. $width .';
                            }
                        ';
            }
            
             // Margin Right
            if ( $width = athen_get_mod( 'athen_headertop_rightmargin_logo' ) ) {
                $css .= ' .'.$this->theme_name.'-header-top .site-branding {
                                margin-right: '. $width .';
                            }
                        ';
            }

            // Tablet Portrait
            if ( $width = athen_get_mod( 'athen_headertop_maxwidth_logotablet' ) ) {
                $css .= '@media only screen and (min-width: 768px) and (max-width: 959px) {
                            .'.$this->theme_name.'-header-top .site-branding {
                                max-width: '. $width .';
                            }
                        }';
            }

            // Phone
            if ( $width = athen_get_mod( 'athen_headertop_maxwidth_logophone' ) ) {
                $css .= '@media only screen and (max-width: 767px) {
                            .'.$this->theme_name.'-header-top .site-branding {
                                max-width: '. $width .';
                            }
                        }';
            }

            /*-----------------------------------------------------------------------------------*/
            /*  - Other
            /*-----------------------------------------------------------------------------------*/

            // Fix for Fonts In the Visual Composer
            $css .='.wpb_row
                    .fa:before {
                        box-sizing:content-box!important;
                        -moz-box-sizing:content-box!important;
                        -webkit-box-sizing:content-box!important;
                    }';

            // Remove header border if custom color is set
            if ( athen_get_mod( 'header_background' ) ) {
                $css .='.is-sticky #site-header{border-color:transparent;}';
            }
            
            /*-----------------------------------------------------------------------------------*/
            /*  - Return CSS
            /*-----------------------------------------------------------------------------------*/
            if ( ! empty( $css ) ) {
                $output .= '/*ADVANCED STYLING CSS*/'. $css;
            }

            // Return output css
            return $output;
        }
    }
}
new Athen_Advanced_Styling();