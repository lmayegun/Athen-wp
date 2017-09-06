<?php
/**
 * Mobile Menu alternative.
 *
 * @package     Total
 * @subpackage  Partials/Header
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       1.6.0
 * @version     1.0.3
 */ ?>

<div id="mobile-menu-alternative" class="wpex-hidden">
    <?php wp_nav_menu( array(
        'theme_location'    => 'mobile_menu_alt',
        'menu_class'        => 'dropdown-menu',
        'fallback_cb'       => false,
    ) ); ?>
</div><!-- #mobile-menu-alternative -->