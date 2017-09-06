<?php
/**
 * Output for the Spacing Visual Composer module
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

// Get array of social links to loop through
$social_links = vcex_social_links_profiles();

// Return if $sociail_links is empty
if ( empty ( $social_links ) ) {
    return;
}

// Extract shortcode attributes
extract( shortcode_atts( array(
    'unique_id'         => '',
    'classes'           => '',
    'visibility'        => '',
    'css_animation'     => '',
    'align'             => '',
    'hover_animation'   => '',
    'hover_bg'          => '',
    'hover_color'       => '',
    'size'              => '',
    'color'             => '',
    'border_radius'     => '',
    'css'               => '',
), $atts ) );

// Wrap classes
$wrap_classes = array( 'vcex-social-links' );
if ( $align ) {
    $wrap_classes[] = 'text'. $align;
}
if ( $css_animation ) {
    $wrap_classes[] = $this->getCSSAnimation( $css_animation );
}
if ( $classes ) {
    $wrap_classes[] = $this->getExtraClass( $classes );
}
if ( $visibility ) {
    $wrap_classes[] = $visibility;
}
$wrap_classes = implode( ' ', $wrap_classes );

// Wrap style
$wrap_style = vcex_inline_style( array(
    'color'         => $color,
    'font_size'     => $size,
    'border_radius' => $border_radius,
) );

// Data Attributes
$a_data = array();
if ( $hover_bg ) {
    $a_data[] = 'data-hover-background="'. $hover_bg .'"';
}
if ( $hover_color ) {
    $a_data[] = 'data-hover-color="'. $hover_color .'"';
}
$a_data = implode( ' ', $a_data );

// Link Classes
$a_classes = array( 'vcex-social-link' );
if ( $hover_bg || $hover_color ) {
   $a_classes[] = 'wpex-data-hover';
   vcex_inline_js( array( 'data_hover' ) );
}
if ( $hover_animation ) {
    $a_classes[] = athen_hover_animation_class( $hover_animation );
    vcex_enque_style( 'hover-animations' );
}
if ( $css ) {
    $a_classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css ), 'vcex_social_links', $atts );   
}
$a_classes = implode( ' ', $a_classes ); ?>

<div class="<?php echo $wrap_classes; ?>"<?php echo $wrap_style; ?><?php vcex_unique_id( $unique_id ); ?>>

    <?php
    // Loop through social options and display if set
    foreach ( $social_links as $key => $val ) : ?>

        <?php
        // If url field is empty check next profile
        if ( empty( $atts[$key] ) ) continue; ?>

        <a href="<?php echo esc_url( $atts[$key] ); ?>" class="<?php echo $a_classes; ?>"<?php echo $a_data; ?>><span class="<?php echo $val['icon_class']; ?>"></span></a>

    <?php endforeach; ?>

</div><!-- .<?php echo $wrap_classes; ?> -->