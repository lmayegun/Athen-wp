<?php
/**
 * Description : Functions used to setup theme hooks and trigger hooks(with do_action() ).
 *             : General panel, section, setting & control.
 * 
 * @package     Athen
 * @subpackage  Closer - View/Model
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 * Dependent : customizer/customizer.php (Athen_Customizer class)
 */


/**
 * Array of theme hooks
 *
 * @since 2.0.0
 */
function athen_theme_hooks() {
    return array(
        'athen_outer_wrap_before',
        'athen_outer_wrap_after',
        'athen_hook_topbar_before',
        'athen_hook_topbar_after',
        'athen_hook_header_before',
        'athen_hook_header_after',
        'athen_hook_header_top',
        'athen_hook_header_inner',
        'athen_hook_header_bottom',
        'athen_hook_wrap_before',
        'athen_hook_wrap_after',
        'athen_hook_wrap_top',
        'athen_hook_wrap_bottom',
        'athen_hook_main_before',
        'athen_hook_main_after',
        'athen_hook_main_top',
        'athen_hook_main_bottom',
        'athen_hook_primary_before',
        'athen_hook_primary_after',
        'athen_hook_content_before',
        'athen_hook_content_top',
        'athen_hook_content_bottom',
        'athen_hook_content_after',
        'athen_hook_sidebar_before',
        'athen_hook_sidebar_after',
        'athen_hook_sidebar_top',
        'athen_hook_sidebar_bottom',
        'athen_hook_sidebar_inner',
        'athen_hook_footer_before',
        'athen_hook_footer_after',
        'athen_hook_footer_top',
        'athen_hook_footer_bottom',
        'athen_hook_footer_inner',
        'athen_hook_main_menu_before',
        'athen_hook_main_menu_after',
        'athen_hook_main_menu_top',
        'athen_hook_main_menu_bottom',
        'athen_hook_page_header_before',
        'athen_hook_page_header_after',
        'athen_hook_page_header_top',
        'athen_hook_page_header_inner',
        'athen_hook_page_header_bottom',
        'athen_hook_social_share_before',
        'athen_hook_social_share_after',
        'athen_hook_social_share_inner',
    );
}

/**
 * Outer Wrap Hooks
 *
 * @since 2.0.0
 */
function athen_outer_wrap_before() {
    do_action( 'athen_outer_wrap_before' );
}
function athen_outer_wrap_after() {
    do_action( 'athen_outer_wrap_after' );
}

/**
 * Wrap Hooks
 *
 * @since Total 1.0.0
 */
function athen_hook_wrap_before() {
    do_action( 'athen_hook_wrap_before' );
}
function athen_hook_wrap_after() {
    do_action( 'athen_hook_wrap_after' );
}
function athen_hook_wrap_bottom() {
    do_action( 'athen_hook_wrap_bottom' );
}

/**
 * Site Header
 *
 * @since Total 1.0.0
 */
function athen_hook_site_header_before(){
    do_action('athen_hook_site_header_before');
}
function athen_display_site_header() {
    do_action( 'athen_display_site_header' );
}
function athen_hook_site_header_after(){
    do_action('athen_hook_site_header_after');
}
function athen_hook_top_header() {
    do_action( 'athen_hook_top_header' );
}
function athen_hook_top_header_before() {
    do_action( 'athen_hook_top_header_before' );
}
function athen_hook_top_header_after() {
    do_action( 'athen_hook_top_header_after' );
}
function athen_display_top_header() {
    do_action( 'athen_display_top_header' );
}
function athen_hook_main_header_before() {
    do_action( 'athen_hook_main_header_before' );
}
function athen_hook_main_header_after() {
    do_action( 'athen_hook_main_header_after' );
}
function athen_hook_bottom_header() {
    do_action( 'athen_hook_bottom_header' );
}
function athen_display_bottom_header() {
    do_action( 'athen_display_bottom_header' );
}
function athen_hook_main_header() {
    do_action( 'athen_hook_main_header' );
}
function athen_hook_header_bottom() {
    do_action( 'athen_hook_header_bottom' );
}


/**
 * Topbar Hooks
 *
 * @since 2.0.0
 */
function athen_hook_topbar_before() {
    do_action( 'athen_hook_topbar_before' );
}
function athen_hook_topbar_after() {
    do_action( 'athen_hook_topbar_after' );
}

/**
 * Main Hooks
 *
 * @since Total 1.0.0
 */
function athen_hook_main_before() {
    do_action( 'athen_hook_main_before' );
}
function athen_hook_main_after() {
    do_action( 'athen_hook_main_after' );
}
function athen_hook_main_top() {
    do_action( 'athen_hook_main_top' );
}
function athen_hook_main_bottom() {
    do_action( 'athen_hook_main_bottom' );
}


/**
 * Primary Hooks
 *
 * @since 2.0.0
 */
function athen_hook_primary_before() {
    do_action( 'athen_hook_primary_before' );
}
function athen_hook_primary_after() {
    do_action( 'athen_hook_primary_after' );
}


/**
 * Content Hooks
 *
 * @since Total 1.0.0
 */
function athen_hook_content_before() {
    do_action( 'athen_hook_content_before' );
}
function athen_hook_content_top() {
    do_action( 'athen_hook_content_top' );
}
function athen_hook_content_bottom() {
    do_action( 'athen_hook_content_bottom' );
}
function athen_hook_content_after() {
    do_action( 'athen_hook_content_after' );
}


/**
 * Sidebar Hooks
 *
 * @since Total 1.0.0
 */
function athen_hook_sidebar_before() {
    do_action( 'athen_hook_sidebars_before' );
}
function athen_hook_sidebar_after() {
    do_action( 'athen_hook_sidebars_after' );
}
function athen_hook_sidebar_top() {
    do_action( 'athen_hook_sidebar_top' );
}
function athen_hook_sidebar_bottom() {
    do_action( 'athen_hook_sidebar_bottom' );
}
function athen_hook_sidebar_inner() {
    do_action( 'athen_hook_sidebar_inner' );
}


/**
 * Footer Hooks
 *
 * @since Total 1.0.0
 */
function athen_hook_footer_before() {
    do_action( 'athen_hook_footer_before' );
}
function athen_hook_footer_after() {
    do_action( 'athen_hook_footer_after' );
}
function athen_hook_footer_top() {
    do_action( 'athen_hook_footer_top' );
}
function athen_hook_footer_bottom() {
    do_action( 'athen_hook_footer_bottom' );
}
function athen_hook_footer_inner() {
    do_action( 'athen_hook_footer_inner' );
}


/**
 * Main Menu Hooks
 *
 * @since Total 1.0.0
 */
function athen_hook_main_menu_before() {
    do_action( 'athen_hook_main_menu_before' );
}
function athen_hook_main_menu_after() {
    do_action( 'athen_hook_main_menu_after' );
}
function athen_hook_main_menu_top() {
    do_action( 'athen_hook_main_menu_top' );
}
function athen_hook_main_menu_bottom() {
    do_action( 'athen_hook_main_menu_bottom' );
}


/**
 * Page Header Hooks
 *
 * @since Total 1.0.0
 */
function athen_hook_page_header_before() {
    do_action( 'athen_hook_page_header_before' );
}
function athen_hook_page_header_after() {
    do_action( 'athen_hook_page_header_after' );
}
function athen_hook_page_header_top() {
    do_action( 'athen_hook_page_header_top' );
}
function athen_hook_page_header_inner() {
    do_action( 'athen_hook_page_header_inner' );
}
function athen_hook_page_header_bottom() {
    do_action( 'athen_hook_page_header_bottom' );
}