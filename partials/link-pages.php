<?php
/**
 * Page links
 *
 * @package		Total
 * @subpackage	Partials
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

wp_link_pages( array(
	'before'		=> '<div class="page-links clr">',
	'after'			=> '</div>',
	'link_before'	=> '<span>',
	'link_after'	=> '</span>'
) );