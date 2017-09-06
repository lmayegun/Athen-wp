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

// Extract shortcode attributes
extract( shortcode_atts( array(
    'size'          => '20px',
    'class'         => '',
    'visibility'    => '',
),
$atts ) );

// Core class
$classes = 'vcex-spacing';

// Custom Class
if ( $class ) {
    $classes .= $this->getExtraClass( $class );
}

// Visiblity Class
if ( $visibility ) {
    $classes .= ' '. $visibility;
}

// Front-end composer class
if ( athen_is_front_end_composer() ) {
    $classes .= ' vc-spacing-shortcode';
} ?>

<div class="<?php echo $classes; ?>" style="height:<?php echo vcex_sanitize_data( $size, 'px-pct' ); ?>"></div>