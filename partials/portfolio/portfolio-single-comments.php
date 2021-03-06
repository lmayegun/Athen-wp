<?php
/**
 * Portfolio single comments
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

// Return if comments are disabled
if ( ! comments_open() ) {
	return;
} ?>

<div id="portfolio-post-comments" class="clr">
	<?php comments_template(); ?>
</div><!-- #portfolio-post-comments -->