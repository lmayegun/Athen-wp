<?php
/**
 * Output for the Icon Box Visual Composer module
 *
 *
 * @package     Total
 * @subpackage  vcex_templates
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
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

// Get shortcode attributes
$atts = shortcode_atts( array(
    'unique_id'                 => '',
    'visibility'                => '',
    'classes'                   => '',
    'font_size'                 => '',
    'background'                => '',
    'font_color'                => '',
    'border_radius'             => '',
    'style'                     => 'one',
    'image'                     => '',
    'image_width'               => '',
    'icon_type'                 => 'fontawesome',
    'icon'                      => '',
    'icon_fontawesome'          => '',
    'icon_openiconic'           => '',
    'icon_typicons'             => '',
    'icon_entypo'               => '',
    'icon_linecons'             => '',
    'icon_pixelicons'           => '',
    'icon_color'                => '',
    'icon_width'                => '',
    'icon_height'               => '',
    'icon_alternative_classes'  => '',
    'icon_size'                 => '',
    'icon_background'           => '',
    'icon_border_radius'        => '',
    'icon_bottom_margin'        => '',
    'heading'                   => '',
    'heading_type'              => 'h2',
    'heading_color'             => '',
    'heading_size'              => '',
    'heading_weight'            => '',
    'heading_letter_spacing'    => '',
    'heading_transform'         => '',
    'heading_bottom_margin'     => '',
    'container_left_padding'    => '',
    'container_right_padding'   => '',
    'url'                       => '',
    'url_target'                => '',
    'url_rel'                   => '',
    'url_wrap'                  => '',
    'css_animation'             => '',
    'padding'                   => '',
    'margin_bottom'             => '',
    'el_class'                  => '',
    'alignment'                 => '',
    'background'                => '',
    'background_image'          => '',
    'background_image_style'    => 'strech',
    'border_color'              => '',
    'hover_background'          => '',
    'hover_white_text'          => '',
    'hover_animation'           => '',
    'css'                       => '',
), $atts );

// Extract shortcode atts
extract( $atts );

// Sanitize data & declare main vars
$url                = esc_url( $url );
$inline_js          = array();
$css_wrap_classes   = array();
$clickable_boxes    = array( 'four', 'five', 'six' );
$url_wrap           = ( in_array( $style, $clickable_boxes ) & 'false' != $url_wrap ) ? 'true' : $url_wrap;
$url_wrap           = ( 'true' == $url_wrap ) ? true : false;
$image              = $image ? wp_get_attachment_url( $image ) : '';
$icon               = $image ? '' : vcex_get_icon_class( $atts, 'icon' );
$hover_white_text   = ( 'true' == $hover_white_text ) ? true : false;
$heading_type       = $heading_type ? $heading_type : 'h2';

// Icon functions
if ( $icon ) {

    // Load icon family CSS
    vcex_enqueue_icon_font( $icon_type );

    // Icon Style
    $icon_style = vcex_inline_style( array(
        'color'         => $icon_color,
        'width'         => $icon_width,
        'font_size'     => $icon_size,
        'border_radius' => $icon_border_radius,
        'background'    => $icon_background,
    ), false );
    if ( $icon_bottom_margin && in_array( $style, array( 'two', 'three', 'four', 'five', 'six' ) ) ) {
        $icon_style .= 'margin-bottom:' . intval( $icon_bottom_margin ) .'px;';
    }
    if ( $icon_height ) {
        $icon_style .= 'height:'.  intval( $icon_height ) .'px;line-height:'.  intval( $icon_height ) .'px;';
    }
    if ( $icon_style ) {
        $icon_style = ' style="' . $icon_style . '"';
    }

    // Icon Classes
    $icon_classes = array( 'vcex-icon-box-icon' );
    if ( $icon_background ) {
        $icon_classes[] = 'with-background';
    }
    if ( $icon_width || $icon_height ) {
        $icon_classes[] = 'no-padding';
    }

}

// Main Classes
$wrapper_classes = array( 'vcex-icon-box', 'clr' );
if ( $style ) {
    //$wrapper_classes[] = 'style-'. $style;
}
if ( empty( $icon ) && empty( $image ) ) {
    $wrapper_classes[] = 'no-icon';
}
if ( $url && $url_wrap ) {
    $wrapper_classes[] = 'link-wrap';
}
if ( $alignment ) {
    $wrapper_classes[] = 'align-'. $alignment;
} else {
    $wrapper_classes[] = 'align-center';
}
if ( $icon_background ) {
    $wrapper_classes[] = 'with-background';
}
if ( $hover_white_text ) {
    $wrapper_classes['hover-white-text'] = 'hover-white-text';
    $css_wrap_classes[] = 'hover-white-text';
}
if ( $hover_animation ) {
    $wrapper_classes[] = athen_hover_animation_class( $hover_animation );
    vcex_enque_style( 'hover-animations' );
}
if ( ! $hover_animation && $hover_background ) {
    $wrapper_classes[] = 'animate-bg-hover';
    $css_wrap_classes[] = 'animate-bg-hover';
}
if ( $css_animation ) {
    $wrapper_classes[] = $this->getCSSAnimation( $css_animation );
}
if ( $classes ) {
    $wrapper_classes[] = $this->getExtraClass( $classes );
}
if ( $visibility ) {
    $wrapper_classes[] = $visibility;
}
if ( $css ) {
    $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css ), 'vcex_icon_box', $atts );
    if ( in_array( $style, array( 'one', 'seven' ) ) ) {
        $css_wrap_classes[] = $css_class;
    } else {
        $wrapper_classes[] = $css_class;
    }
}

// Container Style
$wrapper_style = '';
if ( $border_radius ) {
    $wrapper_style .= 'border-radius:'. vcex_sanitize_data( $border_radius, 'border_radius' ) .';';
}
if ( 'six' == $style && $icon_color ) {
    $wrapper_style .= 'color:'. $icon_color .';';
}
if ( 'one' == $style && $container_left_padding ) {
    $wrapper_style .= 'padding-left:'. intval( $container_left_padding ) .'px;';
}
if ( 'seven' == $style && $container_right_padding ) {
    $wrapper_style .= 'padding-right:'. intval( $container_right_padding ) .'px;';
}
if ( ! $css ) {

    if ( $padding ) {
        $wrapper_style .= 'padding:'. $padding .'';
    }

    if ( 'four' == $style && $border_color ) {
        $wrapper_style .= 'border-color:'. $border_color .';';
    }
    if ( 'six' == $style && $icon_background && '' === $background ) {
        $wrapper_style .= 'background-color:'. $icon_background .';';
    }
    if ( $background && in_array( $style, $clickable_boxes ) ) {
        $wrapper_style .= 'background-color:'. $background .';';
    }
    if ( $background_image && in_array( $style, $clickable_boxes ) ) {
        $background_image = wp_get_attachment_url( $background_image );
        $wrapper_style .= 'background-image:url('. $background_image .');';
        $wrapper_classes[] = 'vcex-background-'. $background_image_style;
    }
    if ( $margin_bottom ) {
        $wrapper_style .= 'margin-bottom:'. intval( $margin_bottom ) .'px;';
    }
}
if ( $wrapper_style ) {
    $wrapper_style = ' style="' . $wrapper_style . '"';
}

// Wrapper data
$wrapper_data = ( $hover_background ) ? ' data-hover-background="'. $hover_background .'"' : '';
if ( $hover_background ) {
    $wrapper_classes['wpex-data-hover'] = 'wpex-data-hover';
    $css_wrap_classes[] = 'wpex-data-hover';
    $inline_js['data_hover'] = 'data_hover';
}

// Content style
$content_style = vcex_inline_style( array(
    'color'     => $font_color,
    'font_size' => $font_size,
) );

// Link data
if ( $url ) {

    $url_classes = '';
    if ( ! $url_wrap ) {
        $url_classes = 'vcex-icon-box-link';
    }
    if ( 'local' == $url_target ) {
        $url_classes .= ' local-scroll-link';
    } elseif ( '_blank' == $url_target ) {
        $url_target = ' target="_blank"';
    } else {
        $url_target = '';
    }
    if ( $url_rel ) {
        $url_rel = ' rel="'. $url_rel .'"';
    }

}

// Heading style
if ( $heading ) {
    $heading_style = vcex_inline_style( array(
        'font_weight'       => $heading_weight,
        'color'             => $heading_color,
        'font_size'         => $heading_size,
        'letter_spacing'    => $heading_letter_spacing,
        'margin_bottom'     => $heading_bottom_margin,
        'text_transform'    => $heading_transform,
    ) );
}

// Load inline js for front end editor
if ( ! empty( $inline_js ) ) {
    vcex_inline_js( $inline_js );
} ?>

<?php
// Open new wrapper for icon style 1
if ( $css && in_array( $style, array( 'one', 'seven' ) ) ) : ?>
    <?php
    // Remove wrapper hover
    if ( isset( $wrapper_classes['wpex-data-hover'] ) ) {
        unset( $wrapper_classes['wpex-data-hover'] );
    }
    if ( isset( $wrapper_classes['hover-white-text'] ) ) {
        unset( $wrapper_classes['hover-white-text'] );
    }
    // Convert wrapper classes to string
    $css_wrap_classes = implode( ' ', $css_wrap_classes );
    // Add hover animations to css div
    $outer_wrap_data = '';
    if ( $hover_background ) {
        $outer_wrap_data = 'data-hover-background="'. $hover_background .'"';
    }?>
    <div class="<?php echo $css_wrap_classes; ?>"<?php echo $outer_wrap_data; ?>>
<?php endif; ?>

<?php
// Convert wrapper classes to string
$wrapper_classes = implode( ' ', $wrapper_classes );

// Open link tag if url and url_wrap are defined
if ( $url && $url_wrap ) : ?>
<a href="<?php echo $url; ?>" title="<?php echo esc_attr( $heading ); ?>" class="<?php echo $wrapper_classes; ?>"<?php vcex_unique_id( $unique_id ); ?><?php echo $wrapper_style; ?><?php echo $url_target; ?><?php echo $url_rel; ?><?php echo $wrapper_data; ?>>
<?php else : ?>
<div class="<?php echo $wrapper_classes; ?>"<?php vcex_unique_id( $unique_id ); ?><?php echo $wrapper_style; ?><?php echo $wrapper_data; ?>>
<?php endif; ?>

    <?php
    // Open link if url is defined and the entire wrapper isn't a link
    if ( $url && ! $url_wrap ) : ?>
        <a href="<?php echo $url; ?>" title="<?php echo esc_attr( $heading ); ?>" class="<?php echo $url_classes; ?>"<?php echo $url_target; ?><?php echo $url_rel; ?>>
    <?php endif; ?>
    
    <?php
    // Display Image Icon Alternative
    if ( $image ) : ?>

        <img src="<?php echo $image; ?>" alt="<?php echo esc_attr( $heading ); ?>" class="vcex-icon-box-image"<?php echo vcex_inline_style( array( 'width'  => $image_width ) ); ?> />

    <?php
    // Display Icon
    elseif ( $icon ) : ?>

        <?php
        //Convert icon classes to string
        $icon_classes = implode( ' ', $icon_classes ); ?>

        <div class="<?php echo $icon_classes; ?>"<?php echo $icon_style; ?>>

            <?php
            // Display alternative icon
            if ( $icon_alternative_classes ) : ?>

                <span class="<?php echo $icon_alternative_classes; ?>"></span>

            <?php
            // Display theme supported icon
            else : ?>

                <span class="<?php echo $icon; ?>"></span>

            <?php endif; ?>

        </div><!-- .<?php echo $icon_classes; ?> -->

    <?php endif; ?>
    
    <?php
    // Display heading if defined
    if ( $heading ) : ?>

        <<?php echo $heading_type; ?> class="vcex-icon-box-heading"<?php echo $heading_style; ?>>
            <?php echo $heading; ?>
        </<?php echo $heading_type; ?>>

    <?php endif; ?>

    <?php
    // Close link around heading and icon
    if ( $url && ! $url_wrap ) echo '</a>'; ?>

    <?php
    // Display content if defined
    if ( $content ) : ?>

        <div class="vcex-icon-box-content clr"<?php echo $content_style; ?>>
            <?php echo apply_filters( 'the_content', $content ); ?>
        </div><!-- .vcex-icon-box-content -->

    <?php endif; ?>

<?php
// Close outer link wrap
if ( $url && $url_wrap ) : ?>

    </a><!-- .vcex-icon-box -->

<?php
// Close outer div wrap
else : ?>

    </div><!-- .vcex-icon-box -->

<?php endif; ?>

<?php
// Close css wrapper for icon style one
if ( $css && in_array( $style, array( 'one', 'seven' ) ) ) echo '</div>'; ?>