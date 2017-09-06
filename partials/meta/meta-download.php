<?php
/**
 * Post meta for the Easy Digital Downloads post type
 *
 * @package		Total
 * @subpackage	Partials/Post Meta
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		2.1.0
 * @version		2.0.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Default enabled meta sections
$meta_sections	= array( 'date', 'author', 'categories', 'comments' );

// Apply filters for easy modification
$meta_sections = apply_filters( 'athen_meta_sections', $meta_sections );

// Convert meta sections into array if not array
if ( $meta_sections && ! is_array( $meta_sections ) ) {
	$meta_sections = explode( ',', $meta_sections );
}

// Return if sections are empty
if ( empty( $sections ) ) {
	return;
} ?>

<ul class="meta clr">

	<?php
	// Loop through meta sections
	foreach ( $meta_sections as $meta_section ) : ?>

		<?php
		// Date
		if ( 'date' == $meta_section ) { ?>

			<li class="meta-date"><span class="fa fa-clock-o"></span><?php echo get_the_date(); ?></li>

		<?php } ?>

		<?php
		// Author
		if ( 'author' == $meta_section ) { ?>

			<li class="meta-author"><span class="fa fa-user"></span><?php the_author_posts_link(); ?></li>

		<?php } ?>

		<?php
		// Categories
		if ( 'categories' == $meta_section && $categories = athen_list_post_terms( 'download_category', true, false ) ) { ?>

			<li class="meta-category"><span class="fa fa-folder-o"></span><?php echo $categories; ?></li>

		<?php } ?>

		<?php
		// Comments
		if ( 'comments' == $meta_section && comments_open() && ! post_password_required() ) { ?>

			<li class="meta-comments comment-scroll"><span class="fa fa-comment-o"></span><?php comments_popup_link( __( '0 Comments', 'athen_transl' ), __( '1 Comment',  'athen_transl' ), __( '% Comments', 'athen_transl' ), 'comments-link' ); ?></li>

		<?php } ?>

	<?php endforeach; ?>

</ul><!-- .meta -->