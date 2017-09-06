<?php
/**
 * Single blog post title
 *
 * @package		Total
 * @subpackage	Partials/Blog
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		1.6.0
 * @version		2.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Return if disabled
if ( 'custom_text' != athen_get_mod( 'blog_single_header', 'custom_text' ) ) {
	return;
} ?>

<h1 class="single-post-title entry-title">
	<?php the_title(); ?>
</h1><!-- .single-post-title -->