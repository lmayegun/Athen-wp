<?php
/**
 * Creates the admin panel and custom CSS output
 *
 * @package		Athen 
 * @subpackage	Framework/Addons
 * @author		Lukmon Mayegun 
 * @since		1.0.0
 * @version		1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'WPEX_Custom_CSS' ) ) {

	class Athen_Custom_CSS {

		/**
		 * Start things up
		 */
		public function __construct() {
			add_action( 'admin_menu', array( $this, 'add_page' ), 20 );
			add_action( 'admin_bar_menu', array( $this, 'adminbar_menu' ), 999 );
			add_action( 'admin_init', array( $this,'register_settings' ) );
			add_action( 'admin_enqueue_scripts',array( $this,'scripts' ) );
			add_action( 'admin_notices', array( $this, 'notices' ) );
			add_action( 'athen_head_css' , array( $this, 'output_css' ), 9999 );
		}

		/**
		 * Add sub menu page for the custom CSS input
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_page
		 */
		public function add_page() {
			add_submenu_page(
				ATHEN_THEME_PANEL_SLUG,
				__( 'Custom CSS', 'athen_transl' ),
				__( 'Custom CSS', 'athen_transl' ),
				'administrator',
				ATHEN_THEME_PANEL_SLUG .'-custom-css',
				array( $this, 'create_admin_page' )
			);
		}

		/**
		 * Add custom CSS to the adminbar since it will be used frequently
		 *
		 * @link http://codex.wordpress.org/Class_Reference/WP_Admin_Bar/add_node
		 */
		public function adminbar_menu( $wp_admin_bar ) {
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}
			$url	= admin_url( 'admin.php?page='. ATHEN_THEME_PANEL_SLUG .'-custom-css' );
			$args	= array(
				'id'	=> 'athen_custom_css',
				'title'	=> __( 'Custom CSS', 'athen_transl' ),
				'href'	=> $url,
				'meta'	=> array(
					'class'	=> 'wpex-custom-css',
				)
			);
			$wp_admin_bar->add_node( $args );
		}

		/**
		 * Load scripts
		 *
		 * @link http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
		 */
		public function scripts( $hook ) {

			// Only load scripts when needed
			if ( ATHEN_ADMIN_PANEL_LOAD_PAGE . '-custom-css' != $hook ) {
				return;
			}

			// Define assets URL
			$dir = ATHEN_FRAMEWORK_DIR_URI .'customiser-addons/assets/codemirror/';

			// Load JS files and required CSS
			wp_enqueue_script(
				'wpex-codemirror',
				$dir .
				'codemirror.js',
				array( 'jquery' )
			);
			wp_enqueue_script(
				'wpex-codemirror-css',
				$dir . 'css.js',
				array(
					'jquery',
					'wpex-codemirror'
				)
			);
			wp_enqueue_script(
				'wpex-codemirror-css-link',
				$dir . 'css-lint.js',
				array(
					'jquery',
					'wpex-codemirror',
					'wpex-codemirror-css'
				)
			);
			wp_enqueue_style(
				'wpex-codemirror',
				$dir . 'codemirror.css'
			);

			// Load correct skin type based on theme option
			if ( 'dark' == get_option( 'athen_custom_css_theme', 'dark' ) ) {
				wp_enqueue_style( 'wpex-codemirror-theme', $dir . 'theme-dark.css' );
			} else {
				wp_enqueue_style( 'wpex-codemirror-theme', $dir . 'theme-light.css' );
			}
			
		}

		/**
		 * Register a setting and its sanitization callback.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/register_setting
		 */
		public function register_settings() {
			register_setting( 'athen_custom_css', 'athen_custom_css', array( $this, 'sanitize' ) );
			register_setting( 'athen_custom_css', 'athen_custom_css_theme' );
		}

		/**
		 * Displays all messages registered to 'wpex-custom_css-notices'
		 *
		 * @link http://codex.wordpress.org/Function_Reference/settings_errors
		 */
		public function notices() {
			settings_errors( 'athen_custom_css_notices' );
		}

		/**
		 * Sanitization callback
		 */
		public function sanitize( $option ) {

			// Set option to theme mod
			set_theme_mod( 'custom_css', $option );

			// Return notice
			add_settings_error(
				'athen_custom_css_notices',
				esc_attr( 'settings_updated' ),
				__( 'Settings saved.', 'athen_transl' ),
				'updated'
			);

			// Lets save the custom CSS into a standard option as well for backup
			return $option;
		}

		/**
		 * Settings page output
		 */
		public function create_admin_page() { ?>
			<div class="wrap">
				<h2 style="padding-right:0;">
					<?php _e( 'Custom CSS', 'athen_transl' ); ?>
				</h2>
				<p><?php _e( 'Use the form below to add custom CSS to tweak your theme design.', 'athen_transl' ); ?></p>
				<div style="margin:10px 0 20px;"><a href="#" class="button-secondary wpex-custom-css-toggle-skin"><?php _e( 'Toggle Skin', 'athen_transl' ); ?></a></div>
				<form method="post" action="options.php">
					<?php settings_fields( 'athen_custom_css' ); ?>
					<table class="form-table">
						<tr valign="top">
							<td style="padding:0;">
								<textarea rows="40" cols="50" id="athen_custom_css" style="width:100%;" name="athen_custom_css"><?php echo athen_get_mod( 'custom_css', false ); ?></textarea>
							</td>
						</tr>
					</table>
					<input type="hidden" name="athen_custom_css_theme" value="<?php echo get_option( 'athen_custom_css_theme', 'dark' ); ?>" id="wpex-default-codemirror-theme"></input>
					<?php submit_button(); ?>
				</form>
			</div>
			<script>
				( function( $ ) {
					"use strict";
					window.onload = function() {
						window.editor = CodeMirror.fromTextArea(athen_custom_css, {
							mode			: "css",
							lineNumbers		: true,
							lineWrapping	: true,
							theme			: 'athen',
							lint			: true
						} );
					};
					<?php $dir = ATHEN_FRAMEWORK_DIR_URI .'customiser-addons/assets/codemirror/'; ?>
					$( '.wpex-custom-css-toggle-skin' ).click(function() {
						var hiddenField = $( '#wpex-default-codemirror-theme' );
						if ( hiddenField.val() == 'dark' ) {
							hiddenField.val( 'light' );
							$( '#wpex-codemirror-theme-css' ).attr( 'href','<?php echo $dir; ?>theme-light.css' );
						} else {
							hiddenField.val( 'dark' );
							$( '#wpex-codemirror-theme-css' ).attr( 'href','<?php echo $dir; ?>theme-dark.css' );
						}
						return false;
					} );
				} ) ( jQuery );
			</script>
		<?php }

		/**
		 * Outputs the custom CSS to the wp_head
		 */
		public function output_css( $output ) {
			if ( $css = athen_get_mod( 'custom_css', false ) ) {
				$output .= '/*CUSTOM CSS*/'. $css;
			}
			return $output;
		}
	}
}
new Athen_Custom_CSS();