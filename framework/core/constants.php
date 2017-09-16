<?php

class Athen_Constants extends Athen_Framework_Init {
    
    public function __construct(){
        
        define( 'ATHEN_FRAMEWORK_VERSION', '1.0.0' );

		// Define branding constant based on theme options
		define( 'ATHEN_NAME_THEME', $this->athen_get_mod( 'theme_branding', 'Athen' ) );

		// Theme Panel slug
		define( 'ATHEN_THEME_PANEL_SLUG', 'theme-panel' );
		define( 'ATHEN_ADMIN_PANEL_LOAD_PAGE', 'theme-panel-addons_page_'. ATHEN_THEME_PANEL_SLUG );

		// Paths to the parent theme directory
		define( 'ATHEN_TEMPLATE_DIR', get_template_directory() );
		define( 'ATHEN_TEMPLATE_DIR_URI', get_template_directory_uri() );

		// Javascript and CSS Paths
		define( 'ATHEN_JS_DIR_URI', ATHEN_TEMPLATE_DIR_URI .'/js/' );
		define( 'ATHEN_CSS_DIR_URI', ATHEN_TEMPLATE_DIR_URI .'/css/' );

		// Skins Paths
		define( 'ATHEN_SKIN_DIR', ATHEN_TEMPLATE_DIR .'/skins/' );
		define( 'ATHEN_SKIN_DIR_URI', ATHEN_TEMPLATE_DIR_URI .'/skins/' );

		// Framework Paths
		define( 'ATHEN_FRAMEWORK_DIR', ATHEN_TEMPLATE_DIR .'/framework/' );
		define( 'ATHEN_FRAMEWORK_DIR_URI', ATHEN_TEMPLATE_DIR_URI .'/framework/' );
		define( 'ATHEN_CLASSES_DIR', ATHEN_FRAMEWORK_DIR .'/classes/' );

		// Classes directory
		define( 'WPEX_ClASSES_DIR', ATHEN_FRAMEWORK_DIR .'/classes/' );

		// Check if plugins are active
		define( 'ATHEN_CHECK_VC', class_exists( 'Vc_Manager' ) );
		//define( 'ATHEN_CHECK_BBPRESS', class_exists( 'bbPress' ) );
		define( 'ATHEN_CHECK_WOOCOMMERCE', class_exists( 'WooCommerce' ) );
		define( 'ATHEN_CHECK_REVOLUTION_SLIDER', class_exists( 'RevSlider' ) );
		define( 'ATHEN_CHECK_LAYERSLIDER', function_exists( 'lsSliders' ) );
		define( 'ATHEN_CHECK_WPML', class_exists( 'SitePress' ) );
		define( 'ATHEN_CHECK_TEC', class_exists( 'TribeEvents' ) );

		// Active post types
		define( 'ATHEN_CHECK_PORTFOLIO', $this->athen_get_mod( 'portfolio_enable', true ) );
		define( 'ATHEN_CHECK_STAFF', $this->athen_get_mod( 'staff_enable', true ) );
		define( 'ATHEN_CHECK_TESTIMONIALS', $this->athen_get_mod( 'testimonials_enable', true ) );

		// Visual Composer
		define( 'ATHEN_VCEX_DIR', ATHEN_FRAMEWORK_DIR .'third-party/visual-composer/extend/' );
		define( 'ATHEN_VCEX_DIR_URI', ATHEN_FRAMEWORK_DIR_URI .'third-party/visual-composer/extend/' );
        
    }
}

new Athen_Constants();
