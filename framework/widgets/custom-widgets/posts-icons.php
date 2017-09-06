<?php
/**
* Description  : Class for generating recent recent post with icons - widget.
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
if ( ! class_exists( 'Athen_Recent_Posts_Icons_Widget' ) ) {
    class Athen_Recent_Posts_Icons_Widget extends WP_Widget {
        
        /**
         * Register widget with WordPress.
         *
         * @since 1.0.0
         */
        public function __construct() {
            parent::__construct(
                'athen_recent_posts_icons',
                $name = ATHEN_NAME_THEME . ' - '. __( 'Posts With Icons', 'athen_transl' ),
                array()
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
            $title      = isset ( $instance['title'] ) ? $instance['title'] : '';
            $title      = apply_filters( 'widget_title', $instance['title'] );
            $number     = isset( $instance['number'] ) ? $instance['number'] : '5';
            $order      = isset( $instance['order'] ) ? $instance['order'] : 'DESC';
            $orderby    = isset( $instance['orderby'] ) ? $instance['orderby'] : 'date';
            $category   =  isset( $instance['category'] ) ? $instance['category'] : 'all';
            $exclude    = ( is_singular() ) ? array( get_the_ID() ) : NULL;

            // Before Widget Hook
            echo $before_widget;

            // Title
            if ( $title ) {
                echo $before_title . $title . $after_title;
            }
                // Category
                if ( ! empty( $category ) && 'all' != $category ) {
                    $taxonomy = array (
                        array (
                            'taxonomy'  => 'category',
                            'field'     => 'id',
                            'terms'     => $category,
                        )
                    );
                } else {
                    $taxonomy = NUll;
                }

                // Query Posts
                global $post;
                $athen_query = new WP_Query( array(
                    'post_type'             => 'post',
                    'posts_per_page'        => $number,
                    'orderby'               => $orderby,
                    'order'                 => $order,
                    'no_found_rows'         => true,
                    'post__not_in'          => $exclude,
                    'tax_query'             => $taxonomy,
                    'ignore_sticky_posts'   => 1
                ) );

                // Loop through posts
                if ( $athen_query->have_posts() ) : ?>

                    <ul class="athen-widget-recent-posts-icons clr">

                        <?php foreach( $athen_query->posts as $post ) : setup_postdata( $post ); ?>

                            <li class="clr">
                                <a href="<?php athen_permalink() ?>" title="<?php athen_esc_title(); ?>">
                                    <span class="<?php athen_post_format_icon(); ?>"></span><?php the_title(); ?>
                                </a>
                            </li>

                        <?php endforeach; ?>

                    </ul>

                <?php endif; ?>

            <?php 
            // Reset post data
            wp_reset_postdata(); ?>

            <?php 
            // After widget hook
            echo $after_widget; ?>

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
        function update( $new_instance, $old_instance ) {
            $instance               = $old_instance;
            $instance['title']      = strip_tags( $new_instance['title'] );
            $instance['number']     = strip_tags( $new_instance['number'] );
            $instance['order']      = strip_tags( $new_instance['order'] );
            $instance['orderby']    = strip_tags( $new_instance['orderby'] );
            $instance['category']   = strip_tags( $new_instance['category'] );
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
            $instance = wp_parse_args( ( array ) $instance, array(
                'title'     => __( 'Recent Posts', 'athen_transl' ),
                'number'    => '5',
                'order'     => 'DESC',
                'orderby'   => 'date',
                'category'  => 'all'

            ) );
            $title      = esc_attr( $instance['title'] );
            $number     = esc_attr( $instance['number'] );
            $order      = esc_attr( $instance['order'] );
            $orderby    = esc_attr( $instance['orderby'] );
            $category   = esc_attr( $instance['category'] ); ?>
            
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'athen_transl' ); ?>:</label> 
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title','athen_transl' ); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number to Show', 'athen_transl' ); ?>:</label> 
                <input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" />
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e( 'Order', 'athen_transl' ); ?>:</label>
                <br />
                <select class='wpex-select' name="<?php echo $this->get_field_name( 'order' ); ?>" id="<?php echo $this->get_field_id( 'order' ); ?>">
                <option value="DESC" <?php if( $order == 'DESC' ) { ?>selected="selected"<?php } ?>><?php _e( 'Descending', 'athen_transl' ); ?></option>
                <option value="ASC" <?php if( $order == 'ASC' ) { ?>selected="selected"<?php } ?>><?php _e( 'Ascending', 'athen_transl' ); ?></option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Order By', 'athen_transl' ); ?>:</label>
                <br />
                <select class='wpex-select' name="<?php echo $this->get_field_name( 'orderby' ); ?>" id="<?php echo $this->get_field_id( 'orderby' ); ?>">
                <?php
                // Orderby options
                $orderby_array = array (
                    'date'          => __( 'Date', 'athen_transl' ),
                    'title'         => __( 'Title', 'athen_transl' ),
                    'modified'      => __( 'Modified', 'athen_transl' ),
                    'author'        => __( 'Author', 'athen_transl' ),
                    'rand'          => __( 'Random', 'athen_transl' ),
                    'comment_count' => __( 'Comment Count', 'athen_transl' ),
                );
                foreach ( $orderby_array as $key => $value ) { ?>
                    <option value="<?php echo $key; ?>" <?php if( $orderby == $key ) { ?>selected="selected"<?php } ?>>
                        <?php echo $value; ?>
                    </option>
                <?php } ?>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category', 'athen_transl' ); ?>:</label>
                <br />
                <select class='wpex-select' name="<?php echo $this->get_field_name( 'category' ); ?>" id="<?php echo $this->get_field_id( 'category' ); ?>">
                <option value="all" <?php if($category == 'all' ) { ?>selected="selected"<?php } ?>><?php _e( 'All', 'athen_transl' ); ?></option>
                <?php
                $terms = get_terms( 'category' );
                if ( ! empty ( $terms ) ) {
                    foreach ( $terms as $term ) { ?>
                        <option value="<?php echo $term->term_id; ?>" <?php if( $category == $term->term_id ) { ?>selected="selected"<?php } ?>><?php echo $term->name; ?></option>
                    <?php }
                } ?>
                </select>
            </p>
            <?php
        }
    }
}

// Register the Athen_Post_Icon_Widget custom widget
if ( ! function_exists( 'register_recent_posts_icons_widget' ) ) {
    function register_recent_posts_icons_widget() {
        register_widget( 'Athen_Recent_Posts_Icons_Widget' );
    }
}
add_action( 'widgets_init', 'register_recent_posts_icons_widget' );