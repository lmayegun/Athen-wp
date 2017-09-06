<?php
/**
 * Parses Row attributes to return correct values
 *
 * @package     Total
 * @subpackage  Visual Composer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       2.0.2
 * @version     2.1.2
 */

class VCEX_Parse_Row_Atts {

    /**
     * Class Constructor
     *
     * @since   2.0.2
     * @access  public
     */
    public function __construct( $atts ) {

        // Check if parallax is enabled
        $this->enable_row_parallax = vcex_enable_row_parallax();

        // Set attributes var
        $this->atts = $atts;

        // Loop through attributes and parse them
        foreach ( $this->atts as $key => $value ) {
            $method = 'parse_' . $key;
            if ( method_exists( $this, $method ) ) {
                $this->$method( $value );
            }
        }

    }

    /**
     * Convert bg_image ID into src
     *
     * @since   2.0.2
     * @access  private
     */
    private function parse_bg_image( $value ) {
        $this->atts['bg_image'] = ( ! empty( $value ) ) ? wp_get_attachment_url( $value ) : false;
    }

    /**
     * Convert center row into bool
     *
     * @since   2.0.2
     * @access  private
     */
    private function parse_center_row( $value ) {
        
        // Return if value is empty or is_admin
        if ( empty( $value ) || is_admin() ) {
            return false;
        }

        // Make sure function exists
        if ( ! function_exists( 'athen_get_post_layout' ) ) {
            return false;
        }

        // Get current post layout
        $current_post_layout = athen_get_post_layout();

        // Center row if needed
        if ( 'yes' == $value && ! empty( $current_post_layout ) && 'full-screen' == $current_post_layout ) {
            $this->atts['center_row'] = true;
        } else {
            $this->atts['center_row'] = false;
        }

    }

    /**
     * Convert 'no-margins' to '0px' column_spacing
     *
     * @since   2.0.2
     * @access  private
     */
    private function parse_no_margins( $value ) {
        if ( 'true' == $value ) {
             $this->atts['column_spacing'] = '0px';
        }
    }

    /**
     * Convert video bg att into bool
     *
     * @since   2.0.2
     * @access  private
     */
    private function parse_video_bg( $value ) {
        $this->atts['video_bg'] = ( 'yes' == $value ) ? 'self_hosted' : $value;
    }

    /**
     * Convert style to typography style
     *
     * @since   2.0.2
     * @access  private
     */
    private function parse_style( $value ) {

        // Sanitize to make sure it hasn't been parsed by another function
        $value = $value ? $value : $this->atts['style'];

        // Return if empty or set to none
        if ( empty( $value ) || 'none' == $value ) {
            return;
        }

        // Set new typography_style atts
        if ( empty( $this->atts['typography_style'] ) && in_array( $value, vcex_typography_styles() ) ) {
            $this->atts['typography_style'] = $value;
            $this->atts['style'] = '';
        }
        
    }

    /**
     * Convert Typography style to correct classname
     *
     * @since   2.0.2
     * @access  private
     */
    private function parse_typography_style( $value ) {
        if ( function_exists( 'athen_typography_style_class' ) ) {
            $this->atts['typography_style'] = athen_typography_style_class( $this->atts['typography_style'] );
        }
    }

    /**
     * Return correct parallax value, checks for old bg_style method
     *
     * @since   2.0.2
     * @access  private
     */
    private function parse_parallax( $value ) {

        // Return if parallax rows are disabled or is inline
        if ( ! $this->enable_row_parallax ) {
            $this->atts['parallax'] = '';
            return;
        }

        // Check if parallax is enabled
        if ( $value ) {
            return true;
        }

        // Check if parallax is enabled
        if ( empty( $value ) && ! empty( $this->atts['bg_style'] ) ) {
            if ( 'parallax' ==  $this->atts['bg_style'] || 'parallax-advanced' ==  $this->atts['bg_style'] ) {
                $this->atts['parallax'] = true;
            } else {
                $this->atts['parallax'] = false;
            }
        }

    }

    /**
     * Background style class
     *
     * @since   2.0.2
     * @access  private
     */
    private function parse_bg_style_class() {

        // If background image isn't defined we don't need to add a background style class
        if ( empty( $this->atts['bg_image'] ) ) {
            return;
        }

        // Set simple parallax background to cover
        if ( isset( $this->atts['parallax'] ) && 'simple' == $this->atts['parallax'] ) {
             $this->atts['bg_style_class'] = 'bg-cover';
            return;
        }

        // Get background style
        $bg_style = ( isset( $this->atts['bg_style'] ) ) ? $this->atts['bg_style'] : 'cover';

        // Return correct background style class
        if ( ! $bg_style ) {
            $this->atts['bg_style_class'] = '';
        } elseif( 'stretch' == $bg_style || 'cover' == $bg_style ) {
            $this->atts['bg_style_class'] = 'bg-cover';
        } elseif( 'repeat' == $bg_style ) {
            $this->atts['bg_style_class'] = 'bg-repeat';
        } elseif( 'fixed' == $bg_style ) {
            $this->atts['bg_style_class'] = 'bg-fixed';
        } elseif( 'repeat-x' == $bg_style ) {
            $this->atts['bg_style_class'] = 'bg-repeat-x';
        } elseif( 'repeat-y' == $bg_style ) {
            $this->atts['bg_style_class'] = 'bg-repeat-y';
        } elseif( 'fixed-top' == $bg_style ) {
            $this->atts['bg_style_class'] = 'bg-fixed-top';
        } elseif( 'repeat-bottom' == $bg_style ) {
            $this->atts['bg_style_class'] = 'bg-fixed-bottom';
        }

    }

    /**
     * Returns attributes
     *
     * @since   2.0.2
     * @access  public
     */
    public function return_atts() {
        return $this->atts;
    }

} // End Class

// Helper function runs the VCEX_Parse_Row_Atts class
function vcex_parse_row_atts( $atts ) {
    $parse = new VCEX_Parse_Row_Atts( $atts );
    return $parse->return_atts();
}