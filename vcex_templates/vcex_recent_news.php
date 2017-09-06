<?php
/**
 * Output for the Recent News Visual Composer module
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

// Get shortcode attributes
$atts = shortcode_atts( array(
    'unique_id'                 => '',
    'classes'                   => '',
    'visibility'                => '',
    'post_types'                => 'post',
    'term_slug'                 => 'all',
    'taxonomies'                => 'category',
    'tax_query'                 => '',
    'include_categories'        => '',
    'exclude_categories'        => '',
    'ignore_sticky_posts'       => '',
    'count'                     => '12',
    'grid_columns'              => '',
    'order'                     => '',
    'orderby'                   => '',
    'orderby_meta_key'          => '',
    'header'                    => '',
    'heading'                   => 'h3',
    'date'                      => '',
    'month_background'          => '',
    'month_color'               => '',
    'excerpt_length'            => '',
    'excerpt_font_size'         => '',
    'excerpt_color'             => '',
    'read_more'                 => '',
    'readmore_style'            => 'flat',
    'readmore_background'       => '',
    'readmore_style_color'      => '',
    'readmore_color'            => '',
    'readmore_hover_color'      => '',
    'readmore_hover_background' => '',
    'readmore_size'             => '',
    'readmore_padding'          => '',
    'readmore_margin'           => '',
    'readmore_border_radius'    => '',
    'read_more_text'            => '',
    'readmore_rarr'             => '',
    'offset'                    => 0,
    'taxonomy'                  => '',
    'terms'                     => '',
    'css_animation'             => '',
    'img_size'                  => 'athen_custom',
    'img_crop'                  => '',
    'img_width'                 => '',
    'img_height'                => '',
    'featured_image'            => '',
    'featured_video'            => '',
    'pagination'                => '',
    'get_posts'                 => 'standard_post_types',
    'title'                     => '',
    'title_size'                => '',
    'title_weight'              => '',
    'title_transform'           => '',
    'title_line_height'         => '',
    'title_margin'              => '',
    'css'                       => '',
    'entry_bottom_border_color' => '',
), $atts );

// Extract shortcode atts
extract( $atts );

// Custom taxonomy only for standard posts
if ( 'custom_post_types' == $get_posts ) {
    $include_categories = $exclude_categories ='';
}

// Get Standard posts
if ( 'standard_post_types' == $get_posts ) {
    $atts['post_types'] = 'post';
}

// Build the WordPress query
$my_query = vcex_build_wp_query( $atts );

//Output posts
if ( $my_query->have_posts() ) :

    // Sanitize data
    $inline_js      = array();
    $title          = ( 'false' == $title ) ? false : true;
    $date           = ( 'false' == $date ) ? false : true;
    $featured_image = ( 'true' == $featured_image ) ? true : false;
    $featured_video = ( 'false' == $featured_video ) ? false : true;
    $read_more      = ( 'false' == $read_more ) ? false : true;
    $read_more_text = $read_more_text ? $read_more_text : __( 'read more', 'athen_transl' );
    $excerpt_length = $excerpt_length ? $excerpt_length : '15';
    $grid_columns   = $grid_columns ? $grid_columns : '1';
    
    // Wrapper Classes
    $wrap_classes = 'vcex-recent-news clr';
    if ( $classes ) {
        $wrap_classes .= $this->getExtraClass( $classes );
    }
    if ( $visibility ) {
        $wrap_classes .= ' '. $visibility;
    }
    if ( '1' != $grid_columns ) {
        $wrap_classes .= ' wpex-row';
    }
    if ( $css ) {
        $wrap_classes .= apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'vcex_recent_news', $atts );
    }

    // Entry Classes
    $entry_classes = array( 'vcex-recent-news-entry', 'clr' );
    if ( ! $date ) {
        $entry_classes[] = 'no-left-padding';
    }
    if ( $css_animation ) {
        $entry_classes[] = $this->getCSSAnimation( $css_animation );
    }

    // Entry Style
    $entry_style = vcex_inline_style( array(
        'border_color' => $entry_bottom_border_color
    ) );

    // Heading style
    if ( $title ) {
        $heading_style = vcex_inline_style( array(
            'font_size'         => $title_size,
            'font_weight'       => $title_weight,
            'text_transform'    => $title_transform,
            'line_height'       => $title_line_height,
            'margin'            => $title_margin,
        ) );
    }

    // Excerpt style
    $excerpt_style = vcex_inline_style( array(
        'font_size' => $excerpt_font_size,
        'color'     => $excerpt_color,
    ) );

    // Month Style
    if ( $date ) {
        $month_style = vcex_inline_style( array(
            'background_color'  => $month_background,
            'color'             => $month_color,
        ) );
    }

    // Readmore design and classes
    if ( $read_more ) {

        // Readmore classes
        $readmore_classes   = array( 'vcex-button', 'animate-on-hover' );
        if ( $readmore_hover_color || $readmore_hover_background ) {
            $readmore_classes[] = ' wpex-data-hover';
        }
        $readmore_classes[] = $readmore_style;
        if ( $readmore_style_color ) {
            $readmore_classes[] = $readmore_style_color;
        }
        $readmore_classes = implode( ' ', $readmore_classes );

        // Read more style
        $readmore_border_color  = ( 'outline' == $readmore_style ) ? $readmore_color : '';
        $readmore_style = vcex_inline_style( array(
            'background'    => $readmore_background,
            'color'         => $readmore_color,
            'border_color'  => $readmore_border_color,
            'font_size'     => $readmore_size,
            'padding'       => $readmore_padding,
            'border_radius' => $readmore_border_radius,
            'margin'        => $readmore_margin,
        ) );

        // Readmore data
        $readmore_data = '';
        if ( $readmore_hover_color ) {
            $readmore_data .= ' data-hover-color="'. $readmore_hover_color .'"';
        }
        if ( $readmore_hover_background ) {
            $readmore_data .= ' data-hover-background="'. $readmore_hover_background .'"';
        }
    }

    // Hover js
    if ( $readmore_hover_color || $readmore_hover_background ) {
         $inline_js[] = 'data_hover';
    }

    // Load inline js
    if ( ! empty( $inline_js ) ) {
        vcex_inline_js( $inline_js );
    } ?>

    <div class="<?php echo $wrap_classes; ?>"<?php vcex_unique_id( $unique_id ); ?>>
    
        <?php if ( $header && function_exists( 'athen_heading' ) ) : ?>
            <?php athen_heading( array(
                'content'   => $header,
                'tag'       => 'h2',
                'classes'   => array( 'vcex-recent-news-header' ),
            ) ); ?>
        <?php endif; ?>

        <?php
        // Loop through posts
        $count = '0';
        while ( $my_query->have_posts() ) :

            // Get post from query
            $my_query->the_post();

            // Add to counter
            $count++;

            // Create new post object.
            $post = new stdClass();
        
            // Post VARS
            $post->ID               = get_the_ID();
            $post->permalink        = athen_get_permalink( $post->ID );
            $post->the_title        = get_the_title( $post->ID );
            $post->the_title_esc    = esc_attr( the_title_attribute( 'echo=0' ) );
            $post->type             = get_post_type( $post->ID );
            $post->video_embed      = athen_get_post_video_html();
            $post->format           = get_post_format( $post->ID ); ?>

            <?php if ( $grid_columns > '1' ) : ?>
                <div class="col span_1_of_<?php echo $grid_columns; ?> vcex-recent-news-entry-wrap col-<?php echo $count; ?>">
            <?php endif; ?>

            <article <?php echo post_class( $entry_classes ); ?><?php echo $entry_style; ?>>

                <?php if ( $date ) : ?>

                    <div class="vcex-recent-news-date">

                        <span class="day">

                            <?php if ( 'tribe_events' == $post->type && function_exists( 'tribe_get_start_date' ) ) : ?>

                                <?php echo tribe_get_start_date( $post->ID, false, 'd' ); ?>

                            <?php else : ?> 

                                <?php echo get_the_time( 'd', $post->ID ); ?>

                            <?php endif; ?>

                        </span><!-- .day -->

                        <span class="month"<?php echo $month_style; ?>>

                            <?php if ( 'tribe_events' == $post->type && function_exists( 'tribe_get_start_date' ) ) : ?>

                                <span><?php echo tribe_get_start_date( $post->ID, false, 'M' ); ?></span>
                                <span class="year"><?php echo tribe_get_start_date( $post->ID, false, 'y' ); ?></span>

                            <?php else : ?> 

                                <span><?php echo get_the_time( 'M', $post->ID ); ?></span>
                                <span class="year"><?php echo get_the_time( 'y', $post->ID ); ?></span>

                            <?php endif; ?>
                        </span><!-- .month -->

                    </div><!-- .vcex-recent-news-date -->

                <?php endif; ?>

                <div class="vcex-news-entry-details clr">

                    <?php if ( $featured_image ) : ?>

                        <?php if ( $featured_video && $post->video_embed ) : ?>

                            <div class="vcex-news-entry-video clr">
                                <?php echo $post->video_embed; ?>
                            </div><!-- .vcex-news-entry-video -->

                        <?php elseif ( has_post_thumbnail( $post->ID ) ) : ?>

                            <div class="vcex-news-entry-thumbnail clr">
                                <a href="<?php echo $post->permalink; ?>" title="<?php athen_esc_title(); ?>">
                                    <?php athen_post_thumbnail( array(
                                        'size'      => $img_size,
                                        'crop'      => $img_crop,
                                        'width'     => $img_width,
                                        'height'    => $img_height,
                                        'alt'       => athen_get_esc_title(),
                                    ) ); ?>
                                </a>
                            </div><!-- .vcex-news-entry-thumbnail -->

                        <?php endif; ?>

                    <?php endif; ?>

                    <?php if ( $title ) : ?>

                        <header class="vcex-recent-news-entry-title entry-title">
                            <<?php echo $heading; ?> class="vcex-recent-news-entry-title-heading"<?php echo $heading_style; ?>>
                                <a href="<?php echo $post->permalink; ?>" title="<?php athen_esc_title(); ?>"><?php the_title(); ?></a>
                            </<?php echo $heading; ?>>
                        </header><!-- .vcex-recent-news-entry-title -->

                    <?php endif; ?>

                    <div class="vcex-recent-news-entry-excerpt clr">

                        <div class="entry"<?php echo $excerpt_style; ?>>
                            <?php athen_excerpt( array (
                                'length' => $excerpt_length,
                            ) ); ?>
                        </div><!-- .entry -->

                        <?php
                        // Display readmore link
                        if ( $read_more && $read_more_text ) : ?>

                            <a href="<?php echo $post->permalink; ?>" title="<?php echo esc_attr( $read_more_text ); ?>" rel="bookmark" class="<?php echo $readmore_classes; ?>"<?php echo $readmore_style; ?><?php echo $readmore_data; ?>>
                                <?php echo $read_more_text; ?>
                                <?php if ( 'true' == $readmore_rarr ) { ?>
                                    <span class="vcex-readmore-rarr"><?php echo athen_element( 'rarr' ); ?></span>
                                <?php } ?>
                            </a>

                        <?php endif; ?>

                    </div><!-- .vcex-recent-news-entry-excerpt -->

                </div><!-- .vcex-recent-news-entry-details -->

            </article><!-- .vcex-recent-news-entry -->

            <?php if ( $grid_columns > '1' ) echo '</div>'; ?>

            <?php if ( $count == $grid_columns ) $count = ''; ?>

        <?php endwhile; ?>

        <?php if ( 'true' == $pagination ) : ?>
            <?php athen_pagination( $my_query ); ?>
        <?php endif; ?>
    
    </div><!-- .vcex-recent-news -->

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