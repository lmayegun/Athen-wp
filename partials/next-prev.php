<?php
/**
 * The page header displays at the top of all single pages and posts
 * See framework/page-header.php for all page header related functions.
 *
 * @package     Total
 * @subpackage  Partials
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

// Check if post has terms if so then show next/prev from the same_cat
$has_terms  = athen_post_has_terms( get_the_ID() );
$same_cat   = $has_terms;
$same_cat   = apply_filters( 'athen_next_prev_in_same_term', $same_cat );

// Get taxonomy for same_term filter
if ( $same_cat ) {
    $taxonomy = athen_get_post_type_cat_tax();
    $taxonomy = apply_filters( 'athen_next_prev_same_cat_taxonomy', $taxonomy );
} else {
    $taxonomy = '';
}

// Exclude terms
$excluded_terms = '';

// Previous post link title
$prev_post_link_title = '<span class="fa fa-angle-double-left"></span>%title';
$prev_post_link_title = apply_filters( 'athen_prev_post_link_title', $prev_post_link_title );

// Next post link title
$next_post_link_title = '%title<span class="fa fa-angle-double-right"></span>';
$next_post_link_title = apply_filters( 'athen_next_post_link_title', $next_post_link_title );

// Get post links
if ( $has_terms || athen_is_post_in_series() ) {
    $prev_link  = get_previous_post_link( '%link',  $prev_post_link_title, $same_cat, $excluded_terms, $taxonomy );
    $next_link  = get_next_post_link( '%link', $next_post_link_title, $same_cat, $excluded_terms, $taxonomy );
} else {
    $prev_link  = get_previous_post_link( '%link', $prev_post_link_title, false );
    $next_link  = get_next_post_link( '%link', $next_post_link_title, false );
} ?>

<?php if ( $prev_link || $next_link ) : ?>

    <div class="post-pagination-wrap clr">

        <ul class="post-pagination container clr">

            <?php if ( $prev_link ) : ?>

                <li class="post-prev"><?php echo $prev_link; ?></li>

            <?php endif; ?>

            <?php if ( $next_link ) : ?>

                <li class="post-next"><?php echo $next_link; ?></li>

            <?php endif; ?>
            
        </ul><!-- .post-post-pagination -->

    </div><!-- .post-pagination-wrap -->

<?php endif; ?>