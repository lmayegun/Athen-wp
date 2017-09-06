<?php
/**
 * Search entry header
 *
 * @package		Total
 * @subpackage	Partials/Search
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		2.0.0
 * @version		2.1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<header class="search-entry-header clr">
	<h2><a href="<?php athen_permalink(); ?>" title="<?php athen_esc_title(); ?>"><?php the_title(); ?></a></h2>
</header><!-- .search-entry-header -->