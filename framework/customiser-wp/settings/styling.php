<?php
/**
 * Description : This class adds styling ( color, margin, padding etc) option to the theme. 
 *               Theme Customizer and outputs the needed CSS to the header 
 *  
 * @package     Athen
 * @subpackage  Closer - Controller/View/Model
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Athen_Theme_Customizer_Styling' ) ) {
    class Athen_Theme_Customizer_Styling {

        /*-----------------------------------------------------------------------------------*/
        /*  - Constructor
        /*-----------------------------------------------------------------------------------*/
        public function __construct() {

            // Register settings
            add_action( 'customize_register', array( $this , 'register' ) );

            // Reset CSS cache when the customizer is saved
            add_action( 'customize_save_after', array( $this, 'reset_cache' ) );

            // Add custom CSS to the wp_head via the athen_head_css filter
            add_action( 'athen_head_css' , array( $this, 'header_output' ), 40 );

            // Clear cache based on GET variable
            if ( ! empty( $_GET['clear_css_cache'] ) ) {
                $this->reset_cache();
            }

        }

        /**
         * Defines the array of styling options
         *
         * @since   2.0.0
         * @access  public
         * @var     array $array An array of styling options to loop through.
         */
        public function styling_options() {

            $array = array();

            /*-----------------------------------------------------*/
            /*  - Layouts
            /*-----------------------------------------------------*/
            $array[] = array(
                'id'            => 'boxed_padding',
                'type'          => 'text',
                'label'         => __( 'Boxed Layout Padding', 'athen_transl' ),
                'element'       => '.'.ATHEN_NAME_THEME.'-main2-wrap',
                'style'         => 'padding',
                'section'       => 'athen_layout_boxed',
                'description'   => __( 'Default:', 'athen_transl' ) .' 40px 30px',
                'transport'     => 'refresh',
            );

            /*-----------------------------------------------------*/
            /*  - Header Top
            /*-----------------------------------------------------*/
            $array[] = array(
                'id'        => 'top_bar_bg',
                'type'      => 'color',
                'label'     => __( 'Background', 'athen_transl' ),
                'element'   => '#header-top',
                'style'     => 'background-color',
                'section'   => 'athen_topbar_styling',
            );

            $array[] = array(
                'id'        => 'top_bar_text',
                'type'      => 'color',
                'label'     => __( 'Color', 'athen_transl' ),
                'element'   => '#header-top, #site-header.header-one .header-top .header-top-free-txt,
                                #site-header.header-one .header-top .header-top-free-txt .fa,
                                #site-header.header-one .header-top .site-branding a:link',
                'style'     => 'color',
                'section'   => 'athen_topbar_styling',
            );

            // Header Top Styling Link
            $array[] = array(
                'id'        => 'athen_hr_control',
                'type'      => 'hr',
                'section'   => 'athen_topbar_styling',
            );
            $array[] = array(
                'id'        => 'top_bar_link_color',
                'type'      => 'color',
                'label'     => __( 'Link Color', 'athen_transl' ),
                'element'   => '#site-header.header-one .header-top a:link',
                'style'     => 'color',
                'section'   => 'athen_topbar_styling',
            );
            $array[] = array(
                'id'        => 'top_bar_link_color_hover',
                'type'      => 'color',
                'label'     => __( 'Link Color: Hover', 'athen_transl' ),
                'element'   => '#site-header.header-one .header-top a:hover',
                'style'     => 'color',
                'section'   => 'athen_topbar_styling',
                'transport' => 'refresh',
            );

            // Header Top Social Styling
            $array[] = array(
                'id'        => 'athen_hr_control',
                'type'      => 'hr',
                'section'   => 'athen_topbar_styling',
            );
            $array[] = array(
                'id'        => 'top_bar_social_color',
                'type'      => 'color',
                'label'     => __( 'Social Links Color', 'athen_transl' ),
                'element'   => '#header-top .social-icons a span.fa',
                'style'     => 'color',
                'section'   => 'athen_topbar_styling',
            );
            $array[] = array(
                'id'        => 'top_bar_social_hover_color',
                'type'      => 'color',
                'label'     => __( 'Social Links Hover Color', 'athen_transl' ),
                'element'   => '#header-top .social-icons a span.fa:hover',
                'style'     => 'color',
                'section'   => 'athen_topbar_styling',
                'transport' => 'refresh',
            );

            /*-----------------------------------------------------*/
            /*  - Header Main 
            /*-----------------------------------------------------*/

            // Header main - Background color
            $array[] = array(
                'id'        => 'header_main_background_color',
                'type'      => 'color',
                'label'     => __( 'Header Background Color', 'athen_transl' ), 
                'element'   => '#site-header-inner',
                'style'     => 'background-color',
                'section'   => 'athen_header_styling',
            );

            // Header main - Text color
            $array[] = array(
                'id'        => 'header_main_text_color',
                'type'      => 'color',
                'label'     => __( 'Header Text Color', 'athen_transl' ), 
                'element'   => '#site-header-inner, #site-header.header-one .header-main .header-main-free-txt,
                                #site-header.header-one .header-main .header-main-free-txt .fa',
                'style'     => 'color',
                'section'   => 'athen_header_styling',
            );

            // Header main - Link color
            $array[] = array(
                'id'        => 'header_main_link_color',
                'type'      => 'color',
                'label'     => __( 'Header Link Color', 'athen_transl' ), 
                'element'   => '#site-header-inner a:link',
                'style'     => 'color',
                'section'   => 'athen_header_styling',
            );

            $array[] = array(
                'id'        => 'athen_hr_control',
                'type'      => 'hr',
                'section'   => 'athen_header_styling',
            );

            // Header Main Top Padding
            $array[] = array(
                'id'        => 'header_main_top_padding',
                'type'      => 'text',
                'label'     => __( 'Header Main Top Padding', 'athen_transl' ), 
                'element'   => '#site-header-inner',
                'style'     => 'padding-top',
                'section'   => 'athen_header_styling',
                'sanitize'  => 'px',
                'transport' => 'refresh',
            );

            $array[] = array(
                'id'            => 'header_main_bottom_padding',
                'type'          => 'text',
                'label'         => __( 'Header Main Bottom Padding', 'athen_transl' ), 
                'element'       => '#site-header-inner',
                'style'         => 'padding-bottom',
                'section'       => 'athen_header_styling',
                'sanitize'      => 'px',
                'transport'     => 'refresh',
            );

            // Logo Colors
            $array[] = array(
                'id'        => 'athen_hr_control',
                'type'      => 'hr',
                'section'   => 'athen_header_styling',
            );

            $array[] = array(
                'id'        => 'logo_color',
                'type'      => 'color',
                'label'     => __( 'Logo Color', 'athen_transl' ), 
                'element'   => '#site-logo a',
                'style'     => 'color',
                'section'   => 'athen_header_styling',
            );
            $array[] = array(
                'id'        => 'logo_hover_color',
                'type'      => 'color',
                'label'     => __( 'Logo Hover Color', 'athen_transl' ), 
                'element'   => '#site-logo a:hover',
                'style'     => 'color',
                'section'   => 'athen_header_styling',
                'transport' => 'refresh',
            );

            // Logo Icon
            $array[] = array(
                'id'        => 'athen_hr_control',
                'type'      => 'hr',
                'section'   => 'athen_header_styling',
            );
            $array[] = array(
                'id'        => 'logo_icon_color',
                'type'      => 'color',
                'label'     => __( 'Text Logo Icon Color', 'athen_transl' ),
                'element'   => '#site-logo a .fa',
                'style'     => 'color',
                'section'   => 'athen_header_styling',
            );
            $array[] = array(
                'id'        => 'logo_icon_right_margin',
                'type'      => 'text',
                'label'     => __( 'Text Logo Icon Right Margin', 'athen_transl' ),
                'element'   => '#site-logo a .fa',
                'style'     => 'margin-right',
                'section'   => 'athen_header_styling',
                'sanitize'  => 'px',
                'transport' => 'refresh',
            );

            // Header Search
            $array[] = array(
                'id'        => 'athen_hr_control',
                'type'      => 'hr',
                'section'   => 'athen_header_styling',
            );
            $array[] = array(
                'id'        => 'search_dropdown_top_border',
                'type'      => 'color',
                'label'     => __( 'Search Dropdown Top Border', 'athen_transl' ),
                'element'   => '#searchform-dropdown',
                'style'     => 'border-top-color',
                'section'   => 'athen_header_styling',
            );
            $array[] = array(
                'id'        => 'main_search_overlay_top_margin',
                'type'      => 'text',
                'label'     => __( 'Search Overlay Top Margin', 'athen_transl' ),
                'element'   => '#searchform-overlay',
                'style'     => 'top',
                'section'   => 'athen_header_styling',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'search_button_color',
                'type'      => 'color',
                'label'     => __( 'Search Button Color', 'athen_transl' ), 
                'element'   => '#site-header .site-search-toggle, #site-header .site-search-toggle:hover, #site-header .site-search-toggle:active, body #header-two-search #header-two-search-submit',
                'style'     => 'color',
                'section'   => 'athen_header_styling',
                'important' => true,
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'search_button_background',
                'type'      => 'color',
                'label'     => __( 'Search Button Background', 'athen_transl' ),
                'element'   => '#site-header .site-search-toggle, #site-header .site-search-toggle:hover, #site-header .site-search-toggle:active, body #header-two-search #header-two-search-submit',
                'style'     => 'background',
                'section'   => 'athen_header_styling',
                'transport' => 'refresh',
            );

            // Fixed Header Opacity
            $array[] = array(
                'id'            => 'fixed_header_opacity',
                'type'          => 'text',
                'label'         => __( 'Fixed header Opacity', 'athen_transl' ),
                'element'       => '.is-sticky #site-header, #site-header.overlay-header.is-sticky',
                'style'         => 'opacity',
                'section'       => 'athen_header_fixed',
                'description'   =>  __( 'Enter a value from 0-1', 'athen_transl' ),
                'sanitize'      => 'intval',
                'transport'     => 'refresh',
            );

            /*-----------------------------------------------------*/
            /*  - Menu
            /*-----------------------------------------------------*/
            $array[] = array(
                'id'        => 'menu_background',
                'type'      => 'color',
                'label'     => __( 'Background', 'athen_transl' ), 
                'element'   => '#site-navigation-wrap, .is-sticky .fixed-nav',
                'style'     => 'background-color',
                'section'   => 'athen_main_menu_styling',
            );
            $array[] = array(
                'id'            => 'menu_borders',
                'type'          => 'color',
                'label'         => __( 'Borders', 'athen_transl' ), 
                'element'       => '#site-navigation li, #site-navigation a,
                                    #site-navigation ul, #site-navigation-wrap',
                'style'         => 'border-color',
                'section'       => 'athen_main_menu_styling',
                'description'   => __( 'Not all menus have borders, but this setting is for those that do', 'athen_transl' ),
            );

            // Menu Link Colors
            $array[] = array(
                'id'        => 'athen_hr_control',
                'type'      => 'hr',
                'section'   => 'athen_main_menu_styling',
            );
            $array[] = array(
                'id'        => 'menu_link_color',
                'type'      => 'link_color',
                'label'     => __( 'Link Color', 'athen_transl' ),
                'element'   => '#site-navigation .dropdown-menu > li > a',
                'style'     => 'color',
                'section'   => 'athen_main_menu_styling',
            );
            $array[] = array(
                'id'        => 'menu_link_color_hover',
                'type'      => 'link_color',
                'label'     => __( 'Link Color: Hover', 'athen_transl' ),
                'element'   => '#site-navigation .dropdown-menu > li > a:hover',
                'style'     => 'color',
                'section'   => 'athen_main_menu_styling',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'menu_link_color_active',
                'type'      => 'link_color',
                'label'     => __( 'Link Color: Current Menu Item', 'athen_transl' ),
                'element'   => '#site-navigation .dropdown-menu > .current-menu-item > a,
                                #site-navigation .dropdown-menu > .current-menu-parent > a,
                                #site-navigation .dropdown-menu > .current-menu-item > a:hover,
                                #site-navigation .dropdown-menu > .current-menu-parent > a:hover',
                'style'     => 'color',
                'section'   => 'athen_main_menu_styling',
                'transport' => 'refresh',
            );

            // Link Background
            $array[] = array(
                'id'        => 'athen_hr_control',
                'type'      => 'hr',
                'section'   => 'athen_main_menu_styling',
            );
            $array[] = array(
                'id'        => 'menu_link_background',
                'type'      => 'color',
                'label'     => __( 'Link Background', 'athen_transl' ),
                'element'   => '#site-navigation .dropdown-menu > li > a',
                'style'     => 'background-color',
                'section'   => 'athen_main_menu_styling',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'menu_link_hover_background',
                'type'      => 'color',
                'label'     => __( 'Link Background: Hover', 'athen_transl' ),
                'element'   => '#site-navigation .dropdown-menu > li > a:hover',
                'style'     => 'background-color',
                'section'   => 'athen_main_menu_styling',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'menu_link_active_background',
                'type'      => 'color',
                'label'     => __( 'Link Background: Current Menu Item', 'athen_transl' ),
                'element'   => '#site-navigation .dropdown-menu > .current-menu-item > a,
                                #site-navigation .dropdown-menu > .current-menu-parent > a,
                                #site-navigation .dropdown-menu > .current-menu-item > a:hover,
                                #site-navigation .dropdown-menu > .current-menu-parent > a:hover',
                'style'     => 'background-color',
                'section'   => 'athen_main_menu_styling',
            );

            // Link Inner
            $array[] = array(
                'id'        => 'athen_hr_control',
                'type'      => 'hr',
                'section'   => 'athen_main_menu_styling',
            );
            $array[] = array(
                'id'        => 'menu_link_span_background',
                'type'      => 'color',
                'label'     => __( 'Link Inner Background', 'athen_transl' ),
                'element'   => '#site-navigation .dropdown-menu > li > a > span.link-inner',
                'style'     => 'background-color',
                'section'   => 'athen_main_menu_styling',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'menu_link_span_hover_background',
                'type'      => 'color',
                'label'     => __( 'Link Inner Background: Hover', 'athen_transl' ),
                'element'   => '#site-navigation .dropdown-menu > li > a:hover > span.link-inner',
                'style'     => 'background-color',
                'section'   => 'athen_main_menu_styling',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'menu_link_span_active_background',
                'type'      => 'color',
                'label'     => __( 'Link Inner Background: Current Menu Item', 'athen_transl' ),
                'element'   => '#site-navigation .dropdown-menu > .current-menu-item > a > span.link-inner,
                                #site-navigation .dropdown-menu > .current-menu-parent > a > span.link-inner,
                                #site-navigation .dropdown-menu > .current-menu-item > a:hover > span.link-inner,
                                #site-navigation .dropdown-menu > .current-menu-parent > a:hover > span.link-inner',
                'style'     => 'background-color',
                'section'   => 'athen_main_menu_styling',
                'transport' => 'refresh',
            );

            // Menu Dropdowns
            $array[] = array(
                'id'        => 'athen_hr_control',
                'type'      => 'hr',
                'section'   => 'athen_main_menu_styling',
            );
            $array[] = array(
                'id'        => 'dropdown_menu_background',
                'type'      => 'color',
                'label'     => __( 'Dropdowns Background', 'athen_transl' ), 
                'element'   => '#site-navigation .dropdown-menu ul',
                'style'     => 'background-color',
                'section'   => 'athen_main_menu_styling',
            );
            $array[] = array(
                'id'        => 'dropdown_menu_pointer_bg',
                'type'      => 'color',
                'label'     => __( 'Dropdowns Pointer Background', 'athen_transl' ), 
                'element'   => '.navbar-style-one .dropdown-menu ul:after',
                'style'     => 'border-bottom-color',
                'section'   => 'athen_main_menu_styling',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'dropdown_menu_pointer_border',
                'type'      => 'color',
                'label'     => __( 'Dropdowns Pointer Border', 'athen_transl' ), 
                'element'   => '.navbar-style-one .dropdown-menu ul:before',
                'style'     => 'border-bottom-color',
                'section'   => 'athen_main_menu_styling',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'            => 'menu_dropdown_top_border_color',
                'type'          => 'color',
                'label'         => __( 'Dropdowns Top Border', 'athen_transl' ), 
                'element'       => 'body #site-navigation-wrap.nav-dropdown-top-border .dropdown-menu > li > ul',
                'style'         => 'border-top-color',
                'section'       => 'athen_main_menu_styling',
                'description'   => __( 'Used only if "Top Border" is enabled in the Menu "General" settings.', 'athen_transl' ),
            );
            $array[] = array(
                'id'        => 'dropdown_menu_borders',
                'type'      => 'color',
                'label'     => __( 'Menu Dropdown Borders', 'athen_transl' ), 
                'element'   => '#site-navigation .dropdown-menu ul, #site-navigation .dropdown-menu ul li, #site-navigation .dropdown-menu ul li a',
                'style'     => 'border-color',
                'section'   => 'athen_main_menu_styling',
            );
            $array[] = array(
                'id'        => 'dropdown_menu_link_color',
                'type'      => 'link_color',
                'label'     => __( 'Dropdown Link Color', 'athen_transl' ),
                'element'   => '#site-navigation .dropdown-menu ul > li > a',
                'style'     => 'color',
                'section'   => 'athen_main_menu_styling',
            );
            $array[] = array(
                'id'        => 'dropdown_menu_link_color_hover',
                'type'      => 'link_color',
                'label'     => __( 'Dropdown Link Color: Hover', 'athen_transl' ),
                'element'   => '#site-navigation .dropdown-menu ul > li > a:hover',
                'style'     => 'color',
                'section'   => 'athen_main_menu_styling',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'dropdown_menu_link_color_active',
                'type'      => 'link_color',
                'label'     => __( 'Dropdown Link Color: Current Menu Item', 'athen_transl' ),
                'element'   => '#site-navigation .dropdown-menu ul > .current-menu-item > a',
                'style'     => 'color',
                'section'   => 'athen_main_menu_styling',
            );
            $array[] = array(
                'id'        => 'dropdown_menu_link_hover_bg',
                'type'      => 'color_gradient',
                'label'     => __( 'Dropdown Link Background: Hover', 'athen_transl' ), 
                'subtitle'  => __( 'Select your custom hex color.', 'athen_transl' ),
                'element'   => '#site-navigation .dropdown-menu ul > li > a:hover',
                'style'     => 'background-color',
                'section'   => 'athen_main_menu_styling',
                'transport' => 'refresh',
            );

            // Menu Megamenu
            $array[] = array(
                'id'        => 'athen_hr_control',
                'type'      => 'hr',
                'section'   => 'athen_main_menu_styling',
            );
            $array[] = array(
                'id'        => 'mega_menu_title',
                'type'      => 'color',
                'label'     => __( 'Megamenu Subtitle Color', 'athen_transl' ), 
                'element'   => '.sf-menu > li.megamenu > ul.sub-menu > .menu-item-has-children > a',
                'style'     => 'color',
                'section'   => 'athen_main_menu_styling',
            );

            /*-----------------------------------------------------*/
            /*  - Mobile Icons
            /*-----------------------------------------------------*/

            $array[] = array(
                'id'        => 'mobile_menu_icon_size',
                'type'      => 'text',
                'label'     => __( 'Font Size', 'athen_transl' ),
                'element'   => '#mobile-menu a',
                'style'     => 'font-size',
                'sanitize'  => 'px',
                'section'   => 'athen_mobile_menu_icons_styling',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'mobile_menu_icon_color',
                'type'      => 'color',
                'label'     => __( 'Color', 'athen_transl' ),
                'element'   => '#mobile-menu a',
                'style'     => 'color',
                'section'   => 'athen_mobile_menu_icons_styling',
            );
            $array[] = array(
                'id'        => 'mobile_menu_icon_color_hover',
                'type'      => 'color',
                'label'     => __( 'Color: Hover', 'athen_transl' ),
                'element'   => '#mobile-menu a:hover',
                'style'     => 'color',
                'section'   => 'athen_mobile_menu_icons_styling',
                'transport' => 'refresh',
            );

            // Icons Menu BG
            $array[] = array(
                'id'        => 'athen_hr_control',
                'type'      => 'hr',
                'section'   => 'athen_mobile_menu_icons_styling',
            );

            $array[] = array(
                'id'        => 'mobile_menu_icon_background',
                'type'      => 'color',
                'label'     => __( 'Background', 'athen_transl' ),
                'element'   => '#mobile-menu a',
                'style'     => 'background-color',
                'section'   => 'athen_mobile_menu_icons_styling',
            );

            $array[] = array(
                'id'        => 'mobile_menu_icon_background_hover',
                'type'      => 'color',
                'label'     => __( 'Background: Hover', 'athen_transl' ),
                'element'   => '#mobile-menu a:hover',
                'style'     => 'background-color',
                'section'   => 'athen_mobile_menu_icons_styling',
                'transport' => 'refresh',
            );

            // Icons Menu Border
            $array[] = array(
                'id'        => 'athen_hr_control',
                'type'      => 'hr',
                'section'   => 'athen_mobile_menu_icons_styling',
            );

            $array[] = array(
                'id'        => 'mobile_menu_icon_border',
                'type'      => 'color',
                'label'     => __( 'Border', 'athen_transl' ),
                'element'   => '#mobile-menu a',
                'style'     => 'border-color',
                'section'   => 'athen_mobile_menu_icons_styling',
            );

            $array[] = array(
                'id'        => 'mobile_menu_icon_border_hover',
                'type'      => 'color',
                'label'     => __( 'Border: Hover', 'athen_transl' ),
                'element'   => '#mobile-menu a:hover',
                'style'     => 'border-color',
                'section'   => 'athen_mobile_menu_icons_styling',
                'transport' => 'refresh',
            );

            /*-----------------------------------------------------*/
            /*  - Sidr Menu
            /*-----------------------------------------------------*/
            $array[] = array(
                'id'        => 'mobile_menu_sidr_background',
                'type'      => 'color',
                'label'     => __( 'Background', 'athen_transl' ),
                'element'   => '#sidr-main',
                'style'     => 'background-color',
                'section'   => 'athen_sidr_styling',
            );
            $array[] = array(
                'id'        => 'mobile_menu_sidr_borders',
                'type'      => 'color',
                'label'     => __( 'Borders', 'athen_transl' ),
                'element'   => '#sidr-main li, #sidr-main ul',
                'style'     => 'border-color',
                'section'   => 'athen_sidr_styling',
            );

            // Sidr Links
            $array[] = array(
                'id'        => 'athen_hr_control',
                'type'      => 'hr',
                'section'   => 'athen_sidr_styling',
            );
            $array[] = array(
                'id'        => 'mobile_menu_links',
                'type'      => 'color',
                'label'     => __( 'Links', 'athen_transl' ),
                'element'   => '.sidr a, .sidr-class-dropdown-toggle',
                'style'     => 'color',
                'section'   => 'athen_sidr_styling',
            );
            $array[] = array(
                'id'        => 'mobile_menu_links_hover',
                'type'      => 'color',
                'label'     => __( 'Links: Hover', 'athen_transl' ),
                'element'   => '.sidr a:hover, .sidr-class-dropdown-toggle:hover, .sidr-class-dropdown-toggle .fa, .sidr-class-menu-item-has-children.active > a, .sidr-class-menu-item-has-children.active > a > .sidr-class-dropdown-toggle',
                'style'     => 'color',
                'section'   => 'athen_sidr_styling',
                'transport' => 'refresh',
            );

            // Sidr Search
            $array[] = array(
                'id'        => 'athen_hr_control',
                'type'      => 'hr',
                'section'   => 'athen_sidr_styling',
            );
            $array[] = array(
                'id'        => 'mobile_menu_sidr_search_color',
                'type'      => 'color',
                'label'     => __( 'Searchbar Color', 'athen_transl' ),
                'element'   => '.sidr-class-mobile-menu-searchform input',
                'style'     => 'color',
                'section'   => 'athen_sidr_styling',
            );
            $array[] = array(
                'id'        => 'mobile_menu_sidr_search_bg',
                'type'      => 'color',
                'label'     => __( 'Searchbar Background', 'athen_transl' ),
                'element'   => '.sidr-class-mobile-menu-searchform input',
                'style'     => 'background-color',
                'section'   => 'athen_sidr_styling',
            );

            /*-----------------------------------------------------*/
            /*  - Toggle Menu
            /*-----------------------------------------------------*/
            $array[] = array(
                'id'        => 'toggle_mobile_menu_background',
                'type'      => 'color',
                'label'     => __( 'Background', 'athen_transl' ),
                'element'   => '.mobile-toggle-nav',
                'style'     => 'background-color',
                'section'   => 'athen_toggle_mobile_menu_styling',
            );
            $array[] = array(
                'id'        => 'toggle_mobile_menu_borders',
                'type'      => 'color',
                'label'     => __( 'Borders', 'athen_transl' ),
                'element'   => '.mobile-toggle-nav a',
                'style'     => 'border-color',
                'section'   => 'athen_toggle_mobile_menu_styling',
            );
            $array[] = array(
                'id'        => 'athen_hr_control',
                'type'      => 'hr',
                'section'   => 'athen_toggle_mobile_menu_styling',
            );
            $array[] = array(
                'id'        => 'toggle_mobile_menu_links',
                'type'      => 'color',
                'label'     => __( 'Links', 'athen_transl' ),
                'element'   => '.mobile-toggle-nav a',
                'style'     => 'color',
                'section'   => 'athen_toggle_mobile_menu_styling',
            );
            $array[] = array(
                'id'        => 'toggle_mobile_menu_links_hover',
                'type'      => 'color',
                'label'     => __( 'Links: Hover', 'athen_transl' ),
                'element'   => '.mobile-toggle-nav a:hover',
                'style'     => 'color',
                'section'   => 'athen_toggle_mobile_menu_styling',
                'transport' => 'refresh',
            );

            /*-----------------------------------------------------*/
            /*  - Footer Widgets
            /*-----------------------------------------------------*/
            $array[] = array(
                'id'            => 'footer_padding',
                'type'          => 'text',
                'label'         => __( 'Padding', 'athen_transl' ),
                'element'       => '#footer-inner',
                'style'         => 'padding',
                'section'       => 'athen_footer_styling',
                'description'   => __( 'Format: top right bottom left.', 'athen_transl' ),
            );
            $array[] = array(
                'id'        => 'footer_background',
                'type'      => 'color',
                'label'     => __( 'Background', 'athen_transl' ),
                'element'   => '#footer',
                'style'     => 'background-color',
                'section'   => 'athen_footer_styling',
            );
            $array[] = array(
                'id'        => 'footer_color',
                'type'      => 'color',
                'label'     => __( 'Color', 'athen_transl' ),
                'element'   => '#footer, #footer p, #footer li a:before',
                'style'     => 'color',
                'section'   => 'athen_footer_styling',
            );
            $array[] = array(
                'id'        => 'footer_borders',
                'type'      => 'color',
                'label'     => __( 'Li & Calendar Borders', 'athen_transl' ),
                'element'   => '#footer li, #footer #wp-calendar thead th, #footer #wp-calendar tbody td',
                'style'     => 'border-color',
                'section'   => 'athen_footer_styling',
            );

            // Footer - Links
            $array[] = array(
                'id'        => 'athen_hr_control',
                'type'      => 'hr',
                'section'   => 'athen_footer_styling',
            );
            $array[] = array(
                'id'        => 'footer_link_color',
                'type'      => 'color',
                'label'     => __( 'Links', 'athen_transl' ),
                'element'   => '#footer a',
                'style'     => 'color',
                'section'   => 'athen_footer_styling',
            );
            $array[] = array(
                'id'        => 'footer_link_color_hover',
                'type'      => 'color',
                'label'     => __( 'Links: Hover', 'athen_transl' ),
                'element'   => '#footer a:hover',
                'style'     => 'color',
                'section'   => 'athen_footer_styling',
                'transport' => 'refresh',
            );

            /*-----------------------------------------------------*/
            /*  - Footer Bottom
            /*-----------------------------------------------------*/
            $array[] = array(
                'id'            => 'bottom_footer_text_align',
                'type'          => 'text_align',
                'label'         => __( 'Text Align', 'athen_transl' ),
                'element'       => '#footer-bottom',
                'style'         => 'text-align',
                'section'       => 'athen_footer_bottom_styling',
                'description'   => __( 'If you have disabled the footer menu this option is perfect for centering your copyright information.', 'athen_transl' ),
            );
            $array[] = array(
                'id'            => 'bottom_footer_padding',
                'type'          => 'text',
                'label'         => __( 'Padding', 'athen_transl' ),
                'element'       => '#footer-bottom',
                'style'         => 'padding',
                'section'       => 'athen_footer_bottom_styling',
                'description'   => __( 'Format: top right bottom left.', 'athen_transl' ),
            );
            $array[] = array(
                'id'        => 'bottom_footer_background',
                'type'      => 'color',
                'label'     => __( 'Background', 'athen_transl' ),
                'element'   => '#footer-bottom',
                'style'     => 'background-color',
                'section'   => 'athen_footer_bottom_styling',
            );
            $array[] = array(
                'id'        => 'bottom_footer_color',
                'type'      => 'color',
                'label'     => __( 'Color', 'athen_transl' ),
                'element'   => '#footer-bottom, #footer-bottom p',
                'style'     => 'color',
                'section'   => 'athen_footer_bottom_styling',
            );

            // Footer bottom links
            $array[] = array(
                'id'        => 'athen_hr_control',
                'type'      => 'hr',
                'section'   => 'athen_footer_bottom_styling',
            );
            $array[] = array(
                'id'        => 'bottom_footer_link_color',
                'type'      => 'color',
                'label'     => __( 'Links', 'athen_transl' ),
                'element'   => '#footer-bottom a',
                'style'     => 'color',
                'section'   => 'athen_footer_bottom_styling',
            );
            $array[] = array(
                'id'        => 'bottom_footer_link_color_hover',
                'type'      => 'color',
                'label'     => __( 'Links: Hover', 'athen_transl' ),
                'element'   => '#footer-bottom a:hover',
                'style'     => 'color',
                'section'   => 'athen_footer_bottom_styling',
                'transport' => 'refresh',
            );

            /*-----------------------------------------------------*/
            /*  - Scroll Top
            /*-----------------------------------------------------*/
            $array[] = array(
                'id'        => 'scroll_top_border_radius',
                'type'      => 'text',
                'label'     => __( 'Border Radius', 'athen_transl' ),
                'element'   => '#site-scroll-top',
                'style'     => 'border-radius',
                'section'   => 'athen_scroll_up_button_styling',
                'transport' => 'refresh',
            );

            // Scroll Top bg
            $array[] = array(
                'id'        => 'scroll_top_bg',
                'type'      => 'color',
                'label'     => __( 'Background', 'athen_transl' ),
                'element'   => '#site-scroll-top',
                'style'     => 'background-color',
                'section'   => 'athen_scroll_up_button_styling',
            );
            $array[] = array(
                'id'        => 'scroll_top_bg_hover',
                'type'      => 'color',
                'label'     => __( 'Background: Hover', 'athen_transl' ),
                'element'   => '#site-scroll-top:hover',
                'style'     => 'background-color',
                'section'   => 'athen_scroll_up_button_styling',
                'transport' => 'refresh',
            );

            // Scroll Top Border
            $array[] = array(
                'id'        => 'athen_hr_control',
                'type'      => 'hr',
                'section'   => 'athen_scroll_up_button_styling',
            );
            $array[] = array(
                'id'        => 'scroll_top_border',
                'type'      => 'color',
                'label'     => __( 'Border', 'athen_transl' ),
                'element'   => '#site-scroll-top',
                'style'     => 'border-color',
                'section'   => 'athen_scroll_up_button_styling',
            );
            $array[] = array(
                'id'        => 'scroll_top_border_hover',
                'type'      => 'color',
                'label'     => __( 'Border: Hover', 'athen_transl' ),
                'element'   => '#site-scroll-top:hover',
                'style'     => 'border-color',
                'section'   => 'athen_scroll_up_button_styling',
                'transport' => 'refresh',
            );

            // Scroll Top Color
            $array[] = array(
                'id'        => 'athen_hr_control',
                'type'      => 'hr',
                'section'   => 'athen_scroll_up_button_styling',
            );
            $array[] = array(
                'id'        => 'scroll_top_color',
                'type'      => 'color',
                'label'     => __( 'Text Color', 'athen_transl' ),
                'element'   => '#site-scroll-top',
                'style'     => 'color',
                'section'   => 'athen_scroll_up_button_styling',
            );
            $array[] = array(
                'id'        => 'scroll_top_color_hover',
                'type'      => 'color',
                'label'     => __( 'Text Color: Hover', 'athen_transl' ),
                'element'   => '#site-scroll-top:hover',
                'style'     => 'color',
                'section'   => 'athen_scroll_up_button_styling',
                'transport' => 'refresh',
            );

            /*-----------------------------------------------------*/
            /*  - Sidebar
            /*-----------------------------------------------------*/
            $array[] = array(
                'id'        => 'sidebar_background',
                'type'      => 'color',
                'label'     => __( 'Background', 'athen_transl' ),
                'element'   => '#sidebar',
                'style'     => 'background-color',
                'section'   => 'athen_sidebar_styling',
            );
            $array[] = array(
                'id'            => 'sidebar_padding',
                'type'          => 'text',
                'label'         => __( 'Padding', 'athen_transl' ),
                'element'       => '#sidebar',
                'style'         => 'padding',
                'section'       => 'athen_sidebar_styling',
                'description'   => __( 'Format: top right bottom left.', 'athen_transl' ),
                'transport'     => 'refresh',
            );
            $array[] = array(
                'id'            => 'sidebar_headings_color',
                'type'          => 'color',
                'label'         => __( 'Headings Color', 'athen_transl' ),
                'element'       => '#sidebar .widget-title, #sidebar .widget-title a',
                'style'         => 'color',
                'section'       => 'athen_sidebar_styling',
            );
            $array[] = array(
                'id'            => 'sidebar_text_color',
                'type'          => 'color',
                'label'         => __( 'Text Color', 'athen_transl' ),
                'element'       => '#sidebar, #sidebar p',
                'style'         => 'color',
                'section'       => 'athen_sidebar_styling',
            );
            $array[] = array(
                'id'            => 'sidebar_borders_color',
                'type'          => 'color',
                'label'         => __( 'Li & Calendar Borders', 'athen_transl' ),
                'element'       => '#sidebar li, #sidebar #wp-calendar thead th, #sidebar #wp-calendar tbody td',
                'style'         => 'border-color',
                'section'       => 'athen_sidebar_styling',
            );

            // Sidebar links
            $array[] = array(
                'id'        => 'athen_hr_control',
                'type'      => 'hr',
                'section'   => 'athen_sidebar_styling',
            );
            $array[] = array(
                'id'            => 'sidebar_link_color',
                'type'          => 'color',
                'label'         => __( 'Link Color', 'athen_transl' ),
                'element'       => '#sidebar a',
                'style'         => 'color',
                'section'       => 'athen_sidebar_styling',
            );
            $array[] = array(
                'id'            => 'sidebar_link_color_hover',
                'type'          => 'color',
                'label'         => __( 'Link Color: Hover', 'athen_transl' ),
                'element'       => '#sidebar a:hover',
                'style'         => 'color',
                'section'       => 'athen_sidebar_styling',
                'transport'     => 'refresh',
            );

            /*-----------------------------------------------------*/
            /*  - Page Title
            /*-----------------------------------------------------*/
            $array[] = array(
                'id'        => 'page_header_top_padding',
                'type'      => 'text',
                'label'     => __( 'Top Padding', 'athen_transl' ),
                'element'   => '.page-header, .section-intro',
                'style'     => 'padding-top',
                'section'   => 'athen_page_header',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'page_header_bottom_padding',
                'type'      => 'text',
                'label'     => __( 'Bottom Padding', 'athen_transl' ),
                'element'   => '.page-header, .section-intro',
                'style'     => 'padding-bottom',
                'section'   => 'athen_page_header',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'page_header_background',
                'type'      => 'color',
                'label'     => __( 'Background', 'athen_transl' ),
                'element'   => '.page-header, .section-intro',
                'style'     => 'background-color',
                'section'   => 'athen_page_header',
            );
            $array[] = array(
                'id'        => 'page_header_title_color',
                'type'      => 'color',
                'label'     => __( 'Text Color', 'athen_transl' ),
                'element'   => '.page-header-title',
                'style'     => 'color',
                'section'   => 'athen_page_header',
            );
            /*$array[] = array(
                'id'        => 'page_header_top_border',
                'type'      => 'color',
                'label'     => __( 'Top Border Color', 'athen_transl' ),
                'element'   => '.page-header, .theme-gaps .page-header-inner',
                'style'     => 'border-top-color',
                'section'   => 'athen_page_header',
            );
            $array[] = array(
                'id'        => 'page_header_bottom_border',
                'type'      => 'color',
                'label'     => __( 'Bottom Border Color', 'athen_transl' ),
                'element'   => '.page-header, .theme-gaps .page-header-inner',
                'style'     => 'border-bottom-color',
                'section'   => 'athen_page_header',
            );*/

            /*-----------------------------------------------------*/
            /*  - Breadcrumbs
            /*-----------------------------------------------------*/
            $array[] = array(
                'id'        => 'breadcrumbs_text_color',
                'type'      => 'color',
                'label'     => __( 'Text Color', 'athen_transl' ), 
                'element'   => '.site-breadcrumbs',
                'style'     => 'color',
                'section'   => 'athen_breadcrumbs',
            );
            $array[] = array(
                'id'        => 'breadcrumbs_seperator_color',
                'type'      => 'color',
                'label'     => __( 'Seperator Color', 'athen_transl' ), 
                'element'   => '.site-breadcrumbs .sep',
                'style'     => 'color',
                'section'   => 'athen_breadcrumbs',
            );
            $array[] = array(
                'id'        => 'breadcrumbs_link_color',
                'type'      => 'color',
                'label'     => __( 'Link Color', 'athen_transl' ), 
                'element'   => '.site-breadcrumbs a',
                'style'     => 'color',
                'section'   => 'athen_breadcrumbs',
            );
            $array[] = array(
                'id'        => 'breadcrumbs_link_color_hover',
                'type'      => 'color',
                'label'     => __( 'Link Color: Hover', 'athen_transl' ), 
                'element'   => '.site-breadcrumbs a:hover',
                'style'     => 'color',
                'section'   => 'athen_breadcrumbs',
                'transport' => 'refresh',
            );

            /*-----------------------------------------------------*/
            /*  - Links & Buttons
            /*-----------------------------------------------------*/
            $array[] = array(
                'id'        => 'link_color',
                'type'      => 'color',
                'label'     => __( 'Links Color', 'athen_transl' ),
                'element'   => 'a, h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover, .wpex-carousel-entry-title a:hover',
                'style'     => 'color',
                'section'   => 'athen_general_links_buttons',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'link_color_hover',
                'type'      => 'color',
                'label'     => __( 'Links Color: Hover', 'athen_transl' ),
                'element'   => 'a:hover',
                'style'     => 'color',
                'section'   => 'athen_general_links_buttons',
                'transport' => 'refresh',
            );

            $array[] = array(
                'id'        => 'headings_link_color_hover',
                'type'      => 'color',
                'label'     => __( 'Headings With Links Color: Hover', 'athen_transl' ),
                'element'   => 'h1 a:hover, h2 a:hover, a:hover h2, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover',
                'style'     => 'color',
                'section'   => 'athen_general_links_buttons',
            );

            // Button colors
            $array[] = array(
                'id'        => 'athen_hr_control',
                'type'      => 'hr',
                'section'   => 'athen_general_links_buttons',
            );
            $array[] = array(
                'id'            => 'theme_button_padding',
                'type'          => 'text',
                'label'         => __( 'Theme Button Padding', 'athen_transl' ),
                'element'       => 'input[type="submit"], .theme-button, button, .vcex-button.flat, .navbar-style-one .menu-button > a > span.link-inner',
                'style'         => 'padding',
                'section'       => 'athen_general_links_buttons',
                'transport'     => 'refresh',

                'description'   => __( 'Format: top right bottom left.', 'athen_transl' ),
            );
            $array[] = array(
                'id'        => 'theme_button_border_radius',
                'type'      => 'text',
                'label'     => __( 'Theme Button Border Radius', 'athen_transl' ),
                'element'   => 'input[type="submit"], .theme-button, button, .vcex-button.flat, .navbar-style-one .menu-button > a > span.link-inner',
                'style'     => 'border-radius',
                'section'   => 'athen_general_links_buttons',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'theme_button_color',
                'type'      => 'color',
                'label'     => __( 'Theme Button Color', 'athen_transl' ),
                'element'   => 'input[type="submit"], .theme-button, button, #main .tagcloud a:hover, .post-tags a:hover, .vcex-button.flat:hover,.navbar-style-one .menu-button > a > span.link-inner:hover',
                'style'     => 'color',
                'section'   => 'athen_general_links_buttons',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'theme_button_hover_color',
                'type'      => 'color',
                'label'     => __( 'Theme Button Color: Hover', 'athen_transl' ),
                'element'   => 'input[type="submit"]:hover, .theme-button:hover, button:hover, .vcex-button.flat:hover, .navbar-style-one .menu-button > a > span.link-inner:hover',
                'style'     => 'color',
                'section'   => 'athen_general_links_buttons',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'theme_button_bg',
                'type'      => 'color',
                'label'     => __( 'Theme Button Background', 'athen_transl' ),
                'element'   => 'input[type="submit"], .theme-button, button, .vcex-button.flat, .navbar-style-one .menu-button > a > span.link-inner',
                'style'     => 'background',
                'section'   => 'athen_general_links_buttons',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'theme_button_hover_bg',
                'type'      => 'color',
                'label'     => __( 'Theme Button Background: Hover', 'athen_transl' ),
                'element'   => 'input[type="submit"]:hover, .theme-button:hover, button:hover, .vcex-button.flat:hover, .navbar-style-one .menu-button > a > span.link-inner:hover',
                'style'     => 'background',
                'section'   => 'athen_general_links_buttons',
                'transport' => 'refresh',
                'transport' => 'refresh',
            );

            /*-----------------------------------------------------*/
            /*  - Forms
            /*-----------------------------------------------------*/
            $array[] = array(
                'id'            => 'input_padding',
                'type'          => 'text',
                'label'         => __( 'Padding', 'athen_transl' ),
                'element'       => '.entry input[type="text"],
                                .site-content input[type="password"],
                                .site-content input[type="email"],
                                .site-content input[type="tel"],
                                .site-content input[type="url"],
                                .site-content input[type="search"],
                                .site-content textarea',
                'style'         => 'padding',
                'section'       => 'athen_general_forms',
                'transport'     => 'refresh',
                'description'   => __( 'Format: top right bottom left.', 'athen_transl' ),
            );
            $array[] = array(
                'id'            => 'input_border_radius',
                'type'          => 'text',
                'label'         => __( 'Border Radius', 'athen_transl' ),
                'element'       => '.site-content input[type="text"],
                                .site-content input[type="password"],
                                .site-content input[type="email"],
                                .site-content input[type="tel"],
                                .site-content input[type="url"],
                                .site-content input[type="search"],
                                .site-content textarea',
                'style'         => 'border-radius',
                'section'       => 'athen_general_forms',
                'transport'     => 'refresh',
            );
            $array[] = array(
                'id'            => 'input_font_size',
                'type'          => 'text',
                'label'         => __( 'Font-Size', 'athen_transl' ),
                'element'       => '.site-content input[type="text"],
                                .site-content input[type="password"],
                                .site-content input[type="email"],
                                .site-content input[type="tel"],
                                .site-content input[type="url"],
                                .site-content input[type="search"],
                                .site-content textarea',
                'style'         => 'font-size',
                'section'       => 'athen_general_forms',
                'transport'     => 'refresh',
            );
            $array[] = array(
                'id'        => 'input_background',
                'type'      => 'color',
                'label'     => __( 'Background', 'athen_transl' ),
                'element'   => '.site-content input[type="text"],
                                .site-content input[type="password"],
                                .site-content input[type="email"],
                                .site-content input[type="tel"],
                                .site-content input[type="url"],
                                .site-content input[type="search"],
                                .site-content textarea',
                'style'     => 'background-color',
                'section'   => 'athen_general_forms',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'input_border',
                'type'      => 'color',
                'label'     => __( 'Border', 'athen_transl' ),
                'element'   => '.site-content input[type="text"],
                                .site-content input[type="password"],
                                .site-content input[type="email"],
                                .site-content input[type="tel"],
                                .site-content input[type="url"],
                                .site-content input[type="search"],
                                .site-content textarea',
                'style'     => 'border-color',
                'section'   => 'athen_general_forms',
                'transport' => 'refresh',
            );
            $array[] = array(
                'id'        => 'input_color',
                'type'      => 'color',
                'label'     => __( 'Color', 'athen_transl' ),
                'element'   => '.site-content input[type="text"],
                                .site-content input[type="password"],
                                .site-content input[type="email"],
                                .site-content input[type="tel"],
                                .site-content input[type="url"],
                                .site-content input[type="search"],
                                .site-content textarea',
                'style'     => 'color',
                'section'   => 'athen_general_forms',
                'transport' => 'refresh',
            );

            /*-----------------------------------------------------*/
            /*  - WooCommerce
            /*-----------------------------------------------------*/
            if ( ATHEN_CHECK_WOOCOMMERCE ) {
                $array[] = array(
                    'id'        => 'onsale_bg',
                    'type'      => 'color',
                    'label'     => __( 'On Sale Background', 'athen_transl' ),
                    'element'   => '.woocommerce span.onsale',
                    'style'     => 'background-color',
                    'section'   => 'athen_woocommerce_styling',
                );
                $array[] = array(
                    'id'        => 'onsale_color',
                    'type'      => 'color',
                    'label'     => __( 'On Sale Color', 'athen_transl' ),
                    'element'   => '.woocommerce span.onsale',
                    'style'     => 'color',
                    'section'   => 'athen_woocommerce_styling',
                );
                $array[] = array(
                    'id'        => 'woo_product_title_link_color',
                    'type'      => 'color',
                    'label'     => __( 'Product Entry Title Color', 'athen_transl' ),
                    'element'   => '.woocommerce ul.products li.product h3, .woocommerce ul.products li.product h3 mark',
                    'style'     => 'color',
                    'section'   => 'athen_woocommerce_styling',
                );
                $array[] = array(
                    'id'        => 'woo_product_title_link_color_hover',
                    'type'      => 'color',
                    'label'     => __( 'Product Entry Title Color: Hover', 'athen_transl' ),
                    'element'   => '.woocommerce ul.products li.product h3:hover, .woocommerce ul.products li.product h3:hover mark',
                    'style'     => 'color',
                    'section'   => 'athen_woocommerce_styling',
                );
                $array[] = array(
                    'id'        => 'woo_price_color',
                    'type'      => 'color',
                    'label'     => __( 'Global Price Color', 'athen_transl' ),
                    'element'   => '.price, .amount',
                    'style'     => 'color',
                    'section'   => 'athen_woocommerce_styling',
                );
                $array[] = array(
                    'id'        => 'woo_product_entry_price_color',
                    'type'      => 'color',
                    'label'     => __( 'Product Entry Price Color', 'athen_transl' ),
                    'element'   => '.woocommerce ul.products li.product .price, .woocommerce ul.products li.product .price .amount',
                    'style'     => 'color',
                    'section'   => 'athen_woocommerce_styling',
                );
                $array[] = array(
                    'id'        => 'woo_single_price_color',
                    'type'      => 'color',
                    'label'     => __( 'Single Product Price Color', 'athen_transl' ),
                    'element'   => '.woocommerce .summary .price, .woocommerce .summary .amount',
                    'style'     => 'color',
                    'section'   => 'athen_woocommerce_styling',
                );
                $array[] = array(
                    'id'        => 'woo_stars_color',
                    'type'      => 'color',
                    'label'     => __( 'Star Ratings Color', 'athen_transl' ),
                    'element'   => '.woocommerce p.stars a, .woocommerce .star-rating',
                    'style'     => 'color',
                    'section'   => 'athen_woocommerce_styling',
                );
                $array[] = array(
                    'id'        => 'woo_single_tabs_active_border_color',
                    'type'      => 'color',
                    'label'     => __( 'Product Tabs Active Border Color', 'athen_transl' ),
                    'element'   => '.woocommerce div.product .woocommerce-tabs ul.tabs li.active a',
                    'style'     => 'border-color',
                    'section'   => 'athen_woocommerce_styling',
                );
                $array[] = array(
                    'id'        => 'woo_button_bg',
                    'type'      => 'color',
                    'label'     => __( 'WooCommerce Button Background', 'athen_transl' ),
                    'element'   => '.woocommerce input#submit, .woocommerce .button, a.wc-forward',
                    'style'     => 'background-color',
                    'section'   => 'athen_woocommerce_styling',
                    'important' => true,
                );
                $array[] = array(
                    'id'        => 'woo_button_color',
                    'type'      => 'color',
                    'label'     => __( 'WooCommerce Button Color', 'athen_transl' ),
                    'element'   => '.woocommerce input#submit, .woocommerce .button, a.wc-forward',
                    'style'     => 'color',
                    'section'   => 'athen_woocommerce_styling',
                    'important' => true,
                );
                $array[] = array(
                    'id'        => 'woo_button_bg_hover',
                    'type'      => 'color',
                    'label'     => __( 'WooCommerce Button Hover: Background', 'athen_transl' ),
                    'element'   => '.woocommerce input#submit:hover, .woocommerce .button:hover, a.wc-forward:hover',
                    'style'     => 'background-color',
                    'section'   => 'athen_woocommerce_styling',
                    'important' => true,
                );
                $array[] = array(
                    'id'        => 'woo_button_color_hover',
                    'type'      => 'color',
                    'label'     => __( 'WooCommerce Button Hover: Color', 'athen_transl' ),
                    'element'   => '.woocommerce input#submit:hover, .woocommerce .button:hover, a.wc-forward:hover',
                    'style'     => 'color',
                    'section'   => 'athen_woocommerce_styling',
                    'important' => true,
                );
            }

            /*-----------------------------------------------------*/
            /*  - Visual Composer
            /*-----------------------------------------------------*/
            if ( ATHEN_CHECK_VC ) {

                $array[] = array(
                    'id'            => 'vc_row_bottom_margin',
                    'type'          => 'text',
                    'default'       => '40px',
                    'label'         => __( 'Column Bottom Margin', 'athen_transl' ), 
                    'description'   => __( 'Enter a default bottom margin for all Visual Composer columns to help speed up development.', 'athen_transl' ),
                    'element'       => '.wpb_column',
                    'style'         => 'margin-bottom',
                    'section'       => 'athen_visual_composer_styling',
                    'transport'     => 'refresh',
                );

                // Randoms
                $array[] = array(
                    'id'        => 'vcex_text_separator_two_border_color',
                    'type'      => 'color',
                    'label'     => __( 'Seperator With Text Border Color', 'athen_transl' ),
                    'element'   => 'body .vc_text_separator_two span',
                    'style'     => 'border-color',
                    'section'   => 'athen_visual_composer_styling',
                );
                $array[] = array(
                    'id'        => 'vcex_text_tab_two_bottom_border',
                    'type'      => 'color',
                    'label'     => __( 'Tabs Alternative 2 Border Color', 'athen_transl' ),
                    'element'   => 'body .wpb_tabs.tab-style-alternative-two .wpb_tabs_nav li.ui-tabs-active a',
                    'style'     => 'border-color',
                    'section'   => 'athen_visual_composer_styling',
                );
                $array[] = array(
                    'id'        => 'vcex_carousel_arrows',
                    'type'      => 'color',
                    'transport' => 'refresh',
                    'label'     => __( 'Carousel Arrows Highlight Color', 'athen_transl' ),
                    'element'   => '.wpex-carousel .owl-prev, .wpex-carousel .owl-next, .wpex-carousel .owl-prev:hover, .wpex-carousel .owl-next:hover',
                    'style'     => 'background-color',
                    'section'   => 'athen_visual_composer_styling',
                    'transport' => 'refresh',
                );

                // Grid filter
                $array[] = array(
                    'id'        => 'athen_hr_control',
                    'type'      => 'hr',
                    'section'   => 'athen_visual_composer_styling',
                );
                $array[] = array(
                    'id'        => 'vcex_grid_filter_active_color',
                    'type'      => 'color',
                    'label'     => __( 'Grid Filter: Active Link Color', 'athen_transl' ),
                    'element'   => '.vcex-filter-links a:hover, .vcex-filter-links li.active a',
                    'style'     => 'color',
                    'section'   => 'athen_visual_composer_styling',
                    'transport' => 'refresh',
                );
                $array[] = array(
                    'id'        => 'vcex_grid_filter_active_bg',
                    'type'      => 'color',
                    'label'     => __( 'Grid Filter: Active Link Background', 'athen_transl' ),
                    'element'   => '.vcex-filter-links a:hover, .vcex-filter-links li.active a',
                    'style'     => 'background-color',
                    'section'   => 'athen_visual_composer_styling',
                    'transport' => 'refresh',
                );
                $array[] = array(
                    'id'        => 'vcex_grid_filter_active_border',
                    'type'      => 'color',
                    'label'     => __( 'Grid Filter: Active Link Border', 'athen_transl' ),
                    'element'   => '.vcex-filter-links a:hover, .vcex-filter-links li.active a',
                    'style'     => 'border-color',
                    'section'   => 'athen_visual_composer_styling',
                    'transport' => 'refresh',
                );

                // Recent news
                $array[] = array(
                    'id'        => 'athen_hr_control',
                    'type'      => 'hr',
                    'section'   => 'athen_visual_composer_styling',
                );
                $array[] = array(
                    'id'        => 'vcex_recent_news_date_bg',
                    'type'      => 'color',
                    'label'     => __( 'Recent News Date: Background', 'athen_transl' ),
                    'element'   => '.vcex-recent-news-date span.month',
                    'style'     => 'background-color',
                    'section'   => 'athen_visual_composer_styling',
                );
                $array[] = array(
                    'id'        => 'vcex_recent_news_date_color',
                    'type'      => 'color',
                    'label'     => __( 'Recent News Date: Color', 'athen_transl' ),
                    'element'   => '.vcex-recent-news-date span.month',
                    'style'     => 'color',
                    'section'   => 'athen_visual_composer_styling',
                );


            }

            // Return array
            return $array;
        }

        /*-----------------------------------------------------------------------------------*/
        /*  - Reset Cache after customizer save
        /*-----------------------------------------------------------------------------------*/
        public function reset_cache() {
            remove_theme_mod( 'athen_customizer_css_cache' );
        }

        /*-----------------------------------------------------------------------------------*/
        /*  - Register theme options
        /*-----------------------------------------------------------------------------------*/
        public function register ( $wp_customize ) {

            // Get enabled customizer panels
            $enabled_panels = array( 'styling' => true );
            $enabled_panels = get_option( 'athen_customizer_panels', $enabled_panels );
            if ( empty( $enabled_panels['styling'] ) ) {
                return;
            }

            // Top Bar
            $wp_customize->add_section( 'athen_topbar_styling' , array(
                'title'     => __( 'Styling', 'athen_transl' ),
                'priority'  => 999,
                'panel'     => 'athen_headertop',
            ) );

            // Toggle Bar
            $wp_customize->add_section( 'athen_togglebar_styling' , array(
                'title'     => __( 'Styling', 'athen_transl' ),
                'priority'  => 999,
                'panel'     => 'athen_togglebar',
            ) );

            // Header
            $wp_customize->add_section( 'athen_header_styling' , array(
                'title'     => __( 'Styling', 'athen_transl' ),
                'priority'  => 999,
                'panel'     => 'athen_header',
            ) );

            // Menu
            $wp_customize->add_section( 'athen_main_menu_styling' , array(
                'title'     => __( 'Styling: Main', 'athen_transl' ),
                'priority'  => 997,
                'panel'     => 'athen_menu',
            ) );

            // Mobile Menu
            $wp_customize->add_section( 'athen_mobile_menu_icons_styling' , array(
                'title'     => __( 'Styling: Mobile Icons Menu', 'athen_transl' ),
                'priority'  => 998,
                'panel'     => 'athen_menu',
            ) );

            // Sidr
            $wp_customize->add_section( 'athen_sidr_styling' , array(
                'title'     => __( 'Styling: Mobile Sidebar Menu', 'athen_transl' ),
                'priority'  => 999,
                'panel'     => 'athen_menu',
            ) );

            // Toggle Mobile Menu
            $wp_customize->add_section( 'athen_toggle_mobile_menu_styling' , array(
                'title'     => __( 'Styling: Mobile Toggle Menu', 'athen_transl' ),
                'priority'  => 9999,
                'panel'     => 'athen_menu',
            ) );

            // Sidebar styling
            $wp_customize->add_section( 'athen_sidebar_styling' , array(
                'title'     => __( 'Styling', 'athen_transl' ),
                'priority'  => 999,
                'panel'     => 'athen_sidebar',
            ) );

            // Footer
            $wp_customize->add_section( 'athen_footer_styling' , array(
                'title'     => __( 'Styling: Footer', 'athen_transl' ),
                'priority'  => 997,
                'panel'     => 'athen_footer',
            ) );

            // Footer - Bottom
            $wp_customize->add_section( 'athen_footer_bottom_styling' , array(
                'title'     => __( 'Styling: Footer Bottom', 'athen_transl' ),
                'priority'  => 998,
                'panel'     => 'athen_footer',
            ) );

            // Footer - Back to top link
            $wp_customize->add_section( 'athen_scroll_up_button_styling' , array(
                'title'     => __( 'Styling: Scroll Up Button', 'athen_transl' ),
                'priority'  => 999,
                'panel'     => 'athen_footer',
            ) );

            // Links & Buttons
            $wp_customize->add_section( 'athen_general_links_buttons' , array(
                'title'     => __( 'Links & Buttons', 'athen_transl' ),
                'priority'  => 999,
                'panel'     => 'athen_general',
            ) );

            // Forms
            $wp_customize->add_section( 'athen_general_forms' , array(
                'title'     => __( 'Forms', 'athen_transl' ),
                'priority'  => 999,
                'panel'     => 'athen_general',
            ) );

            // Callout
            $wp_customize->add_section( 'athen_callout_styling' , array(
                'title'     => __( 'Styling', 'athen_transl' ),
                'priority'  => 999,
                'panel'     => 'athen_callout',
            ) );

            // WooCommerce
            if ( ATHEN_CHECK_WOOCOMMERCE ) {
                $wp_customize->add_section( 'athen_woocommerce_styling' , array(
                    'title'     => __( 'Styling', 'athen_transl' ),
                    'priority'  => 999,
                    'panel'     => 'athen_woocommerce',
                ) );
            }

            // Visual Composer
            if ( ATHEN_CHECK_VC ) {
                $wp_customize->add_section( 'athen_visual_composer_styling' , array(
                    'title'     => __( 'Styling', 'athen_transl' ),
                    'priority'  => 999,
                    'panel'     => 'athen_visual_composer',
                ) );
            }

            // Get Styling Options
            $styling_options = $this->styling_options();

            // Loop through color options and add a theme customizer setting for it
            $count = 0;
            foreach( $styling_options as $option ) {

                // Get vals
                $count++;
                $id             = $option[ 'id' ];
                $default        = isset( $option[ 'default' ] ) ? $option[ 'default' ] : '';
                $transport      = isset( $option[ 'transport' ] ) ? $option[ 'transport' ] : 'postMessage';
                $type           = isset( $option[ 'type' ] ) ? $option[ 'type' ] : 'color';
                $section        = isset( $option[ 'section' ] ) ? $option[ 'section' ] : 'athen_styling_other';
                $description    = isset( $option[ 'description' ] ) ? $option[ 'description' ] : '';

                /* Check theme mod and set transport to refresh when value is set to fix a bug with the clear button
                if ( 'postMessage' == $transport && get_theme_mod( $option[ 'id' ] ) ) {
                    $transport = 'refresh';
                }*/

                // Set all transports to refresh...too many WP bugs, lets see how people react
                $transport = 'refresh';

                // Setting
                if ( 'hr' == $type ) {
                    $id = 'athen_hr_control[ '. $count .' ]';
                }
                $wp_customize->add_setting( $id, array(
                    'type'              => 'theme_mod',
                    'default'           => $default,
                    'transport'         => $transport,
                    'sanitize_callback' => false,
                ) );

                // Control
                if ( 'hr' == $type ) {
                    $wp_customize->add_control( new WPEX_HR_Control( $wp_customize, $id, array(
                        'label'         => '',
                        'section'       => $section,
                        'settings'      => $id,
                        'priority'      => $count,
                    ) ) );
                } elseif ( 'text' == $type ) {
                    $wp_customize->add_control( $option[ 'id' ], array(
                        'label'         => $option[ 'label' ],
                        'section'       => $section,
                        'settings'      => $id,
                        'priority'      => $count,
                        'type'          => 'text',
                        'description'   => $description,
                    ) );
                } elseif( 'text_align' == $type ) {
                    $wp_customize->add_control( $option[ 'id' ], array(
                        'label'         => $option[ 'label' ],
                        'section'       => $section,
                        'settings'      => $id,
                        'priority'      => $count,
                        'type'          => 'select',
                        'description'   => $description,
                        'choices'       => array(
                            'default'   => __( 'Default','athen_transl' ),
                            'left'      => __( 'Left','athen_transl' ),
                            'right'     => __( 'Right','athen_transl' ),
                            'center'    => __( 'Center','athen_transl' ),
                        ),
                    ) );
                } else {
                    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $id, array(
                        'label'         => $option[ 'label' ],
                        'section'       => $section,
                        'settings'      => $id,
                        'priority'      => $count,
                        'description'   => $description,
                    ) ) );
                }
            }
        }

        /*-----------------------------------------------------------------------------------*/
        /*  - Output CSS
        /*-----------------------------------------------------------------------------------*/
        public function header_output( $output ) {

            // Get cached CSS output
            $data   = get_theme_mod( 'athen_customizer_css_cache', false );
            $css    = '';

            // Remove mod in the customizer
            if ( is_customize_preview() ) {
                $data = '';
            }

            // If theme mod cache empty or is live customizer loop through elements and set output
            if ( ! $data || 'empty' == $data ) {

                // Get all color options
                $styling_options = $this->styling_options();

                foreach( $styling_options as $option ) {

                    // Get option type
                    $type = isset( $option[ 'type' ] ) ? $option[ 'type' ] : 'color';

                    // Seperator doesn't need styling
                    if ( 'hr' == $type ) {
                        continue;
                    }

                    $element        = $option[ 'element' ];
                    $style          = $option[ 'style' ];
                    $default        = isset( $option[ 'default' ] ) ? $option[ 'default' ] : '';
                    $sanitize       = isset( $option[ 'sanitize' ] ) ? $option[ 'sanitize' ] : '';
                    $media_query    = isset( $option[ 'media_query' ] ) ? $option[ 'media_query' ] : '';
                    $important      = isset( $option[ 'important' ] ) ? true : false;
                    $theme_mod      = get_theme_mod( $option[ 'id' ], $default );

                    // Output CSS
                    if ( $theme_mod ) {

                        // Fix some weird wp bug
                        if ( is_array( $theme_mod ) ) {
                            continue;
                        }

                        // Add !important tag
                        if ( $important ) {
                            $important = ' !important;';
                        }

                        // Sanitize data
                        if ( 'px' == $sanitize ) {
                            $theme_mod = intval( $theme_mod ) .'px !important';
                        }
                        if ( 'border-radius' == $sanitize ) {
                            $theme_mod = athen_sanitize_data( $theme_mod, 'border_radius' );
                        }

                        // Media Query
                        if ( $media_query ) {
                            $css .= $media_query .' {';
                                $css .= $element .'{ '. $style .':'. $theme_mod . $important .'; }';
                            $css .= '}';
                        }

                        // Standard Output
                        else {
                            if ( is_array( $style ) ) {
                                foreach ( $style as $style_item ) {
                                    $css .= $element .'{ '. $style_item .':'. $theme_mod . $important .'; }';
                                }
                            } else {
                                $css .= $element .'{ '. $style .':'. $theme_mod . $important .'; }';
                            }
                        }

                    }
                }
            }

            // Set cache or get cache if not in customizer
            if ( ! is_customize_preview() ) {
                // Get Cache
                if ( $data ) {
                    $css = get_theme_mod( 'athen_customizer_css_cache' );
                }
                // Set Cache
                else {
                    if ( $css ) {
                        $css = athen_minify_css( $css );
                        set_theme_mod( 'athen_customizer_css_cache', $css );
                        $css = get_theme_mod( 'athen_customizer_css_cache' );
                    } else {
                        set_theme_mod( 'athen_customizer_css_cache', 'empty' );
                    }
                }
            }

            // Output CSS in head if not empty
            if ( $css && 'empty' != $css ) {
                $output .= '/*CUSTOMIZER STYLING*/'. $css;
            }

            // Return $output
            return $output;

        } // End header_output function
    }
}
new Athen_Theme_Customizer_Styling(); 