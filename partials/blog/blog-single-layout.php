<?php
/**
 * Single blog post layout
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

// Get global object
$athen_std_theme = athen_global_obj();

// Get single blog layout blocks
$post_format        = get_post_format();
$password_required  = post_password_required();

/*-----------------------------------------------------------------------------------*/
/*  - Blog post layout
/*  - All blog elements can be re-ordered via the WP Customizer so don't edit this
/*  - file unless you really have to.
/*-----------------------------------------------------------------------------------*/

// Quote format is completely different
if ( 'quote' == $post_format ) :

    get_template_part( 'partials/blog/blog-single', 'quote' );

    return;

// Blog Single Post Composer
else :

    // Get layout blocks
    $layout_blocks = athen_blog_single_layout_blocks(); 

    // Loop through blocks
    foreach ( $layout_blocks as $block ) :

        // Post title
        if ( 'title_meta' == $block ) {

            get_template_part( 'partials/blog/blog-single', 'header' );

        }

        // Featured Media - featured image, video, gallery, etc
        elseif ( 'featured_media' == $block ) {

            if ( ! $password_required && ! get_post_meta( get_the_ID(), 'athen_post_media_position', true ) ) {

                $post_format = $post_format ? $post_format : 'thumbnail';
                
                get_template_part( 'partials/blog/media/blog-single', $post_format );

            }
            
        }

        // Post Series
        elseif ( 'post_series' == $block ) {
            
            get_template_part( 'partials/blog/blog-single', 'series' );

        }

        // Get post content
        elseif ( 'the_content' == $block ) {

            get_template_part( 'partials/blog/blog-single', 'content' );
            get_template_part( 'partials/link', 'pages' );


        }

        // Social sharing links
        elseif ( 'social_share' == $block && $athen_std_theme->has_social_share && ! $password_required ) {
            
            get_template_part( 'partials/social', 'share' );
           
        }

        // Author bio
        elseif ( 'author_bio' == $block && get_the_author_meta( 'description' ) && 'hide' != get_post_meta( get_the_ID(), 'athen_post_author', true ) && ! $password_required ) {

            get_template_part( 'author-bio' );

        }

        // Displays related posts
        elseif ( 'related_posts' == $block ) {

            get_template_part( 'partials/blog/blog-single', 'related' );

        }

        // Get the post comments & comment_form
        elseif ( 'comments' == $block ) {

            comments_template();

        }

        // Custom Blocks
        else {

            get_template_part( 'partials/blog/blog-single', $block );

        }

    endforeach;

endif;