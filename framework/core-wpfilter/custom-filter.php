<?php

class Athen_Custom_Filter{
    
    public function __construct(){
        
        // Add gallery metabox to portfolio
		add_filter( 'athen_gallery_metabox_post_types', array( &$this, 'add_gallery_metabox' ), 10 );

		// Define the directory URI for the gallery metabox class
		add_filter( 'athen_gallery_metabox_dir_uri', array( &$this, 'gallery_metabox_dir_uri' ) );
        
    }
    
	public function add_gallery_metabox( $types ) {
		$types[] = 'page';
		return $types;
	}

	public function gallery_metabox_dir_uri( $url ) {
		$url = ATHEN_FRAMEWORK_DIR_URI .'classes/gallery-metabox/';
		return $url;
	}
}

new Athen_Custom_Filter();

