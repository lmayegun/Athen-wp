<?php
/**
 * Footer Layout
 *
 * @package     Total
 * @subpackage  Partials/Footer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       1.6.0
 * @version     2.1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get global object
$athen_std_theme = athen_global_obj(); ?>

<?php athen_hook_footer_before(); ?>

<?php if ( $athen_std_theme->has_footer_widgets ) : ?>

    <footer id="footer" class="site-footer <?php echo athen_wrap_classes('footer-wrap'); ?> ">

        <?php athen_hook_footer_top(); ?>

        <div id="footer-main" class=" clr <?php echo Athen_Footer::athen_footer_classes(); ?> ">

            <?php athen_hook_footer_inner(); // widgets are added via this hook ?>
            
        </div><!-- #footer-widgets -->

        <?php athen_hook_footer_bottom(); ?>

    </footer><!-- #footer -->

<?php endif; ?>

<?php athen_hook_footer_after(); ?>