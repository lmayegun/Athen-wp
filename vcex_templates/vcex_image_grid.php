<?php
/**
 * Output for the image grid Visual Composer module
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
    'unique_id'             => '',
    'classes'               => '',
    'visibility'            => '',
    'css_animation'         => '',
    'hover_animation'       => '',
    'columns'               => '4',
    'columns_gap'           => '',
    'responsive_columns'    => '',
    'image_ids'             => '',
    'post_gallery'          => '',
    'posts_per_page'        => '-1',
    'randomize_images'      => '',
    'img_filter'            => '',
    'grid_style'            => '',
    'rounded_image'         => '',
    'thumbnail_link'        => 'lightbox',
    'custom_links'          => '',
    'custom_links_target'   => '_self',
    'img_size'              => 'athen_custom',
    'img_crop'              => 'center-center',
    'img_width'             => '',
    'img_height'            => '',
    'title'                 => '',
    'title_type'            => 'title',
    'title_tag'             => 'div',
    'title_size'            => '',
    'title_color'           => '',
    'title_line_height'     => '',
    'title_margin'          => '',
    'title_weight'          => '',
    'title_transform'       => '',
    'img_hover_style'       => '',
    'overlay_style'         => '',
    'img_rendering'         => '',
    'lightbox_title'        => '',
    'lightbox_caption'      => '',
    'lightbox_skin'         => '',
    'lightbox_path'         => '',
    'is_isotope'            => false,
    'css'                   => '',
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

// Lets do some things now that we have images
if ( ! empty ( $attachment_ids ) ) :

    // Inline js to load
    $inline_js = array();

    // Turn links into array
    if ( $custom_links ) {
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
    $images_links_array = array_combine( $attachment_ids, $custom_links );

    // Pagination variables
    $posts_per_page = $posts_per_page ? $posts_per_page : '-1';
    $paged          = NULL;
    $no_found_rows  = true;
    if ( '-1' != $posts_per_page ) {
        if ( get_query_var( 'paged' ) ) {
            $paged = get_query_var( 'paged' );
        } elseif ( get_query_var( 'page' ) ) {
            $paged = get_query_var( 'page' );
        } else {
            $paged = 1;
        }
        $no_found_rows  = false;
    }


    // Randomize images
    if ( 'true' == $randomize_images ) {
        $orderby = 'rand';
    } else {
        $orderby = 'post__in';
    }

    // Lets create a new Query so the image grid can be paginated
    $my_query = new WP_Query(
        array(
            'post_type'         => 'attachment',
            //'post_mime_type'    => 'image/jpeg,image/gif,image/jpg,image/png',
            'post_status'       => 'any',
            'posts_per_page'    => $posts_per_page,
            'paged'             => $paged,
            'post__in'          => $attachment_ids,
            'no_found_rows'     => $no_found_rows,
            'orderby'           => $orderby,
        )
    );

    // Display images if we found some
    if ( $my_query->have_posts() ) :

        // Define isotope variable for masony and no margin grids
        if ( 'masonry' == $grid_style || 'no-margins' == $grid_style ) {
            $is_isotope = true;
        }

        // Output script for inline JS for the Visual composer front-end builder
        if ( $is_isotope ) {
            $inline_js[] = 'isotope';
        }

        // Load lightbox scripts
        if ( 'lightbox' == $thumbnail_link ) {
           vcex_enque_style( 'ilightbox', $lightbox_skin );
        }

        // Wrap Classes
        $wrap_classes = array( 'vcex-image-grid', 'wpex-row', 'clr' );
        $wrap_classes[] = 'grid-style-'. $grid_style;
        if ( $columns_gap ) {
            $wrap_classes[] = 'gap-'. $columns_gap;
        }
        if ( $is_isotope ) {
            $wrap_classes[] = 'vcex-isotope-grid no-transition';
        }
        if ( 'no-margins' == $grid_style ) {
            $wrap_classes[] = 'vcex-no-margin-grid';
        }
        if ( $img_rendering ) {
            $wrap_classes[] = athen_image_rendering_class( $img_rendering );
        }
        if ( 'lightbox' == $thumbnail_link ) {
            $wrap_classes[] = 'lightbox-group';
            $inline_js[] = 'ilightbox';
        }
        if ( 'yes' == $rounded_image ) {
            $wrap_classes[] = 'vcex-rounded-images';
        }
        if ( $classes ) {
            $wrap_classes[] = $this->getExtraClass( $classes );
        }
        if ( $visibility ) {
            $wrap_classes[] = $visibility;
        }
        $wrap_classes   = implode( ' ', $wrap_classes );

        // Wrap data attributes
        $wrap_data = '';
        if ( $is_isotope ) {
            $wrap_data .= ' data-transition-duration="0.0"';
        }
        if ( 'lightbox' == $thumbnail_link ) {
            if ( $lightbox_skin ) {
                $wrap_data .= ' data-skin="'. $lightbox_skin .'"';
            }
            if ( $lightbox_path ) {
                $wrap_data .= ' data-path="'. $lightbox_path .'"';
            }
            vcex_enque_style( 'ilightbox', $lightbox_skin ); // Load lightbox stylesheet
        }

        // Entry Classes
        $entry_classes = array( 'vcex-image-grid-entry' );
        if ( $is_isotope ) {
            $entry_classes[] = 'vcex-isotope-entry';
        }
        if ( 'no-margins' == $grid_style ) {
            $entry_classes[] = 'vcex-no-margin-entry';
        }
        if ( $columns ) {
            $entry_classes[] = 'athen-col-'. $columns;
        }
        if ( 'false' == $responsive_columns ) {
            $entry_classes[] = 'nr-col';
        } else {
            $entry_classes[] = 'col';
        }
        if ( $css_animation ) {
            $entry_classes[] = $this->getCSSAnimation( $css_animation );
        }
        if ( $hover_animation ) {
            $entry_classes[] = athen_hover_animation_class( $hover_animation );
            vcex_enque_style( 'hover-animations' );
        }
        $entry_classes = implode( ' ', $entry_classes );

        // Hover Classes
        $hover_classes = array();
        if ( $img_filter ) {
            $hover_classes[] = athen_image_filter_class( $img_filter );
        }
        if ( $img_hover_style ) {
            $hover_classes[] = athen_image_hover_classes( $img_hover_style );
        }
        $hover_classes = implode( ' ', $hover_classes );

        // Title style
        $title_style = vcex_inline_style( array(
            'font_size'         => $title_size,
            'color'             => $title_color,
            'text_transform'    => $title_transform,
            'line_height'       => $title_line_height,
            'margin'            => $title_margin,
            'font_weight'       => $title_weight,
        ) );

        // Load inline js for front-end editor
        if ( $inline_js ) {
            vcex_inline_js( $inline_js );
        } ?>

        <?php
        // Open CSS div
        if ( $css ) : ?>

            <div class="vcex-image-grid-css-wrapper <?php echo apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), 'vcex_image_grid', $atts ); ?>">
            
        <?php endif; ?>

        <div class="<?php echo $wrap_classes; ?>"<?php echo vcex_unique_id( $unique_id ); ?><?php echo $wrap_data; ?>>
            
            <?php
            $count=0;
            // Loop through images
            while ( $my_query->have_posts() ) :
            $count++;

                // Get post from query
                $my_query->the_post();

                // Create new post object.
                $post = new stdClass();

                // Get attachment ID
                $post->id = get_the_ID();

                // Attachment VARS
                $post->data             = athen_get_attachment_data( $post->id );
                $post->link             = $post->data['url'];
                $post->alt              = esc_attr( $post->data['alt'] );
                $post->title_display    = false;

                // Pluck array to see if item has custom link
                $post->url = $images_links_array[$post->id];

                // Validate URl
                $post->url = ( '#' !== $post->url ) ? $post->url : '';

                // Set image HTML since we'll use it a lot later on
                $post->thumbnail = athen_get_post_thumbnail( array(
                    'size'          => $img_size,
                    'attachment'    => $post->id,
                    'alt'           => $post->alt,
                    'width'         => $img_width,
                    'height'        => $img_height,
                    'crop'          => $img_crop,
                ) ); ?>

                <div class="id-<?php echo $post->id .' '. $entry_classes; ?> col-<?php echo $count; ?>">

                    <figure class="vcex-image-grid-entry-img">

                        <?php
                        // Open hover classes div
                        if ( ! empty( $hover_classes ) ) : ?>
                            <div class="<?php echo $hover_classes; ?>">
                        <?php endif; ?>

                            <?php
                            // Lightbox
                            if ( 'lightbox' == $thumbnail_link ) :

                                // Define lightbox vars
                                $lightbox_data  = array();
                                $lightbox_image = athen_get_lightbox_image( $post->id );
                                $lightbox_url   = $lightbox_image;
                                $video_url      = $post->data['video'];

                                // Data attributes
                                if ( 'false' != $lightbox_title ) {
                                    if ( 'title' == $lightbox_title ) {
                                        $lightbox_data[] = ' data-title="'. strip_tags( get_the_title( $post->id ) ) .'"';
                                    } else {
                                        $lightbox_data[] = ' data-title="'. $post->alt .'"';
                                    }
                                }

                                // Caption data
                                if ( 'false' != $lightbox_caption ) {
                                    if ( $attachment_caption = get_post_field( 'post_excerpt', $post->id ) ) {
                                        $lightbox_data[] = ' data-caption="'. str_replace( '"',"'", $attachment_caption ) .'"';
                                    }
                                }

                                // Video data
                                if ( $video_url ) {
                                    $video_embed_url    = athen_sanitize_data( $video_url, 'embed_url' );
                                    $lightbox_url       = $video_embed_url ? $video_embed_url : $video_url;
                                    if ( $video_embed_url ) {
                                        $lightbox_data[]    = ' data-type="iframe"';
                                        $smart_recognition  = '';
                                    } else {
                                        $smart_recognition = ',smartRecognition:true';
                                    }
                                    $lightbox_data[] = ' data-options="thumbnail:\''. $lightbox_image .'\',width:1920,height:1080'. $smart_recognition .'"';
                                }

                                // Set data type to image for non-video lightbox
                                else {
                                    $lightbox_data[] = ' data-type="image"';
                                } ?>

                                <?php
                                // Convert data attributes to array
                                $lightbox_data = ' '. implode( ' ', $lightbox_data); ?>

                                <a href="<?php echo $lightbox_url; ?>" title="<?php echo $post->alt; ?>" class="vcex-image-grid-entry-img lightbox-group-item"<?php echo $lightbox_data; ?>>
                                    <?php
                                    // Display image
                                    echo $post->thumbnail; ?>
                                    <?php
                                    // Video icon overlay
                                    if ( $video_url ) { ?>
                                        <div class="vcex-image-grid-video-overlay show-on-load rounded"><span class="fa fa-play"></span></div>
                                    <?php } ?>
                                </a><!-- .vcex-image-grid-entry-img -->

                            <?php
                            // Custom Links
                            elseif ( 'custom_link' == $thumbnail_link && $post->url ) : ?>

                                <a href="<?php echo esc_url( $post->url ); ?>" title="<?php echo $post->alt; ?>" class="vcex-image-grid-entry-img" target="<?php echo $custom_links_target; ?>">
                                    <?php
                                    // Display image
                                    echo $post->thumbnail; ?>
                                </a>

                            <?php
                            // Attachment page
                            elseif ( 'attachment_page' == $thumbnail_link ) : ?>

                                <a href="<?php echo the_permalink(); ?>" title="<?php echo $post->alt; ?>" class="vcex-image-grid-entry-img" target="<?php echo $custom_links_target; ?>">
                                    <?php
                                    // Display image
                                    echo $post->thumbnail; ?>
                                </a>

                            <?php
                            // Just the Image
                            else : ?>

                                 <?php
                                    // Display image
                                    echo $post->thumbnail; ?>

                            <?php endif; ?>

                        <?php
                        // Close hover classes div
                        if ( ! empty( $hover_classes ) ) echo '</div>'; ?>

                        <?php
                        // If title is enabled
                        if ( 'yes' == $title ) :

                            // Get correct title
                            if ( 'title' == $title_type ) {
                                $post->title_display = get_the_title();
                            } elseif ( 'alt' == $title_type ) {
                                $post->title_display = $post->alt;
                            } elseif ( 'caption' == $title_type ) {
                                $post->title_display = get_the_excerpt();
                            } elseif ( 'description' == $title_type ) {
                                $post->title_display = get_the_content();
                            } ?>

                            <?php
                            // Display title
                            if ( $post->title_display ) : ?>

                                 <figcaption class="vcex-image-grid-entry-title">
                                    <<?php echo $title_tag; ?><?php echo $title_style; ?>>
                                        <?php echo $post->title_display; ?>
                                    </<?php echo $title_tag; ?>
                                </figcaption>

                            <?php endif; ?>
                        
                        <?php endif; ?>

                    </figure>

                </div><!--. vcex-image-grid-entry -->
                
                <?php
                // Clear counter
                if ( $count == $columns ) {
                    $count = 0;
                }
            
            // End while loop
            endwhile; ?>

        </div><!-- .vcex-image-grid -->

        <?php
        // Close CSS div
        if ( $css ) echo '</div><!-- css wrapper -->'; ?>

        <?php
        // Paginate Posts
        if ( '-1' != $posts_per_page ) : ?>
           <?php athen_pagination( $my_query ); ?>
        <?php endif; ?>

        <?php
        // Remove post object from memory
        $post = null;

        // Reset the post data to prevent conflicts with WP globals
        wp_reset_postdata(); ?>

        <?php
        // End Query
        endif; ?>           

<?php
// End image check
endif; ?>