<?php
/**
 * Main Loop : Product
 *
 * @package     Total
 * @subpackage  Partials
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       2.1.0
 * @version     2.1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'woocommerce_get_template_part' ) ) {
	get_template_part( 'partials/loop' );
}

woocommerce_get_template_part( 'content', 'product' );