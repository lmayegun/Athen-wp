<?php
/**
 * Main Customizer functions
 * Description : Class for deciding which panel(and section + setting + controls ) 
 *               to be set for theme. This class  
 * 
 * @package     Athen
 * @subpackage  Closer - Controller / view / Model (especially styling and typography)
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 * Associate :  with different area in the theme and conditional area of theme
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Start Class
if ( ! class_exists( 'Athen_Customizer' ) ) {

    class Athen_Customizer {

        /**
         * Start things up
         */
        public function __construct() {

            // Add the page to the admin menu
            add_action( 'admin_menu', array( $this, 'add_admin_page' ), 99 );

            // Add customizer to adminbar
            add_action( 'admin_bar_menu', array( $this, 'adminbar_menu' ), 999 );

            // Register page options
            add_action( 'admin_init', array( $this,'admin_options' ) );

            // Enqueue scripts
            add_action( 'admin_enqueue_scripts',array( $this,'admin_scripts' ) );

            // Adds CSS for customizer custom controls
            add_action( 'customize_controls_print_styles', array( $this, 'controls_print_styles' ) );

            // Register and unregister Customizer settings
            add_action( 'customize_register', array( $this, 'customize_register' ) );

            // Customizer directory paths
            $this->customizer_dir_uri   = ATHEN_FRAMEWORK_DIR_URI .'customiser-wp/';
            $this->customizer_dir       = ATHEN_FRAMEWORK_DIR .'customiser-wp/';

            // Define array of customizer sections
            $this->sections = array();

            // Create an array of registered theme customizer panels
            $this->panels = array(
                'title_tagline'     => __( 'Site Title & Tagline', 'athen_transl' ),
                'static_front_page' => __( 'Static Front Page', 'athen_transl' ),
                'nav'               => __( 'Navigation', 'athen_transl' ),
                'widgets'           => __( 'Widgets', 'athen_transl' ),
                'general'           => __( 'General Options', 'athen_transl' ),
                'layout'            => __( 'Layout', 'athen_transl' ),
                'headertop'         => __( 'Top Header', 'athen_transl' ),
                'header'            => __( 'Main Header', 'athen_transl' ),
                'menu'              => __( 'Menu', 'athen_transl' ),
                'search'            => __( 'Search', 'athen_transl' ),
                'socials'           => __( 'Socials', 'athen_transl' ),
                'togglebar'         => __( 'Toggle Bar', 'athen_transl' ),
                'sidebar'           => __( 'Sidebar', 'athen_transl' ),
                'blog'              => __( 'Blog', 'athen_transl' ),
                'portfolio'         => __( 'Portfolio', 'athen_transl' ),
                'staff'             => __( 'Staff', 'athen_transl' ),
                'typography'        => __( 'Typography', 'athen_transl' ),
                'testimonials'      => __( 'Testimonials', 'athen_transl' ),
                'woocommerce'       => __( 'WooCommerce', 'athen_transl' ),
                'visual_composer'   => __( 'Visual Composer', 'athen_transl' ),
                'footer'            => __( 'Footer', 'athen_transl' ),
                'styling'           => __( 'Styling', 'athen_transl' ),
            );

            // Disable these panels by default
            $this->exclude_panels_from_defaults = array( 'title_tagline', 'widgets', 'nav' );

            // Apply filters
            $this->panels = apply_filters( 'athen_customizer_panels', $this->panels );

        }

        /**
         * Add sub menu page for the custom CSS input
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_page
         */
        public function add_admin_page() {

            add_submenu_page(
                ATHEN_THEME_PANEL_SLUG,
                __( 'Customizer', 'athen_transl' ),
                __( 'Customizer', 'athen_transl' ),
                'administrator',
                ATHEN_THEME_PANEL_SLUG .'-customizer',
                array( $this, 'create_admin_page' )
            );

        }

        /**
         * Add Customizer link to the adminbar since it will be used frequently
         *
         * @link http://codex.wordpress.org/Class_Reference/WP_Admin_Bar/add_node
         */
        public function adminbar_menu( $wp_admin_bar ) {

            // Make sure user can manage options
            if ( ! current_user_can( 'manage_options' ) ) {
                return;
            }

            // URL to the customizer
            $url = admin_url( 'admin.php?page=wpex-customizer-editor' );

            // Add Node arguments
            $args = array(
                'id'    => 'athen_customizer',
                'title' => __( 'Customizer', 'athen_transl' ),
                'href'  => $url,
                'meta'  => array(
                    'class' => 'wpex-customizer'
                ),
            );

            // Add athen_customizer node to the admin bar 
            $wp_admin_bar->add_node( $args );

        }

        /**
         * Load scripts
         *
         * @link http://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
         */
        public function admin_scripts( $hook ) {

            // Make sure scripts are added only when needed
            if ( ATHEN_ADMIN_PANEL_LOAD_PAGE . '-customizer' != $hook ) {
                return;
            }

            // Load customizer-editor CSS
            wp_enqueue_style(
                'wpex-admin',
                $this->customizer_dir_uri .'assets/customizer-editor.css'
            );

        }

        /**
         * Function that will register admin page options.
         *
         * @link http://codex.wordpress.org/Function_Reference/register_setting
         */
        public function admin_options() {

            register_setting( 'athen_customizer_editor', 'athen_customizer_panels' );

        }

        /**
         * Settings page output
         */
        public function create_admin_page() { ?>

            <div class="wrap">

                <h2><?php _e( 'Customizer', 'athen_transl' ); ?></h2>

                <p>
                    * <?php _e( 'The customizer is where you will find all your theme options', 'athen_transl' ); ?>
                    <br />
                    * <?php _e( 'Disabling sections will help speed up the WordPress customizer.', 'athen_transl' ); ?>
                    <br />
                    * <?php _e( 'Disabling a section will NOT remove your options, it will simply hide the section from the customizer to speed things up.', 'athen_transl' ); ?>
                </p>

                <br />

                <h2 class="nav-tab-wrapper">
                    <a href="#" class="nav-tab nav-tab-active"><?php _e( 'Enable Panels', 'athen_transl' ); ?></a>
                    <a href="<?php echo admin_url( 'customize.php' ); ?>"  class="nav-tab" target="_blank" ><?php _e( 'Customize', 'athen_transl' ); ?></a>
                </h2>

                <div style="margin-top:20px;">
                    <a href="#" class="wpex-customizer-check-all"><?php _e( 'Check all', 'athen_transl' ); ?></a> | <a href="#" class="wpex-customizer-uncheck-all"><?php _e( 'Uncheck all', 'athen_transl' ); ?></a>
                </div>

                <form method="post" action="options.php">

                    <?php settings_fields( 'athen_customizer_editor' ); ?>

                    <table class="form-table wpex-customizer-editor-table">
                        <?php
                        // Get panels
                        $panels = $this->panels;

                        // Set defaults
                        $defaults = array();
                        foreach ( $this->panels as $key => $val ) {
                            if ( ! in_array( $key, $this->exclude_panels_from_defaults ) ) {
                                $defaults[$key] = 'on';
                            }
                        }

                        // Check if post types are enabled
                        $post_types = athen_theme_post_types();

                        // Get options and set defaults
                        $options = get_option( 'athen_customizer_panels', $defaults );

                        // Loop through panels and add checkbox
                        foreach ( $panels as $id => $title ) {
                            // Hide any post type that is disabled
                            if ( in_array( $id, $post_types ) && ! get_theme_mod( $id .'_enable', true ) ) {
                                continue;
                            }
                            // Get option
                            $option = isset( $options[$id] ) ? 'on' : false; ?>
                            <tr valign="top">
                            <th scope="row"><?php echo $title; ?></th>
                            <td>
                                <fieldset>
                                    <input class="wpex-customizer-editor-checkbox" type="checkbox" name="athen_customizer_panels[<?php echo $id; ?>]"<?php checked( $option, 'on' ); ?>>
                                    <?php if ( 'styling' == $id ) {
                                        echo '<span class="description">'. __( 'Styling options area added throughout for changing colors, paddings, borders, etc.', 'athen_transl' ) .'</span>';
                                    } ?>
                                </fieldset>
                            </td>
                            </tr>
                        <?php } ?>
                    </table>

                    <?php submit_button(); ?>

                </form>

            </div><!-- .wrap -->

            <script>
                (function($) {
                    "use strict";
                        $( '.wpex-customizer-check-all' ).click( function() {
                            $('.wpex-customizer-editor-checkbox').each( function() {
                                this.checked = true;
                            } );
                            return false;
                        } );
                        $( '.wpex-customizer-uncheck-all' ).click( function() {
                            $('.wpex-customizer-editor-checkbox').each( function() {
                                this.checked = false;
                            } );
                            return false;
                        } );
                } ) ( jQuery );
            </script>

        <?php } // END create_admin_page()

        /**
         * Adds CSS for customizer custom controls
         *
         * @link http://codex.wordpress.org/Plugin_API/Action_Reference/customize_controls_print_styles
         */
        public function controls_print_styles() {

            wp_enqueue_style(
                'wpex-customizer-style',
                $this->customizer_dir_uri . 'assets/customizer-style.css',
                '1.0'
            );
            
        }

        /**
         * Registers new controls
         * Removes default customizer sections and settings
         * Adds new customizer sections, settings & controls
         *
         * @link http://codex.wordpress.org/Theme_Customization_API
         */
        public function customize_register( $wp_customize ) {

            // Get panels
            $panels = $this->panels;

            // Default panels
            $defaults = array();
            foreach ( $panels as $key => $val ) {
                if ( ! in_array( $key, $this->exclude_panels_from_defaults ) ) {
                    $defaults[$key] = 'on';
                }
            }

            // Get array of enabled panels
            $enabled_panels = get_option( 'athen_customizer_panels', $defaults );
            
            // Remove default sections
            $wp_customize->remove_section( 'themes' );
            $wp_customize->remove_section( 'background_image' );

            // Remove default settings
            $wp_customize->remove_setting( 'background_color' );
            $wp_customize->remove_setting( 'background_image' );

            // Remove default controls
            $wp_customize->remove_control( 'background_color' );
            $wp_customize->remove_control( 'background_image' );
            $wp_customize->remove_control( 'header_textcolor' );

            if ( ! isset( $enabled_panels['widgets'] ) ) {
                $wp_customize->remove_panel( 'widgets' );
            }

            if ( ! isset( $enabled_panels['nav'] ) ) {
                $wp_customize->remove_section( 'nav' );
            }

            if ( ! isset( $enabled_panels['title_tagline'] ) ) {
                $wp_customize->remove_section( 'title_tagline' );
            }

            if ( ! isset( $enabled_panels['static_front_page'] ) ) {
                $wp_customize->remove_section( 'static_front_page' );
            }

            // Include custom controls
            require_once( $this->customizer_dir . 'controls.php' );

            // Unset panels that we don't need to grab
            $exclude_panels = array( 'title_tagline', 'static_front_page', 'nav', 'widgets', 'typography', 'styling' );
            foreach ( $exclude_panels as $exclude_panel ) {
                if ( isset( $enabled_panels[$exclude_panel] ) ) {
                    unset( $enabled_panels[$exclude_panel] );
                }
            }

            // If there are panels enabled let's add them and get their controls
            if ( $enabled_panels ) {

                // Add Panels
                $count = 140;
                foreach( $panels as $key => $val ) {

                    // Add to counter for priority
                    $count++;

                    // Double check to make sure panel is actually enabled
                    if ( isset( $enabled_panels[$key] ) ) {

                        // Register the new panel
                        $wp_customize->add_panel( 'athen_'. $key, array(
                            'priority'      => $count,
                            'capability'    => 'edit_theme_options',
                            'title'         => $val,
                        ) );

                        // Include panels
                        require_once( $this->customizer_dir . 'settings/'. $key .'.php' );

                    }

                }

                // Create the new customizer sections
                $this->create_sections( $wp_customize, $this->sections );

            }

        } // END customize_register()

        /**
         * Creates the Sections and controls for the customizer
         *
         * @link http://codex.wordpress.org/Theme_Customization_API
         */
        public function create_sections( $wp_customize ) {

            // Return if $this->sections var is empty
            if ( empty( $this->sections ) ) {
                return;
            }

            // Loop through sections and add create the customizer sections, settings & controls
            $section_priority = 0;
            foreach ( $this->sections as $section_id => $section ) { 
                $section_priority++;

                $description = isset( $section['desc'] ) ? $section['desc'] : '';

                // Add Section
                $wp_customize->add_section( $section_id, array(
                    'title'         => $section['title'],
                    'priority'      => $section_priority,
                    'panel'         => $section['panel'],
                    'description'   => $description,
                ) );

                // Add settings+controls
                $settings           = $section['settings'];
                $control_priority   = 0;
                foreach ( $settings as $setting ) {
                    $control_priority++;

                    $id                 = $setting['id']; // Required no need to check
                    $transport          = isset( $setting['transport'] ) ? $setting['transport'] : 'refresh';
                    $default            = isset( $setting['default'] ) ? $setting['default'] : '';
                    $control_label      = $setting['control']['label']; // Required no need to check
                    $control_desc       = isset( $setting['control']['desc'] ) ? $setting['control']['desc'] : '';
                    $control_type       = isset( $setting['control']['type'] ) ? $setting['control']['type'] : 'text';
                    $control_choices    = isset( $setting['control']['choices'] ) ? $setting['control']['choices'] : '';

                    // Control object
                    if ( isset( $setting['control']['object'] ) ) {
                        $control_object = $setting['control']['object'];
                    } elseif ( 'color' == $control_type ) {
                        $control_object = 'WP_Customize_Color_Control';
                    } else {
                        $control_object = 'WP_Customize_Control';
                    }

                    // If $id defined add setting and control
                    if ( $id ) {
                        $wp_customize->add_setting( $id, array(
                            'type'              => 'theme_mod',
                            'transport'         => $transport,
                            'default'           => $default,
                            'sanitize_callback' => false,
                        ) );
                        $wp_customize->add_control( new $control_object ( $wp_customize, $id, array(
                            'label'         => $control_label,
                            'section'       => $section_id,
                            'settings'      => $id,
                            'priority'      => $control_priority,
                            'description'   => $control_desc,
                            'type'          => $control_type,
                            'choices'       => $control_choices,
                        ) ) );
                    }
                }
            }

        } // END create_sections()

    }

}

$athen_customizer = new Athen_Customizer();

// Include Typography & Styling Classes
require_once( ATHEN_FRAMEWORK_DIR .'customiser-wp/settings/typography.php' );
require_once( ATHEN_FRAMEWORK_DIR .'customiser-wp/settings/styling.php' );