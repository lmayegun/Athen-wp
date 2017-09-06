<?php
/**
  * Description : Template for displaying woocommerce content post-type. 
 * 
 * @package     Athen
 * @subpackage  Closer - View
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 */

get_header(); 

?>

    <div id="content-wrap" class="container clr">

        <?php athen_hook_primary_before(); ?>

        <div id="primary" class="content-area clr">

            <?php athen_hook_content_before(); ?>

            <main id="content" class="clr site-content" role="main">

                <?php athen_hook_content_top(); ?>

                <article class="entry-content entry clr">

                    <?php woocommerce_content(); ?>
                    
                </article><!-- #post -->

                <?php athen_hook_content_bottom(); ?>

            </main><!-- #content -->

            <?php athen_hook_content_after(); ?>

        </div><!-- #primary -->

        <?php athen_hook_primary_after(); ?>

    </div><!-- #content-wrap -->

<?php get_footer(); ?>