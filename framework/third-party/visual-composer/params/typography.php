<?php
/**
 * Adds custom Typography param to the Visual Composer - IN PROGRESSS
 *
 * @package     Total
 * @subpackage  Visual Composer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       2.1.0
 * @version     1.0.0
 */

class VCEX_Typography_Param {

    /**
     * Class Constructor
     *
     * @since  2.1.0
     * @access public
     */
    public function __construct() {

        // Run on admin init, not needed in front-end
        add_action( 'admin_init', array( &$this, 'init' ) );

    }

    /**
     * Register the Param
     *
     * vc_add_shortcode_param( $name, $form_field_callback, $script_url );
     *
     * @since  2.1.0
     * @access public
     */
    public function init() {

        // Make sure function exists
        if ( ! function_exists( 'vc_add_shortcode_param' ) ) {
            return;
        }

        // Register param
        vc_add_shortcode_param( 'vcex_typography', array( &$this, 'typography' ) );
        
    }

    /**
     * Param output
     *
     * @since  2.1.0
     * @access public
     */
    public function typography( $settings, $value ) {

        ob_start();

            $value = $this->parse_value( $value );

            //print_r( $value );

            $defaults = array(
                'tag',
                'text_align',
                'font_size',
                'line_height',
                'color',
                'font_style_italic',
                'font_style_bold',
                'font_family',
            );

            $values = wp_parse_args( $value, $defaults );

        ?>
        
            <div class="vcex-typography clr">

                <?php
                // Color ?>
                <div class="vc_row-fluid vc_column">
                    <div class="wpb_element_label"><?php _e( 'Text color', 'athen_transl' ); ?></div>
                    <div class="color-group">
                        <input name="<?php echo $settings['param_name']; ?>-color" type="text" value="<?php echo $values['color']; ?>" class="wpb_vc_param_value wpb-textinput vc_color-control" />
                    </div>
                </div>

                <?php
                // Color ?>
                <div class="vc_row-fluid vc_column">
                    <div class="wpb_element_label"><?php _e( 'Font Size', 'athen_transl' ); ?></div>
                    <input type="text" value="<?php echo $values['font_size']; ?>" class="textfield" />
                </div>

                <?php
                // Create value to save ?>

                <?php
                // Hidden field to save data ?>
                <input name="<?php echo $settings['param_name']; ?>" class="wpb_vc_param_value <?php echo $settings['param_name']; ?> <?php echo $settings['type']; ?>_field" type="hidden" value="<?php echo $value; ?>" />

            </div><!-- .vcex-typography -->

        <?php
        return ob_get_clean();
        
    }

    /**
     * Parses value into array
     *
     * @since  2.1.0
     * @access private
     */
    private function parse_value( $value ) {

        if ( function_exists( 'vc_parse_multi_attribute' ) ) {
            return vc_parse_multi_attribute( $value );
        }


    }


} // End Class
new VCEX_Typography_Param;