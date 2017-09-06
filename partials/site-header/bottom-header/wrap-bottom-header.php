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

?>

<div id="header-bottom" class="<?php echo Athen_Header::athen_header_bottom_classes() ;?> "> 
    <?php athen_hook_bottom_header();  ?> 
</div>
