<?php
/**
 * Description  : Class for generating fontawesome icon button widgets.
 * 
 * @package     Athen
 * @subpackage  Closer - View/controller
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Start class
if ( ! class_exists( 'Athen_Fontawesome_Social_Widget' ) ) {
    class Athen_Fontawesome_Social_Widget extends WP_Widget {

        /**
         * Register widget with WordPress.
         *
         * @since 1.0.0
         */
        function __construct() {
            parent::__construct(
                'athen_fontawesome_social_widget',
                ATHEN_NAME_THEME . ' - '. __( 'Font Awesome Social Widget', 'athen_transl' ),
                array( 'description' => __( 'Displays icons with links to your social profiles with drag and drop support and Font Awesome Icons.', 'athen_transl' ) )
            );
        }

        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         * @since 1.0.0
         *
         *
         * @param array $args     Widget arguments.
         * @param array $instance Saved values from database.
         */
        function widget( $args, $instance ) {

            // Extract args
            extract( $args );

            // Sanitize args
            $title              = isset( $instance['title'] ) ? $instance['title'] : '';
            $title              = apply_filters( 'widget_title', $title );
            $description        = isset( $instance['description'] ) ? $instance['description'] : '';
            $style              = isset( $instance['style'] ) ? $instance['style'] : '';
            $type               = isset( $instance['type'] ) ? $instance['type'] : '';
            $target             = isset( $instance['target'] ) ? $instance['target'] : '';
            $target             = ( 'blank' == $target ) ? ' target="_blank"' : '';
            $size               = isset( $instance['size'] ) ? intval( $instance['size'] ) : '';
            $size               = ( $size ) ? athen_sanitize_data( $size, 'px' ) : '';
            $font_size          = isset( $instance['font_size'] ) ? intval( $instance['font_size'] ) : '';
            $font_size          = ( $font_size ) ? athen_sanitize_data( $font_size, 'font_size' ) : '';
            $border_radius      = isset( $instance['border_radius'] ) ? $instance['border_radius'] : '';
            $border_radius      = ( $border_radius ) ? athen_sanitize_data( $border_radius, 'border_radius' ) : '';
            $social_services    = isset( $instance['social_services'] ) ? $instance['social_services'] : ''; ?>

            <?php
            // Social services are required for this widget
            if ( $social_services ) : ?>

                <?php
                // Before widget hook
                echo $before_widget; ?>

                <?php
                // Display title
                if ( $title ) : ?>
                    <?php echo $before_title . $title . $after_title; ?>
                <?php endif; ?>

                <div class="athen-fontawesome-social-widget clr">

                    <?php
                    // Inline style
                    $add_style = '';
                    if ( '30' != $size && $size ) {
                        $add_style .= 'height:'. $size .';width:'. $size .';line-height:'. $size .';';
                    }
                    if ( '14' != $font_size && $font_size ) {
                        $add_style .= 'font-size:'. $font_size .';';
                    }
                    if ( '3px' != $border_radius && $border_radius ) {
                        $add_style .= 'border-radius:'. $border_radius .';';
                    }
                    if ( $add_style ) {
                        $add_style = ' style="' . esc_attr( $add_style ) . '"';
                    } ?>

                    <?php
                    // Description
                    if ( $description ) : ?>

                        <div class="desc clr">
                            <?php echo $description; ?>
                        </div><!-- .desc -->

                    <?php endif; ?>

                    <ul class="<?php echo $style; ?> <?php echo $type; ?>">

                        <?php
                        // Loop through each social service and display font icon
                        foreach( $social_services as $key => $service ) {
                            $link = ! empty( $service['url'] ) ? $service['url'] : null;
                            $name = $service['name'];
                            if ( $link ) {
                                if ( 'youtube' == $key ) {
                                    $key = 'youtube-play';
                                }
                                echo '<li class="social-widget-'. $key .'"><a href="'. esc_url( $link ) .'" title="'. esc_attr( $name ) .'"'. $add_style . $target .'><i class="fa fa-'. $key .'"></i></a></li>';
                            }
                        } ?>

                    </ul>

                </div><!-- .fontawesome-social-widget -->

                <?php echo $after_widget; ?>

            <?php endif; ?>

        <?php
        }

        /**
         * Sanitize widget form values as they are saved.
         *
         * @see WP_Widget::update()
         * @since 1.0.0
         *
         * @param array $new_instance Values just sent to be saved.
         * @param array $old_instance Previously saved values from database.
         *
         * @return array Updated safe values to be saved.
         */
        function update( $new, $old ) {

            $instance = $old;

            $instance['title']              = ! empty( $new['title'] ) ? strip_tags( $new['title'] ) : null;
            $instance['description']        = ! empty( $new['description'] ) ? $new['description'] : null;
            $instance['style']              = ! empty( $new['style'] ) ? strip_tags( $new['style'] ) : 'black';
            $instance['type']               = ! empty( $new['type'] ) ? strip_tags( $new['type'] ) : 'graphical';
            $instance['target']             = ! empty( $new['target'] ) ? strip_tags( $new['target'] ) : 'blank';
            $instance['size']               = ! empty( $new['size'] ) ? strip_tags( $new['size'] ) : '30px';
            $instance['border_radius']      = ! empty( $new['border_radius'] ) ? strip_tags( $new['border_radius'] ) : '3px';
            $instance['font_size']          = ! empty( $new['font_size'] ) ? strip_tags( $new['font_size'] ) : '14px';
            $instance['social_services']    = $new['social_services'];

            return $instance;
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         * @since 1.0.0
         *
         * @param array $instance Previously saved values from database.
         */
        function form( $instance ) {

            $social_services_array = array(
                'dribbble'      => array(
                    'name'      => 'Dribbble',
                    'url'       => ''
                ),
                'facebook'      => array(
                    'name'      => 'Facebook',
                    'url'       => ''
                ),
                'flickr'        => array(
                    'name'      => 'Flickr',
                    'url'       => ''
                ),
                'vk'            => array(
                    'name'      => 'VK',
                    'url'       => ''
                ),
                'github'        => array(
                    'name'      => 'GitHub',
                    'url'       => ''
                ),
                'google-plus'   => array(
                    'name'      => 'GooglePlus',
                    'url'       => ''
                ),
                'instagram'     => array(
                    'name'      => 'Instagram',
                    'url'       => ''
                ),
                'linkedin'      => array(
                    'name'      => 'LinkedIn',
                    'url'       => ''
                ),
                'pinterest'     => array(
                    'name'      => 'Pinterest',
                    'url'       => ''
                ),
                'tumblr'        => array(
                    'name'      => 'Tumblr',
                    'url'       => ''
                ),
                'twitter'       => array(
                    'name'      => 'Twitter',
                    'url'       => ''
                ),
                'skype'         => array(
                    'name'      => 'Skype',
                    'url'       => ''
                ),
                'trello'        => array(
                    'name'      => 'Trello',
                    'url'       => ''
                ),
                'foursquare'    => array(
                    'name'      => 'Foursquare',
                    'url'       => ''
                ),
                'renren'        => array(
                    'name'      => 'RenRen',
                    'url'       => ''
                ),
                'xing'          => array(
                    'name'      => 'Xing',
                    'url'       => ''
                ),
                'vimeo-square'  => array(
                    'name'      => 'Vimeo',
                    'url'       => ''
                ),
                'vine'          => array(
                    'name'      => 'Vine',
                    'url'       => ''
                ),
                'youtube'       => array(
                    'name'      => 'Youtube',
                    'url'       => ''
                ),
                'rss'           => array(
                    'name'      => 'RSS',
                    'url'       => ''
                ),
            );
            $social_services_array = apply_filters( 'athen_social_widget_profiles', $social_services_array );
            $defaults =  array(
                'title'             => __('Follow Us', 'athen_transl' ),
                'description'       => '',
                'style'             => 'color-square',
                'type'              => 'flat',
                'font_size'         => '14px',
                'border_radius'     => '3px',
                'target'            => 'blank',
                'size'              => '30px',
                'social_services'   => $social_services_array
            );
            
            $instance = wp_parse_args( ( array ) $instance, $defaults ); ?>
            
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'athen_transl' ); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('description'); ?>"><?php _e( 'Description:','athen_transl' ); ?></label> 
                <label for="<?php echo $this->get_field_id('description'); ?>"><?php _e( 'Description:', 'athen_transl' ); ?></label> 
                <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>"><?php echo $instance['description']; ?></textarea>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('style'); ?>"><?php _e( 'Style', 'athen_transl'); ?></label>
                <br />
                <select class='wpex-widget-select' name="<?php echo $this->get_field_name('style'); ?>" id="<?php echo $this->get_field_id('style'); ?>">
                    <option value="color" <?php if ( $instance['style'] == 'color' ) { ?>selected="selected"<?php } ?>><?php _e( 'Color', 'athen_transl' ); ?></option>
                    <option value="black" <?php if ( $instance['style'] == 'black' ) { ?>selected="selected"<?php } ?>><?php _e( 'Black', 'athen_transl' ); ?></option>
                    <option value="black-color-hover" <?php if ( $instance['style' ] == 'black-color-hover') { ?>selected="selected"<?php } ?>><?php _e( 'Black With Color Hover', 'athen_transl' ); ?></option>
                </select>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('type'); ?>"><?php _e( 'Type', 'athen_transl'); ?></label>
                <br />
                <select class='wpex-widget-select' name="<?php echo $this->get_field_name('type'); ?>" id="<?php echo $this->get_field_id('type'); ?>">
                    <option value="flat" <?php if ($instance['type'] == 'flat') { ?>selected="selected"<?php } ?>><?php _e( 'Flat', 'athen_transl' ); ?></option>
                    <option value="graphical" <?php if ($instance['type'] == 'graphical') { ?>selected="selected"<?php } ?>><?php _e( 'Graphical', 'athen_transl' ); ?></option>
                </select>
            </p>
            
            <p>
                <label for="<?php echo $this->get_field_id('target'); ?>"><?php _e( 'Link Target:', 'athen_transl' ); ?></label>
                <br />
                <select class='wpex-widget-select' name="<?php echo $this->get_field_name('target'); ?>" id="<?php echo $this->get_field_id('target'); ?>">
                    <option value="blank" <?php if ($instance['target'] == 'blank') { ?>selected="selected"<?php } ?>><?php _e( 'Blank', 'athen_transl' ); ?></option>
                    <option value="self" <?php if ($instance['target'] == 'self') { ?>selected="selected"<?php } ?>><?php _e( 'Self', 'athen_transl' ); ?></option>
                </select>
            </p>
            
            <p>
                <label for="<?php echo $this->get_field_id('size'); ?>"><?php _e( 'Icon Size', 'athen_transl' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('size'); ?>" name="<?php echo $this->get_field_name('size'); ?>" type="text" value="<?php echo $instance['size']; ?>" />
                <small><?php _e( 'Enter a size to be used for the height/width for the icon.', 'athen_transl'); ?></small>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('font_size'); ?>"><?php _e( 'Icon Font Size', 'athen_transl' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('font_size'); ?>" name="<?php echo $this->get_field_name('font_size'); ?>" type="text" value="<?php echo $instance['font_size']; ?>" />
                <small><?php _e( 'Enter a custom font size for the icons.', 'athen_transl'); ?></small>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('border_radius'); ?>"><?php _e( 'Border Radius', 'athen_transl' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'border_radius' ); ?>" name="<?php echo $this->get_field_name('border_radius'); ?>" type="text" value="<?php echo $instance['border_radius']; ?>" />
                <small><?php _e( 'Enter a custom border radius. For circular icons enter a number equal or greater to the Icon Size field above.', 'athen_transl'); ?></small>
            </p>

            <?php
            $field_id_services      = $this->get_field_id( 'social_services' );
            $field_name_services    = $this->get_field_name( 'social_services' ); ?>
            <h3 style="margin-top:20px;margin-bottom:0;"><?php _e( 'Social Links','athen_transl' ); ?></h3>  
            <small style="display:block;margin-bottom:10px;"><?php _e( 'Enter the full URL to your social profile.', 'athen_transl' ); ?> <?php _e( 'Drag and drop to re-order items.', 'athen_transl' ); ?></small>
            <ul id="<?php echo $field_id_services; ?>" class="wpex-services-list">
                <input type="hidden" id="<?php echo $field_name_services; ?>" value="<?php echo $field_name_services; ?>">
                <input type="hidden" id="<?php echo wp_create_nonce( 'athen_fontawesome_social_widget_nonce' ); ?>">
                <?php
                $display_services = isset ( $instance['social_services'] ) ? $instance['social_services']: '';
                if ( ! empty( $display_services ) ) {
                    foreach( $display_services as $key => $service ) {
                        $url        = isset( $service['url'] ) ? $service['url'] : 0;
                        $name       = isset( $service['name'] )  ? $service['name'] : ''; ?>
                        <li id="<?php echo $field_id_services; ?>_0<?php echo $key ?>">
                            <p>
                                <label for="<?php echo $field_id_services; ?>-<?php echo $key ?>-name"><?php echo $name; ?>:</label>
                                <input type="hidden" id="<?php echo $field_id_services; ?>-<?php echo $key ?>-url" name="<?php echo $field_name_services .'['.$key.'][name]'; ?>" value="<?php echo $name; ?>">
                                <input type="url" class="widefat" id="<?php echo $field_id_services; ?>-<?php echo $key ?>-url" name="<?php echo $field_name_services .'['.$key.'][url]'; ?>" value="<?php echo $url; ?>" />
                            </p>
                        </li>
                    <?php }
                } ?>
            </ul>
            
        <?php
        }
    }
}

// Register the Athen_Tabs_Widget custom widget
if ( ! function_exists( 'register_athen_fontawesome_social_widget' ) ) {
    function register_athen_fontawesome_social_widget() {
        register_widget( 'Athen_Fontawesome_Social_Widget' );
    }
}
add_action( 'widgets_init', 'register_athen_fontawesome_social_widget' );

// Widget Styles
if ( ! function_exists( 'athen_social_widget_style' ) ) {
    function athen_social_widget_style() { ?>
        <style> 
        .wpex-services-list li {
            cursor: move;
            background: #fafafa;
            padding: 10px;
            border: 1px solid #e5e5e5;
            margin-bottom: 10px;
        }
        .wpex-services-list li p {
            margin: 0;
        }
        .wpex-services-list li label {
            margin-bottom: 3px;
            display: block;
            color: #222;
        }
        .wpex-services-list .placeholder {
            border: 1px dashed #e3e3e3;
        }
        </style>
    <?php
    }
}


// Widget AJAX functions
function athen_fontawesome_social_widget_scripts() {
    global $pagenow;
    if ( is_admin() && $pagenow == "widgets.php" ) {
        add_action('admin_head', 'athen_social_widget_style');
        add_action('admin_footer', 'add_new_athen_fontawesome_social_ajax_trigger');
        function add_new_athen_fontawesome_social_ajax_trigger() { ?>
            <script type="text/javascript" >
                jQuery(document).ready(function($) {
                    jQuery(document).ajaxSuccess(function(e, xhr, settings) {
                        var widget_id_base = 'athen_fontawesome_social_widget';
                        if (settings.data.search('action=save-widget') != -1 && settings.data.search('id_base=' + widget_id_base) != -1) {
                            wpexSortServices();
                        }
                    });
                    function wpexSortServices() {
                        jQuery('.wpex-services-list').each( function() {
                            var id = jQuery(this).attr('id');
                            $('#'+ id).sortable({
                                placeholder: "placeholder",
                                opacity: 0.6
                            });
                        });
                    }
                    wpexSortServices();
                });
            </script>
        <?php
        }
    }
}
add_action('admin_init','athen_fontawesome_social_widget_scripts');