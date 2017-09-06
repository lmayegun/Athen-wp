<?php
/**
 * Template for the Lightbox + View Text overlay style
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

// Only used for outside position
if ( 'outside_link' != $position ) {
	return;
}

// Load lightbox skin stylesheet
athen_enqueue_ilightbox_skin(); ?>

<div class="overlay-view-lightbox-text">
	<div class="overlay-view-lightbox-text-inner clr">
		<div class="overlay-view-lightbox-text-buttons clr">
			<a href="<?php athen_lightbox_image(); ?>" class="wpex-lightbox" title="<?php athen_esc_title(); ?>"><?php _e( 'Zoom', 'athen_transl' ); ?><span class="fa fa-search"></span></a>
			<a href="<?php the_permalink(); ?>" class="view-post" title="<?php athen_esc_title(); ?>"><?php _e( 'View', 'athen_transl' ); ?><span class="fa fa-arrow-right"></span></a>
		</div><!-- .overlay-view-lightbox-text-buttons -->
	</div><!-- .overlay-view-lightbox-text-inner -->
</div><!-- .overlay-view-lightbox-text -->