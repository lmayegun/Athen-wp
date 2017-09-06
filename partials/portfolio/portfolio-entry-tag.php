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

$cat = athen_get_post_cpt_terms( get_the_ID(), "portfolio_category");

?>

    <ul class="entry-category-label">
        <?php foreach ($cat as $Cat ): ?>
            <li>
            <a href= " <?php echo esc_url(home_url('/')); ?>/portfolio-category/<?php echo( $Cat ); ?> " > <?php echo( $Cat ); ?> </a>
            </li>
        <?php endforeach; ?>
    </ul>  