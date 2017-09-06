<?php

class Athen_Admin_Scripts{
   
    public function __construct(){
    
        // Load scripts in the WP admin
        add_action( 'admin_enqueue_scripts', array( &$this,'admin_scripts' ) );
    
    }
    
    public function admin_scripts() {
        wp_enqueue_style( 'wpex-font-awesome', ATHEN_CSS_DIR_URI .'font-awesome.min.css' );
    }

}

new Athen_Admin_Scripts();