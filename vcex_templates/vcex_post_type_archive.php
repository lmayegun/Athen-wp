<?php
/**
 * Output for the Post Type Grid Visual Composer module
 *
 * @package     Total
 * @subpackage  vcex_templates
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
 * @version     2.0.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Not needed in admin ever
if ( is_admin() ) {
	return;
}

// Extract shortcode attributes
$atts = shortcode_atts( array(
	'unique_id'          => '',
	'classes'            => '',
	'visibility'         => '',
	'css_animation'      => '',
	'post_type'          => 'post',
	'posts_per_page'     => '12',
	'order'              => 'DESC',
	'orderby'            => 'date',
	'orderby_meta_key'   => '',
	'posts_in'           => '',
	'author_in'          => '',
	'pagination'         => '',
	'tax_query'          => '',
	'tax_query_taxonomy' => '',
	'tax_query_terms'    => '',
	'taxonomies'         => '',
	'thumbnail_query'    => '',
), $atts );

// Extract shortcode atts
extract( $atts );

// Build the WordPress query
$my_query = vcex_build_wp_query( $atts );

// Set post to blog
$post_type = ( 'post' == $post_type ) ? 'blog' : $post_type;

// Output posts
if ( $my_query->have_posts() ) :

	get_template_part( 'partials/loop/loop-top', $post_type );

		// Define counter var to clear floats
		$athen_count='';

		// Loop through posts
		while ( $my_query->have_posts() ) :

			// Get post from query
			$my_query->the_post();

			// Create new post object.
			$post = new stdClass();

				get_template_part( 'partials/loop/loop', $post_type );

		endwhile;

	get_template_part( 'partials/loop/loop-bottom', $post_type );
	
	// Display pagination if enabled
	if ( 'true' == $pagination ) :
		athen_pagination( $my_query );
	endif;
	
	// Remove post object from memory
	$post = null;

	// Reset the post data to prevent conflicts with WP globals
	wp_reset_postdata(); ?>

<?php
// If no posts are found display message
else : ?>

	<?php
	// Display no posts found error if function exists
	echo vcex_no_posts_found_message( $atts ); ?>

<?php
// End post check
endif; ?>