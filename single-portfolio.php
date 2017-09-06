<?php
/**
 * Description : Template for displaying single portfolio post-type. 
 * 
 * @package     Athen
 * @subpackage  Closer - View
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 * Dependent : http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

    <div id="content-wrap" class="container clr">

        <?php athen_hook_primary_before(); ?>

        <div id="primary" class="content-area clr">

            <?php athen_hook_content_before(); ?>

            <main id="content" class="site-content clr" role="main">

                <?php athen_hook_content_top(); ?>

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php get_template_part( 'partials/portfolio/portfolio-single-layout' ); ?>

                    <?php endwhile; ?>

                <?php athen_hook_content_bottom(); ?>

            </main><!-- #content -->

            <?php athen_hook_content_after(); ?>

        </div><!-- #primary -->

        <?php athen_hook_primary_after(); ?>

    </div><!-- .container -->

<?php get_footer();?>