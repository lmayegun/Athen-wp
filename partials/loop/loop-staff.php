<?php
/**
 * Main Loop : Staff
 *
 * @package     Total
 * @subpackage  Partials
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       2.1.0
 * @version     2.1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Add to counter
global $athen_count;
$athen_count++;

	// Include template part
	get_template_part( 'partials/staff/staff-entry' );

// Clear Counter
if ( athen_staff_archive_columns() == $athen_count ) {
	$athen_count=0;
}