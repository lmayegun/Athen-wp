<?php
/**
 * Header aside content used in Header Style Two, Three and Four
 *
 * @package		Total
 * @subpackage	Partials/Header
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		1.6.0
 * @version		2.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get global object
$athen_std_theme = athen_global_obj();

// Get header style
$header_style = $athen_std_theme->header_style;

// Get header aside content
$content = Athen_Header::athen_header_aside_mod();

// WPML translations
$copyright = athen_translate_theme_mod( 'header_aside', $content );

// Check if we should display the header aside
if ( $content || in_array( $header_style, array( 'one', 'two') )) :

	// Add classes
	$classes = 'clr';
	if ( $header_style ) {
		$classes .= ' header-main-free-txt';
	} ?>

	<aside id="header-aside" class="<?php echo $classes; ?>">

		<div class="header-aside-content clr">

			<?php echo do_shortcode( $content ); ?>

		</div><!-- .header-aside-content -->
		
		<?php 
		// Show Icons for Header Style 2
		if ( 'two' == $header_style ) {
			get_template_part('partials/header/header-social');
		}?>
		
		
		
		<?php
		// Show header search field if enabled in the theme options panel and it's header style 2
		if ( athen_get_mod( 'main_search', true ) && 'not yet' == $header_style ) : ?>

			<div id="header-two-search" class="clr">

				<form method="get" class="header-two-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
					<input type="search" id="header-two-search-input" name="s" value="<?php _e( 'search', 'athen_transl' ); ?>" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/>
					<button type="submit" value="" id="header-two-search-submit" />
						<span class="fa fa-search"></span>
					</button>
				</form><!-- #header-two-searchform -->

			</div><!-- #header-two-search -->

		<?php endif; ?>

	</aside><!-- #header-two-aside -->

<?php endif; ?>