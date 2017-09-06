<?php

class Athen_Post_Addons extends Athen_Framework_Init{
    
    public function __construct(){
        
        add_action( 'after_setup_theme', array( &$this, 'post_addons' ), 5 );
        
    }
    
    public function post_addons(){
        
        //Post Series
		if ( $this->athen_get_mod( 'post_series_enable', true ) ) {
			require_once( ATHEN_FRAMEWORK_DIR .'post-types/post-series/post-series-config.php' );
		}
        
       // Add some basic shortcodes
		require_once( ATHEN_FRAMEWORK_DIR .'post-types/shortcodes/shortcodes.php' );
        
        // Adds new media fields to the WP media library items
		require_once( ATHEN_FRAMEWORK_DIR .'post-types/thumbnails/media-fields.php' );

		// TinyMCE editor tweaks and addons
		require_once( ATHEN_FRAMEWORK_DIR .'post-types/tinymce.php' );
        
        // Dashboard thumbnails
		if ( $this->athen_get_mod( 'blog_dash_thumbs', true ) ) {
			require_once( ATHEN_FRAMEWORK_DIR .'post-types/thumbnails/dashboard-thumbnails.php' );
		}
        
        // Add post metabox to posts
        if( is_admin() ){
            require_once( ATHEN_FRAMEWORK_DIR .'post-types/post-metaboxes/post-metaboxes.php');
        }
        
        // Adds a gallery metabox to posts
		require_once( ATHEN_FRAMEWORK_DIR .'post-types/gallery-metabox/gallery-metabox.php' );
    }
}

new Athen_Post_Addons();
