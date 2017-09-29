<?php

class Athen_Template_Objects extends Athen_Framework_Init{
    
    public function __construct(){
        
        add_action( 'template_redirect', array( &$this, 'global_object' ), 20 );
        
    }
    
    public function global_object() {
        
        if ( !is_admin() | is_admin() ) {

            $template_objects = array('header-functions','footer-functions',
                                  'menu-functions','page-header','pagination',
                                  'post-slider','social-share','search-functions',
                                  'togglebar','header-top','post-layout','title',
                                  'excerpts'
                                );

            foreach ( $template_objects as $files){
                require_once( ATHEN_FRAMEWORK_DIR .'/template-objects/'. $files .'.php' );
            }
        }
        
        if (!is_admin()){
    
            $view_partials = array('category-meta','comments-callback');

            foreach ( $view_partials as $files ){
                require_once( ATHEN_FRAMEWORK_DIR . '/template-partials/'.$files.'.php');
            }
        }
        
		// Get global object
		global $athen_std_theme;
		$headerObj      = new Athen_Header();
		$footerObj      = new Athen_Footer();
		$menuObj        = new Athen_Menu();
		$postLayoutObj  = new Athen_Post_Layout();
		$pageHeaderObj  = new Athen_Page_Header();
		$postSliderObj  = new Athen_Post_Slider();
		$socialShareObj = new Athen_Social_Share();
		$searchFuncObj  = new Athen_Search_Func();
		$toggleBarObj   = new Athen_Toggle_Bar();
		$topBarObj      = new Athen_Header_Top();
        
        // check if window view is an admin, if not carry out operations. 
        // *** Front End Only *** //

		// Array of all theme hooks
		$athen_std_theme->hooks                      = athen_theme_hooks();

		// Main
		$athen_std_theme->skin                       = function_exists( 'athen_active_skin' ) ? athen_active_skin() : 'base';
		$athen_std_theme->post_id                    = athen_get_the_id();
		$athen_std_theme->main_layout                = athen_main_layout( $athen_std_theme->post_id );
		$athen_std_theme->responsive                 = $this->athen_get_mod( 'responsive', true );
		$athen_std_theme->post_layout                = $postLayoutObj->athen_post_layout( $athen_std_theme->post_id );
		$athen_std_theme->has_site_header            = $headerObj->athen_has_header( $athen_std_theme->post_id );
		$athen_std_theme->has_overlay_header         = $athen_std_theme->has_site_header ? $headerObj->athen_has_header_overlay( $athen_std_theme->post_id ) : false;
		$athen_std_theme->header_overlay_style       = get_post_meta( $athen_std_theme->post_id, 'athen_overlay_header_style', true );
		$athen_std_theme->header_style               = $headerObj->athen_get_header_style( $athen_std_theme->post_id );
		$athen_std_theme->header_logo                = $headerObj->athen_header_logo_img();
		$athen_std_theme->page_header_style          = $pageHeaderObj->athen_page_header_style( $athen_std_theme->post_id );
		$athen_std_theme->lightbox_skin              = athen_ilightbox_skin();
		$athen_std_theme->mobile_menu_style          = $menuObj->athen_mobile_menu_style();
		$athen_std_theme->mega_menu_width            = $menuObj->athen_mega_menu_width();
		$athen_std_theme->mega_menu_margin			 = $menuObj->athen_mega_menu_margin();
		$athen_std_theme->header_search_style        = $searchFuncObj->athen_header_search_style();
		$athen_std_theme->sidr_menu_source           = $menuObj->athen_mobile_menu_source();
		$athen_std_theme->post_slider_position       = $postSliderObj->athen_post_slider_position( $athen_std_theme->post_id );
		$athen_std_theme->fixed_header_custom_logo   = $headerObj->athen_fixed_header_logo( $athen_std_theme->post_id );
		$athen_std_theme->shrink_fixed_header        = $this->athen_get_mod( 'shink_fixed_header' );
		$athen_std_theme->has_composer               = athen_has_composer( $athen_std_theme->post_id );
		$athen_std_theme->has_top_bar                = $topBarObj->athen_has_top_bar( $athen_std_theme->post_id );
		$athen_std_theme->sticky_topheader           = $topBarObj->athen_enable_sticky_topheader();
		$athen_std_theme->toggle_bar_content_id      = $toggleBarObj->athen_toggle_bar_content_id();
		$athen_std_theme->has_togglebar              = $toggleBarObj->athen_has_togglebar( $athen_std_theme->post_id );
		$athen_std_theme->has_page_header            = $pageHeaderObj->athen_has_page_header( $athen_std_theme->post_id );
		$athen_std_theme->has_page_header_title      = $pageHeaderObj->athen_has_page_header_title( $athen_std_theme->post_id );
		$athen_std_theme->has_page_header_subheading = $pageHeaderObj->athen_has_page_header_subheading( $athen_std_theme->post_id );
		$athen_std_theme->has_post_slider            = $postSliderObj->athen_has_post_slider( $athen_std_theme->post_id );
		$athen_std_theme->has_breadcrumbs            = athen_has_breadcrumbs( $athen_std_theme->post_id );
		$athen_std_theme->has_fixed_header           = $headerObj->athen_has_fixed_header();
		$athen_std_theme->has_footer                 = $footerObj->athen_has_footer( $athen_std_theme->post_id );
		$athen_std_theme->has_footer_widgets         = $footerObj->athen_has_footer_widgets( $athen_std_theme->post_id );
		$athen_std_theme->has_footer_reveal          = $footerObj->athen_has_footer_reveal( $athen_std_theme->post_id );
		$athen_std_theme->has_social_share           = $socialShareObj->athen_has_social_share( $athen_std_theme->post_id );

		// Store term data
		if ( is_tax() ) {
			$athen_std_theme->term_data = get_option( 'athen_term_data' );
		}
        //print_r($athen_std_theme);
        
		// No longer in use but keep to prevent errors if people used them in template parts
		$athen_std_theme->is_mobile = false; 
	}  
}

new Athen_Template_Objects();

