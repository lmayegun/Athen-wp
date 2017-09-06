<?php
/**
 * Shortcodes in the TinyMCE
 *
 * @package		Total
 * @subpackage	Framework/Core
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link 		http://www.wpexplorer.com
 * @since		1.3.6
 * @version		2.1.2
 */

// Adds button to mce
if ( ! function_exists( 'total_shortcodes_add_mce_button' ) ) {
	function total_shortcodes_add_mce_button() {
		// check user permissions
		if ( ! current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
			return;
		}
		// check if WYSIWYG is enabled
		if ( 'true' == get_user_option( 'rich_editing' ) ) {
			add_filter( 'mce_external_plugins', 'total_shortcodes_add_tinymce_plugin' );
			add_filter( 'mce_buttons', 'total_shortcodes_register_mce_button' );
		}
	}
}
add_action('admin_head', 'total_shortcodes_add_mce_button');

// Loads js for the Button
if ( ! function_exists( 'total_shortcodes_add_tinymce_plugin' ) ) {
	function total_shortcodes_add_tinymce_plugin( $plugin_array ) {
		$plugin_array['total_shortcodes_mce_button'] = ATHEN_FRAMEWORK_DIR_URI .'post-types/shortcodes/tinymce.js';
		return $plugin_array;
	}
}

// Registers new button
if ( ! function_exists( 'total_shortcodes_register_mce_button' ) ) {
	function total_shortcodes_register_mce_button( $buttons ) {
		array_push( $buttons, 'total_shortcodes_mce_button' );
		return $buttons;
	}
}

/**
 * Allow shortcodes in widgets
 *
 * @since Total 1.3.3
 */
add_filter( 'widget_text', 'do_shortcode' );

/**
 * Fixes spacing issues with shortcodes
 *
 * @since Total 1.0.0
 */
if ( ! function_exists( 'athen_fix_shortcodes' ) ) {
	function athen_fix_shortcodes( $content ){
		$array = array (
			'<p>['		=> '[', 
			']</p>'		=> ']', 
			']<br />'	=> ']'
		);
		$content = strtr( $content, $array) ;
		return $content;
	}
}
add_filter( 'the_content', 'athen_fix_shortcodes' );

/**
 * Year shortcode
 *
 * @since Total 1.0.0
 */
if ( ! function_exists( 'athen_year_shortcode' ) ) {
	function athen_year_shortcode() {
		return date('Y');
	}
}
add_shortcode( 'current_year', 'athen_year_shortcode' );

/**
 * WPML Shortcode
 *
 * [wpml_translate lang=es]Hola[/wpml_translate]
 * [wpml_translate lang=en]Hello[/wpml_translate]
 *
 * @since Total 1.2.1
 */
if ( ! function_exists( 'athen_wpml_lang_translate_shortcode' ) ) {
	function athen_wpml_lang_translate_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'lang'	=> '',
		), $atts ) );
		$lang_active = ICL_LANGUAGE_CODE;
		if ( $lang == $lang_active ) {
			return do_shortcode($content);
		}
	}
}
add_shortcode( 'wpml_translate', 'athen_wpml_lang_translate_shortcode' );

/**
 * Font Awesome Shortcode
 *
 * @since Total 1.3.2
 */
if ( ! function_exists( 'athen_font_awesome_shortcode' ) ) {

	function athen_font_awesome_shortcode( $atts ) {

		extract( shortcode_atts( array (
			'icon'          => '',
			'link'          => '',
			'link_title'    => '',
			'margin_right'  => '',
			'margin_left'   => '',
			'margin_top'    => '',
			'margin_bottom' => '',
			'color'         => '',
			'size'          => '',
			'link'          => '',
		), $atts ) );

		// Sanitize vars
		$link       = $link ? esc_url( $link ) : '';
		$link_title = $link_title ? esc_attr( $link_title ) : '';

		// Generate inline styles
		$style = array();
		if ( $color ) {
			$style[] = 'color: #'. str_replace( '#', '', $color ) .';';
		}
		if ( $margin_left ) {
			$style[] = 'margin-left: '. intval( $margin_left ) .'px;';
		}
		if ( $margin_right ) {
			$style[] = 'margin-right: '. intval( $margin_right ) .'px;';
		}
		if ( $margin_top ) {
			$style[] = 'margin-top: '. intval( $margin_top ) .'px;';
		}
		if ( $margin_bottom ) {
			$style[] = 'margin-bottom: '. intval( $margin_bottom ) .'px;';
		}
		if ( $size ) {
			$style[] = 'font-size: '. intval( $size ) .'px;';
		}
		$style = implode( '', $style );

		if ( $style ) {
			$style = wp_kses( $style, array() );
			$style = ' style="' . esc_attr( $style) . '"';
		}

		// Display icon with link
		if ( $link ) {
			$output = '<a href="'. $link .'" title="'. $link_title .'"><i class="fa fa-'. $icon .'" '. $style .'></i></a>';
		}

		// Display icon without link
		else {
			$output = '<i class="fa fa-'. $icon .'" '. $style .'></i>';
		}

		// Return shortcode output
		return $output;

	}

}
add_shortcode( 'font_awesome', 'athen_font_awesome_shortcode' );

/**
 * Login Link
 *
 * @since Total 1.3.2
 */
if ( ! function_exists( 'athen_wp_login_url_shortcode' ) ) {

	function athen_wp_login_url_shortcode( $atts ) {

		extract( shortcode_atts( array(
			'login_url'			=> '',
			'text'				=> __( 'Login', 'athen_transl' ),
			'logout_text'		=> __( 'Log Out', 'athen_transl' ),
			'target'			=> 'blank',
			'logout_redirect'	=> '',
		), $atts ) );
		if ( 'blank' == $target ) {
			$target = 'target="_blank"';
		} else {
			$target = '';
		}
		if ( ! $login_url ) {
			$login_url = wp_login_url();
		}
		if ( ! $logout_redirect ) {
			$permalink = get_permalink();
			if ( $permalink ) {
				$logout_redirect = $permalink;
			} else {
				$logout_redirect = home_url();
			}
		}

		// Logged in link
		if ( is_user_logged_in() ) {
			return '<a href="'. wp_logout_url( $logout_redirect ) .'" title="'. $logout_text .'" class="wpex-logout" rel="nofollow">'. $logout_text .'</a>';
		}

		// Non-logged in link
		else {
			return '<a href="'. $login_url .'" title="'. $text .'" class="wpex-login" rel="nofollow" '. $target .'>'. $text .'</a>';
		}

	}

}
add_shortcode( 'wp_login_url', 'athen_wp_login_url_shortcode' );

/**
 * WPML Language Switcher
 *
 * @since Total 1.3.6
 */
if ( ! function_exists( 'athen_wpml_lang_switcher_shortcode' ) ) {
	function athen_wpml_lang_switcher_shortcode() {
		do_action( 'icl_language_selector' );
	}
}
add_shortcode( 'wpml_lang_selector', 'athen_wpml_lang_switcher_shortcode' );

/**
 * Polylang Language Switcher
 *
 * @since Total 1.4.0
 */
if ( ! function_exists( 'athen_polylang_switcher' ) ) {
	function athen_polylang_switcher( $atts ) {
		extract( shortcode_atts( array(
			'dropdown'		=> 'false',
			'show_flags'	=> 'true',
			'show_names'	=> 'false',
			'classes'		=> '',
		), $atts ) );
		if ( function_exists( 'pll_the_languages' ) ) {
			// Args
			$dropdown = 'true' == $dropdown ? true : false;
			$show_flags = 'true' == $show_flags ? true : false;
			$show_names = 'true' == $show_names ? true : false;
			if ( $dropdown ) {
				$show_flags = $show_names = false;
			}
			// Classes
			$classes = 'polylang-switcher-shortcode clr';
			if ( $show_names && !$dropdown ) {
				$classes .= ' flags-and-names';
			}
			// Display Switcher
			if ( ! $dropdown ) {
				echo '<ul class="'. $classes .'">';
			}
				// Display the switcher
				pll_the_languages( array(
					'dropdown'		=> $dropdown,
					'show_flags'	=> $show_flags,
					'show_names'	=> $show_names
				) );
			if ( ! $dropdown ) {
				echo '</ul>';
			}
		}
	}
}
add_shortcode( 'polylang_switcher', 'athen_polylang_switcher' );