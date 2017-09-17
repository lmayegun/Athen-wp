<?php
/**
 *
 * Description : All action in this file helps in display content. Do Not Edit or Delete.
 *             : Action can be remove by using remove_action in child theme. 
 *             : The main key function that hooks other partials are - 
 *             : 'athen_header', 'athen_get_sidebar_template', 'athen_footer.
 * 
 * @package     Athen
 * @subpackage  Closer - View
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 * Dependent : customizer/customizer.php (Athen_Customizer class)
 */

/* Wrap > Top
-------------------------------------------------------------------------------*/
add_action( 'athen_hook_site_header_before', 'athen_post_slider' );
add_action( 'athen_display_site_header', 'athen_site_header_partial' );

	/* Topbar > Before
	------------------------------------------------------------------------------*/
    add_action( 'athen_hook_top_header_before', 'athen_post_slider' );
			
            /* Header > Top 
            -------------------------------------------------------------------------------*/
            add_action( 'athen_display_top_header', 'athen_top_header_partial');
                        
            /* Header > Top > Partials
            -------------------------------------------------------------------*/
            add_action( 'athen_hook_top_header', 'athen_top_header_logo' );
            add_action( 'athen_hook_top_header', 'athen_top_header_menu' );
            add_action( 'athen_hook_top_header', 'athen_top_header_aside' );
            add_action( 'athen_hook_top_header', 'athen_search_icon' );
            add_action( 'athen_hook_top_header', 'athen_header_social' );
            add_action( 'athen_hook_top_header', 'athen_search_dropdown');
            add_action( 'athen_hook_top_header', 'athen_search_header_replace' );
    
    /* Topbar > After
	------------------------------------------------------------------------------*/
    add_action( 'athen_hook_top_header_after', 'athen_post_slider' );

    
    /* Main Header > Before
	------------------------------------------------------------------------------*/
    add_action( 'athen_hook_top_header_after', 'athen_post_slider' );
    
            /* Header > Inner
			-------------------------------------------------------------------------------*/
			add_action( 'athen_hook_main_header', 'athen_header_logo' );
			add_action( 'athen_hook_main_header', 'athen_header_aside' );
			add_action( 'athen_hook_main_header', 'athen_header_menu' );
            add_action( 'athen_hook_main_header', 'athen_header_social' );
            add_action( 'athen_hook_main_header', 'athen_search_icon' );
			add_action( 'athen_hook_main_header', 'athen_search_dropdown' );
			add_action( 'athen_hook_main_header', 'athen_search_header_replace' );
            
    /* Main Header > After
	------------------------------------------------------------------------------*/
    add_action( 'athen_hook_main_header_before', 'athen_post_slider' );
                        
            /* Header > Bottom
            -------------------------------------------------------------------------------*/
            add_action( 'athen_display_bottom_header', 'athen_bottom_header_partial');
            
			/* Header > Bottom
			-------------------------------------------------------------------------------*/
			add_action( 'athen_hook_bottom_header', 'athen_bottom_header_menu' );
            add_action( 'athen_hook_bottom_header', 'athen_header_social' );
			add_action( 'athen_hook_bottom_header', 'athen_post_slider' );
            add_action( 'athen_hook_bottom_header', 'athen_search_icon' );
            add_action( 'athen_hook_bottom_header', 'athen_search_dropdown' );
			add_action( 'athen_hook_bottom_header', 'athen_search_header_replace' );
            
add_action( 'athen_hook_main_header_after', 'athen_post_slider' );

			/* Menu > Bottom
			-------------------------------------------------------------------------------*/
			add_action( 'athen_hook_main_menu_bottom', 'athen_search_dropdown' );
 
/* Main > Before
-------------------------------------------------------------------------------*/
add_action( 'athen_hook_main_before', 'athen_section_open');
        
	/* Main > Top
    -------------------------------------------------------------------------------*/
    add_action( 'athen_hook_main_top', 'athen_page_header' );
    add_action( 'athen_hook_main_top', 'athen_post_slider' );

		/* Page Header > Before
		-------------------------------------------------------------------------------*/
		add_action( 'athen_hook_page_header_bottom', 'athen_post_slider' );

			/* Page Header > Inner
			-------------------------------------------------------------------------------*/
			add_action( 'athen_hook_page_header_inner', 'athen_page_header_title' );
			add_action( 'athen_hook_page_header_inner', 'athen_page_header_subheading' );
			add_action( 'athen_hook_page_header_inner', 'athen_display_breadcrumbs' );
			add_action( 'athen_hook_page_header_inner', 'athen_search_header_replace' );

		/* Page Header > Bottom
		-------------------------------------------------------------------------------*/
		add_action( 'athen_hook_page_header_bottom', 'Athen_Page_Header::athen_page_header_overlay' );


	/* Primary > Before
	-------------------------------------------------------------------------------*/
	add_action( 'athen_hook_primary_before', 'athen_blog_single_media_above' );

		/* Content > Top
		-------------------------------------------------------------------------------*/
		add_action( 'athen_hook_content_top', 'athen_term_description' );

		/* Content > Bottom
		-------------------------------------------------------------------------------*/
		add_action( 'athen_hook_content_bottom', 'athen_post_edit' );


	/* Primary > After
	-------------------------------------------------------------------------------*/
	add_action( 'athen_hook_primary_after', 'athen_get_sidebar_template' );

		/* Sidebar > Inner
		-------------------------------------------------------------------------------*/
		add_action( 'athen_hook_sidebar_inner', 'athen_display_sidebar' );

/* Main > Bottom
-------------------------------------------------------------------------------*/
add_action( 'athen_hook_main_bottom', 'athen_next_prev' );

/* Wrap > Bottom
-------------------------------------------------------------------------------*/
add_action( 'athen_hook_wrap_bottom', 'athen_footer' );

/* Footer > Before
-------------------------------------------------------------------------------*/
add_action( 'athen_hook_footer_before', 'athen_footer_reveal_open' );

/* Footer > Inner
-------------------------------------------------------------------------------*/
add_action( 'athen_hook_footer_inner', 'athen_footer_widgets' );

/* Footer > After
-------------------------------------------------------------------------------*/
add_action( 'athen_hook_footer_after', 'athen_footer_bottom' );
add_action( 'athen_hook_footer_after', 'athen_footer_reveal_close' );

/* Wrap > After
-------------------------------------------------------------------------------*/
add_action( 'athen_hook_wrap_after', 'athen_toggle_bar' );

/* WP_Footer
-------------------------------------------------------------------------------*/
add_action( 'wp_footer', 'athen_mobile_menu_alt' );
add_filter( 'wp_footer', 'athen_mobile_searchform' );
add_action( 'wp_footer', 'athen_scroll_top' );
add_action( 'wp_footer', 'athen_search_overlay' );

/* REMOVE ACTIONS !!!
-------------------------------------------------------------------------------*/

// Helper function to remove all actions
function athen_remove_actions() {

	// Get global object
	$obj = athen_global_obj();

	// Return if there aren't any hooks
	if ( empty( $obj->hooks ) ) {
		return;
	}

	// Remove all actions
	foreach ( $obj->hooks as $hook ) {
        remove_all_actions( $hook, 10 );
    }

}

// Remove actions for landing page
function athen_landing_page_remove_actions() {
	if ( is_page_template( 'templates/landing-page.php' ) ) {
		athen_remove_actions();
	}
}
add_action( 'wp_head', 'athen_landing_page_remove_actions' );