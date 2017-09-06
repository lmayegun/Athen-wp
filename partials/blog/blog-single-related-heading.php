<?php
/**
 * Blog single post related heading
 *
 * @package		Total
 * @subpackage	Partials/Blog
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		2.0.0
 * @version		1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get heading
$heading = athen_blog_related_heading();

// Output heading
athen_heading( array(
	'content'		=> $heading,
	'tag'			=> 'div',
	'classes'		=> array( 'related-posts-title' ),
	'apply_filters'	=> 'blog_related',
) );