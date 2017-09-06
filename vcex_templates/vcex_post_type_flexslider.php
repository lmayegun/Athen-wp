<?php
/**
 * Output for the Total button Visual Composer module
 *
 * @package     Total
 * @subpackage  vcex_templates
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
 * @version     2.0.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Not needed in admin ever.
if ( is_admin() ) return;

// Extract shortcode attributes
$atts = shortcode_atts( array(
    'unique_id'                 => '',
    'classes'                   => '',
    'visibility'                => '',
    'post_types'                => '',
    'tax_query'                 => '',
    'tax_query_taxonomy'        => '',
    'tax_query_terms'           => '',
    'posts_per_page'            => '4',
    'order'                     => '',
    'orderby'                   => '',
    'posts_in'                  => '',
    'author_in'                 => '',
    'thumbnail_query'           => true,
    'loop'                      => '',
    'animation'                 => 'fade',
    'slideshow'                 => 'true',
    'slideshow_speed'           => '5000',
    'height_animation'          => '500',
    'control_thumbs'            => 'false',
    'control_thumbs_height'     => '70',
    'control_thumbs_width'      => '70',
    'control_thumbs_pointer'    => '',
    'loop'                      => '',
    'randomize'                 => '',
    'direction'                 => '',
    'animation_speed'           => '600',
    'control_nav'               => '',
    'direction_nav'             => '',
    'direction_nav_hover'       => '',
    'pause_on_hover'            => 'true',
    'img_crop'                  => 'center-center',
    'img_size'                  => 'athen_custom',
    'img_width'                 => '',
    'img_height'                => '',
    'caption'                   => true,
    'caption_location'          => 'over-slider',
    'caption_visibility'        => '',
    'title'                     => 'true',
    'excerpt'                   => 'true',
    'excerpt_length'            => '40',
    'preloader_img'             => '',
    'css'                       => '',
), $atts );

// Extract shortcode atts
extract( $atts );

// Build the WordPress query
$my_query = vcex_build_wp_query( $atts );

//Output posts
if ( $my_query->have_posts() ) :

    // Load inline js
    vcex_inline_js( array( 'slider_pro' ) );

    // Sanitize data and declare main vars
    $wrap_data  = array();
    $slideshow  = vc_is_inline() ? 'false' : $slideshow;
    $thumbnails = ( 'false' == $control_thumbs ) ? false : true;
    $randomize  = ( 'true' == $randomize ) ? true : false;
    $loop       = ( 'true' == $loop ) ? true : false;

    // Slider attributes
    if ( in_array( $animation, array( 'fade', 'fade_slides' ) ) ) {
        $wrap_data[] = 'data-fade="true"';
    }
    if ( $randomize ) {
        $wrap_data[] = 'data-shuffle="true"';
    }
    if ( $loop ) {
        $wrap_data[] = 'data-loop="true"';
    }
    if ( 'true' == $loop ) {
        $wrap_data[] = ' data-loop="true"';
    }
    if ( 'false' == $slideshow ) {
        $wrap_data[] = 'data-auto-play="false"';
    }
    if ( $slideshow && $slideshow_speed ) {
        $wrap_data[] = 'data-auto-play-delay="'. $slideshow_speed .'"';
    }
    if ( 'false' == $direction_nav ) {
        $wrap_data[] = 'data-arrows="false"';
    }
    if ( 'false' == $control_nav ) {
        $wrap_data[] = 'data-buttons="false"';
    }
    if ( 'false' == $direction_nav_hover ) {
        $wrap_data[] = 'data-fade-arrows="false"';
    }
    if ( $thumbnails ) {
        $wrap_data[] = 'data-thumbnails="true"';
    }
    if ( $thumbnails && 'true' == $control_thumbs_pointer ) {
        $wrap_data[] = 'data-thumbnail-pointer="true"';
    }
    if ( $animation_speed ) {
        $wrap_data[] = 'data-animation-speed="'. intval( $animation_speed ) .'"';
    }
    if ( $height_animation ) {
        $wrap_data[] = 'data-height-animation-duration="'. intval( $height_animation ) .'"';
    }
    if ( $control_thumbs_height ) {
        $wrap_data[] = 'data-thumbnail-height="'. intval( $control_thumbs_height ) .'"';
    }
    if ( $control_thumbs_width ) {
        $wrap_data[] = 'data-thumbnail-width="'. intval( $control_thumbs_width ) .'"';
    }

    // Caption attributes and classes
    $caption_data = '';
    $caption_classes = array( 'wpex-slider-caption', 'clr' );
    if ( 'over-image' == $caption_location ) {
        $caption_classes[]  = 'sp-static sp-layer sp-black';
        $caption_data       = ' data-width="100%" data-position="bottomLeft"';
    }
    $caption_classes[] = $caption_location;
    if ( $caption_visibility ) {
        $caption_classes[] = $caption_visibility;
    }
    $caption_classes = implode( ' ', $caption_classes );

    // Main Classes
    $wrap_classes = array( 'vcex-posttypes-slider', 'wpex-slider', 'slider-pro', 'vcex-image-slider', 'clr' );
    if ( $classes ) {
        $wrap_classes[] = $this->getExtraClass( $classes );
    }
    if ( $visibility ) {
        $wrap_classes[] = $visibility;
    }
    if ( 'true' == $excerpt ) {
        $wrap_classes[] = 'has-excerpt';
    }
    if ( $control_thumbs ) {
        $wrap_classes[] = 'has-thumbnails';
    }

    // Convert arrays into strings
    $wrap_classes       = implode( ' ', $wrap_classes );
    $wrap_data    = ' '. implode( ' ', $wrap_data ); ?>

    <?php
    // Open css wrapper
    if ( $css ) : ?>
        <div class="vcex-posttype-slider-css-wrap <?php echo apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css ), 'vcex_image_flexslider', $atts ); ?>">
    <?php endif; ?>

    <?php
    // Display the first image of the slider as a "preloader"
    if ( 'false' != $preloader_img && $first_post = $my_query->posts[0]->ID ) : ?>

        <div class="wpex-slider-preloaderimg">

            <?php athen_post_thumbnail( array(
                'attachment'    => get_post_thumbnail_id( $first_post ),
                'size'          => $img_size,
                'crop'          => $img_crop,
                'width'         => $img_width,
                'height'        => $img_height,
            ) ); ?>

        </div><!-- .wpex-slider-preloaderimg -->

    <?php endif; ?>

    <div class="<?php echo $wrap_classes; ?>"<?php vcex_unique_id( $unique_id ); ?><?php echo $wrap_data; ?>>

        <div class="wpex-slider-slides sp-slides">

                <?php
                // Store posts in an array for use with the thumbnails later
                $posts_cache = array();

                // Loop through posts
                while ( $my_query->have_posts() ) :

                    // Get post from query
                    $my_query->the_post();

                    // Store post ids
                    $posts_cache[] = get_the_ID(); ?>

                    <div class="wpex-slider-slide sp-slide">

                        <div class="wpex-slider-media">

                            <?php if ( has_post_thumbnail() ) : ?>

                                    <a href="<?php athen_permalink(); ?>" title="<?php athen_esc_title(); ?>">
                                        <?php athen_post_thumbnail( array(
                                            'size'      => $img_size,
                                            'crop'      => $img_crop,
                                            'width'     => $img_width,
                                            'height'    => $img_height,
                                            'alt'       => athen_get_esc_title(),
                                        ) ); ?>
                                    </a>

                                <?php endif; ?>

                            <?php
                            // WooComerce Price
                            if ( class_exists( 'Woocommerce' ) && 'product' == get_post_type() ) : ?>
                                <div class="slider-woocommerce-price">
                                    <?php athen_woo_product_price(); ?>
                                </div><!-- .slider-woocommerce-price -->
                            <?php endif; ?>

                            <?php if ( 'false' != $caption ) : ?>

                                <div class="<?php echo $caption_classes; ?>"<?php echo $caption_data ;?>>

                                    <?php
                                    // Display title
                                    if ( 'true' == $title ) : ?>

                                        <header class="vcex-posttype-slider-header clr">
                                            <div class="vcex-posttype-slider-title entry-title">
                                                <a href="<?php athen_permalink(); ?>" title="<?php athen_esc_title(); ?>" class="title"><?php the_title(); ?></a>
                                            </div><!-- .entry-title -->
                                            <?php if ( 'staff' == get_post_type() && get_post_meta( get_the_ID(), 'athen_staff_position', true ) ) : ?>
                                                <div class="staff-position">
                                                    <?php echo get_post_meta( get_the_ID(), 'athen_staff_position', true ); ?>
                                                </div>
                                            <?php endif; ?>
                                        </header>

                                    <?php endif; ?>
                                    
                                    <?php
                                    // Display excerpt
                                    if ( 'true' == $excerpt ) : ?>

                                        <div class="excerpt clr">
                                            <?php athen_excerpt( array (
                                                'length' => $excerpt_length,
                                            ) ); ?>
                                        </div><!-- .excerpt -->

                                    <?php endif; ?>

                                </div><!-- .vcex-img-flexslider-caption -->

                            <?php endif; ?>

                    </div><!-- .wpex-slider-media -->

                </div><!-- .wpex-slider-slide -->

            <?php endwhile; ?>
            
        </div><!-- .wpex-slider-slides -->

        <?php if ( $thumbnails ) : ?>

            <div class="wpex-slider-thumbnails sp-thumbnails">

                <?php foreach ( $posts_cache as $post_id ) : ?>

                    <?php
                    // Output thumbnail image
                    athen_post_thumbnail( array(
                        'attachment'    => get_post_thumbnail_id( $post_id ),
                        'size'          => $img_size,
                        'crop'          => $img_crop,
                        'width'         => $img_width,
                        'height'        => $img_height,
                        'class'         => 'wpex-slider-thumbnail sp-thumbnail',
                    ) ); ?>

                <?php endforeach; ?>

            </div><!-- .wpex-slider-thumbnails -->

        <?php endif; ?>

    </div><!-- .<?php echo $wrap_classes; ?> -->

    <?php
    // Close css wrapper
    if ( $css ) echo '</div>'; ?>

    <?php
    // Remove post object from memory
    $post = null;

    // Reset the post data to prevent conflicts with WP globals
    wp_reset_postdata(); ?>

<?php
// If no posts are found display message
else : ?>

    <?php
    // Display no posts found error if function exists
    echo vcex_no_posts_found_message( $atts ); ?>

<?php
// End post check
endif; ?>