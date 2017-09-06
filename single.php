<?php
/**
 /**
 * Description : Template for displaying single post, either use single-standard or single -other. 
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

    <?php
    // Standard post template file

    if ( is_singular( 'post' ) ) : ?>

        <?php get_template_part( 'single-standard' ); ?>
 	
    <?php
    /**
     * Third party post type template file
     * You can create a file called single-post_type.php in your child theme and it will use that instead
     */
    else : ?>

        <?php get_template_part( 'single-other' ); ?>

    <?php endif; ?>

<?php get_footer(); ?>