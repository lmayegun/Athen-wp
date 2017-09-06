<?php
/**
 * Output for the Skillbar Visual Composer module
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
	'visibility'        => '',
	'css_animation'		=> '',
	'title'             => '',
	'percentage'        => '100',
	'font_size'			=> '',
	'background'        => '',
	'box_shadow'        => '',
	'color'             => '',
	'show_percent'      => '',
	'css_animation'     => '',
	'show_icon'         => '',
	'icon_type'         => 'fontawesome',
	'icon'              => '',
	'icon_fontawesome'  => '',
	'icon_openiconic'   => '',
	'icon_typicons'     => '',
	'icon_entypo'       => '',
	'icon_linecons'     => '',
	'icon_pixelicons'   => '',
	'container_height'	=> '',
), $atts ) );

// Load inline js
vcex_inline_js( array( 'skillbar' ) );

// Classes
$wrapper_classes = 'vcex-skillbar clr';
if ( 'false' == $box_shadow ) {
   $wrapper_classes .= ' disable-box-shadow';
}
if ( $css_animation ) {
	$wrapper_classes .= $this->getCSSAnimation( $css_animation );
}
if ( $classes ) {
	$wrapper_classes .= $this->getExtraClass( $classes );
}
if ( $css_animation ) {
	$wrapper_classes .= $this->getCSSAnimation( $css_animation );
}

// Set Icon Variable for output
if ( 'false' != $show_icon ) {
	if ( $icon && 'fontawesome' == $icon_type ) {
		$icon = str_replace( 'fa-', '', $icon );
		$icon = str_replace( 'fa ', '', $icon );
		$icon = 'fa fa-'. $icon;
	}
	if ( 'openiconic' == $icon_type && $icon_pixelicons ) {
		$icon = $icon_openiconic;
	}
	if ( 'typicons' == $icon_type && $icon_typicons ) {
		$icon = $icon_typicons;
	}
	if ( 'entypo' == $icon_type && $icon_entypo ) {
		$icon = $icon_entypo;
	}
	if ( 'linecons' == $icon_type && $icon_linecons ) {
		$icon = $icon_linecons;
	}
	if ( 'pixelicons' == $icon_type && $icon_pixelicons ) {
		$icon = $icon_pixelicons;
	}

	// Enqueue needed icon font.
	if ( function_exists( 'vc_icon_element_fonts_enqueue' ) && $icon_type ) {
		vc_icon_element_fonts_enqueue( $icon_type );
	}
}

// Style
$wrapper_style = vcex_inline_style( array(
	'background'		=> $background,
	'font_size'			=> $font_size,
	'height_px'			=> $container_height,
	'line_height_px'	=> $container_height,
) );
$title_style = vcex_inline_style( array(
	'background'	=> $color,
) );
$bar_style = vcex_inline_style( array(
	'background'	=> $color,
) ); ?>

<div class="<?php echo $wrapper_classes; ?>" data-percent="<?php echo intval( $percentage ); ?>&#37;"<?php vcex_unique_id( $unique_id ); ?><?php echo $wrapper_style; ?>>
	<div class="vcex-skillbar-title"<?php echo $title_style; ?>>
		<div class="vcex-skillbar-title-inner">
			<?php if ( 'false' != $show_icon && $icon ) { ?>
				<span class="vcex-icon-wrap"><span class="<?php echo $icon; ?>"></span></span>
			<?php } ?>
			<?php echo $title; ?>
		</div><!-- .vcex-skillbar-title-inner -->
	</div><!-- .vcex-skillbar-title -->
	<div class="vcex-skillbar-bar"<?php echo $bar_style; ?>>
		<?php if ( 'false' != $show_percent && $percentage ) { ?>
			<div class="vcex-skill-bar-percent"><?php echo intval( $percentage ); ?>&#37;</div>
		<?php } ?>
	</div><!-- .vcex-skillbar -->
</div><!-- .vcex-skillbar -->