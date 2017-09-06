<?php
/**
 * Outputs the testimonial entry meta data
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

<div class="testimonial-entry-meta clr">
	<?php get_template_part( 'partials/testimonials/testimonials-entry-author' ); ?>
	<?php get_template_part( 'partials/testimonials/testimonials-entry-company' ); ?>
</div><!-- .testimonial-entry-meta -->