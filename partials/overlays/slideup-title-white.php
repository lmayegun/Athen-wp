<?php
/**
 * Template for the Slide Up Title White overlay style
 *
 * @package		Total
 * @subpackage	Partials/Overlays
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		1.6.0
 * @version		1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Only used for inside position
if ( 'inside_link' != $position ) {
	return;
} ?>

<div class="overlay-slideup-title white clr">
	<span class="title">
		<?php if ( 'staff' == get_post_type() ) {
			echo get_post_meta( get_the_ID(), 'athen_staff_position', true );
		} else {
			the_title();
		} ?>
	</span>
</div>