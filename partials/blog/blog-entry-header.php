<?php
/**
 * Blog entry layout
 *
 * @package		Total
 * @subpackage	Partials/Blog
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		1.6.0
 * @version		1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define classes
$classes = 'blog-entry-header clr';
if ( athen_post_entry_author_avatar_enabled( get_the_ID() ) ) {
	$classes .= ' header-with-avatar';
} ?>

<header class="<?php echo $classes; ?>">
	<?php get_template_part( 'partials/blog/blog-entry', 'title' ); ?>
	<?php get_template_part( 'partials/blog/blog-entry', 'avatar' ); ?>
	<?php get_template_part( 'partials/blog/blog-entry', 'meta' ); ?>
</header><!-- .<?php $classes; ?> -->