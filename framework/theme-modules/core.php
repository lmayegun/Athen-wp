<?php
/**
 * Description : Core function for theme, any change make in here will affect theme behaviour or display.
 *               Use child theme to edit.  
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
 * Returns global object or property from global object
 *
 * @since Athen 1.0.0
 */
function athen_global_obj( $property = null ) {

    // Get global object
    global $athen_std_theme;

    // Return object
    if ( ! $property ) {
        return $athen_std_theme;
    } else {
        $property = $athen_std_theme->$property;
        if ( ! empty( $property ) ) {
            return $property;
        }
    }

}

/**
 * Returns theme mod from global data
 *
 * @since Total 2.1.0
 */
function athen_get_mod( $id, $default = '' ) {

    // Return get_theme_mod on customize_preview
    if ( is_customize_preview() ) {
        return get_theme_mod( $id, $default );
    }
   
    // Get global object
    global $athen_theme_mods;

    // Return data from global object
    if ( ! empty( $athen_theme_mods ) ) {

        // Return value
        if ( isset( $athen_theme_mods[$id] ) ) {
            return $athen_theme_mods[$id];
        }

        // Return default
        else {
            return $default;
        }

    }

    // Global object not found return using get_theme_mod
    else {
        return get_theme_mod( $id, $default );
    }
}

/**
 * Returns theme custom post types
 *
 * @since   Total 1.3.3
 * @return  array
 */
function athen_theme_post_types() {
    $post_types = array( 'portfolio', 'staff', 'testimonials' );
    $post_types = array_combine( $post_types, $post_types );
    $post_types = apply_filters( 'athen_theme_post_types', $post_types );
    return $post_types;
}

/**
 * Check if retina is enabled
 *
 * @since Total 1.3.3
 */
function athen_is_retina_enabled() {
    if ( athen_get_mod( 'image_resizing', true ) && athen_get_mod( 'retina', false ) ) {
        return true;
    }
}

/**
 * Get's the current ID, this function is needed to properly support WooCommerce
 *
 * @since   Total 1.5.4
 * @return  string
 */
function athen_get_the_id() {

    // If singular get_the_ID
    if ( is_singular() ) {
        return get_the_ID();
    }

    // Get ID of WooCommerce product archive
    elseif ( ATHEN_CHECK_WOOCOMMERCE && is_shop()  ) {
        $shop_id = wc_get_page_id( 'shop' );
        if ( isset( $shop_id ) ) {
            return wc_get_page_id( 'shop' );
        }
    }

    // Posts page
    elseif ( is_home() && $page_for_posts = get_option( 'page_for_posts' ) ) {
        return $page_for_posts;
    }

    // Return nothing
    else {
        return NULL;
    }

}

/**
 * Returns the correct main layout class
 *
 * @since   Total 1.5.0
 * @return  string
 */
function athen_main_layout( $post_id = '' ) {

    // Check URL
    /* Do not need to check URL - Parse to head style
	if ( ! empty( $_GET['site_layout'] ) ) {
        return $_GET['site_layout'];
    }
	*/

    // Get global object
    $athen_std_theme = athen_global_obj();

    // Get layout
    $layout = athen_get_mod( 'main_layout_style', 'layout-one' );
    $meta   = get_post_meta( $post_id, 'athen_main_layout', true );
    $layout = $meta ? $meta : $layout;

    // Check skin
    if ( 'gaps' == $athen_std_theme->skin ) {
        $layout = 'boxed';
    }

    // Apply filters for child theming
    $layout = apply_filters( 'athen_main_layout', $layout );

    // Return layout
    return $layout;

}


/**
 * Defines your default search results page style
 *
 * @return  $style
 * @since   Total 1.5.4
 */
function athen_search_results_style() {
    $style = apply_filters( 'athen_search_results_style', 'default' );
    return $style;
}

/**
 * Echo the post URL
 *
 * @since   Total 1.5.4
 * @return  string
 */
function athen_permalink( $post_id = '' ) {
    echo athen_get_permalink( $post_id );
}

/**
 * Return the post URL
 *
 * @since   2.0.0
 * @return  string
 */
function athen_get_permalink( $post_id = '' ) {

    // If post ID isn't defined lets get it
    $post_id = $post_id ? $post_id : get_the_ID();

    // Check athen_post_link custom field for custom link
    $meta = get_post_meta( $post_id, 'athen_post_link', true );

    // If athen_post_link custom field is defined return that otherwise return the permalink
    $permalink  = $meta ? $meta : get_permalink( $post_id );

    // Apply filters
    $permalink = apply_filters( 'athen_permalink', $permalink );

    // Sanitize
    $permalink = esc_url( $permalink );

    // Return permalink
    return $permalink;

}

/**
 * Return custom permalink
 *
 * @since   2.0.0
 * @return  string
 */
function athen_get_custom_permalink() {
    $link = get_post_meta( get_the_ID(), 'athen_post_link', true );
    return esc_url( $link );
}

/**
 * Echo escaped post title
 *
 * @since   2.0.0
 * @return  string
 */
function athen_esc_title() {
    echo athen_get_esc_title();
}

/**
 * Return escaped post title
 *
 * @since   Total 1.5.4
 * @return  string
 */
function athen_get_esc_title() {
    return esc_attr( the_title_attribute( 'echo=0' ) );
}

/**
 * Returns the correct sidebar ID
 *
 * @return  $sidebar
 * @since   1.0.0
 */
function athen_get_sidebar( $sidebar = 'sidebar' ) {

    // Get global object
    $athen_std_theme = athen_global_obj();

    // Pages
    if ( is_page() && athen_get_mod( 'pages_custom_sidebar', true ) ) {
        if ( ! is_page_template( 'templates/blog.php' ) ) {
            $sidebar = 'pages_sidebar';
        }
    }

    // Search
    elseif ( is_search() && athen_get_mod( 'search_custom_sidebar', true ) ) {
        $sidebar = 'search_sidebar';
    }
    
    // Add filter for tweaking the sidebar display via child theme's
    $sidebar = apply_filters( 'athen_get_sidebar', $sidebar );

    // Check meta option after filter so it always overrides
    if ( $meta = get_post_meta( $athen_std_theme->post_id, 'sidebar', true ) ) {
        $sidebar = $meta;
    }

    // Return the correct sidebar
    return $sidebar;
    
}

/**
 * Returns the correct classname for any specific column grid
 *
 * @return $class
 * @since   1.0.0
 */
function athen_grid_class( $col = '4' ) {
    $class = 'athen-col-'. $col;
    $class = apply_filters( 'athen_grid_class', $class );
    return $class;
}

/**
 * Returns the 1st taxonomy of any taxonomy
 *
 * @since Total 1.3.3
 */
function athen_get_first_term( $post_id, $taxonomy = 'category' ) {
    if ( ! $post_id ) {
        return;
    }
    if ( ! taxonomy_exists( $taxonomy ) ) {
        return;
    }
    $terms = wp_get_post_terms( $post_id, $taxonomy );
    if ( ! empty( $terms ) ) { ?>
        <span><?php echo $terms[0]->name; ?></span>
    <?php
    }
}

/**
 * Echos 1st taxonomy of any taxonomy with a link
 *
 * @since 2.0.0
 */
function athen_first_term_link( $post_id, $taxonomy = 'category' ) {
    if ( ! $post_id ) {
        return;
    }
    if ( ! taxonomy_exists( $taxonomy ) ) {
        return;
    }
    $terms = wp_get_post_terms( $post_id, $taxonomy );
    if ( ! empty( $terms ) ) {
        $term_link = get_term_link( $terms[0], $taxonomy ); ?>
        <a href="<?php echo esc_url( $term_link ); ?>" title="<?php esc_attr( $terms[0]->name ); ?>"><?php echo $terms[0]->name; ?></a>
    <?php
    }
}

/**
 * List categories for specific taxonomy
 * 
 * @link    http://codex.wordpress.org/Function_Reference/wp_get_post_terms
 * @since   Total 1.6.3
 */
function athen_list_post_terms( $taxonomy = 'category', $show_links = true, $echo = true ) {

    // Make sure taxonomy exists
    if ( ! taxonomy_exists( $taxonomy ) ) {
        return;
    }

    // Get terms
    $list_terms = array();
    $terms      = wp_get_post_terms( get_the_ID(), $taxonomy );

    // Return if no terms are found
    if ( ! $terms ) {
        return;
    }

    // Loop through terms
    foreach ( $terms as $term ) {
        $permalink = get_term_link( $term->term_id, $taxonomy );
        if ( $show_links ) {
            $list_terms[]   = '<a href="'. $permalink .'" title="'. $term->name .'" class="term-'. $term->term_id .'entry-category-label">'. $term->name .'</a>';
        } else {
            $list_terms[]   = '<span class="term-'. $term->term_id .'">'. $term->name .'</span>';
        }
    }

    // Turn into comma seperated string
    if ( $list_terms && is_array( $list_terms ) ) {
        $list_terms = implode( ' ', $list_terms );
    } else {
        return;
    }

    // Echo terms
    if ( $echo ) {
        echo $list_terms;
    } else {
        return $list_terms;
    }

}

/**
 * Minify CSS
 *
 * @since   Total 1.6.3
 * @return  string
 */
function athen_minify_css( $css ) {

    if ( ! $css ) {
        return;
    }

    // Normalize whitespace
    $css = preg_replace( '/\s+/', ' ', $css );

    // Remove ; before }
    $css = preg_replace( '/;(?=\s*})/', '', $css );

    // Remove space after , : ; { } */ >
    $css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );

    // Remove space before , ; { }
    $css = preg_replace( '/ (,|;|\{|})/', '$1', $css );

    // Strips leading 0 on decimal values (converts 0.5px into .5px)
    $css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );

    // Strips units if value is 0 (converts 0px to 0)
    $css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );

    // Trim
    $css = trim( $css );

    // Return minified CSS
    return $css;
    
}

/**
 * Provides translation support for plugins such as WPML
 *
 * @since   Total 1.6.3
 * @return  string
 */
function athen_translate_theme_mod( $id, $content ) {

    // Return false if no content is found
    if ( ! $content ) {
        return false;
    }

    // WPML translation
    if ( function_exists( 'icl_t' ) && $id ) {
        $content = icl_t( 'Theme Mod', $id, $content );
    }

    // Polylang Translation
    if ( function_exists( 'pll__' ) && $id ) {
        $content = pll__( $content );
    }

    // Return the content
    return $content;

}

/**
 * Outputs a theme heading
 * 
 * @since Total 1.3.3
 */
if ( ! function_exists( 'athen_heading' ) ) {
    function athen_heading( $args = array() ) {

        // Defaults
        $defaults = array(
            'apply_filters' => '',
            'content'       => '',
            'tag'           => 'h2',
            'classes'       => array(),
        );

        // Add filters if defined
        if ( ! empty( $args['apply_filters'] ) ) {
            $args = apply_filters( 'athen_heading_'. $args['apply_filters'], $args );
        }

        // Parse args
        wp_parse_args( $args, $defaults );

        // Extract args
        extract( $args );

        // Return if text is empty
        if ( ! $content ) {
            return;
        }

        // Get classes
        $add_classes    = $classes;
        $classes        = array( 'theme-heading' );
        if ( $add_classes && is_array( $add_classes ) ) {
            $classes = array_merge( $classes, $add_classes );
        }

        // Turn classes into space seperated string
        $classes = implode( ' ', $classes ); ?>

        <<?php echo $tag; ?> class="<?php echo $classes; ?>">
            <span class="text"><?php echo $content; ?></span>
        </<?php echo $tag; ?>><!-- <?php echo $classes; ?> -->

    <?php
    }
}

/**
 * Provides translation support for plugins such as WPML
 * 
 * @since Total 1.3.3
 */
if ( ! function_exists( 'athen_element' ) ) {
    function athen_element( $element ) {

        // Rarr
        if ( 'rarr' == $element ) {
            if ( is_rtl() ) {
                return '&larr;';
            } else {
                return '&rarr;';
            }
        }

        // Angle Right
        elseif ( 'angle_right' == $element ) {

            if ( is_rtl() ) {
                return '<span class="fa fa-angle-left"></span>';
            } else {
                return '<span class="fa fa-angle-right"></span>';
            }

        }

    }
}

/**
 * Checks if a featured image has a caption
 *
 * @since   2.0.0
 * @return  bool
 */
function athen_featured_image_caption( $post_id = '' ) {
    $post_id        = $post_id ? $post_id : get_the_ID();
    $thumbnail_id   = get_post_thumbnail_id( $post_id );
    $caption        = get_post_field( 'post_excerpt', $thumbnail_id );
    return $caption;
}

/**
 * Adds the sp-video class to an iframe
 *
 * @since   Total 1.0.0
 * @return  string
 */
function athen_add_sp_video_to_oembed( $oembed ) {
    $oembed = str_replace( 'iframe', 'iframe class="sp-video"', $oembed );
    return $oembed;
}

/**
 * Returns attachment data
 *
 * @since   2.0.0
 * @return  array
 */
function athen_get_attachment_data( $attachment = '', $return = '' ) {

    // Return if no attachment
    if ( ! $attachment ) {
        return;
    }

    // Return if return equals none
    if ( 'none' == $return ) {
        return;
    }

    // Create array of attachment data
    $array = array(
        'url'           => get_post_meta( $attachment, '_wp_attachment_url', true ),
        'src'           => wp_get_attachment_url( $attachment ),
        'alt'           => get_post_meta( $attachment, '_wp_attachment_image_alt', true ),
        'title'         => get_the_title( $attachment),
        'caption'       => get_post_field( 'post_excerpt', $attachment ),
        'description'   => get_post_field( 'post_content', $attachment ),
        'video'         => esc_url( get_post_meta( $attachment, '_video_url', true ) ),
    );

    // Return data
    if ( $return ) {
        return $array[$return];
    } else {
        return $array;
    }

}

/**
 * Returns correct hover animation class
 *
 * @since   2.0.0
 * @return  array
 */
function athen_hover_animation_class( $animation ) {
    $animation = 'hvr-'. $animation;
    return $animation;
}

/**
 * Echo animation classes for entries
 *
 * @since   Total 1.1.6
 * @return  string
 */
function athen_entry_image_animation_classes() {
    echo athen_get_entry_image_animation_classes();
}

/**
 * Returns animation classes for entries
 *
 * @since   Total 1.1.6
 * @return  string
 */
function athen_get_entry_image_animation_classes() {

    // Empty by default
    $classes = '';

    // Only used for standard posts now
    if ( 'post' != get_post_type( get_the_ID() ) ) {
        return;
    }

    // Get blog classes
    if ( athen_get_mod( 'blog_entry_image_hover_animation' ) ) {
        $classes = ' athen-image-hover '. athen_get_mod( 'blog_entry_image_hover_animation' );
    }

    // Apply filters
    return apply_filters( 'athen_entry_image_animation_classes', $classes );

}


/**
 * Returns thumbnail sizes
 *
 * @link    http://codex.wordpress.org/Function_Reference/get_intermediate_image_sizes
 * @since   2.0.0
 * @return  array
 */
function athen_get_thumbnail_sizes( $size = '' ) {

    global $_wp_additional_image_sizes;

    $sizes                          = array(
        'full'  => array(
            'width'     => '9999',
            'height'    => '9999',
            'crop'      => 0
        ),
    );
    $get_intermediate_image_sizes   = get_intermediate_image_sizes();

    // Create the full array with sizes and crop info
    foreach( $get_intermediate_image_sizes as $_size ) {

        if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {

            $sizes[ $_size ]['width']   = get_option( $_size . '_size_w' );
            $sizes[ $_size ]['height']  = get_option( $_size . '_size_h' );
            $sizes[ $_size ]['crop']    = (bool) get_option( $_size . '_crop' );

        } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {

            $sizes[ $_size ] = array( 
                'width'     => $_wp_additional_image_sizes[ $_size ]['width'],
                'height'    => $_wp_additional_image_sizes[ $_size ]['height'],
                'crop'      => $_wp_additional_image_sizes[ $_size ]['crop']
            );

        }

    }

    // Get only 1 size if found
    if ( $size ) {
        if ( isset( $sizes[ $size ] ) ) {
            return $sizes[ $size ];
        } else {
            return false;
        }
    }

    // Return sizes
    return $sizes;
}

/**
 * Generates a retina image
 *
 * @since 2.0.0
 */
function athen_generate_retina_image( $image, $width, $height, $crop ) {

    // Define cropping args
    $args = array(
        'image'     => $image,
        'width'     => $width,
        'height'    => $height,
        'crop'      => $crop,
        'return'    => 'url',
        'retina'    => true,
    );

    // Resize image and create retina version
    $image = athen_image_resize( $args );

    // Return image
    return $image;

}

/**
 * Echo post thumbnail url
 *
 * @since   2.0.0
 * @return  string
 */
function athen_post_thumbnail_url( $args = array() ) {
    echo athen_get_post_thumbnail_url( $args );
}

/**
 * Return post thumbnail url
 *
 * @since   2.0.0
 * @return  string
 */
function athen_get_post_thumbnail_url( $args = array() ) {
    $args['return'] = 'url';
    return athen_get_post_thumbnail( $args );
}

/**
 * Outputs the img HTMl thubmails used in the Total VC modules
 *
 * @since   2.0.0
 * @return  string
 */
function athen_post_thumbnail( $args = array() ) {
    echo athen_get_post_thumbnail( $args );
}

/**
 * Returns correct HTMl for post thumbnails
 *
 * @since   2.0.0
 * @return  string
 */
function athen_get_post_thumbnail( $args = array() ) {
    
    // Check if retina is enabled
    $retina     = athen_is_retina_enabled();
    $retina_img = '';
    $attr       = array();

    // Default args
    $defaults = array(
        'attachment'    => get_post_thumbnail_id(),
        'size'          => 'full',
        'width'         => '',
        'height'        => '',
        'crop'          => 'center-center',
        'alt'           => '',
        'class'         => '',
        'return'        => 'html',
        'style'         => '',
    );

    // Parse args
    $args = wp_parse_args( $args, $defaults );

    // Extract args
    extract( $args );

    // Return if there isn't any attachment
    if ( ! $attachment ) {
        return;
    }

    // Sanitize variables
    $size   = ( 'wpex-custom' == $size ) ? 'athen_custom' : $size;
    $size   = ( 'athen_custom' == $size ) ? false : $size;
    $crop   = ( ! $crop ) ? 'center-center' : $crop;
    $crop   = ( 'true' == $crop ) ? 'center-center' : $crop;

    // Image must have an alt
    if ( empty( $alt ) ) {
        $alt = get_post_meta( $attachment, '_wp_attachment_image_alt', true );
    }
    if ( empty( $alt ) ) {
        $alt = trim( strip_tags( get_post_field( 'post_excerpt', $attachment ) ) );
    }
    if ( empty( $alt ) ) {
        $alt = trim( strip_tags( get_the_title( $attachment ) ) );
        $alt = str_replace( '_', ' ', $alt );
        $alt = str_replace( '-', ' ', $alt );
    }

    // Prettify alt attribute
    if ( $alt ) {
        $alt = ucwords( $alt );
    }

    // If image width and height equal '9999' return full image
    if ( '9999' == $width && '9999' == $height ) {
        $size   = $size ? $size : 'full';
        $width  = $height = '';
    }

    // Define crop locations
    $crop_locations = array_flip( athen_image_crop_locations() );

    // Set crop location if defined in format 'left-top' and turn into array
    if ( $crop && in_array( $crop, $crop_locations ) ) {
        $crop = ( 'center-center' == $crop ) ? true : explode( '-', $crop );
    }

    // Get attachment URl
    $attachment_url = wp_get_attachment_url( $attachment );

    // Return if there isn't any attachment URL
    if ( ! $attachment_url ) {
        return;
    }

    // Add classes
    if ( $class ) {
        $attr['class'] = $class;
    }

    // Add alt
    if ( $alt ) {
        $attr['alt'] = $alt;
    }

    // Add style
    if ( $style ) {
        $attr['style'] = $style;
    }

    // If on the fly image resizing is enabled or a custom width/height is defined
    if ( athen_get_mod( 'image_resizing', true ) || ( $width || $height ) ) {

        // Add Classes
        if ( $class ) {
            $class = ' class="'. $class .'"';
        }

        // If size is defined and not equal to athen_custom
        if ( $size && 'athen_custom' != $size ) {
            $dims   = athen_get_thumbnail_sizes( $size );
            $width  = $dims['width'];
            $height = $dims['height'];
            $crop   = ! empty( $dims['crop'] ) ? $dims['crop'] : $crop;
        }


        // Crop standard image
        $image = athen_image_resize( array(
            'image'     => $attachment_url,
            'width'     => $width,
            'height'    => $height,
            'crop'      => $crop,
        ) );

        // Generate retina version
        if ( $retina ) {
            $retina_img = athen_generate_retina_image( $attachment_url, $width, $height, $crop );
            if ( $retina_img ) {
                $attr['data-at2x'] = $retina_img;
            } else {
                $attr['data-no-retina'] = '';
            }
        }

        // Return HTMl
        if ( $image ) {

            // Return image URL
            if ( 'url' == $return ) {
                return $image['url'];
            }

            // Return image HTMl
            else {

                // Add attributes
                $attr = array_map( 'esc_attr', $attr );
                $html = '';
                foreach ( $attr as $name => $value ) {
                    $html .= ' '. $name .'="'. $value .'"';
                }

                // Return img
                return '<img src="'. $image['url'] .'" width="'. $image['width'] .'" height="'. $image['height'] .'"'. $html .' />';

            }

        }

    }

    // Return image from add_image_size
    else {

        // Sanitize size
        $size = $size ? $size : 'full';

        // Create retina version if retina is enabled (not needed for full images)
        if ( $retina ) {

            // Retina not needed for full images
            if ( 'full' != $size ) {
                $dims       = athen_get_thumbnail_sizes( $size );
                $retina_img = athen_generate_retina_image( $attachment_url, $dims['width'], $dims['height'], $dims['crop'] );
            }

            // Add retina tag
            if ( $retina_img ) {
                $attr['data-at2x'] = $retina_img;
            } else {
                $attr['data-no-retina'] = '';
            }

        }

        // Return image URL
        if ( 'url' == $return ) {
            $src = wp_get_attachment_image_src( $attachment, $size, false );
            return $src[0];
        }

        // Return image HTMl
        else {
            return wp_get_attachment_image( $attachment, $size, false, $attr );
        }

    }

}

/**
 * Echo post video
 *
 * @since   2.0.0
 * @return  string
 */
function athen_post_video( $post_id ) {
    echo athen_get_post_video( $post_id );
}

/**
 * Returns post video
 *
 * @since   2.0.0
 * @return  string
 */
function athen_get_post_video( $post_id = '' ) {

    // Define video variable
    $video = '';

    // Get correct ID
    $post_id = $post_id ? $post_id : get_the_ID();

    // Embed
    if ( $meta = get_post_meta( $post_id, 'athen_post_video_embed', true ) ) {
        $video = $meta;
    }

    // Check for self-hosted first
    elseif ( $meta = get_post_meta( $post_id, 'athen_post_self_hosted_media', true ) ) {
        $video = $meta;
    }

    // Check for athen_post_video custom field
    elseif ( $meta = get_post_meta( $post_id, 'athen_post_video', true ) ) {
        $video = $meta;
    }

    // Check for post oembed
    elseif ( $meta = get_post_meta( $post_id, 'athen_post_oembed', true ) ) {
        $video = $meta;
    }

    // Check old redux custom field last
    elseif ( $meta = get_post_meta( $post_id, 'athen_post_self_hosted_shortcode_redux', true ) ) {
        $video = $meta;
    }

    // Apply filters for child theming
    $video = apply_filters( 'athen_get_post_video', $video );

    // Return data
    return $video;

}

/**
 * Echo post video HTML
 *
 * @since   2.0.0
 * @return  string
 */
function athen_post_video_html( $video = '' ) {
    echo athen_get_post_video_html( $video );
}

/**
 * Returns post video HTML
 *
 * @since   2.0.0
 * @return  string
 */
function athen_get_post_video_html( $video = '' ) {

    // Get video
    $video = $video ? $video : athen_get_post_video();

    // Return if video is empty
    if ( empty( $video ) ) {
        return;
    }

    // Check post format for standard post type
    if ( 'post' == get_post_type() && 'video' != get_post_format() ) {
        return;
    }

    // Check if it's an embed or iframe

    // Get oembed code and return
    if ( ! is_wp_error( $oembed = wp_oembed_get( $video ) ) && $oembed ) {
        return '<div class="responsive-video-wrap">'. $oembed .'</div>';
    }

    // Display using apply_filters if it's self-hosted
    else {

        $video = apply_filters( 'the_content', $video );

        // Add responsive video wrap for youtube/vimeo embeds
        if ( strpos( $video, 'youtube' ) || strpos( $video, 'vimeo' ) ) {
            return '<div class="responsive-video-wrap">'. $video .'</div>';
        }
        
        // Else return without responsive wrap
        else {
            return $video;
        }

    }
}


/**
 * Returns post audio
 *
 * @since   2.0.0
 * @return  string
 */
function athen_get_post_audio( $id = '' ) {

    // Define video variable
    $audio = '';

    // Get correct ID
    $id = $id ? $id : get_the_ID();

    // Check for self-hosted first
    if ( $self_hosted = get_post_meta( $id, 'athen_post_self_hosted_media', true ) ) {
        $audio = $self_hosted;
    }

    // Check for athen_post_audio custom field
    elseif ( $post_video = get_post_meta( $id, 'athen_post_audio', true ) ) {
        $audio = $post_video;
    }

    // Check for post oembed
    elseif ( $post_oembed = get_post_meta( $id, 'athen_post_oembed', true ) ) {
        $audio = $post_oembed;
    }

    // Check old redux custom field last
    elseif ( $self_hosted = get_post_meta( $id, 'athen_post_self_hosted_shortcode_redux', true ) ) {
        $audio = $self_hosted;
    }

    // Apply filters for child theming
    $audio = apply_filters( 'athen_get_post_audio', $audio );

    // Return data
    return $audio;

}

/**
 * Returns post audio
 *
 * @since   2.0.0
 * @return  string
 */
function athen_get_post_audio_html( $audio = '' ) {

    // Get video
    $audio = $audio ? $audio : athen_get_post_audio();

    // Return if video is empty
    if ( empty( $audio ) ) {
        return;
    }

    // Get oembed code and return
    if ( ! is_wp_error( $oembed = wp_oembed_get( $audio ) ) && $oembed ) {
        return '<div class="responsive-audio-wrap">'. $oembed .'</div>';
    }

    // Display using apply_filters if it's self-hosted
    else {
        return apply_filters( 'the_content', $audio );
    }

}

/**
 * Returns the "category" taxonomy for a given post type
 *
 * @since   2.0.0
 * @return  string
 */
function athen_get_post_type_cat_tax( $post_type = '' ) {

    // Get the post type
    $post_type = $post_type ? $post_type : get_post_type();

    // Return taxonomy
    if ( 'post' == $post_type ) {
        $tax = 'category';
    } elseif ( 'portfolio' == $post_type ) {
        $tax = 'portfolio_category';
    } elseif( 'staff' == $post_type ) {
        $tax = 'staff_category';
    } elseif( 'testimonials' == $post_type ) {
        $tax = 'testimonials_category';
    } elseif ( 'product' == $post_type ) {
        $tax = 'product_cat';
    } elseif ( 'tribe_events' == $post_type ) {
        $tax = 'tribe_events_cat';
    } else {
        $tax = false;
    }

    // Apply filters
    $tax = apply_filters( 'athen_get_post_type_cat_tax', $tax );

    // Return
    return $tax;

}

/**
 * Returns correct typography style class
 *
 * @since   Total 2.0.2
 * @return  string
 */
function athen_typography_style_class( $style ) {
    $class = '';
    if ( $style
        && 'none' != $style
        && array_key_exists( $style, athen_typography_styles() ) ) {
        $class = 'typography-'. $style;
    }
    return $class;
}

/**
 * Convert to array
 *
 * @since 2.0.0
 */
function athen_string_to_array( $value = array() ) {

    // Return empty array if value is empty
    if ( empty( $value ) ) {
        return array();
    }

    // Check if array and not empty
    elseif ( ! empty( $value ) && is_array( $value ) ) {
        return $array;
    }

    // Create our own return
    else {

        // Define array
        $array = array();

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
 * Retrieve all term data
 *
 * @since Total 2.1.0
 */
function athen_get_term_data() {

    // Get global object
    $athen_std_theme = athen_global_obj();

    // Check global object for term data
    if ( ! empty( $athen_std_theme->term_data ) ) {
        return $athen_std_theme->term_data;
    }

    // Fallback - get_option
    else {
        return get_option( 'athen_term_data' );
    }
    
}

/**
 * Placeholder Image
 *
 * @since Total 2.1.0
 */
function athen_placeholder_img_src() {
    return get_template_directory_uri() .'/images/placeholder.png';
}

/**
 * Returns data attributes for post sliders
 *
 * @since  2.0.0
 * @return array
 */
function athen_slider_data() {

    // Define main vars
    $attributes                         = array();
    $return                             = '';
    $attributes['auto-play']            = 'false';
    $attributes['buttons']              = 'false';
    $attributes['fade']                 = 'true';
    $attributes['loop']                 = 'true';
    $attributes['thumbnails-height']    = '60';
    $attributes['thumbnails-width']     = '60';

    // Apply filters for child theming
    $attributes = apply_filters( 'athen_slider_data', $attributes );

    // Turn array into HTML
    foreach ( $attributes as $key => $val ) {
        $return .= ' data-'. $key .'="'. $val .'"';
    }

    // Return
    echo $return;
}

/**
 * Return Array of CPT categoryy terms
 * 
 * @since Athen 1.0.0
 * @return Array 
 */

function athen_get_cpt_terms( $cat = '' ,  $filterBy = '', $arg = array() ){
    
    $objTerms = get_terms( $cat , array( 'hide_empty' => 0 ));
    
    $countTerms = count($objTerms);
    
    $keyword = $filterBy;
    
    $return = array();
    
    for( $i = 0 ; $i < $countTerms ; $i++){
        array_push( $return , $objTerms[$i]->$keyword ); 
    }
      
    return $return;
}


/**
 * Display Filter Buttons
 * 
 * @since Athen 1.0.0
 */
function athen_display_filter_btn( $cat, $key ){
    
    $slugs = athen_get_cpt_terms( $cat, $key );
    
    $output = "<div class='cpt-filter-container button-group filters-button-group'>";
    
    $output .= "<ul class='athen-filter'>";
    
    $output .= "<li class='button is-checked' data-filter='*'>show all</li>";
    
    foreach( $slugs as $Slug ){
        $minusDash = str_replace('-', " ", $Slug );
        $output .= "<li class='button' data-filter=.".$cat.'-'.$Slug."><a href='#' onclick='return false;'> $minusDash </a></li>";
    }
    
    $output .= "</ul>";
    
    $output .= "</div>";
    
    echo $output;       
}

/**
 * Sidebar Classes
 * 
 * @return String 
 * @since Athen 1.0.0
 */
function athen_sidebar_classes( ){
    
    $classes = '';
        
    if(is_home()){
        $classes .= ATHEN_NAME_THEME."-home-sidebar "; 
    }
    return $classes;
}

/**
 * Container Divs Classes
 * 
 * @return String
 * @since Athen 1.0.0
 */
function athen_wrap_classes( $div = '' ){
   
    $athen_std_theme = athen_global_obj();
    $post_id = $athen_std_theme->post_id;
    $post_type_check = get_post_meta($post_id, 'athen_post_container', true);
    
    
    $classes = "";
    
    if ( $div == 'main-wrap' ){
    
        $classes .= ATHEN_NAME_THEME."-main-wrap ";
    
    }elseif ( $div == 'main2-wrap' ) {
    
        $classes .= ATHEN_NAME_THEME."-main2-wrap ";
            
    }elseif ( $div == 'header-wrap') {
     
        $classes .= ATHEN_NAME_THEME."-header-wrap ";
        
    }elseif ( $div == 'section-wrap') {
     
        $classes .= ATHEN_NAME_THEME."-section-wrap ";
        
    }elseif ( $div == 'content-wrap') {
     
        $classes .= ATHEN_NAME_THEME."-content-wrap ";
        if ( $post_type_check == 'off' ){
            $classes .= 'full-width';
        }elseif( athen_get_mod('athen_bootstrap_container', true) || 
                athen_get_mod('athen_content_sidebar_container') ||
                $post_type_check == 'on' ){
                $classes .= 'container';
        }
        
    }elseif ( $div == 'posts-wrap' ) {
    
        $classes .= ATHEN_NAME_THEME."-posts-box ";
    
    }elseif ( $div == 'sidebar-wrap') {
        
        $classes .= ATHEN_NAME_THEME."-sidebar-box ";
        
        if(is_home()){
            $classes .= ATHEN_NAME_THEME."-home-sidebar "; 
        }
        
    }elseif ( $div == 'footer-wrap'){
        
        $classes .= ATHEN_NAME_THEME."-footer-wrap ";
    
    }elseif ( $div == 'footer-bottom-wrap') {
        
        $classes .= ATHEN_NAME_THEME."-footer-bottom ";
        
    } else {
        $classes .= 'Missing A Class Not Good';
    }
    
    return $classes;    
}



/**
 * Return Arrays of a post CPT category terms
 * 
 * @since 1.0.0
 * @return Array 
 */

function athen_get_post_cpt_terms( $post_id = '', $category = ''){
    
    $postObjTerms = get_the_terms( $post_id, $category );
    
    $countTerms = count($postObjTerms);
    
    $return = array();
    
    for( $i = 0 ; $i < $countTerms ; $i++ ){
     array_push($return, $postObjTerms[$i]->name );
    }
    
    return $return;
}

/*
 * Return Classes For Section 
 * Description : Use to layout section on page bade 
 *               base on header or layout.
 * 
 * @since 1.0.0
 * @return String
 */
function athen_section_classes(){
    
    // Get global object
    $athen_std_theme = athen_global_obj();
    
    $classes = '';
    
    $classes .= 'athen-section'. $athen_std_theme->headerstyle . '';
    return $classes;
}


/*
 * Return Excerpt of a specific post type
 * Description : Should be use in a wp query loop
 * 
 * @since 1.0.0
 * @return String
 */
function athen_custom_excerpt( $post_excerpt, $lengths = 100 ){

    if ( $post_excerpt ){
        $excerpt = wp_trim_words( $post_excerpt, $lengths);
    }
    return $excerpt;
}

$athen_std_theme = athen_global_obj(); 