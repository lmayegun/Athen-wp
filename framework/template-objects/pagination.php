<?php
/**
* Description : Class use to modify pagination post (modification include infinite scroll & jump). 
 * 
 * @package     Athen
 * @subpackage  Closer - View
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 */
 
 
 class Athen_Pagination{
	 
	 public function __construct(){
		 
	 }
	 
	/**
	 * Numbered Pagination
	 *
	 * @since Total 1.0.0
	 */
    public static function athen_pagination( $query = '' ) {
        
        // Arrows with RTL support
        $prev_arrow = is_rtl() ? 'fa fa-angle-right' : 'fa fa-angle-left';
        $next_arrow = is_rtl() ? 'fa fa-angle-left' : 'fa fa-angle-right';
        
        // Get global $query
        if ( ! $query ) {
            global $wp_query;
            $query = $wp_query;
        }

        // Set vars
        $total  = $query->max_num_pages;
        $big    = 999999999;

        // Display pagination
        if ( $total > 1 ) {

            // Get current page
            if ( $current_page = get_query_var( 'paged' ) ) {
                $current_page = $current_page;
            } elseif ( $current_page = get_query_var( 'page' ) ) {
                $current_page = $current_page;
            } else {
                $current_page = 1;
            }

            // Get permalink structure
            if ( get_option( 'permalink_structure' ) ) {
                if ( is_page() ) {
                    $format = 'page/%#%/';
                } else {
                    $format = '/%#%/';
                }
            } else {
                $format = '&paged=%#%';
            }

            // Midsize
            $mid_size = '3';

            // Output pagination
            echo paginate_links( array(
                'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format'        => $format,
                'current'       => max( 1, $current_page ),
                'total'         => $total,
                'mid_size'      => $mid_size,
                'type'          => 'list',
                'prev_text'     => '<i class="'. $prev_arrow .'"></i>',
                'next_text'     => '<i class="'. $next_arrow .'"></i>',
            ) );
        }

    }
	
	
	/**
	 * Blog Pagination
	 * Used to load the correct pagination function for blog archives
	 * Execute the correct pagination function based on the theme settings
	 *
	 * @since Total 1.0.0
	 */

    public function athen_blog_pagination() {
        
        // Admin Options
        $blog_style         = athen_get_mod( 'blog_style', 'large-image' );
        $pagination_style   = athen_get_mod( 'blog_pagination_style', 'standard' );
        
        // Category based settings
        if ( is_category() ) {
            
            // Get taxonomy meta
            $term       = get_query_var( 'cat' );
            $term_data  = get_option( 'category_'. $term );
            $term_style = $term_pagination = '';
            
            if ( isset( $term_data['athen_term_style'] ) ) {
                $term_style = '' != $term_data['athen_term_style'] ? $term_data['athen_term_style'] .'' : $term_style;
            }
            
            if ( isset( $term_data['athen_term_pagination'] ) ) {
                $term_pagination = '' != $term_data['athen_term_pagination'] ? $term_data['athen_term_pagination'] .'' : '';
            }
            
            if ( $term_style ) {
                $blog_style = $term_style .'-entry-style';
            }
            
            if ( $term_pagination ) {
                $pagination_style = $term_pagination;
            }
            
        }
        
        // Set default $type for infnite scroll
        if ( 'grid-entry-style' == $blog_style ) {
            $infinite_type = 'standard-grid';
        } else {
            $infinite_type = 'standard';
        }
        
        // Execute the correct pagination function
        if ( 'infinite_scroll' == $pagination_style ) {
            athen_infinite_scroll( $infinite_type );
        } elseif ( $pagination_style == 'next_prev' ) {
            Athen_Pagination::athen_pagejump();
        } else {
            Athen_Pagination::athen_pagination();
        }
    }
	
	/**
	 * Next/Prev Pagination
	 *
	 * @since Total 1.0.0
	 */

    public static function athen_pagejump( $pages = '', $range = 4 ) {
        $output     = '';
        $showitems  = ($range * 2)+1; 
        global $paged;
        if ( empty( $paged ) ) $paged = 1;
        
        if ( $pages == '' ) {
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if ( ! $pages) {
                $pages = 1;
            }
        }
        if ( 1 != $pages ) {
        $output .= '<div class="page-jump clr">';
            $output .= '<div class="alignleft newer-posts">';
                $output .= get_previous_posts_link('&larr; '. __( 'Newer Posts', 'athen_transl' ) );
            $output .= '</div>';
            $output .= '<div class="alignright older-posts">';
                $output .= get_next_posts_link( __( 'Older Posts', 'athen_transl' ) .' &rarr;');
            $output .= '</div>';
        $output .= '</div>';
        }
        echo $output;
    }
} 
 

/**
 * Infinite Scroll Pagination
 *
 * @since Total 1.0.0
 */
if ( ! function_exists( 'athen_infinite_scroll' ) ) {
    function athen_infinite_scroll( $type = 'standard' ) {
        
        // Load infinite scroll js for standard blog style
        if ( $type == 'standard' ) {
            wp_enqueue_script( 'wpex-infinitescroll', ATHEN_JS_DIR_URI .'infinite-scroll/infinitescroll.js', array( 'jquery' ), 1.0, true );
            wp_enqueue_script( 'wpex-infinitescroll-standard', ATHEN_JS_DIR_URI .'infinite-scroll/infinitescroll-standard.js', array( 'jquery' ), 1.0, true );
        }
        
        // Load infinite scroll js for grid
        if ( $type == 'standard-grid' ) {
            wp_enqueue_script( 'wpex-infinitescroll', ATHEN_JS_DIR_URI .'infinite-scroll/infinitescroll.js', array( 'jquery' ), 1.0, true );
            wp_enqueue_script( 'wpex-infinitescroll-grid', ATHEN_JS_DIR_URI .'infinite-scroll/infinitescroll-standard-grid.js', array( 'jquery' ), 1.0, true );
        }
        
        // Localize loading text
        $is_params = array( 'msgText' => __( 'Loading...', 'athen_transl' ) );
        wp_localize_script( 'wpex-infinitescroll', 'wpexInfiniteScroll', $is_params );  
        
        // Output pagination HTML
        $output = '';
        $output .= '<div class="infinite-scroll-nav clr">';
            $output .= '<div class="alignleft newer-posts">';
                $output .= get_previous_posts_link('&larr; '. __( 'Newer Posts', 'athen_transl' ) );
            $output .= '</div>';
            $output .= '<div class="alignright older-posts">';
                $output .= get_next_posts_link( __( 'Older Posts', 'athen_transl' ) .' &rarr;');
            $output .= '</div>';
        $output .= '</div>';

        echo $output;

    }
}
$this->pagination   = new Athen_Pagination();

function athen_pagination( $query = '' ) {
        
        // Arrows with RTL support
        $prev_arrow = is_rtl() ? 'fa fa-angle-right' : 'fa fa-angle-left';
        $next_arrow = is_rtl() ? 'fa fa-angle-left' : 'fa fa-angle-right';
        
        // Get global $query
        if ( ! $query ) {
            global $wp_query;
            $query = $wp_query;
        }

        // Set vars
        $total  = $query->max_num_pages;
        $big    = 999999999;

        // Display pagination
        if ( $total > 1 ) {

            // Get current page
            if ( $current_page = get_query_var( 'paged' ) ) {
                $current_page = $current_page;
            } elseif ( $current_page = get_query_var( 'page' ) ) {
                $current_page = $current_page;
            } else {
                $current_page = 1;
            }

            // Get permalink structure
            if ( get_option( 'permalink_structure' ) ) {
                if ( is_page() ) {
                    $format = 'page/%#%/';
                } else {
                    $format = '/%#%/';
                }
            } else {
                $format = '&paged=%#%';
            }

            // Midsize
            $mid_size = '3';

            // Output pagination
            echo paginate_links( array(
                'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format'        => $format,
                'current'       => max( 1, $current_page ),
                'total'         => $total,
                'mid_size'      => $mid_size,
                'type'          => 'list',
                'prev_text'     => '<i class="'. $prev_arrow .'"></i>',
                'next_text'     => '<i class="'. $next_arrow .'"></i>',
            ) );
        }

    }

//add_action('wp_head', 'athen_pagination');