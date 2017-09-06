<?php
/**
 * Template Name: Blog
 *
 * @package		Total
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since 		1.0.0
 * @version		2.0.2
 */

get_header(); ?>

	<div id="content-wrap" class="container clr">

		<?php athen_hook_primary_before(); ?>

		<section id="primary" class="content-area clr">

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

				<?php
				global $post, $paged, $more;
				$more = 0;
				if ( get_query_var( 'paged' ) ) {
					$paged = get_query_var( 'paged' );
				} else if ( get_query_var( 'page' ) ) {
					$paged = get_query_var( 'page' );
				} else {
					$paged = 1;
				}
				// Query posts
				$wp_query = new WP_Query(
					array(
						'post_type'			=> 'post',
						'paged'				=> $paged,
						'category__not_in'	=> athen_blog_exclude_categories( true ),
					)
				);
				if ( $wp_query->posts ) : ?>

					<div id="blog-entries" class="clr <?php athen_blog_wrap_classes(); ?>">
						<?php $athen_count = 0; ?>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php $athen_count++; ?>
							<?php get_template_part( 'partials/blog/blog-entry-layout' ); ?>
							<?php if ( athen_blog_entry_columns() == $athen_count ) $athen_count=0; ?>
						<?php endwhile; ?>
					</div><!-- #blog-entries -->

					<?php athen_blog_pagination(); ?>

				<?php endif; ?>

				<?php wp_reset_postdata(); wp_reset_query(); ?>

				<?php athen_hook_content_bottom(); ?>

			</div><!-- #content -->

			<?php athen_hook_content_after(); ?>

		</section><!-- #primary -->

		<?php athen_hook_primary_after(); ?>

	</div><!-- #content-wrap -->

<?php get_footer(); ?>