<?php
/**
 * Description : Class use to modify how slider should be display based on the meta provided. 
 * 
 * @package     Athen
 * @subpackage  Closer - View
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 */

class Athen_Post_Slider{
	
	public function __construct(){
		
	}
	
	/**
	 * Checks if the current page has a post slider or not
	 *
	 * @since   2.0.0
	 * @return  bool
	 */
	public function athen_has_post_slider( $post_id = '' ) {

		// Get post ID if not defined
		$post_id = $post_id ? $post_id : athen_get_the_id();

		// Return false by default
		$return = false;

		// Check for meta
		if ( $this->athen_post_slider_shortcode( $post_id ) ) {
			$return = true;
		}

		// Apply filters for child theming
		$return = apply_filters( 'athen_has_post_slider', $return );

		// Return value
		return $return;
	}
	
	/**
	 * Gets slider position based on athen_post_slider_shortcode_position custom field
	 *
	 * @since Total 1.5.1
	 */
	public function athen_post_slider_position( $post_id = '' ) {

		// Default position is below the title
		$position = 'below_title';

		// Check meta field for position
		if ( $meta = get_post_meta( $post_id, 'athen_post_slider_shortcode_position', true ) ) {
			$position = $meta;
		}

		// Apply filters for child theming
		$position = apply_filters( 'athen_post_slider_position', $position );

		// Return position
		return $position;
	}
	
	/**
	 * Returns correct post slider shortcode
	 *
	 * @since 1.6.0
	 */
	public static function athen_post_slider_shortcode( $post_id = '' ) {

		// Get post id if not defined
		$post_id = $post_id ? $post_id : athen_get_the_id();

		// Check for slider defined in custom fields
		if ( $slider = get_post_meta( $post_id, 'athen_post_slider_shortcode', true ) ) {
			$slider = $slider;
		} elseif( get_post_meta( $post_id, 'athen_page_slider_shortcode', true ) ) {
			$slider = get_post_meta( $post_id, 'athen_page_slider_shortcode', true );
		}

		// Apply filters
		$slider = apply_filters( 'athen_post_slider_shortcode', $slider );

		// Return slider
		return $slider;
	}
	
} 


/**
 * Outputs page/post slider based on the athen_post_slider_shortcode custom field
 *
 * @since Total 1.0.0
 */
function athen_post_slider( $post_id = '', $postion = '' ) {

	// Get global object
	$athen_std_theme = athen_global_obj();

	// Return if there isn't a slider defined
	if ( ! $athen_std_theme->has_post_slider ) {
		return;
	}

	// Get current filter
	$filter = current_filter();

	// Define get variable
	$get = false;

	// Get slider position
	$position = $athen_std_theme->post_slider_position;

	// Get current filter against slider position
	if ( 'before_site_header' == $position && 'athen_hook_site_header_before' == $filter ) {
		$get = true;
	} elseif ( 'after_site_header' == $position && 'athen_hook_site_header_after' == $filter ) {
		$get = true;
	} elseif ( 'before_top_header' == $position && 'athen_hook_top_header_before' == $filter ) {
		$get = true;
	} elseif ( 'after_top_header' == $position && 'athen_hook_top_header_after' == $filter ) {
		$get = true;
	} elseif ( 'before_main_header' == $position && 'athen_hook_main_header_before' == $filter ) {
		$get = true;
	} elseif ( 'after_main_header' == $position && 'athen_hook_main_header_after' == $filter ) {
		$get = true;
	} elseif ( 'below_title' == $position && 'athen_hook_main_top' == $filter ) {
		$get = true;
	}

	// Return if $get is still false after checking filters
	if ( ! $get ) {
		return;
	}

	// Get post id
	$post_id = $post_id ? $post_id : $athen_std_theme->post_id;
	
	// Get the Slider shortcode
	$slider = Athen_Post_Slider::athen_post_slider_shortcode( $post_id );

	// Disable on Mobile?
	$disable_on_mobile = get_post_meta( $post_id, 'athen_disable_post_slider_mobile', true );

	// Get slider alternative
	$slider_alt = get_post_meta( $post_id, 'athen_post_slider_mobile_alt', true );

	// Check if alider alternative for mobile custom field has a value
	if ( 'on' == $disable_on_mobile && $slider_alt ) {

		// Sanitize slider mobile alt
		if ( is_numeric( $slider_alt ) ) {
			$slider_alt = wp_get_attachment_image_src( $slider_alt, 'full' );
			$slider_alt = $slider_alt[0];
		}

		// Cleanup validation for old Redux system
		if ( is_array( $slider_alt ) && ! empty( $slider_alt['url'] ) ) {
			$slider_alt = $slider_alt['url'];
		}

		// Mobile slider alternative link
		$slider_alt_url = get_post_meta( $post_id, 'athen_post_slider_mobile_alt_url', true );

		// Mobile slider alternative link target
		if ( $slider_alt_target = get_post_meta( $post_id, 'athen_post_slider_mobile_alt_url_target', true ) ) {
			$slider_alt_target = 'target="_'. $slider_alt_target .'"';
		}
	}

	// Otherwise set all vars to empty
	else {
		$slider_alt = $slider_alt_url = $slider_alt_target = NULL;;
	} ?>

		<div class="page-slider clr">

			<?php
			// Mobile slider
			if ( $slider_alt ) : ?>

				<div class="page-slider-mobile hidden-desktop clr">
				
					<?php if ( $slider_alt_url ) : ?>

						<a href="<?php echo esc_url( $slider_alt_url ); ?>" title=""<?php echo $slider_alt_target; ?>>
							<img src="<?php echo $slider_alt; ?>" class="page-slider-mobile-alt" alt="<?php echo the_title(); ?>" />
						</a>

					<?php else : ?>

						<img src="<?php echo $slider_alt; ?>" class="page-slider-mobile-alt" alt="<?php echo the_title(); ?>" />

					<?php endif; ?>

				</div><!-- .page-slider-mobile -->

			<?php endif; ?>

			<?php
			// Disable slider on mobile
			if ( 'on' == $disable_on_mobile ) { ?>
				<div class="visible-desktop clr">
			<?php } ?>

				<?php echo do_shortcode( $slider ); ?>

			<?php if ( 'on' == $disable_on_mobile ) echo '</div>'; ?>

		</div><!-- .page-slider -->

		<?php if ( $margin = get_post_meta( $post_id, 'athen_post_slider_bottom_margin', true ) ) : ?>

			<div style="height:<?php echo intval( $margin ); ?>px;"></div>

		<?php endif; ?>
		
<?php
}
