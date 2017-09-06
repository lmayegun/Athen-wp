<?php
/**
 * Staff post title
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

// Check for position
$position = get_post_meta( get_the_ID(), 'athen_staff_position', true );

// Display if position is defined
if ( $position ) : ?>

	<div class="single-staff-position em-14px clr">
		<?php echo $position; ?>
	</div><!-- .single-staff-position -->

<?php endif; ?>