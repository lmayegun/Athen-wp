<?php
/**
 * Template for the Title + Category Visible overlay style
 *
 * @package		Total
 * @subpackage	Partials/Overlays
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

// Only used for inside position
if ( 'inside_link' != $position ) {
	return;
}

// Get category taxonomy for current post type
$taxonomy = athen_get_post_type_cat_tax();

// Get terms
if ( $taxonomy ) {
	$terms = athen_list_post_terms( $taxonomy, $show_links = false, $echo = false );
} ?>

<div class="overlay-title-category-visible">
	<div class="overlay-title-category-visible-inner clr">
		<div class="overlay-title-category-visible-text clr">
			<div class="overlay-title-category-visible-title">
				<?php the_title(); ?>
			</div><!-- .overlay-title-category-visible-title -->
			<?php if ( ! empty( $terms ) ) : ?>
				<div class="overlay-title-category-visible-category">
					<?php echo $terms; ?>
				</div><!-- .overlay-title-category-visible-category -->
			<?php endif; ?>
		</div><!-- .overlay-title-category-visible-text -->
	</div><!-- .overlay-title-category-visible-inner -->
</div><!-- .overlay-title-category-visible -->