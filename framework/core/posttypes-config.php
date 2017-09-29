<?php

class Athen_Post_Types {
    
    public function __construct(){
        
        add_action( 'after_setup_theme', array( &$this, 'post_types' ), 3 );
        
    }
    
    public function post_types() {
        
        $post_types = array( 'portfolio-config'=> true,
                             'staff-config'=> false,
                             'testimonials-config' => false
                      );
        
        foreach($post_types as $posttype => $check){
            if ( $check ){
                require_once(ATHEN_FRAMEWORK_DIR . 'post-types/' . $posttype .'.php');
            }
        }
    }
}

new Athen_Post_Types();
