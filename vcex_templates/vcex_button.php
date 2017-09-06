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
extract( shortcode_atts( array(
    'unique_id'                 => '',
    'button_text'               => '',
    'classes'                   => '',
    'visibility'                => '',
    'layout'                    => '',
    'style'                     => '',
    'color'                     => '',
    'custom_color'              => '',
    'custom_background'         => '',
    'custom_hover_background'   => '',
    'custom_hover_color'        => '',
    'url'                       => 'http://www.google.com/',
    'title'                     => __( 'Visit Site', 'athen_transl' ),
    'target'                    => '',
    'size'                      => '',
    'font_family'               => '',
    'font_weight'               => '',
    'text_transform'            => '',
    'font_size'                 => '',
    'letter_spacing'            => '',
    'width'                     => '',
    'margin'                    => '',
    'font_padding'              => '',
    'align'                     => 'alignleft',
    'rel'                       => '',
    'border_radius'             => '',
    'class'                     => '',
    'icon_left'                 => '',
    'icon_left_openiconic'      => '',
    'icon_left_typicons'        => '',
    'icon_left_entypo'          => '',
    'icon_left_linecons'        => '',
    'icon_left_pixelicons'      => '',
    'icon_right'                => '',
    'icon_right_openiconic'     => '',
    'icon_right_typicons'       => '',
    'icon_right_entypo'         => '',
    'icon_right_linecons'       => '',
    'icon_right_pixelicons'     => '',
    'icon_type'                 => 'fontawesome',
    'css_animation'             => '',
    'hover_animation'           => '',
    'icon_left_padding'         => '',
    'icon_right_padding'        => '',
    'lightbox'                  => '',
    'lightbox_image'            => '',
    'lightbox_type'             => '',
    'lightbox_poster_image'     => '',
    'lightbox_dimensions'       => '',
    'lightbox_video_html5_webm' => '',
), $atts ) );

// Sanitize & declare vars
$content     = ! empty( $content ) ? $content : __( 'Button Text', 'athen_transl' );
$inline_js   = array();
$data_attr   = array();
$url         = esc_url( $url );
$target_html = vcex_html( 'target_attr', $target );
$rel         = vcex_html( 'rel_attr', $rel );

// Load custom font
if ( $font_family ) {
    athen_enqueue_google_font( $font_family );
}

// Button Classes
$button_classes = array( 'vcex-button' );
if ( $layout ) {
    $button_classes[] = $layout;
}
if ( $style ) {
    $button_classes[] = $style;
}
if ( $align ) {
    $button_classes[] = 'align-'. $align;
}
if ( $size ) {
    $button_classes[] = $size;
}
if ( $color ) {
    $button_classes[] = $color;
}
if ( $class ) {
    $button_classes[] = $class;
}
if ( $hover_animation ) {
    $button_classes[] = athen_hover_animation_class( $hover_animation );
    vcex_enque_style( 'hover-animations' );
} else {
    $button_classes[] = 'animate-on-hover';
}
if ( 'local' == $target ) {
    $button_classes[] = 'local-scroll-link';
}
if ( $css_animation ) {
    $button_classes[] = $this->getCSSAnimation( $css_animation );
}
if ( $classes ) {
    $button_classes[] = $this->getExtraClass( $classes );
}
if ( $visibility ) {
    $button_classes[] = $visibility;
}

// Lightbox classes, image and data attributes
if ( 'true' == $lightbox ) {

    // Enqueue lightbox style
    vcex_enque_style( 'ilightbox' );

    // Parse lightbox dimensions
    $lightbox_dimensions = vcex_parse_lightbox_dims( $lightbox_dimensions );

    // Set data attributes based on lightbox type
    if ( 'iframe' == $lightbox_type ) {
        
        $button_classes[] = 'wpex-lightbox';
        $data_attr[]      = 'data-type="iframe"';
        $data_attr[]      = 'data-options="'. $lightbox_dimensions .'"';

    } elseif ( 'image' == $lightbox_type ) {

        $button_classes[] = 'wpex-lightbox';
        $data_attr[]      = 'data-type="image"';
        if ( $lightbox_image ) {
            $url = wp_get_attachment_url( $lightbox_image );
        }
        $inline_js[] = 'ilightbox';

    } elseif ( 'video_embed' == $lightbox_type ) {

        $url = athen_sanitize_data( $url, 'embed_url' );
        $button_classes[] = 'wpex-lightbox';
        $data_attr[]      = 'data-type="iframe"';
        $data_attr[]      = 'data-options="'. $lightbox_dimensions .'"';

    } elseif ( 'html5' == $lightbox_type ) {

        $lightbox_video_html5_webm = $lightbox_video_html5_webm ? $lightbox_video_html5_webm : $url;
        $poster = wp_get_attachment_url( $lightbox_poster_image );
        $button_classes[] = 'wpex-lightbox';
        $data_attr[]      = 'data-type="video"';
        $data_attr[]      = 'data-options="'. $lightbox_dimensions .', html5video: { webm: \''. $lightbox_video_html5_webm .'\', poster: \''. $poster .'\' }"';

    } elseif ( 'quicktime' == $lightbox_type ) {

        $button_classes[] = 'wpex-lightbox';
        $data_attr[]      = 'data-type="video"';
        $data_attr[]      = 'data-options="'. $lightbox_dimensions .'"';

    } else {

        $button_classes[] = 'wpex-lightbox-autodetect';

    }

}

// Wrap classes
$wrap_classes = array();
if ( 'center' == $align ) {
    $wrap_classes[] = 'textcenter';
}
if ( 'block' == $layout ){
    $wrap_classes[] = 'vcex-button-block-wrap';
}
if ( 'expanded' == $layout ){
    $wrap_classes[]     = 'vcex-button-expanded-wrap';
    $button_classes[]   = 'expanded';
}
if ( $wrap_classes ) {
    $wrap_classes[] = 'vcex-button-wrap';
    $wrap_classes[] = 'clr';
    $wrap_classes   = implode( ' ', $wrap_classes );
}

// Custom Style
$inline_style = vcex_inline_style( array(
    'background'        => $custom_background,
    'padding'           => $font_padding,
    'color'             => $custom_color,
    'font_size'         => $font_size,
    'font_weight'       => $font_weight,
    'letter_spacing'    => $letter_spacing,
    'border_radius'     => $border_radius,
    'margin'            => $margin,
    'width'             => $width,
    'text_transform'    => $text_transform,
    'font_family'       => $font_family,
), false );
if ( $custom_color && 'outline' == $style ) {
    $inline_style .= 'border-color:'. $custom_color .';';
}
if ( $inline_style ) {
    $inline_style = ' style="'. esc_attr( $inline_style ) .'"';
}

// Custom hovers
if ( $custom_hover_background || $custom_hover_color ) {
    if ( $custom_hover_background ) {
        $data_attr[] = 'data-hover-background="'. $custom_hover_background .'"';
    }
    if ( $custom_hover_color ) {
        $data_attr[] = 'data-hover-color="'. $custom_hover_color .'"';
    }
    if ( $data_attr ) {
        $button_classes[] = 'wpex-data-hover';
    }
    $inline_js[] = 'data_hover';
}

// Define button icon_classes
$icon_left  = vcex_get_icon_class( $atts, 'icon_left' );
$icon_right = vcex_get_icon_class( $atts, 'icon_right' );

// Icon left style
if ( $icon_left ) {
    $icon_left_style = vcex_inline_style ( array(
        'padding_right'  => $icon_left_padding,
    ) );
}

// Icon right style
if ( $icon_right ) {
    $icon_right_style = vcex_inline_style ( array(
        'padding_left' => $icon_right_padding,
    ) );
}

// Load icon fonts if needed
if ( $icon_left || $icon_right ) {
    vcex_enqueue_icon_font( $icon_type );
}

// Load inline js
vcex_inline_js( $inline_js );

// Turn arrays into strings
$button_classes     = implode( ' ', $button_classes );
$data_attr    = implode( ' ', $data_attr );

// Open wrapper for specific button styles
if ( $wrap_classes ) echo '<div class="'. esc_attr( $wrap_classes ) .'">'; ?>

    <a href="<?php echo $url; ?>" class="<?php echo esc_attr( $button_classes ); ?>" title="<?php echo esc_attr( $title ); ?>"<?php echo $inline_style; ?><?php echo $target_html; ?><?php echo $rel; ?> <?php echo $data_attr; ?><?php echo vcex_unique_id( $unique_id ); ?>>

        <span class="vcex-button-inner">

            <?php
            // Display left Icon
            if ( $icon_left ) : ?>

                <span class="vcex-icon-wrap vcex-button-icon-left">
                    <span class="<?php echo $icon_left; ?>"<?php echo $icon_left_style; ?>></span>
                </span>

            <?php endif; ?>

            <?php
            // Button Text
            echo $content; ?>

            <?php
            // Display Right Icon
            if ( $icon_right ) : ?>

                <span class="vcex-icon-wrap vcex-button-icon-right">
                    <span class="<?php echo $icon_right; ?>"<?php echo $icon_right_style; ?>></span>
                </span>

            <?php endif; ?>

        </span><!-- .vcex-button-inner -->

    </a><!-- <?php echo esc_attr( $button_classes ); ?> -->

<?php
// Close wrapper for specific button styles
if ( $wrap_classes ) echo '</div><!-- '. esc_attr( $wrap_classes ) .' -->'; ?>