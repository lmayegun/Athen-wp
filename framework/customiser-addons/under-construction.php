<?php
/**
 * Under Construction Addon
 *
 * @package     Total
 * @subpackage  Framework/Addons
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       2.1.0
 * @version		1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
class WPEX_Under_Construction {

	/**
	 * Start things up
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_page' ) );
		add_action( 'admin_init', array( $this,'register_page_options' ) );
		add_action( 'admin_notices', array( $this, 'notices' ) );
		add_filter( 'template_redirect', array( &$this, 'redirect' ) );
	}

	/**
	 * Add sub menu page for the custom CSS input
	 *
	 * @link	http://codex.wordpress.org/Function_Reference/add_theme_page
	 * @since	2.0.0
	 */
	public function add_page() {
		add_submenu_page(
			ATHEN_THEME_PANEL_SLUG,
			__( 'Under Construction', 'athen_transl' ),
			__( 'Under Construction', 'athen_transl' ),
			'administrator',
			ATHEN_THEME_PANEL_SLUG . '-under-construction',
			array( $this, 'create_admin_page' )
		);
	}

	/**
	 * Function that will register admin page options.
	 *
	 * @link	http://codex.wordpress.org/Function_Reference/register_setting
	 * @link	http://codex.wordpress.org/Function_Reference/add_settings_section
	 * @link	http://codex.wordpress.org/Function_Reference/add_settings_field
	 * @since	2.0.0
	 */
	public function register_page_options() {

		// Register settings
		register_setting( 'athen_under_construction', 'under_construction', array( $this, 'sanitize' ) );

		// Add main section to our options page
		add_settings_section( 'athen_under_construction_main', false, array( $this, 'section_main_callback' ), 'wpex-under-construction-admin' );

		// Redirect field
		add_settings_field(
			'under_construction',
			__( 'Enable Under Constuction', 'athen_transl' ),
			array( $this, 'redirect_field_callback' ),
			'wpex-under-construction-admin',
			'athen_under_construction_main'
		);

		// Custom Page ID
		add_settings_field(
			'under_construction_page_id',
			__( 'Under Construction page', 'athen_transl' ),
			array( $this, 'content_id_field_callback' ),
			'wpex-under-construction-admin',
			'athen_under_construction_main'
		);

	}

	/**
	 * Displays all messages registered to 'wpex-custom_css-notices'
	 *
	 * @link	http://codex.wordpress.org/Function_Reference/settings_errors
	 * @since	2.0.0
	 */
	public function notices() {
		settings_errors( 'athen_custom_under_construction_notices' );
	}

	/**
	 * Sanitization callback
	 *
	 * @since 2.0.0
	 */
	public function sanitize( $options ) {

		// Set theme mods
		if ( isset ( $options['enable'] ) ) {
			set_theme_mod( 'under_construction', true );
		} else {
			remove_theme_mod( 'under_construction' );
		}

		if ( isset( $options['content_id'] ) ) {
			set_theme_mod( 'under_construction_page_id', $options['content_id'] );
		}

		// Add notice
		add_settings_error(
			'athen_custom_under_construction_notices',
			esc_attr( 'settings_updated' ),
			__( 'Settings saved.', 'athen_transl' ),
			'updated'
		);

		// Set options to nothing since we are storing in the theme mods
		// $options = '';
		return $options;
	}

	/**
	 * Main Settings section callback
	 *
	 * @since 2.0.0
	 */
	public function section_main_callback( $options ) {
		// Leave blank
	}

	/**
	 * Fields callback functions
	 *
	 * @since 2.0.0
	 */

	// Enable admin field
	public function redirect_field_callback() {
		$val    = athen_get_mod( 'under_construction', false );
		$output = '<input type="checkbox" name="under_construction[enable]" value="'. $val .'" '. checked( $val, true, false ) .'> ';
		$output .= '<span class="description">'. __( 'Enable the Under Construction function.', 'athen_transl' ) .'</span>';
		echo $output;
	}

	// Page ID admin field
	public function content_id_field_callback() { ?>

		<?php
		// Get construction page id
		$page_id = athen_get_mod( 'under_construction_page_id', false ); ?>

		<p><?php
		// Display dropdown of pages to select from
		wp_dropdown_pages( array(
			'echo'				=> true,
			'selected'			=> $page_id,
			'name'				=> 'under_construction[content_id]',
			'show_option_none'	=> __( 'None', 'athen_transl' ),
		) ); ?></p>

		<p class="description"><?php _e( 'Select your custom page for your under construction display. Every page and post will redirect to your selected page for non-logged in users.', 'athen_transl' ) ?></p>

		<?php
		// Display edit and preview buttons
		if ( $page_id ) { ?>

			<p style="margin:20px 0 0;">

			<a href="<?php echo admin_url( 'post.php?post='. $page_id .'&action=edit' ); ?>" class="button" target="_blank">
                <?php _e( 'Backend Edit', 'athen_transl' ); ?>
            </a>

            <?php if ( ATHEN_CHECK_VC ) { ?>
                <a href="<?php echo admin_url( 'post.php?vc_action=vc_inline&post_id='. $page_id .'&post_type=page' ); ?>" class="button" target="_blank">
                    <?php _e( 'Frontend Edit', 'athen_transl' ); ?>
                </a>
            <?php } ?>

            <a href="<?php echo get_permalink( $page_id ); ?>" class="button" target="_blank">
                <?php _e( 'Preview', 'athen_transl' ); ?>
            </a>

		<?php } ?>

	<?php }

	/**
	 * Settings page output
	 *
	 * @since 2.0.0
	 */
	public function create_admin_page() { ?>

		<div class="wrap">

			<h2><?php _e( 'Under Construction', 'athen_transl' ); ?></h2>
			
			<form method="post" action="options.php">
				<?php settings_fields( 'athen_under_construction' ); ?>
				<?php do_settings_sections( 'wpex-under-construction-admin' ); ?>
				<?php submit_button(); ?>
			</form>

		</div><!-- .wrap -->

	<?php }

	/**
	 * Redirect all pages to the under cronstruction page if user is not logged in
	 *
	 * @link    http://codex.wordpress.org/Plugin_API/Action_Reference/template_redirect
	 * @since   1.6.0
	 */
	public function redirect() {
		if ( ! is_user_logged_in() ) {
			if ( athen_get_mod( 'under_construction_enable' ) && athen_get_mod( 'under_construction' ) ) {
				$page_id = athen_get_mod( 'under_construction_page_id' );
				if ( $page_id ) {
					if ( function_exists( 'icl_object_id' ) ) {
						$page_id = icl_object_id( $page_id, 'page' );
					}
					$permalink = get_permalink( $page_id );
					if ( $permalink && ! is_page( $page_id ) ) {
						wp_redirect( $permalink, 302 );
						exit();
					}
				}
			}
		}
	}

}
new WPEX_Under_Construction();