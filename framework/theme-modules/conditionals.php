<?php
/**
 * Description : Different conditional functions that return bool(true or false) type.
 *               Base on the tstate of theme. 
 * 
 * @package     Athen
 * @subpackage  Closer 
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 * Associated : with different functions within frameworks 
 */

/**
 * Checks if responsiveness is enabled.
 *
 * @since   2.0.0
 * @return  bool
 */
function athen_is_responsive() {
    $obj = athen_global_obj();
    if ( ! empty( $obj->responsive ) ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Check if the mobile menu is enabled or not
 *
 * @since   2.1.0
 * @return  bool
 */
function athen_has_mobile_menu() {
    $obj = athen_global_obj();
    if ( 'disabled' == $obj->mobile_menu_style ) {
        return false;
    } else {
        return true;
    }
}

/**
 * Returns true if the current Query is a query related to standard blog posts.
 *
 * @since   1.6.0
 * @return  bool
 */
if ( ! function_exists( 'athen_is_blog_query' ) ) {
    function athen_is_blog_query() {

        // Return true for blog archives
        if ( is_home() ) {
            $return = true;
        } elseif( is_search() ) {
            return false;
        } elseif ( is_category() ) {
            $return = true;
        } elseif ( is_tag() ) {
            $return = true;
        } elseif ( is_date() ) {
            $return = true;
        } elseif ( is_author() ) {
            $return = true;
        } else {
            $return = false;
        }

        // Apply filters
        $return = apply_filters( 'athen_is_blog_query', $return );

        // Return bool
        return $return;

    }
}

/**
 * Check if currently in front-end composer.
 *
 * @since   Total 1.5.0
 * @return  bool
 */
function athen_is_front_end_composer() {
    if ( ! function_exists( 'vc_is_inline' ) ) {
        return false;
    } elseif ( vc_is_inline() ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Check to see if the Visual Composer is enabled on a specific page.
 *
 * @since   1.6.0
 * @return  bool
 */
function athen_has_composer( $post_id = '' ) {

    // Return if ID is empty
    if ( ! $post_id ) {
        return false;
    }

    // Get post content
    $post_content = get_post_field( 'post_content', $post_id );

    // Check if post content has a vc_row shortcode
    if ( $post_content && strpos( $post_content, 'vc_row' ) ) {
        return true;
    } else {
        return false;
    }


}

/**
 * Checks if the current post is part of a post series.
 *
 * @since   2.0.0
 * @return  bool
 */
function athen_is_post_in_series() {
    $terms = get_the_terms( get_the_id(), 'post_series' );
    if ( $terms ) {
        return true;
    } else {
        return false;
    }

}

/**
 * Checks if on a theme portfolio category page.
 *
 * @since   1.6.0
 * @return  bool
 */
if ( ! function_exists( 'athen_is_portfolio_tax' ) ) {
    function athen_is_portfolio_tax() {
        if ( ! is_search() && ( is_tax( 'portfolio_category' ) || is_tax( 'portfolio_tag' ) ) ) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * Checks if on a theme staff category page.
 *
 * @since   1.6.0
 * @return  bool
 */
if ( ! function_exists( 'athen_is_staff_tax' ) ) {
    function athen_is_staff_tax() {
        if ( ! is_search() && ( is_tax( 'staff_category' ) || is_tax( 'staff_tag' ) ) ) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * Checks if on a theme testimonials category page.
 *
 * @since   1.6.0
 * @return  bool
 */
if ( ! function_exists( 'athen_is_testimonials_tax' ) ) {
    function athen_is_testimonials_tax() {
        if ( ! is_search() && ( is_tax( 'testimonials_category' ) || is_tax( 'testimonials_tag' ) ) ) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * Checks if on the WooCommerce shop page.
 *
 * @since   1.6.0
 * @return  bool
 */
function athen_is_woo_shop() {
    if ( ! ATHEN_CHECK_WOOCOMMERCE ) {
        return false;
    } elseif ( function_exists( 'is_shop' ) && is_shop() ) {
        return true;
    }
}

/**
 * Checks if on a WooCommerce tax.
 *
 * @since   1.6.0
 * @return  bool
 */
if ( ! function_exists( 'athen_is_woo_tax' ) ) {
    function athen_is_woo_tax() {
        if ( ! ATHEN_CHECK_WOOCOMMERCE ) {
            return false;
        } elseif ( ! is_tax() ) {
            return false;
        } elseif ( function_exists( 'is_product_category' ) && function_exists( 'is_product_tag' ) ) {
            if ( is_product_category() || is_product_tag() ) {
                return true;
            }
        }
    }
}

/**
 * Checks if on singular WooCommerce product post.
 *
 * @since   1.6.0
 * @return  bool
 */
function athen_is_woo_single() {
    if ( ! ATHEN_CHECK_WOOCOMMERCE ) {
        return false;
    } elseif ( is_woocommerce() && is_singular( 'product' ) ) {
        return true;
    }
}

/**
 * Check if current user has social profiles defined.
 *
 * @since   Total 1.0.0
 * @return  bool
 */
function athen_author_has_social() {

    // Get global post object
    global $post;

    // Get post author
    $post_author = ! empty( $post->post_author ) ? $post->post_author : '';

    // Return if there isn't any post author
    if ( ! $post_author ) {
        return;
    }

    if ( get_the_author_meta( 'athen_twitter', $post_author ) ) {
        return true;
    } elseif ( get_the_author_meta( 'athen_facebook', $post_author ) ) {
        return true;
    } elseif ( get_the_author_meta( 'athen_googleplus', $post_author ) ) {
        return true;
    } elseif ( get_the_author_meta( 'athen_linkedin', $post_author ) ) {
        return true;
    } elseif ( get_the_author_meta( 'athen_pinterest', $post_author ) ) {
        return true;
    } elseif ( get_the_author_meta( 'athen_instagram', $post_author ) ) {
        return true;
    } else {
        return false;
    }

}

/**
 * Check if a post has categories.
 *
 * This function is used for the next and previous posts so if a post is in a category it
 * will display next and previous posts from the same category.
 *
 * @since   Total 1.0.0
 * @return  bool
 */
if ( ! function_exists( 'athen_post_has_terms' ) ) {
    function athen_post_has_terms( $post_id = '', $post_type = '' ) {

        // Post data
        $post_id    = $post_id ? $post_id : get_the_ID();
        $post_type  = $post_type ? $post_type : get_post_type( $post_id );

        // Standard Posts
        if ( $post_type == 'post' ) {
            $terms = get_the_terms( $post_id, 'category');
            if ( $terms ) {
                return true;
            }
        }

        // Portfolio
        elseif ( 'portfolio' == $post_type ) {
            $terms = get_the_terms( $post_id, 'portfolio_category');
            if ( $terms ) {
                return true;
            }
        }

        // Staff
        elseif ( 'staff' == $post_type ) {
            $terms = get_the_terms( $post_id, 'staff_category');
            if ( $terms ) {
                return true;
            }
        }

        // Testimonials
        elseif ( 'testimonials' == $post_type ) {
            $terms = get_the_terms( $post_id, 'testimonials_category');
            if ( $terms ) {
                return true;
            }
        }

    }
}

/**
 * Check if the post edit links should display on the page
 *
 * @since   2.0.0
 * @return  bool
 */
function athen_has_post_edit() {

    // Display by default
    $return = true;

    // If not singular we can bail completely
    if ( ! is_singular() ) {
        return false;
    }

    // Don't show on front-end composer
    if ( athen_is_front_end_composer() ) {
        return;
    }

    // Not needed for these pages
    if ( function_exists( 'is_cart' ) && is_cart() ) {
        return;
    }
    if ( function_exists( 'is_checkout' ) && is_checkout() ) {
        return;
    }

    // Apply filters
    $return = apply_filters( 'athen_has_post_edit', $return );

    // Return bool
    return $return;

}

/**
 * Check if the next/previous links should display
 *
 * @since   2.0.0
 * @return  bool
 */
function athen_has_next_prev() {

    // Display by default
    $return = true;

    // If not singular or is a page we can bail completely
    if ( ! is_singular() || is_page() ) {
        return false;
    }

    // Check if it should be enabled on standard posts
    if ( is_singular( 'post' ) && ! athen_get_mod( 'blog_next_prev', true ) ) {
        $return = false;
    }

    // Apply filters
    $return = apply_filters( 'athen_has_next_prev', $return );

    // Return bool
    return $return;

}

/**
 * Check if term description should display above the loop.
 *
 * By default the term description displays in the subheading in the page header,
 * however, there are some built-in settings to enable the term description above the loop.
 * This function returns true if the term description should display above the loop and not in the header.
 *
 * @since   2.0.0
 * @return  bool
 */
function athen_has_term_description_above_loop( $return = false ) {

    // Return true for tags and categories only
    if (  'above_loop' == athen_get_mod( 'category_description_position' ) && ( is_category() || is_tag() ) ) {
        $return = true;
    }

    // Apply filters
    $return = apply_filters( 'athen_has_term_description_above_loop', $return );

    // Return
    return $return;

}

/**
 * Check if the readmore button should display
 *
 * @since   2.1.2
 * @return  bool
 */
function athen_has_readmore() {

    // Display by default
    $bool = true;

    // Disable if posts are set to display full content
    if ( 'post' == get_post_type()
        && ! strpos( get_the_content(), 'more-link' )
        && ! athen_get_mod( 'blog_exceprt', true ) ) {
        $bool = false;
    }

    // Don't show for password protected posts
    if ( post_password_required() ) {
        $bool = false;
    }

    // Apply filters
    $bool = apply_filters( 'athen_has_readmore', $bool );

    // Return bool
    return $bool;

}