<?php
/**
 * Portfolio entry content template part
 *
 * @package		Total
 * @subpackage	Partials/Portfolio
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		1.6.0
 * @version		1.0.1
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cat = athen_get_post_cpt_terms( get_the_ID(), "staff_category");

?>

    <ul class="entry-category-label">
        <?php foreach ($cat as $Cat ): ?>
            <li>
         <?php   athen_list_post_terms( 'staff_category', true, true ); ?>
            </li>
        <?php endforeach; ?>
    </ul>  