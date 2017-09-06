<?php

/*-----------------------------------------------------------------------------------*/
/*	- Search
/*-----------------------------------------------------------------------------------*/

// Define Section
$wp_customize->add_section( 'athen_general_search' , array(
	'title'			=> __( 'General', 'athen_transl' ),
	'priority'		=> 4,
	'panel'			=> 'athen_search',
) );

// Search Style
$wp_customize->add_setting( 'athen_search_toggle_style', array(
	'type'			=> 'theme_mod',
	'default'		=> 'drop_down',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'athen_search_toggle_style', array(
	'label'		=> __( 'Search Style', 'athen_transl' ), 
	'section'	=> 'athen_general_search',
	'settings'	=> 'athen_search_toggle_style',
	'priority'	=> 1,
	'type'		=> 'select',
	'choices'	=> array(
		'drop_down'			=> __( 'Drop Down','athen_transl' ),
		'overlay'			=> __( 'Site Overlay','athen_transl' ),
		'header_replace'	=> __( 'Header Replace','athen_transl' )
	),
) );

/*-----------------------------------------------------------------------------------*/
/*	- Alignments
/*-----------------------------------------------------------------------------------*/

// Define Section
$wp_customize->add_section( 'athen_search_alignment' , array(
	'title'			=> __( 'Alignment', 'athen_transl' ),
	'priority'		=> 4,
	'panel'			=> 'athen_search',
) );

// Search Icon Placement
$wp_customize->add_setting( 'athen_search_icon_placement', array(
	'type'		=> 'theme_mod',
	'default'	=> 'header_top',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'athen_search_icon_placement', array(
	'label'			=> __( 'Search Icon Placement', 'athen_transl' ),
	'section'		=> 'athen_search_alignment',
	'settings'		=> 'athen_search_icon_placement',
	'priority'		=> 2,
	'type'			=> 'select',
   	'description'	=> __( 'epending on your logo height.', 'athen_transl' ),
	'choices'		=> array (
		'header_top'	=> __( 'Top Header', 'athen_transl' ),
		'header_main'	=> __( 'Main Header', 'athen_transl' ),
        'header_bottom'	=> __( 'Bottom Header', 'athen_transl' ),
	),
) );

// Search Div Replacement
$wp_customize->add_setting( 'athen_search_section_placement', array(
	'type'		=> 'theme_mod',
	'default'	=> 'header_top',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'athen_search_section_placement', array(
	'label'			=> __( 'Search Section Replacement', 'athen_transl' ),
	'section'		=> 'athen_search_alignment',
	'settings'		=> 'athen_search_section_placement',
	'priority'		=> 2,
	'type'			=> 'select',
   	'description'	=> __( ' depending on your logo height.', 'athen_transl' ),
	'choices'		=> array (
		'header_top'	=> __( 'Top Header', 'athen_transl' ),
		'header_main'	=> __( 'Main Header', 'athen_transl' ),
        'header_bottom'	=> __( 'Bottom Header', 'athen_transl' ),
	),
) );

// Search Div Replacement
$wp_customize->add_setting( 'athen_search_dropdown_placement', array(
	'type'		=> 'theme_mod',
	'default'	=> 'header_top',
	'sanitize_callback' => false,
) );
$wp_customize->add_control( 'athen_search_dropdown_placement', array(
	'label'			=> __( 'Search Dropdown Placement', 'athen_transl' ),
	'section'		=> 'athen_search_alignment',
	'settings'		=> 'athen_search_dropdown_placement',
	'priority'		=> 2,
	'type'			=> 'select',
   	'description'	=> __( '<h5>nding on your logo height.</h5>', 'athen_transl' ),
	'choices'		=> array (
		'header_top'	=> __( 'Top Header', 'athen_transl' ),
		'header_main'	=> __( 'Main Header', 'athen_transl' ),
        'header_bottom'	=> __( 'Bottom Header', 'athen_transl' ),
	),
) );