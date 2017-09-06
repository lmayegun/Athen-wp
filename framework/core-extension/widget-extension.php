<?php

class Athen_Widget_Extension extends Athen_Framework_Init{
    
    public function __construct(){
        
        add_action( 'after_setup_theme', array( &$this, 'custom_widgets' ), 5 );
        add_action( 'widgets_init', array( &$this, 'register_widgets_area' ) ); 
    }
    
    public function register_widgets_area() {

		require_once( ATHEN_FRAMEWORK_DIR .'widgets/widgets-area.php' );

	}
    
    public function custom_widgets() {

		// Define array of custom widgets for the theme
		$widgets = array(
			'social-fontawesome','social','simple-menu','modern-menu',
			'flickr','video','posts-thumbnails','posts-grid',
			'posts-icons','comments-avatar',
		);
		// Apply filters so you can remove custom widgets via a child theme if wanted
		$widgets = apply_filters( 'athen_custom_widgets', $widgets );

		// Loop through widgets and load their files
		foreach ( $widgets as $widget ) {
			$widget_file = ATHEN_FRAMEWORK_DIR .'widgets/custom-widgets/'. $widget .'.php';
			if ( file_exists( $widget_file ) ) {
				require_once( $widget_file );
			}
		}
	}
}

new Athen_Widget_Extension();

