<?php
/**
 * Description : Template for 404 error page
 * 
 */

get_header(); ?>
    
    <div id="content-wrap" class="container clr">

        <?php athen_hook_primary_before(); ?>

        <div id="primary" class="content-area clr">

            <?php athen_hook_content_before(); ?>

            <main id="content" class="clr site-content" role="main">

                <?php athen_hook_content_top(); ?>

                <article class="entry clr">

                    <?php
                    // Display custom text
                    if ( $athen_error_page_text = athen_get_mod( 'error_page_text' ) )  : ?>

                        <?php
                        // Translate theme mod
                        $athen_error_page_text = athen_translate_theme_mod( 'error_page_text', $athen_error_page_text ); ?>

                        <div class="custom-error404-content clr">
                            <?php echo apply_filters( 'the_content', $athen_error_page_text ); ?>
                        </div><!-- .custom-error404-content -->

                    <?php
                    // Display default text
                    else : ?>

                        <div class="error404-content clr">

                            <h1><?php _e('You Broke The Internet!', 'athen_transl' ) ?></h1>
                            <p><?php _e( 'We are just kidding...but sorry the page you were looking for can not be found.', 'athen_transl' ); ?></p>

                        </div><!-- .error404-content -->

                    <?php endif; ?>

                </article><!-- .entry -->

                <?php athen_hook_content_bottom(); ?>

            </main><!-- #content -->

            <?php athen_hook_content_after(); ?>

        </div><!-- #primary -->

        <?php athen_hook_primary_after(); ?>

    </div><!-- .container -->
    
<?php get_footer(); ?>