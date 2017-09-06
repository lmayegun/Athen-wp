<?php
/**
 * Main Header Layout Output
 * Have a look at framework/hooks/actions to see what is hooked into the header
 * See all header parts at partials/header/
 *
 * @package		Total
 * @subpackage	Partials/Header
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		1.6.0
 * @version		2.1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

 ?>

<header id="site-header" class="<?php echo Athen_Header::athen_header_classes( "header-outer" ); ?>" role="banner">
	
	<?php athen_display_top_header(); ?>
	
     <?php athen_hook_main_header_before(); ?>
	<div id="site-header-inner" class="<?php echo Athen_Header::athen_header_classes( "header-main" ); ?>">
               
		<div class="<?php echo Athen_Header::athen_header_classes( "container" ); ?>">
			<?php athen_hook_main_header(); ?>
		</div>
		
    </div><!-- #site-header-inner -->
    <?php athen_hook_main_header_after(); ?>

	<?php athen_display_bottom_header(); ?>

</header><!-- #header -->

