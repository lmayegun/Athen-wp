<?php
/**
 * The page header displays at the top of all single pages, posts and archives.
 * See framework/page-header.php for all page header related functions.
 * See framework/hooks/actions.php for all functions attached to the header hooks.
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
} ?>

<?php athen_hook_page_header_before(); ?>

<header class="<?php echo Athen_Page_Header::athen_page_header_classes('wrap'); ?>">

	<?php athen_hook_page_header_top(); ?>

	<div class="clr page-header-inner <?php echo Athen_Page_Header::athen_page_header_classes('inner'); ?>">

		<?php athen_hook_page_header_inner(); // All default content added via this hook ?>

	</div><!-- .page-header-inner -->

	<?php athen_hook_page_header_bottom(); ?>

</header><!-- .page-header -->

<?php athen_hook_page_header_after(); ?>