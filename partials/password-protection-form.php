<?php
/**
 * Custom WordPress password protection form output
 *
 * @package		Total
 * @subpackage	Template Parts
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		2.0.0
 * @version		2.1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get global theme object
$athen_std_theme = athen_global_obj();

// Add label based on post ID
$label = 'pwbox-'.( empty( $athen_std_theme->post_id ) ? rand() : $athen_std_theme->post_id );

// Main classes
$classes = 'password-protection-box clr';

// Add container for full-screen layout to center it
if ( 'full-screen' == $athen_std_theme->post_layout ) {
	$classes .= ' container';
} ?>

<div class="<?php echo esc_attr( $classes ); ?>">
	<form action="<?php echo esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ); ?>" method="post">
		<h2><?php echo __( 'Password Protected', 'athen_transl' ); ?></h2>
		<p><?php echo __( 'This content is password protected. To view it please enter your password below:', 'athen_transl' ); ?></p>
		<input name="post_password" id="<?php echo $label; ?>" type="password" size="20" maxlength="20" placeholder="<?php echo __( 'Password', 'athen_transl' ); ?>" /><input type="submit" name="Submit" value="<?php echo esc_attr__( 'Submit', 'athen_transl' ); ?>" />
	</form>
</div>