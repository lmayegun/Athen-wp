<?php
/**
 * Generates Inline styles
 *
 * @package     Total
 * @subpackage  Visual Composer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
 * @version     2.1.0
 */

class VCEX_Inline_Style {

	/**
	 * Style variable to return
	 *
	 * @since   2.0.0
	 * @var     $style
	 * @access  private
	 * @return  string
	 */
	private $style = array();

	/**
	 * Whether the class should add the style="" code
	 *
	 * @since   2.0.0
	 * @var     $add_style
	 * @access  private
	 * @return  bool
	 */
	private $add_style = true;

	/**
	 * Class Constructor
	 *
	 * @since   2.0.0
	 * @access  public
	 * @param   $atts, $add_style
	 */
	public function __construct( $atts, $add_style ) {

		// Check if class should add the style="" code
		$this->add_style = $add_style;

		// Loop through shortcode atts and run class methods
		foreach ( $atts as $key => $value ) {
			if ( ! empty( $value ) ) {
				$method = 'parse_' . $key;
				if ( method_exists( $this, $method ) ) {
					$this->$method( $value );
				}
			}
		}

	}

	/**
	 * Display
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_display( $value ) {
		$this->style[] = 'display:'.$value.';';
	}

	/**
	 * Width
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_width( $value ) {
		$value          = athen_sanitize_data( $value, 'px-pct' );
		$this->style[]  = 'width:'.$value.';';
	}

	/**
	 * Background
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_background( $value ) {
		$this->style[] = 'background:'.$value.';';
	}

	/**
	 * Background Image
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_background_image( $value ) {
		$this->style[] = 'background-image:url('.$value.');';
	}

	/**
	 * Background Color
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_background_color( $value ) {
		$value          = ( 'none' == $value ) ? 'transparent' : $value;
		$this->style[]  = 'background-color:'.$value.';';
	}

	/**
	 * Border
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_border( $value ) {
		$value          = ( 'none' == $value ) ? '0' : $value;
		$this->style[]  = 'border:'.$value.';';
	}

	/**
	 * Border: Color
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_border_color( $value ) {
		$value          = ( 'none' == $value ) ? 'transparent' : $value;
		$this->style[]  = 'border-color:'.$value.';';
	}

	/**
	 * Border Width
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_border_width( $value ) {
		$this->style[] = 'border-width:'.$value.';';
	}

	/**
	 * Border Style
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_border_style( $value ) {
		$this->style[] = 'border-style:'.$value.';';
	}

	/**
	 * Border: Top Width
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_border_top_width( $value ) {
		$value          = athen_sanitize_data( $value, 'px' );
		$this->style[]  = 'border-top-width:'.$value.';';
	}

	/**
	 * Border: Bottom Width
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_border_bottom_width( $value ) {
		$value          = athen_sanitize_data( $value, 'px' );
		$this->style[]  = 'border-bottom-width:'.$value.';';
	}

	/**
	 * Margin
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_margin( $value ) {
		$value          = ( 'none' == $value ) ? '0' : $value;
		$this->style[]  = 'margin:'.$value.';';
	}

	/**
	 * Margin: Right
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_margin_right( $value ) {
		$value          = athen_sanitize_data( $value, 'px-pct' );
		$this->style[]  = 'margin-right:'.$value.';';
	}

	/**
	 * Margin: Left
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_margin_left( $value ) {
		$value          = athen_sanitize_data( $value, 'px-pct' );
		$this->style[]  = 'margin-left:'.$value.';';
	}

	/**
	 * Margin: Top
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_margin_top( $value ) {
		$value          = athen_sanitize_data( $value, 'px' );
		$this->style[]  = 'margin-top:'.$value.';';
	}

	/**
	 * Margin: Bottom
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_margin_bottom( $value ) {
		$value          = athen_sanitize_data( $value, 'px' );
		$this->style[]  = 'margin-bottom:'.$value.';';
	}

	/**
	 * Padding
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_padding( $value ) {
		$value          = ( 'none' == $value ) ? '0' : $value;
		$this->style[]  = 'padding:'.$value.';';
	}

	/**
	 * Padding: Top
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_padding_top( $value ) {
		$value          = athen_sanitize_data( $value, 'px' );
		$this->style[]  = 'padding-top:'.$value.';';
	}

	/**
	 * Padding: Bottom
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_padding_bottom( $value ) {
		$value          = athen_sanitize_data( $value, 'px' );
		$this->style[]  = 'padding-bottom:'.$value.';';
	}

	/**
	 * Padding: Left
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_padding_left( $value ) {
		$value          = athen_sanitize_data( $value, 'px-pct' );
		$this->style[]  = 'padding-left:'.$value.';';
	}

	/**
	 * Padding: Right
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_padding_right( $value ) {
		$value          = athen_sanitize_data( $value, 'px-pct' );
		$this->style[]  = 'padding-right:'.$value.';';
	}

	/**
	 * Font-Size
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_font_size( $value ) {
		$value          = athen_sanitize_data( $value, 'font_size' );
		$this->style[]  = 'font-size:'.$value.';';
	}

	/**
	 * Font Weight
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_font_weight( $value ) {
		$value          = athen_sanitize_data( $value, 'font_weight' );
		$this->style[] = 'font-weight:'.$value.';';
	}

	/**
	 * Font Family
	 *
	 * @since   2.1.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_font_family( $value ) {
		$this->style[] = 'font-family:'. $value .';';
	}

	/**
	 * Color
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_color( $value ) {
		$this->style[] = 'color:'.$value.';';
	}

	/**
	 * Opacity
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_opacity( $value ) {
		$value          = athen_sanitize_data( $value, 'opacity' );
		$this->style[]  = 'opacity:'.$value.';';
	}

	/**
	 * Text Align
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_text_align( $value ) {
		if ( 'textcenter' == $value ) {
			$value = 'center';
		} elseif ( 'textleft' == $value ) {
			$value = 'left';
		} elseif ( 'textright' == $value ) {
			$value = 'right';
		}
		$this->style[]  = 'text-align:'.$value.';';
	}

	/**
	 * Text Transform
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_text_transform( $value ) {
		$this->style[] = 'text-transform:'.$value.';';
	}

	/**
	 * Letter Spacing
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_letter_spacing( $value ) {
		$value          = athen_sanitize_data( $value, 'px' );
		$this->style[]  = 'letter-spacing:'.$value.';';
	}

	/**
	 * Line-Height
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_line_height( $value ) {
		$this->style[] = 'line-height:'.$value.';';
	}

	/**
	 * Line-Height with px sanitize
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_line_height_px( $value ) {
		$value          = athen_sanitize_data( $value, 'px' );
		$this->style[]  = 'line-height:'.$value.';';
	}

	/**
	 * Height
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_height( $value ) {
		$value          = athen_sanitize_data( $value, 'px-pct' );
		$this->style[]  = 'height:'.$value.';';
	}

	/**
	 * Height with px sanitize
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_height_px( $value ) {
		$value          = athen_sanitize_data( $value, 'px' );
		$this->style[]  = 'height:'.$value.';';
	}

	/**
	 * Min-Height
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_min_height( $value ) {
		$value          = athen_sanitize_data( $value, 'px-pct' );
		$this->style[]  = 'min-height:'.$value.';';
	}

	/**
	 * Border Radius
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_border_radius( $value ) {
		$value          = athen_sanitize_data( $value, 'border_radius' );
		$this->style[]  = 'border-radius:'.$value.';';
	}

	/**
	 * Position: Top
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_top( $value ) {
		$value          = athen_sanitize_data( $value, 'px-pct' );
		$this->style[]  = 'top:'.$value.';';
	}

	/**
	 * Position: Bottom
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_bottom( $value ) {
		$value          = athen_sanitize_data( $value, 'px-pct' );
		$this->style[]  = 'bottom:'.$value.';';
	}

	/**
	 * Position: Right
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_right( $value ) {
		$value          = athen_sanitize_data( $value, 'px-pct' );
		$this->style[]  = 'right:'.$value.';';
	}

	/**
	 * Position: Left
	 *
	 * @since   2.0.0
	 * @access  private
	 * @param   $value
	 */
	private function parse_left( $value ) {
		$value          = athen_sanitize_data( $value, 'px-pct' );
		$this->style[]  = 'left:'.$value.';';
	}

	/**
	 * Returns the styles
	 *
	 * @since   2.0.0
	 * @access  public
	 */
	public function return_style() {
		if ( ! empty( $this->style ) ) {
			$this->style = implode( false, $this->style );
			if ( $this->add_style ) {
				return ' style="'. esc_attr( $this->style ) .'"';
			} else {
				return esc_attr( $this->style );
			}
		} else {
			return null;
		}
	}


} // End Class

// Helper function runs the VCEX_Inline_Style class
function vcex_inline_style( $atts = array(), $add_style = true ) {
	if ( ! empty( $atts ) && is_array( $atts ) ) {
		$inline_style = new VCEX_Inline_Style( $atts, $add_style );
		return $inline_style->return_style();
	}
}