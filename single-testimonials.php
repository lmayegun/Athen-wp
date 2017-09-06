<?php
/**
/**
 * Description : Template for displaying testimonial post-type. 
 * 
 * @package     Athen
 * @subpackage  Closer - View
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 * Dependent : http://codex.wordpress.org/Template_Hierarchy
 *
 */

get_header(); ?>

    
    <div id="content-wrap" class="container clr">

        <?php athen_hook_primary_before(); ?>

        <div id="primary" class="content-area clr">

            <?php athen_hook_content_before(); ?>

            <main id="content" class="clr site-content" role="main">

                <?php athen_hook_content_top(); ?>

                <?php while ( have_posts() ) : the_post(); ?>

                    <article class="clr">

                        <div class="entry-content entry clr">

                            <?php if ( 'blockquote' == athen_get_mod( 'testimonial_post_style', 'blockquote' ) ) : ?>

                                <?php get_template_part( 'partials/testimonials/testimonials-entry' ); ?>

                            <?php else : ?>

                                <?php the_content(); ?>

                            <?php endif; ?>

                        </div><!-- .entry-content -->

                    </article><!-- #post -->

                    <?php
                    // Displays comments if enabled
                    if ( athen_get_mod( 'testimonials_comments' ) && comments_open() ) : ?>

                        <section id="testimonials-post-comments" class="clr">
                            <?php comments_template(); ?>
                        </section><!-- #testimonials-post-comments -->

                    <?php endif; ?>

                <?php endwhile; ?>

                <?php athen_hook_content_bottom(); ?>

            </main><!-- #content -->

            <?php athen_hook_content_after(); ?>

        </div><!-- #primary -->

        <?php athen_hook_primary_after(); ?>

    </div><!-- .container -->

<?php get_footer();?>