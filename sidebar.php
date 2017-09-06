<?php
/**
 * Description : Template use for sidebar content - display all widget added to sidebar. 
 * 
 * @package     Athen
 * @subpackage  Closer - View
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 * Dependent : framework/hooks/action (for all hooks attach to sidebar).
 *              
 */ 
?>

<?php athen_hook_sidebar_before(); ?>

<aside id="sidebar" class=" sidebar-wrap sidebar-primary <?php echo athen_wrap_classes( 'sidebar-wrap' ); ?>">

	<?php athen_hook_sidebar_top(); ?>

	<div id="sidebar-inner" class="sidebar-row clr">

		<?php athen_hook_sidebar_inner(); ?>

	</div><!-- #sidebar-inner -->

	<?php athen_hook_sidebar_bottom(); ?>

</aside><!-- #sidebar -->

<?php athen_hook_sidebar_after(); ?>