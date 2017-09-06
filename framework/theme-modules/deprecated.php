<?php
/**
 * Description : Deprecated functions. 
 * 
 * @package     Athen
 * @subpackage  Closer 
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 * Associated : with different functions within frameworks 
 */


/*-----------------------------------------------------------------------------------*/
/*  - Rename old functions for better consistancy
/*-----------------------------------------------------------------------------------*/
function athen_is_page_header_enabled( $post_id = NULL ) {
	return athen_has_page_header( $post_id );
}
function athen_footer_reveal_enabled( $post_id = '' ) {
	return athen_has_footer_reveal( $post_id );
}
function athen_display_callout( $post_id = '' ) {
	return athen_has_callout( $post_id );
}
function athen_display_page_header() {
	athen_page_header();
}
function athen_display_page_header_title() {
	athen_page_header_title();
}
function athen_is_top_bar_enabled() {
	return athen_has_top_bar();
}
function athen_header_layout() {
	// Do nothing, new function athen_site_header is added via hook
}
function athen_toggle_bar_active() {
	return athen_has_togglebar();
}
function athen_toggle_bar_btn() {
	return athen_toggle_bar_button();
}
function athen_get_post_layout_class() {
	return athen_post_layout();
}
function athen_overlay_classname() {
	return athen_overlay_classes();
}
function athen_img_animation_classes() {
	return athen_entry_image_animation_classes();
}

/*-----------------------------------------------------------------------------------*/
/*  - Display Deprecated notices
/*-----------------------------------------------------------------------------------*/
function athen_option() {
	_deprecated_function( 'athen_option', '1.6.0', 'athen_get_mod' );
}
function athen_image() {
	_deprecated_function( 'athen_image', '2.0.0', 'athen_get_post_thumbnail' );
}
function athen_mobile_menu() {
	_deprecated_function( 'athen_mobile_menu', '2.0.0', 'athen_mobile_menu_icons' );
}
function athen_post_has_composer() {
	_deprecated_function( 'athen_post_has_composer', '2.0.0', 'athen_has_composer' );
}
function athen_display_header() {
	_deprecated_function( 'athen_display_header', '2.0.0', 'athen_has_header' );
}
function athen_display_footer() {
	_deprecated_function( 'athen_display_footer', '2.0.0', 'athen_has_footer' );
}
function athen_display_footer_widgets() {
	_deprecated_function( 'athen_display_footer_widgets', '2.0.0', 'athen_has_footer_widgets' );
}
function athen_page_title() {
	_deprecated_function( 'athen_page_title', '2.0.0', 'athen_title' );
}
function athen_breadcrumbs_enabled() {
	_deprecated_function( 'athen_breadcrumbs_enabled', '2.0.0', 'athen_has_breadcrumbs' );
}

function athen_post_subheading() {
	_deprecated_function( 'athen_post_subheading', '2.0.0', 'athen_page_header_subheading' );
}

function athen_hook_header_before_default() {
	_deprecated_function( 'athen_hook_header_before_default', '2.0.0' );
}

function athen_hook_header_inner_default() {
	_deprecated_function( 'athen_hook_header_inner_default', '2.0.0' );
}

function athen_hook_header_bottom_default() {
	_deprecated_function( 'athen_hook_header_bottom_default', '2.0.0' );
}

function athen_hook_main_top_default() {
	_deprecated_function( 'athen_hook_main_top_default', '2.0.0' );
}

function athen_hook_sidebar_inner_default() {
	_deprecated_function( 'athen_hook_sidebar_inner_default', '2.0.0' );
}

function athen_hook_footer_before_default() {
	_deprecated_function( 'athen_hook_footer_before_default', '2.0.0' );
}

function athen_hook_footer_inner_default() {
	_deprecated_function( 'athen_hook_footer_inner', '2.0.0' );
}

function athen_hook_footer_after_default() {
	_deprecated_function( 'athen_hook_footer_after', '2.0.0' );
}

function athen_hook_wrap_after_default() {
	_deprecated_function( 'athen_hook_wrap_after_default', '2.0.0' );
}

function athen_theme_setup() {
	_deprecated_function( 'athen_theme_setup', '1.6.0' );
}

function athen_get_template_part() {
	_deprecated_function( 'athen_get_template_part', '1.6.0', 'get_template_part' );
}

function athen_active_post_types() {
	_deprecated_function( 'athen_active_post_types', '1.6.0' );
}

function athen_jpeg_quality() {
	_deprecated_function( 'athen_jpeg_quality', '1.6.0' );
}

function athen_favicons() {
	_deprecated_function( 'athen_favicons', '1.6.0' );
}

function athen_get_woo_product_first_cat() {
	_deprecated_function( 'athen_get_woo_product_first_cat', '1.6.0' );
}

function athen_global_config() {
	_deprecated_function( 'athen_global_config', '1.6.0' );
}

function athen_supports() {
	_deprecated_function( 'athen_supports', '1.6.0' );
}

function athen_ie8_css() {
	_deprecated_function( 'athen_ie8_css', '1.6.0' );
}

function athen_html5() {
	_deprecated_function( 'athen_html5', '1.6.0' );
}

function athen_load_scripts() {
	_deprecated_function( 'athen_load_scripts', '1.6.0' );
}

function athen_remove_wp_ver_css_js() {
	_deprecated_function( 'athen_remove_wp_ver_css_js', '1.6.0' );
}

function athen_output_css() {
	_deprecated_function( 'athen_output_css', '1.6.0' );
}

function athen_header_output() {
	_deprecated_function( 'athen_header_output', '1.6.0', 'athen_header_layout' );
}

function athen_footer_copyright() {
	_deprecated_function( 'athen_footer_copyright', '1.6.0', 'get_template_part' );
}

function athen_topbar_output() {
	_deprecated_function( 'athen_topbar_output', '1.6.0', 'get_template_part' );
}

function athen_top_bar_social() {
	_deprecated_function( 'athen_top_bar_social', '1.6.0', 'get_template_part' );
}

function athen_portfolio_single_media() {
	_deprecated_function( 'athen_portfolio_single_media', '1.6.0', 'get_template_part' );
}

function athen_portfolio_related() {
	_deprecated_function( 'athen_portfolio_related', '1.6.0', 'get_template_part' );
}

function athen_portfolio_entry_media() {
	_deprecated_function( 'athen_portfolio_entry_media', '1.6.0', 'get_template_part' );
}

function athen_portfolio_entry_content() {
	_deprecated_function( 'athen_portfolio_entry_content', '1.6.0', 'get_template_part' );
}

function athen_staff_entry_media() {
	_deprecated_function( 'athen_staff_entry_media', '1.6.0', 'get_template_part' );
}

function athen_staff_related() {
	_deprecated_function( 'athen_staff_related', '1.6.0', 'get_template_part' );
}

function athen_blog_related() {
	_deprecated_function( 'athen_blog_related', '1.6.0', 'get_template_part' );
}

function athen_blog_entry_display() {
	_deprecated_function( 'athen_blog_entry_display', '1.6.0', 'get_template_part' );
}

function athen_blog_entry_image() {
	_deprecated_function( 'athen_blog_entry_image', '1.6.0', 'get_template_part' );
}

function athen_post_entry_author_avatar() {
	_deprecated_function( 'athen_post_entry_author_avatar', '1.6.0', 'get_template_part' );
}

function athen_blog_entry_title() {
	_deprecated_function( 'athen_blog_entry_title', '1.6.0', 'get_template_part' );
}

function athen_blog_entry_header() {
	_deprecated_function( 'athen_blog_entry_header', '1.6.0', 'get_template_part' );
}

function athen_blog_entry_content() {
	_deprecated_function( 'athen_blog_entry_content', '1.6.0', 'get_template_part' );
}

function athen_blog_entry_media() {
	_deprecated_function( 'athen_blog_entry_media', '1.6.0', 'get_template_part' );
}

function athen_blog_entry_link_format_image() {
	_deprecated_function( 'athen_blog_entry_link_format_image', '1.6.0', 'get_template_part' );
}

function athen_post_readmore_link() {
	_deprecated_function( 'athen_post_readmore_link', '1.6.0', 'get_template_part' );
}

function athen_blog_entry_video() {
	_deprecated_function( 'athen_blog_entry_video', '1.6.0', 'get_template_part' );
}

function athen_blog_entry_audio() {
	_deprecated_function( 'athen_blog_entry_audio', '1.6.0', 'get_template_part' );
}

function athen_post_meta() {
	_deprecated_function( 'athen_post_meta', '1.6.0', 'get_template_part' );
}

function athen_post_entry_classes() {
	_deprecated_function( 'athen_post_entry_classes', '1.6.0' );
}