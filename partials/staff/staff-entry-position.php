<?php
/**
 * Staff entry title template part
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

// Return if disabled via the Customizer
if ( ! athen_get_mod( 'staff_entry_position', true ) ) {
	return;
}

// Check for position
$position = get_post_meta( get_the_ID(), 'athen_staff_position', true );

// Return if position is empty
if ( ! $position ) {
	return;
} ?>

<div class="staff-entry-position clr">
	<?php echo $position; ?>
</div><!-- .staff-entry-position -->