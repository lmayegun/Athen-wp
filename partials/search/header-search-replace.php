<?php
/**
 * Site header search dropdown HTML
 *
 * @package		Total
 * @subpackage	Partials/Search
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		1.6.0
 * @version		1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div id="searchform-header-replace" class="clr header-searchform-wrap">
	<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search" class="header-searchform">
		<input type="search" name="s" autocomplete="off" placeholder="<?php echo Athen_Search_Func::athen_header_search_placeholder(); ?>" />
		<?php if ( ATHEN_CHECK_WPML ) { ?>
			<input type="hidden" name="lang" value="<?php echo( ICL_LANGUAGE_CODE ); ?>"/>
		<?php } ?>
	</form>
	<span id="searchform-header-replace-close" class="fa fa-times"></span>
</div><!-- #searchform-header-replace -->