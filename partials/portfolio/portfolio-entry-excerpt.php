<?php
/**
 * Outputs the portfolio entry excerpt
 *
 * @package		Total
 * @subpackage	Partials/Portfolio
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		1.0.0
 * @version		1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get excerpt length
$excerpt_length = athen_get_mod( 'portfolio_entry_excerpt_length', '20' );

// Return if excerpt length is set to 0
if ( '0' == $excerpt_length ) {
	return;
} ?>

<div class="portfolio-entry-excerpt clr">
	<?php athen_excerpt( array(
		'length'	=> $excerpt_length,
		'readmore'	=> false,
	) ); ?>
</div><!-- .portfolio-entry-excerpt -->