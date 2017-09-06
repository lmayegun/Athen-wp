<?php
/**
 * Portfolio single media template part
 *
 * @package     Total
 * @subpackage  Partials/Portfolio
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       1.6.0
 * @version     2.1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get portfolio video
$video = athen_get_portfolio_post_video();

// Get portfolio attachment ( gallery images )
$attachments = athen_get_gallery_ids( get_the_ID() );

// Get portfolio thumbnail
$thumbnail = ( ! $video ) ? athen_get_portfolio_post_thumbnail() : ''; ?>

<div id="portfolio-single-media" class="clr">

    <?php
    // Display slider if there are $attachments
    if ( $attachments ) :

        get_template_part( 'partials/portfolio/portfolio-single-gallery' );

    // Display Post Video if defined
    elseif ( $video ) : ?>
    
        <?php echo $video; ?>
    
    <?php
    // Otherwise display post thumbnail
    elseif ( $thumbnail ) : ?>

        <a href="<?php athen_lightbox_image(); ?>" title="<?php athen_esc_title(); ?>" class="wpex-lightbox">
            <?php echo $thumbnail; ?>
        </a>

    <?php endif; ?>

</div><!-- .portfolio-entry-media -->