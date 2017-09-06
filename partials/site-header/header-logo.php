<?php
/**
 * Header Logo
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

// Define variables
$logo_url       = Athen_Header::athen_header_logo_url();
$logo_img       = Athen_Header::athen_header_logo_img();
$overlay_logo   = Athen_Header::athen_header_overlay_logo();
$logo_icon      = Athen_Header::athen_header_logo_icon();
$logo_title     = Athen_Header::athen_header_logo_title(); ?>

<div id="site-logo" class="<?php echo Athen_Header::athen_header_logo_classes(); ?>">

    <?php if ( $logo_img || $overlay_logo ) : ?>

        <?php
        // Custom site-wide image logo
        if ( $logo_img ) : ?>
            <a href="<?php echo esc_url( $logo_url ); ?>" title="<?php echo esc_attr( $logo_title ); ?>" rel="home" class="main-logo">
                <img src="<?php echo esc_url( $logo_img ); ?>" alt="<?php echo esc_attr( $logo_title ); ?>" data-no-retina />
            </a>
        <?php endif; ?>

        <?php
        // Custom header-overlay logo
        if ( $overlay_logo ) : ?>
            <a href="<?php echo esc_url( $logo_url ); ?>" title="<?php echo esc_attr( $logo_title ); ?>" rel="home" class="overlay-header-logo">
                <img src="<?php echo esc_url( $overlay_logo ); ?>" alt="<?php echo esc_attr( $logo_title ); ?>" data-no-retina />
            </a>
        <?php endif; ?>

    <?php else : ?>

        <a href="<?php echo $logo_url; ?>" title="<?php echo esc_attr( $logo_title ); ?>" rel="home">
            <?php echo $logo_icon; ?><?php echo $logo_title; ?>
        </a>

    <?php endif; ?>

</div><!-- #site-logo -->