<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * The wp_get_attachment_url() function doesn't distinguish whether a page request arrives via HTTP or HTTPS.
 * Using wp_get_attachment_url filter, we can fix this to avoid the dreaded mixed content browser warning
 *
 * @since   1.6.0
 * @access  public
 *
 * @link    http://codex.wordpress.org/Plugin_API/Filter_Reference/wp_get_attachment_url
 */
function honor_ssl_for_attachments( $url ) {
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
// Make sure the wp_get_attachment_url() function returns correct page request (HTTP or HTTPS)
add_filter( 'wp_get_attachment_url', array( &$this, 'honor_ssl_for_attachments' ) );

	/**
	 * Alters the default WordPress password protected form so it's easier to style
	 *
	 * @since   2.0.0
	 * @access  public
	 *
	 * @link    http://codex.wordpress.org/Using_Password_Protection
	 */
	function custom_password_protected_form() {
		ob_start();
		include( locate_template( 'partials/password-protection-form.php' ) );
		return ob_get_clean();
	}
    // Tweak the default password protection output form
	add_filter( 'the_password_form', array( &$this, 'custom_password_protected_form' ) );

	/**
	 * Modify JOIN in the next/prev function
	 *
	 * @since   2.0.0
	 * @access  public
	 *
	 * @link    https://core.trac.wordpress.org/browser/tags/4.1.1/src/wp-includes/link-template.php
	 */
	function prev_next_join( $join ) {
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
	function prev_next_where( $where ) {
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
	function redirect_custom_links() {

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
function delete_term( $term_id ) {

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
add_action( 'delete_term', array( &$this, 'delete_term' ), 5 );

// Allow for the use of shortcodes in the WordPress excerpt
		add_filter( 'the_excerpt', 'shortcode_unautop' );
		add_filter( 'the_excerpt', 'do_shortcode' );

		



		// Exclude posts with custom links from the next and previous post links
		add_filter( 'get_previous_post_join', array( &$this, 'prev_next_join' ) );
		add_filter( 'get_next_post_join', array( &$this, 'prev_next_join' ) );
		add_filter( 'get_previous_post_where', array( &$this, 'prev_next_where' ) );
		add_filter( 'get_next_post_where', array( &$this, 'prev_next_where' ) );

		// Redirect posts with custom links
		add_filter( 'template_redirect', array( &$this, 'redirect_custom_links' ) );
		

		// Remove emoji scripts
		if ( $this->athen_get_mod( 'remove_emoji_scripts_enable', true ) ) {
			remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
			remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
			remove_action( 'wp_print_styles', 'print_emoji_styles' );
			remove_action( 'admin_print_styles', 'print_emoji_styles' );
		}
