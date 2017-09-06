<?php
/**
 * Outputs the testimonial entry content
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
} ?>

<div class="testimonial-entry-content clr">
	<span class="testimonial-caret"></span>
	<?php the_content(); ?>
</div><!-- .home-testimonial-entry-content-->