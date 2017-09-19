<?php
/**
 * Used for generating custom layouts CSS
 *
 * Description : Class used to generate custom css layout. 
 * 
 * @package     Athen
 * @subpackage  Closer - View
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'Athen_Responsive_Widths_CSS' ) ) {
	
	class Athen_Responsive_Widths_Css {

		/**
		 * Main constructor
		 *
		 * @since Total 1.6.3
		 */
		public function __construct() {
			add_filter( 'athen_head_css', array( $this, 'get_css' ), 999 );
		}

		/**
		 * Retrieves cached CSS or generates the responsive CSS
		 *
		 * @since Total 1.6.3
		 */
		public function get_css( $output ) {

			// Get global object
			$athen_std_theme   = athen_global_obj();
            $theme_name        = ATHEN_NAME_THEME;
			$this->main_layout = $athen_std_theme->main_layout;
			$this->active_skin = $athen_std_theme->skin;

			// Vars
			$css = '';
            $add_css = '';

			/*-----------------------------------------------------------------------------------*/
			/*  - Desktop Width
			/*-----------------------------------------------------------------------------------*/
			
			// Main Container With
			if ( $width = athen_get_mod( 'main_wrap_width', false ) ) {
				if ( 'layout-three' == $this->main_layout  ) {
					$add_css .= 'body.athen-layout-three .'. $theme_name .'-main2-wrap {
									width:'. $width .';
									max-width:none;
								}';
				} else {
					/*$add_css .= '.container,
								.vc_row-fluid.container {
									width: '. $width .' !important;
									max-width:none;
								}';*/
				}
			}
            
            // Athen Section Width
            if( $width = athen_get_mod( 'section_width', false) ){
                if( $this->main_layout != 'layout-three' ){
                    $add_css .= '.'. $theme_name .'-section-wrap {
                                    width:'. $width .';
                                    margin: auto auto;
                                    max-width:none;
                                }';         
                }
            }
            
            // Content Width
			if ( $width = athen_get_mod( 'content_width', false ) ) {
				$add_css.= '.'. $theme_name .'-content-wrap{
								width:'. $width .' !important;
								margin: auto;
							}';
			}
			
			// Post Box width
			if ( $width = athen_get_mod( 'posts_box_width', false ) ) {
				$add_css .= '.'. $theme_name .'-posts-box{
								width:'. $width .' !important;
								max-width:none;
							}';
			}

			// Sidebar width
			if ( $width = athen_get_mod( 'sidebar_width', false ) ) {
				$add_css .= '.'. $theme_name .'-sidebar-box{
								width: '. $width .' !important;
								max-width:none;
							}';
			}
            
            // Footer width
			if ( $width = athen_get_mod( 'footer_width', false ) ) {
				$add_css .= '.'. $theme_name .'-footer-wrap{
								width: '. $width .' !important;
								margin: auto;
							}';
			}
            
            // Footer Bottom
			if ( $width = athen_get_mod( 'footer_bottom_width', false ) ) {
				$add_css .= '.'. $theme_name .'-footer-bottom{
								width: '. $width .' !important;
								margin: auto;
							}';
			}


			// Add to $css var
			if ( $add_css ) {
				$css .= '@media only screen and (min-width: 1281px){
							'. $add_css .'
						}';
				$add_css = '';
			}


			/*-----------------------------------------------------------------------------------*/
			/*  - Medium Screen Widths
			/*-----------------------------------------------------------------------------------*/

			// Main Container With
			if ( $width = athen_get_mod( 'main_wrap_medium_width', false ) ) {
				if ( 'layout-three' == $this->main_layout  ) {
					$add_css .= 'body.athen-layout-three .'. $theme_name .'-main2-wrap {
									width:'. $width .';
									max-width:none;
								}';
				} else {
					/*$add_css .= '.container,
								.vc_row-fluid.container {
									width: '. $width .' !important;
									max-width:none;
								}';*/
				}
			}
            
            // Athen Section Width
            if( $width = athen_get_mod( 'section_medium_width', false) ){
                $add_css .= '.'. $theme_name .'-section-wrap {
                                    width:'. $width .';
                                    margin: auto auto;
                                    max-width:none;
                            }';         
            }
            
            // Content Width
			if ( $width = athen_get_mod( 'content_medium_width', false ) ) {
				$add_css.= '.'. $theme_name .'-content-wrap{
								width:'. $width .' !important;
								margin: auto;
							}';
			}
			
			// Post Box width
			if ( $width = athen_get_mod( 'posts_box_medium_width', false ) ) {
				$add_css .= '.'. $theme_name .'-posts-box{
								width:'. $width .' !important;
								max-width:none;
							}';
			}

			// Sidebar width
			if ( $width = athen_get_mod( 'sidebar_medium_width', false ) ) {
				$add_css .= '.'. $theme_name .'-sidebar-box{
								width: '. $width .' !important;
								max-width:none;
							}';
			}
            
            // Footer width
			if ( $width = athen_get_mod( 'footer_medium_width', false ) ) {
				$add_css .= '.'. $theme_name .'-footer-wrap{
								width: '. $width .' !important;
								margin: auto;
							}';
			}
            
            // Footer Bottom
			if ( $width = athen_get_mod( 'footer_bottom_medium_width', false ) ) {
				$add_css .= '.'. $theme_name .'-footer-bottom{
								width: '. $width .' !important;
								margin: auto;
							}';
			}

			// Add to $css var
			if ( $add_css ) {
				$css .= '@media only screen and (min-width: 960px) and (max-width: 1280px)  {
							'. $add_css .'
						}';
				$add_css = '';
			}
			

			/*-----------------------------------------------------------------------------------*/
			/*  - Tablet Widths
			/*-----------------------------------------------------------------------------------*/

			// Main Container With
			if ( $width = athen_get_mod( 'main_wrap_tablet_width', false ) ) {
				if ( 'layout-three' == $this->main_layout  ) {
					$add_css .= 'body.athen-layout-three .'. $theme_name .'-main2-wrap {
									width:'. $width .';
									max-width:none;
								}';
				} else {
					/*$add_css .= '.container,
								.vc_row-fluid.container {
									width: '. $width .' !important;
									max-width:none;
								}';*/
				}
			}
            
            // Athen Section Width
            if( $width = athen_get_mod( 'section_tablet_width', false) ){
                $add_css .= '.'. $theme_name .'-section-wrap {
                                    width:'. $width .';
                                    margin: auto auto;
                                    max-width:none;
                            }';         
            }
            
            // Content Width
			if ( $width = athen_get_mod( 'content_tablet_width', false ) ) {
				$add_css.= '.'. $theme_name .'-content-wrap{
								width:'. $width .' !important;
								margin: auto;
							}';
			}
			
			// Post Box width
			if ( $width = athen_get_mod( 'posts_box_tablet_width', false ) ) {
				$add_css .= '.'. $theme_name .'-posts-box{
								width:'. $width .' !important;
								max-width:none;
							}';
			}

			// Sidebar width
			if ( $width = athen_get_mod( 'sidebar_tablet_width', false ) ) {
				$add_css .= '.'. $theme_name .'-sidebar-box{
								width: '. $width .' !important;
								max-width:none;
							}';
			}
            
            // Footer width
			if ( $width = athen_get_mod( 'footer_tablet_width', false ) ) {
				$add_css .= '.'. $theme_name .'-footer-wrap{
								width: '. $width .' !important;
								margin: auto;
							}';
			}
            
            // Footer Bottom
			if ( $width = athen_get_mod( 'footer_bottom_tablet_width', false ) ) {
				$add_css .= '.'. $theme_name .'-footer-bottom{
								width: '. $width .' !important;
								margin: auto;
							}';
			}

			// Add to $css var
			if ( $add_css ) {
				$css .= '@media only screen and (min-width: 720px) and (max-width: 959px){
							'. $add_css .'
						}';
				$add_css = '';
			}

			/*-----------------------------------------------------------------------------------*/
			/*  - Phone Widths
			/*-----------------------------------------------------------------------------------*/
						// Main Container With
			if ( $width = athen_get_mod( 'main_wrap_phone_width', false ) ) {
				if ( 'layout-three' == $this->main_layout  ) {
					$add_css .= 'body.athen-layout-three .'. $theme_name .'-main2-wrap {
									width:'. $width .';
									max-width:none;
								}';
				} else {
					/*$add_css .= '.container,
								.vc_row-fluid.container {
									width: '. $width .' !important;
									max-width:none;
								}';*/
				}
			}
            
            // Athen Section Width
            if( $width = athen_get_mod( 'section_phone_width', false) ){
                $add_css .= '.'. $theme_name .'-section-wrap {
                                    width:'. $width .';
                                    margin: auto auto;
                                    max-width:none;
                            }';         
            }
            
            // Content Width
			if ( $width = athen_get_mod( 'content_phone_width', false ) ) {
				$add_css.= '.'. $theme_name .'-content-wrap{
								width:'. $width .' !important;
								margin: auto;
							}';
			}
			
			// Post Box width
			if ( $width = athen_get_mod( 'posts_box_phone_width', false ) ) {
				$add_css .= '.'. $theme_name .'-posts-box{
								width:'. $width .' !important;
								max-width:none;
							}';
			}

			// Sidebar width
			if ( $width = athen_get_mod( 'sidebar_phone_width', false ) ) {
				$add_css .= '.'. $theme_name .'-sidebar-box{
								width: '. $width .' !important;
								max-width:none;
							}';
			}
            
            // Footer width
			if ( $width = athen_get_mod( 'footer_phone_width', false ) ) {
				$add_css .= '.'. $theme_name .'-footer-wrap{
								width: '. $width .' !important;
								margin: auto;
							}';
			}
            
            // Footer Bottom
			if ( $width = athen_get_mod( 'footer_bottom_phone_width', false ) ) {
				$add_css .= '.'. $theme_name .'-footer-bottom{
								width: '. $width .' !important;
								margin: auto;
							}';
			}
            
			/*// Phone Portrait
			if ( $width = athen_get_mod( 'mobile_portrait_main_container_width', false ) ) {
				if ( 'boxed' == $this->main_layout || 'gaps' == $this->active_skin ) {
					$css .= '@media only screen and (max-width: 767px) {
							.boxed-main-layout #wrap {
								width: '. $width .' !important; min-width: 0;
							}
						}';
				} else {
					$css .= '@media only screen and (max-width: 767px) {
							.container {
								width: '. $width .' !important; min-width: 0;
							}
					}';
				}
			}
			
			// Phone Landscape
			if ( $width = athen_get_mod( 'mobile_landscape_main_container_width', false ) ) {
				if ( 'boxed' == $this->main_layout || 'gaps' == $this->active_skin ) {
					$css .= '@media only screen and (min-width: 480px) and (max-width: 767px) {
							.boxed-main-layout #wrap {
								width: '. $width .' !important;
							}
						}';
				} else {
					$css .= '@media only screen and (min-width: 480px) and (max-width: 767px) {
							.container {
								width: '. $width .' !important;
							}
					}';
				}
			}*/
		
			// Return custom CSS
			if ( ! empty( $css ) ) {
				$css = '/*RESPONSIVE WIDTHS*/'. $css;
				$output .= $css;
			}

			// Return output css
			return $output;

		}

	}

}
new Athen_Responsive_Widths_Css();