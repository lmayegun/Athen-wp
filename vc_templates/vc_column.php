<?php
// Display error for those using an outdated Visual Composer plugin
if ( ! function_exists( 'wpb_translateColumnWidthToSpan' )
	|| ! function_exists( 'vc_column_offset_class_merge' ) ) {
    echo '<p>'. __( 'The Visual Composer plugin must be updated for this module to work correctly.', 'athen_transl' ) .'</p>';
    return;
}
$output = $el_class = $width = '';
extract( shortcode_atts( array(
    'el_class'          => '',
    'visibility'        => '',
    'width'             => '1/1',
    'css_animation'     => '',
    'typo_style'        => '',
    'style'             => '',
    'drop_shadow'       => '',
    'bg_color'          => '',
    'bg_image'          => '',
    'bg_style'          => '',
    'border_color'      => '',
    'border_style'      => '',
    'border_width'      => '',
    'margin_top'        => '',
    'margin_bottom'     => '',
    'padding_top'       => '',
    'min_height'        => '',
    'padding_bottom'    => '',
    'padding_left'      => '',
    'padding_right'     => '',
    'border'            => '',
    'css'               => '',
    'offset'            => '',
), $atts ) );

// Add extra classes
$el_class = $this->getExtraClass( $el_class );

// Core: width
$width = wpb_translateColumnWidthToSpan( $width );
if ( function_exists( 'vc_column_offset_class_merge' ) ) {
    $width = vc_column_offset_class_merge( $offset, $width );
}

// Animation class
if ( $css_animation ) {
    $css_animation = $this->getCSSAnimation( $css_animation );
}

$el_class .= ' wpb_column clr column_container'. $css_animation;

// Parent Classes
$parent_classes = '';
if ( '' != $style && 'no-spacing' == $style ) {
    $parent_classes .= ' '. $style .'-column';
}

// Inner Classes
$col_inner_classes = '';
if ( $bg_image ) {
    if ( $bg_style ) {
        $bg_style = $bg_style;
    } else {
        $bg_style = 'stretch';
    }
    $col_inner_classes .= ' vcex-background-'. $bg_style;
}
if ( $typo_style ) {
    $col_inner_classes .= athen_typography_style_class( $typo_style );
}
if ( '' != $style && 'default' != $style && 'no-spacing' != $style ) {
    $col_inner_classes .= ' '. $style .'-column';
}

if ( $drop_shadow == 'yes' ) {
    $col_inner_classes .= ' column-dropshadow';
}

// Outter Style
$outter_style = vcex_inline_style( array(
    'margin_top'    => $margin_top,
    'margin_bottom' => $margin_bottom,
) );


// Inner Style
$inner_style = vcex_inline_style( array(
    'background_image'  => wp_get_attachment_url( $bg_image ),
    'background_color'  => $bg_color,
    'border_color'      => $border_color,
    'border_style'      => $border_style,
    'border_width'      => $border_width,
    'padding_top'       => $padding_top,
    'padding_bottom'    => $padding_bottom,
    'padding_left'      => $padding_left,
    'padding_right'     => $padding_right,
    'min_height'        => $min_height,
) );

// Output
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$output .= "\n\t".'<div class="'. $css_class .' '. $parent_classes .' '. $visibility .'"'. $outter_style .'>';
    if ( $col_inner_classes || $inner_style ) {
        $output .= '<div class="clr '. $col_inner_classes .'"'. $inner_style .'>';
    }
        $output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
    if ( $col_inner_classes || $inner_style ) {
        $output .= '</div>';
    }
$output .= "\n\t".'</div> '.$this->endBlockComment( $el_class ) . "\n";
echo $output;