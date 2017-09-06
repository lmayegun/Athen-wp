<?php
/**
/**
 * Description : Template for displaying single standadrd post-type (would only be use if a post-type single is not define). 
 * 
 * @package     Athen
 * @subpackage  Closer - View
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 * Dependent : http://codex.wordpress.org/Template_Hierarchy
 *
 */ ?>

<div id="content-capsule" class="content-capsule <?php echo athen_wrap_classes( 'content-wrap' ); ?>  clr">

    <?php athen_hook_primary_before(); ?>

    <div id="primary" class="post-box clr">

        <?php athen_hook_content_before(); ?>

        <main id="content" class="site-content clr" role="main">

            <?php athen_hook_content_top(); ?>

            <?php while ( have_posts() ) : the_post(); ?>

                <article class="single-blog-article clr">

                    <?php get_template_part( 'partials/blog/blog-single-layout' ); ?>

                </article><!-- .entry -->

            <?php endwhile; ?>

            <?php athen_hook_content_bottom(); ?>

        </main><!-- #content -->

        <?php athen_hook_content_after(); ?>

    </div><!-- #primary -->

    <?php athen_hook_primary_after(); ?>

</div><!-- .container -->