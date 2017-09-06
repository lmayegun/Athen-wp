<?php
/**
 * Description : Template for page post type. 
 * 
 */

// Get site header
get_header(); ?>

    <div id="content-capsule" class="content-capsule <?php echo athen_wrap_classes( 'content-wrap' ); ?> clr">

        <?php athen_hook_primary_before(); ?>

        <div id="primary" class="post-box clr">

            <?php athen_hook_content_before(); ?>
		
            <div id="content" class="clr site-content" role="main">

                <?php athen_hook_content_top(); ?>

                <?php
                // Main page loop
                while ( have_posts() ) : the_post(); ?>

                    <article class="clr">

                        <?php
                        // Check if page should display featured image
                        if ( has_post_thumbnail() && athen_get_mod( 'page_featured_image' ) ) : ?>

                            <div id="page-featured-img" class="clr">

                                <?php
                                // Dislpay full featured image
                                athen_post_thumbnail( array(
                                    'size'  => 'full',
                                    'alt'   => athen_get_esc_title(),
                                ) ); ?>
                                
                            </div><!-- #page-featured-img -->

                        <?php endif; ?>

                        <div class="entry-content entry clr">

                            <?php
                            // Output page content
                            the_content(); ?>

                            <?php
                            // Output page pagination
                            wp_link_pages( array(
                                'before'        => '<div class="page-links clr">',
                                'after'         => '</div>',
                                'link_before'   => '<span>',
                                'link_after'    => '</span>',
                            ) ); ?>

                        </div><!-- .entry-content -->

                        <?php
                        // Get social sharing template part
                        get_template_part( 'partials/social', 'share' ); ?>

                    </article><!-- #post -->

                    <?php
                    // Check if comments are enabled for pages
                    if ( athen_get_mod( 'page_comments' ) ) : ?>
                    
                        <?php
                        // Display comments
                        comments_template(); ?>

                    <?php endif; ?>

                <?php
                // End main loop
                endwhile; ?>

                <?php athen_hook_content_bottom(); ?>

            </div><!-- #content -->

            <?php athen_hook_content_after(); ?>

        </div><!-- #primary -->

        <?php athen_hook_primary_after(); ?>

    </div><!-- #content-wrap -->

<?php
// Get site footer
get_footer(); ?>