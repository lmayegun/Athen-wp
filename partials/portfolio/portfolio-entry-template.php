<?php
/**
 * Main portfolio entry template part
 *
 * @package		Total
 * @subpackage	Partials/portfolio
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

// Counter for clearing floats and margins
if ( ! isset( $athen_related_query ) ) {
	global $athen_count;
	$query = 'archive';
} else {
	$query = 'related';
}

// Add Standard Classes
$classes	= array();
$classes[]	= 'portfolio-entry grid-item';
$classes[]	= 'col';
$classes[]	= athen_portfolio_column_class( $query );
$classes[]	= 'col-'. $athen_count;

if( $cat ){
    foreach( $cat as $Cat){
        $classes[] = $Cat;
    }
}

// Get grid style
$athen_grid_style = athen_get_mod( 'portfolio_archive_grid_style', 'fit-rows' );

// Masonry Classes
if ( 'archive' == $query && in_array( $athen_grid_style, array( 'masonry', 'no-margins' ) ) ) {
	$classes[] = ' isotope-entry';
} ?>

<article id="#post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<?php get_template_part( 'partials/portfolio/portfolio-entry', 'media' ); ?>
	<?php get_template_part( 'partials/portfolio/portfolio-entry', 'content' ); ?> 
    
</article><!-- .portfolio-entry -->

