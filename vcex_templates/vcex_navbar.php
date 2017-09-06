<?php
/**
 * Output for the bullets Visual Composer module
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
    'hover_animation'   => '',
    'align'             => '',
    'classes'           => '',
    'menu'              => '',
    'style'             => 'buttons',
    'button_color'      => '',
    'target'            => '',
    'css_animation'     => '',
    'visibility'        => '',
    'css'               => '',
    'hover_bg'          => '',
    'link_color'        => '',
    'hover_color'       => '',
    'border_radius'     => '',
),
$atts ) );

// Sanitize
$style = $style ? $style : 'buttons';

// Get current post ID
$post_id = get_the_ID();

// Hover animation
if ( $hover_animation ) {
    $hover_animation = athen_hover_animation_class( $hover_animation );
    vcex_enque_style( 'hover-animations' );
}

// CSS class
if ( $css ) {
    $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css ), 'vcex_navbar', $atts );
} else {
    $css_class = '';
}

// Link Data
$link_hover_class = $link_data = '';
if ( $hover_bg ) {
    $link_data .= ' data-hover-background="'. $hover_bg .'"';
}
if ( $hover_color ) {
    $link_data .= ' data-hover-color="'. $hover_color .'"';
}
if ( $link_data ) {
    $link_hover_class = 'wpex-data-hover';
}

// Border radius
if ( $border_radius ) {
    $border_radius = vcex_get_border_radius_class( $border_radius );
} 

// Classes
$wrap_classes = array( 'vcex-navbar', 'clr' );
if ( $classes ) {
    $wrap_classes[] = $this->getExtraClass( $classes );
}
if ( $link_color ) {
    $wrap_classes[] = 'color-'. $link_color;
}
if ( $visibility ) {
    $wrap_classes[] = $visibility;
}
if ( $align ) {
    $wrap_classes[] = 'align-'. $align;
}
if ( $css_animation ) {
    $wrap_classes[] = $this->getCSSAnimation( $css_animation );
}
if ( $style ) {
    $wrap_classes[] = ' style-'. $style;
}
$wrap_classes = implode( ' ', $wrap_classes ); ?>

<nav class="<?php echo $wrap_classes; ?>"<?php vcex_unique_id( $unique_id ); ?>>
    <div class="vcex-navbar-inner clr">
        <?php
        // Get menu object
        $menu = wp_get_nav_menu_object( $menu );

        // If menu isn't empty display items
        if ( ! empty( $menu ) ) :

            // Load inline js
            vcex_inline_js( array( 'data_hover' ) );

            // Get menu items
            $menu_items = wp_get_nav_menu_items( $menu->term_id );

            // Inline styles
            $reset_border = ( $hover_bg || $hover_color ) ? 'inherit' : '';
            $active_style = vcex_inline_style( array(
                'background'   => $hover_bg,
                'color'        => $hover_color,
                'border_color' => $reset_border,
            ) );

            // Loop through menu items
            foreach ( $menu_items as $menu_item ) :

                // Link Classes
                $link_classes = array( 'vcex-navbar-link' );
                if ( $css_class ) {
                    $link_classes[] = $css_class;
                }
                if ( $hover_animation ) {
                    $link_classes[] = $hover_animation;
                }
                if ( $hover_bg ) {
                    $link_classes[] = 'has-bg-hover';
                }
                if ( $border_radius ) {
                    $link_classes[] = $border_radius;
                }
                if ( $link_hover_class ) {
                    $link_classes[] = $link_hover_class;
                }
                if ( $menu_item->object_id == $post_id ) {
                    $link_classes[] = 'active';
                }
                if ( $menu_item->classes ) {
                    $link_classes = array_merge( $link_classes, $menu_item->classes );
                }
                $link_classes = implode( ' ', $link_classes ); ?>

                <a href="<?php echo esc_url( $menu_item->url ); ?>" title="<?php echo esc_attr( $menu_item->attr_title ); ?>" class="<?php echo $link_classes; ?>"<?php echo vcex_html( 'target_attr', $menu_item->target ); ?><?php echo $link_data; ?><?php if ( $menu_item->object_id == $post_id ) echo $active_style; ?>>
                    <?php echo $menu_item->title; ?>
                </a>

            <?php endforeach; ?>

        <?php endif; ?>
    </div><!-- .vcex-navbar-inner -->
</nav><!-- .vcex-navbar -->