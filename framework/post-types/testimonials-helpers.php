<?php
/**
 * Description : Function for testimonials post-type related components. 
 * 
 * @package     Athen
 * @subpackage  Closer - Controller
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 */

/**
 * Returns correct thumbnail HTML for the testimonials entries
 *
 * @since 2.0.0
 */
function athen_get_testimonials_entry_thumbnail() {
    return athen_get_post_thumbnail( array(
        'size'  => 'testimonials_entry',
        'class' => 'testimonials-entry-img',
        'alt'	=> athen_get_esc_title(),
    ) );
}

/**
 * Returns testimonials archive columns
 *
 * @since 2.0.0
 */
function athen_testimonials_archive_columns() {
	return athen_get_mod( 'testimonials_entry_columns', '4' );
}

/**
 * Returns correct classes for the testimonials archive wrap
 *
 * @since	2.0.0
 * @return	var $classes
 */
function athen_get_testimonials_wrap_classes() {

	// Define main classes
	$classes = array( 'wpex-row', 'clr' );

	// Apply filters
	apply_filters( 'athen_testimonials_wrap_classes', $classes );

	// Turninto space seperated string
	$classes = implode( " ", $classes );

	// Return
	return $classes;

}