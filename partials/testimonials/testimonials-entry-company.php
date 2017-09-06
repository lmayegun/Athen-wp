<?php
/**
 * Outputs the testimonial entry company
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

// Testimonial data
$company		= get_post_meta( get_the_ID(), 'athen_testimonial_company', true );
$company_url	= get_post_meta( get_the_ID(), 'athen_testimonial_url', true ); ?>

<?php if ( $company ) : ?>
	<?php if ( $company_url ) : ?>
		<a href="<?php echo esc_url( $company_url ); ?>" class="testimonial-entry-company" title="<?php echo $company; ?>" target="_blank"><?php echo $company; ?></a>
	<?php else : ?>
		<span class="testimonial-entry-company"><?php echo $company; ?></span>
	<?php endif; ?>
<?php endif; ?>