<?php
/**
 * Registers the image slider shortcode and adds it to the Visual Composer
 *
 * @package     Total
 * @subpackage  Framework/Visual Composer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.4.1
 * @version     2.0.0
 */

/**
 * Register shortcode with VC Composer
 *
 * @since 2.0.0
 */
class WPBakeryShortCode_vcex_image_flexslider extends WPBakeryShortCode {
    protected function content( $atts, $content = null ) {
        ob_start();
        include( locate_template( 'vcex_templates/vcex_image_flexslider.php' ) );
        return ob_get_clean();
    }
}

/**
 * Adds the shortcode to the Visual Composer
 *
 * @since Total 1.4.1
 */
if ( ! function_exists( 'vcex_image_flexslider_shortcode_vc_map' ) ) {
    function vcex_image_flexslider_shortcode_vc_map() {
        vc_map( array(
            'name'                  => __( 'Image Slider', 'athen_transl' ),
            'description'           => __( 'Custom image slider', 'athen_transl' ),
            'base'                  => 'vcex_image_flexslider',
            'category'              => ATHEN_NAME_THEME,
            'icon'                  => 'vcex-image-flexslider',
            'params'                => array(

                // Images
                array(
                    'type'          => 'attach_images',
                    'admin_label'   => true,
                    'heading'       => __( 'Attach Images', 'athen_transl' ),
                    'param_name'    => 'image_ids',
                    'description'   => __( 'You can display captions by giving your images a caption and you can also display videos by adding an image that has a Video URL defined for it.', 'athen_transl' ),
                    'group'         => __( 'Images', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Post Gallery', 'athen_transl' ),
                    'param_name'    => 'post_gallery',
                    'group'         => __( 'Images', 'athen_transl' ),
                    'description'   => __( 'Enable to display images from the current post "Image Gallery".', 'athen_transl' ),
                    'value'         => array(
                        __( 'No', 'athen_transl' )     => '',
                        __( 'Yes', 'athen_transl' )  => 'true',
                    ),
                ),

                // General
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Unique Id', 'athen_transl' ),
                    'description'   => __( 'Give your main element a unique ID.', 'athen_transl' ),
                    'param_name'    => 'unique_id',
                    'group'         => __( 'General', 'athen_transl' ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Custom Classes', 'athen_transl' ),
                    'description'   => __( 'Add additonal classes to the main element.', 'athen_transl' ),
                    'param_name'    => 'classes',
                    'group'         => __( 'General', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Visibility', 'athen_transl' ),
                    'param_name'    => 'visibility',
                    'value'         => vcex_visibility(),
                    'group'         => __( 'General', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Randomize', 'athen_transl' ),
                    'param_name'    => 'randomize',
                    'value'         => array(
                        __( 'No', 'athen_transl' )  => '',
                        __( 'Yes', 'athen_transl' ) => 'true',
                    ),
                    'description'   => __( 'Randomize image order display on page load?', 'athen_transl' ),
                    'group'         => __( 'General', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Animation', 'athen_transl' ),
                    'param_name'    => 'animation',
                    'value'         => array(
                        __( 'Slide', 'athen_transl' )   => 'slide',
                        __( 'Fade', 'athen_transl' )    => 'fade_slides',
                    ),
                    'group'         => __( 'General', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Loop', 'athen_transl' ),
                    'param_name'    => 'loop',
                    'value'         => array(
                        __( 'No', 'athen_transl' )   => '',
                        __( 'Yes', 'athen_transl' )    => 'true',
                    ),
                    'group'         => __( 'General', 'athen_transl' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Auto Height Animation', 'athen_transl' ),
                    'std'               => '500',
                    'param_name'        => 'height_animation',
                    'group'             => __( 'General', 'athen_transl' ),
                    'description'       => __( 'You can enter "0.0" to disable the animation completely.', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Animation Speed', 'athen_transl' ),
                    'param_name'        => 'animation_speed',
                    'std'               => '600',
                    'description'       => __( 'Enter a value in milliseconds.', 'athen_transl' ),
                    'group'             => __( 'General', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Auto Play', 'athen_transl' ),
                    'param_name'        => 'slideshow',
                    'value'             => array(
                        __( 'Yes', 'athen_transl' ) => 'true',
                        __( 'No', 'athen_transl' )  => 'false',
                    ),
                    'description'       => __( 'Enable automatic slideshow? Disabled in front-end composer to prevent page "jumping".', 'athen_transl' ),
                    'group'             => __( 'General', 'athen_transl' ),
                     'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Auto Play Delay', 'athen_transl' ),
                    'param_name'        => 'slideshow_speed',
                    'std'               => '5000',
                    'description'       => __( 'Enter a value in milliseconds.', 'athen_transl' ),
                    'group'             => __( 'General', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Arrows', 'athen_transl' ),
                    'param_name'        => 'direction_nav',
                    'value'             => array(
                        __( 'Yes', 'athen_transl' ) => '',
                        __( 'No', 'athen_transl' )  => 'false',
                    ),
                    'group'             => __( 'General', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Arrows on Hover', 'athen_transl' ),
                    'param_name'        => 'direction_nav_hover',
                    'value'             => array(
                        __( 'Yes', 'athen_transl' ) => '',
                        __( 'No', 'athen_transl' )  => 'false',
                    ),
                    'group'             => __( 'General', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Dot Navigation', 'athen_transl' ),
                    'param_name'        => 'control_nav',
                    'value'             => array(
                        __( 'Yes', 'athen_transl' ) => '',
                        __( 'No', 'athen_transl' )  => 'false',
                    ),
                    'group'             => __( 'General', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Thumbnails', 'athen_transl' ),
                    'param_name'        => 'control_thumbs',
                    'value'             => array(
                        __( 'Yes', 'athen_transl' ) => 'true',
                        __( 'No', 'athen_transl' )  => 'false',
                    ),
                    'group'             => __( 'General', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Thumbnails Pointer', 'athen_transl' ),
                    'param_name'        => 'control_thumbs_pointer',
                    'value'             => array(
                        __( 'No', 'athen_transl' )  => '',
                        __( 'Yes', 'athen_transl' ) => 'true',
                    ),
                    'group'             => __( 'General', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Navigation Thumbnails Height', 'athen_transl' ),
                    'param_name'        => 'control_thumbs_height',
                    'std'               => '70',
                    'dependency'        => Array(
                        'element'   => 'control_thumbs',
                        'value'     => array( 'true' )
                    ),
                    'group'             => __( 'General', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Navigation Thumbnails Width', 'athen_transl' ),
                    'param_name'        => 'control_thumbs_width',
                    'std'               => '70',
                    'dependency'        => Array(
                        'element'   => 'control_thumbs',
                        'value'     => array( 'true' )
                    ),
                    'group'             => __( 'General', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),


                // Image
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Image Size', 'athen_transl' ),
                    'param_name'    => 'img_size',
                    'std'           => 'athen_custom',
                    'value'         => vcex_image_sizes(),
                    'group'         => __( 'Image', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Image Crop Location', 'athen_transl' ),
                    'param_name'    => 'img_crop',
                    'std'           => 'center-center',
                    'value'         => vcex_image_crop_locations(),
                    'dependency'    => array(
                        'element'   => 'img_size',
                        'value'     => 'athen_custom',
                    ),
                    'group'         => __( 'Image', 'athen_transl' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Image Crop Width', 'athen_transl' ),
                    'param_name'        => 'img_width',
                    'dependency'        => array(
                        'element'   => 'img_size',
                        'value'     => 'athen_custom',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'description'       => __( 'Enter a width in pixels.', 'athen_transl' ),
                    'group'             => __( 'Image', 'athen_transl' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Image Crop Height', 'athen_transl' ),
                    'param_name'        => 'img_height',
                    'description'       => __( 'Enter a height in pixels. Leave empty to disable vertical cropping and keep image proportions.', 'athen_transl' ),
                    'dependency'    => array(
                        'element'   => 'img_size',
                        'value'     => 'athen_custom',
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'group'             => __( 'Image', 'athen_transl' )
                ),

                // Caption
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Display Caption', 'athen_transl' ),
                    'param_name'    => 'caption',
                    'value'         => array(
                        __( 'Yes', 'athen_transl' ) => 'true',
                        __( 'No', 'athen_transl' )  => 'false',
                    ),
                    'group'         => __( 'Caption', 'athen_transl' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Caption Based On Image', 'athen_transl' ),
                    'param_name'        => 'caption_type',
                    'value'             => array(
                        __( 'Title', 'athen_transl' )       => 'title',
                        __( 'Caption', 'athen_transl' )     => 'caption',
                        __( 'Description', 'athen_transl' ) => 'description',
                        __( 'Alt', 'athen_transl' )         => 'alt',
                    ),
                    'dependency'    => Array(
                        'element'   => 'caption',
                        'value'     => array( 'true' )
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                    'group'             => __( 'Caption', 'athen_transl' ),
                ),
                array(
                    'type'              => 'dropdown',
                    'heading'           => __( 'Caption Visibility', 'athen_transl' ),
                    'param_name'        => 'caption_visibility',
                    'value'             => vcex_visibility(),
                    'dependency'    => Array(
                        'element'   => 'caption',
                        'value'     => array( 'true' )
                    ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                    'group'             => __( 'Caption', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Caption Style', 'athen_transl' ),
                    'param_name'    => 'caption_style',
                    'value'         => array(
                        __( 'Black', 'athen_transl' )   => 'black',
                        __( 'White', 'athen_transl' )   => 'white',
                    ),
                    'dependency'    => Array(
                        'element'   => 'caption',
                        'value'     => array( 'true' )
                    ),
                    'group'         => __( 'Caption', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Rounded Caption', 'athen_transl' ),
                    'param_name'    => 'caption_rounded',
                    'value'         => array(
                        __( 'No', 'athen_transl' )  => '',
                        __( 'Yes', 'athen_transl' ) => 'true',
                    ),
                    'dependency'    => Array(
                        'element'   => 'caption',
                        'value'     => array( 'true' )
                    ),
                    'group'         => __( 'Caption', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Caption Position', 'athen_transl' ),
                    'param_name'    => 'caption_position',
                    'std'           => 'up',
                    'value'         => array(
                        __( 'Bottom Center', 'athen_transl' )   => 'bottomCenter',
                        __( 'Bottom Left', 'athen_transl' )     => 'bottomLeft',
                        __( 'Bottom Right', 'athen_transl' )    => 'bottomRight',
                        __( 'Top Center', 'athen_transl' )      => 'topCenter',
                        __( 'Top Left', 'athen_transl' )        => 'topLeft',
                        __( 'Top Right', 'athen_transl' )       => 'topRight',
                        __( 'Center Center', 'athen_transl' )   => 'centerCenter',
                        __( 'Center Left', 'athen_transl' )     => 'centerLeft',
                        __( 'Center Right', 'athen_transl' )    => 'centerRight',
                    ),
                    'dependency'    => Array(
                        'element'   => 'caption',
                        'value'     => array( 'true' )
                    ),
                    'group'         => __( 'Caption', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Caption Show Transition', 'athen_transl' ),
                    'param_name'    => 'caption_show_transition',
                    'std'           => 'up',
                    'value'         => array(
                        __( 'None', 'athen_transl' )    => 'false',
                        __( 'Up', 'athen_transl' )      => 'up',
                        __( 'Down', 'athen_transl' )    => 'down',
                        __( 'Left', 'athen_transl' )    => 'left',
                        __( 'Right', 'athen_transl' )   => 'right',
                    ),
                    'dependency'    => Array(
                        'element'   => 'caption',
                        'value'     => array( 'true' )
                    ),
                    'group'         => __( 'Caption', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column clear',
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Caption Hide Transition', 'athen_transl' ),
                    'param_name'    => 'caption_hide_transition',
                    'std'           => 'down',
                    'value'         => array(
                        __( 'None', 'athen_transl' )    => 'false',
                        __( 'Up', 'athen_transl' )      => 'up',
                        __( 'Down', 'athen_transl' )    => 'down',
                        __( 'Left', 'athen_transl' )    => 'left',
                        __( 'Right', 'athen_transl' )   => 'right',
                    ),
                    'dependency'    => Array(
                        'element'   => 'caption',
                        'value'     => array( 'true' )
                    ),
                    'group'         => __( 'Caption', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-6 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Caption Width', 'athen_transl' ),
                    'param_name'        => 'caption_width',
                    'dependency'        => Array(
                        'element'   => 'caption',
                        'value'     => array( 'true' )
                    ),
                    'value'             => '100%',
                    'description'       => __( 'Enter a pixel or percentage value. You can also enter "auto" for content dependent width.', 'athen_transl' ),
                    'group'             => __( 'Caption', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Caption Font-Size', 'athen_transl' ),
                    'param_name'        => 'caption_font_size',
                    'dependency'        => Array(
                        'element'   => 'caption',
                        'value'     => array( 'true' )
                    ),
                    'description'       => __( 'You can use em or px values, but you must define them.', 'athen_transl' ),
                    'group'             => __( 'Caption', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Caption Padding', 'athen_transl' ),
                    'param_name'        => 'caption_padding',
                    'dependency'        => Array(
                        'element'   => 'caption',
                        'value'     => array( 'true' )
                    ),
                    'description'       => __( 'Please use the following format: top right bottom left.', 'athen_transl' ),
                    'group'             => __( 'Caption', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Caption Horizontal Offset', 'athen_transl' ),
                    'param_name'    => 'caption_horizontal',
                    'dependency'    => Array(
                        'element'   => 'caption',
                        'value'     => array( 'true' )
                    ),
                    'group'         => __( 'Caption', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column clear',
                    'description'       => __( 'Please enter a px value.', 'athen_transl' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Caption Vertical Offset', 'athen_transl' ),
                    'param_name'        => 'caption_vertical',
                    'dependency'        => Array(
                        'element'   => 'caption',
                        'value'     => array( 'true' )
                    ),
                    'group'             => __( 'Caption', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                    'description'       => __( 'Please enter a px value.', 'athen_transl' ),
                ),
                array(
                    'type'              => 'textfield',
                    'heading'           => __( 'Caption Delay', 'athen_transl' ),
                    'param_name'        => 'caption_delay',
                    'std'               => '500',
                    'dependency'    => Array(
                        'element'   => 'caption',
                        'value'     => array( 'true' )
                    ),
                    'group'         => __( 'Caption', 'athen_transl' ),
                    'edit_field_class'  => 'vc_col-sm-4 vc_column',
                    'description'       => __( 'Enter a value in milliseconds.', 'athen_transl' ),
                ),

                // Links
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Image Link', 'athen_transl' ),
                    'param_name'    => 'thumbnail_link',
                    'value'         => array(
                        __( 'None', 'athen_transl' )            => '',
                        __( 'Lightbox', 'athen_transl' )        => 'lightbox',
                        __( 'Custom Links', 'athen_transl' )    => 'custom_link',
                    ),
                    'group'         => __( 'Links', 'athen_transl' ),
                ),
                array(
                    'type'          => 'exploded_textarea',
                    'heading'       => __('Custom links', 'athen_transl' ),
                    'param_name'    => 'custom_links',
                    'description'   => __( 'Enter links for each slide here. Divide links with linebreaks (Enter). For images without a link enter a # symbol.', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'thumbnail_link',
                        'value'     => array( 'custom_link' )
                    ),
                    'group'         => __( 'Links', 'athen_transl' ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __('Custom link target', 'athen_transl' ),
                    'param_name'    => 'custom_links_target',
                    'dependency'    => Array(
                        'element' => 'thumbnail_link',
                        'value' => array('custom_link'
                    ) ),
                    'value'         => array(
                        __( 'Same window', 'athen_transl' ) => '',
                        __( 'New window', 'athen_transl' )  => '_blank'
                    ),
                    'group'         => __( 'Links', 'athen_transl' ),
                ),
                                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Lightbox Skin', 'athen_transl' ),
                    'param_name'    => 'lightbox_skin',
                    'std'           => '',
                    'value'         => vcex_ilightbox_skins(),
                    'group'         => __( 'Links', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'thumbnail_link',
                        'value'     => array( 'lightbox' ),
                    ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Lightbox Thumbnails Placement', 'athen_transl' ),
                    'param_name'    => 'lightbox_path',
                    'value'         => array(
                        __( 'Horizontal', 'athen_transl' )  => '',
                        __( 'Vertical', 'athen_transl' )    => 'vertical',
                    ),
                    'group'         => __( 'Links', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'thumbnail_link',
                        'value'     => array( 'lightbox' ),
                    ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Lightbox Title', 'athen_transl' ),
                    'param_name'    => 'lightbox_title',
                    'value'         => array(
                        __( 'None', 'athen_transl' )    => '',
                        __( 'Alt', 'athen_transl' )     => 'alt',
                        __( 'Title', 'athen_transl' )   => 'title',
                    ),
                    'group'         => __( 'Links', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'thumbnail_link',
                        'value'     => array( 'lightbox' ),
                    ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Lightbox Caption', 'athen_transl' ),
                    'param_name'    => 'lightbox_caption',
                    'value'         => array(
                        __( 'Enable', 'athen_transl' )      => '',
                        __( 'Disable', 'athen_transl' )     => 'false',
                    ),
                    'group'         => __( 'Links', 'athen_transl' ),
                    'dependency'    => Array(
                        'element'   => 'thumbnail_link',
                        'value'     => array( 'lightbox' ),
                    ),
                ),

                // Design options
                array(
                    'type'          => 'css_editor',
                    'heading'       => __( 'CSS', 'athen_transl' ),
                    'param_name'    => 'css',
                    'description'   => __( 'If any of these are defined it will add a new wrapper around your icon box with the custom CSS applied to it.', 'athen_transl' ),
                    'group'         => __( 'Design', 'athen_transl' ),
                ),

            )
            
        ) );
    }
}
add_action( 'vc_before_init', 'vcex_image_flexslider_shortcode_vc_map' );