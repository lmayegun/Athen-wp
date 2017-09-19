<?php
/**
 * Used for the main Add Ons dashboard menu and page
 *
 * @package     Total
 * @subpackage  Framework/Addons
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       1.6.0
 * @version     2.1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Only needed in the admin
if ( ! is_admin() ) {
    return;
}

// Start Class
if ( ! class_exists( 'WPEX_Tweaks_Admin' ) ) {

    class WPEX_Tweaks_Admin {

        /**
         * Start things up
         */
        public function __construct() {

            // Array of theme "parts/addons" that can be enabled/disabled
            $this->theme_parts = array(
                'recommend_plugins' => array(
                    'enabled' => true,
                    'label'   => __( 'Recommend Plugins', 'athen_transl' ),
                ),
                'post_series' => array(
                    'enabled' => true,
                    'label'   => __( 'Blog Post Series', 'athen_transl' ),
                ),
                'portfolio' => array(
                    'enabled' => true,
                    'label'   => __( 'Portfolio', 'athen_transl' ),
                ),
                'staff' => array(
                    'enabled' => true,
                    'label'   => __( 'Staff', 'athen_transl' ),
                ),
                'testimonials' => array(
                    'enabled' => true,
                    'label'   => __( 'Testimonials', 'athen_transl' ),
                ),
                'custom_css' => array(
                    'enabled' => true,
                    'label'   => __( 'Custom CSS', 'athen_transl' ),
                ),
                'under_construction' => array(
                    'enabled' => true,
                    'label'   => __( 'Under Construction', 'athen_transl' ),
                ),
                'favicons' => array(
                    'enabled' => true,
                    'label'   => __( 'Favicons', 'athen_transl' ),
                ),
                'footer_builder' => array(
                    'enabled' => true,
                    'label'   => __( 'Footer Builder', 'athen_transl' ),
                ),
                'custom_admin_login'  => array(
                    'enabled' => true,
                    'label'   => __( 'Login Page', 'athen_transl' ),
                ),
                'custom_404' => array(
                    'enabled' => true,
                    'label'   => __( '404 Page', 'athen_transl' ),
                ),
                'custom_wp_gallery' => array(
                    'enabled' => true,
                    'label'   => __( 'Custom WordPress Gallery', 'athen_transl' ),
                ),
                'widget_areas' => array(
                    'enabled' => true,
                    'label'   => __( 'Widget Areas', 'athen_transl' ),
                ),
                'term_thumbnails' => array(
                    'enabled' => true,
                    'label'   => __( 'Category Thumbnails', 'athen_transl' ),
                ),
                'editor_formats' => array(
                    'enabled' => true,
                    'label'   => __( 'Editor Formats', 'athen_transl' ),
                ),
                'remove_emoji_scripts' => array(
                    'enabled' => true,
                    'label'   => __( 'Remove Emoji Scripts', 'athen_transl' ),
                ),
                'image_sizes' => array(
                    'enabled' => true,
                    'label'   => __( 'Image Sizes', 'athen_transl' ),
                ),
                'minify_js' => array(
                    'enabled' => true,
                    'label'   => __( 'Minify Javascript', 'athen_transl' ),
                ),
                'remove_posttype_slugs' > array(
                    'enabled'   => false,
                    'label'     => __( 'Remove Custom Post Type Slugs (Experimental)', 'athen_transl' ),
                    'desc'      => __( 'Toggle the slug on/off for your custom post types (portfolio, staff, testimonials). Custom Post Types in WordPress by default should have a slug to prevent conflicts, you can use this setting to disable them, but be careful.', 'athen_transl' ) .  __( 'Please make sure to re-save your WordPress permalinks settings whenever changing this option.', 'athen_transl' ),
                    'custom_id' => true, 
                ),
            );

            // Add menu page
            add_action( 'admin_menu', array( $this, 'add_menu_page' ) );

            // Add menu subpage
            add_action( 'admin_menu', array( $this, 'add_menu_subpage' ) );

            // Register settings
            add_action( 'admin_init', array( $this,'register_settings' ) );


        }

        /**
         * Registers a new menu page
         *
         * @link    http://codex.wordpress.org/Function_Reference/add_menu_page
         * @since   1.6.0
         */
        function add_menu_page() {
            add_menu_page(
                __( 'Theme Panel - Addons', 'athen_transl' ),
                'Theme Panel - Addons', // menu title - can't be translated because it' used for the $hook prefix
                'manage_options',
                ATHEN_THEME_PANEL_SLUG,
                '',
                'dashicons-admin-generic',
                null
            );
        }

        /**
         * Registers a new submenu page
         *
         * @link    http://codex.wordpress.org/Function_Reference/add_submenu_page
         * @since   1.6.0
         */
        function add_menu_subpage(){
            add_submenu_page(
                'wpex-general',
                __( 'General', 'athen_transl' ),
                __( 'General', 'athen_transl' ),
                'manage_options',
                ATHEN_THEME_PANEL_SLUG,
                array( $this, 'create_admin_page' )
            );
        }

        /**
         * Register a setting and its sanitization callback.
         *
         * @link http://codex.wordpress.org/Function_Reference/register_setting
         */
        function register_settings() {
            register_setting( 'athen_tweaks', 'athen_tweaks', array( $this, 'admin_sanitize' ) ); 
        }

        /**
         * Main Sanitization callback
         */
        function admin_sanitize( $options ) {

            // Check options first
            if ( ! is_array( $options ) || empty( $options ) || ( false === $options ) ) {
                return array();
            }

            // Save checkboxes
            $checkboxes = array( 'post_series_enable', 'visual_composer_theme_mode', 'extend_visual_composer' );

            // Add theme parts to checkboxes array
            foreach ( $this->theme_parts as $key => $val ) {
                if ( isset( $val['custom_id'] ) ) {
                    $checkboxes[] = $key;
                } else {
                    $checkboxes[] = $key .'_enable';
                }
            }

            // Remove thememods for checkboxes not in array
            foreach ( $checkboxes as $checkbox ) {
                if ( isset( $options[$checkbox] ) ) {
                    set_theme_mod( $checkbox, 1 );
                } else {
                    set_theme_mod( $checkbox, 0 );
                }
            }

            // Standard options
           foreach( $options as $key => $value ) {
                if ( in_array( $key, $checkboxes ) ) {
                    continue; // checkboxes already done
                }
                if ( ! empty( $value ) ) {
                    set_theme_mod( $key, $value );
                } else {
                    remove_theme_mod( $key );
                }
            }

            // No need to save in options table
           /* $options = '';*/
            return $options;

        }

        /**
         * Settings page output
         */
        function create_admin_page() { ?>

            <div class="wrap">

                <h2><?php _e( 'Theme Panel', 'athen_transl' ); ?></h2>

                <form method="post" action="options.php">

                    <?php settings_fields( 'athen_tweaks' ); ?>

                    <table class="form-table">

                        <tr valign="top">
                            <th scope="row"><?php _e( 'Theme Branding', 'athen_transl' ); ?></th>
                            <td>
                                <fieldset>
                                    <input type="text" name="athen_tweaks[theme_branding]" value="<?php echo athen_get_mod( 'theme_branding', 'Total' ); ?>" style="width:25em;">
                                </fieldset>
                            </td>
                        </tr>

                        <tr valign="top">
                            <th scope="row"><?php _e( 'Purchase Code', 'athen_transl' ); ?></th>
                            <td>
                                <fieldset>
                                    <input type="text" name="athen_tweaks[envato_license_key]" value="<?php echo athen_get_mod( 'envato_license_key', '' ); ?>" style="width:25em;"><p class="description"><?php _e( 'Enter your Envato license key here if you wish to receive auto updates for your theme.', 'athen_transl' ); ?></p>
                                </fieldset>
                            </td>
                        </tr>

                        <tr valign="top">
                            <th scope="row"><?php _e( 'Theme Features', 'athen_transl' ); ?></th>
                            <td>
                                <fieldset>
                                    <?php
                                    // Loop through theme pars and add checkboxes
                                    foreach ( $this->theme_parts as $key => $val ) {

                                        $enabled   = isset ( $val['enabled'] ) ? $val['enabled'] : true;
                                        $label     = isset ( $val['label'] ) ? $val['label'] : '';

                                        // Set id
                                        if ( isset( $val['custom_id'] ) ) {
                                            $key = $key;
                                        } else {
                                            $key = $key .'_enable';
                                        }

                                        // Get theme option
                                        $theme_mod = athen_get_mod( $key, $enabled ); ?>

                                        <label><input type="checkbox" name="athen_tweaks[<?php echo $key; ?>]" value="<?php echo $theme_mod; ?>" <?php checked( $theme_mod, true ); ?>> <?php echo $label; ?></label>
                                        <?php if ( isset( $val['desc'] ) ) { ?>
                                        <p class="description"><?php echo $val['desc']; ?></p>
                                        <?php } ?>
                                        <br />
                                    <?php } ?>
                                </fieldset>
                            </td>
                        </tr>

                        <?php
                        // Post Series Settings
                        if ( athen_get_mod( 'post_series_enable', true ) ) { ?>
                            <tr valign="top">
                                <th scope="row"><?php _e( 'Post Series Labels', 'athen_transl' ); ?></th>
                                <td>
                                <input type="text" name="athen_tweaks[post_series_labels]" value="<?php echo athen_get_mod( 'post_series_labels', __( 'Post Series', 'athen_transl' ) ); ?>" style="width:25em;">
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row"><?php _e( 'Post Series Slug', 'athen_transl' ); ?></th>
                                <td>
                                <input type="text" name="athen_tweaks[post_series_slug]" value="<?php echo athen_get_mod( 'post_series_slug', 'post-series' ); ?>" style="width:25em;">
                                </td>
                            </tr>
                        <?php } ?>

                        <?php
                        // Visual Composer Settings
                        if ( ATHEN_CHECK_VC ) { ?>

                            <tr valign="top">
                                <th scope="row"><?php _e( 'Visual Composer', 'athen_transl' ); ?></th>
                                <td>
                                    <fieldset>
                                        <label><input type="checkbox" name="athen_tweaks[visual_composer_theme_mode]" <?php checked( athen_get_mod( 'visual_composer_theme_mode', true ) ); ?>> <?php _e( ' Run Visual Composer In Theme Mode', 'athen_transl' ); ?></label><p class="description"><?php _e( 'Please keep this option enabled unless you have purchased a full copy of the Visual Composer plugin directly from the author.', 'athen_transl' ); ?></p>
                                        <br />
                                        <label><input type="checkbox" name="athen_tweaks[extend_visual_composer]" <?php checked( athen_get_mod( 'extend_visual_composer', true ) ); ?>> <?php _e( ' Extend The Visual Composer?', 'athen_transl' ); ?></label><p class="description"><?php _e( 'This theme includes many extensions (more modules) for the Visual Composer plugin. If you do not wish to use any disable them here.', 'athen_transl' ); ?></p>
                                    </fieldset>
                                </td>
                            </tr>

                            <tr valign="top">
                                <th scope="row"><?php _e( 'Analytics Tracking Code', 'athen_transl' ); ?></th>
                                <td>
                                    <fieldset>
                                        <textarea type="text" name="athen_tweaks[tracking]" rows="5" style="width:25em;"><?php echo athen_get_mod( 'tracking', false ); ?></textarea><p class="description"><?php _e( 'Enter your entire tracking code (javascript).', 'athen_transl' ); ?></p>
                                    </fieldset>
                                </td>
                            </tr>

                        <?php } ?>

                    </table>

                    <?php submit_button(); ?>

                </form>

            </div><!-- .wrap -->

        <?php
        }

    }

}
new WPEX_Tweaks_Admin();