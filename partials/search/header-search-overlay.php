<?php
/**
 * Site header search dropdown HTML
 *
 * @package		Total
 * @subpackage	Partials/Search
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since	 	1.6.0
 * @version		1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<section id="searchform-overlay" class="header-searchform-wrap clr">
	<div id="searchform-overlay-title"><?php echo Athen_Search_Func::athen_header_search_placeholder(); ?></div>
	<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search" class="header-searchform">
		<input type="search" name="s" autocomplete="off" />
		<?php if ( ATHEN_CHECK_WPML ) { ?>
			<input type="hidden" name="lang" value="<?php echo( ICL_LANGUAGE_CODE ); ?>"/>
		<?php } ?>
	</form>
</section><!-- #searchform-overlay -->