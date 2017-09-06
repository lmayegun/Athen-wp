<?php
/**
 * Description : Class use to modify search function of theme 
 * 
 * @package     Athen
 * @subpackage  Closer - controller
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 */

class Athen_Search_Func{
	
	public function __construct(){
		
		add_filter( 'wp_nav_menu_items', array(&$this,'athen_add_search_to_menu'), 1 , 2 );
		
	}
	
	/**
	 * Check if search icon should be in the nav
	 *
	 * @since   Total 1.0.0
	 * @return  bool
	 */

    public static function athen_search_in_menu() {

        // Get global object
        $obj = athen_global_obj();

        // Return false by default
        $return = false;

        // Always return true for the header style 2, we can hide via CSS
        if ( 'two' == $obj->header_style ) {
            $return = true;
        }
		
		if ( 'three' == $obj->header_style ) {
            $return = false;
        }

        // Return true if enabled via the Customizer
        elseif ( athen_get_mod( 'main_search', true ) ) {
            $return = true;
        }

        // Apply filters
        $return = apply_filters( 'athen_search_in_menu', $return );

        // Return
        return $return;

    }
	
	/**
	 * Get Correct header search style
	 *
	 * @since Total 1.0.0
	 */

    public function athen_header_search_style() {

        // Return if search disabled form the menu
        if ( ! Athen_Search_Func::athen_search_in_menu() ) {
            return;
        }

        // Get search style from Customizer
        $style = athen_get_mod( 'athen_search_toggle_style', 'drop_down' );

        // Apply filters for advanced edits
        $style = apply_filters( 'athen_header_search_style', $style );

        // Sanitize output so it's not empty
        $style = $style ? $style : 'drop_down';

        // Return style
        return $style;

    }
	
	/**
	 * Adds the search icon to the menu items
	 *
	 * @since   Total 1.0.0
	 * @return  bool
	 */

    public function athen_add_search_to_menu ( $items, $args ) {

        // Only used on main menu
        if ( 'main_menu' != $args->theme_location ) {
            return $items;
        }

        // Get global object
        $obj = athen_global_obj();

        // Return if disabled
        if ( ! $obj->header_search_style ) {
            return $items;
        }
		
		// Disable if header is one 
		if ('one' == $obj->header_style){
			return $items;
		}
        
        // Get correct search icon class
        if ( 'overlay' == $obj->header_search_style ) {
            $class = ' search-overlay-toggle';
        } elseif ( 'drop_down' == $obj->header_search_style ) {
            $class = ' search-dropdown-toggle';
        } elseif ( 'header_replace' == $obj->header_search_style ) {
            $class = ' search-header-replace-toggle';
        }

        // Add search item to menu
        $items .= '<li class="search-toggle-li" style="float:left !important;">';
            $items .= '<a href="#" class="site-search-toggle'. $class .'">';
                $items .= '<span class="link-inner">';
                    $items .= '<span class="fa fa-search"></span>';
                $items .= '</span>';
            $items .= '</a>';
        $items .= '</li>';
        
        // Return nav $items
        return $items;

    }
		
	/**
	 * Search Dropdown
	 *
	 * @since 1.0.0
	 */
	public static function athen_header_search_placeholder() {

		// Get global object
		$obj = athen_global_obj();

		// Default
		$return = __( 'Search', 'athen_transl' );

		// Overlay
		if ( 'overlay' == $obj->header_search_style ) {
			$return = __( 'Search', 'athen_transl' );
		}

		// Header Overlay
		if ( 'header_replace' == $obj->header_search_style ) {
			$return = __( 'Type then hit enter to search...', 'athen_transl' );
		}

		// Apply filters
		$return = apply_filters( 'athen_search_placeholder_text', $return );

		// Return
		return $return;
	}
	
	/**
	 * Add Search Icon to header_social 
	 *
	 * @since 1.0.0
	 * Return Array
	**/
	public function search_icon () {
		
		// Checker 
		$get = false; 
		
		// Get Global Object 
		$obj = athen_global_obj();
		
		// Get Header Style 
		$header_style = $obj->header_style;
		
		if ( in_array($header_style, array('one', 'three'))){
			$get = true; 		
		}  
		
		// Get correct search icon class
			if ( 'overlay' == $obj->header_search_style ) {
				$class = ' search-overlay-toggle';
			} elseif ( 'drop_down' == $obj->header_search_style ) {
				$class = ' search-dropdown-toggle';
			} elseif ( 'header_replace' == $obj->header_search_style ) {
				$class = ' search-header-replace-toggle';
			}
		
		if ($get){
			
			$icon .= '<a href="#" class= "site-search-toggle '.$class.' ">';
				$icon .= '<span class="fa fa-search">';
				$icon .= '</span>';
			$icon .= '</a>';
		}
		
		return $icon;
	}
}



/**
 * Adds a hidden searchbox in the footer for use with the mobile menu
 *
 * @since Total 1.5.1
 */
if ( ! function_exists( 'athen_mobile_searchform' ) ) {
    function athen_mobile_searchform() {

        // Make sure the mobile search is enabled for the sidr nav other wise return
        if ( function_exists( 'athen_mobile_menu_source' ) ) {
            $sidr_elements = athen_mobile_menu_source();
            if ( isset( $sidr_elements ) && is_array( $sidr_elements ) ) {
                if ( ! isset( $sidr_elements['search'] ) ) {
                    return;
                }
            }
        }

        // Output the search
        $placeholder = apply_filters( 'athen_mobile_searchform_placeholder', __( 'Search', 'athen_transl' ) );

        // Add Classes
        $classes = 'clr hidden';
        if ( 'toggle' == athen_get_mod( 'mobile_menu_style' ) ) {
            $classes .= ' container';
        } ?>

        <div id="mobile-menu-search" class="<?php echo $classes; ?>">
            <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search" class="mobile-menu-searchform">
                <input type="search" name="s" autocomplete="off" placeholder="<?php echo $placeholder; ?>" />
                <?php if ( ATHEN_CHECK_WPML ) { ?>
                    <input type="hidden" name="lang" value="<?php echo( ICL_LANGUAGE_CODE ); ?>"/>
                <?php } ?>
            </form>
        </div>
        
    <?php }
}


