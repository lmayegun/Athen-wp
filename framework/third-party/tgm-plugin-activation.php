<?php
/**
 * Description : Class to modify tgn plugin. 
 * 
 * @package     Athen
 * @subpackage  Closer - View
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Start Class
if ( ! class_exists( 'Athen_Recommend_Plugins' ) ) {

    class Athen_Recommend_Plugins {

        /**
         * Start things up
         *
         * @since 1.6.0
         */
        public function __construct() {
            add_action( 'tgmpa_register', array( &$this, 'config' ) );
        }

        /**
         * Configures the TGMA script
         *
         * @since 1.6.0
         */
        public function config() {

            // Return if function doesn't exist
            if ( ! function_exists( 'tgmpa' ) ) {
                return;
            }
            
            $plugins_dir = get_template_directory_uri() .'/framework/plugins/';

            $plugins = array(
                'js_composer'       => array(
                    'name'              => 'WPBakery Visual Composer',
                    'slug'              => 'js_composer', 
                    'source'            => $plugins_dir .'js_composer.zip',
                    'required'          => false,
                    'force_activation'  => false,
                ),
                'templatera'        => array(
                    'name'              => 'Templatera',
                    'slug'              => 'templatera', 
                    'source'            => $plugins_dir .'templatera.zip',
                    'required'          => false,
                    'force_activation'  => false,
                ),
                'revslider'         => array(
                    'name'              => 'Revolution Slider',
                    'slug'              => 'revslider',
                    'source'            => $plugins_dir .'revslider.zip',
                    'required'          => false,
                    'force_activation'  => false,
                ),
                'contact-form-7'    => array(
                    'name'              => 'Contact Form 7',
                    'slug'              => 'contact-form-7', 
                    'required'          => false,
                    'force_activation'  => false,
                ),
                'woocommerce'       => array(
                    'name'              => 'WooCommerce',
                    'slug'              => 'woocommerce', 
                    'required'          => false,
                    'force_activation'  => false,
                ),  
                'polylang'       => array(
                    'name'              => 'PolyLang',
                    'slug'              => 'polylang', 
                    'required'          => false,
                    'force_activation'  => false,
                ),
            );

            $plugins = apply_filters( 'athen_recommended_plugins', $plugins );

            // Config settings
            $config = array(
                'domain'            => 'athen_transl',
                'default_path'      => '',
                'parent_menu_slug'  => 'themes.php',
                'parent_url_slug'   => 'themes.php',
                'menu'              => 'install-required-plugins',
                'has_notices'       => true,
                'is_automatic'      => false,
                'message'           => '',
                'strings'           => array(
                    'page_title'                      => __( 'Install Required Plugins', 'athen_transl' ),
                    'menu_title'                      => __( 'Install Plugins', 'athen_transl' ),
                    'installing'                      => __( 'Installing Plugin: %s', 'athen_transl' ),
                    'oops'                            => __( 'Something went wrong.', 'athen_transl' ),
                    'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'athen_transl' ),
                    'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'athen_transl' ),
                    'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'athen_transl' ),
                    'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'athen_transl' ),
                    'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'athen_transl' ),
                    'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'athen_transl' ),
                    'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'athen_transl' ),
                    'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'athen_transl' ),
                    'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'athen_transl' ),
                    'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'athen_transl' ),
                    'return'                          => __( 'Return to Required Plugins Installer', 'athen_transl' ),
                    'dashboard'                       => __( 'Return to the dashboard', 'athen_transl' ),
                    'plugin_activated'                => __( 'Plugin activated successfully.', 'athen_transl' ),
                    'activated_successfully'          => __( 'The following plugin was activated successfully:', 'athen_transl' ),
                    'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'athen_transl' ),
                    'dismiss'                         => __( 'Dismiss this notice', 'athen_transl' ),
                )
            );

            tgmpa( $plugins, $config );

        }

    }

}
new Athen_Recommend_Plugins();