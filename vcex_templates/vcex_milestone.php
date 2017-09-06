<?php
/**
 * Output for the Milestone Visual Composer module
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
    'speed'                 => '2500',
    'interval'              => '50',
    'animated'              => 'yes',
    'number'                => '',
    'before'                => '',
    'after'                 => '',
    'number_size'           => '',
    'number_weight'         => '',
    'number_color'          => '',
    'number_bottom_margin'  => '',
    'caption'               => '',
    'caption_size'          => '',
    'caption_color'         => '',
    'caption_font'          => '',
    'url'                   => '',
    'url_rel'               => '',
    'url_target'            => '',
    'url_wrap'              => '',
    'css'                   => '',
    'visibility'            => '',
    'css_animation'         => '',
    'hover_animation'       => '',
    'width'                 => '',
    'border_radius'         => '',
), $atts ) );

// Sanitize data
$number     = intval( $number );

// Inline js
vcex_inline_js( 'milestone' );

// Wrapper Classes
$wrap_classes = array( 'vcex-milestone', 'clr' );
if ( 'yes' == $animated ) {
    $wrap_classes[] = 'vcex-animated-milestone';
}
if ( $classes ) {
    $wrap_classes[] = $classes;
}
if ( $visibility ) {
    $wrap_classes[] = $visibility;
}
if ( $css_animation ) {
    $wrap_classes[] = $this->getCSSAnimation( $css_animation );
}
if ( $hover_animation ) {
    $wrap_classes[] = athen_hover_animation_class( $hover_animation );
    vcex_enque_style( 'hover-animations' );
}
$wrap_classes[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css ), 'vcex_milestone', $atts );
$wrap_classes = implode( ' ', $wrap_classes );

// Wrap style
$wrap_style = vcex_inline_style( array(
    'width'         => $width,
    'border_radius' => $border_radius,
) );

// Number Style
$number_style = vcex_inline_style( array(
    'color'         => $number_color,
    'font_size'     => $number_size,
    'margin_bottom' => $number_bottom_margin,
    'font_weight'   => $number_weight
) ); ?>

<?php if ( 'true' == $url_wrap && $url ) : ?>

    <a href="<?php echo esc_url( $url ); ?>" class="<?php echo $wrap_classes; ?>"<?php vcex_unique_id( $unique_id ); ?><?php echo $wrap_style; ?><?php echo vcex_html( 'rel_attr', $url_rel ); ?><?php echo vcex_html( 'target_attr', $url_target ); ?>>

<?php else : ?>

    <div class="<?php echo $wrap_classes; ?>"<?php vcex_unique_id( $unique_id ); ?><?php echo $wrap_style; ?>>

<?php endif; ?>

    <div class="vcex-milestone-number"<?php echo $number_style; ?>>

        <?php if ( ! empty( $number ) ) : ?>

            <?php if ( $before ) : ?><span class="vcex-milestone-before"><?php echo $before; ?><span><?php endif; ?>
            <span class="vcex-milestone-time" data-from="0" data-to="<?php echo intval( $number ); ?>" data-speed="<?php echo intval( $speed ); ?>" data-refresh-interval="<?php echo intval( $interval ); ?>"><?php echo $number; ?></span>
            <?php if ( $after ) : ?><span class="vcex-milestone-after"><?php echo $after; ?><span><?php endif; ?>

        <?php else : ?>

            <?php _e( 'Please enter a number!', 'athen_transl' ); ?>

        <?php endif; ?>

    </div><!-- .vcex-milestone-number -->

    <?php if ( ! empty( $caption ) ) : ?>

        <?php
        // Caption Style
        $caption_style = vcex_inline_style( array(
            'color'         => $caption_color,
            'font_size'     => $caption_size,
            'font_weight'   => $caption_font,
        ) ); ?>
        
        <?php if ( $url && ! $url_wrap ) : ?>

            <a href="<?php echo esc_url( $url ); ?>" class="vcex-milestone-caption"<?php echo vcex_html( 'rel_attr', $url_rel ); ?><?php echo vcex_html( 'target_attr', $url_target ); ?><?php echo $caption_style; ?>>
                <?php echo $caption; ?>
            </a>

        <?php else : ?>

            <div class="vcex-milestone-caption"<?php echo $caption_style; ?>>
                <?php echo $caption; ?>
            </div><!-- .vcex-milestone-caption -->

        <?php endif; ?>
        
    <?php endif; ?>

<?php if ( 'true' == $url_wrap && $url ) : ?>

    </a><!-- .vcex-milestone -->

<?php else : ?>

    </div><!-- .vcex-milestone -->

<?php endif; ?>