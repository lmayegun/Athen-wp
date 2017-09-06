<?php
/**
 * Loop Top : Blog / Standard entries
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
	get_template_part( 'partials/loop-top' );
} ?>

<div class="woocommerce clr">
	<ul class="products wpex-row clr">