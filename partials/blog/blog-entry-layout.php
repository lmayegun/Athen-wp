<?php
/**
 * Blog entry layout
 *
 * @package     Total
 * @subpackage  Partials/Blog
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       1.6.0
 * @version     2.0.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get post data
$post_format    = get_post_format();
$entry_style    = athen_blog_entry_style();
$social_share   = Athen_Social_Share::athen_social_share_animation();

// Quote format is completely different
if ( 'quote' == $post_format ) :

    // Get quote entry content
    get_template_part( 'partials/blog/blog-entry-quote' );

    // Don't run any other code in this file
    return;

endif;

// Add classes to the blog entry post class - see framework/blog/blog-functions
$classes = athen_blog_entry_classes();

// Get layout blocks
$blocks = athen_blog_entry_layout_blocks(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

    <div class="blog-entry-inner clr">
		
        <?php 
        // Thumbnail entry style uses different layout
        if ( 'thumbnail-entry-style' == $entry_style ) : ?>

            <?php get_template_part( 'partials/blog/media/blog-entry', $post_format ); ?>

            <div class="blog-entry-content clr ">

                <?php
                // Loop through entry blocks
                foreach ( $blocks as $block ) : ?>

                    <?php
                    // Display the entry header
                    if ( 'post_title' == $block ) { ?>

                        <?php get_template_part( 'partials/blog/blog-entry-title' ); ?>
						

                    <?php }
					
					// Display the entry excerpt or content
                    elseif ( 'post_meta' == $block ) { ?>

                        <?php get_template_part( 'partials/blog/blog-entry-meta' ); ?>

                    <?php }

                    // Display the entry excerpt or content
                    elseif ( 'excerpt_content' == $block ) { ?>

                        <?php get_template_part( 'partials/blog/blog-entry-content' ); ?>

                    <?php }

                    // Display the readmore button
                    elseif ( 'readmore' == $block ) { ?>

                        <?php get_template_part( 'partials/blog/blog-entry-readmore' ); ?>

                    <?php }
                    
                    // Display the social share
                    elseif ( 'social_share' == $block ){ ?>
                
                        <?php //get_template_part( 'partials/social-share/social-share', $social_share ); ?>
                    
                    <?php }
                    
                     // Displaye category terms
                    elseif ( 'category_terms' == $block ){ ?>

                        <?php get_template_part( 'partials/blog/blog-terms', 'category' ); ?>

                    <?php }

                    // Displaye tag terms
                    elseif ( 'tag_terms' == $block ){ ?>

                        <?php get_template_part( 'partials/blog/blog-terms', 'tag' ); ?>

                    <?php }
                    // Custom Blocks
                    else { ?>

                        <?php get_template_part( 'partials/blog/blog-entry-'. $block ); ?>

                    <?php } ?>

                <?php
                // End block loop
                endforeach; ?>
				
                <?php
                // Display social share
                //get_template_part( 'partials/social-share/social-share', $social_share ); ?>

            </div><!-- blog-entry-content -->

        <?php

        // Other entry styles
        else :
            // Loop through composer blocks and output layout
            foreach ( $blocks as $block ) : ?>

                <?php
                // Featured media
                if ( 'featured_media' == $block ) { ?>

                    <?php get_template_part( 'partials/blog/media/blog-entry', $post_format ); ?>

                <?php }

                // Display entry post title
                elseif ( 'post_title' == $block ) { ?>

                    <?php get_template_part( 'partials/blog/blog-entry-title' ); ?>

                <?php }
				
				// Display entry meta
				elseif ( 'post_meta' == $block ) { ?>
				
					<?php get_template_part( 'partials/blog/blog-entry-meta' ); ?>
					
				<?php }

                // Display the entry excerpt or content
                elseif ( 'excerpt_content' == $block ) { ?>

                    <?php get_template_part( 'partials/blog/blog-entry-content' ); ?>

                <?php }

                // Display the readmore button
                elseif ( 'readmore' == $block ) { ?>

                    <?php get_template_part( 'partials/blog/blog-entry-readmore' ); ?>

                <?php }
                    
                // Display the social share
                elseif ( 'social_share' == $block ){ ?>
                
                    <?php //get_template_part( 'partials/social-share/social-share', $social_share ); ?>
                    
                <?php }
                    
                // Displaye category terms
                elseif ( 'category_terms' == $block ){ ?>
                
                    <?php get_template_part( 'partials/blog/blog-terms', 'category' ); ?>
                    
                <?php }
                
                // Displaye tag terms
                elseif ( 'tag_terms' == $block ){ ?>
                
                    <?php get_template_part( 'partials/blog/blog-terms', 'tag' ); ?>
                    
                <?php }

                // Custom Blocks
                else { ?>

                    <?php get_template_part( 'partials/blog/blog-entry-'. $block ); ?>

                <?php } ?>

            <?php
            // End block loop
            endforeach; ?>
			
            <?php
            // Display social share
            //get_template_part( 'partials/social-share/social-share', $social_share ); ?>

        <?php
        // End block check
        endif; ?>

    </div><!-- .blog-entry-inner -->

</article><!-- .blog-entry -->