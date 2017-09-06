<?php

class Athen_Template_Engine{
    
    public function __construct(){
        
        add_action( 'init', array( &$this, 'template_engine' ), 1 );
        
    }
    
    public function template_engine() {

		// Front-end functions only
		if ( is_admin() ) {
			return;
		}
        
        $view_engine = array('hooks', 'actions', 'partials');
        
        foreach($view_engine as $files){
            require_once(ATHEN_FRAMEWORK_DIR .'template-engine/' . $files .'.php');
        }
	}
}

new Athen_Template_Engine();