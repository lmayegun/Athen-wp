<?php
/**
 * Descrition   : Adds custom metaboxes to the WordPress categories
 *
 * @package     Athen
 * @subpackage  Closer - controller/view
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// The Metabox class
if ( ! class_exists( 'Athen_Post_Metaboxes' ) ) {

    class Athen_Post_Metaboxes {

        /**
         * Vars
         *
         * @since 1.0.0
         */
        protected $class_dir = '';
 
        /**
         * Register this class with the WordPress API
         *
         * @since 1.0.0
         */
        public function __construct() {

            // Add metabox
            add_action( 'add_meta_boxes', array( $this, 'post_meta' ), 11 );

            // Save metabox
            add_action( 'save_post', array( $this, 'save_meta_data' ) );

            // Enqueue scripts
            add_action( 'admin_enqueue_scripts', array( $this, 'scripts' ) );

            // Define class variables
            $this->class_dir    = ATHEN_FRAMEWORK_DIR .'meta/post-meta/';
            $this->types        = '';
        }

        /**
         * The function responsible for creating the actual meta box.
         *
         * @since 1.0.0
         */
        public function post_meta( $post_type ) {
            $types  = array( 'post', 'page', 'portfolio', 'staff', 'testimonials', 'page', 'product' );
            $types  = apply_filters( 'athen_main_metaboxes_post_types', $types );
            $types  = array_combine( $types, $types );
            
            if ( in_array( $post_type, $types ) ) {
                $obj = get_post_type_object( $post_type );
                add_meta_box(
                    'wpex-metabox',
                    $obj->labels->singular_name . ' '. __( 'Settings', 'athen_transl' ),
                    array( $this, 'display_meta_box' ),
                    $post_type,
                    'normal',
                    'high'
                );
            }
            $this->types = $types;
        }

        /**
         * Enqueue scripts and styles needed for the metaboxes
         *
         * @since 1.0.0
         */
        public function scripts() {

            $dir = ATHEN_FRAMEWORK_DIR_URI .'post-types/post-metaboxes/assets/';

            // Core WP scripts
            wp_enqueue_media();
            wp_enqueue_style( 'wp-color-picker' );

            // Metaboxes JS
            wp_enqueue_script(
                'wpex-metabox',
                $dir .'js/metabox.js',
                array( 'media-upload', 'wp-color-picker' ),
                false,
                true
            );
            $localize = array(
                'reset'     => __( 'Reset Settings', 'athen_transl' ),
                'cancel'    => __( 'Cancel Reset', 'athen_transl' )
            );
            wp_localize_script('wpex-metabox','wpexMetabox', $localize);

            // Metaboxes Styles
            wp_enqueue_style('wpex-metabox', $dir .'css/metabox.css', array( 'wp-color-picker' ),false);

        }

        /**
         * Renders the content of the meta box.
         *
         * @since 1.0.0
         */
        public function display_meta_box( $post ) {

            // Add an nonce field so we can check for it later.
            wp_nonce_field( 'athen_metabox', 'athen_metabox_nonce' );

            // Get current post data
            $post_id    = $post->ID;
            $post_type  = get_post_type();

            // Get tabs
            $tabs = $this->tabs_array();

            // Make sure tabs aren't empty
            if ( empty( $tabs ) ) {
                echo '<p>Hey your settings are empty, something is going on please contact your webmaster</p>';
                return;
            }

            // Store tabs that should display on this specific page in an array for use later
            $active_tabs = array();
            foreach ( $tabs as $tab ) {
                $tab_post_type = isset( $tab['post_type'] ) ? $tab['post_type'] : '';
                if ( ! $tab_post_type ) {
                    $display_tab = true;
                } elseif ( in_array( $post_type, $tab_post_type ) ) {
                    $display_tab = true;
                } else {
                    $display_tab = false;
                }
                if ( $display_tab ) {
                    $active_tabs[] = $tab;
                }
            } ?>

            <ul class="wp-tab-bar">
                <?php
                // Output tab links
                $count ='';
                foreach ( $active_tabs as $tab ) {
                    $count++;
                    $li_class = ( '1' == $count ) ? ' class="wp-tab-active"' : '';
                    // Define tab title
                    $tab_title = $tab['title'] ? $tab['title'] : __( 'Other', 'athen_transl' ); ?>
                    <li<?php echo $li_class; ?>>
                        <a href="javascript:;" data-tab="#wpex-mb-tab-<?php echo $count; ?>"><?php echo $tab_title; ?></a>
                    </li>
                <?php } ?>
            </ul><!-- .wpex-mb-tabnav -->

            <?php
            // Output tab sections
            $count = '';
            foreach ( $active_tabs as $tab ) {
                $count++; ?>
                <div id="wpex-mb-tab-<?php echo $count; ?>" class="wp-tab-panel clr">
                    <table class="form-table">
                        <?php
                        // Loop through sections and store meta output
                        foreach ( $tab['settings'] as $setting ) {

                            // Vars
                            $meta_id        = $setting['id'];
                            $title          = $setting['title'];
                            $hidden         = isset ( $setting['hidden'] ) ? $setting['hidden'] : false;
                            $type           = isset ( $setting['type'] ) ? $setting['type'] : 'text';
                            $default        = isset ( $setting['default'] ) ? $setting['default'] : '';
                            $description    = isset ( $setting['description'] ) ? $setting['description'] : '';
                            $meta_value     = get_post_meta( $post_id, $meta_id, true );
                            $meta_value     = $meta_value ? $meta_value : $default; ?>

                            <tr<?php if ( $hidden ) echo ' style="display:none;"'; ?> id="<?php echo $meta_id; ?>_tr">
                                <th>
                                    <label for="athen_main_layout"><strong><?php echo $title; ?></strong></label>
                                    <?php
                                    // Display field description
                                    if ( $description ) { ?>
                                        <p class="wpex-mb-description"><?php echo $description; ?></p>
                                    <?php } ?>
                                </th>

                                <?php
                                // Text Field
                                if ( 'text' == $type ) { ?>

                                    <td><input name="<?php echo $meta_id; ?>" type="text" value='<?php echo $meta_value; ?>'></td>

                                <?php }

                                // Link field
                                elseif ( 'link' == $type ) { ?>

                                    <td><input name="<?php echo $meta_id; ?>" type="text" value="<?php echo esc_url( $meta_value ); ?>"></td>

                                <?php }

                                // Textarea Field
                                elseif ( 'textarea' == $type ) {
                                    $rows = isset ( $setting['rows'] ) ? $setting['rows'] : '4';?>

                                    <td>
                                        <textarea rows="<?php echo $rows; ?>" cols="1" name="<?php echo $meta_id; ?>" type="text" class="wpex-mb-textarea"><?php echo $meta_value; ?></textarea>
                                    </td>

                                <?php }

                                // Code Field
                                elseif ( 'code' == $type ) { ?>

                                    <td>
                                        <textarea rows="1" cols="1" name="<?php echo $meta_id; ?>" type="text" class="wpex-mb-textarea-code"><?php echo $meta_value; ?></textarea>
                                    </td>

                                <?php }

                                // Checkbox
                                elseif ( 'checkbox' == $type ) {

                                    $meta_value = ( 'on' == $meta_value ) ? false : true; ?>
                                    <td><input name="<?php echo $meta_id; ?>" type="checkbox" <?php checked( $meta_value, true, true ); ?>></td>

                                <?php }

                                // Select
                                elseif ( 'select' == $type ) {

                                    $options = isset ( $setting['options'] ) ? $setting['options'] : '';
                                    if ( ! empty( $options ) ) { ?>
                                        <td><select id="<?php echo $meta_id; ?>" name="<?php echo $meta_id; ?>">
                                        <?php foreach ( $options as $option_value => $option_name ) { ?>
                                            <option value="<?php echo $option_value; ?>" <?php selected( $meta_value, $option_value, true ); ?>><?php echo $option_name; ?></option>
                                        <?php } ?>
                                        </select></td>
                                    <?php }

                                }

                                // Select
                                elseif ( 'color' == $type ) { ?>

                                    <td><input name="<?php echo $meta_id; ?>" type="text" value="<?php echo $meta_value; ?>" class="wpex-mb-color-field"></td>

                                <?php }

                                // Media
                                elseif ( 'media' == $type ) {

                                    // Validate data if array - old Redux cleanup
                                    if ( is_array( $meta_value ) ) {
                                        if ( ! empty( $meta_value['url'] ) ) {
                                            $meta_value = $meta_value['url'];
                                        } else {
                                            $meta_value = '';
                                        }
                                    } ?>
                                    <td>
                                        <div class="uploader">
                                        <input type="text" name="<?php echo $meta_id; ?>" value="<?php echo $meta_value; ?>">
                                        <input class="wpex-mb-uploader button-secondary" name="<?php echo $meta_id; ?>" type="button" value="<?php _e( 'Upload', 'athen_transl' ); ?>" />
                                        <?php /* if ( $meta_value ) {
                                                if ( is_numeric( $meta_value ) ) {
                                                    $meta_value = wp_get_attachment_image_src( $meta_value, 'full' );
                                                    $meta_value = $meta_value[0];
                                                } ?>
                                            <div class="wpex-mb-thumb" style="padding-top:10px;"><img src="<?php echo $meta_value; ?>" height="40" width="" style="height:40px;width:auto;max-width:100%;" /></div>
                                        <?php } */ ?>
                                        </div>
                                    </td>

                                <?php }

                                // Editor
                                elseif ( 'editor' == $type ) {
                                    $teeny          = isset( $setting['teeny'] ) ? $setting['teeny'] : false;
                                    $rows           = isset( $setting['rows'] ) ? $setting['rows'] : '10';
                                    $media_buttons  = isset( $setting['media_buttons'] ) ? $setting['media_buttons'] : true; ?>
                                    <td><?php wp_editor( $meta_value, $meta_id, array(
                                        'textarea_name' => $meta_id,
                                        'teeny'         => $teeny,
                                        'textarea_rows' => $rows,
                                        'media_buttons' => $media_buttons,
                                    ) ); ?></td>
                                <?php } ?>
                            </tr>

                        <?php } ?>
                    </table>
                </div>
            <?php } ?>

            <div class="wpex-mb-reset">
                <a class="button button-secondary wpex-reset-btn"><?php _e( 'Reset Settings', 'athen_transl' ); ?></a>
                <div class="wpex-reset-checkbox"><input type="checkbox" name="athen_metabox_reset"> <?php _e( 'Are you sure? Check this box, then update your post to reset all settings.', 'athen_transl' ); ?></div>
            </div>

            <div class="clear"></div>

        <?php }

        /**
         * Save metabox data
         *
         * @since 1.0.0
         */
        public function save_meta_data( $post_id ) {

            /*
             * We need to verify this came from our screen and with proper authorization,
             * because the save_post action can be triggered at other times.
             */

            // Check if our nonce is set.
            if ( ! isset( $_POST['athen_metabox_nonce'] ) ) {
                return;
            }

            // Verify that the nonce is valid.
            if ( ! wp_verify_nonce( $_POST['athen_metabox_nonce'], 'athen_metabox' ) ) {
                return;
            }

            // If this is an autosave, our form has not been submitted, so we don't want to do anything.
            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
                return;
            }

            // Check the user's permissions.
            if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

                if ( ! current_user_can( 'edit_page', $post_id ) ) {
                    return;
                }

            } else {

                if ( ! current_user_can( 'edit_post', $post_id ) ) {
                    return;
                }
            }

            /* OK, it's safe for us to save the data now. Now we can loop through fields */

            // Check reset field
            $reset = isset( $_POST['athen_metabox_reset'] ) ? $_POST['athen_metabox_reset'] : '';

            // Set settings array
            $tabs       = $this->tabs_array();
            $settings   = array();
            foreach( $tabs as $tab ) {
                foreach ( $tab['settings'] as $setting ) {
                    $settings[] = $setting;
                }
            }

            // Loop through settings and validate
            foreach ( $settings as $setting ) {

                // Vars
                $value  = '';
                $id     = $setting['id'];
                $type   = isset ( $setting['type'] ) ? $setting['type'] : 'text';

                // Make sure field exists and if so validate the data
                if ( isset( $_POST[$id] ) ) {

                    // Validate text
                    if ( 'text' == $type ) {

                        $value = sanitize_text_field( $_POST[$id] );

                    }

                    // Validate textarea
                    if ( 'textarea' == $type ) {

                        $value = esc_html( $_POST[$id] );

                    }

                    // Links
                    elseif ( 'link' == $type ) {

                        $value = esc_url( $_POST[$id] );

                    }

                    // Validate select
                    elseif ( 'select' == $type ) {
                        if ( 'default' == $_POST[$id] ) {
                            $value = '';
                        } else {
                            $value = $_POST[$id];
                        }
                    }

                    // Validate media
                    if ( 'media' == $type ) {

                        // Sanitize
                        $value = $_POST[$id];

                        // Move old athen_post_self_hosted_shortcode_redux to athen_post_self_hosted_media
                        if ( 'athen_post_self_hosted_media' == $id && empty( $_POST[$id] ) && $old = get_post_meta( get_the_ID(), 'athen_post_self_hosted_shortcode_redux', true ) ) {
                            $value = $old;
                            delete_post_meta( get_the_ID(), 'athen_post_self_hosted_shortcode_redux' );
                        }

                    }

                    // All else
                    else {
                        $value = $_POST[$id];
                    }

                    // Update meta if value exists
                    if ( $value && 'on' != $reset ) {
                        update_post_meta( $post_id, $id, $value );
                    }

                    // Otherwise cleanup stuff
                    else {
                        delete_post_meta( $post_id, $id );
                    }
                    
                }

            }

        }

        /**
         * Helpers
         *
         * @since 1.0.0
         */
        public function helpers( $return = NULl ) {


            // Return array of WP menus
            if ( 'menus' == $return ) {
                $menus = array( __( 'Default', 'athen_transl' ) );
                $get_menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
                foreach ( $get_menus as $menu) {
                    $menus[$menu->term_id] = $menu->name;
                }
                return $menus;
            }

            // Title styles
            elseif ( 'title_styles' == $return ) {
                $styles = array(
                    ''                  => __( 'Default', 'athen_transl' ),
                    'centered'          => __( 'Centered', 'athen_transl' ),
                    'centered-minimal'  => __( 'Centered Minimal', 'athen_transl' ),
                    'background-image'  => __( 'Background Image', 'athen_transl' ),
                    'solid-color'       => __( 'Solid Color & White Text', 'athen_transl' ),
                );
                $styles = apply_filters( 'athen_title_styles', $styles );
                return $styles;
            }

            // Widgets
            elseif ( 'widget_areas' == $return ) {
                global $wp_registered_sidebars;
                $widgets_areas      = array( __( 'Default', 'athen_transl' ) );
                $get_widget_areas   = $wp_registered_sidebars;
                if ( ! empty( $get_widget_areas ) ) {
                    foreach ( $get_widget_areas as $widget_area ) {
                        $name   = isset ( $widget_area['name'] ) ? $widget_area['name'] : '';
                        $id     = isset ( $widget_area['id'] ) ? $widget_area['id'] : '';
                        if ( $name && $id ) {
                            $widgets_areas[$id] = $name;
                        }
                    }
                }
                return $widgets_areas;
            }

        }

        /**
         * Settings Array
         *
         * @since 1.0.0
         */
        public function tabs_array() {

            // Prefix
            $prefix = 'athen_';

            // Define variable
            $array = array();

            // Main Tab
            $array['main'] = array(
                'title'     => __( 'Main', 'athen_transl' ),
                'settings'  => array(
                    'post_link' => array(
                        'title'         => __( 'Redirect', 'athen_transl' ),
                        'id'            => $prefix . 'post_link',
                        'type'          => 'link',
                        'description'   => __( 'Enter a url to redirect this post or page.', 'athen_transl' ),
                    ),
                    'main_layout'   =>  array(
                        'title'         => __( 'Site Layout', 'athen_transl' ),
                        'type'          => 'select',
                        'id'            => $prefix . 'main_layout',
                        'description'   => __( 'Select the layout for your site. This option should only be used in very specific cases such as landpages. Use the theme option to control globally.', 'athen_transl' ),
                        'options'       => array(
                            ''              => __( 'Default', 'athen_transl' ),
                            'full-width'    => __( 'Full-Width', 'athen_transl' ),
                            'boxed'         => __( 'Boxed', 'athen_transl' ),
                        ),
                    ),
                    'post_layout'   => array(
                        'title'         => __( 'Content Layout', 'athen_transl' ),
                        'type'          => 'select',
                        'id'            => $prefix . 'post_layout',
                        'description'   => __( 'Select your custom layout for this page or post content.', 'athen_transl' ),
                        'options'       => array(
                            ''              => __( 'Default', 'athen_transl' ),
                            'right-sidebar' => __( 'Right Sidebar', 'athen_transl' ),
                            'left-sidebar'  => __( 'Left Sidebar', 'athen_transl' ),
                            'full-width'    => __( 'No Sidebar', 'athen_transl' ),
                            'full-screen'   => __( 'Full Screen', 'athen_transl' ),
                        ),
                    ),
                    'post_container' => array(
                        'title'         => __( 'Post Container', 'athen_transl'),
                        'type'          => 'select',
                        'id'            => $prefix .'post_container',
                        'description'   => __( 'Enable container for this page or post', 'athen_transl'),
                        'options'       => array(
                            ''           => __( 'Default', 'athen_transl' ),
                            'off'           => __( 'No Container', 'athen_transl' ),
                            'on'            => __( 'Include Container', 'athen_transl' ),      
                        ),
                    ),
                    'sidebar'   => array(
                        'title'         => __( 'Sidebar', 'athen_transl' ),
                        'type'          => 'select',
                        'id'            => 'sidebar',
                        'description'   => __( 'Select your a custom sidebar for this page or post.', 'athen_transl' ),
                        'options'       => $this->helpers( 'widget_areas' ),
                    ),
                    'disable_toggle_bar'    => array(
                        'title'         => __( 'Toggle Bar', 'athen_transl' ),
                        'id'            => $prefix . 'disable_toggle_bar',
                        'type'          => 'select',
                        'description'   => __( 'Enable or disable this element on this page or post.', 'athen_transl' ),
                        'options'       => array(
                            ''          => __( 'Default', 'athen_transl' ),
                            'enable'    => __( 'Enable', 'athen_transl' ),
                            'on'        => __( 'Disable', 'athen_transl' ),
                        ),
                    ),
                    'disable_top_bar'   => array(
                        'title'         => __( 'Top Bar', 'athen_transl' ),
                        'id'            => $prefix . 'disable_top_bar',
                        'type'          => 'select',
                        'description'   => __( 'Enable or disable this element on this page or post.', 'athen_transl' ),
                        'options'       => array(
                            ''          => __( 'Default', 'athen_transl' ),
                            'enable'    => __( 'Enable', 'athen_transl' ),
                            'on'        => __( 'Disable', 'athen_transl' ),
                        ),
                    ),
                    'disable_breadcrumbs'   => array(
                        'title'         => __( 'Breadcrumbs', 'athen_transl' ),
                        'id'            => $prefix . 'disable_breadcrumbs',
                        'type'          => 'select',
                        'description'   => __( 'Enable or disable this element on this page or post.', 'athen_transl' ),
                        'options'       => array(
                            ''          => __( 'Default', 'athen_transl' ),
                            'enable'    => __( 'Enable', 'athen_transl' ),
                            'on'        => __( 'Disable', 'athen_transl' ),
                        ),
                    ),
                    'disable_social'    => array(
                        'title'         => __( 'Social Share', 'athen_transl' ),
                        'id'            => $prefix . 'disable_social',
                        'type'          => 'select',
                        'description'   => __( 'Enable or disable this element on this page or post.', 'athen_transl' ),
                        'options'       => array(
                            ''          => __( 'Default', 'athen_transl' ),
                            'enable'    => __( 'Enable', 'athen_transl' ),
                            'on'        => __( 'Disable', 'athen_transl' ),
                        ),
                    ),
                ),
            );

            // Header Tab
            $array['header'] = array(
                'title'     => __( 'Header', 'athen_transl' ),
                'settings'  => array(
                    'disable_header'    => array(
                        'title'         => __( 'Header', 'athen_transl' ),
                        'id'            => $prefix . 'disable_header',
                        'type'          => 'select',
                        'description'   => __( 'Enable or disable this element on this page or post.', 'athen_transl' ),
                        'options'   => array(
                            ''      => __( 'Enable', 'athen_transl' ),
                            'on'    => __( 'Disable', 'athen_transl' ),
                        ),
                    ),
                    'custom_menu'   => array(
                        'title'         => __( 'Custom Menu', 'athen_transl' ),
                        'type'          => 'select',
                        'id'            => $prefix . 'custom_menu',
                        'description'   => __( 'Select a custom menu for this page or post.', 'athen_transl' ),
                        'options'       => $this->helpers( 'menus' ),
                    ),
                    'overlay_header'    => array(
                        'title'         => __( 'Overlay Header', 'athen_transl' ),
                        'description'   => __( 'Check to enable a overlay header. Useful for putting the header over an element such as a slider or background row. This is for desktops only and the top bar will be hidden when enabled.', 'athen_transl' ),
                        'id'            => $prefix . 'overlay_header',
                        'type'          => 'select',
                        'options'       => array(
                            ''      => __( 'Disable', 'athen_transl' ),
                            'on'    => __( 'Enable', 'athen_transl' ),
                        ),
                    ),
                    'overlay_header_style'  => array(
                        'title'     => __( 'Overlay Header Style', 'athen_transl' ),
                        'type'      => 'select',
                        'id'        => $prefix . 'overlay_header_style',
                        'description'   => __( 'Select your overlay header style', 'athen_transl' ),
                        'options'   => array(
                            ''      => __( 'White Text', 'athen_transl' ),
                            'dark'  => __( 'Black Text', 'athen_transl' ),
                        ),
                        'default'   => 'light',
                    ),
                    'overlay_header_logo'   => array(
                        'title'         => __( 'Overlay Header Logo', 'athen_transl'),
                        'id'            => $prefix . 'overlay_header_logo',
                        'type'          => 'media',
                        'description'   => __( 'Select a custom logo (optional) for the overlay header.', 'athen_transl' ),
                    ),
                    /*'overlay_header_logo_retina'  => array(
                        'title'         => __( 'Overlay Header Logo: Retina', 'athen_transl'),
                        'id'            => $prefix . 'overlay_header_logo_retina',
                        'type'          => 'media',
                        'description'   => __( 'Retina version for the overlay header custom logo.', 'athen_transl' ),
                    ),
                    'overlay_header_logo_height'    => array(
                        'title'         => __( 'Overlay Header Logo: Retina', 'athen_transl'),
                        'id'            => $prefix . 'overlay_header_logo_retina',
                        'type'          => 'media',
                        'description'   => __( 'Retina version for the overlay header custom logo.', 'athen_transl' ),
                    ),*/
                ),
            );

            // Title Tab
            $array['title'] = array(
                'title'     => __( 'Title', 'athen_transl' ),
                'settings'  => array(
                    'disable_title'                 => array(
                        'title'         => __( 'Title', 'athen_transl' ),
                        'id'            => $prefix . 'disable_title',
                        'type'          => 'select',
                        'description'   => __( 'Enable or disable this element on this page or post.', 'athen_transl' ),
                        'options'       => array(
                            ''      => __( 'Enable', 'athen_transl' ),
                            'on'    => __( 'Disable', 'athen_transl' ),
                        ),
                    ),
                    'disable_header_margin'         => array(
                        'title'         => __( 'Title Margin', 'athen_transl' ),
                        'id'            => $prefix . 'disable_header_margin',
                        'type'          => 'select',
                        'description'   => __( 'Enable or disable this element on this page or post.', 'athen_transl' ),
                        'options'       => array(
                            ''      => __( 'Enable', 'athen_transl' ),
                            'on'    => __( 'Disable', 'athen_transl' ),
                        ),
                    ),
                    'post_subheading'               => array(
                        'title'         => __( 'Subheading', 'athen_transl' ),
                        'type'          => 'text',
                        'id'            => $prefix . 'post_subheading',
                        'description'   => __( 'Enter your page subheading. Shortcodes & HTML is allowed.', 'athen_transl' ),
                    ),
                    'post_title_style'              => array(
                        'title'         => __( 'Title Style', 'athen_transl' ),
                        'type'          => 'select',
                        'id'            => $prefix . 'post_title_style',
                        'description'   => __( 'Select a custom title style for this page or post.', 'athen_transl' ),
                        'options'       => $this->helpers( 'title_styles' ),
                    ),
                    'post_title_background_color'   => array(
                        'title'      => __( 'Title: Background Color', 'athen_transl' ),
                        'description'=> __( 'Select a color.', 'athen_transl' ),
                        'id'         => $prefix .'post_title_background_color',
                        'type'       => 'color',
                        'hidden'     => true,
                    ),
                    'post_title_background_redux'   => array(
                        'title'         => __( 'Title: Background Image', 'athen_transl'),
                        'id'            => $prefix . 'post_title_background_redux',
                        'type'          => 'media',
                        'description'   => __( 'Select a custom header image for your main title.', 'athen_transl' ),
                        'hidden'        => true,
                    ),
                    'post_title_height' => array(
                        'title'         => __( 'Title: Background Height', 'athen_transl' ),
                        'type'          => 'text',
                        'id'            => $prefix . 'post_title_height',
                        'description'   => __( 'Select your custom height for your title background. Default is 400px.', 'athen_transl' ),
                        'hidden'        => true,
                    ),
                    'post_title_background_overlay' => array(
                        'title'         => __( 'Title: Background Overlay', 'athen_transl' ),
                        'type'          => 'select',
                        'id'            => $prefix . 'post_title_background_overlay',
                        'description'   => __( 'Select an overlay for the title background.', 'athen_transl' ),
                        'options'       => array(
                            ''          => __( 'None', 'athen_transl' ),
                            'dark'      => __( 'Dark', 'athen_transl' ),
                            'dotted'    => __( 'Dotted', 'athen_transl' ),
                            'dashed'    => __( 'Diagonal Lines', 'athen_transl' ),
                            'bg_color'  => __( 'Background Color', 'athen_transl' ),
                        ),
                        'hidden'        => true,
                    ),
                    'post_title_background_overlay_opacity' => array(
                        'id'            => $prefix . 'post_title_background_overlay_opacity',
                        'type'          => 'text',
                        'title'         => __( 'Title: Background Overlay Opacity', 'athen_transl' ),
                        'description'   => __( 'Enter a custom opacity for your title background overlay.', 'athen_transl' ),
                        'default'       => '',
                        'hidden'        => true,
                    ),
                ),
            );

            // Slider tab
            $array['slider'] = array(
                'title'     => __( 'Slider', 'athen_transl' ),
                'settings'  => array(
                    'post_slider_shortcode' => array(
                        'title'       => __( 'Slider Shortcode', 'athen_transl' ),
                        'type'        => 'code',
                        'id'          => $prefix . 'post_slider_shortcode',
                        'description' => __( 'Enter a slider shortcode here to display a slider at the top of the page.', 'athen_transl' ),
                    ),
                    'post_slider_shortcode_position' => array(
                        'title'       => __( 'Slider Position', 'athen_transl' ),
                        'type'        => 'select',
                        'id'          => $prefix . 'post_slider_shortcode_position',
                        'description' => __( 'Select the position for the slider shortcode.', 'athen_transl' ),
                        'options'     => array(
                            ''             => __( 'Skin Default', 'athen_transl' ),
                            'before_site_header'    => __( 'Before Site Header', 'athen_transl' ),
                            'after_site_header'     => __( 'After Site Header', 'athen_transl' ),
                            'before_top_header'     => __( 'Before Top Header', 'athen_transl' ),
                            'after_top_header'     => __( 'After Top Header', 'athen_transl' ),
                            'before_main_header'     => __( 'Before Main Header', 'athen_transl' ),
                            'after_main_header'     => __( 'After Main Header', 'athen_transl' ),
                            'above_title'  => __( 'Above Title', 'athen_transl' ),
                            'below_title' => __( 'Below Title', 'athen_transl' ),
                        ),
                    ),  
                    'post_slider_bottom_margin' => array(
                        'title'       => __( 'Slider Bottom Margin', 'athen_transl' ),
                        'description' => __( 'Enter a bottom margin for your slider in pixels', 'athen_transl' ),
                        'id'          => $prefix . 'post_slider_bottom_margin',
                        'type'        => 'text',
                    ),
                    'disable_post_slider_mobile' => array(
                        'title'       => __( 'Slider On Mobile', 'athen_transl' ),
                        'id'          => $prefix . 'disable_post_slider_mobile',
                        'type'        => 'select',
                        'description' => __( 'Enable or disable slider display for mobile devices.', 'athen_transl' ),
                        'options'     => array(
                            ''      => __( 'Enable', 'athen_transl' ),
                            'on'    => __( 'Disable', 'athen_transl' ),
                        ),
                    ),
                    'post_slider_mobile_alt' => array(
                        'title'       => __( 'Slider Mobile Alternative', 'athen_transl' ),
                        'type'        => 'media',
                        'id'          => $prefix . 'post_slider_mobile_alt',
                        'description' => __( 'Select an image.', 'athen_transl' ),
                        'type'        => 'media',
                    ),
                    'post_slider_mobile_alt_url' => array(
                        'title'         => __( 'Slider Mobile Alternative URL', 'athen_transl' ),
                        'id'            => $prefix . 'post_slider_mobile_alt_url',
                        'description'   => __( 'URL for the mobile slider alternative.', 'athen_transl' ),
                        'type'          => 'text',
                    ),
                    'post_slider_mobile_alt_url_target' => array(
                        'title'       => __( 'Slider Mobile Alternative URL Target', 'athen_transl' ),
                        'id'          => $prefix . 'post_slider_mobile_alt_url_target',
                        'description' => __( 'Select your link target window.', 'athen_transl' ),
                        'type'        => 'select',
                        'options'     => array(
                            ''      => __( 'Same Window', 'athen_transl' ),
                            'blank' => __( 'New Window', 'athen_transl' ),
                        ),
                    ),
                ),
            );

            // Background tab
            $array['background'] = array(
                'title'     => __( 'Background', 'athen_transl' ),
                'settings'  => array(
                    'page_background_color' => array(
                        'title'         => __( 'Background Color', 'athen_transl' ),
                        'description'   => __( 'Select a color.', 'athen_transl' ),
                        'id'            => $prefix . 'page_background_color',
                        'type'          => 'color',
                    ),
                    'page_background_image_redux'   => array(
                        'title'       => __( 'Background Image', 'athen_transl' ),
                        'id'          => $prefix . 'page_background_image_redux',
                        'description' => __( 'Select an image.', 'athen_transl' ),
                        'type'        => 'media',
                    ),
                    'page_background_image_style'   => array(
                        'title'         => __( 'Background Style', 'athen_transl' ),
                        'type'          => 'select',
                        'id'            => $prefix . 'page_background_image_style',
                        'description'   => __( 'Select the style.', 'athen_transl' ),
                        'options'       => array(
                            ''          => __( 'Default', 'athen_transl' ),
                            'repeat'    => __( 'Repeat', 'athen_transl' ),
                            'fixed'     => __( 'Fixed', 'athen_transl' ),
                            'stretched' => __( 'Streched', 'athen_transl' ),
                        ),
                    ),
                ),
            );

            // Footer tab
            $array['footer'] = array(
                'title'     => __( 'Footer', 'athen_transl' ),
                'settings'  => array(
                    'disable_footer'    => array(
                        'title'         => __( 'Footer', 'athen_transl' ),
                        'id'            => $prefix . 'disable_footer',
                        'type'          => 'select',
                        'description'   => __( 'Enable or disable this element on this page or post.', 'athen_transl' ),
                        'options'       => array(
                            ''          => __( 'Default', 'athen_transl' ),
                            'enable'    => __( 'Enable', 'athen_transl' ),
                            'on'        => __( 'Disable', 'athen_transl' ),
                        ),
                    ),
                    'disable_footer_widgets'    => array(
                        'title'     => __( 'Footer Widgets', 'athen_transl' ),
                        'id'        => $prefix . 'disable_footer_widgets',
                        'type'      => 'select',
                        'description'   => __( 'Enable or disable this element on this page or post.', 'athen_transl' ),
                        'options'       => array(
                            ''          => __( 'Enable', 'athen_transl' ),
                            'on'        => __( 'Disable', 'athen_transl' ),
                        ),
                    ),
                    'footer_reveal' => array(
                        'title'         => __( 'Footer Reveal', 'athen_transl' ),
                        'description'   => __( 'Enable the footer reveal style. The footer will be placed in a fixed postion and display on scroll. This setting is for the "Full-Width" layout only and desktops only.', 'athen_transl' ),
                        'id'        => $prefix . 'footer_reveal',
                        'type'      => 'select',
                        'options'   => array(
                            ''      => __( 'Default', 'athen_transl' ),
                            'on'    => __( 'Enable', 'athen_transl' ),
                            'off'   => __( 'Disable', 'athen_transl' ),
                        ),
                    ),
                ),
            );

            // Media tab
            $array['media'] = array(
                'title'     => __( 'Media', 'athen_transl' ),
                'post_type' => array( 'post' ),
                'settings'  => array(
                    'post_media_position'   => array(
                        'title'         => __( 'Media Display/Position', 'athen_transl' ),
                        'id'            => $prefix . 'post_media_position',
                        'type'          => 'select',
                        'description'   => __( 'Select your preferred position for your post\'s media (featured image or video).', 'athen_transl' ),
                        'options'       => array(
                            ''          => __( 'Default', 'athen_transl' ),
                            'above'     => __( 'Full-Width Above Content', 'athen_transl' ),
                            'hidden'    => __( 'None (Do Not Display Featured Image/Video)', 'athen_transl' ),
                        ),
                    ),
                    'post_oembed'   => array(
                        'title'         => __( 'oEmbed URL', 'athen_transl' ),
                        'description'   =>  __( 'Enter a URL that is compatible with WP\'s built-in oEmbed feature. This setting is used for your video and audio post formats.', 'athen_transl' ) .'<br /><a href="http://codex.wordpress.org/Embeds" target="_blank">'. __( 'Learn More', 'athen_transl' ) .' &rarr;</a>',
                        'id'            => $prefix . 'post_oembed',
                        'type'          => 'text',
                    ),
                    'post_self_hosted_shortcode_redux'  => array(
                        'title'         => __( 'Self Hosted', 'athen_transl' ),
                        'description'   => __( 'Insert your self hosted video or audio url here.', 'athen_transl' ) .'<br /><a href="http://make.wordpress.org/core/2013/04/08/audio-video-support-in-core/" target="_blank">'. __( 'Learn More', 'athen_transl' ) .' &rarr;</a>',
                        'id'            => $prefix . 'post_self_hosted_media',
                        'type'          => 'media',
                    ),
                    'post_video_embed'   => array(
                        'title'         => __( 'Embed Code', 'athen_transl' ),
                        'description'   => __( 'Insert your embed/iframe code.', 'athen_transl' ),
                        'id'            => $prefix . 'post_video_embed',
                        'type'          => 'textarea',
                        'rows'          => '2',
                    ),
                ),
            );

            // Staff Tab
            if ( ATHEN_CHECK_STAFF ) {
                $staff_meta_array = athen_staff_social_meta_array();
                $staff_meta_array['position'] = array(
                    'title'     => __( 'Position', 'athen_transl' ),
                    'id'        => $prefix .'staff_position',
                    'type'      => 'text',
                );
                $obj        = get_post_type_object( 'staff' );
                $tab_title  = $obj->labels->singular_name;
                $array['staff'] = array(
                    'title'     => $tab_title,
                    'post_type' => array( 'staff' ),
                    'settings'  => $staff_meta_array,
                );
            }

            // Portfolio Tab
            if ( ATHEN_CHECK_PORTFOLIO ) {
                $obj        = get_post_type_object( 'portfolio' );
                $tab_title  = $obj->labels->singular_name;
                $array['portfolio'] = array(
                    'title'     => $tab_title,
                    'post_type' => array( 'portfolio' ),
                    'settings'  => array(
                        'featured_video'    => array(
                            'title'         => __( 'oEmbed URL', 'athen_transl' ),
                            'description'   =>  __( 'Enter a URL that is compatible with WP\'s built-in oEmbed feature. This setting is used for your video and audio post formats.', 'athen_transl' ) .'<br /><a href="http://codex.wordpress.org/Embeds" target="_blank">'. __( 'Learn More', 'athen_transl' ) .' &rarr;</a>',
                            'id'            => $prefix .'post_video',
                            'type'          => 'text',
                        ),
                        'post_video_embed'   => array(
                            'title'         => __( 'Embed Code', 'athen_transl' ),
                            'description'   => __( 'Insert your embed/iframe code.', 'athen_transl' ),
                            'id'            => $prefix . 'post_video_embed',
                            'type'          => 'textarea',
                            'rows'          => '2',
                        ),
                    ),
                );
            }

            // Testimonials Tab
            if ( ATHEN_CHECK_TESTIMONIALS ) {
                $obj        = get_post_type_object( 'testimonials' );
                $tab_title  = $obj->labels->singular_name;
                $array['testimonials'] = array(
                    'title'     => $tab_title,
                    'post_type' => array( 'testimonials' ),
                    'settings'  => array(
                        'testimonial_author'    => array(
                            'title'         => __( 'Author', 'athen_transl' ),
                            'description'   => __( 'Enter the name of the author for this testimonial.', 'athen_transl' ),
                            'id'            => $prefix .'testimonial_author',
                            'type'          => 'text',
                        ),
                        'testimonial_company'   => array(
                            'title'         => __( 'Company', 'athen_transl' ),
                            'description'   => __( 'Enter the name of the company for this testimonial.', 'athen_transl' ),
                            'id'            => $prefix .'testimonial_company',
                            'type'          => 'text',
                        ),
                        'testimonial_url'       => array(
                            'title'         => __( 'Company URL', 'athen_transl' ),
                            'description'   => __( 'Enter the url for the company for this testimonial.', 'athen_transl' ),
                            'id'            => $prefix .'testimonial_url',
                            'type'          => 'text',
                        ),
                    ),
                );
            }

            // Apply filter & return settings array
            $array = apply_filters( 'athen_metabox_array', $array );
            return $array;
        }
    }
}
$athen_post_metaboxes = new Athen_Post_Metaboxes();