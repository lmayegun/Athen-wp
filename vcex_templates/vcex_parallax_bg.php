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
    'image_id1'     => '',
    'image_id2'     => '',
), $atts ) );

$image_id1;
var_dump(wp_get_attachment_image_url($image_id2));
var_dump(wp_get_attachment_image_url($image_id1));
$img = wp_get_attachment_image_url($image_id1);

?>

<section id="bottle">

<div class="parallax" data-velocity="-.1" style="background: url(<?php echo $img; ?>) 50% 0 no-repeat fixed;"></div>

</section>