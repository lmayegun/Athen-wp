<?php
/**
 * Adds image sizes for use with the theme
 *
 * Description : Class use to crop image size - ee theme add on panel
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
if ( ! class_exists( 'Athen_Image_Sizes' ) ) {

    class Athen_Image_Sizes {

        /**
         * Main constructor
         *
         * @access  public
         * @since Total 1.6.3
         */
        public function __construct() {
        
            // Array of image sizes
            $this->sizes = array();

            // Define and add image sizes => Needs low priority for Visual Composer
            add_filter( 'init', array( &$this, 'define_sizes' ), 0 );
            add_filter( 'init', array( &$this, 'add_sizes' ), 1 );

            // Prevent images from cropping when on the fly is enabled
            add_filter( 'intermediate_image_sizes_advanced', array( &$this, 'do_not_crop_on_upload' ) );

            // Create admin panel
            add_action( 'admin_menu', array( &$this, 'add_admin_page' ), 40 );
            add_action( 'admin_init', array( &$this,'register_settings' ) );

        }

        /**
         * Define array of image sizes used by the theme
         *
         * @access  public
         * @return  array
         * @since   2.0.0
         */
        public function define_sizes() {

            // Update sizes array
            $this->sizes = array(
                'blog_entry'    => array(
                    'label'     => __( 'Blog Entry', 'athen_transl' ),
                    'width'     => 'blog_entry_image_width',
                    'height'    => 'blog_entry_image_height',
                    'crop'      => 'blog_entry_image_crop',
                ),
                'blog_post'    => array(
                    'label'     => __( 'Blog Post', 'athen_transl' ),
                    'width'     => 'blog_post_image_width',
                    'height'    => 'blog_post_image_height',
                    'crop'      => 'blog_post_image_crop',
                ),
                'blog_post_full'    => array(
                    'label'     => __( 'Blog Post: Full-Width', 'athen_transl' ),
                    'width'     => 'blog_post_full_image_width',
                    'height'    => 'blog_post_full_image_height',
                    'crop'      => 'blog_post_full_image_crop',
                ),
                'blog_related'    => array(
                    'label'     => __( 'Blog Post: Related', 'athen_transl' ),
                    'width'     => 'blog_related_image_width',
                    'height'    => 'blog_related_image_height',
                    'crop'      => 'blog_related_image_crop',
                ),
            );

            // Apply filters
            $this->sizes = apply_filters( 'athen_image_sizes', $this->sizes );

        }

        /**
         * Filter the image sizes automatically generated when uploading an image.
         *
         * @access  public
         * @return  $meta
         * @link    https://developer.wordpress.org/reference/functions/wp_generate_attachment_metadata/
         * @since   2.0.0
         */
        public function do_not_crop_on_upload( $sizes ) {

            // Remove my image sizes from cropping if image resizing is enabled
            if ( athen_get_mod( 'image_resizing', true ) && ! empty ( $this->sizes ) ) {
                foreach( $this->sizes as $size => $args ) {
                    unset( $sizes[$size] );
                }
            }

            // Return $meta
            return $sizes;

        }

        /**
         * Retrieves cached CSS or generates the responsive CSS
         *
         * @access  public
         * @return  void
         * @link    http://codex.wordpress.org/Plugin_API/Action_Reference/after_setup_theme
         * @since   2.0.0
         */
        public function add_sizes() {
            
            // Get sizes array
            $sizes = $this->sizes;

            // Loop through sizes
            foreach ( $sizes as $size => $args ) {

                // Define dims
                $size = $size;

                // Extract args
                extract( $args );

                // Get theme mods
                $width  = athen_get_mod( $width, '9999' );
                $height = athen_get_mod( $height, '9999' );
                $crop   = athen_get_mod( $crop );
                $crop   = $crop ? $crop : 'center-center';

                // Turn crop into array
                $crop = ( 'center-center' == $crop ) ? 1 : explode( '-', $crop );

                // If image resizing is disabled and a width or height is defined add image size
                if ( $width || $height ) {
                    add_image_size( $size, $width, $height, $crop );
                }

            }

        }

        /**
         * Add sub menu page
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_page
         */
        public function add_admin_page() {
            add_submenu_page(
                ATHEN_THEME_PANEL_SLUG,
                __( 'Image Sizes', 'athen_transl' ),
                __( 'Image Sizes', 'athen_transl' ),
                'administrator',
                ATHEN_THEME_PANEL_SLUG . '-image-sizes',
                array( $this, 'create_admin_page' )
            );
        }

        /**
         * Register a setting and its sanitization callback.
         *
         * @link http://codex.wordpress.org/Function_Reference/register_setting
         */
        function register_settings() {
            register_setting( 'athen_image_sizes', 'athen_image_sizes', array( &$this, 'admin_sanitize' ) ); 
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
            $checkboxes = array( 'retina', 'image_resizing' );

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
            $options = '';
            return $options;

        }

        /**
         * Settings page output
         */
        function create_admin_page() { ?>
            <div class="wrap">
                <h2><?php _e( 'Image Sizes', 'athen_transl' ); ?></h2>
                <p><?php _e( 'Define the exact cropping for all the featured images on your site. Leave the width and height empty to display the full image. Set any height to "9999" or empty to disable cropping and simply resize the image to the corresponding width. All image sizes defined below will be added to the list of WordPress image sizes.', 'athen_transl' ); ?></p>
                <form method="post" action="options.php">
                    <?php settings_fields( 'athen_image_sizes' ); ?>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row"><?php _e( 'Image Resizing', 'athen_transl' ); ?></th>
                            <td>
                                <fieldset>
                                    <label>
                                        <input id="athen_image_resizing" type="checkbox" name="athen_image_sizes[image_resizing]" <?php checked( athen_get_mod( 'image_resizing', true ) ); ?>>
                                            <?php _e( 'Enable on the fly image cropping.', 'athen_transl' ); ?>
                                            <p class="description"><?php _e( 'This theme includes an advanced "on the fly" cropping function that uses the safe and native WordPress function "wp_get_image_editor". If enabled whenever you upload a new image it will NOT be cropped into all the different sizes defined below, but rather cropped when loaded on the front-end (cropped once then saved to your uploads directory), thus saving precious server space. However it may conflict with with certain CDN\'s, so you can disable if needed. If disabled you will need to "regenerate your thumbnails".', 'athen_transl' ); ?></p>
                                    </label>
                                </fieldset>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php _e( 'Retina', 'athen_transl' ); ?></th>
                            <td>
                                <fieldset>
                                    <label>
                                        <input id="athen_retina" type="checkbox" name="athen_image_sizes[retina]" <?php checked( athen_get_mod( 'retina' ), true ); ?>> <?php _e( 'Enable retina support for your site (via retina.js).', 'athen_transl' ); ?>
                                    </label>
                                </fieldset>
                            </td>
                        </tr>

                        <?php
                        // Get sizes & crop locations
                        $sizes            = $this->sizes;
                        $crop_locations   = athen_image_crop_locations(); ?>

                        <?php
                        // Loop through all sizes
                        foreach ( $sizes as $size => $args ) : ?>

                            <?php
                            // Extract args
                            extract( $args );

                            // Label is required
                            if ( ! $label ) {
                                continue;
                            }

                            // Define values
                            $width_value    = athen_get_mod( $width );
                            $height_value   = athen_get_mod( $height );
                            $crop_value     = athen_get_mod( $crop ); ?>

                            <tr valign="top">
                                <th scope="row"><?php echo $label; ?></th>
                                <td>
                                    <label for="<?php echo $width; ?>"><?php _e( 'Width', 'athen_transl' ); ?></label>
                                    <input name="athen_image_sizes[<?php echo $width; ?>]" type="number" step="1" min="0" value="<?php echo $width_value; ?>" class="small-text" />

                                    <label for="<?php echo $height; ?>"><?php _e( 'Height', 'athen_transl' ); ?></label>
                                    <input name="athen_image_sizes[<?php echo $height; ?>]" type="number" step="1" min="0" value="<?php echo $height_value; ?>" class="small-text" />
                                    <label for="<?php echo $crop; ?>"><?php _e( 'Crop Location', 'athen_transl' ); ?></label>

                                    <select name="athen_image_sizes[<?php echo $crop; ?>]">
                                        <?php foreach ( $crop_locations as $key => $label ) { ?>
                                            <option value="<?php echo $key; ?>" <?php selected( $key, $crop_value, true ); ?>><?php echo $label; ?></option>
                                        <?php } ?>
                                    </select>

                                </td>
                            </tr>

                        <?php endforeach; ?>

                    </table>

                    <?php submit_button(); ?>

                </form>

                <div id="athen_regenerating_tools" style="display:none;">
                    <hr />
                    <p><?php _e( 'Useful Plugins:', 'athen_transl' ); ?> <a href="https://wordpress.org/plugins/regenerate-thumbnails/" target="_blank"><?php _e( 'Regenerate Thumbnails', 'athen_transl' ); ?></a> | <a href="https://wordpress.org/plugins/image-cleanup/screenshots/" target="_blank"><?php _e( 'Image Cleanup', 'athen_transl' ); ?></a></p>
                </div><!-- #athen_regenerating_tools -->

            </div><!-- .wrap -->

            <script>
                ( function( $ ) {
                    "use strict";

                    // Disable and hide retina if image resizing is deleted
                    var $imageResizing      = $( '#athen_image_resizing' ),
                        $imageResizingVal   = $imageResizing.prop( 'checked' );

                    // Check initial val
                    if ( ! $imageResizingVal ) {
                        $( '#athen_retina' ).attr('checked', false );
                        $( '#athen_retina' ).closest( 'tr' ).hide();
                        $( '#athen_regenerating_tools' ).show();
                    }

                    // Check on change
                    $( $imageResizing ).change(function () {
                        var $checked    = $( this ).prop('checked');
                        if ( $checked ) {
                            $( '#athen_retina' ).closest( 'tr' ).show();
                            $( '#athen_regenerating_tools' ).hide();
                            $( '#athen_retina' ).attr('checked', true );
                        } else {
                            $( '#athen_retina' ).attr('checked', false );
                            $( '#athen_retina' ).closest( 'tr' ).hide();
                            $( '#athen_regenerating_tools' ).show();
                        }
                    });

                } ) ( jQuery );

            </script>
        <?php
        }

    }

}
new Athen_Image_Sizes();