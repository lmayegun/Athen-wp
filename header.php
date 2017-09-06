<?php
/**
 * File Description : The template display header for theme.
 * 
 * @package     Athen
 * @subpackage  Closer - View
 * @since       Closer 1.0.0
 * @version     1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 * Dependant : framework/hooks/actions (for all hooks to header). 
 *             partials/header (for display modification).
 */ 
?>
 
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<!-- Begin Body -->
<body 
<?php body_class(); ?>>

<?php athen_outer_wrap_before(); ?>

    <div id="athen-main-capsule" class="<?php echo athen_wrap_classes( 'main-wrap' ); ?> clr" >

	<?php athen_hook_wrap_before(); ?>

	<div id="athen-alt-capsule" class="athen-alt-capsule <?php echo athen_wrap_classes( 'main2-wrap' ); ?> clr">
        
        <?php athen_hook_site_header_before(); ?>
        
            <?php athen_display_site_header(); ?>
        
        <?php athen_hook_site_header_after(); ?>

		<?php athen_hook_main_before(); ?>

		<?php athen_hook_main_top(); ?>