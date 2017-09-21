<?php
/**
 * Output for the Teaser Visual Composer module
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
extract( shortcode_atts( array(
    'unique_id'                 => '',
    'heading'                   => '',
    'heading_type'              => 'h2',
    'heading_color'             => '',
    'heading_size'              => '',
    'heading_margin'            => '',
    'heading_weight'            => '',
    'heading_letter_spacing'    => '',
    'heading_transform'         => '',
    'style'                     => 'one',
    'text_align'                => '',
    'image'                     => '',
    'img_width'                 => '',
    'img_height'                => '',
    'video'                     => '',
    'content_background'        => '',
    'url'                       => '',
    'url_target'                => '',
    'url_rel'                   => '',
    'url_title'                 => '',
    'url_local_scroll'          => '',
    'hover_animation'           => '',
    'css_animation'             => '',
    'img_filter'                => '',
    'img_hover_style'           => '',
    'img_rendering'             => '',
    'content_font_size'         => '',
    'content_margin'            => '',
    'content_padding'           => '',
    'content_color'             => '',
    'content_font_weight'       => '',
    'background'                => '',
    'border_color'              => '',
    'padding'                   => '',
    'border_radius'             => '',
    'img_style'                 => '',
    'classes'                   => '',
    'visibility'                => '',
    'css'                       => '',
    'teaser_button'             => '',
    'button_teaser_animation'   => '',
    'button_bg_transition'      => '',
    'button_animation_icon'     => '',
    'button_color'              => '',
    'button_color_hover'        => '',


), $atts ) );
/*
var_dump($teaser_button);
var_dump($button_teaser_animation);
var_dump($button_bg_transition);
var_dump($button_animation_icon);
var_dump($button_color);
var_dump($button_color_hover);
*/

// Add main Classes
$wrap_classes = array( 'vcex-teaser' );
if ( $css_animation ) {
    $wrap_classes[] = $this->getCSSAnimation( $css_animation );
}
if ( $style ) {
    $wrap_classes[] = 'vcex-teaser-'. $style;
}
if ( $text_align ) {
    $wrap_classes[] = 'vcex-text-align-'. $text_align;
}
if ( $classes ) {
    $wrap_classes[] = $this->getExtraClass( $classes );
}
if ( $visibility ) {
    $wrap_classes[] = $visibility;
}
if ( $hover_animation ) {
    $wrap_classes[] = athen_hover_animation_class( $hover_animation );
    vcex_enque_style( 'hover-animations' );
}
$wrap_classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css ), 'vcex_teaser', $atts );
$wrap_classes   = implode( ' ', $wrap_classes );

// Add inline style for main div
$wrap_style = '';
if ( $padding && 'two' == $style ) {
    $wrap_style .= 'padding:'. $padding.';';
}
if ( $background && 'two' == $style ) {
    $wrap_style .= 'background:'. $background.';';
}
if ( $content_background ) {
    $wrap_style .= 'background:'. $content_background.';';
}
if ( $background && 'three' == $style && '' == $content_background ) {
    $wrap_style .= 'background:'. $background.';';
}
if ( $border_color ) {
    $wrap_style .= 'border-color:'. $border_color.';';
}
if ( $border_radius && 'two' == $style ) {
    $wrap_style .= 'border-radius:'. $border_radius.';';
}
if ( $wrap_style ) {
    $wrap_style = ' style="'. $wrap_style .'"';
} ?>

<div class="<?php echo $wrap_classes; ?>"<?php vcex_unique_id( $unique_id ); ?><?php echo $wrap_style; ?>>

    <?php
    // Video
    if ( $video ) : ?>
        <div class="vcex-teaser-media responsive-video-wrap">
            <?php echo wp_oembed_get( $video ); ?>
        </div><!-- .vcex-teaser-media -->
    <?php endif; ?>

    <?php
    // Check for and sanitize URL
    if ( $url && '||' != $url ) :

        // Link attributes
        $url_atts = vc_build_link( $url );
        if ( ! empty( $url_atts['url'] ) ) {
            $url        = isset( $url_atts['url'] ) ? $url_atts['url'] : $url;
            $url_title  = isset( $url_atts['title'] ) ? $url_atts['title'] : $url_title;
            $url_target = isset( $url_atts['target'] ) ? $url_atts['target'] : $url_target;
        }

        // URL title fallback
        $url_title = $url_title ? $url_title : $heading;

        // Link classes
        $url_classes = 'vcex-teaser-link';

        // Target blank
        if ( strpos( $url_target, 'blank' ) ) {
            $url_target = ' target="_blank"';
        }

        // Local scroll
        if ( 'true' == $url_local_scroll ) {
            $url_target = 'local';
        }
        if ( 'local' == $url_target ) {
            $url_classes .= ' local-scroll-link';
        }

        // Link Rel
        if ( 'nofollow' == $url_rel ) {
            $url_rel = 'rel="nofollow"';
        }

        // Sanitize and display URL
        if ( $url = esc_url( $url ) ) { ?>
            <a href="<?php echo $url; ?>" title="<?php echo esc_attr( $url_title ); ?>" class="<?php echo $url_classes; ?>"<?php echo $url_target; ?>>
        <?php } ?>
    <?php endif; ?>

    <?php
    // Image
    if ( $image ) : ?>

        <?php
        // Generate image classes
        $image_classes = array( 'vcex-teaser-media' );
        if ( $img_filter ) {
            $image_classes[] = athen_image_filter_class( $img_filter );
        }
        if ( $img_hover_style ) {
            $image_classes[] = athen_image_hover_classes( $img_hover_style );
        }
        if ( $img_rendering ) {
            $image_classes[] = athen_image_rendering_class( $img_rendering );
        }
        if ( 'stretch' == $img_style ) {
            $image_classes[] = 'stretch-image';
        }
        $image_classes = implode( ' ', $image_classes ); ?>

        <figure class="<?php echo $image_classes; ?>">
            <?php athen_post_thumbnail( array(
                'attachment'    => $image,
                'size'          => 'athen_custom',
                'width'         => $img_width,
                'height'        => $img_height,
            ) ); ?>
        </figure>

    <?php endif; ?>

    <?php
    // Content
    if ( $content || $heading ) :
        // Content area
        $content_style = '';
        if ( $content_margin ) {
            $content_style .= 'margin:'. $content_margin.';';
        }
        if ( $content_padding ) {
            $content_style .= 'padding:'. $content_padding.';';
        }
        if ( $border_radius && ( 'three' == $style || 'four' == $style ) ) {
            $content_style .= 'border-radius:'. $border_radius.';';
        }
        if ( $content_style ) {
            $content_style = ' style="'. $content_style .'"';
        } ?>

        <div class="vcex-teaser-content clr"<?php echo $content_style; ?>>

            <?php
            /// Heading
            if ( $heading ) : ?>
                
                <?php
                // Heading style
                $heading_style = vcex_inline_style( array(
                    'color'             => $heading_color,
                    'font_size'         => $heading_size,
                    'margin'            => $heading_margin,
                    'font_weight'       => $heading_weight,
                    'letter_spacing'    => $heading_letter_spacing,
                    'text_transform'    => $heading_transform,
                ) ); ?>

                <<?php echo $heading_type; ?> class="vcex-teaser-heading"<?php echo $heading_style; ?>>
                    <?php
                    // Display heading
                    echo $heading; ?>
                </<?php echo $heading_type; ?>>

            <?php endif; ?>

            <?php
            // Close URL tag
            if ( $url ) echo '</a>'; ?>

            <?php
            // Content
            if ( $content ) :
                $text_style = vcex_inline_style( array(
                    'font_size'     => $content_font_size,
                    'color'         => $content_color,
                    'font_weight'   => $content_font_weight,
                ) ); ?>
                <div class="vcex-teaser-text clr"<?php echo $text_style; ?>>
                    <?php echo do_shortcode( $content ); ?>
                </div><!-- .vcex-teaser-text -->
            <?php endif; ?>

        </div><!-- .vcex-teaser-content -->

    <?php endif; ?>

</div><!-- .vcex-teaser -->