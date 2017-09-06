<?php
/**
  * Description : Classes use to modify UI controller in customize preview page. 
 * 
 * @package     Athen
 * @subpackage  Closer - conroller/view
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 * Dependent : classes in setting packages
 */

/**
 * HR control for the customizer
 *
 * @since 1.6.0
 */
class WPEX_HR_Control extends WP_Customize_Control {
	public $type = 'hr';
	public function render_content() {
		echo '<hr />';
	}
}

/**
 * Editor Class for the customizer
 *
 * @since 1.6.0
 */
class WPEX_Text_Editor_Control extends WP_Customize_Control {
	/**
	 * Render the content on the theme customizer page
	 */
	public function render_content() { ?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php $settings = array(
				'textarea_name'	=> $this->id,
				'media_buttons'	=> false,
				'teeny'			=> true,
			);
			wp_editor($this->value(), $this->id, $settings ); ?>
		</label>
	<?php
	}
}

/**
 * Multiple check customize control class.
 *
 * @since 2.0.0
 */
if ( ! class_exists( 'WPEX_Customize_Multicheck_Control' ) ) {
	class WPEX_Customize_Multicheck_Control extends WP_Customize_Control {
		public $description = '';
		public $subtitle = '';
		private static $firstLoad = true;
		// Since theme_mod cannot handle multichecks, we will do it with some JS
		public function render_content() {
			// the saved value is an array. convert it to csv
			if ( is_array( $this->value() ) ) {
				$savedValueCSV = implode( ',', $this->value() );
				$values = $this->value();
			} else {
				$savedValueCSV = $this->value();
				$values = explode( ',', $this->value() );
			}
			if ( self::$firstLoad ) {
				self::$firstLoad = false;
				?>
				<script>
				jQuery(document).ready(function($) {
					"use strict";
					$('input.tf-multicheck').change(function(event) {
						event.preventDefault();
						var csv = '';
						$(this).parents('li:eq(0)').find('input[type=checkbox]').each(function() {
							if ($(this).is(':checked')) {
								csv += $(this).attr('value') + ',';
							}
						});
						csv = csv.replace(/,+$/, "");
						$(this).parents('li:eq(0)').find('input[type=hidden]').val(csv)
						// we need to trigger the field afterwards to enable the save button
						.trigger('change');
						return true;
					});
				});
				</script>
				<?php
			} ?>
			<label class='tf-multicheck-container'>
				<span class="customize-control-title">
					<?php echo esc_html( $this->label ); ?>
					<?php if ( isset( $this->description ) && '' != $this->description ) { ?>
						<a href="#" class="button tooltip" title="<?php echo strip_tags( esc_html( $this->description ) ); ?>">?</a>
					<?php } ?>
				</span>
				<?php if ( '' != $this->subtitle ) : ?>
					<div class="customizer-subtitle"><?php echo $this->subtitle; ?></div>
				<?php endif; ?>
				<?php
				foreach ( $this->choices as $value => $label ) {
					printf('<label for="%s"><input class="tf-multicheck" id="%s" type="checkbox" value="%s" %s/> %s</label><br>',
						$this->id . $value,
						$this->id . $value,
						esc_attr( $value ),
						checked( in_array( $value, $values ), true, false ),
						$label
					);
				}
				?>
				<input type="hidden" value="<?php echo esc_attr( $savedValueCSV ); ?>" <?php $this->link(); ?> />
			</label>
			<?php
		}
	}
}

/**
 * Multiple select customize control class.
 *
 * @since 1.6.0
 */
class WPEX_Customize_Control_Multiple_Select extends WP_Customize_Control {
	/**
	 * The type of customize control being rendered.
	 */
	public $type = 'multiple-select';

	/**
	 * Displays the multiple select on the customize screen.
	 */
	public function render_content() {
	if ( empty( $this->choices ) ) {
		return;
	}
	$this_val = $this->value(); ?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php if ( '' != $this->description ) { ?>
				<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php } ?>
			<select <?php $this->link(); ?> multiple="multiple" style="height:120px;">
				<?php foreach ( $this->choices as $value => $label ) {
					$selected = ( in_array( $value, $this_val ) ) ? selected( 1, 1, false ) : '';
					echo '<option value="' . esc_attr( $value ) . '"' . $selected . '>' . $label . '</option>';
				} ?>
			</select>
		</label>
	<?php }
}

/**
 * Slider UI control
 *
 * @since 1.6.0
 */
class WPEX_Customize_Sliderui_Control extends WP_Customize_Control {
	public function enqueue() {
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-slider' );
	}
	public function render_content() {
		$this_val = $this->value() ? $this->value() : '0'; ?>
		<label>
			<span class="customize-control-title">
				<?php echo esc_html( $this->label ); ?>
			</span>
			<?php if ( '' != $this->description ) { ?>
				<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php } ?>
			 <input type="text" id="input_<?php echo $this->id; ?>" value="<?php echo $this_val; ?>" <?php $this->link(); ?>/>
		</label>
		<div id="slider_<?php echo $this->id; ?>" class="wpex-slider-ui"></div>
		<script>
			jQuery(document).ready(function($) {
				$( "#slider_<?php echo $this->id; ?>" ).slider({
					value : <?php echo $this_val; ?>,
					min   : <?php echo $this->choices['min']; ?>,
					max   : <?php echo $this->choices['max']; ?>,
					step  : <?php echo $this->choices['step']; ?>,
					slide : function( event, ui ) { $( "#input_<?php echo $this->id; ?>" ).val(ui.value).keyup(); }
				});
				$( "#input_<?php echo $this->id; ?>" ).val( $( "#slider_<?php echo $this->id; ?>" ).slider( "value" ) );
				$( "#input_<?php echo $this->id; ?>" ).keyup(function() {
					$( "#slider_<?php echo $this->id; ?>" ).slider( "value", $(this).val() );
				});
			});
		</script>
		<?php
	}
}

/**
 * Sorter Control
 *
 * @since 1.6.0
 */
class WPEX_Customize_Control_Sorter extends WP_Customize_Control {
public function enqueue() {
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-sortable' );
}
public function render_content() { ?>
	<div class="wpex-sortable">
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php if ( '' != $this->description ) { ?>
				<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php } ?>
		</label>
		<?php
		// Get values and choices
		$values		= $this->value();
		$choices	= $this->choices;
		// Turn values into array
		if ( ! is_array( $values ) ) {
			$values = explode( ',', $values );
		} ?>
		<ul id="<?php echo $this->id; ?>_sortable">
			<?php
			// Loop through values
			foreach ( $choices as $val => $label ) {
				$hide_sortee	= '';
				$hide_icon		= 'dashicons-no-alt';
				if ( ! in_array( $val, $values ) ) {
					$hide_sortee	= ' wpex-hide';
					$hide_icon		= ' dashicons-yes';
				} ?>
				<li data-value="<?php echo esc_attr( $val ); ?>" class="wpex-sortable-li<?php echo $hide_sortee; ?>">
					<?php echo $label; ?>
					<span class="wpex-hide-sortee dashicons <?php echo $hide_icon; ?>"></span>
				</li>
			<?php } ?>
		</ul>
	</div><!-- .wpex-sortable -->
	<div class="clear:both"></div>
	<?php
	// Return values as comma seperated string for input
	if ( is_array( $values ) ) {
		$values = array_keys( $values );
		$values = implode( ',', $values );
	} ?>
	<input id="<?php echo $this->id; ?>_input" type='hidden' name="<?php echo $this->id; ?>" value="<?php echo esc_attr( $values ); ?>" <?php echo $this->get_link(); ?> />
	<script>
	jQuery(document).ready(function($) {
		"use strict";
		// Define variables
		var sortableUl = $('#<?php echo $this->id; ?>_sortable');

		// Create sortable
		sortableUl.sortable()
		sortableUl.disableSelection();

		// Update values on sortstop
		sortableUl.on( "sortstop", function( event, ui ) {
			wpexUpdateSortableVal();
		});

		// Toggle classes
		sortableUl.find('li').each(function() {
			$(this).find('.wpex-hide-sortee').click(function() {
				$(this).toggleClass('dashicons-no-alt dashicons-yes').parents('li:eq(0)').toggleClass('wpex-hide');
			});
		})
		// Update Sortable when hidding/showing items
		$('#<?php echo $this->id; ?>_sortable span.wpex-hide-sortee').click(function() {
			wpexUpdateSortableVal();
		});
		// Used to update the sortable input value
		function wpexUpdateSortableVal() {
			var values = [];
			sortableUl.find('li').each(function() {
				if ( ! $(this).hasClass('wpex-hide') ) {
					values.push( $(this).attr('data-value') );
				}
			});
			$('#<?php echo $this->id; ?>_input').val(values).trigger('change');
		}
	});
	</script>
	<?php
	}
}

/**
 * Google Fonts Control
 *
 * @since 1.6.0
 */
class WPEX_Fonts_Dropdown_Custom_Control extends WP_Customize_Control {
	public function render_content() {
		$this_val = $this->value(); ?>
	<label>
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<select <?php $this->link(); ?> style="width:100%;">
			<option value="" <?php if ( ! $this_val ) echo 'selected="selected"'; ?>><?php _e( 'Default', 'athen_transl' ); ?></option>
			<optgroup label="<?php _e( 'Standard Fonts', 'athen_transl' ); ?>">
				<?php
				// Get font options
				$std_fonts = athen_standard_fonts();
				// Loop through font options and add to select
				foreach ( $std_fonts as $font ) { ?>
					<option value="<?php echo $font; ?>" <?php selected( $font, $this_val ); ?>><?php echo $font; ?></option>
				<?php } ?>
			</optgroup>
			<optgroup label="<?php _e( 'Google Fonts', 'athen_transl' ); ?>">
				<?php
				// Get font options
				$google_fonts = athen_google_fonts_array();
				// Loop through font options and add to select
				foreach ( $google_fonts as $font ) { ?>
					<option value="<?php echo $font; ?>" <?php selected( $font, $this_val ); ?>><?php echo $font; ?></option>
				<?php } ?>
			</optgroup>
		</select>
	</label>
	<?php }
}