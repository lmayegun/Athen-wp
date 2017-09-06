<?php

class Athen_Theme_Js extends Athen_Framework_Init{
    
    public function __construct(){
        
        // Load theme js
		add_action( 'wp_enqueue_scripts', array( &$this, 'theme_js' ) );
        
    }
    
    
    public function theme_js() {

		// Front end only
		if ( is_admin() ) {
			return;
		}

		// Get global object
		global $athen_std_theme;

		// Make sure the core jQuery script is loaded
		wp_enqueue_script( 'jquery' );

		// Retina.js
		if ( athen_is_retina_enabled() ) {
			wp_enqueue_script( 'retina', ATHEN_JS_DIR_URI .'retina.js', array( 'jquery' ), '0.0.2', true );
		}

		// Comment reply
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		
		// Localize data
		$localize_array = array(
            'templateObjects'           => $athen_std_theme,
			'isRTL'                  	=> is_rtl(),
			'mainLayout'             	=> $athen_std_theme->main_layout,
			'mobileMenuStyle'       	=> $athen_std_theme->mobile_menu_style,
			'megaMenuWidth'             => $athen_std_theme->mega_menu_width,
			'sidrSource'             	=> $athen_std_theme->sidr_menu_source,
			'sidrDisplace'           	=> true,
			'sidrSide'               	=> $this->athen_get_mod( 'mobile_menu_sidr_direction', 'left'),
			'headerSeachStyle'       	=> $athen_std_theme->header_search_style,
			'wooCartStyle'           	=> $this->athen_get_mod( 'woo_menu_icon_style', 'drop-down' ),
			'superfishDelay'         	=> 600,
			'superfishSpeed'         	=> 'fast',
			'superfishSpeedOut'      	=> 'fast',
			'localScrollSpeed'       	=> 1000,
			'overlayHeaderStickyTop' 	=> 0,
			'siteHeaderStyle'        	=> $athen_std_theme->header_style,
			'hasFixedMobileHeader'   	=> $this->athen_get_mod( 'fixed_header_mobile', false ),
			'hasFixedHeader'         	=> $athen_std_theme->has_fixed_header,
			'fixedHeaderBreakPoint'  	=> 960,
			'hasTopBar'              	=> $athen_std_theme->has_top_bar,
			'stickyTopHeader'           => $athen_std_theme->sticky_topheader,
			'hasFooterReveal'        	=> $athen_std_theme->has_footer_reveal,
			'hasHeaderOverlay'       	=> $athen_std_theme->has_overlay_header,
			'fixedHeaderCustomLogo'  	=> $athen_std_theme->fixed_header_custom_logo,
			'shrinkFixedHeader'      	=> $athen_std_theme->shrink_fixed_header,
			'retinaLogo'             	=> $this->athen_get_mod( 'retina_logo' ),
			'carouselSpeed'		     	=> 150,
			'iLightbox'              	=> $this->ilightbox_localize_array(),
		);

		$localize_array = apply_filters( 'athen_localize_array', $localize_array );
        //var_dump($this->athen_get_mod( 'athen_tweaks', false ));
		// Load minified global scripts
		if ( $this->athen_get_mod( 'minify_js_enable', false) ) {
			wp_enqueue_script( 'total-min', ATHEN_JS_DIR_URI .'total-min.js', array( 'jquery' ), '2.0.1', true );
			wp_localize_script( 'total-min', 'athenLocalize', $localize_array );
		}
		
		// Load all non-minified js
		else {

			// Superfish used for menu dropdowns
			wp_enqueue_script( 'wpex-superfish', ATHEN_JS_DIR_URI .'lib/superfish.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'wpex-supersubs', ATHEN_JS_DIR_URI .'lib/supersubs.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'wpex-hoverintent', ATHEN_JS_DIR_URI .'lib/hoverintent.js', array( 'jquery' ), false, true );

			// Sticky header
			wp_enqueue_script( 'wpex-sticky', ATHEN_JS_DIR_URI .'lib/sticky.js', array( 'jquery' ), false, true );
			wp_localize_script( 'wpex-sticky', 'athenLocalize', array( 'retinaLogo' => $localize_array['retinaLogo'] ) );

			// Page animations
			wp_enqueue_script( 'wpex-animsition', ATHEN_JS_DIR_URI .'lib/animsition.js', array( 'jquery' ), false, true );

			// Tooltips
			wp_enqueue_script( 'wpex-tipsy', ATHEN_JS_DIR_URI .'lib/tipsy.js', array( 'jquery' ), false, true );

			// Checks if images are loaded within an element
			wp_enqueue_script( 'wpex-images-loaded', ATHEN_JS_DIR_URI .'lib/images-loaded.js', array( 'jquery' ), false, true );

			// Main masonry script
			wp_enqueue_script( 'wpex-isotope', ATHEN_JS_DIR_URI .'lib/isotope.js', array( 'jquery' ), false, true );

			// Leaner modal used for search/woo modals
			wp_enqueue_script( 'wpex-leanner-modal', ATHEN_JS_DIR_URI .'lib/leanner-modal.js', array( 'jquery' ), false, true );

			// Slider Pro
			wp_enqueue_script( 'wpex-sliderpro', ATHEN_JS_DIR_URI .'lib/jquery.sliderPro.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'wpex-sliderpro-customthumbnails', ATHEN_JS_DIR_URI .'lib/jquery.sliderProCustomThumbnails.js', array( 'jquery' ), false, true );

			// Touch Swipe - do we need it?
			wp_enqueue_script( 'wpex-touch-swipe', ATHEN_JS_DIR_URI .'lib/touch-swipe.js', array( 'jquery' ), false, true );

			// Carousels
			wp_enqueue_script( 'wpex-owl-carousel', ATHEN_JS_DIR_URI .'lib/owl.carousel.js', array( 'jquery' ), false, true );

			// Used for milestones
			wp_enqueue_script( 'wpex-count-to', ATHEN_JS_DIR_URI .'lib/count-to.js', array( 'jquery' ), false, true );
			wp_enqueue_script( 'wpex-appear', ATHEN_JS_DIR_URI .'lib/appear.js', array( 'jquery' ), false, true );

			// Mobile menu
			wp_enqueue_script( 'wpex-sidr', ATHEN_JS_DIR_URI .'lib/sidr.js', array( 'jquery' ), false, true );

			// Custom Selects
			wp_enqueue_script( 'wpex-custom-select', ATHEN_JS_DIR_URI .'lib/jquery.customSelect.js', array( 'jquery' ), false, true );

			// Equal Heights
			wp_enqueue_script( 'wpex-match-height', ATHEN_JS_DIR_URI .'lib/jquery.matchHeight.js', array( 'jquery' ), false, true );

			// Not sure if needed, lets check on that and removed if not!
			wp_enqueue_script( 'wpex-mousewheel', ATHEN_JS_DIR_URI .'lib/jquery.mousewheel.js', array( 'jquery' ), false, true );

			// Parallax bgs
			wp_enqueue_script( 'wpex-scrolly', ATHEN_JS_DIR_URI .'lib/jquery.scrolly.js', array( 'jquery' ), false, true );

			// iLightbox
			wp_enqueue_script( 'wpex-ilightbox', ATHEN_JS_DIR_URI .'lib/ilightbox.js', array( 'jquery' ), false, true );

			// WooCommerce quanity buttons
			if ( ATHEN_CHECK_WOOCOMMERCE ) {
				wp_enqueue_script( 'wc-quantity-increment', ATHEN_JS_DIR_URI .'lib/wc-quantity-increment.js', array( 'jquery' ), false, true );
			}

			// Core global functions
			wp_enqueue_script( 'wpex-functions', ATHEN_JS_DIR_URI .'functions.js', array( 'jquery' ), false, true );

			// Localize script
			wp_localize_script( 'wpex-functions', 'athenLocalize', $localize_array );

		}
	}

    /**
	 * iLightbox array for athen_localize
	 *
	 * @access  public
	 * @since   1.6.0
	 *
	 * @return  sring
	 */
	public function ilightbox_localize_array() {

		$athen_std_theme = athen_global_obj();

		$array = array(
			'skin'     => $athen_std_theme->lightbox_skin,
			'controls' => array(
				'arrows'     => $this->athen_get_mod( 'lightbox_arrows', true ),
				'thumbnail'  => $this->athen_get_mod( 'lightbox_thumbnails', true ),
				'fullscreen' => $this->athen_get_mod( 'lightbox_fullscreen', true ),
				'mousewheel' => $this->athen_get_mod( 'lightbox_mousewheel', false ),
			),
			'effects'  => array(
				'loadedFadeSpeed' => 50,
				'fadeSpeed'       => 500,
			),
			'show'     => array(
				'title' => $this->athen_get_mod( 'lightbox_titles', true ),
				'speed' => 200,
			),
			'hide'     => array(
				'speed' => 200,
			),
			'overlay' => array(
				'blur'    => true,
				'opacity' => 0.9,
			),
			'social' => array(
				'start'   => true,
				'show'    => 'mouseenter',
				'hide'    => 'mouseleave',
				'buttons' => false,
			),
			/*'social' => array(
				'buttons' => array(
					'facebook' => array(
						'text' => 'Facebook'
					),
					'twitter' => array(
						'text' => 'Twitter'
					),
					'googleplus' => array(
						'text' => 'Google Plus'
					),
					'pinterest' => array(
						'text'   => 'Pinterest',
						'source' => 'https://www.pinterest.com/pin/create/button/?url={URL}',
					),
				),
			),*/
		);
		return $array;
	}
}

new Athen_Theme_Js();
