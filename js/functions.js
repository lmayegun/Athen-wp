/**
 * Project      : Athen
 * Version      : 1.0
 */
(function($) {
    'use strict';

    var AthenTheme = {

        /**
         * Define cache var
         *
         * @since 2.0.0
         */
        cache: {},

        /**
         * Main Function
         *
         * @since 2.0.0
         */
        init: function() {
            this.config();
            this.bindEvents();
        },

        /**
         * Cache Elements
         *
         * @since 2.0.0
         */
        config: function() {

            this.config = {
                $window           : $( window ),
                $document         : $( document ),
                $windowWidth      : $( window ).width(),
                $windowHeight     : $( window ).height(),
                $windowTop        : $( window ).scrollTop(),
                $siteHeader       : $( '#site-header' ),
                $siteLogo         : $( '#site-header #site-logo img' ),
                $currentLogo      : $( '#site-header #site-logo img' ).attr( 'src' ),
                $siteHeaderHeight : 0,
                $localScrollSpeed : parseInt( athenLocalize.localScrollSpeed ),
                $localScrollArray : this.localScrollLinksArray(),
                $mobileMenuStyle  : $( '#site-navigation-wrap' ).length ? athenLocalize.mobileMenuStyle : false
            };

        },

        /**
         * Bind Events
         *
         * @since 2.0.0
         */
        bindEvents: function() {

            // Set self var to use within functions
            var self = this;

            // Update the Cache
            if ( athenLocalize.hasHeaderOverlay && $( '.overlay-header-logo' ).length ) {
                self.config.$siteLogo    = $( '.overlay-header-logo img' );
                self.config.$currentLogo = self.config.$siteLogo.attr( 'src' );
            }

            // Run on document ready
            this.config.$document.on( 'ready', function() {
 
                // Run functions
                self.pageAnimations();
                self.superFish();
                self.megaMenusTop();
                self.megaMenusWidth();
                self.mobileMenu();
                self.navNoClick();
                self.hideEditLink();
                self.customMenuWidgetAccordion();
                self.headerSearch();
                self.headerCart();
                self.backTopLink();
                self.smoothCommentScroll();
                self.tipsyTooltips();
                self.customHovers();
                self.toggleBar();
                self.localScrollLinks();
                self.customSelects();
                self.skillbar();
                self.milestone();
                self.owlCarousel();
                self.isotopeGrids();
                self.archiveMasonryGrids();
                self.iLightbox();
                self.wooSelects();
                self.footerRevealLoadShow();
                self.cptPostFilter();
				//console.log(self.layoutAutoContainer());

            } );

            // Run on Window Load
            this.config.$window.on( 'load', function() {

                // Update config
                self.config.$siteHeaderHeight = self.parseHeaderHeight();

                // Run functions
                self.equalHeights();
                self.footerRevealMainMargin();
                self.overlayHeaderTopbarOffset();
                self.fadeIn();
                self.parallax();
                self.cartSearchDropdownsRelocate();
                self.sliderPro();
				//console.log(self.layoutAutoContainer());

                // Delay functions if page animations are enabled
                if ( $.fn.animsition && athenLocalize.pageAnimation && athenLocalize.pageAnimationInDuration ) {
                    setTimeout( function() {
                        self.toggleStickyHeader();
                    }, athenLocalize.pageAnimationInDuration );
                } else {
                    self.toggleStickyHeader();
                }

                // Scroll to hash
                window.setTimeout( self.scrollToHash( self ), 500 );
                self.config.$window.on( 'hashchange', function() {
                    self.scrollToHash( self );
                } );

            } );

            // Run on Window Resize
            this.config.$window.resize( function() {

                // Update config
                self.config.$windowHeight     = self.config.$window.height();
                self.config.$windowWidth      = self.config.$window.width();
                self.config.$siteHeaderHeight = self.parseHeaderHeight();

                // Run functions
                self.megaMenusWidth();
                self.overlayHeaderTopbarOffset();
                self.toggleStickyHeader();
            } );

            // Run on Scroll
            this.config.$window.scroll( function() {

                // Update config
                self.config.$windowTop        = self.config.$window.scrollTop();
                self.config.$siteHeaderHeight = self.parseHeaderHeight();

                // Run functions
                self.megaMenusTop();
                self.localScrollHighlight();
                self.footerRevealScrollShow();

                // Overlay Header Sticky
                self.stickyHeaderOverlay();

            } );

            // On orientation change
            this.config.$window.on( 'orientationchange',function() {

                // Update config
                self.config.$windowTop        = self.config.$window.scrollTop();
                self.config.$siteHeaderHeight = self.parseHeaderHeight();

                // Run functions
                self.isotopeGrids();
                self.archiveMasonryGrids();


            } );

            // On Document click
            this.config.$document.click( function() {
                $( '#searchform-dropdown, #searchform-header-replace' ).removeClass( 'show' );
                $( 'a.search-dropdown-toggle' ).parent( 'li' ).removeClass( 'active' );
                $( '#toggle-bar-wrap' ).removeClass( 'active-bar' );
                $( 'a.toggle-bar-btn' ).children( '.fa' ).removeClass( 'fa-minus' ).addClass( 'fa-plus' );
            } );

        },

        /**
         * Page Animations
         *
         * @since 2.1.0
         */
        pageAnimations: function() {

            if ( ! $.fn.animsition ) {
                return;
            }

            // Return if wrapper doesn't exist
            if ( ! athenLocalize.pageAnimation ) {
                return;
            }

            // Run animsition
            $( '.animsition' ).animsition( {
                touchSupport : false,
                inClass      : athenLocalize.pageAnimationIn,
                outClass     : athenLocalize.pageAnimationOut,
                inDuration   : athenLocalize.pageAnimationInDuration,
                outDuration  : athenLocalize.pageAnimationOutDuration,
                linkElement  : 'a[href]:not([target="_blank"]):not([href^="#"]):not([href*="javascript"]):not([href*=".jpg"]):not([href*=".jpeg"]):not([href*=".gif"]):not([href*=".png"]):not([href*=".mov"]):not([href*=".swf"]):not([href*=".mp4"]):not([href*=".flv"]):not([href*=".avi"]):not([href*=".mp3"]):not([href^="mailto:"]):not([href*="?"]):not([href*="#localscroll"]):not([class="wcmenucart"])',
                loading      : true,
                loadingText  : athenLocalize.pageAnimationLoadingText
            } );

        },

        /**
         * Superfish menus
         *
         * @since 2.0.0
         */
        superFish: function() {

            if ( ! $.fn.superfish ) {
                return;
            }

            $( '#site-navigation ul.sf-menu' ).superfish( {
                delay       : athenLocalize.superfishDelay,
                animation   : {
                    opacity : 'show'
                },
                animationOut: {
                    opacity : 'hide'
                },
                speed       : athenLocalize.superfishSpeed,
                speedOut    : athenLocalize.superfishSpeedOut,
                cssArrows   : false,
                disableHI   : false
            } );


        },

         /**
         * MegaMenus Width
         *
         * @since 2.0.0
         */
        megaMenusWidth: function() {

            if ( this.config.$siteHeader.length === 0 || athenLocalize.siteHeaderStyle !== 'one' ) {
                return;
            }

            var $siteNavigationWrap   	= $( '#site-navigation-wrap' ),
				$megaMenuClass 		= $( 'ul.sf-menu .megamenu' ),
				$megaMenuColWidth 	= athenLocalize.megaMenuWidth ? athenLocalize.megaMenuWidth : 280,
                $headerContainerWidth	= this.config.$siteHeader.find( '.container' ).outerWidth(),
                $navWrapWidth        	= $siteNavigationWrap.outerWidth(),
                $siteNavigationWrapPosition = $siteNavigationWrap.css( 'right' ),
                $siteNavigationWrapPosition = parseInt( $siteNavigationWrapPosition );

            if ( 'auto' == $siteNavigationWrapPosition ) {
                $siteNavigationWrapPosition = 0;
            }

            var $megaMenuNegativeMargin = $headerContainerWidth-$navWrapWidth-$siteNavigationWrapPosition;
			if ( $megaMenuClass.hasClass( "col-2" ) ){
				$( '#site-navigation-wrap .megamenu > ul' ).css( {
					'width'         : $megaMenuColWidth * 2,
					'margin-left'   : -$megaMenuNegativeMargin
				} );
			}
			
			else if ( $megaMenuClass.hasClass( "col-3" ) ){
				$( '#site-navigation-wrap .megamenu > ul' ).css( {
					'width'         : $megaMenuColWidth * 3,
					'margin-left'   : -$megaMenuNegativeMargin
				} );
			}
			
			else if ( $megaMenuClass.hasClass( "col-4" ) ){
				$( '#site-navigation-wrap .megamenu > ul' ).css( {
					'width'         : $megaMenuColWidth * 4,
					'margin-left'   : -$megaMenuNegativeMargin
				} );
			}
			
			else if ( $megaMenuClass.hasClass( "col-5" ) ){
				$( '#site-navigation-wrap .megamenu > ul' ).css( {
					'width'         : $megaMenuColWidth * 5,
					'margin-left'   : -$megaMenuNegativeMargin
				} );
			}
			
			else if ( $megaMenuClass.hasClass( "col-6" ) ){
				$( '#site-navigation-wrap .megamenu > ul' ).css( {
					'width'         : $megaMenuColWidth * 6,
					'margin-left'   : -$megaMenuNegativeMargin
				} );
			}
			
			else {
				$( '#site-navigation-wrap .megamenu > ul' ).css( {
					'width'   		 :  $headerContainerWidth,
					'margin-left'   : -$megaMenuNegativeMargin
				} );
			}
			
        },

        /**
         * MegaMenus Top Position
         *
         * @since 2.0.0
         */
        megaMenusTop: function() {

            if ( this.config.$siteHeader.length === 0
                || $( '#site-navigation-wrap' ).length === 0
                || athenLocalize.siteHeaderStyle !== 'one' ) {
                return;
            }

            var $navHeight   = $( '#site-navigation-wrap' ).outerHeight(),
                $megaMenuTop = this.config.$siteHeader.outerHeight() - $navHeight;
				
			// Header Style One Megamenu Top
			if ( athenLocalize.siteHeaderStyle == "one" ){
				if ( ! $( '#site-navigation' ).hasClass( '.nav-custom-height' ) ) {
					$( '#site-navigation-wrap .megamenu > ul' ).css( {
						'top' : $megaMenuTop/2.5
					} );
				}
			}
			
			// Other Header Style 
			else {
				if ( ! $( '#site-navigation' ).hasClass( '.nav-custom-height' ) ) {
					$( '#site-navigation-wrap .megamenu > ul' ).css( {
						'top' : $megaMenuTop/2 + $navHeight
					} );
				}
			}
        },

        /**
         * Mobile Menu
         *
         * @since 2.0.0
         */
        mobileMenu: function() {

            // Sidr
            if ( 'sidr' == this.config.$mobileMenuStyle && typeof athenLocalize.sidrSource != 'undefined' ) {

                if ( ! $.fn.sidr ) {
                    return;
                }

                // Add sidr
                $( 'a.mobile-menu-toggle, li.mobile-menu-toggle > a' ).sidr( {
                    name        : 'sidr-main',
                    source      	: athenLocalize.sidrSource,
                    side        	: athenLocalize.sidrSide,
                    displace    	: athenLocalize.sidrDisplace,
                    renaming    	: true,
					body 		: '',
					/*onOpen 		: $('a.mobile-menu-toggle').click( function(){
									$('#athen-alt-capsule').wrap("<div class='mask'></div>");
						}),*/
                } );

                // Declare useful vars
                var $hasChildren = $( '.sidr-class-menu-item-has-children' );

                // Add dropdown toggle (arrow)
                $hasChildren.children( 'a' ).append( '<span class="sidr-class-dropdown-toggle"></span>' );

                // Toggle dropdowns
                $( '.sidr-class-dropdown-toggle' ).on( athenLocalize.isMobile ? 'touchstart' : 'click', function( event ) {
                    event.preventDefault();
                    var $toggleParentLink   = $( this ).parent( 'a' ),
                        $toggleParentLi     = $toggleParentLink.parent( 'li' ),
                        $allParentLis       = $toggleParentLi.parents( 'li' ),
                        $dropdown           = $toggleParentLi.children( 'ul' );
                    if ( ! $toggleParentLi.hasClass( 'active' ) ) {
                        $hasChildren.not( $allParentLis ).removeClass( 'active' ).children( 'ul' ).slideUp( 'fast' );
                        $toggleParentLi.addClass( 'active' ).children( 'ul' ).slideDown( 'fast' );
                    } else {
                        $toggleParentLi.removeClass( 'active' ).children( 'ul' ).slideUp( 'fast' );
                    }
                } );
                
                // Close sidr when clicking toggle
                $( 'a.sidr-class-toggle-sidr-close' ).on( athenLocalize.isMobile ? 'touchstart' : 'click', function( event ) {
                    event.preventDefault();
                    $( '.sidr-class-menu-item-has-children.active' ).removeClass( 'active' ).children( 'ul' ).hide();
                    $.sidr( 'close', 'sidr-main' );
                } );

                // Close sidr when cliking main content
                $( '#athen-main-capsule' ).click( function() {
                    $( '.sidr-class-menu-item-has-children.active' ).removeClass( 'active' ).children( 'ul' ).hide();
                    $.sidr( 'close', 'sidr-main' );
                } );

            }

            // Toggle
            else if ( 'toggle' == this.config.$mobileMenuStyle ) {
                
                // Add toggle nav to header
                this.config.$siteHeader.append( '<nav class="mobile-toggle-nav clr"></nav>' );

                // Grab all content from menu and add into mobile-toggle-nav element
                if ( $( '#mobile-menu-alternative' ).length ) {
                    var mobileMenuContents = $( '#mobile-menu-alternative .dropdown-menu' ).html();
                } else {
                    var mobileMenuContents = $( '#site-navigation .dropdown-menu' ).html();
                }
                $( '.mobile-toggle-nav' ).html( '<ul class="mobile-toggle-nav-ul">' + mobileMenuContents + '</ul>' );

                // Remove all classes inside prepended nav
                $( '.mobile-toggle-nav-ul, .mobile-toggle-nav-ul *' ).children().each( function() {
                    var attributes = this.attributes;
                    $( this ).removeAttr("style");
                } );

                // Add classes where needed
                $( '.mobile-toggle-nav-ul' ).addClass( 'container' );

                // Main toggle
                $( '.mobile-menu-toggle' ).on( athenLocalize.isMobile ? 'touchstart' : 'click', function( event ) {
                    $( '.mobile-toggle-nav' ).toggle();
                    return false;
                } );

                /* Add search
                $( '.mobile-toggle-nav' ).append($( '#mobile-menu-search' )); */
            }

        },

        /**
         * Prevent clickin on links
         *
         * @since 2.0.0
         */
        navNoClick: function() {

            $( 'li.nav-no-click > a, li.sidr-class-nav-no-click > a' ).live( 'click', function() {
                return false;
            } );

        },

        /**
         * Sticky Header
         *
         * @since 2.0.0
         */
        toggleStickyHeader: function() {

            // Sanitize
            if ( ! $.fn.sticky
                || ! $.fn.unstick
                || ! athenLocalize.hasFixedHeader
                //|| athenLocalize.hasHeaderOverlay 
			) {
                return;
            }

            // Destroy sticky
            this.stickyHeader( 'unstick' );

            // Run sticky
            if ( athenLocalize.hasFixedMobileHeader || ( this.config.$windowWidth >= athenLocalize.fixedHeaderBreakPoint ) ) {
                this.stickyHeader();
                var contW = $( '#athen-alt-capsule' ).outerWidth();
		var stage = athenLocalize.hasHeaderOverlay;
            }
        },
		
		/**
		 * Layout Auto Container
		 *
		 * @since 1.0.0
		**/
		layoutAutoContainer: function() {
			
			// Check Layout Style 
			if ( ! athenLocalize.mainLayout == 'layout-one' 
				||  ! athenLocalize.hasHeaderOverlay ) {	
				return;
			}
	
			// Get container width 
			var altCapsuleContainer = $( '#site-header' ).outerWidth();
				
			// Get elements with container 
			$( '#header-top', '#site-header-inner' ).css( 'width', altCapsuleContainer );
				
			return 'yes';
		},
		

        /**
         * Sticky Header
         *
         * @since 2.0.0
         */
        stickyHeader: function( event ) {

            // Descroty sticky
            if ( 'unstick' == event ) {

                $( '#header-top' ).unstick();
                $( '.fixed-nav' ).unstick();
                $( '#top-bar-wrap' ).unstick();

            }

            // Add Sticky
            else {
                if ( athenLocalize.stickyTopHeader == true ){
                    $( '#header-top' ).sticky( {
                        topSpacing          : 0,
                        getWidthFrom        : '',
                        responsiveWidth     : true,
                        center		: true,
                        shrink              : athenLocalize.shrinkFixedHeader ? false : true,
                        //customHeaderLogo    : athenLocalize.fixedHeaderCustomLogo
                    } );
;		}	
		if ( athenLocalize.siteHeaderStyle == 'two' ){
                    $( '#site-header-inner' ).sticky( {
                        topSpacing      : 0,
			getWidthFrom    : '',
			center  	: true,
			responsiveWidth : true
                    } );
		};
				
		if ( athenLocalize.stickyTopHeader == true ){
                    $( '#top-bar-wrap' ).sticky( {
                    	topSpacing      : 0,
			getWidthFrom    : '#athen-alt-capsule',
			responsiveWidth : true
                    } );
		}
            }

        },

        /**
         * Sticky Header Overlay
         *
         * @since 2.0.0
         */
        stickyHeaderOverlay: function() {

            // Validate
            if ( ! this.config.$siteHeader.length
                 || athenLocalize.mainLayout !== 'full-width'
                 || ! athenLocalize.hasFixedHeader
                 || ! athenLocalize.hasHeaderOverlay
            ) {
                return;
            };

            // Disable on mobile
            if ( ! athenLocalize.hasFixedMobileHeader && ( this.config.$windowWidth <= athenLocalize.fixedHeaderBreakPoint ) ) {
                return;
            }

            var $el = $( '#site-header.fix-overlay-header' );

            // Has topbar
            if ( athenLocalize.hasTopBar ) {

                if ( this.config.$windowTop > this.config.$siteHeader.outerHeight() ) {
                    if (  ! $( $el ).hasClass( 'is-sticky' ) ) {
                        $( $el ).addClass( 'is-sticky' );
                        /*if ( this.config.$fixedHeaderCustomLogo && this.config.$fixedHeaderCustomLogo !== this.config.$siteLogo.attr( 'src' ) ) {
                            this.config.$siteLogo.attr( 'src', this.config.$fixedHeaderCustomLogo );
                        }*/
                    }
                } else {
                    $( $el ).removeClass( 'is-sticky' );
                    /*this.config.$siteLogo.attr( 'src', this.config.$currentLogo );*/
                }

            }

            // No topbar
            else {

                if ( this.config.$windowTop > 0 ) {
                    if (  ! $( $el ).hasClass( 'is-sticky' ) ) {
                        $( $el ).addClass( 'is-sticky' );
                    }
                } else {
                    $( $el ).removeClass( 'is-sticky' );
                }

            }

        },

        /**
         * Sticky Header Overlay TopbarOffset
         *
         * @since 2.0.0
         */
        overlayHeaderTopbarOffset: function() {

            if ( ! athenLocalize.hasFixedHeader
                || ! athenLocalize.hasHeaderOverlay
                || ! athenLocalize.hasTopBar
            ) {
                return;
            }

            var $paddingEl = ( athenLocalize.mainLayout == 'boxed' ) ? $( '#wrap' ) : $( '#outer-wrap' );
            
            $( $paddingEl ).css( {
                'padding-top' : $( '#top-bar-wrap' ).outerHeight()
            } );

            $( '#site-header.overlay-header' ).css( {
                'top' : $( '#top-bar-wrap' ).outerHeight()
            } );

        },

        /**
         * Header Search
         *
         * @since 2.0.0
         */
        headerSearch: function() {

            // Dropdown
            if ( 'drop_down' == athenLocalize.headerSeachStyle ) {

                $( 'a.search-dropdown-toggle' ).click( function( event ) {
                    $( '#searchform-dropdown' ).toggleClass( 'show' );
                    $( '#searchform-dropdown input' ).focus();
                    $( this ).parent( 'li' ).toggleClass( 'active' );
                    $( 'div#current-shop-items-dropdown' ).removeClass( 'show' );
                    $( 'li.wcmenucart-toggle-dropdown' ).removeClass( 'active' );
                    return false;
                } );

                $( '#searchform-dropdown' ).click( function( event ) {
                    event.stopPropagation();
                } );

            }

            // Overlay Modal
            else if ( 'overlay' == athenLocalize.headerSeachStyle ) {

                if ( ! $.fn.leanerModal ) {
                    return;
                }

                var $searchOverlayToggle = $( 'a.search-overlay-toggle' );

                $searchOverlayToggle.leanerModal( {
                    id      : '#searchform-overlay',
                    top     : 100,
                    overlay : 0.8
                } );

                $searchOverlayToggle.click( function() {
                    $( '#site-searchform input' ).focus();
                } );

            }
            
            // Header Replace
            else if ( 'header_replace' == athenLocalize.headerSeachStyle ) {
                var $headerReplace = $( '#searchform-header-replace' );
                $( 'a.search-header-replace-toggle' ).click( function( event ) {
                    $headerReplace.toggleClass( 'show' );
                    $headerReplace.find( 'input' ).focus();
                    return false;
                } );
                $( '#searchform-header-replace-close' ).click( function() {
                    $headerReplace.removeClass( 'show' );
                    return false;
                } );
                $headerReplace.click( function( event ) {
                    event.stopPropagation();
                } );
            }

        },

        /**
         * Header Cart
         *
         * @since 2.0.0
         */
        headerCart: function() {

            if ( $( 'a.wcmenucart' ).hasClass( 'go-to-shop' ) ) {
                return;
            }

            // Drop-down
            if ( 'drop-down' == athenLocalize.wooCartStyle ) {

                // Display cart dropdown
                $( '.toggle-cart-widget' ).click( function( event ) {
                    $( '#searchform-dropdown' ).removeClass( 'show' );
                    $( 'a.search-dropdown-toggle' ).parent( 'li' ).removeClass( 'active' );
                    $( 'div#current-shop-items-dropdown' ).toggleClass( 'show' );
                    $( this ).toggleClass( 'active' );
                    return false;
                } );

                // Hide cart dropdown
                $( 'div#current-shop-items-dropdown' ).click( function( event ) {
                    event.stopPropagation(); 
                } );
                this.config.$document.click( function() {
                    $( 'div#current-shop-items-dropdown' ).removeClass( 'show' );
                    $( 'li.wcmenucart-toggle-dropdown' ).removeClass( 'active' );
                } );

                // Prevent body scroll on current shop dropdown
                $( '#current-shop-items-dropdown' ).bind( 'mousewheel DOMMouseScroll', function ( e ) {
                    var e0      = e.originalEvent,
                        delta   = e0.wheelDelta || -e0.detail;
                    this.scrollTop += ( delta < 0 ? 1 : -1 ) * 30;
                    e.preventDefault();
                } );

            }

            // Modal
            else if ( 'overlay' == athenLocalize.wooCartStyle ) {

                if ( ! $.fn.leanerModal ) {
                    return;
                }

                $( '.toggle-cart-widget' ).leanerModal( {
                    id      : '#current-shop-items-overlay',
                    top     : 100,
                    overlay : 0.8
                } );

            }

        },

        /**
         * Relocate the cart and search dropdowns for specific header styles
         *
         * @since 2.0.0
         */
        cartSearchDropdownsRelocate: function() {

            // Return if header overlay is enabled
            if ( athenLocalize.hasHeaderOverlay ) {
                return;
            }

            // Only needed for specific header styles
            if ( athenLocalize.siteHeaderStyle !== 'three' && athenLocalize.siteHeaderStyle !== 'four' ) {
                return;
            }

            // Define search and cart elements
            var $searchDrop = $( '#searchform-dropdown' ),
                $shopDrop   = $( '#current-shop-items-dropdown');

            // Return if search and shop drops don't exist
            if ( ! $searchDrop && ! $shopDrop ) {
                return;
            }

            // Last menu item offset
            var $lastMenuItem       = $( '#site-navigation .dropdown-menu > li:nth-last-child(1)' ),
                $lastMenuItemOffset = $lastMenuItem.position();

            // Position search dropdown
            if ( $searchDrop.length ) {

                var $searchDropPosition = $lastMenuItemOffset.left - $searchDrop.outerWidth() + $lastMenuItem.width();

                $searchDrop.css( {
                    'right' : 'auto',
                    'left'  : $searchDropPosition
                } );

            }

            // Position Woo dropdown
            if ( $shopDrop.length ) {

                var $shopDropPosition = $lastMenuItemOffset.left - $shopDrop.outerWidth() + $lastMenuItem.width();

                $shopDrop.css( {
                    'right' : 'auto',
                    'left'  : $shopDropPosition
                } );

            }

        },

        /**
         * Hide post edit link
         *
         * @since 2.0.0
         */
        hideEditLink: function() {

            $( 'a.hide-post-edit' ).click( function() {
                $( 'div.post-edit' ).hide();
                return false;
            } );

        },

        /**
         * Custom menu widget toggles
         *
         * @since 2.0.0
         */
        customMenuWidgetAccordion: function() {

            var self = this;

            $( '#main .widget_nav_menu .current-menu-ancestor' ).addClass( 'active' ).children( 'ul' ).show();

            $( 'div#main .widget_nav_menu' ).each( function() {
                var $widgetMenu     = $( this ),
                    $hasChildren    = $( this ).find( '.menu-item-has-children' ),
                    $allSubs        = $hasChildren.children( '.sub-menu' );
                $hasChildren.each( function() {
                    $( this ).addClass( 'parent' );
                    var $links = $( this ).children( 'a' );
                    $links.on( self.config.$isMobile ? 'touchstart' : 'click', function( event ) {
                        event.preventDefault();
                        var $linkParent = $( this ).parent( 'li' ),
                            $allParents = $linkParent.parents( 'li' );
                        if ( ! $linkParent.hasClass( 'active' ) ) {
                            $hasChildren.not( $allParents ).removeClass( 'active' ).children( '.sub-menu' ).slideUp( 'fast' );
                            $linkParent.addClass( 'active' ).children( '.sub-menu' ).slideDown( 'fast' );
                        } else {
                            $linkParent.removeClass( 'active' ).children( '.sub-menu' ).slideUp( 'fast' );
                        }
                    } );
                } );
            } );

        },

        /**
         * Back to top link
         *
         * @since 2.0.0
         */
        backTopLink: function() {

            var $scrollTopLink = $( 'a#site-scroll-top' );

            this.config.$window.scroll( function() {

                if ( $( this ).scrollTop() > 100 ) {
                    $scrollTopLink.addClass( 'show' );
                } else {
                    $scrollTopLink.removeClass( 'show' );
                }

            } );

            $scrollTopLink.on( athenLocalize.isMobile ? 'touchstart' : 'click', function( event ) {
                event.preventDefault();
                $( 'html, body' ).animate( {
                    scrollTop : 0
                }, 400 );
            } );

        },

        /**
         * Smooth Comment Scroll
         *
         * @since 2.0.0
         */
        smoothCommentScroll: function() {

            $( '.single li.comment-scroll a' ).click( function( event ) {
                event.preventDefault();
                $( 'html, body' ).animate( {
                    scrollTop: $( this.hash ).offset().top -180
                }, 'normal' );
            } );

        },

        /**
         * Tooltips
         *
         * @since 2.0.0
         */
        tipsyTooltips: function() {

            if ( ! $.fn.tipsy ) {
                return;
            }

            $( 'a.tooltip-left' ).tipsy( {
                fade    : true,
                gravity : 'e'
            } );

            $( 'a.tooltip-right' ).tipsy( {
                fade    : true,
                gravity : 'w'
            } );

            $( 'a.tooltip-up' ).tipsy( {
                fade    : true,
                gravity : 's'
            } );

            $( 'a.tooltip-down' ).tipsy( {
                fade    : true,
                gravity : 'n'
            } );

        },

        /**
         * Custom hovers using data attributes
         *
         * @since 2.0.0
         */
        customHovers: function() {

            $( '.wpex-data-hover' ).each( function() {

                var $this           = $( this ),
                    $originalBg     = $( this ).css( 'backgroundColor' ),
                    $originalColor  = $( this ).css( 'color' ),
                    $hoverBg        = $( this ).attr( 'data-hover-background' ),
                    $hoverColor     = $( this ).attr( 'data-hover-color' );

                $this.hover( function () {
                    if ( CSSStyleDeclaration.prototype.setProperty != undefined ) {
                        if ( $hoverBg ) {
                            this.style.setProperty( 'background-color', $hoverBg, 'important' );
                        }
                        if ( $hoverColor ) {
                            this.style.setProperty( 'color', $hoverColor, 'important' );
                        }
                    } else {
                        if ( $hoverBg ) {
                            $this.css( 'background-color', $hoverBg );
                        }
                        if ( $hoverColor ) {
                            $this.css( 'color', $hoverColor );
                        }
                    }
                }, function () {
                    if ( CSSStyleDeclaration.prototype.setProperty != undefined ) {
                        if ( $hoverBg ) {
                            this.style.setProperty( 'background-color', $originalBg, 'important' );
                        }
                        if ( $hoverColor ) {
                            this.style.setProperty( 'color', $originalColor, 'important' );
                        }
                    } else {
                        if ( $hoverBg && $originalBg ) {
                            $this.css( 'background-color', $originalBg );
                        }
                        if ( $hoverColor && $originalColor ) {
                            $this.css( 'color', $originalColor );
                        }
                    }
                } );

            } );

        },


        /**
         * Togglebar toggle
         *
         * @since 2.0.0
         */
        toggleBar: function() {

            $( 'a.open-togglebar' ).on( athenLocalize.isMobile ? 'touchstart' : 'click', function( event ) {
                $( '.toggle-bar-btn' ).find( '.fa' ).toggleClass( 'fa-plus fa-minus' );
                $( '#toggle-bar-wrap' ).toggleClass( 'active-bar' );
                return false;
            } );

            $( '#toggle-bar-wrap' ).click( function( event ) {
                event.stopPropagation();
            } );

        },

        /**
         * Skillbar
         *
         * @since 2.0.0
         */
        skillbar: function() {

            if ( ! $.fn.appear ) {
                return;
            }

            $( '.vcex-skillbar' ).each( function() {
                var $this = $( this );
                $this.appear( function() {
                    $this.find( '.vcex-skillbar-bar' ).animate( {
                        width: $( this ).attr( 'data-percent' )
                    }, 800 );
                } );
            }, {
                accX : 0,
                accY : 0
            } );

        },

        /**
         * Milestones
         *
         * @since 2.0.0
         */
        milestone: function() {

            if ( ! $.fn.appear || ! $.fn.countTo ) {
                return;
            }

            $( '.vcex-animated-milestone' ).each( function() {
                $( this ).appear( function() {
                    $( this ).find( '.vcex-milestone-time' ).countTo( {
                        formatter: function ( value, options ) {
                            return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
                        },
                    } );
                }, {
                    accX : 0,
                    accY : 0
                } );
            } );

        },

        /**
         * Advanced Parallax
         *
         * @since 2.0.0
         */
        parallax: function() {

            if ( ! $.fn.scrolly ) {
                return;
            }
            
            $('.parallax').scrolly({bgParallax: true});

            $( '.parallax' ).each( function() {
                var $this = $( this );
                $this.scrolly().trigger( 'scroll' );
                $this.css( {
                    'opacity' : 1
                } );
            } );

        },

        /**
         * Header Height
         *
         * @since 2.0.0
         */
        parseHeaderHeight: function() {
            if ( this.config.$siteHeader.length === 0 ) {
                return 0;
            } else {
                return this.config.$siteHeader.outerHeight();
            }
        },

        /**
         * Local scroll links array
         *
         * @since 2.0.0
         */
        localScrollLinksArray: function() {

            // Define array
            var $localScrollArray = []

            // Return if no local-scroll links
            if ( ! $( 'li.local-scroll' ).length ) {
                return $localScrollArray;
            }

            var $localScrollLinks = $( '#site-navigation li.local-scroll' ).children( 'a' );

            for ( var i=0; i < $localScrollLinks.length; i++ ) {    
                var $localScrollLink    = $localScrollLinks[i],
                    $localScrollLinkRef = $( $localScrollLink ).attr( 'href' );
                if ( $( $localScrollLinkRef ).length ) {
                    $localScrollArray.push( $localScrollLinkRef );
                }
            }

            // Return array of local scroll links
            return $localScrollArray;

        },

        /**
         * Local Scroll link
         *
         * @since 2.0.0
         */
        localScrollLinks: function() {

            // Set global object to "self" var
            var self = this;

            // Local Scroll - Menu
            $( 'li.local-scroll > a, li.sidr-class-local-scroll > a, .vcex-navbar-link.local-scroll, .local-scroll' ).click(function() {

                // Get target
                var $target = $( this.hash );

                // Scroll to target
                if ( $( $target ).length ) {
                    $( 'html,body' ).stop( true,true ).animate( {
                        scrollTop: $target.offset().top /*- self.config.$siteHeaderHeight*/
                    }, self.config.$localScrollSpeed );
                }

                // Close sidr mobile menu
                if ( $.fn.sidr != undefined && 'sidr' == self.config.$mobileMenuStyle ) {
                    $.sidr( 'close', 'sidr-main' );
                } else if ( 'toggle' == self.config.$mobileMenuStyle ) {
                    $( '.mobile-toggle-nav' ).hide();
                }

                // Prevent default click actions
                return false;

            } );

            // Local Scroll Anylink
            $( '.local-scroll-link' ).click( function() {
                var $target = $( this.hash );
                if ( $( $target ).length ) {
                    $( 'html,body' ).stop( true, true ).animate( {
                        scrollTop: $target.offset().top - self.config.$siteHeaderHeight
                    }, self.config.$localScrollSpeed );
                }
                return false;
            } );

            // LocalScroll Woocommerce Reviews
            $( 'body.single div.entry-summary a.woocommerce-review-link' ).click( function() {
                var $target = $( this.hash );
                if ( $( $target ).length ) {
                    $( 'html,body' ).stop( true, true ).animate( {
                        scrollTop: $target.offset().top - self.config.$siteHeaderHeight - 30
                    }, 800 );
                }
                return false;
            } );

        },

        /**
         * Local Scroll Highlight on scroll
         *
         * @since 2.0.0
         */
        localScrollHighlight: function() {

            // Return if local scroll links array is empty
            if ( $localScrollArray === 0 ) {
                return;
            }

            // Get local scroll array
            var $localScrollArray = this.config.$localScrollArray;

            // Return if there aren't any local scroll items
            if ( $localScrollArray.length === 0 ) {
                return;
            }

            // Define vars
            var $windowPos    = this.config.$window.scrollTop(),
                $windowHeight = this.config.$windowHeight,
                $docHeight    = this.config.$document.height();

            // Highlight active items
            for ( var i=0; i < $localScrollArray.length; i++ ) {
                var $theID = $localScrollArray[i];
                if ( $( $theID ).length ) {
                        var $divPos     = $( $theID ).offset().top - this.config.$siteHeader.outerHeight(),
                            $divHeight  = $( $theID ).height();
                    if ( $windowPos >= $divPos && $windowPos < ( $divPos + $divHeight ) ) {
                        $( "li.local-scroll a[href='" + $theID + "']" ).parent( 'li' ).addClass( 'current-menu-item' );
                    } else {
                        $( "li.local-scroll a[href='" + $theID + "']" ).parent( 'li' ).removeClass( 'current-menu-item' );
                    }
                }
            }

            // Highlight last item if at bottom of page
            var $lastLink = $localScrollArray[$localScrollArray.length-1];
            if ( $windowPos + $windowHeight == $docHeight ) {
                $( '.local-scroll.current-menu-item' ).removeClass( 'current-menu-item' );
                $( "li.local-scroll a[href='" + $lastLink + "']" ).parent( 'li' ).addClass( 'current-menu-item' );
            }

        },

        /**
         * Scroll to Hash
         *
         * @since 2.0.0
         */
        scrollToHash: function( $this ) {

            // Declare site header var
            var $siteHeader = $( '#site-header' );

            // Return if there isn't a header
            if ( $siteHeader.length === 0 ) {
                return;
            }

            // Declare function vars
            var self  = this,
                $hash = location.hash;

            // Scroll to hash
            if ( $hash.indexOf( 'localscroll-' ) != -1 ) {

                var $target = $hash.replace( 'localscroll-','' ),
                    $speed  = parseInt( athenLocalize.localScrollSpeed );

                if ( ! $( $target ).length ) {
                    return;
                }

                $( 'html,body' ).animate( {
                    scrollTop: $( $target ).offset().top - self.config.$siteHeaderHeight
                }, $speed );

            }

        },

        /**
         * Equal heights function
         *
         * @since 2.0.0
         */
        equalHeights: function() {

            // Make sure equal heights function is defined
            if ( ! $.fn.matchHeight ) {
                return;
            }
            
            // Add equal heights
            $( '.match-height-grid .vcex-blog-entry' ).matchHeight();

        },

        /**
         * Footer Reveal Margin
         *
         * @since 2.0.0
         */
        footerRevealMainMargin: function() {

            // Return if Footer Reveal is disabled
            if ( ! athenLocalize.hasFooterReveal || $( '#wrap' ).length === 0 ) {
                return;
            }

            // Add margin to wrap equal to footer-reveal height
            $( '#wrap' ).css( {
                'margin-bottom': $( '.footer-reveal' ).outerHeight()
            } );

        },

        /**
         * Footer Reveal Display on Load
         *
         * @since 2.0.0
         */
        footerRevealLoadShow: function() {

            // Return if Footer Reveal is disabled or wrap element doesn't exist
            if ( ! athenLocalize.hasFooterReveal || $( '#wrap' ).length === 0 ) {
                return;
            }

            // Show Footer Reveal on load if the window height is greater then the wrap
            if ( $( window ).height() > $( '#wrap' ).height() ) {
                $( '.footer-reveal' ).show().addClass( 'visible' );
            }

        },

        /**
         * Footer Reveal Display on Scroll
         *
         * @since 2.0.0
         */
        footerRevealScrollShow: function() {

            // Return if footer reveal is disabled
            if ( ! athenLocalize.hasFooterReveal ) {
                return;
            }

            // Return if the footer reveal is already visible
            if ( $( '.footer-reveal' ).hasClass( 'visible' ) ) {
                return;
            }

            // Get main element top offset
            var $mainTop = $( '#main' ).offset().top;

            // Show/hide the footer based on the main offset
            if ( this.config.$windowTop > $mainTop ) {
                $( '.footer-reveal' ).show();
            } else {
                $( '.footer-reveal' ).hide();
            }

        },

        /**
         * Custom Selects
         *
         * @since 2.0.0
         */
        customSelects: function() {

            // Return if the customSelect function doesn't exist
            if ( ! $.fn.customSelect ) {
                return;
            } 
            
            // Add custom Selects to various selects
            $( '.woocommerce-ordering .orderby, #dropdown_product_cat, .widget_categories select, .widget_archive select, #bbp_stick_topic_select, #bbp_topic_status_select, #bbp_destination_topic, .single-product .variations_form .variations select' ).customSelect( {
                customClass : 'theme-select'
            } );

        },

        /**
         * FadeIn Elements
         *
         * @since 2.0.0
         */
        fadeIn: function() {
            $( '.fade-in-image, .show-on-load' ).addClass( 'no-opacity' );
        },

        /**
         * OwlCarousel
         *
         * @since 2.0.0
         */
        owlCarousel: function() {

            if ( ! $.fn.owlCarousel ) {
                return;
            }

            $( '.athen-blog-carousel' ).each( function() {

                var $this = $( this ),
                    $data = $this.data(),
                    $rtl  = athenLocalize.isRTL ? true : false;

                $this.owlCarousel( {
                    animateIn       : false,
                    animateOut      : false,
                    lazyLoad        : false,
                    smartSpeed      : athenLocalize.carouselSpeed,
                    rtl             : $rtl,
                    dots            : $data.dots,
                    nav             : $data.nav,
                    items           : $data.items,
                    slideBy         : $data.slideby,
                    center          : $data.center,
                    loop            : $data.loop,
                    margin          : $data.margin,
                    autoplay        : $data.autoplay,
                    autoplayTimeout : $data.autoplayTimeout,
                    navText         : [ '<span class="fa fa-chevron-left"><span>', '<span class="fa fa-chevron-right"></span>' ],
                    responsive      : {
                        0   : {
                            items   : $data.itemsMobilePortrait
                        },
                        480 : {
                             items  : $data.itemsMobileLandscape
                        },
                        768 : {
                            items   : $data.itemsTablet
                        },
                        960 : {
                            items   : $data.items
                        }
                    }
                } );
            } );

        },

        /**
         * SliderPro
         *
         * @since 2.0.0
         */
        sliderPro: function() {

            // Return if sliderPro script isn't defined
            if ( ! $.fn.sliderPro ) {
                return;
            }

            // Set main object to self
            var self = this;

            // Loop through each slider
            $( '.wpex-slider' ).each( function() {

                // Declare vars
                var $slider = $( this ),
                    $data   = $slider.data();

                // Parse Slider data
                var $animationSpeed          = self.parseData( $data.animationSpeed, 600 ),
                    $loop                    = self.parseData( $data.loop, false ),
                    $fade                    = self.parseData( $data.fade, 600 ),
                    $direction               = self.parseData( $data.direction, 'horizontal' ),
                    $autoPlay                = self.parseData( $data.autoPlay, true ),
                    $autoPlayDelay           = self.parseData( $data.autoPlayDelay, 5000 ),
                    $touchSwipe              = self.parseData( $data.touchSwipe, true ),
                    $buttons                 = self.parseData( $data.buttons, true ),
                    $arrows                  = self.parseData( $data.arrows, true ),
                    $fadeArrows              = self.parseData( $data.fadeArrows, true ),
                    $shuffle                 = self.parseData( $data.shuffle, false ),
                    $fullscreen              = self.parseData( $data.fullscreen, false ),
                    $slideDistance           = self.parseData( $data.slideDistance, 0 ),
                    $heightAnimationDuration = self.parseData( $data.heightAnimationDuration, 500 ),
                    $thumbnailPointer        = self.parseData( $data.thumbnailPointer, false ),
                    $thumbnailHeight         = self.parseData( $data.thumbnailHeight, 70 ),
                    $thumbnailWidth          = self.parseData( $data.thumbnailWidth, 70 ),
                    $updateHash              = self.parseData( $data.updateHash, false ),
                    $fadeCaption             = self.parseData( $data.fadeCaption, true ),
                    $autoHeight              = self.parseData( $data.autoHeight, true );

                // Lets show things that were hidden to prevent flash
                $( '.wpex-slider-slide, .wpex-slider-thumbnails' ).css( {
                        'opacity'   : 1,
                        'display'   : 'block'
                } );

                // Run slider
                $slider.sliderPro( {
                    responsive              : true,
                    width                   : '100%',
                    height                  : '300',
                    fade                    : $fade,
                    touchSwipe              : $touchSwipe,
                    fadeDuration            : $animationSpeed,
                    slideAnimationDuration  : $animationSpeed,
                    autoHeight              : $autoHeight,
                    heightAnimationDuration : $heightAnimationDuration,
                    arrows                  : $arrows,
                    fadeArrows              : $fadeArrows,
                    autoplay                : $autoPlay,
                    autoplayDelay           : $autoPlayDelay,
                    buttons                 : $buttons,
                    shuffle                 : $shuffle,
                    orientation             : $direction,
                    loop                    : $loop,
                    keyboard                : false,
                    fullScreen              : $fullscreen,
                    slideDistance           : $slideDistance,
                    thumbnailHeight         : $thumbnailHeight,
                    thumbnailWidth          : $thumbnailWidth,
                    thumbnailPointer        : $thumbnailPointer,
                    updateHash              : $updateHash,
                    thumbnailArrows         : false,
                    fadeThumbnailArrows     : false,
                    thumbnailTouchSwipe     : true,
                    fadeCaption             : $fadeCaption,
                    captionFadeDuration     : 500,
                    waitForLayers           : true,
                    autoScaleLayers         : true,
                    forceSize               : 'none',
                    thumbnailPosition       : 'bottom',
                    reachVideoAction        : 'playVideo',
                    leaveVideoAction        : 'pauseVideo',
                    endVideoAction          : 'nextSlide',
                    init                    : function( event ) {
                        $slider.prev( '.wpex-slider-preloaderimg' ).hide();
                        if ( $slider.parent( '.gallery-format-post-slider' ) && $( '.blog-masonry-grid' ).length ) {
                            setTimeout( function() {
                                $( '.blog-masonry-grid' ).isotope( 'layout' );
                            }, $heightAnimationDuration + 1 );
                        }
                    },
                    gotoSlideComplete       : function( event ) {
                        if ( $slider.parent( '.gallery-format-post-slider' ) && $( '.blog-masonry-grid' ).length ) {
                            $( '.blog-masonry-grid' ).isotope( 'layout' );
                        }
                    }

                } );

            } );

            // WooCommerce: Prevent clicking on Woo entry slider
            $( '.woo-product-entry-slider' ).click( function() {
                return false;
            } );
           
        },

        /**
         * Isotope Grids
         *
         * @since 2.0.0
         */
        isotopeGrids: function() {

            if ( ! $.fn.imagesLoaded || ! $.fn.isotope ) {
                return;
            }

            var self = this;

            $( '.vcex-isotope-grid' ).each( function() {

                // Get data
                var $container          = $( this ),
                    $transitionDuration = $container.data( 'transition-duration' ),
                    $layoutMode         = $container.data( 'layout-mode' ),
                    $isOriginLeft       = athenLocalize.isRTL ? false : true;

                // Sanitize
                $transitionDuration = $transitionDuration ? $transitionDuration : '0.4';
                $layoutMode         = $layoutMode ? $layoutMode : 'masonry';


                // Make sure images are loaded first
                $container.imagesLoaded( function() {

                    // Initialize isotope
                    $container.isotope( {
                        itemSelector        : '.vcex-isotope-entry',
                        transformsEnabled   : true,
                        isOriginLeft        : $isOriginLeft,
                        transitionDuration  : $transitionDuration + 's',
                        layoutMode          : $layoutMode
                    } );

                    // Isotope filter links
                    var $filter = $container.prev( 'ul.vcex-filter-links' );

                    if ( $filter.length ) {
                        var $filterLinks = $filter.find( 'a' );
                        $filterLinks.each( function() {
                            var $filterableDiv = $( this ).data( 'filter' );
                            if ( $filterableDiv !== '*' && ! $container.find($filterableDiv).length ) {
                                $( this ).parent().addClass( 'hidden' );
                            }
                        } );
                        $filterLinks.css( { opacity: 1 } );
                        $filterLinks.click( function() {
                            var selector = $( this ).attr( 'data-filter' );
                                $container.isotope( {
                                    filter: selector
                                } );
                                $( this ).parents( 'ul' ).find( 'li' ).removeClass( 'active' );
                                $( this ).parent( 'li' ).addClass( 'active' );
                            return false;
                        } );
                    }

                } );

            } );

        },

        /**
         * Isotope Grids
         *
         * @since 2.0.0
         */
        archiveMasonryGrids: function() {

            if ( ! $.fn.imagesLoaded || ! $.fn.isotope ) {
                return;
            }

            // Define vars
            var $container          = $( '.blog-masonry-grid,div.wpex-row.portfolio-masonry,div.wpex-row.portfolio-no-margins,div.wpex-row.staff-masonry,div.wpex-row.staff-no-margins' ),
                $transitionDuration = $container.data( 'transition-duration' ),
                $layoutMode         = $container.data( 'layout-mode' ),
                $isOriginLeft       = athenLocalize.isRTL ? false : true;

                // Sanitize
                $transitionDuration = ( typeof $transitionDuration != 'undefined' ) ? $transitionDuration : '0.0';
                $layoutMode         = ( typeof $layoutMode != 'undefined' ) ? $layoutMode : 'masonry';

            // Load isotope after images loaded
            $container.imagesLoaded( function() {
                $container.isotope( {
                    itemSelector        : '',
                    transformsEnabled   : true,
                    isOriginLeft        : $isOriginLeft,
                    transitionDuration  : $transitionDuration + 's'
                } );
            } );
        },
        
        /**
         * Theme CPT Filter 
         * 
         * @since 1.0.0
         */
        cptPostFilter : function(){
           
            //cancel out blog entries
            var $grid = $('.post-type-entries').isotope({
                itemSelector: '.staff-entry, .portfolio-entry',
              });
              // filter functions
              var filterFns = {

              };
              // bind filter button click
              $('.filters-button-group').on( 'click', 'li', function() {
                var filterValue = $( this ).attr('data-filter');
                // use filterFn if matches value
                filterValue = filterFns[ filterValue ] || filterValue;
                $grid.isotope({ filter: filterValue });
              });    
        }, 

        /**
         * iLightbox
         *
         * @since 2.0.0
         */
        iLightbox: function() {

            if ( ! $.fn.iLightBox ) {
                return;
            }

            // Set main object to self
            var self = this;

            // Lightbox Standard
            $( '.wpex-lightbox' ).each( function() {

                var $this = $( this ),
                    $data = $this.data(),
                    $skin = self.parseData( $data.skin, athenLocalize.iLightbox.skin );

                $this.iLightBox( {
                    skin     : $skin,
                    controls : {
                        fullscreen : athenLocalize.iLightbox.controls.fullscreen
                    },
                    show : {
                        title : athenLocalize.iLightbox.show.title,
                        speed : parseInt( athenLocalize.iLightbox.show.speed )
                    },
                    hide : {
                        speed : parseInt( athenLocalize.iLightbox.hide.speed )
                    },
                    effects: {
                        reposition      : true,
                        repositionSpeed : 200,
                        switchSpeed     : 300,
                        loadedFadeSpeed : athenLocalize.iLightbox.effects.loadedFadeSpeed,
                        fadeSpeed       : athenLocalize.iLightbox.effects.fadeSpeed
                    },
                    overlay : athenLocalize.iLightbox.overlay,
                    social  : athenLocalize.iLightbox.social
                } );

            } );

            // Lightbox Videos => OLD SCHOOL STUFF, keep for old customers
            $( '.wpex-lightbox-video, .wpb_single_image.video-lightbox a, .wpex-lightbox-autodetect, .wpex-lightbox-autodetect a' ).each( function() {

                var $this = $( this ),
                    $data = $this.data(),
                    $skin = self.parseData( $data.skin, athenLocalize.iLightbox.skin );

                $this.iLightBox( {
                    smartRecognition : true,
                    skin : $skin,
                    path : 'horizontal',
                    controls : {
                        fullscreen : athenLocalize.iLightbox.controls.fullscreen
                    },
                    show : {
                        title : athenLocalize.iLightbox.show.title,
                        speed : parseInt( athenLocalize.iLightbox.show.speed )
                    },
                    hide : {
                        speed : parseInt( athenLocalize.iLightbox.hide.speed )
                    },
                    effects: {
                        reposition      : true,
                        repositionSpeed : 200,
                        switchSpeed     : 300,
                        loadedFadeSpeed : athenLocalize.iLightbox.effects.loadedFadeSpeed,
                        fadeSpeed       : athenLocalize.iLightbox.effects.fadeSpeed
                    },
                    overlay : athenLocalize.iLightbox.overlay,
                    social  : athenLocalize.iLightbox.social
                } );
            } );

            // Lightbox Galleries - NEW since 1.6.0
            $( '.lightbox-group' ).each( function() {

                // Get lightbox data
                var $this       = $( this ),
                    $item       = $this.find( 'a.lightbox-group-item' ),
                    $data       = $this.data(),
                    $skin       = self.parseData( $data.skin, athenLocalize.iLightbox.skin ),
                    $skin       = self.parseData( $data.skin, athenLocalize.iLightbox.skin ),
                    $path       = self.parseData( $data.path, 'horizontal' ),
                    $arrows     = self.parseData( $data.arrows, athenLocalize.iLightbox.controls.arrows ),
                    $thumbnails = self.parseData( $data.thumbnails, athenLocalize.iLightbox.controls.thumbnail );

                // Start up lightbox
                $item.iLightBox( {
                    skin     : $skin,
                    path     : $path,
                    infinite : true,
                    show : {
                        title : athenLocalize.iLightbox.show.title,
                        speed : parseInt( athenLocalize.iLightbox.show.speed )
                    },
                    hide : {
                        speed : parseInt( athenLocalize.iLightbox.hide.speed )
                    },
                    controls : {
                        arrows     : $arrows,
                        thumbnail  : $thumbnails,
                        fullscreen : athenLocalize.iLightbox.controls.fullscreen,
                        mousewheel : athenLocalize.iLightbox.controls.mousewheel
                    },
                    effects : {
                        reposition      : true,
                        repositionSpeed : 200,
                        switchSpeed     : 300,
                        loadedFadeSpeed : athenLocalize.iLightbox.effects.loadedFadeSpeed,
                        fadeSpeed       : athenLocalize.iLightbox.effects.fadeSpeed
                    },
                    overlay : athenLocalize.iLightbox.overlay,
                    social  : athenLocalize.iLightbox.social
                } );

            } );

            // Lightbox Gallery with custom imgs
            $( '.wpex-lightbox-gallery' ).on( 'click', function( event ) {
                event.preventDefault();
                var imagesArray = $( this ).data( 'gallery' ).split( ',' );
                if ( imagesArray ) {
                    $.iLightBox( imagesArray, {
                        skin : athenLocalize.iLightbox.skin,
                        path : 'horizontal',
                        infinite : true,
                        show : {
                            title : athenLocalize.iLightbox.show.title,
                            speed : parseInt( athenLocalize.iLightbox.show.speed )
                        },
                        hide : {
                            speed : parseInt( athenLocalize.iLightbox.hide.speed )
                        },
                        controls : {
                            arrows : athenLocalize.iLightbox.controls.arrows,
                            thumbnail : athenLocalize.iLightbox.controls.thumbnail,
                            fullscreen : athenLocalize.iLightbox.controls.fullscreen,
                            mousewheel : athenLocalize.iLightbox.controls.mousewheel
                        },
                        effects: {
                            reposition : true,
                            repositionSpeed : 200,
                            switchSpeed : 300,
                            loadedFadeSpeed : athenLocalize.iLightbox.effects.loadedFadeSpeed,
                            fadeSpeed : athenLocalize.iLightbox.effects.fadeSpeed
                        },
                        overlay : athenLocalize.iLightbox.overlay,
                        social  : athenLocalize.iLightbox.social
                    } );
                }
            } );

        },

        /**
         * WooCommerce Selects
         *
         * @since 2.0.0
         */
        wooSelects: function() {

            if ( ! $.fn.select2 ) {
                return;
            }

            $( '#calc_shipping_country' ).select2();


        },

        /**
         * Parses data to check if a value is defined in the data attribute and if not returns the fallback
         *
         * @since 2.0.0
         */
        parseData: function( val, fallback ) {
            return ( typeof val !== 'undefined' ) ? val : fallback;
        }


    }; // END wpexTheme

    // Start things up
    AthenTheme.init();

} ) ( jQuery );