<?php
/**
 * Search entry thumbnail
 *
 * @package     Total
 * @subpackage  Partials/Search
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
 * @version     2.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Return if there isn't any thumbnail defined
if ( ! has_post_thumbnail() ) {
    return;
}

// Thumbnail arguments
$args = array(
    'size'      => 'thumbnail',
    'width'     => '',
    'height'    => '',
    'alt'       => athen_get_esc_title(),
);

// Apply filters
$args = apply_filters( 'athen_search_thumbnail_args', $args ); ?>

<div class="search-entry-thumb">
    <a href="<?php athen_permalink(); ?>" title="<?php athen_esc_title(); ?>" class="search-entry-img-link">
        <?php athen_post_thumbnail( $args ); ?>
    </a>
</div><!-- .search-entry-thumb -->