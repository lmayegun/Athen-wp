<?php
/**
 * Output for the Image Gallery Slider Visual Composer module
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

extract( shortcode_atts( array(
    'unique_id'                 => '',
    'classes'                   => '',
    'image_ids'                 => '',
    'post_gallery'              => '',
    'visibility'                => '',
    'loop'                      => '',
    'animation'                 => 'slide',
    'slideshow'                 => 'true',
    'slideshow_speed'           => '5000',
    'height_animation'          => '500',
    'randomize'                 => 'false',
    'control_nav'               => '',
    'direction_nav'             => '',
    'direction_nav_hover'       => '',
    'pause_on_hover'            => 'true',
    'slideshow_speed'           => '7000',
    'animation_speed'           => '600',
    'pause_on_hover'            => 'true',
    'smooth_height'             => 'false',
    'thumbnail_link'            => '',
    'lightbox_skin'             => '',
    'lightbox_path'             => '',
    'lightbox_title'            => '',
    'lightbox_caption'          => '',
    'custom_links'              => '',
    'custom_links_target'       => '',
    'img_size'                  => '',
    'img_crop'                  => '',
    'img_width'                 => '',
    'img_height'                => '',
    'thumbnails_columns'        => '5',
    'img_thumb_width'           => '',
    'img_thumb_height'          => '',
    'caption'                   => 'true',
    'wrap_attributes'           => '',
    'css'                       => '',
    'caption_type'              => '',
    'caption_position'          => 'bottomCenter',
    'caption_show_transition'   => 'up',
    'caption_hide_transition'   => 'down',
    'caption_width'             => '100%',
    'caption_delay'             => '500',
    'preloader_img'             => 'true',
    'caption_horizontal'        => '',
    'caption_vertical'          => '',
    'caption_style'             => 'black',
    'caption_rounded'           => '',
    'caption_font_size'         => '',
    'caption_padding'           => '',
    'caption_visibility'        => '',
    'css'                       => '',
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
        $attachments = explode( ',', $image_ids );
    } else {
        $attachments = $image_ids;
    }

}

// Turn links into array
if ( $custom_links && 'custom_link' == $thumbnail_link ) {

    // Turn custom links into array
    $custom_links = explode( ',', $custom_links );

    // Display warning if there are more custom links then images
    if ( count( $custom_links ) > count( $attachments ) ) {
        _e( 'You have too many custom links and to few images', 'athen_transl' );
        return;
    }

    // Add empty values to custom_links array for images without links
    if ( count( $attachments ) > count( $custom_links ) ) {
      foreach( $attachments as $key => $value ) {
          if ( ! isset( $custom_links[$key] ) ) {
            $custom_links[] = NULL;
        }
      }
    }

    // Set links as the values for the images
    $attachments = array_combine( $attachments, $custom_links );

} else {
    $attachments = array_combine( $attachments, $attachments );
};

// Output gallery
if ( $attachments ) :

    // Load scripts
    $inline_js = array( 'slider_pro' );
    if ( 'lightbox' == $thumbnail_link ) {
        vcex_enque_style( 'ilightbox', $lightbox_skin );
        $inline_js[] = 'ilightbox';
    }
    vcex_inline_js( $inline_js );

    // Sanitize data and declare main vars
    $wrap_attributes    = array();
    $caption_attributes = array();
    $slideshow          = vc_is_inline() ? 'false' : $slideshow;
    $randomize          = ( 'true' == $randomize ) ? true : false;
    $caption            = ( 'false' == $caption ) ? false : true;
    $thumbnails_columns = $thumbnails_columns ? $thumbnails_columns : '5';

    // Slider attributes
    $wrap_attributes[] = 'data-thumbnails="true"';
    $wrap_attributes[] = 'data-thumbnail-height="auto"';
    if ( in_array( $animation, array( 'fade', 'fade_slides' ) ) ) {
        $wrap_attributes[] = 'data-fade="true"';
    }
    if ( $randomize ) {
        $wrap_attributes[] = 'data-shuffle="true"';
    }
    if ( 'true' == $loop ) {
        $wrap_attributes[] = 'data-loop="true"';
    }
    if ( 'false' == $slideshow ) {
        $wrap_attributes[] = 'data-auto-play="false"';
    }
    if ( $slideshow && $slideshow_speed ) {
        $wrap_attributes[] = 'data-auto-play-delay="'. $slideshow_speed .'"';
    }
    if ( 'false' == $direction_nav ) {
        $wrap_attributes[] = 'data-arrows="false"';
    }
    if ( 'false' == $control_nav ) {
        $wrap_attributes[] = 'data-buttons="false"';
    }
    if ( 'false' == $direction_nav_hover ) {
        $wrap_attributes[] = 'data-fade-arrows="false"';
    }
    if ( $animation_speed ) {
        $wrap_attributes[] = 'data-animation-speed="'. intval( $animation_speed ) .'"';
    }
    if ( $height_animation ) {
        $wrap_attributes[] = 'data-height-animation-duration="'. intval( $height_animation ) .'"';
    }

    // Caption attributes
    if ( $caption ) {

        // Caption attributes
        if ( $caption_position ) {
            $caption_attributes[] = ' data-position="'. $caption_position .'"';
        }
        if ( $caption_show_transition ) {
            $caption_attributes[] = ' data-show-transition="'. $caption_show_transition .'"';
        }
        if ( $caption_hide_transition ) {
            $caption_attributes[] = ' data-hide-transition="'. $caption_hide_transition .'"';
        }
        if ( $caption_width ) {
            $caption_attributes[] = ' data-width="'. vcex_sanitize_data( $caption_width, 'px-pct' ) .'"';
        }
        if ( $caption_horizontal ) {
            $caption_attributes[] = ' data-horizontal="'. intval( $caption_horizontal ) .'"';
        }
        if ( $caption_vertical ) {
            $caption_attributes[] = ' data-vertical="'. intval( $caption_vertical ) .'"';
        }
        if ( $caption_delay ) {
            $caption_attributes[] = ' data-show-delay="'. intval( $caption_delay ) .'"';
        }
        if ( empty( $caption_show_transition ) && empty( $caption_hide_transition ) ) {
            $caption_attributes[] = ' data-sp-static="false"';
        }
        $caption_attributes = implode( ' ', $caption_attributes );

        // Caption classes
        $caption_classes = array( 'wpex-slider-caption', 'sp-layer', 'sp-padding', 'clr' );
        if ( $caption_visibility ) {
            $caption_classes[] = $caption_visibility;
        }
        if ( $caption_style ) {
            $caption_classes[] = 'sp-'. $caption_style;
        }
        if ( 'true' == $caption_rounded ) {
            $caption_classes[] = 'sp-rounded';
        }
        $caption_classes = implode( ' ', $caption_classes );

        // Caption style
        $caption_inline_style = vcex_inline_style( array(
            'font_size' => $caption_font_size,
            'padding'   => $caption_padding,
        ) );

    }

    // Main Classes
    $wrap_classes = array( 'wpex-slider', 'slider-pro', 'no-margin-thumbnails', 'vcex-image-gallery-slider', 'clr' );
    if ( $classes ) {
        $wrap_classes[] = $this->getExtraClass( $classes );
    }
    if ( $visibility ) {
        $wrap_classes[] = $visibility;
    }
    if ( 'lightbox' == $thumbnail_link ) {
        $wrap_classes[] = ' lightbox-group';
        if ( $lightbox_skin ) {
            $wrap_attributes[] = 'data-skin="'. $lightbox_skin .'"';
            vcex_enque_style( 'ilightbox', $lightbox_skin );
        }
        if ( $lightbox_path ) {
            $wrap_attributes[] = 'data-path="'. $lightbox_path .'"';
        }
    }

    // Convert arrays to strings
    $wrap_classes       = implode( ' ', $wrap_classes );
    $wrap_attributes    = implode( ' ', $wrap_attributes ); ?>

    <?php
    // Open css wrapper
    if ( $css ) : ?>
        <div class="vcex-image-gallery-slider-css-wrap <?php echo apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css ), 'vcex_image_flexslider', $atts ); ?>">
    <?php endif; ?>

    <?php if ( 'false' != $preloader_img ) : ?>

        <div class="wpex-slider-preloaderimg">

            <?php athen_post_thumbnail( array(
                'attachment'    => reset( $attachments ),
                'size'          => $img_size,
                'crop'          => $img_crop,
                'width'         => $img_width,
                'height'        => $img_height,
            ) ); ?>

        </div><!-- .wpex-slider-preloaderimg -->

    <?php endif; ?>

    <div class="<?php echo $wrap_classes; ?>"<?php vcex_unique_id( $unique_id ); ?><?php echo $wrap_attributes; ?>>
        <div class="wpex-slider-slides sp-slides">

            <?php
            // Loop through attachments
            foreach ( $attachments as $attachment => $custom_link ) :
            
                // Attachment VARS
                $attachment_link    = get_post_meta( $attachment, '_wp_attachment_url', true );
                $attachment_data    = athen_get_attachment_data( $attachment );
                $caption_type       = $caption_type ? $caption_type : 'caption';
                $caption_output     = $attachment_data[$caption_type];
                $attachment_video   = wp_oembed_get( $attachment_data['video'] );
                $attachment_video   = athen_add_sp_video_to_oembed( $attachment_video );

                // Get and crop image if needed
                $attachment_img = athen_get_post_thumbnail( array(
                    'attachment'    => $attachment,
                    'size'          => $img_size,
                    'crop'          => $img_crop,
                    'width'         => $img_width,
                    'height'        => $img_height,
                    'alt'           => $attachment_data['alt'],
                ) ); ?>

                <div class="wpex-slider-slide sp-slide">

                    <div class="wpex-slider-media">

                        <?php if ( $attachment_video ) : ?>

                            <div class="wpex-slider-video responsive-video-wrap">
                                <?php echo $attachment_video; ?>
                            </div><!-- .wpex-slider-video -->

                        <?php else : ?>

                            <?php if ( 'lightbox' == $thumbnail_link ) { ?>

                                <a href="<?php athen_lightbox_image( $attachment ); ?>" title="<?php echo esc_attr( $attachment_data['alt' ] ); ?>" class="vcex-galleryslider-entry-img lightbox-group-item">
                                    <?php echo $attachment_img; ?>
                                </a>

                           <?php } elseif ( 'custom_link' == $thumbnail_link ) { ?>

                                <?php if ( '#' == $custom_link ) { ?>

                                        <?php echo $attachment_img; ?>

                                    <?php } else { ?>

                                        <a href="<?php echo esc_url( $custom_link ); ?>"<?php echo vcex_html( 'title_attr', $attachment_data['title'] ); ?><?php echo vcex_html( 'target_attr', $custom_links_target ); ?>>
                                            <?php echo $attachment_img; ?>
                                        </a>

                                    <?php } ?>

                            <?php } else { ?>

                                <?php echo $attachment_img; ?>

                            <?php } ?>

                        <?php endif; ?>

                        <?php if ( empty( $attachment_video ) && $caption && $caption_output ) : ?>

                            <div class="<?php echo $caption_classes; ?>"<?php echo $caption_attributes; ?><?php echo $caption_inline_style; ?>>

                                <?php if ( in_array( $caption_type, array( 'description', 'caption' ) ) ) : ?>
                                    <?php echo wpautop( $caption_output ); ?>
                                <?php else : ?>
                                    <?php echo $caption_output; ?>
                                <?php endif; ?>

                            </div><!-- .wpex-slider-caption -->

                        <?php endif; ?>

                    </div><!-- .wpex-slider-media -->

                </div><!-- .wpex-slider-slide -->

            <?php endforeach; ?>
            
        </div><!-- .wpex-slider-slides -->

        <div class="wpex-slider-thumbnails sp-thumbnails cols-<?php echo $thumbnails_columns; ?>">

            <?php foreach ( $attachments as $attachment => $custom_link ) : ?>

                <?php
                // Output thumbnail image
                athen_post_thumbnail( array(
                    'attachment'    => $attachment,
                    'size'          => 'athen_custom',
                    'width'         => $img_thumb_width,
                    'height'        => $img_thumb_height,
                    'class'         => 'wpex-slider-thumbnail sp-thumbnail',
                ) ); ?>

            <?php endforeach; ?>

        </div><!-- .wpex-slider-thumbnails -->

    </div><!-- .wpex-slider -->

    <?php
    // Close css wrapper
    if ( $css ) echo '</div>'; ?>

<?php endif; ?>