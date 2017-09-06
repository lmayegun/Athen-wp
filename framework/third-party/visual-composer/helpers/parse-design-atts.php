<?php
/**
 * Takes old styling options and converts them into CSS for the css parameter
 * THIS FILE IS STILL IN PROGRESS - Maybe it will be used, maybe not.
 *
 * @package     Total
 * @subpackage  Visual Composer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
 * @version     1.0.0
 */

class VCEX_Parse_Old_Design_Atts {

    /**
     * Padding variable
     *
     * @since   2.0.0
     * @var     $style
     * @access  private
     * @return  string
     */
    private $padding = array();

    /**
     * Class Constructor
     *
     * @since 2.0.0
     * @param $elements
     */
    function __construct( $atts ) {

        // Set class variables
        $this->atts = $atts;
        $this->padding = array(
            'top'       => '0',
            'bottom'    => '0',
            'left'      => '0',
            'right'     => '0',
        );

        // Loop through attributes and parse them
        foreach ( $this->atts as $key => $value ) {
            $method = 'parse_' . $key;
            if ( method_exists( $this, $method ) ) {
                if ( ! empty( $value ) ) {
                    $this->$method( $value );
                }
            }
        }

    }

    /**
     * Padding: Top
     *
     * @since 2.0.0
     * @param $value
     */
    public function parse_padding_top( $value ) {
        $this->padding['top'] = $value;
    }

    /**
     * Returns the css
     *
     * @since 2.0.0
     * @param $value
     */
    public function return_atts() {

        // Padding
        if ( empty( $this->atts['padding'] ) ) {
            $this->atts['padding'] = $this->padding['top'] .' '. $this->padding['right'] .' '. $this->padding['bottom'] .' '. $this->padding['left'];
        }

        // Return attributes
        return $this->atts;

    }

} // End Class

// Helper function runs the VCEX_Parse_Old_Design_Atts class
function vcex_parse_old_design_options( $atts ) {

    // Only run when css parameter is empty
    if ( empty( $atts['css'] ) ) {
        $class = new VCEX_Parse_Old_Design_Atts( $atts );
        return $class->return_atts();
    }

}