<?php
/**
 * Outputs the testimonial entry author
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

// Get author
$author = get_post_meta( get_the_ID(), 'athen_testimonial_author', true ); ?>

<?php if ( $author ) : ?>
	<span class="testimonial-entry-author"><?php echo $author; ?></span>
<?php endif; ?>