<?php
/**
 * Output for the Image Swap Visual Composer module
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
    'unique_id'         => '',
    'classes'           => '',
    'css_animation'     => '',
    'primary_image'     => '',
    'container_width'   => '',
    'secondary_image'   => '',
    'border_radius'     => '',
    'link'              => '',
    'link_title'        => '',
    'link_target'       => '',
    'link_tooltip'      => '',
    'img_width'         => '',
    'img_height'        => '',
    'css'               => '',
), $atts ) );

if ( ! $primary_image || ! $secondary_image ) {
    echo '<div>'. __( 'You must select a primary and secondary image', 'athen_transl' ) .'</div>';
}

// Add styles
$wrapper_inline_style = vcex_inline_style( array(
    'width' => $container_width,
) );
$image_style = vcex_inline_style( array(
    'border_radius' => $border_radius,
), false );

// Add classes
$wrapper_classes = array( 'vcex-image-swap', 'clr' );
if ( $classes ) {
    $wrapper_classes[] = $this->getExtraClass( $classes );
}
if ( $css_animation ) {
    $wrapper_classes[] = $this->getCSSAnimation( $css_animation );
}
$wrapper_classes = implode( ' ', $wrapper_classes ); ?>

<?php if ( $primary_image && $secondary_image ) : ?>

    <?php if ( $css ) : ?>
        <div class="<?php echo apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'vcex_image_swap', $atts ); ?>">
    <?php endif; ?>

    <div class="<?php echo $wrapper_classes; ?>"<?php echo $wrapper_inline_style; ?><?php vcex_unique_id( $unique_id ); ?>>

        <?php if ( $link ) {
            // Sanitize link vars
            $link_classes = 'vcex-image-swap-link';
            if ( in_array( $link_tooltip, array( 'yes', 'true' ) ) ) {
                $link_classes .= ' tooltip-up';
            } ?>
            <a href="<?php echo esc_url( $link ); ?>" class="<?php echo $link_classes; ?>"<?php echo vcex_html( 'title_attr', $link_title ); ?><?php echo vcex_html( 'target_attr', $link_target ); ?>>
        <?php } ?>

            <?php
            // Primary image
            athen_post_thumbnail( array(
                'attachment'    => $primary_image,
                'size'          => 'athen_custom',
                'width'         => $img_width,
                'height'        => $img_height,
                'class'         => 'vcex-image-swap-primary',
                'style'         => $image_style,
            ) ); ?>

            <?php
            // Secondary image
            athen_post_thumbnail( array(
                'attachment'    => $secondary_image,
                'size'          => 'athen_custom',
                'width'         => $img_width,
                'height'        => $img_height,
                'class'         => 'vcex-image-swap-secondary',
                'style'         => $image_style,
            ) ); ?>

        <?php if ( $link ) echo '</a>'; ?>

    </div><!-- .vcex-image-swap -->

    <?php if ( $css ) echo '</div><!-- .css-wrapper -->'; ?>

<?php endif; ?>