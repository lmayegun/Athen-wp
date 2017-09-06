<?php

class Athen_Helper_Functions extends Athen_Framework_Init{
    
    public function __construct() {
        
        add_action( 'after_setup_theme', array( &$this, 'get_helpers' ), 5);
        
    }
    
    public function get_helpers(){
        
         require_once( ATHEN_FRAMEWORK_DIR .'classes/sanitize-data.php');
         
         // Automatic updates
		if ( $this->athen_get_mod( 'envato_license_key' ) ) {
			require_once(  ATHEN_FRAMEWORK_DIR .'classes/wp-updates-theme.php');
		}

		// Migrate old redux options to new Customizer
		//if ( ! get_option( 'athen_customizer_migration_complete' ) ) {
			//require_once( ATHEN_FRAMEWORK_DIR .'classes/migrate.php' );
		//}

		// Taxonomy thumbnails
		if ( $this->athen_get_mod( 'term_thumbnails_enable', true ) ) {
			require_once( ATHEN_FRAMEWORK_DIR .'classes/tax-thumbnails.php' );
		}

		// iLightbox
		require_once( ATHEN_FRAMEWORK_DIR .'classes/ilightbox.php' );

		// Remove post type slugs if enabled
		if ( $this->athen_get_mod( 'remove_posttype_slugs' ) ) {
			//require_once( WPEX_ClASSES_DIR .'remove-post-type-slugs.php' );
		}



		/*** Admin end only ***/
		if ( is_admin() ) {

			// Editor Formats
			if ( $this->athen_get_mod( 'editor_formats_enable', true ) ) {
				require_once( ATHEN_FRAMEWORK_DIR .'classes/editor-formats.php' );
			}

		}
         
    }
}

new Athen_Helper_Functions();
