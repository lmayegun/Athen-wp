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
        $menuMag = athen_get_mod('mega_menu_margin_left');
        print_r($menuMag);
	}
}

/**
 * Run the theme setup class
 *
 * @since 1.6.3
 */
$athen_init = new Athen_Framework_Init;



/*function custom_excerpt ( $the_query, $lenght = 10) {
 	$excerpt = wp_trim_words ($the_query, $lenght );
	return $excerpt;
}*/

//add_filter( 'excerpt_length', 'custom_excerpt' );
function tabs_array(){
		$array = array();

            // Main Tab
            $array['main'] = array(
                'title'     => __( 'Main', 'athen_transl' ),
                'settings'  => array(
                    'post_link' => array(
                        'title'         => __( 'Redirect', 'athen_transl' ),
                        'id'            => $prefix . 'post_link',
                        'type'          => 'link',
                        'description'   => __( 'Enter a url to redirect this post or page.', 'athen_transl' ),
                    ),
                    'main_layout'   =>  array(
                        'title'         => __( 'Site Layout', 'athen_transl' ),
                        'type'          => 'select',
                        'id'            => $prefix . 'main_layout',
                        'description'   => __( 'Select the layout for your site. This option should only be used in very specific cases such as landpages. Use the theme option to control globally.', 'athen_transl' ),
                        'options'       => array(
                            ''              => __( 'Default', 'athen_transl' ),
                            'full-width'    => __( 'Full-Width', 'athen_transl' ),
                            'boxed'         => __( 'Boxed', 'athen_transl' ),
                        ),
                    ),
                    'post_layout'   => array(
                        'title'         => __( 'Content Layout', 'athen_transl' ),
                        'type'          => 'select',
                        'id'            => $prefix . 'post_layout',
                        'description'   => __( 'Select your custom layout for this page or post content.', 'athen_transl' ),
                        'options'       => array(
                            ''              => __( 'Default', 'athen_transl' ),
                            'right-sidebar' => __( 'Right Sidebar', 'athen_transl' ),
                            'left-sidebar'  => __( 'Left Sidebar', 'athen_transl' ),
                            'full-width'    => __( 'No Sidebar', 'athen_transl' ),
                            'full-screen'   => __( 'Full Screen', 'athen_transl' ),
                        ),
                    ),
                    'post_container' => array(
                        'title'         => __( 'Post Container', 'athen_transl'),
                        'type'          => 'select',
                        'id'            => $prefix .'post_container',
                        'description'   => __( 'Enable container for this page or post', 'athen_transl'),
                        'options'       => array(
                            ''           => __( 'Default', 'athen_transl' ),
                            'off'           => __( 'No Container', 'athen_transl' ),
                            'on'            => __( 'Include Container', 'athen_transl' ),      
                        ),
                    ),
                    'sidebar'   => array(
                        'title'         => __( 'Sidebar', 'athen_transl' ),
                        'type'          => 'select',
                        'id'            => 'sidebar',
                        'description'   => __( 'Select your a custom sidebar for this page or post.', 'athen_transl' ),
                    ),
                    'disable_top_bar'   => array(
                        'title'         => __( 'Top Bar', 'athen_transl' ),
                        'id'            => $prefix . 'disable_top_bar',
                        'type'          => 'select',
                        'description'   => __( 'Enable or disable this element on this page or post.', 'athen_transl' ),
                        'options'       => array(
                            ''          => __( 'Default', 'athen_transl' ),
                            'enable'    => __( 'Enable', 'athen_transl' ),
                            'on'        => __( 'Disable', 'athen_transl' ),
                        ),
                    ),
                    'disable_breadcrumbs'   => array(
                        'title'         => __( 'Breadcrumbs', 'athen_transl' ),
                        'id'            => $prefix . 'disable_breadcrumbs',
                        'type'          => 'select',
                        'description'   => __( 'Enable or disable this element on this page or post.', 'athen_transl' ),
                        'options'       => array(
                            ''          => __( 'Default', 'athen_transl' ),
                            'enable'    => __( 'Enable', 'athen_transl' ),
                            'on'        => __( 'Disable', 'athen_transl' ),
                        ),
                    ),
                    'disable_social'    => array(
                        'title'         => __( 'Social Share', 'athen_transl' ),
                        'id'            => $prefix . 'disable_social',
                        'type'          => 'select',
                        'description'   => __( 'Enable or disable this element on this page or post.', 'athen_transl' ),
                        'options'       => array(
                            ''          => __( 'Default', 'athen_transl' ),
                            'enable'    => __( 'Enable', 'athen_transl' ),
                            'on'        => __( 'Disable', 'athen_transl' ),
                        ),
                    ),
                ),
            );

            // Header Tab
            $array['header'] = array(
                'title'     => __( 'Header', 'athen_transl' ),
                'settings'  => array(
                    'disable_header'    => array(
                        'title'         => __( 'Header', 'athen_transl' ),
                        'id'            => $prefix . 'disable_header',
                        'type'          => 'select',
                        'description'   => __( 'Enable or disable this element on this page or post.', 'athen_transl' ),
                        'options'   => array(
                            ''      => __( 'Enable', 'athen_transl' ),
                            'on'    => __( 'Disable', 'athen_transl' ),
                        ),
                    ),
                    'custom_menu'   => array(
                        'title'         => __( 'Custom Menu', 'athen_transl' ),
                        'type'          => 'select',
                        'id'            => $prefix . 'custom_menu',
                        'description'   => __( 'Select a custom menu for this page or post.', 'athen_transl' ),
                    ),
                    'overlay_header'    => array(
                        'title'         => __( 'Overlay Header', 'athen_transl' ),
                        'description'   => __( 'Check to enable a overlay header. Useful for putting the header over an element such as a slider or background row. This is for desktops only and the top bar will be hidden when enabled.', 'athen_transl' ),
                        'id'            => $prefix . 'overlay_header',
                        'type'          => 'select',
                        'options'       => array(
                            ''      => __( 'Disable', 'athen_transl' ),
                            'on'    => __( 'Enable', 'athen_transl' ),
                        ),
                    ),
                    'overlay_header_style'  => array(
                        'title'     => __( 'Overlay Header Style', 'athen_transl' ),
                        'type'      => 'select',
                        'id'        => $prefix . 'overlay_header_style',
                        'description'   => __( 'Select your overlay header style', 'athen_transl' ),
                        'options'   => array(
                            ''      => __( 'White Text', 'athen_transl' ),
                            'dark'  => __( 'Black Text', 'athen_transl' ),
                        ),
                        'default'   => 'light',
                    ),
                    'overlay_header_logo'   => array(
                        'title'         => __( 'Overlay Header Logo', 'athen_transl'),
                        'id'            => $prefix . 'overlay_header_logo',
                        'type'          => 'media',
                        'description'   => __( 'Select a custom logo (optional) for the overlay header.', 'athen_transl' ),
                    ),
                ),
            );

            // Title Tab
            $array['title'] = array(
                'title'     => __( 'Title', 'athen_transl' ),
                'settings'  => array(
                    'disable_title'                 => array(
                        'title'         => __( 'Title', 'athen_transl' ),
                        'id'            => $prefix . 'disable_title',
                        'type'          => 'select',
                        'description'   => __( 'Enable or disable this element on this page or post.', 'athen_transl' ),
                        'options'       => array(
                            ''      => __( 'Enable', 'athen_transl' ),
                            'on'    => __( 'Disable', 'athen_transl' ),
                        ),
                    ),
                    'disable_header_margin'         => array(
                        'title'         => __( 'Title Margin', 'athen_transl' ),
                        'id'            => $prefix . 'disable_header_margin',
                        'type'          => 'select',
                        'description'   => __( 'Enable or disable this element on this page or post.', 'athen_transl' ),
                        'options'       => array(
                            ''      => __( 'Enable', 'athen_transl' ),
                            'on'    => __( 'Disable', 'athen_transl' ),
                        ),
                    ),
                    'post_subheading'               => array(
                        'title'         => __( 'Subheading', 'athen_transl' ),
                        'type'          => 'text',
                        'id'            => $prefix . 'post_subheading',
                        'description'   => __( 'Enter your page subheading. Shortcodes & HTML is allowed.', 'athen_transl' ),
                    ),
                    'post_title_style'              => array(
                        'title'         => __( 'Title Style', 'athen_transl' ),
                        'type'          => 'select',
                        'id'            => $prefix . 'post_title_style',
                        'description'   => __( 'Select a custom title style for this page or post.', 'athen_transl' ),
                    ),
                    'post_title_background_color'   => array(
                        'title'      => __( 'Title: Background Color', 'athen_transl' ),
                        'description'=> __( 'Select a color.', 'athen_transl' ),
                        'id'         => $prefix .'post_title_background_color',
                        'type'       => 'color',
                        'hidden'     => true,
                    ),
                    'post_title_background_redux'   => array(
                        'title'         => __( 'Title: Background Image', 'athen_transl'),
                        'id'            => $prefix . 'post_title_background_redux',
                        'type'          => 'media',
                        'description'   => __( 'Select a custom header image for your main title.', 'athen_transl' ),
                        'hidden'        => true,
                    ),
                    'post_title_height' => array(
                        'title'         => __( 'Title: Background Height', 'athen_transl' ),
                        'type'          => 'text',
                        'id'            => $prefix . 'post_title_height',
                        'description'   => __( 'Select your custom height for your title background. Default is 400px.', 'athen_transl' ),
                        'hidden'        => true,
                    ),
                    'post_title_background_overlay' => array(
                        'title'         => __( 'Title: Background Overlay', 'athen_transl' ),
                        'type'          => 'select',
                        'id'            => $prefix . 'post_title_background_overlay',
                        'description'   => __( 'Select an overlay for the title background.', 'athen_transl' ),
                        'options'       => array(
                            ''          => __( 'None', 'athen_transl' ),
                            'dark'      => __( 'Dark', 'athen_transl' ),
                            'dotted'    => __( 'Dotted', 'athen_transl' ),
                            'dashed'    => __( 'Diagonal Lines', 'athen_transl' ),
                            'bg_color'  => __( 'Background Color', 'athen_transl' ),
                        ),
                        'hidden'        => true,
                    ),
                    'post_title_background_overlay_opacity' => array(
                        'id'            => $prefix . 'post_title_background_overlay_opacity',
                        'type'          => 'text',
                        'title'         => __( 'Title: Background Overlay Opacity', 'athen_transl' ),
                        'description'   => __( 'Enter a custom opacity for your title background overlay.', 'athen_transl' ),
                        'default'       => '',
                        'hidden'        => true,
                    ),
                ),
            );

            // Slider tab
            $array['slider'] = array(
                'title'     => __( 'Slider', 'athen_transl' ),
                'settings'  => array(
                    'post_slider_shortcode' => array(
                        'title'       => __( 'Slider Shortcode', 'athen_transl' ),
                        'type'        => 'code',
                        'id'          => $prefix . 'post_slider_shortcode',
                        'description' => __( 'Enter a slider shortcode here to display a slider at the top of the page.', 'athen_transl' ),
                    ),
                    'post_slider_shortcode_position' => array(
                        'title'       => __( 'Slider Position', 'athen_transl' ),
                        'type'        => 'select',
                        'id'          => $prefix . 'post_slider_shortcode_position',
                        'description' => __( 'Select the position for the slider shortcode.', 'athen_transl' ),
                        'options'     => array(
                            ''             => __( 'Skin Default', 'athen_transl' ),
                            'before_site_header'    => __( 'Before Site Header', 'athen_transl' ),
                            'after_site_header'     => __( 'After Site Header', 'athen_transl' ),
                            'before_top_header'     => __( 'Before Top Header', 'athen_transl' ),
                            'after_top_header'     => __( 'After Top Header', 'athen_transl' ),
                            'before_main_header'     => __( 'Before Main Header', 'athen_transl' ),
                            'after_main_header'     => __( 'After Main Header', 'athen_transl' ),
                            'below_title' => __( 'Below Title', 'athen_transl' ),
                        ),
                    ),  
                    'post_slider_bottom_margin' => array(
                        'title'       => __( 'Slider Bottom Margin', 'athen_transl' ),
                        'description' => __( 'Enter a bottom margin for your slider in pixels', 'athen_transl' ),
                        'id'          => $prefix . 'post_slider_bottom_margin',
                        'type'        => 'text',
                    ),
                    'disable_post_slider_mobile' => array(
                        'title'       => __( 'Slider On Mobile', 'athen_transl' ),
                        'id'          => $prefix . 'disable_post_slider_mobile',
                        'type'        => 'select',
                        'description' => __( 'Enable or disable slider display for mobile devices.', 'athen_transl' ),
                        'options'     => array(
                            ''      => __( 'Enable', 'athen_transl' ),
                            'on'    => __( 'Disable', 'athen_transl' ),
                        ),
                    ),
                    'post_slider_mobile_alt' => array(
                        'title'       => __( 'Slider Mobile Alternative', 'athen_transl' ),
                        'type'        => 'media',
                        'id'          => $prefix . 'post_slider_mobile_alt',
                        'description' => __( 'Select an image.', 'athen_transl' ),
                        'type'        => 'media',
                    ),
                    'post_slider_mobile_alt_url' => array(
                        'title'         => __( 'Slider Mobile Alternative URL', 'athen_transl' ),
                        'id'            => $prefix . 'post_slider_mobile_alt_url',
                        'description'   => __( 'URL for the mobile slider alternative.', 'athen_transl' ),
                        'type'          => 'text',
                    ),
                    'post_slider_mobile_alt_url_target' => array(
                        'title'       => __( 'Slider Mobile Alternative URL Target', 'athen_transl' ),
                        'id'          => $prefix . 'post_slider_mobile_alt_url_target',
                        'description' => __( 'Select your link target window.', 'athen_transl' ),
                        'type'        => 'select',
                        'options'     => array(
                            ''      => __( 'Same Window', 'athen_transl' ),
                            'blank' => __( 'New Window', 'athen_transl' ),
                        ),
                    ),
                ),
            );

            // Background tab
            $array['background'] = array(
                'title'     => __( 'Background', 'athen_transl' ),
                'settings'  => array(
                    'page_background_color' => array(
                        'title'         => __( 'Background Color', 'athen_transl' ),
                        'description'   => __( 'Select a color.', 'athen_transl' ),
                        'id'            => $prefix . 'page_background_color',
                        'type'          => 'color',
                    ),
                    'page_background_image_redux'   => array(
                        'title'       => __( 'Background Image', 'athen_transl' ),
                        'id'          => $prefix . 'page_background_image_redux',
                        'description' => __( 'Select an image.', 'athen_transl' ),
                        'type'        => 'media',
                    ),
                    'page_background_image_style'   => array(
                        'title'         => __( 'Background Style', 'athen_transl' ),
                        'type'          => 'select',
                        'id'            => $prefix . 'page_background_image_style',
                        'description'   => __( 'Select the style.', 'athen_transl' ),
                        'options'       => array(
                            ''          => __( 'Default', 'athen_transl' ),
                            'repeat'    => __( 'Repeat', 'athen_transl' ),
                            'fixed'     => __( 'Fixed', 'athen_transl' ),
                            'stretched' => __( 'Streched', 'athen_transl' ),
                        ),
                    ),
                ),
            );

            // Footer tab
            $array['footer'] = array(
                'title'     => __( 'Footer', 'athen_transl' ),
                'settings'  => array(
                    'disable_footer'    => array(
                        'title'         => __( 'Footer', 'athen_transl' ),
                        'id'            => $prefix . 'disable_footer',
                        'type'          => 'select',
                        'description'   => __( 'Enable or disable this element on this page or post.', 'athen_transl' ),
                        'options'       => array(
                            ''          => __( 'Default', 'athen_transl' ),
                            'enable'    => __( 'Enable', 'athen_transl' ),
                            'on'        => __( 'Disable', 'athen_transl' ),
                        ),
                    ),
                    'disable_footer_widgets'    => array(
                        'title'     => __( 'Footer Widgets', 'athen_transl' ),
                        'id'        => $prefix . 'disable_footer_widgets',
                        'type'      => 'select',
                        'description'   => __( 'Enable or disable this element on this page or post.', 'athen_transl' ),
                        'options'       => array(
                            ''          => __( 'Enable', 'athen_transl' ),
                            'on'        => __( 'Disable', 'athen_transl' ),
                        ),
                    ),
                    'footer_reveal' => array(
                        'title'         => __( 'Footer Reveal', 'athen_transl' ),
                        'description'   => __( 'Enable the footer reveal style. The footer will be placed in a fixed postion and display on scroll. This setting is for the "Full-Width" layout only and desktops only.', 'athen_transl' ),
                        'id'        => $prefix . 'footer_reveal',
                        'type'      => 'select',
                        'options'   => array(
                            ''      => __( 'Default', 'athen_transl' ),
                            'on'    => __( 'Enable', 'athen_transl' ),
                            'off'   => __( 'Disable', 'athen_transl' ),
                        ),
                    ),
                ),
            );

            // Media tab
            $array['media'] = array(
                'title'     => __( 'Media', 'athen_transl' ),
                'post_type' => array( 'post' ),
                'settings'  => array(
                    'post_media_position'   => array(
                        'title'         => __( 'Media Display/Position', 'athen_transl' ),
                        'id'            => $prefix . 'post_media_position',
                        'type'          => 'select',
                        'description'   => __( 'Select your preferred position for your post\'s media (featured image or video).', 'athen_transl' ),
                        'options'       => array(
                            ''          => __( 'Default', 'athen_transl' ),
                            'above'     => __( 'Full-Width Above Content', 'athen_transl' ),
                            'hidden'    => __( 'None (Do Not Display Featured Image/Video)', 'athen_transl' ),
                        ),
                    ),
                    'post_oembed'   => array(
                        'title'         => __( 'oEmbed URL', 'athen_transl' ),
                        'description'   =>  __( 'Enter a URL that is compatible with WP\'s built-in oEmbed feature. This setting is used for your video and audio post formats.', 'athen_transl' ) .'<br /><a href="http://codex.wordpress.org/Embeds" target="_blank">'. __( 'Learn More', 'athen_transl' ) .' &rarr;</a>',
                        'id'            => $prefix . 'post_oembed',
                        'type'          => 'text',
                    ),
                    'post_self_hosted_shortcode_redux'  => array(
                        'title'         => __( 'Self Hosted', 'athen_transl' ),
                        'description'   => __( 'Insert your self hosted video or audio url here.', 'athen_transl' ) .'<br /><a href="http://make.wordpress.org/core/2013/04/08/audio-video-support-in-core/" target="_blank">'. __( 'Learn More', 'athen_transl' ) .' &rarr;</a>',
                        'id'            => $prefix . 'post_self_hosted_media',
                        'type'          => 'media',
                    ),
                    'post_video_embed'   => array(
                        'title'         => __( 'Embed Code', 'athen_transl' ),
                        'description'   => __( 'Insert your embed/iframe code.', 'athen_transl' ),
                        'id'            => $prefix . 'post_video_embed',
                        'type'          => 'textarea',
                        'rows'          => '2',
                    ),
                ),
            );

    return $array;
}

//var_dump(tabs_array());