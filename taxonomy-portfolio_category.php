<?php
/**
 /**
 * Description : Template for displaying portfolio post-type category archive. 
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

                <main id="content" class="site-content clr" role="main">

                    <?php athen_hook_content_top(); ?>

                    <?php if ( have_posts( ) ) : ?>

                        <div id="portfolio-entries" class="<?php echo athen_get_portfolio_wrap_classes(); ?>">

                            <?php $athen_count = 0; ?>

                            <?php while ( have_posts() ) : the_post(); ?>

                                <?php $athen_count++; ?>

                                <?php get_template_part( 'partials/portfolio/portfolio-entry' ); ?>

                                <?php if ( $athen_count == athen_portfolio_archive_columns() ) $athen_count=0; ?>

                            <?php endwhile; ?>

                        </div><!-- #portfolio-entries -->

                        <?php Athen_Pagination::athen_pagination(); ?>

                    <?php else : ?>

                        <article class="clr"><?php _e( 'No Posts found.', 'athen_transl' ); ?></article>

                    <?php endif; ?>

                    <?php athen_hook_content_bottom(); ?>

                </main><!-- #content -->

                <?php athen_hook_content_after(); ?>

            </div><!-- #primary -->

            <?php athen_hook_primary_after(); ?>

    </div><!-- #content-wrap -->

<?php get_footer(); ?>