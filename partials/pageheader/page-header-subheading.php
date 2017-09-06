<?php
/**
 * Page subheading output
 *
 * @package		Total
 * @subpackage	Partials
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		1.6.0
 * @version		2.1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get global object
$athen_std_theme = athen_global_obj();

// Get subheading
$subheading = Athen_Page_Header::athen_get_page_subheading( $athen_std_theme->post_id );

// If subheading exists display it
if ( $subheading ) : ?>
	<h5 class="clr page-description">
		<?php echo do_shortcode( $subheading ); ?>
	</h5>
<?php endif; ?>