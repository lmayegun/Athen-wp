<?php
/**
 * Portfolio single layout
 *
 * @package		Total
 * @subpackage	Partials/Portfolio
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		2.0.0
 * @version		2.1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Single layout blocks
$blocks = athen_portfolio_post_blocks();

// Loop through blocks and get template part
foreach ( $blocks as $block ) {
	get_template_part( 'partials/portfolio/portfolio-single-'. $block );
}