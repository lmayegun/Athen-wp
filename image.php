<?php
/**
 * Description : Template for attachment post type
 * 
 */

get_header(); ?>

	<div class="container clr">

		<?php athen_hook_primary_before(); ?>

		<div id="primary" class="content-area">

			<?php athen_hook_content_before(); ?>

			<main id="content" class="site-content" role="main">

				<?php athen_hook_content_top(); ?>

				<article <?php post_class( 'image-attachment' ); ?>>

					<?php echo wp_get_attachment_image( get_the_ID(), 'full' ); ?>

					<?php while ( have_posts() ) : the_post(); ?>

						<div class="entry clr">

							<?php the_content(); ?>

						</div><!-- .entry -->

					<?php endwhile ?>

				</article><!-- #post -->

				<?php athen_hook_content_bottom(); ?>

			</main><!-- #content -->

			<?php athen_hook_content_after(); ?>

		</div><!-- #primary -->

		<?php athen_hook_primary_after(); ?>

	</div><!-- .container -->

<?php get_footer(); ?>