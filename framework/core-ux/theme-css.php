<?php

class Athen_Css{
    
    public function __construct(){
        
        add_action( 'wp_enqueue_scripts', array( &$this, 'theme_css' ) );
        add_action( 'wp_enqueue_scripts', array( &$this, 'responsive_css' ), 99 );
        
    }
   
    public function theme_css() {

		// Front end only
		if ( is_admin() ) {
			return;
		}
		
		// Get global object
		global $athen_std_theme;

		// Font Awesome
		wp_deregister_style( 'font-awesome' );
		wp_deregister_style( 'fontawesome' );
		wp_enqueue_style( 'wpex-font-awesome', ATHEN_CSS_DIR_URI .'font-awesome.min.css', false, '4.3.0' );

		// Register hover-css
		wp_register_style( 'wpex-hover-animations', ATHEN_CSS_DIR_URI .'hover-css.min.css', false, '2.0.1' );

		// Main Style.css File
		//wp_enqueue_style( 'wpex-style', get_stylesheet_uri(), false, ATHEN_FRAMEWORK_VERSION );
		wp_enqueue_style( 'main-styles', get_template_directory_uri() .'/style.css', false );

		// Load RTL.css first
		if ( is_RTL() ) {
			wp_enqueue_style( 'wpex-rtl', ATHEN_CSS_DIR_URI .'rtl.css', array( 'wpex-style' ), false );
		}

		// Visual Composer CSS
		if ( ATHEN_CHECK_VC ) {
			wp_enqueue_style( 'wpex-visual-composer', ATHEN_CSS_DIR_URI .'wpex-visual-composer.css', array( 'js_composer_front' ), '2.0.1' );
			//wp_enqueue_style( 'wpex-visual-composer-extend', ATHEN_CSS_DIR_URI .'wpex-visual-composer-extend.css', '', '2.0.0' );
		}
	}
    
    public function responsive_css() {

		// Return if responsiveness is disabled
		if ( ! athen_is_responsive() ) {
			return;
		}

		// Load main theme responsive.css file
		// wp_enqueue_style( 'wpex-responsive', ATHEN_CSS_DIR_URI .'responsive.css' );

	}
    
}

new Athen_Css();

