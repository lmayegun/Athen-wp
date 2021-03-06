<?php
/**
 * Create Custom Columns for the WP dashboard
 *
 * @package		Total
 * @subpackage	Framework
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		Total 1.0.0
 */

// Add thumbnails to post admin dashboard
add_filter( 'manage_post_posts_columns', 'athen_posts_columns' );
add_filter( 'manage_portfolio_posts_columns', 'athen_posts_columns' );
add_filter( 'manage_testimonials_posts_columns', 'athen_posts_columns' );
add_filter( 'manage_staff_posts_columns', 'athen_posts_columns' );
add_action( 'manage_posts_custom_column', 'athen_posts_custom_columns', 10, 2 );

add_filter( 'manage_page_posts_columns', 'athen_posts_columns' );
add_action( 'manage_pages_custom_column', 'athen_posts_custom_columns', 10, 2 );

if ( ! function_exists( 'athen_posts_columns' ) ) {
	function athen_posts_columns( $defaults ){
		$defaults['athen_post_thumbs'] = __( 'Featured Image', 'athen_transl' );
		return $defaults;
	}
}

if ( ! function_exists( 'athen_posts_custom_columns' ) ) {
	function athen_posts_custom_columns( $column_name, $id ){
		if( $column_name != 'athen_post_thumbs' ) {
			return;
		}
		if ( has_post_thumbnail( $id ) ) {
			$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'thumbnail', false );
			if( ! empty( $img_src[0] ) ) { ?>
					<img src="<?php echo $img_src[0]; ?>" alt="<?php the_title(); ?>" style="max-width:100%;max-height:90px;" />
				<?php
			}
		} else {
			echo '&mdash;';
		}
	}
}