<?php
/**
 * File Description : For displaying author biography 
 * 
 * @package     Athen
 * @subpackage  Closer - View
 * @since       Closer 1.0.0
 * @version     1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get data
global $post;
$post_author    = $post->post_author;
$avatar         = get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'athen_author_bio_avatar_size', 74 ) );
$posts_url      = get_author_posts_url( get_the_author_meta( 'ID' ) );
$description    = get_the_author_meta( 'description' ); ?>

<section class="author-bio clr">

    <?php if ( $avatar ) : ?>

        <div class="author-bio-avatar">

            <a href="<?php echo $posts_url; ?>" title="<?php _e( 'Visit Author Page', 'athen_transl' ); ?>">
                <?php
                // Display author avatar
                echo $avatar; ?>
            </a>

        </div><!-- .author-bio-avatar -->
        
    <?php endif; ?>

    <div class="author-bio-content clr">

        <h4 class="author-bio-title">
            <a href="<?php echo $posts_url; ?>" title="<?php _e( 'Visit Author Page', 'athen_transl' ); ?>">
                <?php echo get_the_author(); ?>
            </a>
        </h4><!-- .author-bio-title -->

        <?php
        // Outputs the author description if one exists
        if ( $description ) : ?>

            <div class="author-bio-description clr">
                <?php echo $description; ?>
            </div><!-- author-bio-description -->

        <?php endif; ?>

        <?php
        // Display author social links if there are social links defined
        if ( athen_author_has_social() ) : ?>

            <div class="author-bio-social clr">

                <?php
                // Display twitter url
                if ( $twitter = get_the_author_meta( 'athen_twitter', $post_author ) ) : ?>
                    <a href="<?php echo $twitter; ?>" title="Twitter" class="twitter tooltip-up">
                        <span class="fa fa-twitter"></span>
                    </a>
                <?php endif; ?>

                <?php
                // Display facebook url
                if ( $facebook = get_the_author_meta( 'athen_facebook', $post_author ) ) : ?>
                    <a href="<?php echo $facebook; ?>" title="Facebook" class="facebook tooltip-up">
                        <span class="fa fa-facebook"></span>
                    </a>
                <?php endif; ?>

                <?php
                // Display google plus url
                if ( $gplus = get_the_author_meta( 'athen_googleplus', $post_author ) ) : ?>
                    <a href="<?php echo $gplus; ?>" title="Google Plus" class="google-plus tooltip-up">
                        <span class="fa fa-google-plus"></span>
                    </a>
                <?php endif; ?>

                <?php
                // Display Linkedin url
                if ( $linkedin = get_the_author_meta( 'athen_linkedin', $post_author ) ) : ?>
                    <a href="<?php echo $linkedin; ?>" title="LinkedIn" class="linkedin tooltip-up">
                        <span class="fa fa-linkedin"></span>
                    </a>
                <?php endif; ?>

                <?php
                // Display pinterest plus url
                if ( $pinterest = get_the_author_meta( 'athen_pinterest', $post_author ) ) : ?>
                    <a href="<?php echo $pinterest; ?>" title="Pinterest" class="pinterest tooltip-up">
                        <span class="fa fa-pinterest"></span>
                    </a>
                <?php endif; ?>

                <?php
                // Display instagram plus url
                if ( $instagram = get_the_author_meta( 'athen_instagram', $post_author ) ) : ?>
                    <a href="<?php echo  $instagram; ?>" title="Instagram" class="instagram tooltip-up">
                        <span class="fa fa-instagram"></span>
                    </a>
                <?php endif; ?>
            </div><!-- .author-bio-social -->

        <?php endif; ?>

    </div><!-- .author-bio-content -->

</section><!-- .author-bio -->