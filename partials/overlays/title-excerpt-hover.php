<?php
/**
 * Template for the Title + Excerpt Hover overlay style
 *
 * @package     Total
 * @subpackage  Partials/Overlays
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
 * @version     2.1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Only used for inside position
if ( 'inside_link' != $position ) {
    return;
}

// Get excerpt
$excerpt_length = isset( $args['excerpt_length'] ) ? $args['excerpt_length'] : '15';
$excerpt = athen_get_excerpt( array(
    'length'    => $excerpt_length,
) );

// Make sure excerpt isn't too long when custom
if ( strlen( $excerpt ) > $excerpt_length ) {
    $excerpt = wp_trim_words( $excerpt, $excerpt_length );
} ?>

<div class="overlay-title-excerpt-hover">

    <div class="overlay-title-excerpt-hover-inner clr">

        <div class="overlay-title-excerpt-hover-text clr">

            <h3 class="overlay-title-excerpt-hover-title">
                <?php the_title(); ?>
            </h3><!-- .overlay-title-excerpt-hover-title -->

            <?php if ( $excerpt ) : ?>

                <div class="overlay-title-excerpt-hover-excerpt">
                    <?php echo $excerpt; ?>
                </div><!-- .overlay-title-excerpt-hover-excerpt -->

            <?php endif; ?>

        </div><!-- .overlay-title-excerpt-hover-text -->

    </div><!-- .overlay-title-excerpt-hover-inner -->

</div><!-- .overlay-title-excerpt-hover -->