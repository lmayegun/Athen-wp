<?php
/**
 * Togglebar content output
 *
 * @package		Total
 * @subpackage	Partials/Togglebar
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		1.6.0
 * @version		1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get global object
$athen_std_theme = athen_global_obj();

// Get togglebar content ID
$id = $athen_std_theme->toggle_bar_content_id;

if ( ! $id ) {
	return;
} ?>

<div class="entry clr">
	<?php echo apply_filters( 'the_content', get_post_field( 'post_content', $id ) ); ?>		
</div><!-- .entry -->