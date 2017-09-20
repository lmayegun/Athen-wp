<?php

class Athen_Framework_Init {
	
	public function __construct() {
        
		global $athen_std_theme, $athen_theme_mods;
		$athen_std_theme = new stdClass;
		$athen_theme_mods = get_theme_mods();

        /**********************************************************************
         ************************* ATHEN CORE *********************************
         **********************************************************************/   
        // after_setup_theme
        require_once ( get_template_directory().'/framework/core/constants.php' );
        require_once ( ATHEN_FRAMEWORK_DIR .'core/core-functions.php' );
        require_once ( ATHEN_FRAMEWORK_DIR .'core/posttypes-config.php' );
        require_once ( ATHEN_FRAMEWORK_DIR .'core/theme-supports.php' );
        require_once ( ATHEN_FRAMEWORK_DIR .'core/template-styling.php');
        
        // init
        require_once ( ATHEN_FRAMEWORK_DIR .'core/template-engine.php' );
        require_once ( ATHEN_FRAMEWORK_DIR .'core/theme-customiser.php');
        // template_redirect
        require_once ( ATHEN_FRAMEWORK_DIR .'core/template-objects.php');
		
     
		/**********************************************************************
         ****************** EXTEND CORE WITH BUILTIN PLUGINS ******************
         **********************************************************************/
		// after_setup_theme
        require_once ( ATHEN_FRAMEWORK_DIR .'core-extension/widget-extension.php');
        require_once ( ATHEN_FRAMEWORK_DIR .'core-extension/post-addons.php');
        
        // Helpers functions
        require_once( ATHEN_FRAMEWORK_DIR .'core-extension/helper-functions.php');
        
        		        
        /**********************************************************************
         ***************** EXTEND CORE WITH 3RD PARTY PLUGINS
         **********************************************************************/
        // after_setup_theme
		require_once ( ATHEN_FRAMEWORK_DIR .'core-extension/third-party-plugins.php');
		
                
        
        /**********************************************************************
         ************************* VIEW COMPONENTS FILES
         **********************************************************************/
        //wp_enqueue_scripts
        require_once ( ATHEN_FRAMEWORK_DIR .'core-ux/theme-css.php');
        require_once ( ATHEN_FRAMEWORK_DIR .'core-ux/theme-js.php');
        
        // admin_enqueue_scripts
		 require_once ( ATHEN_FRAMEWORK_DIR .'core-ux/theme-admin-scripts.php');
		
		//wp_head
        require_once ( ATHEN_FRAMEWORK_DIR . 'core-ux/wp-head.php');
    
				
        /**********************************************************************
         ************************* WP Filters *********************************
         **********************************************************************/
        require_once ( ATHEN_FRAMEWORK_DIR . 'core-wpfilter/wp-filter.php');
        
        
        /**********************************************************************
         ************************* Athen Filters
         **********************************************************************/
        require_once ( ATHEN_FRAMEWORK_DIR . 'core-wpfilter/custom-filter.php');
		
        add_action( 'template_redirect', array( &$this,  'dump_theme_mods'), 50);
        
	}

	/**
	 * Helper function for loading theme mods before core.php is loaded.
	 * Returns theme_mods within this class
	 *
	 * @since   2.0.2
	 * @access  public
	 */
	public function athen_get_mod( $id, $default = '' ) {

		// Get global object
		global $athen_theme_mods;

		// Return data from global object
		if ( ! empty( $athen_theme_mods ) ) {

			// Return value
			if ( isset( $athen_theme_mods[$id] ) ) {
				return $athen_theme_mods[$id];
			}

			// Return default
			else {
				return $default;
			}
		}

		// Global object not found return using get_theme_mod
		else {
			return get_theme_mod( $id, $default );
		}
	}

	public function dump_theme_mods(){
		global $athen_std_theme;
		//print_r($athen_std_theme);
		//var_dump(get_post_type_labels(get_post_type_object('staff')));
		//register_taxonomy_for_object_type( 'category', 'staff' );
	}
}

/**
 * Run the theme setup class
 *
 * @since 1.6.3
 */
$athen_init = new Athen_Framework_Init;




//add_filter( 'the_excerpt', 'custom_excerpt');
