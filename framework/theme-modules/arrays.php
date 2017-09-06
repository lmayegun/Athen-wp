<?php
/**
 * Description : Bunch of functions that return an array type. 
 * 
 * @package     Athen
 * @subpackage  Closer 
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 * Associated : with different functions within frameworks 
 */

/**
 * Returns array of Social Options for the Top Bar
 *
 * @since   1.6.0
 * @return  bool
 */
function athen_topbar_social_options() {
    $social_options = array(
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
            'label'         => 'Instagram',
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

        'rss'           => array(
            'label'         => __( 'RSS', 'athen_transl' ),
            'icon_class'    => 'fa fa-rss',
        ),
        'email'         => array(
            'label'         => __( 'Email', 'athen_transl' ),
            'icon_class'    => 'fa fa-envelope',
        ),
    );
    return apply_filters ( 'athen_topbar_social_options', $social_options );
}

/**
 * Array of social profiles for staff members
 *
 * @since Total 1.5.4
 */
function athen_staff_social_array() {
    $array = array(
        array (
            'key'           => 'twitter',
            'meta'          => 'athen_staff_twitter',
            'icon_class'    => 'fa fa-twitter',
            'label'         => 'Twitter',
        ),
        array (
            'key'           => 'facebook',
            'meta'          => 'athen_staff_facebook',
            'icon_class'    => 'fa fa-facebook',
            'label'         => 'Facebook',
        ),
        array (
            'key'           => 'google-plus',
            'meta'          => 'athen_staff_google-plus',
            'icon_class'    => 'fa fa-google-plus',
            'label'         => 'Google Plus',
        ),
        array (
            'key'           => 'linkedin',
            'meta'          => 'athen_staff_linkedin',
            'icon_class'    => 'fa fa-linkedin',
            'label'         => 'Linkedin',
        ),
        array (
            'key'           => 'dribbble',
            'meta'          => 'athen_staff_dribbble',
            'icon_class'    => 'fa fa-dribbble',
            'label'         => 'Dribbble',
        ),
        array (
            'key'           => 'vk',
            'meta'          => 'athen_staff_vk',
            'icon_class'    => 'fa fa-vk',
            'label'         => 'VK',
        ),
        array (
            'key'           => 'skype',
            'meta'          => 'athen_staff_skype',
            'icon_class'    => 'fa fa-skype',
            'label'         => 'Skype',
        ),
        array (
            'key'           => 'phone_number',
            'meta'          => 'athen_staff_phone_number',
            'icon_class'    => 'fa fa-phone',
            'label'         => __( 'Phone Number', 'athen_transl' ),
        ),
        array (
            'key'           => 'email',
            'meta'          => 'athen_staff_email',
            'icon_class'    => 'fa fa-envelope',
            'label'         => __( 'Email', 'athen_transl' ),
        ),
        array (
            'key'           => 'website',
            'meta'          => 'athen_staff_website',
            'icon_class'    => 'fa fa-external-link-square',
            'label'         => __( 'Website', 'athen_transl' ),
        ),
    );
    return apply_filters( 'athen_staff_social_array', $array );
}

/**
 * Creates an array for adding the staff social options to the metaboxes
 *
 * @since   Total 1.5.4
 * @return  array
 */
function athen_staff_social_meta_array() {
    $profiles = athen_staff_social_array();
    $array = array();
    foreach ( $profiles as $profile ) {
        $array[] = array(
                'title'     => '<span class="'. $profile['icon_class'] .'"></span>' . $profile['label'],
                'id'        => $profile['meta'],
                'type'      => 'text',
                'std'       => '',
        );
    }
    return $array;
}

/**
 * Grid Columns
 *
 * @since   2.0.0
 * @return  array
 */
function athen_grid_columns() {
    $columns = array(
        '1' => __( 'One', 'athen_transl' ),
        '2' => __( 'Two', 'athen_transl' ),
        '3' => __( 'Three', 'athen_transl' ),
        '4' => __( 'Four', 'athen_transl' ),
        '5' => __( 'Five', 'athen_transl' ),
        '6' => __( 'Six', 'athen_transl' ),
        '7' => __( 'Seven', 'athen_transl' ),
    );
    return apply_filters( 'athen_grid_columns', $columns );
}

/**
 * Grid Column Gaps
 *
 * @since   2.0.0
 * @return  array
 */
function athen_column_gaps() {
    $gaps = array(
        ''      => __( 'Default', 'athen_transl' ),
        'none'  => '0px',
        '5'     => '5px',
        '10'    => '10px',
        '15'    => '15px',
        '20'    => '20px',
        '25'    => '25px',
        '30'    => '30px',
        '35'    => '35px',
        '40'    => '40px',
        '50'    => '50px',
        '60'    => '60px',
    );
    return apply_filters( 'athen_column_gaps', $gaps );
}

/**
 * Typography Styles
 *
 * @since   2.0.0
 * @return  array
 */
function athen_typography_styles() {
    $columns = array(
        ''      => __( 'Default', 'athen_transl' ),
        'light' => __( 'Light', 'athen_transl' ),
        'white' => __( 'White', 'athen_transl' ),
        'black' => __( 'Black', 'athen_transl' ),
        'none'  => __( 'None', 'athen_transl' ),
    );
    return apply_filters( 'athen_typography_styles', $columns );
}

/**
 * Button styles
 *
 * @since   Total 1.6.2
 * @return  array
 */
function athen_button_styles() {
    $styles = array(
        ''          => __( 'Default', 'athen_transl' ),
        'flat'      => __( 'Flat', 'athen_transl' ),
        'graphical' => __( 'Graphical', 'athen_transl' ),
        'clean'     => __( 'Clean', 'athen_transl' ),
        'three-d'   => __( '3D', 'athen_transl' ),
        'outline'   => __( 'Outline', 'athen_transl' ),
    );
    return apply_filters( 'athen_button_styles', $styles );
}

/**
 * Button colors
 *
 * @since   Total 1.6.2
 * @return  array
 */
function athen_button_colors() {
    $colors = array(
        ''          => __( 'Default', 'athen_transl' ),
        'black'     => __( 'Black', 'athen_transl' ),
        'blue'      => __( 'Blue', 'athen_transl' ),
        'brown'     => __( 'Brown', 'athen_transl' ),
        'grey'      => __( 'Grey', 'athen_transl' ),
        'green'     => __( 'Green', 'athen_transl' ),
        'gold'      => __( 'Gold', 'athen_transl' ),
        'orange'    => __( 'Orange', 'athen_transl' ),
        'pink'      => __( 'Pink', 'athen_transl' ),
        'purple'    => __( 'Purple', 'athen_transl' ),
        'red'       => __( 'Red', 'athen_transl' ),
        'rosy'      => __( 'Rosy', 'athen_transl' ),
        'teal'      => __( 'Teal', 'athen_transl' ),
        'white'     => __( 'White', 'athen_transl' ),
    );
    return apply_filters( 'athen_button_colors', $colors );
}

/**
 * Array of image crop locations
 *
 * @link    http://codex.wordpress.org/Function_Reference/get_intermediate_image_sizes
 * @since   2.0.0
 * @return  array
 */
function athen_image_crop_locations() {
    return array(
        ''              => __( 'Default', 'athen_transl' ),
        'left-top'      => __( 'Top Left', 'athen_transl' ),
        'right-top'     => __( 'Top Right', 'athen_transl' ),
        'center-top'    => __( 'Top Center', 'athen_transl' ),
        'left-center'   => __( 'Center Left', 'athen_transl' ),
        'right-center'  => __( 'Center Right', 'athen_transl' ),
        'center-center' => __( 'Center Center', 'athen_transl' ),
        'left-bottom'   => __( 'Bottom Left', 'athen_transl' ),
        'right-bottom'  => __( 'Bottom Right', 'athen_transl' ),
        'center-bottom' => __( 'Bottom Center', 'athen_transl' ),
    );
}

/**
 * Image Hovers
 *
 * @since   Total 1.6.2
 * @return  array
 */
function athen_image_hovers() {
    $hovers = array(
        ''              => __( 'Default', 'athen_transl' ),
        'opacity'       => __( 'Opacity', 'athen_transl' ),
        'grow'          => __( 'Grow', 'athen_transl' ),
        'shrink'        => __( 'Shrink', 'athen_transl' ),
        'side-pan'      => __( 'Side Pan', 'athen_transl' ),
        'vertical-pan'  => __( 'Vertical Pan', 'athen_transl' ),
        'tilt'          => __( 'Tilt', 'athen_transl' ),
        'blurr'         => __( 'Normal - Blurr', 'athen_transl' ),
        'blurr-invert'  => __( 'Blurr - Normal', 'athen_transl' ),
        'sepia'         => __( 'Sepia', 'athen_transl' ),
        'fade-out'      => __( 'Fade Out', 'athen_transl' ),
        'fade-in'       => __( 'Fade In', 'athen_transl' ),
    );
    return apply_filters( 'athen_image_hovers', $hovers );
}

/**
 * Returns correct image hover classnames
 *
 * @since   2.0.0
 * @return  array
 */
function athen_image_hover_classes( $style ) {
    $classes    = array( 'athen-image-hover' );
    $classes[]  = $style;
    return implode( ' ', $classes );
}

/**
 * Returns correct image rendering class
 *
 * @since   2.0.0
 * @return  array
 */
function athen_image_rendering_class( $rendering ) {
    return 'image-rendering-'. $rendering;
}

/**
 * Returns correct image filter class
 *
 * @since   2.0.0
 * @return  array
 */
function athen_image_filter_class( $filter ) {
    if ( ! $filter || 'none' == $filter ) {
        return;
    }
    return 'image-filter-'. $filter;
}

/**
 * Font Weights
 *
 * @since   Total 1.6.2
 * @return  array
 */
function athen_font_weights() {
    $weights = array(
        ''          => __( 'Default', 'athen_transl' ),
        'normal'    => __( 'Normal', 'athen_transl' ),
        'semibold'  => __( 'Semibold', 'athen_transl' ),
        'bold'      => __( 'Bold', 'athen_transl' ),
        'bolder'    => __( 'Bolder', 'athen_transl' ),
        '100'       => '100',
        '200'       => '200',
        '300'       => '300',
        '400'       => '400',
        '500'       => '500',
        '600'       => '600',
        '700'       => '700',
        '800'       => '800',
        '900'       => '900',
    );
    return apply_filters( 'athen_font_weights', $weights );
}

/**
 * Text Transform
 *
 * @since   Total 1.6.2
 * @return  array
 */
function athen_text_transforms() {
    return array(
        ''              => __( 'Default', 'athen_transl' ),
        'none'          => __( 'None', 'athen_transl' ) ,
        'capitalize'    => __( 'Capitalize', 'athen_transl' ),
        'uppercase'     => __( 'Uppercase', 'athen_transl' ),
        'lowercase'     => __( 'Lowercase', 'athen_transl' ),
    );
}

/**
 * Border Styles
 *
 * @since   1.6.0
 * @return  array
 */
function athen_border_styles() {
    return array(
        ''          => __( 'Default', 'athen_transl' ),
        'solid'     => __( 'Solid', 'athen_transl' ),
        'dotted'    => __( 'Dotted', 'athen_transl' ),
        'dashed'    => __( 'Dashed', 'athen_transl' ),
    );
}

/**
 * Alignments
 *
 * @since   1.6.0
 * @return  array
 */
function athen_alignments() {
    return array(
        ''          => __( 'Default', 'athen_transl' ),
        'left'      => __( 'Left', 'athen_transl' ),
        'right'     => __( 'Right', 'athen_transl' ),
        'center'    => __( 'Center', 'athen_transl' ),
    );
}

/**
 * Visibility
 *
 * @since   1.6.0
 * @return  array
 */
function athen_visibility() {
    $visibility = array(
        ''                          => __( 'Always Visible', 'athen_transl' ),
        'hidden-phone'              => __( 'Hidden on Phones', 'athen_transl' ),
        'hidden-tablet'             => __( 'Hidden on Tablets', 'athen_transl' ),
        'hidden-tablet-landscape'   => __( 'Hidden on Tablets: Landscape', 'athen_transl' ),
        'hidden-tablet-portrait'    => __( 'Hidden on Tablets: Portrait', 'athen_transl' ),
        'hidden-desktop'            => __( 'Hidden on Desktop', 'athen_transl' ),
        'visible-desktop'           => __( 'Visible on Desktop Only', 'athen_transl' ),
        'visible-phone'             => __( 'Visible on Phones Only', 'athen_transl' ),
        'visible-tablet'            => __( 'Visible on Tablets Only', 'athen_transl' ),
        'visible-tablet-landscape'  => __( 'Visible on Tablets: Landscape Only', 'athen_transl' ),
        'visible-tablet-portrait'   => __( 'Visible on Tablets: Portrait Only', 'athen_transl' ),
    );
    return apply_filters( 'athen_visibility', $visibility );
}

/**
 * CSS Animations
 *
 * @since   1.6.0
 * @return  array
 */
function athen_css_animations() {
    $animations = array(
        ''              => __( 'None', 'athen_transl') ,
        'top-to-bottom' => __( 'Top to bottom', 'athen_transl' ),
        'bottom-to-top' => __( 'Bottom to top', 'athen_transl' ),
        'left-to-right' => __( 'Left to right', 'athen_transl' ),
        'right-to-left' => __( 'Right to left', 'athen_transl' ),
        'appear'        => __( 'Appear from center', 'athen_transl' ),
    );
    return apply_filters( 'athen_css_animations', $animations );
}

/**
 * Array of Hover CSS animations
 *
 * @since   2.0.0
 * @return  array
 */
function athen_hover_css_animations() {
    $animations = array(
        ''                          => __( 'Default', 'athen_transl' ),
        'shadow'                    => __( 'Shadow', 'athen_transl' ),
        'grow-shadow'               => __( 'Grow Shadow', 'athen_transl' ),
        'float-shadow'              => __( 'Float Shadow', 'athen_transl' ),
        'grow'                      => __( 'Grow', 'athen_transl' ),
        'shrink'                    => __( 'Shrink', 'athen_transl' ),
        'pulse'                     => __( 'Pulse', 'athen_transl' ),
        'pulse-grow'                => __( 'Pulse Grow', 'athen_transl' ),
        'pulse-shrink'              => __( 'Pulse Shrink', 'athen_transl' ),
        'push'                      => __( 'Push', 'athen_transl' ),
        'pop'                       => __( 'Pop', 'athen_transl' ),
        'bounce-in'                 => __( 'Bounce In', 'athen_transl' ),
        'bounce-out'                => __( 'Bounce Out', 'athen_transl' ),
        'rotate'                    => __( 'Rotate', 'athen_transl' ),
        'grow-rotate'               => __( 'Grow Rotate', 'athen_transl' ),
        'float'                     => __( 'Float', 'athen_transl' ),
        'sink'                      => __( 'Sink', 'athen_transl' ),
        'bob'                       => __( 'Bob', 'athen_transl' ),
        'hang'                      => __( 'Hang', 'athen_transl' ),
        'skew'                      => __( 'Skew', 'athen_transl' ),
        'skew-backward'             => __( 'Skew Backward', 'athen_transl' ),
        'wobble-horizontal'         => __( 'Wobble Horizontal', 'athen_transl' ),
        'wobble-vertical'           => __( 'Wobble Vertical', 'athen_transl' ),
        'wobble-to-bottom-right'    => __( 'Wobble To Bottom Right', 'athen_transl' ),
        'wobble-to-top-right'       => __( 'Wobble To Top Right', 'athen_transl' ),
        'wobble-top'                => __( 'Wobble Top', 'athen_transl' ),
        'wobble-bottom'             => __( 'Wobble Bottom', 'athen_transl' ),
        'wobble-skew'               => __( 'Wobble Skew', 'athen_transl' ),
        'buzz'                      => __( 'Buzz', 'athen_transl' ),
        'buzz-out'                  => __( 'Buzz Out', 'athen_transl' ),
        'glow'                      => __( 'Glow', 'athen_transl' ),
        'shadow-radial'             => __( 'Shadow Radial', 'athen_transl' ),
        'box-shadow-outset'         => __( 'Box Shadow Outset', 'athen_transl' ),
        'box-shadow-inset'          => __( 'Box Shadow Inset', 'athen_transl' ),
    );
    return apply_filters( 'athen_hover_css_animations', $animations );
}