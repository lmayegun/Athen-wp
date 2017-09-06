<?php
/**
 * Output for the Image Carousel Visual Composer module
 *
 * @package     Total
 * @subpackage  vcex_templates
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
 * @version     2.1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Not needed in admin ever
if ( is_admin() ) {
    return;
}

// Extract shortcode attributes
extract( shortcode_atts( array(
    'unique_id'                 => '',
    'classes'                   => '',
    'style'                     => '',
    'image_ids'                 => '',
    'post_gallery'              => '',
    'randomize_images'          => '',
    'center'                    => 'false',
    'timeout_duration'          => '5000',
    'items'                     => '4',
    'items_margin'              => '15',
    'infinite_loop'             => 'true',
    'items_scroll'              => '1',
    'auto_play'                 => 'false',
    'arrows'                    => 'true',
    'dots'                      => '',
    'thumbnail_link'            => '',
    'gallery_lightbox'          => '',
    'custom_links'              => '',
    'custom_links_target'       => '',
    'img_size'                  => '',
    'img_crop'                  => '',
    'img_width'                 => '',
    'img_height'                => '',
    'title'                     => 'false',
    'title_type'                => 'title',
    'img_filter'                => '',
    'rounded_image'             => '',
    'img_hover_style'           => '',
    'img_rendering'             => '',
    'caption'                   => 'false',
    'content_background'        => '',
    'content_heading_margin'    => '',
    'content_heading_weight'    => '',
    'content_heading_transform' => '',
    'content_margin'            => '',
    'content_font_size'         => '',
    'content_padding'           => '',
    'content_border'            => '',
    'content_color'             => '',
    'content_opacity'           => '',
    'content_heading_color'     => '',
    'content_heading_size'      => '',
    'content_alignment'         => '',
    'tablet_items'              => '3',
    'mobile_landscape_items'    => '2',
    'mobile_portrait_items'     => '1',
    'lightbox_skin'             => '',
), $atts ) );

// Set image ids
$image_ids = ( 'true' == $post_gallery ) ? athen_get_gallery_ids() : $image_ids;

// If there aren't any images lets display a notice
if ( empty( $image_ids ) ) {
    echo '<div class="vc-module-notice">'. __( 'Please select some images.', 'athen_transl' ) .'</div>';
    return;
}

// Otherwise if there are images lets turn it into an array
else {

    // Get image ID's
    if ( ! is_array( $image_ids ) ) {
        $attachment_ids = explode( ',', $image_ids );
    } else {
        $attachment_ids = $image_ids;
    }

}

// Get & sanitize variables
$gallery_lightbox = false;

// Turn links into array
if ( $custom_links && 'custom_link' == $thumbnail_link ) {
    $custom_links = explode( ',', $custom_links );
} else {
    $custom_links = array();
}

// Display warning if there are more custom links then images
if ( count( $custom_links ) > count( $attachment_ids ) ) {
    _e( 'You have too many custom links and to few images', 'athen_transl' );
    return;
}

// Add empty values to custom_links array for images without links
if ( count( $attachment_ids ) > count( $custom_links ) ) {
  foreach( $attachment_ids as $key => $value ) {
      if ( ! isset( $custom_links[$key] ) ) {
        $custom_links[] = NULL;
    }
  }
}

// Set links as the keys for the images
$images = array();
$images = array_combine( $attachment_ids, $custom_links );

// Randomize images and preserve keys
if ( 'true' == $randomize_images ) {
    $shuffled_images    = array();
    $keys               = array_keys( $images );
    shuffle( $keys );
    foreach( $keys as $key ) {
        $shuffled_images[$key] = $images[$key];
        unset( $images[$key] );
    }
    $images = $shuffled_images;
} 

// Image Classes
$img_classes = array( 'wpex-carousel-entry-media', 'clr' );
if ( 'yes' == $rounded_image ) {
    $img_classes[] = ' vcex-rounded-images';
}
if ( $img_filter ) {
    $img_classes[] = athen_image_filter_class( $img_filter );
}
if ( $img_hover_style ) {
    $img_classes[] = athen_image_hover_classes( $img_hover_style );
}
$img_classes = implode( ' ', $img_classes );

// Lightbox links
if ( 'lightbox' == $thumbnail_link ) {
    vcex_enque_style( 'ilightbox', $lightbox_skin );
    $lightbox_data = ' data-type="image"';
    if ( $lightbox_skin ) {
        $lightbox_data .= ' data-skin="'. $lightbox_skin .'"';
        vcex_enque_style( 'ilightbox', $lightbox_skin );
    }
}

// Display carousel if there are images
if ( $images ) :

    // Output js for front-end editor
    $inline_js = array( 'carousel' );
    if ( 'lightbox' == $thumbnail_link ) {
        $inline_js[] = 'ilightbox';
    }
    vcex_inline_js( $inline_js );

    // Prevent auto play in visual composer
    if ( athen_is_front_end_composer() ) {
        $auto_play = 'false';
    }

    // Item Margin
    if ( 'no-margins' == $style ) {
        $items_margin = '0';
    }

    // Items to scroll fallback for old setting
    if ( 'page' == $items_scroll ) {
        $items_scroll = $items;
    }
    
    // Unique ID
    if ( $unique_id ) {
        $unique_id = ' id="'. $unique_id .'"';
    }

    // Title design
    if ( 'yes' == $title ) {
        $heading_style = vcex_inline_style( array(
            'margin'            => $content_heading_margin,
            'text_transform'    => $content_heading_transform,
            'font_weight'       => $content_heading_weight,
            'font_size'         => $content_heading_size,
            'color'             => $content_heading_color,
        ) );
    }

    // Content Design
    if ( 'yes' == $title || 'yes' == $caption ) {
        $content_style = vcex_inline_style( array(
            'background'    => $content_background,
            'padding'       => $content_padding,
            'margin'        => $content_margin,
            'border'        => $content_border,
            'font_size'     => $content_font_size,
            'color'         => $content_color,
            'opacity'       => $content_opacity,
            'text_align'    => $content_alignment,
        ) );
    }

    // Main Classes
    $wrap_classes = array( 'wpex-carousel', 'wpex-carousel-images', 'clr', 'owl-carousel' );
    if ( $style ) {
        $wrap_classes[] = $style;
    }
    if ( $img_rendering ) {
        $wrap_classes[] = athen_image_rendering_class( $img_rendering );
    }
    if ( $classes ) {
        $wrap_classes[] = $this->getExtraClass( $classes );
    }
    $wrap_classes = implode( ' ', $wrap_classes ); ?>

    <div class="<?php echo esc_attr( $wrap_classes ); ?>"<?php echo $unique_id; ?> data-items="<?php echo $items; ?>" data-slideby="<?php echo $items_scroll; ?>" data-nav="<?php echo $arrows; ?>" data-dots="<?php echo $dots; ?>" data-autoplay="<?php echo $auto_play; ?>" data-loop="<?php echo $infinite_loop; ?>" data-autoplay-timeout="<?php echo $timeout_duration ?>" data-center="<?php echo $center; ?>" data-margin="<?php echo intval( $items_margin ); ?>" data-items-tablet="<?php echo $tablet_items; ?>" data-items-mobile-landscape="<?php echo $mobile_landscape_items; ?>" data-items-mobile-portrait="<?php echo $mobile_portrait_items; ?>">
        
        <?php
        // Loop through images
        foreach ( $images as $image => $url ) :
        
            // Define and sanitize variables
            $attachment_data    = athen_get_attachment_data( $image );
            $attachment_alt     = esc_attr( $attachment_data['alt'] );
            $attachment_caption = $attachment_data['caption'];

            // Get correct title
            if ( 'title' == $title_type ) {
                $attachment_title = $attachment_data['title'];
            } elseif ( 'alt' == $title_type ) {
                $attachment_title = esc_attr( $attachment_data['alt'] );
            }
            
            // Image output
            $image_output = athen_get_post_thumbnail( array(
                'attachment'    => $image,
                'img_crop'      => $img_crop,
                'size'          => $img_size,
                'width'         => $img_width,
                'height'        => $img_height,
                'alt'           => $attachment_alt,
            ) ); ?>

            <div class="wpex-carousel-slide">

                <div class="<?php echo $img_classes; ?>">

                    <?php
                    // Lightbox
                    if ( 'lightbox' == $thumbnail_link ) { ?>

                        <a href="<?php athen_lightbox_image( $image ); ?>" title="<?php echo esc_attr( $attachment_alt ); ?>" class="wpex-carousel-entry-img wpex-lightbox"<?php echo $lightbox_data; ?>>
                            <?php echo $image_output; ?>
                        </a><!-- .wpex-carousel-entry-img -->

                    <?php }
                    // Custom Link
                    elseif ( 'custom_link' == $thumbnail_link && $url && '#' != $url ) { ?>
                        <a href="<?php echo esc_url( $url ); ?>" title="<?php echo esc_attr( $attachment_alt ); ?>" class="wpex-carousel-entry-img"<?php vcex_html( 'target_attr', $custom_links_target ); ?>>
                            <?php echo $image_output; ?>
                        </a>
                    <?php }

                    // No link
                    else {
                        echo $image_output;
                    } ?>

                </div><!-- .wpex-carousel-entry-media -->

                <?php
                // Display details
                if ( ( 'yes' == $title && $attachment_title ) || (  'yes' == $caption && $attachment_caption ) ) : ?>

                    <div class="wpex-carousel-entry-details clr"<?php echo $content_style; ?>>

                        <?php
                        // Display title
                        if ( 'yes' == $title && $attachment_title ) : ?>
                            <div class="wpex-carousel-entry-title"<?php echo $heading_style; ?>><?php echo $attachment_title; ?></div>
                        <?php endif; ?>

                        <?php
                        // Display caption
                        if ( 'yes' == $caption && $attachment_caption ) : ?>
                            <div class="wpex-carousel-entry-excerpt"><?php echo $attachment_caption; ?></div>
                        <?php endif; ?>
                    
                    </div><!-- .wpex-carousel-entry-details -->

                <?php endif; ?>

            </div><!-- .wpex-carousel-slide -->

        <?php endforeach; ?>

    </div><!-- .wpex-carousel -->

<?php endif; ?>