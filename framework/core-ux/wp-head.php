<?php

class Athen_Wp_Head extends Athen_Framework_Init{
    
    public function __construct(){
	
		// Add meta viewport tag to header
		add_action( 'wp_head', array( &$this, 'meta_viewport' ), 1 );

		// Add meta viewport tag to header
		add_action( 'wp_head', array( &$this, 'meta_edge' ), 0 );

		// Loads CSS for ie8
		add_action( 'wp_head', array( &$this, 'ie8_css' ) );

		// Loads html5 shiv script
		add_action( 'wp_head', array( &$this, 'html5_shiv' ) );

		// Adds tracking code to the site head
		add_action( 'wp_head', array( &$this, 'tracking' ) );

		// Outputs custom CSS to the head
		add_action( 'wp_head', array( &$this, 'custom_css' ), 9999 );
	       
    } 
    
    //
    public function meta_viewport() {

		// Get global object
		global $athen_std_theme;

		// Responsive viewport viewport
		if ( ! empty( $athen_std_theme->responsive ) ) {
			$viewport = '<meta name="viewport" content="width=device-width, initial-scale=1">';
		}

		// Non responsive meta viewport
		else {
			$width      = intval( $this->athen_get_mod( 'main_container_width', '980' ) );
			$width      = $width ? $width: '980';
			$viewport   = '<meta name="viewport" content="width='. $width .'" />';
		}
		
		// Apply filters to the meta viewport for child theme tweaking
		echo apply_filters( 'athen_meta_viewport', $viewport );

	}
    
    //
    public static function meta_edge() {
	   echo '<meta http-equiv="X-UA-Compatible" content="IE=edge" />';
	}
    
    //
    public function ie8_css() {
		$ie_8_url   = ATHEN_CSS_DIR_URI .'ie8.css';
		$ie_8_url   = apply_filters( 'athen_ie_8_url', $ie_8_url );
		echo '<!--[if IE 8]><link rel="stylesheet" type="text/css" href="'. $ie_8_url .'" media="screen"><![endif]-->';
	}
    
    //
    public function html5_shiv() {
		echo '<!--[if lt IE 9]>
			<script src="'. ATHEN_JS_DIR_URI .'html5.js"></script>
		<![endif]-->';
	}
    
    //
    public function tracking() {

		// Return if user is logged in
		if ( is_user_logged_in() ) {
			return;
		}

		// Display tracking code
		if ( $tracking = $this->athen_get_mod( 'tracking' ) ) {
			echo $tracking;
		}

	}
    
    //
    public function custom_css( $output = NULL ) {

		// Add filter for adding custom css via other functions
		$output = apply_filters( 'athen_head_css', $output );

		// Minify and output CSS in the wp_head
		if ( ! empty( $output ) ) {
			$output = athen_minify_css( $output );
			$output = "<!-- TOTAL CSS -->\n<style type=\"text/css\">\n" . $output . "\n</style>";
			echo $output;
		}

	}
}

new Athen_Wp_Head();

