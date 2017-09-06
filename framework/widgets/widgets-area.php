<?php
	/**
	 * Registers the theme sidebars (widget areas)
	 *
	 * @since   1.6.0
	 * @access  public
	 *
	 * @link    http://codex.wordpress.org/Function_Reference/register_sidebar 
	 */
	

		// Heading element type
		$sidebar_headings   = $this->athen_get_mod( 'sidebar_headings', 'div' );
		$sidebar_headings   = $sidebar_headings ? $sidebar_headings : 'div';
		$footer_headings    = $this->athen_get_mod( 'footer_headings', 'div' );
		$footer_headings    = $footer_headings ? $footer_headings : 'div';

		// Main Sidebar
		register_sidebar( array (
			'name'          => __( 'Main Sidebar', 'athen_transl' ),
			'id'            => 'sidebar',
			'description'   => __( 'Widgets in this area are used in the default sidebar. This sidebar will be used for your standard blog posts.', 'athen_transl' ),
			'before_widget' => '<div class="sidebar-box %2$s clr">',
			'after_widget'  => '</div>',
			'before_title'  => '<'. $sidebar_headings .' class="widget-title">',
			'after_title'   => '</'. $sidebar_headings .'>',
		) );

		// Pages Sidebar
		if ( $this->athen_get_mod( 'pages_custom_sidebar', true ) ) {
			register_sidebar( array (
				'name'          => __( 'Pages Sidebar', 'athen_transl' ),
				'id'            => 'pages_sidebar',
				'before_widget' => '<div class="sidebar-box %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<'. $sidebar_headings .' class="widget-title">',
				'after_title'   => '</'. $sidebar_headings .'>',
			) );
		}

		// Search Results Sidebar
		if ( $this->athen_get_mod( 'search_custom_sidebar', true ) ) {
			register_sidebar( array (
				'name'          => __( 'Search Results Sidebar', 'athen_transl' ),
				'id'            => 'search_sidebar',
				'before_widget' => '<div class="sidebar-box %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<'. $sidebar_headings .' class="widget-title">',
				'after_title'   => '</'. $sidebar_headings .'>',
			) );
		}

		// Testimonials Sidebar
		if ( post_type_exists( 'testimonials' ) && $this->athen_get_mod( 'testimonials_custom_sidebar', true ) ) {
			$obj            = get_post_type_object( 'testimonials' );
			$post_type_name = $obj->labels->name;
			register_sidebar( array (
				'name'          => $post_type_name .' '. __( 'Sidebar', 'athen_transl' ),
				'id'            => 'testimonials_sidebar',
				'before_widget' => '<div class="sidebar-box %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<'. $sidebar_headings .' class="widget-title">',
				'after_title'   => '</'. $sidebar_headings .'>',
			) );
		}

		// Footer Sidebars
		if ( $this->athen_get_mod( 'footer_widgets', true ) ) {

			// Footer widget columns
			$footer_columns = $this->athen_get_mod( 'footer_widgets_columns', '4' );
			
			// Footer 1
			register_sidebar( array (
				'name'          => __( 'Footer Column 1', 'athen_transl' ),
				'id'            => 'footer_one',
				'before_widget' => '<div class="footer-widget %2$s clr">',
				'after_widget'  => '</div>',
				'before_title'  => '<'. $footer_headings .' class="widget-title">',
				'after_title'   => '</'. $footer_headings .'>',
			) );
			
			// Footer 2
			if ( $footer_columns > '1' ) {
				register_sidebar( array (
					'name'          => __( 'Footer Column 2', 'athen_transl' ),
					'id'            => 'footer_two',
					'before_widget' => '<div class="footer-widget %2$s clr">',
					'after_widget'  => '</div>',
					'before_title'  => '<'. $footer_headings .' class="widget-title">',
					'after_title'   => '</'. $footer_headings .'>'
				) );
			}
			
			// Footer 3
			if ( $footer_columns > '2' ) {
				register_sidebar( array (
					'name'          => __( 'Footer Column 3', 'athen_transl' ),
					'id'            => 'footer_three',
					'before_widget' => '<div class="footer-widget %2$s clr">',
					'after_widget'  => '</div>',
					'before_title'  => '<'. $footer_headings .' class="widget-title">',
					'after_title'   => '</'. $footer_headings .'>',
				) );
			}
			
			// Footer 4
			if ( $footer_columns > '3' ) {
				register_sidebar( array (
					'name'          => __( 'Footer Column 4', 'athen_transl' ),
					'id'            => 'footer_four',
					'before_widget' => '<div class="footer-widget %2$s clr">',
					'after_widget'  => '</div>',
					'before_title'  => '<'. $footer_headings .' class="widget-title">',
					'after_title'   => '</'. $footer_headings .'>',
				) );
			}

			// Footer 5
			if ( $footer_columns > '4' ) {
				register_sidebar( array (
					'name'          => __( 'Footer Column 5', 'athen_transl' ),
					'id'            => 'footer_five',
					'before_widget' => '<div class="footer-widget %2$s clr">',
					'after_widget'  => '</div>',
					'before_title'  => '<'. $footer_headings .' class="widget-title">',
					'after_title'   => '</'. $footer_headings .'>',
				) );
			}

		}

	

