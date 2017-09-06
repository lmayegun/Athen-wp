<?php
/**
 * Description : Template for search result. 
 * 
 */

// Get site header
get_header(); ?>

    <div id="content-capsule" class="container clr">

        <?php athen_hook_primary_before(); ?>

        <div id="primary" class="content-area clr">

            <?php athen_hook_content_before(); ?>

            <div id="content" class="site-content" role="main">

                <?php athen_hook_content_top(); ?>

                <?php
                // Check if there are search results
                if ( have_posts() ) : ?>

                    <div id="search-entries" class="clr">

                        <?php
                        // Display blog style search results
                        if ( 'blog' == athen_search_results_style() ) : ?>

                            <div id="blog-entries" class="clr <?php athen_blog_wrap_classes(); ?>">

                                <?php $athen_count = 0; ?>

                                <?php while ( have_posts() ) : the_post(); ?>

                                    <?php $athen_count++; ?>

                                    <?php get_template_part( 'partials/blog/blog-entry', 'layout' ); ?>

                                    <?php if ( athen_blog_entry_columns() == $athen_count ) $athen_count=0; ?>

                                <?php endwhile; ?>

                            </div><!-- #blog-entries -->

                        <?php
                        // Display custom style for search entries
                        else : ?>

                            <?php while ( have_posts() ) : the_post(); ?>

                                <?php get_template_part( 'partials/search/search', 'entry' ); ?>

                            <?php endwhile; ?>

                        <?php endif; ?>

                    </div><!-- #search-entries -->

                    <?php
                    // Display pagination
                    Athen_Pagination::athen_pagination(); ?>

                <?php
                // No search results found
                else : ?>

                    <article id="search-no-results" class="clr">

                        <?php _e( 'Sorry, no results were found for this query.', 'athen_transl' ); ?>

                    </article><!-- #search-no-results -->

                <?php endif; ?>

                <?php athen_hook_content_bottom(); ?>

            </div><!-- #content -->

            <?php athen_hook_content_after(); ?>

        </div><!-- #primary -->

        <?php athen_hook_primary_after(); ?>

    </div><!-- .container -->

<?php
// Get site footer
get_footer(); ?>