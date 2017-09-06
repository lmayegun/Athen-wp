<?php
/**
 * Skin loader function & helpers
 *
 * @package     Total
 * @subpackage  Skins
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.5.4
 */

/**
 * Skins Loader Class
 *
 * @since Total 1.6.3
 */
if ( ! class_exists( 'WPEX_Skin_Loader' ) ) {
    class WPEX_Skin_Loader {

        /**
         * Returns the current skin name
         *
         * @since   1.6.3
         * @var     $current_skin
         * @access  private
         * @return  string
         */
        private $current_skin = 'base';

        /**
         * Start things up
         *
         * @since 1.6.3
         */
        function __construct() {
            
            // Get the current skin
            $this->current_skin = $this->current_skin();

            // Load skin if needed
            if ( $this->current_skin && 'base' != $this->current_skin ) {
                $this->load_skin();
            }

            // Include skins admin panel functions
            require_once( ATHEN_SKIN_DIR . 'admin/skins-admin.php' );

        }

        /**
         * Array of available skins
         *
         * @since 1.6.3
         */
        public function skins_array() {

            $skins = array(
                'base'  => array (
                    'core'          => true,
                    'name'          => __( 'Base', 'athen_transl' ),
                    'screenshot'    => ATHEN_SKIN_DIR_URI .'classes/base/screenshot.jpg',
                ),
                'agent' => array(
                    'core'          => true,
                    'name'          => __( 'Agent', 'athen_transl' ),
                    'class'         => ATHEN_SKIN_DIR .'classes/agent/agent-skin.php',
                    'screenshot'    => ATHEN_SKIN_DIR_URI .'classes/agent/screenshot.jpg',
                ),
                'neat'  => array(
                    'core'          => true,
                    'name'          => __( 'Neat', 'athen_transl' ),
                    'class'         => ATHEN_SKIN_DIR .'classes/neat/neat-skin.php',
                    'screenshot'    => ATHEN_SKIN_DIR_URI .'classes/neat/screenshot.jpg',
                ),
                'flat'  => array(
                    'core'          => true,
                    'name'          => __( 'Flat', 'athen_transl' ),
                    'class'         => ATHEN_SKIN_DIR .'classes/flat/flat-skin.php',
                    'screenshot'    => ATHEN_SKIN_DIR_URI .'classes/flat/screenshot.jpg',
                ),
                'gaps'  => array(
                    'core'          => true,
                    'name'          => __( 'Gaps', 'athen_transl' ),
                    'class'         => ATHEN_SKIN_DIR .'classes/gaps/gaps-skin.php',
                    'screenshot'    => ATHEN_SKIN_DIR_URI .'classes/gaps/screenshot.jpg',
                ),
                /*'minimal-graphical' => array(
                    'core'          => true,
                    'name'          => __( 'Minimal Graphical', 'athen_transl' ),
                    'class'         => ATHEN_SKIN_DIR .'classes/minimal-graphical/minimal-graphical-skin.php',
                    'screenshot'    => ATHEN_SKIN_DIR_URI .'classes/minimal-graphical/screenshot.jpg',
                ),*/
            );

            // Add filter so you can create more skins via child themes or plugins
            $skins = apply_filters( 'athen_skins', $skins );

            // Return skins
            return $skins;
            
        }

        /**
         * Returns the current skin
         *
         * @since 1.6.3
         */
        public function current_skin() {

            // Check URL
            if ( ! empty( $_GET['theme_skin'] ) ) {
                return $_GET['theme_skin'];
            }

            // Get skin from theme mod
            $skin = get_theme_mod( 'theme_skin', 'base' );

            // Apply filters
            $skin = apply_filters( 'athen_active_skin', $skin );

            // Sanitize
            if ( ! $skin ) {
                $skin = 'base';
            }

            // Return current skin
            return $skin;
            
        }

        /**
         * Returns the correct class file for the current skin
         *
         * @since 1.6.3
         */
        public function current_skin_file( $active_skin ) {

            // Nothing needed for the base skin or an empty skin
            if ( 'base' == $active_skin || ! $active_skin ) {
                return;
            }

            // Get currect skin class to load later
            $skins              = $this->skins_array();
            $active_skin_array  = wp_array_slice_assoc( $skins, array( $active_skin ) );
            if ( is_array( $active_skin_array ) ) {
                $class_file = ! empty( $active_skin_array[$active_skin]['class'] ) ? $active_skin_array[$active_skin]['class'] : false;
            }

            // Return class file if one exists
            if ( file_exists( $class_file ) ) {
                return $class_file;
            }
            
        }

        /**
         * Load the active skin
         *
         * @since 1.6.3
         */
        public function load_skin() {

            // Get skin file
            $file = $this->current_skin_file( $this->current_skin );

            // Load the file if it exists
            if ( $file ) {
                require_once( $file );
            }
            
        }


    }

}
new WPEX_Skin_Loader();

/**
 * Helper function that returns skins array
 *
 * @since Total 1.6.3
 */
function athen_skins() {
    $class = new WPEX_Skin_Loader();
    return $class->skins_array();
}

/**
 * Helper function that returns active skin name
 *
 * @since Total 1.6.3
 */
function athen_active_skin() {
    $class = new WPEX_Skin_Loader();
    return $class->current_skin();
}