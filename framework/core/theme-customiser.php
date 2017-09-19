<?php

class Athen_Theme_Customiser extends Athen_Framework_Init{
    
    public function __construct(){
        
        add_action( 'init', array( &$this, 'theme_customizer' ), 2 );
        
    }
    
    public function theme_customizer() {
		
		// Customizer
		require_once( ATHEN_FRAMEWORK_DIR .'customiser-wp/customizer.php' );
        
         // Main Theme Panel
		require_once( ATHEN_FRAMEWORK_DIR .'customiser-addons/tweaks.php' );
        
        $theme_customiser_subpages = array( 'under_construction_enable' => 'under-construction',
                                            'favicons_enable' => 'favicons',
                                            'custom_404_enable' => 'custom-404',
                                            'widget_areas_enable' => 'widget-areas',
                                            'custom_admin_login_enable' => 'custom-login',
                                            'footer_builder_enable' => 'footer-builder',
                                            'custom_wp_gallery_enable' => 'custom-wp-gallery',
                                            'custom_css_enable' => 'custom-css'
                                          ); 

		foreach($theme_customiser_subpages as $check => $subpage){
            if ( $this->athen_get_mod( $check , true ) ){
                require_once(ATHEN_FRAMEWORK_DIR . 'customiser-addons/' . $subpage .'.php');
            }
        }

		// Import Export Functions
		if ( is_admin() ) {
			require_once( ATHEN_FRAMEWORK_DIR .'customiser-addons/import-export.php' );
		}
	}    
}

new Athen_Theme_Customiser();