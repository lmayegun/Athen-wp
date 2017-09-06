<?php
/**
 * Adds new fields for the media items
 *
 * @package		Total
 * @subpackage          Framework
 * @author		Alexander Clarke
 * @copyright           Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		1.0.0
 * @version		1.0.0
 */

/**
 * Adds new custom fields to image media
 *
 * @since Total 1.5.3
 */
if ( ! function_exists( 'athen_custom_attachment_fields' ) ) {
	function athen_custom_attachment_fields( $form_fields, $post ) {
		$form_fields['athen_video_url'] = array(
			'label'	=> __( 'Video URL', 'athen_transl' ),
			'input'	=> 'text',
			'value'	=> get_post_meta( $post->ID, '_video_url', true ),
		);
	 
	   return $form_fields;
	}
}
add_filter( 'attachment_fields_to_edit', 'athen_custom_attachment_fields', null, 2 );

/**
 * Save new attachment fields
 *
 * @since Total 1.5.3
 */
if ( ! function_exists( 'athen_custom_attachment_fields_to_save' ) ) {
	function athen_custom_attachment_fields_to_save( $post, $attachment ) {
		if ( isset( $attachment['athen_video_url'] ) ) {
			update_post_meta( $post['ID'], '_video_url', $attachment['athen_video_url'] );
		}
		return $post;
	}
}
add_filter( 'attachment_fields_to_save', 'athen_custom_attachment_fields_to_save', null , 2 );