<?php

class Athen_Wp_Filter extends Athen_Framework_Init{
    
    public function __construct(){
        
        // Alter tagcloud widget to display all tags with 1em font size
		add_filter( 'widget_tag_cloud_args', array( &$this, 'widget_tag_cloud_args' ) );

		// Alter WP categories widget to display count inside a span
		add_filter( 'wp_list_categories', array( &$this, 'wp_list_categories_args' ) );

		// Exclude categories from the blog page
		add_filter( 'pre_get_posts', array( &$this, 'pre_get_posts' ) );

		// Add new social profile fields to the user dashboard
		add_filter( 'user_contactmethods', array( &$this, 'add_user_social_fields' ) );

		// Add a responsive wrapper to the WordPress oembed output
		add_filter( 'embed_oembed_html', array( &$this, 'add_responsive_wrap_to_oembeds' ), 99, 4 );

		// Allow for the use of shortcodes in the WordPress excerpt
		add_filter( 'the_excerpt', 'shortcode_unautop' );
		add_filter( 'the_excerpt', 'do_shortcode' );

		// Make sure the wp_get_attachment_url() function returns correct page request (HTTP or HTTPS)
		add_filter( 'wp_get_attachment_url', array( &$this, 'honor_ssl_for_attachments' ) );

		// Tweak the default password protection output form
		add_filter( 'the_password_form', array( &$this, 'custom_password_protected_form' ) );

		// Exclude posts with custom links from the next and previous post links
		add_filter( 'get_previous_post_join', array( &$this, 'prev_next_join' ) );
		add_filter( 'get_next_post_join', array( &$this, 'prev_next_join' ) );
		add_filter( 'get_previous_post_where', array( &$this, 'prev_next_where' ) );
		add_filter( 'get_next_post_where', array( &$this, 'prev_next_where' ) );

		// Redirect posts with custom links
		add_filter( 'template_redirect', array( &$this, 'redirect_custom_links' ) );

		// Remove athen_term_data when a term is removed
		add_action( 'delete_term', array( &$this, 'delete_term' ), 5 );

		// Remove emoji scripts
		if ( $this->athen_get_mod( 'remove_emoji_scripts_enable', true ) ) {
			remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
			remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
			remove_action( 'wp_print_styles', 'print_emoji_styles' );
			remove_action( 'admin_print_styles', 'print_emoji_styles' );
		}
    }
    
    /**
	 * Alters the default WordPress tag cloud widget arguments.
	 * Makes sure all font sizes for the cloud widget are set to 1em.
	 *
	 * @since   1.6.0
	 * @access  public
	 *
	 * @link    https://developer.wordpress.org/reference/hooks/widget_tag_cloud_args/   
	 */
	public function widget_tag_cloud_args( $args ) {
		$args['largest']    = '0.923em';
		$args['smallest']   = '0.923em';
		$args['unit']       = 'em';
		return $args;
	}

	/**
	 * Alter wp list categories arguments.
	 * Adds a span around the counter for easier styling.
	 *
	 * @since   1.6.0
	 * @access  public
	 *
	 * @link    https://developer.wordpress.org/reference/functions/wp_list_categories/
	 */
	public function wp_list_categories_args( $links ) {
		$links  = str_replace( '</a> (', '</a> <span class="cat-count-span">(', $links );
		$links  = str_replace( ')', ')</span>', $links );
		return $links;
	}

	/**
	 * This function runs before the main query.
	 *
	 * @since   1.6.0
	 * @access  public
	 *
	 * @link    http://codex.wordpress.org/Plugin_API/Action_Reference/pre_get_posts
	 */
	public function pre_get_posts( $query ) {

		// Lets not break stuff
		if ( is_admin() || ! $query->is_main_query() ) {
			return;
		}

		// Search pagination
		if ( is_search() ) {
			$query->set( 'posts_per_page', $this->athen_get_mod( 'search_posts_per_page', '10' ) );
			return;
		}

		// Exclude categories from the main blog
		if ( ( is_home() || is_page_template( 'templates/blog.php' ) ) && function_exists( 'athen_blog_exclude_categories' ) ) {
			athen_blog_exclude_categories( false );
			return;
		}

		// Category pagination
		$terms = get_terms( 'category' );
		if ( ! empty( $terms ) ) {
			foreach ( $terms as $term ) {
				if ( is_category( $term->slug ) ) {
					$term_id    = $term->term_id;
					$term_data  = get_option( "category_$term_id" );
					if ( $term_data ) {
						if ( ! empty( $term_data['athen_term_posts_per_page'] ) ) {
							$query->set( 'posts_per_page', $term_data['athen_term_posts_per_page'] );
							return;
						}
					}
				}
			}
		}
	}

	/**
	 * Add new user fields / user meta
	 *
	 * @since   1.6.0
	 * @access  public
	 *
	 * @link    http://codex.wordpress.org/Plugin_API/Filter_Reference/user_contactmethods
	 */
	public function add_user_social_fields( $contactmethods ) {

		// Add Twitter
		if ( ! isset( $contactmethods['athen_twitter'] ) ) {
			$contactmethods['athen_twitter'] = ' Twitter';
		}
		// Add Facebook
		if ( ! isset( $contactmethods['athen_facebook'] ) ) {
			$contactmethods['athen_facebook'] = ' Facebook';
		}
		// Add GoglePlus
		if ( ! isset( $contactmethods['athen_googleplus'] ) ) {
			$contactmethods['athen_googleplus'] = ' Google+';
		}
		// Add LinkedIn
		if ( ! isset( $contactmethods['athen_linkedin'] ) ) {
			$contactmethods['athen_linkedin'] = ' LinkedIn';
		}
		// Add Pinterest
		if ( ! isset( $contactmethods['athen_pinterest'] ) ) {
			$contactmethods['athen_pinterest'] = ' Pinterest';
		}
		// Add Pinterest
		if ( ! isset( $contactmethods['athen_instagram'] ) ) {
			$contactmethods['athen_instagram'] = ' Instagram';
		}

		// Return contact methods
		return $contactmethods;

	}

	/**
	 * Alters the default oembed output.
	 * Adds special classes for responsive oembeds via CSS.
	 *
	 * @since   1.6.0
	 * @access  public
	 *
	 * @link    https://developer.wordpress.org/reference/hooks/embed_oembed_html/
	 */
	public function add_responsive_wrap_to_oembeds( $html, $url, $attr, $post_id ) {
		$html = '<div class="responsive-video-wrap entry-video">' . $html . '</div>';
		return $html;
	}

	/**
	 * The wp_get_attachment_url() function doesn't distinguish whether a page request arrives via HTTP or HTTPS.
	 * Using wp_get_attachment_url filter, we can fix this to avoid the dreaded mixed content browser warning
	 *
	 * @since   1.6.0
	 * @access  public
	 *
	 * @link    http://codex.wordpress.org/Plugin_API/Filter_Reference/wp_get_attachment_url
	 */
	public function honor_ssl_for_attachments( $url ) {
		$http       = site_url( FALSE, 'http' );
		$https      = site_url( FALSE, 'https' );
		$isSecure   = false;
		if ( ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443 ) {
			$isSecure = true;
		}
		if ( $isSecure ) {
			return str_replace( $http, $https, $url );
		} else {
			return $url;
		}
	}

	/**
	 * Alters the default WordPress password protected form so it's easier to style
	 *
	 * @since   2.0.0
	 * @access  public
	 *
	 * @link    http://codex.wordpress.org/Using_Password_Protection
	 */
	public function custom_password_protected_form() {
		ob_start();
		include( locate_template( 'partials/password-protection-form.php' ) );
		return ob_get_clean();
	}


	/**
	 * Modify JOIN in the next/prev function
	 *
	 * @since   2.0.0
	 * @access  public
	 *
	 * @link    https://core.trac.wordpress.org/browser/tags/4.1.1/src/wp-includes/link-template.php
	 */
	public function prev_next_join( $join ) {
		global $wpdb;
		$join .= " LEFT JOIN $wpdb->postmeta AS m ON ( p.ID = m.post_id AND m.meta_key = 'athen_post_link' )";
		return $join;
	}

	/**
	 * Modify WHERE in the next/prev function
	 *
	 * @since   2.0.0
	 * @access  public
	 *
	 * @link    https://core.trac.wordpress.org/browser/tags/4.1.1/src/wp-includes/link-template.php
	 */
	public function prev_next_where( $where ) {
		global $wpdb;
		$where .= " AND ( (m.meta_key = 'athen_post_link' AND CAST(m.meta_value AS CHAR) = '') OR m.meta_id IS NULL ) ";
		return $where;
	}

	/**
	 * Alters the default WordPress password protected form so it's easier to style
	 *
	 * @since   2.0.0
	 * @access  public
	 *
	 * @link    http://codex.wordpress.org/Using_Password_Protection
	 */
	public function redirect_custom_links() {

		// Only needed for singular posts and pages
		if ( ! is_singular() ) {
			return;
		}

		// Get custom link
		if ( $custom_link = athen_get_custom_permalink() ) {

			// If there is a custom link, redirect to it
			if ( $custom_link = esc_url( $custom_link ) ) {
				wp_redirect( $custom_link, 301 );
			}

		}

	}

	/**
	 * When a term is deleted, delete its data.
	 *
	 * @access public
	 * @since  2.1.0
	 */
	public function delete_term( $term_id ) {

		// Validate term id
		$term_id = absint( $term_id );

		// If term id is defiend
		if ( $term_id ) {
			
			// Get terms data
			$term_data = get_option( 'athen_term_data' );

			// Remove key with term data
			if ( $term_data && isset( $term_data[$term_id] ) ) {
				unset( $term_data[$term_id] );
				update_option( 'athen_term_data', $term_data );
			}
		}
	}
    
    
    
}

new Athen_Wp_Filter();