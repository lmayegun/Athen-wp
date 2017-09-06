<?php
/**
 * Staff entry content template part
 *
 * @package		Total
 * @subpackage	Partials/Staff
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

// Return if disabled for standard entries
if ( ! is_singular( 'staff' ) && ! athen_get_mod( 'staff_entry_details', true ) ) {
		return;
}

// Return if disabled for related entries
if ( is_singular( 'staff' ) && ! athen_get_mod( 'staff_related_excerpts', true ) ) {
	return;
}

// Entry content classes
$classes = 'staff-entry-details clr';
if ( athen_staff_match_height() ) {
	$classes .= ' match-height-content';
} ?>

<div class="<?php echo $classes; ?>">
	<?php get_template_part( 'partials/staff/staff-entry', 'title' ); ?>
	<?php get_template_part( 'partials/staff/staff-entry', 'position' ); ?>
	<?php get_template_part( 'partials/staff/staff-entry', 'excerpt' ); ?>
	<?php get_template_part( 'partials/staff/staff-entry', 'social' ); ?>
        <?php get_template_part( 'partials/staff/staff-entry', 'tag' ); ?>
        
</div><!-- .staff-entry-details -->