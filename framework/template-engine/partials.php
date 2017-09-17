<?php
/**
 *
 * Description : These functions are used to load template parts (partials) when used within action hooks.
 * 
 * @package     Athen
 * @subpackage  Closer - Controller
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 * Dependent : customizer/customizer.php (Athen_Customizer class)
 */


/*-------------------------------------------------------------------------------*/
/* -  Toggle Bar
/*-------------------------------------------------------------------------------*/

/**
 * Get togglebar layout template part if enabled.
 *
 * @since Total 1.0.0
 */
function athen_toggle_bar() {

	// Get global object
	$obj = athen_global_obj();

	// Get togglebar content if enabled
	if ( $obj->has_togglebar ) {
		get_template_part( 'partials/togglebar/togglebar-layout' );
	}

}

/**
 * Get togglebar button template part.
 *
 * @since Total 1.0.0
 */
function athen_toggle_bar_button() {
	
	// Get global object
	$obj = athen_global_obj();

	// Get toggle bar button template bar
	if ( $obj->has_togglebar ) {
		get_template_part( 'partials/togglebar/togglebar-button' );
	}
}

/*-------------------------------------------------------------------------------*/
/* -  Header 
/*-------------------------------------------------------------------------------*/

/**
 * Get the header template part if enabled.
 *
 * @since   Total 1.5.3
 */
function athen_site_header_partial() {
	
	// Get global object
	$obj = athen_global_obj();

	// Get header template file if enabled
	if ( $obj->has_site_header ) {
		get_template_part( 'partials/site-header/wrap-main-header' );
	}

}

/**
 * Get the header logo template part.
 *
 * @since Total 1.0.0
 */
function athen_header_logo() {
	
	// Get global object and header style
	$obj          = athen_global_obj();
	$header_style = $obj->header_style;

	// Get current filter
	$filter = current_filter();

	// Set bool variable
	$get = false;
	
	if ( 'one' == $header_style && 'athen_hook_top_header' == $filter || 'athen_hook_main_header' == $filter ) {
		$get = true;
		}elseif ( 'two' == $header_style && 'athen_hook_header_inner' == $filter  )  {
			$get = true;
		}elseif ( in_array( $header_style, array( 'three', '' ) ) && 'athen_hook_header_top' == $filter ) {
			$get = true;
		}
		elseif ( 'four' == $header_style && 'athen_hook_header_bottom' == $filter ) {
			$get = true;
		}
	if($get){
		get_template_part( 'partials/site-header/header-logo' );
	}
}

/**
 * Get the header aside content template part.
 *
 * @since Total 1.5.3
 */
function athen_header_aside() {
	$obj = athen_global_obj();
	if ( in_array($obj->header_style, array( 'one' ))) {
		get_template_part( 'partials/site-header/header-aside' );
	}
}

/*-------------------------------------------------------------------------------*/
/* -  Top Header
/*-------------------------------------------------------------------------------*/

/**
 * 
 */
function athen_top_header_partial(){
    get_template_part('partials/site-header/top-header/wrap-top-header');
}

/**
 * Get header aside partials if enabled
 * 
 * @since Athen 1.0.0
 */
function athen_top_header_logo(){
    get_template_part('partials/site-header/top-header/top-header-logo');
}

/**
 * Get header aside partials if enabled
 * 
 * @since Athen 1.0.0
 */
function athen_top_header_aside(){
    get_template_part('partials/site-header/top-header/top-header-aside');
}

/**
 * Get header aside partials if enabled
 * 
 * @since Athen 1.0.0
 */
function athen_top_header_menu(){
    get_template_part('partials/site-header/top-header/top-header-menu');
}

/*-------------------------------------------------------------------------------*/
/* -  Bottom Header
/*-------------------------------------------------------------------------------*/

/**
 * 
 */
function athen_bottom_header_partial(){
    get_template_part('partials/site-header/bottom-header/wrap-bottom-header');
}

/**
 * Get header aside partials if enabled
 * 
 * @since Athen 1.0.0
 */
function athen_bottom_header_aside(){
    get_template_part('partials/site-header/bottom-header/bottom-header-aside');
}

/**
 * Get header aside partials if enabled
 * 
 * @since Athen 1.0.0
 */
function athen_bottom_header_menu(){
    get_template_part('partials/site-header/bottom-header/bottom-header-menu');
}

/*-------------------------------------------------------------------------------*/
/* -  Social Profiles
/*-------------------------------------------------------------------------------*/

/**
 * Reurn Header Social Profiles
 *
 *@since Athen 1.0.0
 */
function athen_header_social() {
	
	$obj = athen_global_obj();
        
    $placement = athen_get_mod('athen_social_header_placement', 'header_top');
    
    $current_hook = current_filter();
        
    if( $current_hook == "athen_hook_top_header" && $placement == "header_top"){
        get_template_part('partials/socials');
    }elseif( $current_hook == "athen_hook_main_header" && $placement == "header_main"){
        get_template_part('partials/socials');
    }elseif( $current_hook == "athen_hook_bottom_header" && $placement == "header_bottom"){
        get_template_part('partials/socials');
    }    
}

/*-------------------------------------------------------------------------------*/
/* -  Search 
/*-------------------------------------------------------------------------------*/

/**
 * Return Search Trigger
 * 
 * @since Athen 1.0.0
 */
function athen_search_icon() {
    
    $enable = false; 
    
    $placement = athen_get_mod('athen_search_icon_placement', 'header_top');
    
    if( 'header_top' == $placement && current_filter() == 'athen_hook_top_header'){
       $enable = true;
    } elseif( 'header_main' == $placement && current_filter() == 'athen_hook_main_header'){
       $enable = true;
    } elseif( 'header_bottom' == $placement && current_filter() == 'athen_hook_bottom_header'){
        $enable = true;
    }
    
    if( $enable ){
        get_template_part('partials/search/search-icon');
    }
}

/**
 * Get header search dropdown template part.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'athen_search_dropdown' ) ) {
	function athen_search_dropdown() {

		$enable = false; 
    
        $placement = athen_get_mod('athen_search_dropdown_placement', 'header_top');

        if( 'header_top' == $placement && current_filter() == 'athen_hook_top_header'){
           $enable = true;
        } elseif( 'header_main' == $placement && current_filter() == 'athen_hook_main_header'){
           $enable = true;
        } elseif( 'header_bottom' == $placement && current_filter() == 'athen_hook_bottom_header'){
            $enable = true;
        }

        if( $enable ){
            get_template_part('partials/search/header-search-dropdown');
        }
	}
}

/**
 * Get header search replace template part.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'athen_search_header_replace' ) ) {
	function athen_search_header_replace() {

		$enable = false; 
    
        $placement = athen_get_mod('athen_search_section_placement', 'header_top');

        if( 'header_top' == $placement && current_filter() == 'athen_hook_top_header'){
           $enable = true;
        } elseif( 'header_main' == $placement && current_filter() == 'athen_hook_main_header'){
           $enable = true;
        } elseif( 'header_bottom' == $placement && current_filter() == 'athen_hook_bottom_header'){
            $enable = true;
        }
        
		if ( $enable ) {
			get_template_part( 'partials/search/header-search-replace' );
		}

	}
}

/**
 * Gets header search overlay template part.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'athen_search_overlay' ) ) {

	function athen_search_overlay() {

		// Get global object
		$obj = athen_global_obj();

		// Get template part
		if ( 'overlay' == $obj->header_search_style ) {
			get_template_part( 'partials/search/header-search-overlay' );
		}
	}
}

/*-------------------------------------------------------------------------------*/
/* -  Menu
/*-------------------------------------------------------------------------------*/

/**
 * Outputs the main header menu
 *
 * @since Total 1.0.0
 */
function athen_header_menu() {

		get_template_part( 'partials/site-header/header-menu' );

}

/**
 * Gets the template part for the "icons" style mobile menu.
 *
 * @since Total 1.0.0
 * Deprecated
 */
function athen_mobile_menu_icons() {
    
    if ( athen_is_responsive() && athen_has_mobile_menu() ) {
	//	get_template_part( 'partials/site-header/_header-menu-mobile-icons' );
    }
}

/**
 * Get mobile menu alternative if enabled.
 *
 * @since Total 1.3.0
 */
function athen_mobile_menu_alt() {

	// Get global object
	$obj = athen_global_obj();

	// Validate and get template part
	if ( $obj->responsive && has_nav_menu( 'mobile_menu_alt' ) && athen_has_mobile_menu() ) {
		get_template_part( 'partials/site-header/header-menu-mobile-alt' );
	}
	
}


/*-------------------------------------------------------------------------------*/
/* -  Page Header
/*-------------------------------------------------------------------------------*/

/**
 * Get page header template part if enabled.
 *
 * @since Total 1.5.2
 */
function athen_page_header() {
	$obj = athen_global_obj();
        $header_style = $obj->header_style;
	if ( $obj->has_page_header && $header_style !== "three" ) {
		get_template_part( 'partials/pageheader/page-header' );
	}
}

/**
 * Get page header title template part if enabled.
 *
 * @since Total 1.0.0
 */
function athen_page_header_title() {
	$obj = athen_global_obj();
	if ( $obj->has_page_header_title ) {
		get_template_part( 'partials/pageheader/page-header-title' );
	}
}

/**
 * Get post heading template part.
 *
 * @since Total 1.0.0
 */
function athen_page_header_subheading() {
	$obj = athen_global_obj();
	if ( $obj->has_page_header_subheading ) {
		get_template_part( 'partials/pageheader/page-header-subheading' );
	}

}


/*-------------------------------------------------------------------------------*/
/* -  Content
/*-------------------------------------------------------------------------------*/

/**
 * Gets sidebar template
 *
 * @since Total 2.1.0
 */
function athen_get_sidebar_template() {
	
	// Not needed for full-width or full-screen pages
	if ( in_array( Athen_Post_Layout::athen_get_post_layout(), array( 'full-screen', 'full-width' ) ) ) {
		return;
	}

	// Apply filters for child theme editing
	$sidebar = apply_filters( 'athen_get_sidebar_template', null );

	// Get sidebar template file
	get_sidebar( $sidebar );

}

/**
 * Displays correct sidebar
 *
 * @since Total 1.6.5
 */
function athen_display_sidebar() {
	$sidebar = athen_get_sidebar();
	if ( $sidebar ) {
		dynamic_sidebar( $sidebar );
	}
}

/**
 * Get term description.
 *
 * @since Total 1.0.0
 */
function athen_term_description() {
	if ( athen_has_term_description_above_loop() ) {
		get_template_part( 'partials/term-description' );
	}
}

/**
 * Get next/previous links.
 *
 * @since Total 1.0.0
 */
function athen_next_prev() {
	if ( athen_has_next_prev() ) {
		get_template_part( 'partials/next-prev' );
	}
}

/**
 * Get next/previous links.
 *
 * @since Total 1.0.0
 */
function athen_post_edit() {
	if ( athen_has_post_edit() ) {
		get_template_part( 'partials/post-edit' );
	}
}

/*-------------------------------------------------------------------------------*/
/* -  Blog
/*-------------------------------------------------------------------------------*/

/**
 * Page Section 
 * 
 * @since Athen 1.0.0
 */
function athen_section_open(){
    get_template_part('partials/section-open');
}



/**
 * Blog single media above content
 *
 * @since Total 1.0.0
 */
function athen_blog_single_media_above() {

	// Only needed for blog posts
	if ( ! is_singular( 'post' ) ) {
		return;
	}

	// Media position
	$blog_single_media_position = get_post_meta( get_the_ID(), 'athen_post_media_position', true );
	$blog_single_media_position = apply_filters( 'athen_blog_single_media_position', $blog_single_media_position );

	// Display the post media above the post (this is a meta option)
	if ( 'above' == $blog_single_media_position && ! post_password_required() ) {

		// Get post format.
		$post_format = get_post_format() ? get_post_format() : 'thumbnail';
        
		// Get correct media template part
		get_template_part( 'partials/blog/media/blog-single', $post_format );

	}

}


/*-------------------------------------------------------------------------------*/
/* -  Footer
/*-------------------------------------------------------------------------------*/

/**
 * Gets the footer layout template part.
 *
 * @since 2.0.0
 */
function athen_footer() {
	$obj = athen_global_obj();
        $header_style = $obj->header_style;
	if ( $obj->has_footer && $header_style !== "three" ) {
		get_template_part( 'partials/footer/footer-layout' );
	}
}

/**
 * Get the footer widgets template part.
 *
 * @since Total 1.0.0
 */
function athen_footer_widgets() {
	get_template_part( 'partials/footer/footer-widgets' );
}

/**
 * Gets the footer bottom template part.
 *
 * @since Total 1.0.0
 */
function athen_footer_bottom() {
	if ( athen_get_mod( 'footer_bottom', true ) ) {
		get_template_part( 'partials/footer/footer-bottom' );
	}
}

/**
 * Gets the scroll to top button template part.
 *
 * @since Total 1.0.0
 */
if ( ! function_exists( 'athen_scroll_top' ) ) {
	function athen_scroll_top() {
		if ( athen_get_mod( 'scroll_top', true ) ) {
			get_template_part( 'partials/scroll-top' );
		}
	}
}

/**
 * Footer reaveal open code
 *
 * @since 2.0.0
 */
function athen_footer_reveal_open() {
	$obj = athen_global_obj();
	if ( $obj->has_footer_reveal ) {
		get_template_part( 'partials/footer-reveal-open' );
	} 
}

/**
 * Footer reaveal close code
 *
 * @since 2.0.0
 */
function athen_footer_reveal_close() {
	$obj = athen_global_obj();
	if ( $obj->has_footer_reveal ) {
		get_template_part( 'partials/footer-reveal-close' );
	}
}


/*-------------------------------------------------------------------------------*/
/* -  Other
/*-------------------------------------------------------------------------------*/

/**
 * Returns social sharing template part
 *
 * @since 2.0.0
 */
function athen_social_share() {
	get_template_part( 'partials/social-share' );
}