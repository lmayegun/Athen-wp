<?php
/**
 * Description : Template to displaysearch form. 
 * 
 * @package     Athen
 * @subpackage  Closer - View
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 * Dependent : http://codex.wordpress.org/Template_Hierarchy
 */ 
?>

<form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="search" class="field" name="s" placeholder="<?php _e( 'search', 'athen_transl' ); ?>" />
    <button type="submit" class="searchform-submit">
		<span class="fa fa-search"></span>
	</button>
</form><!-- .searchform -->