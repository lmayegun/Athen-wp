<?php
/**
 * Outputs the testimonial entry avatar
 *
 * @package		Total
 * @subpackage	Partials/Testimonials
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

// Get image data
$thumbnail = athen_get_testimonials_entry_thumbnail();

// Return if there isn't any thumbnail
if ( ! $thumbnail ) {
	return;
} ?>

<div class="testimonial-entry-thumb">
	<?php echo $thumbnail ?>
</div><!-- /testimonial-thumb -->