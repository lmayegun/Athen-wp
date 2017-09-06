<?php
/**
 * Staff single media template part
 *
 * @package     Total
 * @subpackage  Partials/Staff
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       1.6.0
 * @version     2.1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get portfolio attachment ( gallery images )
$attachments = athen_get_gallery_ids( get_the_ID() );

// Get portfolio thumbnail
$thumbnail = athen_get_staff_post_thumbnail();

if ( $attachments || $thumbnail ) : ?>

	<div id="staff-single-media" class="clr">

		<?php if ( $attachments ) : ?>
			<?php get_template_part( 'partials/staff/staff-single-gallery' ); ?>
		<?php elseif( $thumbnail ) : ?>
			<a href="<?php athen_lightbox_image(); ?>" title="<?php athen_esc_title(); ?>" class="wpex-lightbox">
				<?php echo $thumbnail; ?>
			</a>
		<?php endif; ?>
	</div><!-- .staff-entry-media -->

<?php endif; ?>