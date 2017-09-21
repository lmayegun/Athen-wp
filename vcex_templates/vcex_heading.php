<?php
/**
 * Output for the bullets Visual Composer module
 *
 * @package     Total
 * @subpackage  vcex_templates
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       2.1.0
 * @version     1.0.0
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
$atts = shortcode_atts( array(
	'text'              => __( 'Heading', 'athen_transl' ),
	'font_family'       => '',
	'tag'               => 'div',
	'font_size'         => '',
	'font_weight'       => '',
	'letter_spacing'    => '',
	'color'             => '',
	'color_hover'       => '',
	'css'               => '',
	'text_align'        => '',
	'link'              => '',
	'link_local_scroll' => '',
	'background_hover'  => '',
	'css_animation' 	=> '',
), $atts );

// Extract attributes
extract( $atts );

// Sanitize data
$tag = $tag ? $tag : 'div';

// Define vars
$wrap_classes = array( 'vcex-heading', 'reset-styles' );
$link_html    = array();
$wrap_data    = array();


// Css Animation Appear
if ( $css_animation ){
	$wrap_classes[] = $this->getCSSAnimation( $css_animation );
}

// Load custom font
if ( $font_family ) {
	athen_enqueue_google_font( $font_family );
}

// Add inline style
$style = vcex_inline_style( array(
	'color'          => $color,
	'font_family'    => $font_family,
	'font_size'      => $font_size,
	'letter_spacing' => $letter_spacing,
	'font_weight'    => $font_weight,
	'text_align'     => $text_align,
) );

// Add CSS class
if ( $css ) {
	$wrap_classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'vcex_heading', $atts );
}

// Get link data
$link = vcex_build_link( $link );
if ( $link ) {
	$link_html[] = 'href="'. $link['url'] .'"';
	$link_html[] = 'title="'. $link['title'] .'"';
	$link_html[] = 'target="'. $link['target'] .'"';
	$tag = 'a';
	if ( $link_local_scroll ) {
		$wrap_classes[] = 'local-scroll-link';
	}
}

// Color hover
if ( $color_hover ) {
	$wrap_classes['wpex-data-hover'] = 'wpex-data-hover';
	$wrap_data[]    = 'data-hover-color="'. $color_hover .'"';
}
if ( $background_hover ) {
	if ( ! isset( $wrap_classes['wpex-data-hover'] ) ) {
		$wrap_classes['wpex-data-hover'] = 'wpex-data-hover';
	}
	$wrap_classes[] = 'transition-all';
	$wrap_data[] = 'data-hover-background="'. $background_hover .'"';
}

// Impode dat
$wrap_classes = implode( ' ', $wrap_classes );
$link_html    = implode( ' ', $link_html );
$wrap_data    = implode( ' ', $wrap_data ); ?>


<<?php echo $tag; ?> class="<?php echo $wrap_classes; ?>"<?php echo $link_html; ?><?php echo $style; ?><?php echo $wrap_data; ?>>
	<?php echo do_shortcode( $text ); ?>
</<?php echo $tag; ?>><!-- .vcex-bullets -->