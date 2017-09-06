<?php
/**
 * Post Series Configuration File
 *
 * @package     Total
 * @subpackage  Framework/Blog
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       1.4.0
 * @version     2.1.0
 */

// Registers the Post Series Taxonomy
if ( ! class_exists( 'WPEX_Post_Series_Config' ) ) {

    class WPEX_Post_Series_Config {

        /**
         * Get things started
         *
         * @since   2.0.0
         * @access  public
         */
        public function __construct() {

            // Register the post series taxonomy
            add_action( 'init', array( &$this, 'register' ), 0 );

            // Adds columns in the admin view for thumbnail and taxonomies
            add_filter( 'manage_edit-post_columns', array( &$this, 'edit_columns' ) );
            add_action( 'manage_post_posts_custom_column', array( &$this, 'column_display' ), 10, 2 );

            // Allows filtering of posts by taxonomy in the admin view
            add_action( 'restrict_manage_posts', array( &$this, 'tax_filters' ) );

            // Set same_cat taxonomy for next/previous posts
            add_action( 'athen_next_prev_same_cat_taxonomy', array( &$this, 'next_prev_same_cat_taxonomy' ) );

            // Post series is considered part of the blog query
            add_filter( 'athen_is_blog_query', array( &$this, 'athen_is_blog_query' ) ); 

        }

        /**
         * Registers the custom taxonomy
         *
         * @since   2.0.0
         * @access  public
         */
        public function register() {

            $labels = array(
                'name'                          => __( 'Post Series', 'athen_transl' ),
                'singular_name'                 => __( 'Post Series', 'athen_transl' ),
                'search_items'                  => __( 'Search Post Series', 'athen_transl' ),
                'popular_items'                 => __( 'Popular Post Series', 'athen_transl' ),
                'all_items'                     => __( 'All Post Series', 'athen_transl' ),
                'parent_item'                   => __( 'Parent Post Series', 'athen_transl' ),
                'parent_item_colon'             => __( 'Parent Post Series:', 'athen_transl' ),
                'edit_item'                     => __( 'Edit Post Series', 'athen_transl' ),
                'update_item'                   => __( 'Update Post Series', 'athen_transl' ),
                'add_new_item'                  => __( 'Add New Post Series', 'athen_transl' ),
                'new_item_name'                 => __( 'New Post Series Name', 'athen_transl' ),
                'separate_items_with_commas'    => __( 'Separate post series with commas', 'athen_transl' ),
                'add_or_remove_items'           => __( 'Add or remove post series', 'athen_transl' ),
                'choose_from_most_used'         => __( 'Choose from the most used post series', 'athen_transl' ),
                'menu_name'                     => __( 'Post Series', 'athen_transl' ),
            );
            $args = array(
                'labels'            => $labels,
                'public'            => true,
                'show_in_nav_menus' => true,
                'show_ui'           => true,
                'show_tagcloud'     => true,
                'hierarchical'      => true,
                'rewrite'           => array(
                    'slug'  => 'post-series'
                ),
                'query_var'         => true
            );

            // Apply filters
            $args = apply_filters( 'athen_taxonomy_post_series_args', $args );

            // Register the taxonomy
            register_taxonomy( 'post_series', array( 'post' ), $args );

        }

        /**
         * Adds columns to the WP dashboard edit screen
         *
         * @since   2.0.0
         * @access  public
         */
        public function edit_columns( $columns ) {
            $columns['athen_post_series'] = __( 'Post Series', 'athen_transl' );
            return $columns;
        }

        /**
         * Adds columns to the WP dashboard edit screen
         *
         * @since   2.0.0
         * @access  public
         */
        public function column_display( $column, $post_id ) {
            switch ( $column ) {
                case "athen_post_series":
                if ( $category_list = get_the_term_list( $post_id, 'post_series', '', ', ', '' ) ) {
                    echo $category_list;
                } else {
                    echo '&mdash;';
                }
                break;
            }
        }

        /**
         * Adds taxonomy filters to the posts admin page
         *
         * @since   2.0.0
         * @access  public
         */
        public function tax_filters() {
            global $typenow;
            if ( 'post' == $typenow ) {
                $tax_slug           = 'post_series';
                $current_tax_slug   = isset( $_GET[$tax_slug] ) ? $_GET[$tax_slug] : false;
                $tax_obj            = get_taxonomy( $tax_slug );
                $tax_name           = $tax_obj->labels->name;
                $terms              = get_terms( $tax_slug );
                if ( count( $terms ) > 0) {
                    echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
                    echo "<option value=''>$tax_name</option>";
                    foreach ( $terms as $term ) {
                        echo '<option value=' . $term->slug, $current_tax_slug == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>';
                    }
                    echo "</select>";
                }
            }
        }

        /**
         * Alter next/previous post links same_cat taxonomy
         *
         * @since   2.0.0
         * @access  public
         */
        public function next_prev_same_cat_taxonomy( $taxonomy ) {
            if ( athen_is_post_in_series() ) {
                $taxonomy = 'post_series';
            }
            return $taxonomy;
        }

        /**
         * Return true for the athen_is_blog_query when visiting a post_series tax page
         *
         * @since   2.0.0
         * @access  public
         */
        public function athen_is_blog_query( $bool ) {
            if ( is_tax( 'post_series' ) ) {
                $bool = true;
            }
            return $bool;
        }


    }

}
new WPEX_Post_Series_Config;