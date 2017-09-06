<?php
/**
 * Header cart dropdown
 *
 * @package     Total
 * @subpackage  Partials/Cart
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
 * @version     1.0.0
 */ ?>

<div id="current-shop-items-dropdown" class="clr">

    <div id="current-shop-items-inner" class="clr">

        <?php
        // Display WooCommerce cart
        the_widget( 'WC_Widget_Cart' ); ?>

    </div><!-- #current-shop-items-inner -->
    
</div><!-- #current-shop-items-dropdown -->