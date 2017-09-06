<?php
/**
 * Description : Add more functionality to tiny mce area in editor 
 * 
 * @package     Athen
 * @subpackage  Closer - controller
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 */

// Only needed in the admin
if( ! is_admin() ) {
    return;
}

// Customize mce editor font sizes
if ( ! function_exists( 'athen_customize_text_sizes' ) ) {
    function athen_customize_text_sizes( $initArray ){
        $initArray['fontsize_formats'] = "9px 12px 14px 16px 18px 20px 22px ";
        return $initArray;
    }
}
add_filter( 'tiny_mce_before_init', 'athen_customize_text_sizes' );

// Add "Styles" / "Formats" (3.9+) drop-down
if ( ! function_exists( 'athen_style_select' ) ) {
    function athen_style_select( $buttons ) {
        array_push( $buttons, 'styleselect' );
		array_push( $buttons, 'fontsizeselect' );
		array_push( $buttons, 'fontselect' );
        return $buttons;
    }
}
add_filter( 'mce_buttons', 'athen_style_select' );