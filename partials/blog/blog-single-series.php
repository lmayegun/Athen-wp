<?php
/**
 * Single related posts
 *
 * @package		Total
 * @subpackage	Partials/Blog
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		1.6.0
 * @version		2.1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Return if taxonomy doesn't exist
if ( ! taxonomy_exists( 'post_series' ) ) {
	return;
}

// Get post ID
$post_id = get_the_ID();

// Return if pass protected
if ( post_password_required( $post_id ) ) {
	return;
}

// Get post terms
$terms = wp_get_post_terms( $post_id, 'post_series' );

// Display if series are found
if ( isset( $terms[0] ) ) :

	// Get all posts in series
	$athen_query = new wp_query( array(
		'post_type'			=> 'post',
		'posts_per_page'	=> -1,
		'orderby'			=> 'Date',
		'order'				=> 'ASC',
		'no_found_rows'		=> true,
		'tax_query'			=> array( array(
				'taxonomy'	=> 'post_series',
				'field'		=> 'id',
				'terms'		=> $terms[0]->term_id
		) ),
	) );

	$athen_query = apply_filters( 'athen_post_series_query_args', $athen_query );

	// Display series if posts are found
	if ( $athen_query->have_posts() ) : ?>

		<section id="post-series" class="clr">

			<div id="post-series-title">
				<?php echo athen_get_mod( 'post_series_heading', __( 'Post Series:', 'athen_transl' ) ); ?> <?php echo $terms[0]->name; ?>
			</div><!-- #post-series-title -->

			<ul id="post-series-list" class="clr">
				<?php
				$count=0;
				foreach( $athen_query->posts as $post ) : setup_postdata( $post );
				$count++;
				$current_post_id = $post->ID;
				if ( $current_post_id == $post_id ) { ?>

					<li class="post-series-current">
						<span class="post-series-count"><?php echo $count; ?>.</span><?php the_title(); ?>
					</li>

				<?php } else { ?>

					<li>
						<span class="post-series-count"><?php echo $count; ?>.</span><a href="<?php athen_permalink(); ?>" title="<?php athen_esc_title(); ?>"><?php the_title(); ?></a>
					</li>
				<?php } endforeach; ?>

			</ul><!-- #post-series-list -->

		</section><!-- #post-series -->

	<?php endif; ?>

	<?php wp_reset_postdata(); ?>

<?php endif; ?>