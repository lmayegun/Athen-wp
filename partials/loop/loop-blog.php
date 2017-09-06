<?php
/**
 * Loop Blog
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

// Get blog entry layout
get_template_part( 'partials/blog/blog-entry-layout' );

// Reset counter to clear floats
if ( athen_blog_entry_columns() == $athen_count ) {
    $athen_count=0;
}