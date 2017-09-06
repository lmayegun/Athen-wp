<?php
/**
 * Output for the bullets Visual Composer module
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
    'count'                     => '3',
    'term_slug'                 => '',
    'post_type'                 => 'testimonials',
    'tax_query'                 => '',
    'include_categories'        => '',
    'exclude_categories'        => '',
    'category'                  => 'all',
    'order'                     => 'DESC',
    'orderby'                   => 'date',
    'orderby_meta_key'          => '',
    'skin'                      => 'light',
    'font_size'                 => '',
    'font_weight'               => '',
    'background'                => '',
    'background_image'          => '',
    'background_style'          => 'stretch',
    'css_animation'             => '',
    'excerpt'                   => '',
    'excerpt_length'            => '20',
    'read_more'                 => 'true',
    'read_more_text'            => __( 'read more', 'athen_transl' ),
    'offset'                    => 0,
    'unique_id'                 => '',
    'loop'                      => '',
    'animation'                 => 'fade_slides',
    'slideshow'                 => 'true',
    'slideshow_speed'           => '5000',
    'height_animation'          => '400',
    'control_thumbs'            => '',
    'control_thumbs_height'     => '50',
    'control_thumbs_width'      => '50',
    'randomize'                 => '',
    'direction'                 => '',
    'animation_speed'           => '',
    'control_nav'               => '',
    'direction_nav'             => '',
    'display_author_name'       => '',
    'display_author_avatar'     => '',
    'display_author_company'    => '',
    'padding_bottom'            => '',
    'padding_top'               => '',
    'img_size'                  => 'athen_custom',
    'img_crop'                  => 'center-center',
    'img_width'                 => '70',
    'img_height'                => '70',
    'img_border_radius'         => '',
    'css'                       => '',
), $atts );

// Extract shortcode atts
extract( $atts );

// Fallback for term slug
if ( $term_slug ) {
    $include_categories = $term_slug;
}

// Posts per page
$posts_per_page = $count;

// Build the WordPress query
$my_query = vcex_build_wp_query( $atts );

// Output posts
if ( $my_query->have_posts() ) :

    // Define and sanitize variables
    $slideshow          = vc_is_inline() ? 'false' : $slideshow;
    $img_border_radius  = ( '50%' == $img_border_radius ) ? '' : $img_border_radius;

    // Load js
    vcex_inline_js( array( 'slider_pro' ) );
   
    // Get post meta to check page layout
    $inner_classes = array( 'entry' );
    /*if ( 'full-screen' == athen_get_post_layout() ) {
        $inner_classes[] = 'container';
    }*/
    $inner_classes = implode( ' ', $inner_classes );

    // Add Style
    if ( ! $css ) {
        $wrap_style = vcex_inline_style( array(
            'background_color'  => $background,
            'background_image'  => wp_get_attachment_url( $background_image ),
            'padding_top'       => $padding_top,
            'padding_bottom'    => $padding_bottom,
        ) );
    } else {
        $wrap_style = '';
    }

    // Slide Style
    $slide_style = vcex_inline_style( array(
        'font_size'     => $font_size,
        'font_weight'   => $font_weight,
    ) );

    // Image classes
    $img_classes = '';
    if ( ( $img_width || $img_height ) || 'athen_custom' != $img_size ) {
        $img_classes = 'remove-dims';
    }

    // Wrap classes
    $wrap_classes = array( 'vcex-testimonials-fullslider', 'vcex-flexslider-wrap' );
    if ( $skin ) {
        $wrap_classes[] = $skin .'-skin';
    }
    if ( 'true' == $direction_nav ) {
        $wrap_classes[] = 'has-arrows';
    }
    if ( 'true' == $control_thumbs ) {
        $wrap_classes[] = 'has-thumbs';
    }
    if ( $background_style && $background_image ) {
        $wrap_classes[] = 'vcex-background-'. $background_style;
    }
    if ( $css_animation ) {
        $wrap_classes[] = $this->getCSSAnimation( $css_animation );
    }
    if ( $css ) {
        $wrap_classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css ), 'vcex_testimonials_slider', $atts );
    }
    $wrap_classes   = implode( ' ', $wrap_classes );

    // Wrap data
    $slider_data    = array();
    $slider_data[]  = 'data-dots="true"';
    $slider_data[]  = 'data-fade-arrows="false"';
    if ( 'false' != $loop ) {
        $slider_data[] = ' data-loop="true"';
    }
    if ( 'false' == $slideshow ) {
        $slider_data[] = 'data-auto-play="false"';
    }
    if ( in_array( $animation, array( 'fade', 'fade_slides' ) ) ) {
        $slider_data[] = 'data-fade="true"';
    }
    if ( $slideshow && $slideshow_speed ) {
        $slider_data[] = 'data-auto-play-delay="'. $slideshow_speed .'"';
    }
    if ( 'true' != $direction_nav ) {
        $slider_data[] = 'data-arrows="false"';
    }
    if ( 'false' == $control_nav ) {
        $slider_data[] = 'data-buttons="false"';
    }
    if ( 'true' == $control_thumbs ) {
        $slider_data[] = 'data-thumbnails="true"';
    }
    if ( $animation_speed ) {
        $slider_data[] = 'data-animation-speed="'. intval( $animation_speed ) .'"';
    }
    if ( $height_animation ) {
        $slider_data[] = 'data-height-animation-duration="'. intval( $height_animation ) .'"';
    }
    if ( $control_thumbs_height ) {
        $slider_data[] = 'data-thumbnail-height="'. intval( $control_thumbs_height ) .'"';
    }
    if ( $control_thumbs_width ) {
        $slider_data[] = 'data-thumbnail-width="'. intval( $control_thumbs_width ) .'"';
    }
    $slider_data = ' '. implode( ' ', $slider_data );

    // Image settings & style
    $img_style  = vcex_inline_style( array(
        'border_radius' => $img_border_radius,
    ) ); ?>

    <div class="<?php echo $wrap_classes; ?>"<?php vcex_unique_id( $unique_id ); ?><?php echo $wrap_style; ?>>

        <div class="wpex-slider slider-pro"<?php echo $slider_data; ?>>

            <div class="wpex-slider-slides sp-slides">

                <?php
                // Store posts in an array for use with the thumbnails later
                $posts_cache = array();

                // Loop through posts
                while ( $my_query->have_posts() ) :

                    // Get post from query
                    $my_query->the_post();

                    // Create new post object
                    $testimonial = new stdClass();

                    // Get post
                    $post = get_post();

                    // Get post data
                    $testimonial->ID        = $post->ID;
                    $testimonial->content   = $post->post_content;
                    $testimonial->author    = get_post_meta( get_the_ID(), 'athen_testimonial_author', true );
                    $testimonial->company   = get_post_meta( get_the_ID(), 'athen_testimonial_company', true );
                    $testimonial->url       = get_post_meta( get_the_ID(), 'athen_testimonial_url', true );

                    // Store post ids
                    $posts_cache[] = $post->ID;

                    // Testimonial start
                    if ( '' != $testimonial->content ) : ?>

                        <div class="wpex-slider-slide sp-slide">

                            <div class="<?php echo $inner_classes ; ?>"<?php echo $slide_style; ?>>

                                <?php
                                // Author avatar
                                if ( 'yes' == $display_author_avatar && has_post_thumbnail( $testimonial->ID ) ) : ?>

                                    <div class="vcex-testimonials-fullslider-avatar">

                                        <?php athen_post_thumbnail( array(
                                            'size'      => $img_size,
                                            'crop'      => $img_crop,
                                            'width'     => $img_width,
                                            'height'    => $img_height,
                                            'alt'       => athen_get_esc_title(),
                                            'style'     => $img_style,
                                            'class'     => $img_classes,
                                        ) ); ?>

                                    </div><!-- .vcex-testimonials-fullslider-avatar -->

                                <?php endif; ?>

                                <?php
                                // Custom Excerpt
                                if ( 'true' == $excerpt ) :

                                    if ( 'true' == $read_more ) {
                                        $read_more_link = '...<a href="'. get_permalink() .'" title="'. $read_more_text .'">'. $read_more_text .'<span>&rarr;</span></a>';
                                    } else {
                                        $read_more_link = '...';
                                    }

                                    athen_excerpt( array (
                                        'length'    => intval( $excerpt_length ),
                                        'more'      => $read_more_link,
                                    ) );

                                // Full content
                                else :

                                    the_content();
                                
                                endif;

                                // Author name
                                if ( 'yes' == $display_author_name || 'yes' == $display_author_company ) : ?>

                                    <div class="vcex-testimonials-fullslider-author">

                                        <?php
                                        // Display author name
                                        echo $testimonial->author; ?>

                                        <?php
                                        // Display company
                                        if ( $testimonial->company && 'true' == $display_author_company ) {
                                            if ( $testimonial->url ) { ?>
                                                <a href="<?php echo esc_url( $testimonial->url ); ?>" class="vcex-testimonials-fullslider-company" title="<?php echo esc_attr( $company ); ?>" target="_blank"><?php echo $testimonial->company; ?></a>
                                            <?php } else { ?>
                                                <span class="vcex-testimonials-fullslider-company"><?php echo $testimonial->company; ?></span>
                                            <?php }
                                        } ?>

                                    </div><!-- .vcex-testimonials-fullslider-author -->

                                <?php endif; ?>

                            </div><!-- .entry -->

                        </div><!-- .wpex-slider-slide sp-slide -->

                    <?php endif; ?>

                <?php endwhile; ?>

            </div><!-- .wpex-slider-slides -->

            <?php if ( 'true' == $control_thumbs ) : ?>

                <div class="sp-nc-thumbnails">

                    <?php foreach ( $posts_cache as $post_id ) : ?>

                        <?php
                        // Output thumbnail image
                        athen_post_thumbnail( array(
                            'attachment'    => get_post_thumbnail_id( $post_id ),
                            'size'          => $img_size,
                            'crop'          => $img_crop,
                            'width'         => $img_width,
                            'height'        => $img_height,
                            'class'         => 'sp-nc-thumbnail',
                        ) ); ?>

                    <?php endforeach; ?>

                </div><!-- .sp-nc-thumbnailss -->

            <?php endif; ?>

        </div><!-- .wpex-slider -->

    </div><!-- .vcex-testimonials-fullslider -->

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