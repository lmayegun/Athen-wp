<?php
/**
 * Outputs a grid of terms
 *
 * @package     Total
 * @subpackage  vcex_templates
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

// Not needed in admin ever
if ( is_admin() ) {
    return;
}

// Extract shortcode attributes
extract( shortcode_atts( array(
    'unique_id'          => '',
    'classes'            => '',
    'css_animation'      => '',
    'columns'            => '3',
    'columns_gap'        => '',
    'columns_responsive' => '',
    'visibility'         => '',
    'css'                => '',
    'taxonomy'           => 'category',
    'parent_term'        => '',
    'img_size'           => '',
    'img_width'          => '',
    'img_height'         => '',
    'img_crop'           => '',
    'title'              => '',
    'title_typo'         => '',
    'description'        => '',
    'description_typo'   => '',
    'img_hover_style'    => '',
    'img_filter'         => '',
),
$atts ) );

// Sanitize data
$title            = ( 'false' != $title ) ? true : false;
$description      = ( 'false' != $description ) ? true : false;
$title_typo       = vcex_parse_typography_param( $title_typo );
$title_tag        = ( $title_typo['tag'] ) ? $title_typo['tag'] : 'h2';
$description_typo = vcex_parse_typography_param( $description_typo );

// Get terms
$terms = get_terms( $taxonomy, 'objects' );

// Get term thumbnails
$term_data = athen_get_term_data();

// Define post type based on the taxonomy
$taxonomy  = get_taxonomy( $taxonomy );
$post_type = $taxonomy->object_type[0];

// Grid classes
$grid_classes = array( 'vcex-terms-grid', 'wpex-row', 'clr' );
if ( $columns_gap ) {
    $grid_classes[] = 'gap-'. $columns_gap;
}
$grid_classes = implode( ' ', $grid_classes );

// Image classes
$media_classes = array( 'vcex-terms-grid-entry-image', 'clr' );
if ( $img_filter ) {
    $media_classes[] = athen_image_filter_class( $img_filter );
}
if ( $img_hover_style ) {
    $media_classes[] = athen_image_hover_classes( $img_hover_style );
}
$media_classes = implode( ' ', $media_classes );

// Title style
$title_style       = vcex_inline_style( $title_typo );
$description_style = vcex_inline_style( $description_typo ); ?>

<div class="<?php echo $grid_classes; ?>">
        
    <?php
    // Start counter
    $counter = 0;

    // Loop through terms
    foreach( $terms as $term ) :

        // Add to counter
        $counter++; ?>

        <div class="vcex-terms-grid-entry clr if <?php echo ( 'false' == $columns_responsive ) ? 'nr-col' : 'col'; ?> col-<?php echo $counter; ?> span_1_of_<?php echo $columns; ?> <?php echo $term->slug; ?>">

            <?php
            // Check meta for featured image
            $image_id = '';

            // Check athen_term_thumbnails option for custom category image
            if ( ! empty( $term_data[$term->term_id]['thumbnail'] ) ) {

                $image_id = $term_data[$term->term_id]['thumbnail'];

            }

            // Get woo product image
            elseif ( 'product' == $post_type && function_exists( 'get_woocommerce_term_meta' ) ) {
                $image_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
            }

            // Image not defined via meta, display image from first post in term
            if ( ! $image_id ) : ?>

                <?php
                // Query first post in term
                $my_query = new WP_Query( array(
                    'post_type'      => $post_type,
                    'posts_per_page' => '1',
                    'no_found_rows'  => true,
                    'tax_query'      => array(
                        array(
                            'taxonomy' => $term->taxonomy,
                            'field'    => 'id',
                            'terms'    => $term->term_id,
                        )
                    ),
                ) );

                // Get featured image of first post
                if ( $my_query->have_posts() ) {

                    while ( $my_query->have_posts() ) : $my_query->the_post(); ?>

                        <?php $image_id = get_post_thumbnail_id(); ?>

                    <?php endwhile;

                }

                // Reset query
                wp_reset_postdata(); ?>

            <?php endif; ?>

            <?php if ( $image_id ) : ?>

                <div class="<?php echo $media_classes; ?>">
                    <a href="<?php echo get_term_link( $term, $taxonomy ); ?>" title="<?php echo $term->name; ?>">
                        <?php
                        // Display post thumbnail
                        athen_post_thumbnail( array(
                            'attachment' => $image_id,
                            'width'      => $img_width,
                            'height'     => $img_height,
                            'crop'       => $img_crop,
                            'alt'        => $term->name,
                            'size'       => $img_size,
                        ) ); ?>
                    </a>
                </div><!-- .image -->

            <?php endif; ?>

            <?php
            // Display title
            if ( $title && ! empty( $term->name ) ) : ?>

                <<?php echo $title_tag; ?> class="vcex-terms-grid-entry-title"<?php echo $title_style; ?>>
                    <a href="<?php echo get_term_link( $term, $taxonomy ); ?>" title="<?php echo $term->name; ?>">
                        <?php echo $term->name; ?>
                    </a>
                </<?php echo $title_tag; ?>>

            <?php endif; ?>

            <?php if ( $description && ! empty( $term->description ) ) : ?>
                <div class="vcex-terms-grid-entry-excerpt clr"<?php echo $description_style; ?>>
                    <?php echo $term->description; ?>
                </div><!-- .vcex-terms-grid-entry-excerpt -->
            <?php endif; ?>

        </div><!-- .vcex-terms-grid-entry -->

        <?php
        // Clear counter
        if ( $counter == $columns ) $counter = 0; ?>

    <?php endforeach; ?>

</div><!-- .vcex-terms-grid -->