<?php
/**
 * Term descriptions
 *
 * @package     Total
 * @subpackage  Partials
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
 * @version     2.1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Display term description if there is one
if ( $description = term_description() )  : ?>

	<div class="term-description clr">
	    <?php echo term_description(); ?>
	</div><!-- #term-description -->

<?php endif; ?>