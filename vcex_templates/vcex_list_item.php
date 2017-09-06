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
    'style'                 => '',
    'unique_id'             => '',
    'classes'               => '',
    'visibility'            => '',
    'icon_type'             => 'fontawesome',
    'icon'                  => '',
    'icon_fontawesome'      => '',
    'icon_openiconic'       => '',
    'icon_typicons'         => '',
    'icon_entypo'           => '',
    'icon_linecons'         => '',
    'icon_pixelicons'       => '',
    'color'                 => '',
    'font_color'            => '',
    'font_size'             => '',
    'icon_size'             => '',
    'text_align'            => '',
    'margin_right'          => '',
    'css_animation'         => '',
    'font_size'             => '',
    'url'                   => '',
    'link'                  => '',
    'link_title'            => '',
    'url_target'            => '',
    'icon_background'       => '',
    'icon_border_radius'    => '',
    'icon_width'            => '',
    'icon_height'           => '',
    'css'                   => '',
),
$atts ) );

// Get icon classes
$icon = vcex_get_icon_class( $atts, 'icon' );

// Enqueue needed icon font
if ( $icon && 'fontawesome' != $icon_type ) {
    vcex_enqueue_icon_font( $icon_type );
}

// Get link
if ( $link ) {

    $link_url_temp  = $link;
    $link_url       = vcex_get_link_data( 'url', $link_url_temp );

    if ( $link_url ) {

        // Link attributes
        $url        = $link_url;
        $url_title  = vcex_get_link_data( 'title', $link_url_temp, $link_title );
        $url_target = vcex_get_link_data( 'target', $link_url_temp, $url_target );
    }
}

// Link target
$url_target = vcex_html( 'link_attr', $url_target );

// Classes
$wrap_classes = array( 'vcex-list_item' );
if ( $classes ) {
    $wrap_classes[] = $this->getExtraClass( $classes );
}
if ( $css_animation ) {
    $wrap_classes[] = $this->getCSSAnimation( $css_animation );
}
if ( $visibility ) {
    $wrap_classes[] = $visibility;
}
if ( $css ) {
    $wrap_classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css ), 'vcex_list_item', $atts );
}
$wrap_classes = implode( ' ', $wrap_classes );

// Main Styles
$wrap_style = vcex_inline_style( array(
    'font_size'     => $font_size,
    'color'         => $font_color,
    'text_align'    => $text_align
) ); ?>

<div class="<?php echo $wrap_classes; ?>"<?php echo $wrap_style; ?><?php vcex_unique_id( $unique_id ); ?>>

    <?php
    // Open link tag
    if ( $url ) : ?>

        <?php
        // Inline sytle for the link
        $link_style = vcex_inline_style( array(
            'color' => $font_color,
        ) ); ?>

        <a href="<?php echo $url; ?>"<?php echo vcex_html( 'title_attr', $url_title ); ?><?php echo $url_target; ?><?php echo $link_style; ?>>

    <?php endif; ?>

    <?php
    // Icon classes
    $icon_wrap_classes = 'vcex-icon-wrap';

    // Icon inline style
    $icon_style = vcex_inline_style( array(
        'background'    => $icon_background,
        'width'         => $icon_width,
        'border_radius' => $icon_border_radius,
        'height'        => $icon_height,
        'line_height'   => vcex_sanitize_data( $icon_height, 'px' ),
        'margin_right'  => $margin_right,
        'font_size'     => $icon_size,
        'color'         => $color,
    ) ); ?>
    
    <div class="<?php echo $icon_wrap_classes; ?>"<?php echo $icon_style; ?>><span class="<?php echo $icon; ?>"></span></div><?php echo do_shortcode( $content ); ?>
    
    <?php
    // Close link tag
    if ( $url ) echo '</a>'; ?>

</div><!-- .vcex-list_item -->