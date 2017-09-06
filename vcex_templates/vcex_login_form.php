<?php
/**
 * Output for the Login Form Visual Composer module
 *
 * @package     Total
 * @subpackage  vcex_templates
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
 * @version     2.0.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Not needed in admin ever.
if ( is_admin() ) return;

// Extract shortcode attributes
extract( shortcode_atts( array(
	'unique_id'		=> '',
	'redirect'		=> '',
	'classes'		=> '',
	'unique_id'		=> '',
	'css_animation'	=> '',
),
$atts ) );

// Get classes
$add_classes = 'vcex-login-form clr';
if ( $classes ) {
	$add_classes .= $this->getExtraClass( $classes );
}
if ( $css_animation ) {
	$add_classes .= $this->getCSSAnimation( $css_animation );
}

// Check if user is logged in
if ( is_user_logged_in() && ! athen_is_front_end_composer() ) :

	// Add logged in class
	$add_classes .= ' logged-in'; ?>

	<div class="<?php echo $add_classes; ?>" <?php vcex_unique_id( $unique_id ); ?>>
		<?php echo do_shortcode( $content ); ?>
	</div><!-- .vcex-login-form -->

<?php
// If user is not logged in display login form
else :

	// Redirection URL
	if ( $redirect == '' ) {
		$redirect = site_url( $_SERVER['REQUEST_URI'] );
	}
	
	// Form args
	$args = array(
		'echo'				=> true,
		'redirect'			=> $redirect,
		'form_id'			=> 'vcex-loginform',
		'label_username'	=> __( 'Username', 'athen_transl' ),
		'label_password'	=> __( 'Password', 'athen_transl' ),
		'label_remember'	=> __( 'Remember Me', 'athen_transl' ),
		'label_log_in'		=> __( 'Log In', 'athen_transl' ),
		'remember'			=> true,
		'value_username'	=> NULL,
		'value_remember'	=> false,
	); ?>

	<div class="<?php echo $add_classes; ?>" <?php vcex_unique_id( $unique_id ); ?>>
		<?php wp_login_form( $args ); ?>
	</div><!-- .vcex-login-form -->

<?php endif; ?>