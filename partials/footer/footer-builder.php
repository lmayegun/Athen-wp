<?php
/**
 * Footer Builder Content
 *
 * @package     Total
 * @subpackage  Partials/Footer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       1.6.0
 * @version     2.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get page ID
$page_id = athen_get_mod( 'footer_builder_page_id' );

// WPML fix
if ( function_exists( 'icl_object_id' ) ) {
    $page_id = icl_object_id( $page_id, 'page' );
}

// Return if no page id
if ( ! $page_id ) {
	return;
} ?>

<div class="footer-builder clr">
    <div class="footer-builder-content clr container">
        <?php echo do_shortcode( get_post_field( 'post_content', $page_id ) ); ?>
    </div><!-- .footer-builder-content -->
</div><!-- .footer-builder -->