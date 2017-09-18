<?php

// Get globals
global $content_width;

// Set content width based on theme's default design
if ( ! isset( $content_width ) ) {
	$content_width = 980;
}

// Register navigation menus
register_nav_menus (
	array(
		'top_header_menu'   => __( 'Top Header', 'athen_transl' ),
		'main_menu'         => __( 'Main', 'athen_transl' ),
        'bottom_header_menu'=> __( 'Bottom Header', 'athen_transl' ),
		'mobile_menu_alt'   => __( 'Mobile Menu Alternative', 'athen_transl' ),
		'footer_menu'       => __( 'Footer', 'athen_transl' ),
		)
	);

// Load text domain
load_theme_textdomain( 'athen_transl', ATHEN_TEMPLATE_DIR .'/languages' );

// Enable some useful post formats for the blog
add_theme_support( 'post-formats', array( 'video', 'gallery', 'audio', 'quote', 'link' ) );

// Add automatic feed links in the header - for themecheck nagg
add_theme_support( 'automatic-feed-links' );
		
// Enable featured image support
add_theme_support( 'post-thumbnails' );
		
// And HTML5 support
add_theme_support( 'html5' );
		
// Enable excerpts for pages.
add_post_type_support( 'page', 'excerpt' );
		
// Add support for WooCommerce - Yay!
add_theme_support( 'woocommerce' );

// Add styles to the WP editor
add_editor_style( 'css/editor-style.css' );

// Title tag
add_theme_support( 'title-tag' );

function rewrite_rules() {
		
    flush_rewrite_rules();
  
}
add_action( 'after_switch_theme', 'rewrite_rules' );