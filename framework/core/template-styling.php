<?php

class Athen_Template_Styling extends Athen_Framework_Init{
    
    public function __construct(){
        
        add_action( 'after_setup_theme', array( &$this, 'get_styling_files'), 5 );
        
    }
    
    public function get_styling_files(){
        
        //Body class
        require_once( ATHEN_FRAMEWORK_DIR .'classes/body-classes.php');

        // Custom Header
		require_once( ATHEN_FRAMEWORK_DIR .'classes/custom-header.php');

		// Page animations
		require_once( ATHEN_FRAMEWORK_DIR .'classes/page-animations.php' );
        
		// Image resizer class
		require_once( ATHEN_FRAMEWORK_DIR .'classes/image-resize.php' );

        // Add image Sizes
		if ( $this->athen_get_mod( 'image_sizes_enable', true ) ) {
			require_once( ATHEN_FRAMEWORK_DIR .'classes/image-sizes.php');
		}
        
        if( !is_admin() ) {

			//Accent Colors
			require_once( ATHEN_FRAMEWORK_DIR .'classes/accent-color.php' );

			// Custom site layouts
			require_once( ATHEN_FRAMEWORK_DIR .'classes/site-layouts.php' );

			// Custom backgrounds
			require_once( ATHEN_FRAMEWORK_DIR .'classes/site-backgrounds.php' );

			// Advanced styling output for customizer settings
			require_once( ATHEN_FRAMEWORK_DIR .'classes/advanced-styling.php' );

			// Site breadcrumbs
			require_once( ATHEN_FRAMEWORK_DIR .'classes/breadcrumbs.php' );

		}
        
    }   
}

new Athen_Template_Styling();

