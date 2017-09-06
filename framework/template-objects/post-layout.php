<?php
/**
 * Description : Class use to modify the layout type that should be use for post/page or achive content. 
 * 
 * @package     Athen
 * @subpackage  Closer - View
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 */

class Athen_Post_Layout{
	
	public function __construct(){
		
	}
	
	/**
	 * Returns defined post layout for curent post
	 *
	 * @since 2.0.0
	 */
	public static function athen_get_post_layout() {

		// Get global object
		$obj = athen_global_obj();

		// Return post layout if defined
		if ( ! empty( $obj->post_layout ) ) {
			return $obj->post_layout;
		}

		// Backup check incase $athen_std_theme isn't defined for some reason
		else {
			return $this->athen_post_layout();
		}

	}
	
	/**
	 * Sets the correct layout for posts
	 *
	 * @since Total 1.0.0
	 */
	public function athen_post_layout( $post_id = '' ) {

		// Get ID if not defined
		$post_id = $post_id ? $post_id : athen_get_the_id();

		// Define variables
		$class  = 'right-sidebar';
		$meta   = get_post_meta( $post_id, 'athen_post_layout', true );
        
		// Check meta first to override and return (prevents filters from overriding meta)
		if ( $meta ) {
			return $meta;
		}

		// Singular Page
		if ( is_page() ) {

			// Blog template
			if ( is_page_template( 'templates/blog.php' ) ) {
				$class = athen_get_mod( 'blog_archives_layout', 'right-sidebar' );
			}

			// Landing Page
			if ( is_page_template( 'templates/landing-page.php' ) ) {
				$class = 'full-width';
			}

			// Attachment
			elseif ( is_attachment() ) {
				$class = 'full-width';
			}

			// All other pages
			else {
				$class = athen_get_mod( 'page_single_layout', 'right-sidebar' );
			}

		}

		// Singular Post
		elseif ( is_singular( 'post' ) ) {
			$class = athen_get_mod( 'blog_single_layout', 'right-sidebar' );
		}

		// Home
		elseif ( is_home() ) {
			$class = athen_get_mod( 'blog_archives_layout', 'right-sidebar' );
		}

		// Search
		elseif ( is_search() ) {
			$class = 'right-sidebar';
		}

		// Standard Categories
		elseif ( is_category() ) {
			$class      = athen_get_mod( 'blog_archives_layout', 'right-sidebar' );
			$term       = get_query_var( 'cat' );
			$term_data  = get_option( "category_$term" );
			if ( $term_data ) {
				if( ! empty( $term_data['athen_term_layout'] ) ) {
					$class = $term_data['athen_term_layout'];
				}
			}
		}

		// Archives
		elseif ( athen_is_blog_query() ) {
			$class = athen_get_mod( 'blog_archives_layout', 'right-sidebar' );
		}
		
		// 404 page
		elseif ( is_404() ) {
			$class = 'full-width';
		}

		// All else
		else {
			$class = 'right-sidebar';
		}

		// Class should never be empty
		if ( empty( $class ) ) {
			$class = 'right-sidebar';
		}

		// Apply filters for child theme editing
		$class = apply_filters( 'athen_post_layout_class', $class );
		
		// Return correct classname
		return $class;
		
	}
} 



