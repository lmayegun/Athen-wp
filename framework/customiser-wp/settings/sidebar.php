<?php
/**
 * Description : Bunch of array use modify customizer controller + model.
 *             : Sidebar panel, section, setting & control.
 * 
 * @package     Athen
 * @subpackage  Closer - View/Model
 * @since       Closer 1.0.0
 * @author      Lukmon Mayegun
 * @copyright   Copyright (c) 2016
 * 
 * Dependent : customizer/customizer.php (Athen_Customizer class)
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*-----------------------------------------------------------------------------------*/
/*	- General Section
/*-----------------------------------------------------------------------------------*/
$this->sections['athen_sidebar_general'] = array(
	'title'		=> __( 'General', 'athen_transl' ),
	'panel'		=> 'athen_sidebar',
	'settings'	=> array(
		array(
			'id'		=> 'sidebar_headings',
			'default'	=> 'div',
			'control'	=> array (
				'label'		=>	__( 'Sidebar Widget Title Headings', 'athen_transl' ),
				'type'		=> 'select',
				'choices'	=> array(
					'h2'	=> 'h2',
					'h3'	=> 'h3',
					'h4'	=> 'h4',
					'h5'	=> 'h5',
					'h6'	=> 'h6',
					'span'	=> 'span',
					'div'	=> 'div',
				),
			),
		),
		array(
			'id'		=> 'has_widget_icons',
			'default'   => '1',
			'control'	=> array (
				'label'	=>	__( 'Widget Icons', 'athen_transl' ),
				'type'	=> 'checkbox',
				'desc'	=> __( 'Certain widgets include little icons such as the recent posts widget. Here you can toggle the icons on or off.', 'athen_transl' ),
			),
		),
	),
);