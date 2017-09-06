<?php
/**
 * Custom functions for use with Visual Composer Modules
 *
 * @package     Total
 * @subpackage  Visual Composer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.4.0
 * @version     2.1.2
 */

/**
 * Fallback to prevent JS error
 *
 * @since 2.0.0
 */
if ( ! function_exists( 'vc_icon_element_fonts_enqueue' ) ) {
	function vc_icon_element_fonts_enqueue() {
	   return;
	}
}

/**
 * Array of Google Font options
 *
 * @since 2.1.0
 */
function vcex_fonts_array() {
	$array = array(
		__( 'Default', 'athen_transl' ) => '',
	);
	$std_fonts    = athen_standard_fonts();
	$array        = array_merge( $array, $std_fonts );
	$google_fonts = athen_google_fonts_array();
	$array        = array_merge( $array, $google_fonts );
	$array        = apply_filters( 'vcex_google_fonts_array', $array );
	return $array;
}

/**
 * Parses lightbox dimensions
 *
 * @since 2.1.2
 */
function vcex_parse_lightbox_dims( $dims ) {

	// Return default if undefined
	if ( ! $dims ) {
		return 'width:1920,height:1080';
	}

	// Parse data
	$dims = explode( 'x', $dims );
    $w    = isset( $dims[0] ) ? $dims[0] : '1920';
    $h    = isset( $dims[1] ) ? $dims[1] : '1080';

    // Return dimensions
    return 'width:'. $w .',height:'. $h .'';
	
}

/**
 * Parses the font_control / typography param
 *
 * @since 2.0.0
 */
function vcex_parse_typography_param( $value ) {

	// Conter value to array
	$value = vc_parse_multi_attribute( $value );
	
	// Define defaults
	$defaults = array(
		'tag'               => '',
		'text_align'        => '',
		'font_size'         => '',
		'line_height'       => '',
		'color'             => '',
		'font_style_italic' => '',
		'font_style_bold'   => '',
		'font_family'       => '',
		'letter_spacing'    => '',
		'font_family'       => '',
	);

	// Parse values so keys exist
	$values = wp_parse_args( $value, $defaults );

	// Return values
	return $values;

}

/**
 * Return grid filter arguments
 *
 * @since Total 2.0.2
 */
function vcex_grid_filter_args( $atts = '' ) {

	// Return if no attributes found
	if ( ! $atts ) {
		return;
	}

	// Define args
	$args = array();

	// Define post type and taxonomy
	$post_type  = ! empty( $atts['post_type'] ) ? $atts['post_type'] : '';
	$post_type  = ( 'post' == $post_type ) ? 'blog' : $post_type;
	$taxonomy   = ! empty( $atts['filter_taxonomy'] ) ? $atts['filter_taxonomy'] : $post_type.'_category';

	// Define include/exclude category vars
	$include = ! empty( $atts['include_categories'] ) ? $atts['include_categories'] : array();
	$exclude = ! empty( $atts['exclude_categories'] ) ? $atts['exclude_categories'] : array();

	// Sanitize data
	$include = vcex_string_to_array( $include );
	$exclude = vcex_string_to_array( $exclude );

	// Check if only 1 category is included
	// If so check if it's a parent item so we can display children as the filter links
	if ( '1' == count( $include ) && $children = get_term_children( $include[0], $taxonomy ) ) {
		$include = $children;
	}

	// Add to args
	if ( ! empty( $include ) ) {
		$args['include'] = $include;
	}
	if ( ! empty( $exclude ) ) {
		$args['exclude'] = $exclude;
	}

	// Apply filters
	if ( $post_type ) {
		$args = apply_filters( 'vcex_'. $post_type .'_grid_filter_args', $args );
	}

	// Return args
	return $args;

}

/**
 * Convert to array
 *
 * @since Total 2.0.2
 */
function vcex_string_to_array( $value = array() ) {
	
	// Return wpex function if it exists  
	if ( function_exists( 'athen_string_to_array' ) ) {
		return athen_string_to_array( $value );
	}

	// Create our own return
	else {

		// Return null for empty array
		if ( empty( $value ) && is_array( $value ) ) {
			return null;
		}

		// Return if already array
		if ( ! empty( $value ) && is_array( $value ) ) {
			return $value;
		}

		// Clean up value
		$items  = preg_split( '/\,[\s]*/', $value );

		// Create array
		foreach ( $items as $item ) {
			if ( strlen( $item ) > 0 ) {
				$array[] = $item;
			}
		}

		// Return array
		return $array;

	}

}


/**
 * Generates various types of HTML based on a value
 *
 * @since 2.0.0
 */
function vcex_parse_old_design_js() {
	return ATHEN_VCEX_DIR_URI . 'assets/parse-old-design.js';
}

/**
 * Generates various types of HTML based on a value
 *
 * @since 2.0.0
 */
function vcex_html( $type, $value, $trim = false ) {

	// Return nothing by default
	$return = '';

	// Return if value is empty
	if ( ! $value ) {
		return;
	}

	// Title attribute
	if ( 'id_attr' == $type ) {
		$value  = trim ( str_replace( '#', '', $value ) );
		$value  = str_replace( ' ', '', $value );
		if ( $value ) {
			$return = ' id="'. esc_attr( $value ) .'"';
		}
	}

	// Title attribute
	if ( 'title_attr' == $type ) {
		$return = ' title="'. esc_attr( $value ) .'"';
	}

	// Link Target
	elseif ( 'target_attr' == $type ) {
		if ( 'blank' == $value || strpos( $value, 'blank' ) ) {
			$return = ' target="_blank"';
		}
	}

	// Link rel
	elseif ( 'rel_attr' == $type ) {
		if ( 'nofollow' == $value ) {
			$return = ' rel="nofollow"';
		}
	}

	// Return HTMl
	if ( $trim ) {
		return trim( $return );
	} else {
		return $return;
	}

}

/**
 * Returns array of image sizes for use in the Customizer
 *
 * @since 2.0.0
 */
function vcex_image_sizes() {
	$sizes = array(
		__( 'Custom Size', 'athen_transl' ) => 'athen_custom',
	);
	$get_sizes      = get_intermediate_image_sizes();
	array_unshift( $get_sizes, 'full' );
	$get_sizes      = array_combine( $get_sizes, $get_sizes );
	$sizes          = array_merge( $sizes, $get_sizes );
	return $sizes;
}

/**
 * Image Crop Locations
 *
 * @since 2.0.0
 */
function vcex_image_crop_locations() {
	$locations = athen_image_crop_locations();
	return array_flip( $locations );
}

/**
 * Typography Styles
 *
 * @since 2.0.0
 */
function vcex_typography_styles() {
	$styles = athen_typography_styles();
	return array_flip( $styles );
}


/**
 * Notice when no posts are found
 *
 * @since 2.0.0
 */
function vcex_no_posts_found_message( $atts ) {

	// Define post type
	$post_type = ( isset( $atts['post_types' ] ) ) ? $atts['post_types' ] : '';
	$post_type = ( isset( $atts['post_type' ] ) ) ? $atts['post_type' ] : '';

	// Return if not Visual Composer
	if ( ! athen_is_front_end_composer() || ( ! athen_is_front_end_composer() && 'tribe_events' != $post_type ) ) {
		return;
	}

	// Return message on front-end
	if ( ! empty( $atts['post_types'] ) && 'tribe_events' == $post_type ) {
		return '<div class="vcex-no-posts-found">'. __( 'No ongoing events found.', 'athen_transl' ) .'</div>';
	} else {
		return '<div class="vcex-no-posts-found">'. __( 'No posts found for your query.', 'athen_transl' ) .'</div>';
	}


}

/**
 * Sanitize data
 *
 * @since 2.0.0
 */
function vcex_sanitize_data( $data = NULL, $type = NULL ) {
	if ( function_exists( 'athen_sanitize_data' ) ) {
		return athen_sanitize_data( $data, $type );
	} else {
		return $data;
	}
}

/**
 * Get Extra class
 *
 * @since Total 2.0.2
 */
function vcex_get_extra_class( $classes ) {
	if ( $classes ) {
		return str_replace( '.', '', $classes );
	}
}

/**
 * Echos unique ID html for VC modules
 *
 * @since 2.0.0
 */
function vcex_unique_id( $id ) {
	if ( ! $id ) {
		return;
	}
	echo vcex_html( 'id_attr', $id );
}

/**
 * Returns dummy image
 *
 * @since 2.0.0
 */
function vcex_dummy_image_url() {
	return get_template_directory_uri() .'/images/dummy-image.jpg';
}

/**
 * Outputs dummy image
 *
 * @since 2.0.0
 */
function vcex_dummy_image() {
	echo '<img src="'. get_template_directory_uri() .'/images/dummy-image.jpg" />';
}

/**
 * Used to enqueue styles for Visual Composer modules
 *
 * @since   2.0.0
 * @return  array
 */
function vcex_enque_style( $type, $value = '' ) {

	// iLightbox
	if ( 'ilightbox' == $type ) {
		athen_enqueue_ilightbox_skin( $value );
	}

	// Hover animation
	elseif ( 'hover-animations' == $type ) {
		wp_enqueue_style( 'wpex-hover-animations' );
	}

}

/**
 * Returns array of available hover animations
 *
 * @since   2.0.0
 * @return  array
 */
function vcex_hover_animations() {
	$animations = athen_hover_css_animations( 'array_flip' );
	return array_flip( $animations );
}

/**
 * Returns array of CSS animations
 *
 * @since 2.0.0
 */
function vcex_css_animations() {
	$animations = athen_css_animations();
	return array_flip( $animations );
}

/**
 * Array of Icon box styles
 *
 * @since   2.0.0
 * @return  array
 */
function vcex_icon_box_styles() {

	// Define array
	$array  = array(
		'one'   => __( 'Left Icon', 'athen_transl' ),
		'seven' => __( 'Right Icon', 'athen_transl' ),
		'two'   => __( 'Top Icon', 'athen_transl' ),
		'three' => __( 'Top Icon Style 2 - legacy', 'athen_transl' ),
		'four'  => __( 'Outlined & Top Icon - legacy', 'athen_transl' ),
		'five'  => __( 'Boxed & Top Icon - legacy', 'athen_transl' ),
		'six'   => __( 'Boxed & Top Icon Style 2 - legacy', 'athen_transl' ),
	);

	// Apply filters
	$array = apply_filters( 'vcex_icon_box_styles', $array );

	// Flip array around for use with VC
	$array = array_flip( $array ); 

	// Return array
	return $array;

}

/**
 * Array of grid column options
 *
 * @since   2.0.0
 * @return  array
 */
function vcex_grid_columns() {
	$columns = athen_grid_columns();
	return array_flip( $columns );
}

/**
 * Return array of column gaps
 *
 * @since   2.0.0
 * @return  array
 */
function vcex_column_gaps() {
	$gaps = athen_column_gaps();
	return array_flip( $gaps );
}

/**
 * Array of orderby options
 *
 * @since   2.0.0
 * @return  array
 */
function vcex_orderby_array() {
	$orderby = array(
		__( 'Default', 'athen_transl')              => '',
		__( 'Date', 'athen_transl')                 => 'date',
		__( 'Title', 'athen_transl' )               => 'title',
		__( 'Name', 'athen_transl' )                => 'name',
		__( 'Modified', 'athen_transl')             => 'modified',
		__( 'Author', 'athen_transl' )              => 'author',
		__( 'Random', 'athen_transl')               => 'rand',
		__( 'Parent', 'athen_transl')               => 'parent',
		__( 'Type', 'athen_transl')                 => 'type',
		__( 'ID', 'athen_transl' )                  => 'ID',
		__( 'Comment Count', 'athen_transl' )       => 'comment_count',
		__( 'Menu Order', 'athen_transl' )          => 'menu_order',
		__( 'Meta Key Value', 'athen_transl' )      => 'meta_value',
		__( 'Meta Key Value Num', 'athen_transl' )  => 'meta_value_num',
	);
	return apply_filters( 'vcex_orderby', $orderby );
}

/**
 * Array of order options
 *
 * @since   2.0.0
 * @return  array
 */
function vcex_order_array() {
	return array(
		__( 'Default', 'athen_transl' ) => '',
		__( 'DESC', 'athen_transl' )    => 'DESC',
		__( 'ASC', 'athen_transl' )     => 'ASC',
	);
}

/**
 * Array of ilightbox skins
 *
 * @since   2.0.0
 * @return  array
 */
function vcex_ilightbox_skins() {
	$skins = array(
		''  => __( 'Default', 'athen_transl' ),
	);
	$skins = array_merge( $skins, athen_ilightbox_skins() );
	$skins = array_flip( $skins );
	return $skins;
}

/**
 * Array of font weights
 *
 * @since   2.0.0
 * @return  array
 */
function vcex_font_weights() {
	$weights = athen_font_weights();
	return array_flip( $weights );
}

/**
 * Array of text transforms
 *
 * @since   2.0.0
 * @return  array
 */
function vcex_text_transforms() {
	$transforms = athen_text_transforms();
	return array_flip( $transforms );
}

/**
 * Array of alignments
 *
 * @since   2.0.0
 * @return  array
 */
function vcex_alignments() {
	$alignments = athen_alignments();
	return array_flip( $alignments );
}

/**
 * Array of border styles
 *
 * @since   2.0.0
 * @return  array
 */
function vcex_border_styles() {
	$borders = athen_border_styles();
	return array_flip( $borders );
}

/**
 * Visibility
 *
 * @since   2.0.0
 * @return  array
 */
function vcex_visibility() {
	$visibility = athen_visibility();
	return array_flip( $visibility );
}

/**
 * Image filter styles VC extensions
 *
 * @since Total 1.4.0
 */
function vcex_image_filters() {
	$filters = array (
		__( 'None', 'athen_transl' )        => '',
		__( 'Grayscale', 'athen_transl' )   => 'grayscale',
	);
	return apply_filters( 'vcex_image_filters', $filters );
}

/**
 * Border Radius Options
 *
 * @since Total 1.4.0
 */
function vcex_border_radius() {
	$filters = array (
		__( 'None', 'athen_transl' )            => '',
		__( 'Semi-Rounded', 'athen_transl' )    => 'semi-rounded',
		__( 'Rounded', 'athen_transl' )         => 'rounded',
		__( 'Round', 'athen_transl' )           => 'round',
	);
	return apply_filters( 'vcex_image_filters', $filters );
}

/**
 * Border Radius Classname
 *
 * @since Total 1.4.0
 */
function vcex_get_border_radius_class( $val ) {
	return 'border-radius-'. $val;
}

/**
 * Total Button Styles
 *
 * @since   2.0.0
 * @return  array
 */
function vcex_button_styles() {
	$styles = athen_button_styles();
	return array_flip( $styles );
}

/**
 * Total Button Colors
 *
 * @since   2.0.0
 * @return  array
 */
function vcex_button_colors() {
	$colors = athen_button_colors();
	return array_flip( $colors );
}

/**
 * Image hover styles
 *
 * @since   Total 1.4.0
 * @return  array
 */
function vcex_image_hovers() {
	$hovers = athen_image_hovers();
	return array_flip( $hovers );
}

/**
 * Image rendering
 *
 * @since   Total 1.4.0
 * @return  array
 */
function vcex_image_rendering() {
	$render = array (
		__( 'Auto','athen_transl' )         => '',
		__( 'Crisp Edges','athen_transl' )  => 'crisp-edges',
	);
	return apply_filters( 'vcex_image_rendering', $render );
}

/**
 * Overlay options for the VC
 *
 * @since   Total 1.4.0
 * @return  array
 */
function vcex_overlays_array( $group = '', $style = 'default' ) {
	if ( ! function_exists( 'athen_overlay_styles_array' ) ) {
		return;
	}
	$overlays = athen_overlay_styles_array( $style );
	if ( ! is_array( $overlays ) ) {
		return;
	}
	$overlays   = array_flip( $overlays );
	$group      = ! empty( $group ) ? $group : __( 'Image', 'athen_transl' ); 
	return array(
		'type'          => 'dropdown',
		'heading'       => __( 'Image Overlay Style', 'athen_transl' ),
		'param_name'    => 'overlay_style',
		'value'         => $overlays,
		'group'         => $group,
	);
}

/**
 * Returns an array of overlays
 *
 * @since   Total 1.4.0
 * @return  array
 */
function vcex_image_overlays() {
	$overlays = athen_overlay_styles_array();
	return array_flip( $overlays );
}

/**
 * Returns the athen_excerpt function if it exists otherwise it returns the wordpress excerpt function
 *
 * @since Total 1.4.0
 */
function vcex_get_excerpt( $args ) {
	if ( function_exists( 'athen_excerpt' ) ) {
		return athen_get_excerpt( $args );
	} else {
		return get_the_excerpt();
	}
}

/**
 * Echos the excerpt
 *
 * @since Total 1.4.0
 */
function vcex_excerpt( $args ) {
	if ( function_exists( 'athen_excerpt' ) ) {
		athen_excerpt( $args );
	} else {
		the_excerpt();
	}
}

/**
 * Helper function for building links using link param
 *
 * @since 2.0.0
 */
function vcex_build_link( $link, $fallback = '' ) {

	// If empty return fallback
	if ( empty( $link ) ) {
		return $fallback;
	}

	// Return if there isn't any link
	if ( '||' == $link ) {
		return;
	}

	// Return simple link escaped (fallback for old textfield input)
	if ( false === strpos( $link, 'url:' ) ) {
		return esc_url( $link );
	}

	// Build link
	$link = vc_build_link( $link );

	// Return array of link data
	return $link;

}

/**
 * Returns link data
 *
 * @since 2.0.0
 */
function vcex_get_link_data( $return, $link, $fallback = '' ) {

	// Get data
	$link = vcex_build_link( $link, $fallback );

	if ( 'url' == $return ) {
		if ( is_array( $link ) && ! empty( $link['url'] ) ) {
			return $link['url'];
		} else {
			return $link;
		}
	}

	if ( 'title' == $return ) {
		if ( is_array( $link ) && ! empty( $link['title'] ) ) {
			return $link['title'];
		} else {
			return $fallback;
		}
	}

	if ( 'target' == $return ) {
		if ( is_array( $link ) && ! empty( $link['target'] ) ) {
			return $link['target'];
		} else {
			return $fallback;
		}
	}

}

/**
 * Helper function enqueues icon fonts from Visual Composer
 *
 * @since 2.0.0
 */
function vcex_enqueue_icon_font( $family = '' ) {

	// Return if VC function doesn't exist
	if ( ! function_exists( 'vc_icon_element_fonts_enqueue' ) ) {
		return;
	}

	// Return if icon type is empty or it's fontawesome
	if ( empty( $family ) || 'fontawesome' == $family ) {
		return;
	}

	// Enqueue script
	vc_icon_element_fonts_enqueue( $family );

}

/**
 * Returns correct icon class based on icon type
 *
 * @since 2.0.0
 */
function vcex_get_icon_class( $atts, $icon ) {

	// Return if attributes or icon type
	if ( empty( $atts ) ) {
		return;
	}

	// Define icon type
	$icon_type = ! empty( $atts['icon_type'] ) ? $atts['icon_type'] : 'fontawesome';

	// Generate fontawesome icon class
	if ( 'fontawesome' == $icon_type && ! empty( $atts[$icon] ) ) {
		$icon   = $atts[$icon];
		$icon   = str_replace( 'fa-', '', $icon );
		$icon   = str_replace( 'fa ', '', $icon );
		$icon   = 'fa fa-'. $icon;
	} elseif ( ! empty( $atts[ $icon .'_'. $icon_type ] ) ) {
		$icon   = $atts[ $icon .'_'. $icon_type ];
	}

	// Return if icon is set to "none" or "icon"
	if ( in_array( $icon, array( 'icon', 'none' ) ) ) {
		return;
	}

	// Return icon classes
	return $icon;

}

/**
 * Adds inner row margin to compensate for the VC negative margins
 *
 * @since   2.0.0
 * @return  bool
 */
function vcex_add_inner_row_margin( $atts ) {

	// Do not add for full-width
	if ( ! empty( $atts['full_width'] ) ) {
		return;
	}

	// Check old modules for background or border
	if ( ! empty( $atts['center_row'] )
		|| ! empty( $atts['bg_image'] )
		|| ! empty( $atts['bg_color'] )
		|| ! empty( $atts['border_width'] )
	) {
		return true;
	}

	/* Check css parameter for background or border => NOT USED !!!
	if ( ! empty( $atts['css'] ) ) {

		if ( strpos( $atts['css'], 'background' ) ) {
			return true;
		} elseif ( strpos( $atts['css'], 'border' ) ) {
			return true;
		}

	} */

}

/**
 * Enables/Disables vc_row video bg functions
 *
 * @since 2.0.0
 */
function vcex_enable_row_video() {
	return apply_filters( 'vcex_enable_row_video', true );
}

/**
 * Outputs video row background
 *
 * @since 2.0.0
 */
if ( ! function_exists( 'vcex_row_video' ) ) {
	function vcex_row_video( $atts ) {

		// Extract attributes
		extract( $atts );

		// Return if video_bg is empty
		if ( empty( $video_bg ) ) {
			return;
		}

		// Get background image
		$bg_image = ! empty( $bg_image ) ? $bg_image : ''; ?>

		<?php
		// Self hosted
		if ( 'self_hosted' == $video_bg ) { ?>
			<video class="vcex-video-bg" poster="<?php echo wp_get_attachment_url( $bg_image ); ?>" preload="auto" autoplay="true" loop="loop" muted volume="0">
				<?php if ( $video_bg_webm ) { ?>
					<source src="<?php echo $video_bg_webm; ?>" type="video/webm" />
				<?php } ?>
				<?php if ( $video_bg_ogv ) { ?>
					<source src="<?php echo $video_bg_ogv; ?>" type="video/ogg ogv" />
				<?php } ?>
				<?php if ( $video_bg_mp4 ) { ?>
					<source src="<?php echo $video_bg_mp4; ?>" type="video/mp4" />
				<?php } ?>
			</video><!-- .vcex-video-bg -->
		<?php }

		// Embeded
		elseif ( 'youtube' == $video_bg && ! empty( $video_bg_youtube ) ) {

			return; // Not ready yet

			// Sanize embed src
			$video_bg_youtube_parsed  = vcex_sanitize_data( $video_bg_youtube, 'embed_url' );
			$video_bg_youtube         = $video_bg_youtube_parsed ? $video_bg_youtube_parsed : $video_bg_youtube; ?>

			<embed class="vcex-video-bg" src="<?php echo $video_bg_youtube; ?>?loop=1&amp;autoplay=1&amp;controls=0&amp;showinfo=0&amp;autohide=1&amp;sound=0" width="100%" height="100%"></embed>

		<?php }

		// Wrong style return
		else {
			return;
		} ?>

		<?php if ( $video_bg_overlay && 'none' != $video_bg_overlay ) { ?>
			<span class="vcex-video-bg-overlay <?php echo $video_bg_overlay; ?>-overlay"></span>
		<?php } ?>

	<?php
	}
}

/**
 * Enables/Disables vc_row parallax functions
 *
 * @since 2.0.0
 */
function vcex_enable_row_parallax() {
	return apply_filters( 'vcex_enable_row_parallax', true );
}

/**
 * Outputs row parallax background
 *
 * @since 2.0.0
 */
if ( ! function_exists( 'vcex_parallax_bg' ) ) {

	function vcex_parallax_bg( $atts ) {

		// Extract attributes
		extract( $atts );

		// Make sure parallax is enabled and a background image is defined
		if ( ! $parallax || ! $bg_image ) {
			return;
		}

		// Load inline js
		vcex_inline_js( array( 'parallax' ) );

		// Sanitize data
		$parallax_style     = ( ! empty( $parallax_style ) ) ? $parallax_style : 'fixed-no-repeat';
		$parallax_speed     = ( ! empty( $parallax_speed ) ) ? abs( $parallax_speed ) : '0.2';
		$parallax_direction = ( ! empty( $parallax_direction ) ) ? $parallax_direction : 'up';

		// Classes
		$classes = array( 'parallax-bg', 'bg-cover' );
		$classes[] = $parallax_style;
		if ( ! $parallax_mobile ) {
			 $classes[] = 'not-mobile';
		}
		$classes = implode( ' ', $classes );

		// Add style
		$style = 'style="background-image: url('. $bg_image .');"';

		// Attributes
		$attributes = 'data-direction="'. $parallax_direction .'" data-velocity="-'. $parallax_speed .'"'; ?>

		<div class="<?php echo $classes; ?>" <?php echo $style; ?> <?php echo $attributes; ?>></div>

	<?php
	}

}

/**
 * Array of social links profiles to loop through
 *
 * @since 2.0.0
 */
function vcex_social_links_profiles() {

	// Create array of social profiles
	$profiles = array(
		'twitter'       => array(
			'label'         => 'Twitter',
			'icon_class'    => 'fa fa-twitter',
		),
		'facebook'      => array(
			'label'         => 'Facebook',
			'icon_class'    => 'fa fa-facebook',
		),
		'googleplus'    => array(
			'label'         => 'Google Plus',
			'icon_class'    => 'fa fa-google-plus',
		),
		'pinterest'     => array(
			'label'         => 'Pinterest',
			'icon_class'    => 'fa fa-pinterest',
		),
		'dribbble'      => array(
			'label'         => 'Dribbble',
			'icon_class'    => 'fa fa-dribbble',
		),
		'vk'            => array(
			'label'         => 'Vk',
			'icon_class'    => 'fa fa-vk',
		),
		'instagram'     => array(
			'label'         => 'Instragram',
			'icon_class'    => 'fa fa-instagram',
		),
		'linkedin'      => array(
			'label'         => 'LinkedIn',
			'icon_class'    => 'fa fa-linkedin',
		),
		'tumblr'        => array(
			'label'         => 'Tumblr',
			'icon_class'    => 'fa fa-tumblr',
		),
		'github'        => array(
			'label'         => 'Github',
			'icon_class'    => 'fa fa-github-alt',
		),
		'flickr'        => array(
			'label'         => 'Flickr',
			'icon_class'    => 'fa fa-flickr',
		),
		'skype'         => array(
			'label'         => 'Skype',
			'icon_class'    => 'fa fa-skype',
		),
		'youtube'       => array(
			'label'         => 'Youtube',
			'icon_class'    => 'fa fa-youtube',
		),
		'vimeo'         => array(
			'label'         => 'Vimeo',
			'icon_class'    => 'fa fa-vimeo-square',
		),
		'vine'          => array(
			'label'         => 'Vine',
			'icon_class'    => 'fa fa-vine',
		),
		'xing'          => array(
			'label'         => 'Xing',
			'icon_class'    => 'fa fa-xing',
		),
		'yelp'          => array(
			'label'         => 'Yelp',
			'icon_class'    => 'fa fa-yelp',
		),
		'email'         => array(
			'label'         => __( 'Email', 'athen_transl' ),
			'icon_class'    => 'fa fa-envelope',
		),
		'rss'           => array(
			'label'         => __( 'RSS', 'athen_transl' ),
			'icon_class'    => 'fa fa-rss',
		),
	);

	// Apply filters
	$profiles = apply_filters( 'vcex_social_links_profiles', $profiles );

	// Return profiles array
	return $profiles;

}

/**
 * Array of pixel icons
 *
 * @since 1.4.0
 */
if ( ! function_exists( 'vcex_pixel_icons' ) ) {
	function vcex_pixel_icons() {
		return array(
			array( 'vc_pixel_icon vc_pixel_icon-alert' => __( 'Alert', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-info' => __( 'Info', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-tick' => __( 'Tick', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-explanation' => __( 'Explanation', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-address_book' => __( 'Address book', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-alarm_clock' => __( 'Alarm clock', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-anchor' => __( 'Anchor', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-application_image' => __( 'Application Image', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-arrow' => __( 'Arrow', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-asterisk' => __( 'Asterisk', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-hammer' => __( 'Hammer', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-balloon' => __( 'Balloon', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-balloon_buzz' => __( 'Balloon Buzz', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-balloon_facebook' => __( 'Balloon Facebook', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-balloon_twitter' => __( 'Balloon Twitter', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-battery' => __( 'Battery', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-binocular' => __( 'Binocular', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-document_excel' => __( 'Document Excel', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-document_image' => __( 'Document Image', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-document_music' => __( 'Document Music', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-document_office' => __( 'Document Office', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-document_pdf' => __( 'Document PDF', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-document_powerpoint' => __( 'Document Powerpoint', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-document_word' => __( 'Document Word', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-bookmark' => __( 'Bookmark', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-camcorder' => __( 'Camcorder', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-camera' => __( 'Camera', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-chart' => __( 'Chart', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-chart_pie' => __( 'Chart pie', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-clock' => __( 'Clock', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-fire' => __( 'Fire', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-heart' => __( 'Heart', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-mail' => __( 'Mail', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-play' => __( 'Play', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-shield' => __( 'Shield', 'athen_transl' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-video' => __( 'Video', 'athen_transl' ) ),
		);
	}
}

/**
 * Deprecated functions
 *
 * @since 2.0.0
 */
function vcex_advanced_parallax() {
	_deprecated_function( 'vcex_advanced_parallax', '2.0.2', 'vcex_parallax_bg' );
}
function vcex_front_end_carousel_js() {
	_deprecated_function( 'vcex_front_end_carousel_js', '2.0.0', 'vcex_inline_js' );
}