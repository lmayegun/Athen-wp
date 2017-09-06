<?php

///////***** HTML <head> *****/////
	
// Add meta viewport tag to header
add_action( 'wp_head', array( &$this, 'meta_viewport' ), 1 );

// Add meta viewport tag to header
add_action( 'wp_head', array( &$this, 'meta_edge' ), 0 );

// Loads CSS for ie8
add_action( 'wp_head', array( &$this, 'ie8_css' ) );

// Loads html5 shiv script
add_action( 'wp_head', array( &$this, 'html5_shiv' ) );

// Adds tracking code to the site head
add_action( 'wp_head', array( &$this, 'tracking' ) );

// Outputs custom CSS to the head
add_action( 'wp_head', array( &$this, 'custom_css' ), 9999 );
		
/////***** HTML </head> *****///// 
