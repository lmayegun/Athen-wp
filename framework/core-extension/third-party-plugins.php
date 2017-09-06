<?php

class Athen_Third_Party extends Athen_Framework_Init{
    
    public function __construct(){
        
        add_action( 'after_setup_theme', array( &$this, 'third_party_plugins' ), 5 );
        
    }
    
    public function third_party_plugins(){
        
		$plugins = array('woocommerce/woocommerce-config' => ATHEN_CHECK_WOOCOMMERCE,
                         'visual-composer/visual-composer-config' => ATHEN_CHECK_VC,
                         'revslider' => ATHEN_CHECK_REVOLUTION_SLIDER,
                         'wpml' => ATHEN_CHECK_WPML
                        );
        
        foreach( $plugins as $config => $check){
            if($check){
                require_once(ATHEN_FRAMEWORK_DIR.'third-party/'.$config.'.php');
            }
        }

		// Polylang Config
		if ( class_exists( 'Polylang' ) ) {
			require_once( ATHEN_FRAMEWORK_DIR .'third-party/polylang.php' );
		}
        
        // Recommends plugins for use with the theme
		if ( $this->athen_get_mod( 'recommend_plugins_enable', true ) ) {
			require_once( ATHEN_FRAMEWORK_DIR .'classes/class-tgm-plugin-activation.php' );
			require_once( ATHEN_FRAMEWORK_DIR .'third-party/tgm-plugin-activation.php' );
		}
	}
}

new Athen_Third_Party();