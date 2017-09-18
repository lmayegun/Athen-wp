<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Not needed in admin ever.
if ( is_admin() ) return;

extract( shortcode_atts(array(
    'image_id1'     	=> 'gggg',
    'image_id2'     	=> '',
    'classes'			=> '', 
    'visibilty'			=> '',
    'css_animation'		=> '',
    'hover_animation'	=> '',
    'url'				=> '',
    'content'			=> '',
    'title'				=> '',
    'target'			=> '',
    'rel'				=> '',
    'style'				=> '',
    'layout'			=> '',
    'align'				=> '',
    'color'				=> '',
    'custom_background'	=> '',
    'custome_hover_background' => '',
    'custom_color'		=> '',
    'size'				=> '',
    'font_family'		=> '',
    'font_size'			=> '',
    'letter_spacing'	=> '',
    'text_transform'	=> '',
    'font_weight'		=> '',
    'width'				=> '',
    'border_radius'		=> '',
    'font_padding'		=> '',
), $atts ) );

$image_id1;
//var_dump(wp_get_attachment_image_url($image_id2));
//var_dump(wp_get_attachment_image_url($image_id1, 'full'));

print_r($atts);
$img 	= wp_get_attachment_image_url($image_id1, "full");
$img2 	= wp_get_attachment_image_url($image_id2, "full");

?>

<!--<div id="parallax-container">

<div class="parallax" data-velocity="-.1" style="background: url(<?php echo $img; ?>) 50% 0 no-repeat fixed;"></div>

<div class="parallax-bg" data-velocity="-.5" style="background: url(<?php echo $img2; ?>) 50% 0 no-repeat fixed;"></div>

</div>-->