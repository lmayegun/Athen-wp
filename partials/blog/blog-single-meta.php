<?php
/**
 * Single blog meta
 *
 * @package		Total
 * @subpackage	Partials/Blog
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		1.6.0
 * @version		2.1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Return if disabled
if ( ! athen_get_mod( 'blog_post_meta', true ) ) {
	return;
}

// Get meta sections
$sections = athen_blog_single_meta_sections();

// Return if sections are empty
if ( empty( $sections ) ) {
	return;
}

// Add class for meta with title
$classes = 'meta clr';
if ( 'custom_text' == athen_get_mod( 'blog_single_header', 'custom_text' ) ) {
	$classes .= ' meta-with-title';
} ?>

<ul class="<?php echo $classes; ?>">

	<?php
	// Loop through meta sections
	foreach ( $sections as $section ) : ?>

		<?php if ( 'date' == $section ) : ?>
			<li class="meta-date"><span class="fa fa-clock-o"></span><span class="updated"><?php echo get_the_date(); ?></span></li>
		<?php endif; ?>

		<?php if ( 'author' == $section ) : ?>
			<li class="meta-author"><span class="fa fa-user"></span><span class="vcard author"><?php the_author_posts_link(); ?></span></li>
		<?php endif; ?>

		<?php if ( 'categories' == $section ) : ?>
			<li class="meta-category"><span class="fa fa-folder-o"></span><?php the_category( ', ', get_the_ID() ); ?></li>
		<?php endif; ?>

		<?php if ( 'comments' == $section && comments_open() && ! post_password_required() ): ?>
			<li class="meta-comments comment-scroll"><span class="fa fa-comment-o"></span><?php comments_popup_link( __( '0 Comments', 'athen_transl' ), __( '1 Comment',  'athen_transl' ), __( '% Comments', 'athen_transl' ), 'comments-link' ); ?></li>
		<?php endif; ?>

	<?php endforeach; ?>

</ul><!-- .meta -->