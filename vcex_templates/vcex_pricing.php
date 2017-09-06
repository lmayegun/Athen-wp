<?php
/**
 * Output for the Pricing Visual Composer module
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
    'unique_id'                         => '',
    'el_class'                          => '',
    'visibility'                        => '',
    'css_animation'                     => '',
    'hover_animation'                   => '',
    'position'                          => '',
    'featured'                          => 'no',
    'features_padding'                  => '',
    'features_bg'                       => '',
    'features_border'                   => '',
    'plan'                              => '',
    'plan_background'                   => '',
    'plan_color'                        => '',
    'plan_padding'                      => '',
    'plan_margin'                       => '',
    'plan_size'                         => '',
    'plan_letter_spacing'               => '',
    'plan_text_transform'               => '',
    'plan_weight'                       => '',
    'plan_border'                       => '',
    'cost'                              => '',
    'cost_padding'                      => '',
    'cost_border'                       => '',
    'cost_background'                   => '',
    'cost_color'                        => '',
    'cost_size'                         => '',
    'cost_weight'                       => '',
    'per'                               => '',
    'per_display'                       => '',
    'per_color'                         => '',
    'per_weight'                        => '',
    'per_transform'                     => '',
    'per_size'                          => '',
    'button_style'                      => 'flat',
    'button_style_color'                => '',
    'button_url'                        => '',
    'button_text'                       => __( 'Button Text', 'athen_transl' ),
    'button_bg_color'                   => '',
    'button_hover_bg_color'             => '',
    'button_wrap_padding'               => '',
    'button_wrap_bg'                    => '',
    'button_wrap_border'                => '',
    'button_color'                      => '',
    'button_hover_color'                => '',
    'button_target'                     => 'self',
    'button_rel'                        => 'nofollow',
    'button_border_radius'              => '',
    'button_size'                       => '',
    'custom_button'                     => '',
    'button_padding'                    => '',
    'button_weight'                     => '',
    'button_letter_spacing'             => '',
    'button_transform'                  => '',
    'class'                             => '',
    'font_color'                        => '',
    'font_size'                         => '',
    'button_icon_left'                  => '',
    'button_icon_left_openiconic'       => '',
    'button_icon_left_typicons'         => '',
    'button_icon_left_entypo'           => '',
    'button_icon_left_linecons'         => '',
    'button_icon_left_pixelicons'       => '',
    'button_icon_right'                 => '',
    'button_icon_right_openiconic'      => '',
    'button_icon_right_typicons'        => '',
    'button_icon_right_entypo'          => '',
    'button_icon_right_linecons'        => '',
    'button_icon_right_pixelicons'      => '',
    'icon_type'                         => 'fontawesome',
), $atts ) );

// Sanitize vars
$inline_js          = array();
$featured_pricing   = ( 'yes' == $featured ) ? true : false;
$button_url         = $custom_button ? false : $button_url;

// Wrapper classes
$wrapper_classes = array( 'vcex-pricing' );
if ( $featured_pricing ) {
    $wrapper_classes[] = 'featured';
}
if ( $css_animation ) {
    $wrapper_classes[] = $this->getCSSAnimation( $css_animation );
}
if ( $el_class ) {
    $wrapper_classes[] = $this->getExtraClass( $el_class );
}
if ( $visibility ) {
    $wrapper_classes[] = $visibility;
}
if ( $hover_animation ) {
    $wrapper_classes[] = athen_hover_animation_class( $hover_animation );
    vcex_enque_style( 'hover-animations' );
}
$wrapper_classes = implode( ' ', $wrapper_classes );

// Plan style
if ( $plan ) {
    $plan_style = vcex_inline_style( array(
        'margin'            => $plan_margin,
        'padding'           => $plan_padding,
        'background'        => $plan_background,
        'color'             => $plan_color,
        'font_size'         => $plan_size,
        'font_weight'       => $plan_weight,
        'letter_spacing'    => $plan_letter_spacing,
        'border'            => $plan_border,
        'text_transform'    => $plan_text_transform,
    ) );
}

// Cost Wrap style
if ( $cost ) {
    $cost_wrap_style = vcex_inline_style( array(
        'background'    => $cost_background,
        'padding'       => $cost_padding,
        'border'        => $cost_border,
    ) );
    $cost_style = vcex_inline_style( array(
        'color'         => $cost_color,
        'font_size'     => $cost_size,
        'font_weight'   => $cost_weight,
    ) );
}

// Per style
if ( $per ) {
    $per_style = vcex_inline_style( array(
        'display'           => $per_display,
        'font_size'         => $per_size,
        'color'             => $per_color,
        'font_weight'       => $per_weight,
        'text_transform'    => $per_transform,
    ) );
}

// Features Style
if ( $content ) {
     $features_style = vcex_inline_style( array(
        'padding'       => $features_padding,
        'background'    => $features_bg,
        'border'        => $features_border,
        'color'         => $font_color,
        'font_size'     => $font_size,
    ) );
}

// Button URL & attributes
if ( $button_url ) {

    $button_url_temp    = $button_url;
    $button_url         = vcex_get_link_data( 'url', $button_url_temp );

    if ( $button_url ) {

        $button_title   = vcex_get_link_data( 'title', $button_url_temp );
        $button_target  = vcex_get_link_data( 'target', $button_url_temp );
        $button_target  = vcex_html( 'target_attr', $button_target );

    }

}

// Button Icons, Classes & Style
if ( $button_url || $custom_button ) {

    // Button Wrap Style
    $button_wrap_style = vcex_inline_style( array(
        'padding'       => $button_wrap_padding,
        'border'        => $button_wrap_border,
        'background'    => $button_wrap_bg,
    ) );

    // VCEX button styles
    if ( $button_url ) {

        // Get correct icon classes
        $button_icon_left   = vcex_get_icon_class( $atts, 'button_icon_left' );
        $button_icon_right  = vcex_get_icon_class( $atts, 'button_icon_right' );

        if ( $button_icon_left || $button_icon_right ) {
            vcex_enqueue_icon_font( $icon_type );
        }

    	// Button Classes
    	$button_classes = array( 'vcex-button', 'animate-on-hover' );
    	if ( $button_style ) {
    		$button_classes[] = $button_style; 
    	}
    	if ( $button_style_color ) {
    		$button_classes[] = $button_style_color;
    	}
    	if ( $button_transform ) {
    	    $button_classes[] = 'text-transform-'. $button_transform;
    	}
    	if ( $button_hover_bg_color || $button_hover_color ) {
    	    $button_classes[] = 'wpex-data-hover';
            $inline_js[] = 'data_hover';
    	}
        $button_classes = implode( ' ', $button_classes );

        // Button Data attributes
        $button_data = array();
        if ( $button_hover_bg_color ) {
            $button_data[] = 'data-hover-background="'. $button_hover_bg_color .'"';
        }
        if ( $button_hover_color ) {
            $button_data[] = 'data-hover-color="'. $button_hover_color .'"';
        }
        $button_data = implode( ' ', $button_data );

    	// Button Style
        $border_color = ( 'outline' == $button_style ) ? $button_color : '';
    	$button_style = vcex_inline_style( array(
            'background'        => $button_bg_color,
            'color'             => $button_color,
            'letter_spacing'    => $button_letter_spacing,
            'font_size'         => $button_size,
            'padding'           => $button_padding,
            'border_radius'     => $button_border_radius,
            'font_weight'       => $button_weight,
            'border_color'      => $border_color,
        ) );

    }

}

// Load inline js for the front-end composer
if ( ! empty( $inline_js ) ) {
    vcex_inline_js( $inline_js );
} ?>

<div class="<?php echo $wrapper_classes; ?>"<?php vcex_unique_id( $unique_id ); ?>>

    <?php
    // Display plan
    if ( $plan ) : ?>

        <div class="vcex-pricing-header clr"<?php echo $plan_style; ?>>
            <?php echo $plan; ?>
        </div><!-- .vcex-pricing-header -->

    <?php endif; ?>

    <?php
    // Display cost
    if ( $cost ) : ?>

        <div class="vcex-pricing-cost clr"<?php echo $cost_wrap_style; ?>>
            <div class="vcex-pricing-ammount" <?php echo $cost_style; ?>>
                <?php echo $cost; ?>
            </div><!-- .vcex-pricing-ammount -->
            <?php if ( $per ) { ?>
                <div class="vcex-pricing-per"<?php echo $per_style; ?>>
                    <?php echo $per; ?>
                </div><!-- .vcex-pricing-per -->
            <?php } ?>
        </div><!-- .vcex-pricing-cost -->

    <?php endif; ?>

    <?php
    // Display content
    if ( $content ) : ?>

        <div class="vcex-pricing-content"<?php echo $features_style; ?>>
            <?php echo do_shortcode( $content ); ?>
        </div><!-- .vcex-pricing-content -->

    <?php endif; ?>
    
    <?php
    // Display button
    if ( $button_url || $custom_button ) : ?>

        <div class="vcex-pricing-button"<?php echo $button_wrap_style; ?>>
            <?php if ( $custom_button ) : ?>

                <?php echo rawurldecode( base64_decode( strip_tags( $custom_button ) ) ); ?>

            <?php elseif ( $button_url ) : ?>

                <a href="<?php echo esc_url( $button_url ); ?>" title="<?php esc_attr( $button_title ); ?>" class="<?php echo $button_classes; ?>"<?php echo $button_target; ?><?php echo $button_style; ?><?php echo $button_data; ?>>
                    <?php if ( $button_icon_left ) { ?>
                        <span class="vcex-icon-wrap left"><span class="<?php echo $button_icon_left; ?>"></span></span>
                    <?php } ?>
                    <?php echo $button_text; ?>
                    <?php if ( $button_icon_right ) { ?>
                        <span class="vcex-icon-wrap right"><span class="<?php echo $button_icon_right; ?>"></span></span>
                    <?php } ?>
                </a>
            <?php endif; ?>

        </div><!-- .vcex-pricing-button -->

    <?php endif; ?>

</div><!-- .vcex-pricing -->