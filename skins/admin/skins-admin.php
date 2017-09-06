<?php
/**
 * Creates the admin panel for the customizer
 *
 * @package     Total
 * @subpackage  Skins
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       1.5.3
 * @version     2.1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Only Needed in the admin
if ( ! is_admin() ) {
    return;
}

/**
 * Creates a beautiful admin panel for selecting your theme skin
 *
 * @since 1.6.0
 */
if ( ! class_exists( 'WPEX_Skins_Admin' ) ) {

    class WPEX_Skins_Admin {

        /**
         * Start things up
         */
        public function __construct() {
            add_action( 'admin_menu', array( $this, 'add_page' ), 20 );
            add_action( 'admin_enqueue_scripts', array( $this, 'scripts' ) );
            add_action( 'admin_init', array( $this, 'register_settings' ) );
        }

        /**
         * Add sub menu page
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_page
         */
        function add_page() {
            add_submenu_page(
                ATHEN_THEME_PANEL_SLUG,
                __( 'Theme Skins', 'athen_transl' ),
                __( 'Theme Skins', 'athen_transl' ),
                'administrator',
                ATHEN_THEME_PANEL_SLUG .'-skins',
                array( $this, 'create_admin_page' )
            );
        }

        /**
         * Load CSS and JS for the skins admin panel
         *
         * @link http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
         */
        function scripts( $hook ) {
            if ( ATHEN_ADMIN_PANEL_LOAD_PAGE .'-skins' != $hook ) {
                return;
            }
            wp_enqueue_style( 'scripts', ATHEN_SKIN_DIR_URI . 'admin/assets/skins-admin.css' );
            wp_enqueue_script( 'athen_skins_admin_js', ATHEN_SKIN_DIR_URI . 'admin/assets/skins-admin.js', array( 'jquery' ), '1.0', true );
        }
        
        /**
         * Register a setting and its sanitization callback.
         *
         * @link http://codex.wordpress.org/Function_Reference/register_setting
         */
        function register_settings() {
            register_setting(
                'athen_skins_options',
                'theme_skin'
            );
            register_setting(
                'athen_skins_options',
                'athen_set_theme_defaults',
                array( $this, 'sanitize' )
            );
        }

        /**
         * Sanitization callback
         */
        function sanitize( $options ) {
            $skin = ! empty ( $options['skin'] ) ? $options['skin'] : 'base';
            set_theme_mod( 'theme_skin', $skin );
            $options = '';
        }

        /**
         * Settings page output
         */
        function create_admin_page() { ?>

            <div class="wrap wpex-skins-admin">

                <h2><?php _e( 'Theme Skins', 'athen_transl' ); ?></h2>

                <?php
                // Get theme skins
                $skins = athen_skins();

                // Current skin from site_theme option
                $option = get_theme_mod( 'theme_skin', 'base' );

                // If Option isn't in skins array set to base
                if ( ! array_key_exists( $option, $skins ) ) {
                    $option = 'base';
                }

                // Get fallback from redux
                if ( ! $option ) {
                    $data   = get_option( 'athen_options' );
                    $option = isset( $data['site_theme'] ) ? $data['site_theme'] : 'base';
                } ?>

                <form method="post" action="options.php">

                    <?php settings_fields( 'athen_skins_options' ); ?>

                    <div class="wpex-skins-select theme-browser" id="theme_skin">

                        <?php
                        // Loop through skins
                        foreach ( $skins as $key => $optionue ) {
                        $checked = $active = '';
                        if ( ! empty( $option ) && $option == $key ) {
                            $checked    = 'checked';
                            $active     = 'active';
                        } ?>

                        <div class="wpex-skin <?php echo $active; ?> theme">

                            <input type="radio" id="wpex-skin-<?php echo $key; ?>" name="theme_skin" value="<?php echo $key; ?>" <?php echo $checked; ?> class="wpex-skin-radio" />
                            <div class="theme-screenshot">
                                <img src="<?php echo $optionue['screenshot'] ?>" alt="<?php _e( 'Screenshot', 'athen_transl' ); ?>" />
                            </div>
                            <h3 class="theme-name">
                                <?php if ( 'active' == $active ) {
                                    echo '<strong>'. __( 'Active', 'athen_transl' ). ':</strong> ';
                                } ?>
                                <?php echo $optionue[ 'name' ]; ?>
                            </h3>
                        </div>
                        <?php } ?>

                    </div><!-- .wpex-skin -->

                    <p style="margin: 0 0 30px;display:none;">
                        <input type="hidden" name="athen_set_theme_defaults[skin]" id="wpex-hidden-skin-val" value="<?php echo $option; ?>">
                    </p>

                    <?php submit_button(); ?>

                </form>

            </div><!-- .wpex-skins-select -->

        <?php }

    }

}
new WPEX_Skins_Admin();