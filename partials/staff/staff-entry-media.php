<?php
/**
 * Staff entry media template part
 *
 * @package		Total
 * @subpackage	Partials/Staff
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		1.6.0
 * @version		2.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get thumbnail
$thumbnail	= athen_get_staff_entry_thumbnail();

// Return if thumbnail isn't defined
if ( ! $thumbnail ) {
	return;
}

// Classes
$classes = array( 'staff-entry-media', 'clr' );
if ( $overlay = athen_overlay_classes() ) {
	$classes[] =	$overlay;
}
$classes = implode( ' ', $classes ); ?>

<div class="<?php echo $classes; ?>">

	<?php
	// Open link around staff members if enabled
	if ( athen_get_mod( 'staff_links_enable', true ) ) : ?>

		<a href="<?php athen_permalink(); ?>" title="<?php athen_esc_title(); ?>" rel="bookmark">

	<?php endif; ?>

		<?php echo $thumbnail; ?>

		<?php
		// Inside overlay HTML
		Athen_Overlay::athen_overlay( 'inside_link' ); ?>

	<?php
	// Close link around staff item if enabled
	if ( athen_get_mod( 'staff_links_enable', true ) ) echo '</a>'; ?>

	<?php
	// Outside overlay HTML
	Athen_Overlay::athen_overlay( 'outside_link' ); ?>

</div><!-- .staff-entry-media -->