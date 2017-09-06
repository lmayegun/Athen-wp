<?php
/**
 * Adds custom metaboxes to the WordPress categories
 *
 *
 * @package		Total
 * @subpackage	Framework
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		Total 1.0.0
 * @version		2.0.0
 */
 
// Add extra fields to category edit form callback function
function extra_category_fields( $tag ) {

	// Get term id
	$tag_id		= $tag->term_id;
	$term_meta	= get_option( "category_$tag_id");

	// Category Style
	$style = isset ( $term_meta['athen_term_style'] ) ? $term_meta['athen_term_style'] : '' ; ?>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="athen_term_style"><?php _e( 'Style', 'athen_transl' ); ?></label></th>
	<td>
		<select name="term_meta[athen_term_style]" id="term_meta[term_style]">
			<option value="" <?php selected( $style ); ?>><?php _e( 'Default', 'athen_transl' ); ?></option>
			<option value="large-image" <?php selected( $style, 'large-image' ); ?>><?php _e( 'Large Image', 'athen_transl' ); ?></option>
			<option value="thumbnail" <?php selected( $style, 'thumbnail' ); ?>><?php _e( 'Thumbnail', 'athen_transl' ); ?></option>
			<option value="grid" <?php selected( $style, 'grid' ); ?>><?php _e( 'Grid', 'athen_transl' ); ?></option>
		</select>
	</td>
	</tr>
	
	<?php
	// Grid Columns
	$grid_cols = isset ( $term_meta['athen_term_grid_cols'] ) ? $term_meta['athen_term_grid_cols'] : '' ; ?>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="athen_term_grid_cols"><?php _e( 'Grid Columns', 'athen_transl' ); ?></label></th>
	<td>
		<select name="term_meta[athen_term_grid_cols]" id="term_meta[athen_term_grid_cols]">
			<option value=""  <?php selected( $grid_cols ); ?>><?php _e( 'Default', 'athen_transl' ); ?></option>
			<option value="4" <?php selected( $grid_cols, 4 ) ?>>4</option>
			<option value="3" <?php selected( $grid_cols, 3 ) ?>>3</option>
			<option value="2" <?php selected( $grid_cols, 2 ) ?>>2</option>
			<option value="1" <?php selected( $grid_cols, 1 ) ?>>1</option>
		</select>
	</td>
	</tr>

	<?php
	// Grid Style
	$grid_style = isset ( $term_meta['athen_term_grid_style'] ) ? $term_meta['athen_term_grid_style'] : '' ; ?>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="athen_term_grid_style"><?php _e( 'Grid Style', 'athen_transl' ); ?></label></th>
	<td>
		<select name="term_meta[athen_term_grid_style]" id="term_meta[athen_term_grid_style]">
			<option value="" <?php selected( $grid_style ) ?>><?php _e( 'Default', 'athen_transl' ); ?></option>
			<option value="fit-rows" <?php selected( $grid_style, 'fit-rows' ) ?>><?php _e( 'Fit Rows', 'athen_transl' ); ?></option>
			<option value="masonry" <?php selected( $grid_style, 'masonry' ) ?>><?php _e( 'Masonry', 'athen_transl' ); ?></option>
		</select>
	</td>
	</tr>
	
	<?php
	// Layout Style
	$layout = isset ( $term_meta['athen_term_layout'] ) ? $term_meta['athen_term_layout'] : '' ; ?>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="athen_term_layout"><?php _e( 'Layout', 'athen_transl' ); ?></label></th>
	<td>
		<select name="term_meta[athen_term_layout]" id="term_meta[athen_term_layout]">
			<option value="" <?php selected( $layout ) ?>><?php _e( 'Default', 'athen_transl' ); ?></option>
			<option value="right-sidebar" <?php selected( $layout, 'right-sidebar' ) ?>><?php _e( 'Right Sidebar', 'athen_transl' ); ?></option>
			<option value="left-sidebar" <?php selected( $layout, 'left-sidebar' ) ?>><?php _e( 'Left Sidebar', 'athen_transl' ); ?></option>
			<option value="full-width" <?php selected( $layout, 'full-width' ) ?>><?php _e( 'Full Width', 'athen_transl' ); ?></option>
		</select>
	</td>
	</tr>
	
	<?php
	// Pagination Type
	$pagination = isset ( $term_meta['athen_term_pagination'] ) ? $term_meta['athen_term_pagination'] : ''; ?>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="athen_term_pagination"><?php _e( 'Pagination', 'athen_transl' ); ?></label></th>
	<td>
		<select name="term_meta[athen_term_pagination]" id="term_meta[athen_term_pagination]">
			<option value="" <?php echo ( $pagination == "") ? 'selected="selected"': ''; ?>><?php _e( 'Default', 'athen_transl' ); ?></option>
			<option value="standard" <?php selected( $pagination, 'standard' ) ?>><?php _e( 'Standard', 'athen_transl' ); ?></option>
			<option value="infinite_scroll" <?php selected( $pagination, 'infinite_scroll' ) ?>><?php _e( 'Inifinite Scroll', 'athen_transl' ); ?></option>
			<option value="next_prev" <?php selected( $pagination, 'next_prev' ) ?>><?php _e( 'Next/Previous', 'athen_transl' ); ?></option>
		</select>
	</td>
	</tr>
	
	<?php
	// Excerpt length
	$excerpt_length = isset ( $term_meta['athen_term_excerpt_length'] ) ? $term_meta['athen_term_excerpt_length'] : ''; ?>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="athen_term_excerpt_length"><?php _e( 'Excerpt Length', 'athen_transl' ); ?></label></th>
		<td>
		<input type="text" name="term_meta[athen_term_excerpt_length]" id="term_meta[athen_term_excerpt_length]" size="3" style="width:100px;" value="<?php echo $excerpt_length; ?>">
		</td>
	</tr>
	
	<?php
	// Posts Per Page
	$posts_per_page = isset ( $term_meta['athen_term_posts_per_page'] ) ? $term_meta['athen_term_posts_per_page'] : ''; ?>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="athen_term_posts_per_page"><?php _e( 'Posts Per Page', 'athen_transl' ); ?></label></th>
		<td>
		<input type="text" name="term_meta[athen_term_posts_per_page]" id="term_meta[athen_term_posts_per_page]" size="3" style="width:100px;" value="<?php echo $posts_per_page; ?>">
		</td>
	</tr>
	
	<?php
	// Image Width
	$athen_term_image_width = isset ( $term_meta['athen_term_image_width'] ) ? $term_meta['athen_term_image_width'] : '';?>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="athen_term_image_width"><?php _e( 'Image Width', 'athen_transl' ); ?></label></th>
		<td>
		<input type="text" name="term_meta[athen_term_image_width]" id="term_meta[athen_term_image_width]" size="3" style="width:100px;" value="<?php echo $athen_term_image_width; ?>">
		</td>
	</tr>
		
	<?php
	// Image Height
	$athen_term_image_height = isset ( $term_meta['athen_term_image_height'] ) ? $term_meta['athen_term_image_height'] : ''; ?>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="athen_term_image_height"><?php _e( 'Image Height', 'athen_transl' ); ?></label></th>
		<td>
		<input type="text" name="term_meta[athen_term_image_height]" id="term_meta[athen_term_image_height]" size="3" style="width:100px;" value="<?php echo $athen_term_image_height; ?>">
		</td>
	</tr>
<?php
}
add_action ( 'edit_category_form_fields', 'extra_category_fields' );

// save extra category extra fields callback function
function save_extra_category_fileds( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$tag_id		= $term_id;
		$term_meta	= get_option( "category_$tag_id" );
		$cat_keys	= array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset( $_POST['term_meta'][$key] ) ) {
				$term_meta[$key] = $_POST['term_meta'][$key];
			}
		}
		//save the option array
		update_option( "category_$tag_id", $term_meta );
	}
}
add_action ( 'edited_category', 'save_extra_category_fileds' );