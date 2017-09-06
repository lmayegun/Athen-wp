<?php
/**
 * Search entry layout
 *
 * @package		Total
 * @subpackage	Partials/Search
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		1.6.0
 * @version		1.0.1
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Add classes to the post_class
$classes	= array();
$classes[]	= 'search-entry';
$classes[]	= 'clr';
if ( ! has_post_thumbnail() ) {
	$classes[] = 'search-entry-no-thumb';
} ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

	<?php get_template_part( 'partials/search/search-entry-thumbnail' ); ?>

	<div class="search-entry-text">

		<?php get_template_part( 'partials/search/search-entry-header' ); ?>
		
		<?php get_template_part( 'partials/search/search-entry-excerpt' ); ?>

	</div><!-- .search-entry-text -->

</article><!-- .entry -->