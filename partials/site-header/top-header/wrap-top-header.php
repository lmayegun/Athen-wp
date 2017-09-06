<?php
/**
 * Header-Top social profiles
 *
 * @package		Total
 * @subpackage          Partials/Topbar
 * @author              Alexander Clarke
 * @copyright           Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		1.6.0
 * @version		1.0.2
 */
 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


$top_header_enable = athen_get_mod('athen_headertop_enable_topbar', true);

?>
<?php athen_hook_top_header_before(); ?>
<?php if ( $top_header_enable ): ?>
    <div id="header-top" class="<?php echo Athen_Header_Top::athen_header_top_classes('wrap') ;?> "> 
        <div class="athen-row <?php echo Athen_Header_Top::athen_header_top_classes('row') ;?> ">
            <?php athen_hook_top_header();  ?> 
        </div>
    </div>
<?php endif; ?>
<?php athen_hook_top_header_after(); ?>