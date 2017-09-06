<?php
/**
 * Footer Builder Addon
 *
 * @package     Total
 * @subpackage  Framework/Addons
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
 * @version     2.1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Start Class
class WPEX_Footer_Builder {

    /**
     * Start things up
     */
    public function __construct() {

        // Define footer ID
        $this->footer_builder_id = '';

        // Add admin page
        add_action( 'admin_menu', array( &$this, 'add_page' ), 20 );

        // Register admin optoons
        add_action( 'admin_init', array( &$this,'register_page_options' ) );

        // Update footer_builder_id on init 
        add_action( 'init', array( &$this,'update_id' ) );

        // Alter the footer on init
        add_action( 'init', array( &$this,'alter_footer' ) );

        // Remove all actions from wp_head on footer builder page
        add_action( 'wp_head', array( &$this,'remove_actions' ) );

        // Remove sidebar on footer builder page
        add_filter( 'athen_post_layout_class', array( &$this,'remove_sidebar_on_footer_builder' ) );

        // Remove footer customizer settings
        add_filter( 'athen_customizer_panels', array( &$this,'remove_customizer_footer_panel' ) );

    }

    /**
     * Update footer_builder_id on init once athen_get_mod function exists
     *
     * @access  public
     * @since   2.0.0
     */
    public function update_id() {
        $this->footer_builder_id = athen_get_mod( 'footer_builder_page_id' );
    }

    /**
     * Add sub menu page
     *
     * @link    http://codex.wordpress.org/Function_Reference/add_theme_page
     * @since   2.0.0
     */
    public function add_page() {
        add_submenu_page(
            ATHEN_THEME_PANEL_SLUG,
            __( 'Footer Builder', 'athen_transl' ),
            __( 'Footer Builder', 'athen_transl' ),
            'administrator',
            ATHEN_THEME_PANEL_SLUG .'-footer-builder',
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Function that will register admin page options
     *
     * @link    http://codex.wordpress.org/Function_Reference/register_setting
     * @link    http://codex.wordpress.org/Function_Reference/add_settings_section
     * @link    http://codex.wordpress.org/Function_Reference/add_settings_field
     * @since   2.0.0
     */
    public function register_page_options() {

        // Register settings
        register_setting( 'athen_footer_builder', 'footer_builder', array( $this, 'sanitize' ) );

        // Add main section to our options page
        add_settings_section( 'athen_footer_builder_main', false, array( $this, 'section_main_callback' ), 'wpex-footer-builder-admin' );

        // Custom Page ID
        add_settings_field(
            'footer_builder_page_id',
            __( 'Footer Builder page', 'athen_transl' ),
            array( $this, 'content_id_field_callback' ),
            'wpex-footer-builder-admin',
            'athen_footer_builder_main'
        );

    }

    /**
     * Sanitization callback
     *
     * @since 2.0.0
     */
    public function sanitize( $options ) {

        // Set theme mods
        if ( isset( $options['content_id'] ) ) {
            set_theme_mod( 'footer_builder_page_id', $options['content_id'] );
        }

        // Set options to nothing since we are storing in the theme mods
        $options = '';
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

    // Footer Builder Page ID
    public function content_id_field_callback() { ?>

        <?php
        // Get footer builder page ID
        $page_id = athen_get_mod( 'footer_builder_page_id' ); ?>

        <?php
        // Display dropdown of pages
        wp_dropdown_pages( array(
            'echo'              => true,
            'selected'          => $page_id,
            'name'              => 'footer_builder[content_id]',
            'show_option_none'  => __( 'None - Display Widgetized Footer', 'athen_transl' ),
        ) ); ?>
        <br />

        <p class="description"><?php _e( 'Select your custom page for your footer layout.', 'athen_transl' ) ?></p>

        <?php
        // If page_id is defined display edit and preview links
        if ( $page_id ) { ?>

            <br />

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
            <h2><?php _e( 'Footer Builder', 'athen_transl' ); ?></h2>
            <p>
                <?php _e( 'By default the footer consists of a simple widgetized area. For more complex layouts you can use the option below to select a page which will hold the content and layout for your site footer.', 'athen_transl' ); ?>
                <br />
                <?php _e( 'Selecting a custom footer will remove all footer functions (footer widgets and footer customizer options) so you can create an entire footer using the Visual Composer and not load that extra functions.', 'athen_transl' ); ?>
            </p>
            <form method="post" action="options.php">
                <?php settings_fields( 'athen_footer_builder' ); ?>
                <?php do_settings_sections( 'wpex-footer-builder-admin' ); ?>
                <?php submit_button(); ?>
            </form>
        </div><!-- .wrap -->
    <?php }

    /**
     * Remove the footer and add custom footer if enabled
     *
     * @since 2.0.0
     */
    public function alter_footer() {

        // Remove footer and display custom footer
        if ( $this->footer_builder_id ) {

            // Remove theme footer
            remove_action( 'athen_hook_wrap_bottom', 'athen_footer', 10 );

            // Add builder footer
            add_action( 'athen_hook_wrap_bottom', array( &$this, 'get_part' ), 10 );

            // Remove widgets
            unregister_sidebar( 'footer_one' );
            unregister_sidebar( 'footer_two' );
            unregister_sidebar( 'footer_three' );
            unregister_sidebar( 'footer_four' );

        }

    }

    /**
     * Remove all theme actions
     *
     * @since 2.0.0
     */
    public function remove_actions() {

        // Remove all actions if the footer builder page is defined
        if ( ! empty( $this->footer_builder_id ) && is_page( $this->footer_builder_id ) ) {
            athen_remove_actions();
        }

    }

    /**
     * Remove the footer and add custom footer if enabled
     *
     * @since 2.0.0
     */
    public function remove_customizer_footer_panel( $panels ) {

        // Remove footer panels from the customizer
        if ( $this->footer_builder_id ) {
            unset( $panels['footer'] );
        }

        // Return panels
        return $panels;

    }

    /**
     * Make Footer builder page full-width (no sidebar)
     *
     * @since 2.0.0
     */
    public function remove_sidebar_on_footer_builder( $class ) {

        // Set the footer builder to "full-width" by default
        if ( $this->footer_builder_id && is_page( $this->footer_builder_id ) ) {
            $class = 'full-width';
        }

        // Return correct class
        return $class;

    }

    /**
     * Gets the footer builder template part
     *
     * @since 2.0.0
     */
    public function get_part() {
        $obj = athen_global_obj();
        if ( $obj->has_footer ) {
            get_template_part( 'partials/footer/footer-builder' );
        }
    }

}
new WPEX_Footer_Builder();