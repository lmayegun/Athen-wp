<?php
/**
 * Single blog header
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
} ?>

<header class="single-blog-header clr">
	<?php get_template_part( 'partials/blog/blog-single', 'title' ); ?>
	<?php get_template_part( 'partials/blog/blog-single', 'meta' ); ?>
</header><!-- .single-blog-header -->