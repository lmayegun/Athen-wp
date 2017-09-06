<?php
/**
 * Used to display the staff slider
 *
 * @package     Total
 * @subpackage  Partials/Portfolio
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       2.1.0
 * @version     2.1.0
 */

// Get attachments
$attachments = athen_get_gallery_ids( get_the_ID() );

// Check if lightbox is enabled
$lightbox_enabled = athen_gallery_is_lightbox_enabled() ? true : false;

 // Load lightbox skin stylesheet
if ( $lightbox_enabled ) {
	athen_enqueue_ilightbox_skin();
} ?>

<div class="staff-post-slider clr">

	<div class="wpex-slider-preloaderimg">
		<?php
		// Display first image as a placeholder while the others load
		athen_get_staff_post_thumbnail( array(
			'attachment' => $attachments[0],
			'alt'        => get_post_meta( $attachments[0], '_wp_attachment_image_alt', true ),
		) ); ?>
	</div><!-- .wpex-slider-preloaderimg -->

	<div class="wpex-slider slider-pro" <?php athen_slider_data(); ?>>

		<div class="wpex-slider-slides sp-slides <?php if ( $lightbox_enabled ) echo 'lightbox-group'; ?>">

			<?php
			// Loop through attachments
			foreach ( $attachments as $attachment ) : ?>

				<?php
				// Get attachment data
				$lightbox_url       = $lightbox_enabled ? athen_get_lightbox_image( $attachment ) : '';
				$attachment_data    = athen_get_attachment_data( $attachment );
				$attachment_alt     = $attachment_data['alt'];
				$attachment_video   = $attachment_data['video'];
				$attachment_caption = $attachment_data['caption'];

				// Get image output
				$attachment_html    = athen_get_blog_entry_thumbnail( array(
					'attachment'    => $attachment,
					'alt'           => $attachment_alt,
				) ); ?>

				<div class="wpex-slider-slide sp-slide">

					<?php
					// Display attachment video
					if ( $attachment_video && ! is_wp_error( $attachment_video = wp_oembed_get( $attachment_video ) ) ) : ?>

						<div class="wpex-slider-video responsive-video-wrap">
							<?php echo $attachment_video; ?>
						</div><!-- .wpex-slider-video -->

					<?php
					// Display attachment image
					else : ?>

						<div class="wpex-slider-media clr">

							<?php
							// Display with lightbox
							if ( $lightbox_enabled ) : ?>

								<a href="<?php echo $lightbox_url; ?>" title="<?php echo $attachment_alt; ?>" data-title="<?php echo $attachment_alt; ?>" data-type="image" class="lightbox-group-item"><?php echo $attachment_html; ?></a>

							<?php
							// Display single image
							else : ?>

								<?php echo $attachment_html; ?>

								<?php if ( $attachment_caption ) : ?>
									<div class="wpex-slider-caption sp-layer sp-black sp-padding clr" data-position="bottomCenter" data-show-transition="up" data-hide-transition="down" data-width="100%" data-show-delay="500">
										<?php echo $attachment_caption; ?>
									</div><!-- .wpex-slider-caption -->
								<?php endif; ?>

							<?php endif; ?>

						</div><!-- .wpex-slider-media -->

					<?php endif; ?>

				</div><!-- .wpex-slider-slide sp-slide -->

			<?php endforeach; ?>

		</div><!-- .wpex-slider-slides .sp-slides -->

		<div class="wpex-slider-thumbnails sp-thumbnails">

			<?php
			// Loop through attachments
			foreach ( $attachments as $attachment ) : ?>

				<?php
				// Display image thumbnail
				athen_blog_entry_thumbnail( array(
					'attachment'    => $attachment,
					'class'         => 'wpex-slider-thumbnail sp-thumbnail',
					'alt'           => get_post_meta( $attachments, '_wp_attachment_image_alt', true ),
				) ); ?>

			<?php endforeach; ?>

		</div><!-- .wpex-slider-thumbnails -->

	</div><!-- .wpex-slider .slider-pro -->

</div><!-- .gallery-format-post-slider -->