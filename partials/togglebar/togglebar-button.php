<?php
/**
 * Togglebar button output
 *
 * @package		Total
 * @subpackage	Partials/Togglebar
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		2.0.0
 * @version		1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<a href="#" class="toggle-bar-btn fade-toggle open-togglebar <?php echo athen_get_mod( 'toggle_bar_visibility' ); ?>">
	<span class="fa fa-plus"></span>
</a>