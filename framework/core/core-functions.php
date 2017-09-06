<?php

class Athen_Core_Routines{
    
    public function __construct(){
        
        add_action( 'after_setup_theme', array( &$this, 'include_functions' ), 2 );
        
    }
    
    public function include_functions(){
        // Display warnings for deprecated functions
		require_once( ATHEN_FRAMEWORK_DIR .'theme-modules/deprecated.php' );

		// Core functions used throughout the theme
		require_once( ATHEN_FRAMEWORK_DIR .'theme-modules/core.php' );
        
        // Blog function
        require_once( ATHEN_FRAMEWORK_DIR .'theme-modules/blog-functions.php');
				
		// Conditional functions
		require_once( ATHEN_FRAMEWORK_DIR .'theme-modules/conditionals.php' );

		// Useful arrays
		require_once( ATHEN_FRAMEWORK_DIR .'theme-modules/arrays.php' );
        
        // General Fonts
        require_once( ATHEN_FRAMEWORK_DIR .'theme-modules/fonts.php' );
        
        // Overlays
        require_once( ATHEN_FRAMEWORK_DIR .'theme-modules/overlays.php');
    } 
}

new Athen_Core_Routines();

