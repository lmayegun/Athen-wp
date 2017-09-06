<?php
/**
 * Portfolio entry content template part
 *
 * @package     Total
 * @subpackage  Partials/Portfolio
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       1.6.0
 * @version     2.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get video and thumbnail
$video      = athen_get_portfolio_post_video();
$thumbnail  = athen_get_portfolio_entry_thumbnail();

// Classes
$classes = array( 'portfolio-entry-media', 'clr' );
if ( $overlay = athen_overlay_classes() ) {
    $classes[] = $overlay;
}
$classes = implode( ' ', $classes );

// Return if there isn't a video or a thumbnail
if ( ! $video && ! $thumbnail ) {
    //return;
} ?>

<div class="<?php echo $classes; ?>">
 <?php //var_dump( $thumbnail ); ?>
    <?php
    // If the portfolio post has a video display it
    if ( $video ) : ?>

        <?php echo $video; ?>

    <?php
    // Otherwise display thumbnail if one exists
    elseif ( $thumbnail ) : ?>
            <a href="<?php the_permalink(); ?>" title="<?php athen_esc_title(); ?>" class="portfolio-entry-media-link">
                <?php echo $thumbnail; ?>
                <?php Athen_Overlay::athen_overlay( 'inside_link' ); ?>
            </a>
            <?php Athen_Overlay::athen_overlay( 'outside_link' ); ?>

    <?php endif; ?>

</div><!-- .portfolio-entry-media -->