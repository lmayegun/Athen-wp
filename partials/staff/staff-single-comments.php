<?php
/**
 * Staff single comments
 *
 * @package		Total
 * @subpackage	Partials/Staff
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

// Display comments if enabled
if ( comments_open() ) : ?>

	<div id="staff-post-comments" class="clr">
		<?php comments_template(); ?>
	</div><!-- #staff-post-comments -->

<?php endif; ?>