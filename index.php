<?php
/**
 * Description : This is the main page that will be display, no specific home.php is set.
 *               It will include all the post in wordpress site.  
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

    <div id="content-capsule" class=" content-capsule <?php echo athen_wrap_classes( 'content-wrap' ); ?> clr">

        <?php athen_hook_primary_before(); ?>

        <div id="primary" class="posts-box <?php echo athen_wrap_classes( 'posts-wrap' ); ?> clr">

            <?php athen_hook_content_before(); ?>

            <main id="content" class="site-content" role="main">

                <?php athen_hook_content_top(); ?>

                <?php
                // Display posts if there are in fact posts to display
                if ( have_posts() ) :
                    
                    /*-----------------------------------------------------------------------------------*/
                    /*  - Standard Post Type Posts (BLOG)
                    /*  - See framework/conditionals.php
                    /*  - Blog entries use partials/blog/blog-entry.php for their output
                    /*-----------------------------------------------------------------------------------*/
                    if ( athen_is_blog_query() ) : ?>

                        <div id="blog-entries" class="clr <?php athen_blog_wrap_classes(); ?>">

                            <?php
                            // Define counter for clearing floats
                            $athen_count = 0; ?>

                            <?php
                            // Start main loop
                            while ( have_posts() ) : the_post(); ?>

                                <?php
                                // Add to counter
                                $athen_count++; ?>

                                <?php
                                // Get blog entry layout
                                get_template_part( 'partials/blog/blog-entry-layout' ); ?>

                                <?php
                                // Reset counter to clear floats
                                if ( athen_blog_entry_columns() == $athen_count ) {
                                    $athen_count=0;
                                } ?>

                            <?php
                            // End loop
                            endwhile; ?>

                        </div><!-- #blog-entries -->

                        <?php
                        // Display post pagination (next/prev - 1,2,3,4..)
                        Athen_Pagination::athen_blog_pagination(); ?>

                    <?php
                    /*-----------------------------------------------------------------------------------*/
                    /*  - Custom post type archives display
                    /*  - All non standard post type entries use content-other.php for their output
                    /*-----------------------------------------------------------------------------------*/
                    else : ?>

                        <?php while ( have_posts() ) : the_post(); ?>

                            <?php get_template_part( 'partials/post-type/post-type-entry', get_post_type() ); ?>

                            <?php endwhile; ?>

                        <?php Athen_Pagination::athen_pagination(); ?>

                    <?php endif; ?>

                <?php
                // Show message because there aren't any posts
                else : ?>

                    <article class="clr"><?php _e( 'No Posts found.', 'athen_transl' ); ?></article>

                <?php endif; ?>

                 <?php athen_hook_content_bottom(); ?>

            </main><!-- #content -->

        <?php athen_hook_content_after(); ?>

        </div><!-- #primary -->

        <?php athen_hook_primary_after(); ?>

    </div><!-- .container -->
    
<?php get_footer(); ?>