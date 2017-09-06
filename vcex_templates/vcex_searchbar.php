<?php
/**
 * Outputs the Searchbar shortcode
 *
 * @package     Total
 * @subpackage  vcex_templates
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       2.1.0
 * @version     2.1.0
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
extract( shortcode_atts( array(
    'unique_id'             => '',
    'classes'               => '',
    'placeholder'           => '',
    'css_animation'         => '',
    'visibility'            => '',
    'css'                   => '',
    'input_color'           => '',
    'input_font_size'       => '',
    'input_text_transform'  => '',
    'input_letter_spacing'  => '',
    'input_font_weight'     => '',
    'button_bg'             => '',
    'button_bg_hover'       => '',
    'button_color'          => '',
    'button_color_hover'    => '',
    'button_font_size'      => '',
    'button_text_transform' => '',
    'button_letter_spacing' => '',
    'button_font_weight'    => '',
    'post_type'             => '',
    'advanced_query'        => '',
    'button_text'           => '',
    'button_width'          => '',
    'input_width'           => '',
),
$atts ) );

// Sanitize
$placeholder = $placeholder ? $placeholder : __( 'Keywords...', 'athen_transl' );
$button_text = $button_text ? $button_text : __( 'Search', 'athen_transl' );

// Wrap Classes
$wrap_classes = array( 'vcex-searchbar', 'clr' );
if ( $classes ) {
    $wrap_classes[] = $this->getExtraClass( $classes );
}
if ( $visibility ) {
    $wrap_classes[] = $visibility;
}
if ( $css_animation ) {
    $wrap_classes[] = $this->getCSSAnimation( $css_animation );
}
$wrap_classes = implode( ' ', $wrap_classes );

// Form classes
$input_classes   = array( 'vcex-searchbar-input' );
$input_classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'vcex_searchbar', $atts );
$input_classes   = implode( ' ', $input_classes );

// Input style
$input_style = vcex_inline_style( array(
    'color'          => $input_color,
    'font_size'      => $input_font_size,
    'text_transform' => $input_text_transform,
    'letter_spacing' => $input_letter_spacing,
    'font_weight'    => $input_font_weight,
) );

// Button style
$button_style = vcex_inline_style( array(
    'width'          => $button_width,
    'background'     => $button_bg,
    'color'          => $button_color,
    'font_size'      => $button_font_size,
    'text_transform' => $button_text_transform,
    'letter_spacing' => $button_letter_spacing,
    'font_weight'    => $button_font_weight,
) );

// Button classes and data
$button_classes = 'vcex-searchbar-button';
$button_data    = '';
if ( $button_bg_hover ) {
    $button_data .= ' data-hover-background="'. $button_bg_hover .'"';
}
if ( $button_color_hover ) {
    $button_data .= ' data-hover-color="'. $button_color_hover .'"';
}
if ( $button_bg_hover || $button_color_hover ) {
    $button_classes .= ' wpex-data-hover';
    vcex_inline_js( 'data_hover' );
} ?>

<div class="<?php echo $wrap_classes; ?>">

    <form role="search" method="get" class="vcex-searchbar-form" action="<?php echo esc_url( home_url( '/' ) ); ?>"<?php echo $input_style; ?>>

        <input type="search" class="<?php echo $input_classes; ?>" name="s" placeholder="<?php echo $placeholder; ?>"<?php echo vcex_inline_style( array( 'width' => $input_width ) ); ?> />

        <?php if ( $post_type && ! $advanced_query ) { ?>
            <input type="hidden" name="post_type" value="portfolio">
        <?php } ?>
        
        <?php if ( $advanced_query ) {

            // Sanitize
            $advanced_query = trim( $advanced_query );
            $advanced_query = html_entity_decode( $advanced_query );

            // Convert to array
            $advanced_query = parse_str( $advanced_query, $advanced_query_array );

            // If array is valid loop through params
            if ( $advanced_query_array ) { ?>

                <?php foreach( $advanced_query_array as $key => $val ) : ?>

                   <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $val; ?>">

                <?php endforeach; ?>

            <?php } ?>

        <?php } ?>

        <button type="submit" class="<?php echo $button_classes; ?>"<?php echo $button_data;?><?php echo $button_style ?>>
            <?php echo $button_text; ?>
        </button>

    </form><!-- .searchform -->

</div><!-- .vcex-searchbar-wrap -->