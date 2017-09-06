<?php 
/**
 * Template Name: Staff Template
 * 
 *
 *
 */

get_header(); ?>

<div id="content-wrap" class="container clr">

		<?php athen_hook_primary_before(); ?>

		<div id="primary" class="posts-box clr">

			<?php athen_hook_content_before(); ?>

			<div id="content" class="site-content clr" role="main">

				<?php athen_hook_content_top(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php if ( has_post_thumbnail() && athen_get_mod( 'page_featured_image' ) ) : ?>

						<div id="page-featured-img" class="clr">
							<?php the_post_thumbnail(); ?>
						</div><!-- #page-featured-img -->

					<?php endif; ?>

					<div class="entry-content entry clr">
						<?php the_content(); ?>
					</div><!-- .entry-content -->

				<?php endwhile; ?>
                                
                                <?php athen_display_filter_btn( "staff_category", "slug" ); ?>
                                
				<?php
				global $post, $paged, $more;
				$more = 0;
                                
                                $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
				// Query posts
				$wp_query = new WP_Query(
					array(
						'post_type'			=> 'staff',
                                                'posts_per_page'                => 3,
                                                'paged'                         => $paged,
					)
				);
                               
				if ( $wp_query->posts ) :  ?>

                                    <div id="blog-entries" class="post-type-entries clr <?php athen_blog_wrap_classes(); ?>">
					<?php $athen_count = 0; ?>
					<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                                            <?php $athen_count++; ?>
                                            <?php get_template_part( 'partials/staff/staff-entry-template' ); ?>
                                            <?php if ( athen_blog_entry_columns() == $athen_count ) $athen_count=0; ?>
                                        <?php endwhile; ?>
                                    </div><!-- #blog-entries -->

				<?php endif; ?>
                                    
                                <?php Athen_Pagination::athen_blog_pagination(); ?>

				<?php wp_reset_postdata(); wp_reset_query(); ?>

				<?php athen_hook_content_bottom(); ?>

			</div><!-- #content -->

			<?php athen_hook_content_after(); ?>

		</div><!-- #primary -->

		<?php athen_hook_primary_after(); ?>

	</div><!-- #content-wrap -->

<?php get_footer(); ?>

