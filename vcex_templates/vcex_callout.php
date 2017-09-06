<?php
/**
 * Output for the callout Visual Composer module
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
    'unique_id'             => '',
    'classes'               => '',
    'visibility'            => '',
    'caption'               => '',
    'button_text'           => '',
    'button_style'          => '',
    'button_color'          => '',
    'button_url'            => '',
    'button_rel'            => '',
    'button_target'         => '',
    'button_border_radius'  => '',
    'button_title'          => '',
    'button_icon_left'      => '',
    'button_icon_right'     => '',
    'css_animation'         => '',
    'css'                   => '',
), $atts ) );

// Sanitize variables
$button_target  = vcex_html( 'target_attr', $button_target );
$button_rel     = vcex_html( 'rel_attr', $button_rel );

// Add Classes
$wrap_classes = array( 'vcex-callout', 'clr' );
if ( $button_url ) {
    $wrap_classes[] = 'with-button';
}
if ( $visibility ) {
    $wrap_classes[] = $visibility;
}
if ( $css_animation ) {
    $wrap_classes[] = $this->getCSSAnimation( $css_animation );
}
if ( $classes ) {
    $wrap_classes[] = $this->getExtraClass( $classes );
}
$wrap_classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'vcex_callout', $atts );
$wrap_classes = implode( ' ', $wrap_classes );

// Button style
if ( $button_url && $button_text ) {
    $button_inline_style = vcex_inline_style( array(
        'border_radius' => $button_border_radius,
    ) );
} ?>

<div class="<?php echo esc_attr( $wrap_classes ); ?>"<?php vcex_unique_id( $unique_id ); ?>>

    <?php
    // Display content
    if ( $content ) : ?>
        <div class="vcex-callout-caption clr">
            <?php echo apply_filters ( 'the_content', $content ); ?>
        </div><!-- .vcex-callout-caption -->
    <?php endif; ?>

    <?php
    // Display button
    if ( $button_url && $button_text ) : ?>

        <div class="vcex-callout-button">
            <a href="<?php echo $button_url; ?>" class="vcex-button <?php echo $button_style; ?> <?php echo $button_color; ?> animate-on-hover" title="<?php echo $button_text; ?>"<?php echo $button_target; ?><?php echo $button_rel; ?><?php echo $button_inline_style; ?>>
                <span class="vcex-button-inner" <?php echo $button_border_radius; ?>>
                    <?php
                    // Display left button icon
                    if ( $button_icon_left && 'none' != $button_icon_left ) : ?>
                        <span class="vcex-button-icon-left fa fa-<?php echo $button_icon_left; ?>"></span>
                    <?php endif; ?>
                    <?php
                    // Button Text
                    echo $button_text; ; ?>
                    <?php
                    // Display right button icon
                    if ( $button_icon_right && 'none' != $button_icon_right ) : ?>
                        <span class="vcex-button-icon-right fa fa-<?php echo $button_icon_right; ?>"></span>
                    <?php endif; ?>
                </span>
            </a>
        </div><!-- .vcex-callout-button -->

    <?php endif; ?>

</div><!-- .vcex-callout -->