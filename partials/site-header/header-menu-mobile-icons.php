<?php
/**
 * Mobile Icons Header Menu.
 *
 * @package     Total
 * @subpackage  Partials/Header
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       1.6.0
 * @version     2.1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get global object
$athen_std_theme = athen_global_obj();

// Vars
$mobile_menu_open_button_text = '<span class="fa fa-bars"></span>';
$mobile_menu_open_button_text = apply_filters( 'athen_mobile_menu_open_button_text', $mobile_menu_open_button_text ); ?>

<?php
// Closing toggle for the sidr mobile menu style
if ( 'sidr' == $athen_std_theme->mobile_menu_style ) : ?>

    <div id="sidr-close"><a href="#sidr-close" class="toggle-sidr-close"></a></div>

<?php endif; ?>

<div id="mobile-menu" class="clr athen-hidden">

    <a href="#mobile-menu" class="mobile-menu-toggle"><?php echo $mobile_menu_open_button_text; ?></a>

    <?php
    // Output icons if the mobile_menu region has a menu defined
    if ( has_nav_menu( 'mobile_menu' ) ) {
        if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ 'mobile_menu' ] ) ) {
            $menu = wp_get_nav_menu_object( $locations[ 'mobile_menu' ] );
            if ( ! empty( $menu ) ) {
                $menu_items = wp_get_nav_menu_items( $menu->term_id );
                foreach ( $menu_items as $key => $menu_item ) {
                    // Make sure it's a font-awesome icon
                    if ( in_array( $menu_item->title, athen_get_awesome_icons() ) ) {
                        $url = $menu_item->url;
                        $attr_title = $menu_item->attr_title; ?>
                        <a href="<?php echo $url; ?>" title="<?php echo $attr_title; ?>" class="mobile-menu-extra-icons mobile-menu-<?php echo $menu_item->title; ?>">
                            <span class="fa fa-<?php echo $menu_item->title; ?>"></span>
                        </a>
                <?php }
                }
            }
        }
    } ?>

</div><!-- #mobile-menu -->