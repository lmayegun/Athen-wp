<?php
/**
 * Topbar social profiles
 *
 * @package		Total
 * @subpackage	Partials/Topbar
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		1.6.0
 * @version		1.0.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get social options array
$social_options = athen_topbar_social_options();

// Return if $social_options array is empty
if ( empty( $social_options ) ) {
	return;
}

// Set defaults
$defaults = array(
	'twitter'		=> 'twitter.com',
	'facebook'		=> 'facebook.com',
	'pinterest'		=> 'pinterest.com',
	'linkedin'		=> 'linkedin.com',
	'instagram'		=> 'instagram.com',
	'googleplus'	=> 'googleplus.com',
	'rss'			=> 'feedburner.com',
);

// Return if there aren't any profiles defined
if( ! $profiles = athen_get_mod( 'athen_social_profiles', $defaults ) ) {
	return;
}

// Get theme mods
$style				= athen_get_mod( 'athen_social_style', 'font_icons' );
$colored_icons_url	= get_template_directory_uri() .'/images/social';
$link_target		= athen_get_mod( 'athen_social_target', 'blank' );

// Define filter to alter the URL for the top bar social icon images
$colored_icons_url	= apply_filters( 'top_bar_social_img_url', $colored_icons_url );?>

<div id="top-bar-social" class="clr social-icons <?php echo $classes; ?> social-style-<?php echo $style; ?>">
	<?php
	// Loop through social options
	foreach ( $social_options as $key => $val ) : ?>
		<?php
		// Get URL from the theme mods
		$url = isset( $profiles[$key] ) ? $profiles[$key] : '';
		// Display if there is a value defined
		if ( $url ) {
			// Escape URL except for the following keys
			if ( ! in_array( $key, array( 'skype', 'email' ) ) ) {
				$url = esc_url( $url );
			} ?>
			<a href="<?php echo $url; ?>" title="<?php echo $val['label']; ?>" target="_<?php echo $link_target; ?>">
			<?php
			// Font Icon
			if ( $style == 'font_icons' ) { ?>
				<span class="<?php echo $val['icon_class']; ?>"></span>
			<?php }
			// Img Icons
			if ( $style == 'colored-icons' ) { ?>
				<img src="<?php echo $colored_icons_url; ?>/<?php echo $key; ?>.png" alt="<?php echo $val['label']; ?>" />
			<?php } ?>
			</a>
		<?php } ?>
	<?php endforeach; ?>
</div><!-- #top-bar-social -->