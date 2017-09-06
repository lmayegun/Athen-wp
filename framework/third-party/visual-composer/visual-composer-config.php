<?php
/**
 * Loads all functions for the Visual Composer
 *
 * @package     Total
 * @subpackage  Framework/Visual Composer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       1.6.0
 * @version     2.1.0
 */

// WPEX Visual Composer Class used to tweak VC functions and defaults
class WPEX_Visual_Composer_Config {

	/**
	 * Check if the theme should tweak the Visual Composer or not.
	 * Variable must be static so it can be used in other classes/functions/template_parts
	 *
	 * @since 1.6.0
	 */
	public static $has_vc_edits = true;

	/**
	 * Start things up
	 *
	 * @since 1.6.0
	 */
	public function __construct() {

		// Declare global object to store data for use with custom vc modules and keep things fast
		global $vcex_global;
		$vcex_global = new stdClass;

		// Setup global object to store key data for use with VC modules
		add_action( 'vc_before_init', array( &$this, 'global_object' ), 0 );

		// Load Visual Composer stylesheet at the very top before the main stylesheet so we can override it
		add_action( 'wp_enqueue_scripts', array( &$this, 'reload_js_composer_css' ), 1 );
        
		// Apply filters so you can disable modifications via a child theme
		self::$has_vc_edits = apply_filters( 'athen_edit_visual_composer', self::$has_vc_edits );

		// Make sure we are allowed to edit the Visual Composer
		if ( self::$has_vc_edits ) {

			// Remove welcome page
			add_action( 'admin_menu', array( __class__, 'remove_welcome' ), 999 );
		   
			// Remove redirect on activation
			remove_action( 'vc_activation_hook', 'vc_page_welcome_set_redirect' );
			remove_action( 'init', 'vc_page_welcome_redirect' );

			// Remove and Load scripts
			add_action( 'wp_enqueue_scripts', array( &$this, 'scripts' ) );

			// Remove duplicate scripts added too late to remove in wp_enqueue_scripts hook
			add_action( 'wp_footer', array( &$this, 'remove_footer_scropts' ) );

			// Enque scripts for the admin
			add_action( 'admin_enqueue_scripts',  array( &$this, 'admin_scripts' ) );

			// Disable updates
			add_action( 'vc_before_init', array( &$this, 'disable_updates' ) );

			// Define default post types
			add_action( 'init', array( &$this, 'define_post_types' ) );

			// Configure default VC shortcodes
			add_action( 'init', array( &$this, 'config_shortcodes' ) );

			// Remove VC elements
			add_action( 'init', array( &$this, 'remove_elements' ) );

			// Admin Init
			add_action( 'admin_init', array( &$this, 'remove_params' ) );

			// Remove metaboxes
			add_action( 'do_meta_boxes', array( &$this, 'remove_metaboxes' ) );

			// Alter VC Fonts
			add_filter( 'vc_google_fonts_get_fonts_filter', array( &$this, 'google_fonts' ) );

			// Tweak font_container
			add_filter( 'vc_font_container_get_allowed_tags', array( &$this, 'font_container_tags' ) );
			add_filter( 'vc_font_container_get_fonts_filter', array( &$this, 'font_container_fonts' ) );

		}

		// Extend the Visual Composer (add new modules)
		add_action( 'after_setup_theme', array( &$this, 'extend' ) );

		// Include helper functions
		require_once( ATHEN_FRAMEWORK_DIR .'third-party/visual-composer/helpers.php' );

		// Add custom params
		//require_once( ATHEN_FRAMEWORK_DIR .'visual-composer/params/typography.php' );

		// Include helper classes
		require_once( ATHEN_FRAMEWORK_DIR .'third-party/visual-composer/helpers/build-query.php' );
		require_once( ATHEN_FRAMEWORK_DIR .'third-party/visual-composer/helpers/inline-js.php' );
		require_once( ATHEN_FRAMEWORK_DIR .'third-party/visual-composer/helpers/inline-style.php' );
		require_once( ATHEN_FRAMEWORK_DIR .'third-party/visual-composer/helpers/parse-row-atts.php' );

		// Register accent colors
		add_filter( 'athen_accent_texts', array( &$this, 'accent_texts' ) );
		add_filter( 'athen_accent_borders', array( &$this, 'accent_borders' ) );
		add_filter( 'athen_accent_backgrounds', array( &$this, 'accent_backgrounds' ) );

	}

	/**
	 * Removes "About" page in the Visual Composer
	 *
	 * @since   2.1.0
	 * @access  public
	 */
	public static function remove_welcome() {
		remove_submenu_page( 'vc-general', 'vc-welcome' );
	}

	/**
	 * Setup global object to store key data for use with VC modules
	 *
	 * @since	2.0.2
	 * @access	public
	 */
	public function global_object() {

		// Get global object
		global $vcex_global;
		
		// Store list of users
		$users                   = get_users( array( 'number' => '30' ) );
		$vcex_global->users_list = array();
		foreach ( $users as $user ) {
			$vcex_global->users_list[] = array(
				'label' => esc_html( $user->display_name ),
				'value' => $user->ID,
				'group' => __( 'Select', 'athen_transl' )
			);
		}

		// Store taxonomies
		$taxonomies              = get_taxonomies( array( 'public' => true ) );
		$vcex_global->taxonomies = array();
		foreach ( $taxonomies as $taxonomy ) {
			$get_tax = get_taxonomy( $taxonomy );
			$vcex_global->taxonomies[] = array(
				'label' => $get_tax->labels->name,
				'value' => $taxonomy,
				'group' => __( 'Select', 'athen_transl' )
			);
		}

		// Store Terms
		$taxonomies         = get_taxonomies( array( 'public' => true ), 'objects' );
		$get_terms          = get_terms( array_keys( $taxonomies ), array( 'hide_empty' => false ) );
		$vcex_global->terms = array();
		foreach ( $get_terms as $term ) {
			$group = isset( $taxonomies[$term->taxonomy]->labels ) ? $taxonomies[$term->taxonomy]->labels->name : __( 'Taxonomies', 'athen_transl' );
			$vcex_global->terms[] = array(
				'label'     => $term->name,
				'value'     => $term->slug,
				'group_id'  => $term->taxonomy,
				'group'     => $group,
			);
		}

		// Store post types
		$post_types = get_post_types( array(
			'public' => true
		) );
		unset( $post_types['attachment'] );
		unset( $post_types['page'] );
		foreach ( $post_types as $post_type ) {
			$vcex_global->post_types[$post_type] = $post_type;
		}
	}

	/**
	 * Load Visual Composer stylesheet at the very top before the main stylesheet so we can override it
	 *
	 * @since	2.0.0
	 * @access	public
	 */
	public function reload_js_composer_css() {
		 wp_enqueue_style( 'js_composer_front' );
	}

	/**
	 * Remove and Load scripts
	 *
	 * @since	1.6.0
	 * @access	public
	 */
	public function scripts() {

		// Remove VC javascript when on the customizer to prevent bugs with jQuery UI
		if ( is_customize_preview() ) {
			wp_deregister_script( 'wpb_composer_front_js' );
			wp_dequeue_script( 'wpb_composer_front_js' );
		}

		// Remove unwanted scripts
		if ( self::$has_vc_edits ) {
			wp_deregister_style( 'js_composer_custom_css' );
		}

	}

	/**
	 * Remove scripts hooked in too late for me to remove on wp_enqueue_scripts
	 *
	 * @since   2.1.0
	 * @access  public
	 */
	public function remove_footer_scropts() {

		// JS
		wp_dequeue_script( 'vc_pageable_owl-carousel' );
		wp_dequeue_script( 'vc_grid-js-imagesloaded' );

		// Styles conflict with Total owl carousel styles
		wp_deregister_style( 'vc_pageable_owl-carousel-css-theme' );
		wp_dequeue_style( 'vc_pageable_owl-carousel-css-theme' );
		wp_deregister_style( 'vc_pageable_owl-carousel-css' );
		wp_dequeue_style( 'vc_pageable_owl-carousel-css' );

	}

	/**
	 * Admin Scripts
	 *
	 * @since	1.6.0
	 * @access	public
	 */
	public function admin_scripts() {
		
		// Make sure we can edit the visual composer
		if ( ! self::$has_vc_edits ) {
			return;
		}

		// Load custom admin CSS
		wp_enqueue_style( 'vcex-admin-css', ATHEN_VCEX_DIR_URI .'assets/admin.css' );

	}

	/**
	 * Disable Updates
	 * Set the visual composer to run in theme mod
	 *
	 * @since	1.6.0
	 * @access	public
	 */
	public function disable_updates() {
		
		if ( ! function_exists( 'vc_set_as_theme' ) ||  ! athen_get_mod( 'visual_composer_theme_mode', true ) ) {
			return;
		}

		// Set VC as theme mode and disable updater
		vc_set_as_theme( true );

	}

	/**
	 * Alter default post types
	 *
	 * @since	2.0.0
	 * @access	public
	 */
	public function define_post_types() {

		// Return if vc_set_default_editor_post_types doesn't exist
		if ( ! function_exists( 'vc_set_default_editor_post_types' ) ) {
			return;
		}

		// Set default post types for the VC
		vc_set_default_editor_post_types( array( 'page', 'portfolio', 'staff' ) );

	}

	/**
	 * Configure core VC shortcodes
	 *
	 * @since	2.0.0
	 * @access	public
	 */
	public function config_shortcodes() {

		if ( ! self::$has_vc_edits || ! function_exists( 'vc_add_param' ) ) {
			return;
		}

		// Config files tweak VC modules (add/remove params)
		require_once( ATHEN_FRAMEWORK_DIR .'third-party/visual-composer/config/vc-row.php' );
		require_once( ATHEN_FRAMEWORK_DIR .'third-party/visual-composer/config/vc-single-image.php' );

		// Add params to other modules
		require_once( ATHEN_FRAMEWORK_DIR .'third-party/visual-composer/config/add-params.php' );

	}

	/**
	 * Extend the Visual Composer / Add custom modules
	 *
	 * @since	2.0.0
	 * @access	public
	 */
	public function extend() {

		if ( ! athen_get_mod( 'extend_visual_composer', true ) ) {
			return;
		}

		require_once( ATHEN_VCEX_DIR .'extend.php' );

	}

	/**
	 * Remove metaboxes
	 *
	 * @since   1.6.0
	 * @access	public
	 *
	 * @link    http://codex.wordpress.org/Function_Reference/do_meta_boxes
	 */
	public function remove_metaboxes() {

		// Make sure we can edit the visual composer
		if ( ! self::$has_vc_edits ) {
			return;
		}

		// Loop through post types and remove params
		$post_types = get_post_types( '', 'names' ); 
		foreach ( $post_types as $post_type ) {
			remove_meta_box( 'vc_teaser',  $post_type, 'side' );
		}

	}

	/**
	 * Remove modules
	 *
	 * @since	1.6.0
	 * @access	public
	 *
	 * @link http://kb.wpbakery.com/index.php?title=Vc_remove_element
	 */
	public function remove_elements() {

		// Make sure we can edit the visual composer
		if ( ! self::$has_vc_edits ) {
			return;
		}

		// Array of elements to remove
		$elements = array(
			'vc_teaser_grid',
			'vc_posts_grid',
			'vc_posts_slider',
			'vc_carousel',
			'vc_wp_tagcloud',
			'vc_wp_archives',
			'vc_wp_calendar',
			'vc_wp_pages',
			'vc_wp_links',
			'vc_wp_posts',
			'vc_gallery',
			'vc_wp_categories',
			'vc_wp_rss',
			'vc_wp_text',
			'vc_wp_meta',
			'vc_wp_recentcomments',
			'vc_images_carousel',
			'layerslider_vc'
		);

		// Add filter for child theme tweaking
		$elements = apply_filters( 'athen_vc_remove_elements', $elements );

		// Loop through and remove default Visual Composer Elements until fully tested and they work well
		if ( is_array( $elements ) ) {
			foreach ( $elements as $element ) {
				vc_remove_element( $element );
			}
		}

	}

	/**
	 * Remove params
	 *
	 * @since   1.6.0
	 * @access	public
	 *
	 * @link    http://kb.wpbakery.com/index.php?title=Vc_remove_param
	 */
	public function remove_params() {

		// Make sure we can edit the visual composer
		if ( ! self::$has_vc_edits ) {
			return;
		}

		// Array of params to remove
		$params = array(

			// Rows
			'vc_row'            => array(
				'font_color',
				'padding',
				'bg_image',
				'bg_color',
				'css',
				'bg_image_repeat',
				'margin_bottom',
				'el_id',
				'parallax',
			),

			// Row Inner
			'vc_row_inner'      => array(
				'css',
			),

			// Seperator w/ Text
			'vc_text_separator' => array(
				'color',
				'el_width',
				'accent_color',
				'border_width',
				'align',
			),

			// Columns
			'vc_column'         => array(
				'css',
				'font_color',
			),

			// Column Inner
			'vc_column_inner'   => array(
				'css',
			),

		);

		// Add filter for child theme tweaking
		$params = apply_filters( 'athen_vc_remove_params', $params );

		// Loop through and remove default Visual Composer params
		foreach ( $params as $key => $val ) {

			if ( ! is_array( $val ) ) {
				return;
			}
			foreach ( $val as $remove_param ) {
				vc_remove_param( $key, $remove_param );
			}

		}

	}

	/**
	 * Add fonts to the google_fonts param - does nothing yet...
	 *
	 * @since   2.1.0
	 * @access	public
	 */
	public function google_fonts( $fonts ) {
		return $fonts;
	}

	/**
	 * Adds fonts to the font_container param
	 *
	 * @since   2.1.0
	 * @access	public
	 */
	public function font_container_tags( $tags ) {

		// Add default blank setting
		$new_tags[''] = '';

		// Merge arrays
		$tags = array_merge( $new_tags, $tags );

		// Add more tags
		$tags['span'] = 'span';

		// Return tags
		return $tags;

	}

	/**
	 * Adds fonts to the font_container param
	 *
	 * @since   2.1.0
	 * @access	public
	 */
	public function font_container_fonts( $fonts ) {

		// Add blank option
		$new_fonts[''] = __( 'Default', 'athen_transl' );

		// Merge arrays
		$fonts = array_merge( $new_fonts, $fonts );

		// Return fonts
		return $fonts;

	}

	/**
	 * Adds border accents for WooCommerce styles
	 *
	 * @since   2.1.0
	 * @access  public
	 */
	public function accent_texts( $texts ) {
		$new = array(
			'.wpex-carousel-woocommerce .wpex-carousel-entry-details',
			'.vcex-button.outline',
		);
		$texts = array_merge( $new, $texts );
		return $texts;
	}

	/**
	 * Adds border accents for WooCommerce styles
	 *
	 * @since   2.1.0
	 * @access  public
	 */
	public function accent_borders( $borders ) {
		$new = array(
			'body .vc_text_separator_two span' => array( 'bottom' ),
			'.wpb_tabs.tab-style-alternative-two .wpb_tabs_nav li.ui-tabs-active a' => array( 'bottom' ),
			'.vcex-button.outline',
		);
		$borders = array_merge( $new, $borders );
		return $borders;
	}

	/**
	 * Adds border accents for WooCommerce styles
	 *
	 * @since   2.1.0
	 * @access  public
	 */
	public function accent_backgrounds( $backgrounds ) {
		$new = array(
			// wpex-visual-composer.css
			'.vcex-button',
			'.vcex-button:hover',
			// wpex-visual-composer-extend.css
			'.vcex-skillbar-bar',
			'.vcex-icon-box.style-five.link-wrap:hover',
			'.vcex-icon-box.style-four.link-wrap:hover',
			'.vcex-recent-news-date span.month',
			'.vcex-pricing.featured .vcex-pricing-header',
			'.vcex-testimonials-fullslider .sp-button:hover',
			'.vcex-testimonials-fullslider .sp-selected-button',
			'.vcex-button.graphical:hover',
			'.vcex-button.three-d:hover',
			'.vcex-social-links a:hover',
			'.vcex-button.outline:hover',
			'.vcex-testimonials-fullslider.light-skin .sp-button:hover',
			'.vcex-testimonials-fullslider.light-skin .sp-selected-button',
		);
		$backgrounds = array_merge( $new, $backgrounds );
		return $backgrounds;
	}

}
$athen_visual_composer_config = new WPEX_Visual_Composer_Config();