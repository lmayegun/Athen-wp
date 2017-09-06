<?php
/**
 * Portfolio entry content template part
 *
 * @package		Total
 * @subpackage	Partials/Portfolio
 * @author		Alexander Clarke
 * @copyright	Copyright (c) 2015, WPExplorer.com
 * @link		http://www.wpexplorer.com
 * @since		1.6.0
 * @version		1.0.1
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cat = athen_list_post_terms( 'category', true, false );

?>

<?php if($cat): ?>
<div class="blog-entry-terms clr">
    <h4 class="title"> Category </h4>
    <div class="entry-category-label">
        <?php athen_list_post_terms( 'category', true, true ); ?>
    </div>  
</div>
<?php endif; ?>