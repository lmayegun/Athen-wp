<?php
/**
 * Outputs inline JS for the front-end JS composer
 *
 * @package     Total
 * @subpackage  Visual Composer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       2.0.0
 * @version     1.0.0
 */

class VCEX_Inline_JS {

    /**
     * Class Constructor
     *
     * @since   2.0.0
     * @access  public
     * @param   $scripts
     */
    public function __construct( $scripts ) {
        $this->output( $scripts ); 
    }

    /**
     * Output JS
     *
     * @since   2.0.0
     * @access  private
     * @param   $scripts
     */
    private function output( $scripts ) {

        // Loop through scripts
        if ( is_array( $scripts ) ) {
            foreach ( $scripts as $script ) {
                if ( method_exists( $this, $script ) ) { ?>
                    <script type="text/javascript">
                        jQuery( function( $ ) {
                            <?php $this->$script(); ?>
                        } );
                    </script>
                <?php } ?>
            <?php
            }
        }

        // Output single script
        elseif ( method_exists( $this, $scripts ) ) { ?>
            <script type="text/javascript">
                jQuery( function( $ ) {
                    <?php $this->$scripts(); ?>
                } );
            </script>
        <?php }

    }

    /**
     * Isotope
     *
     * @since   2.0.0
     * @access  private
     */
    private function isotope() { ?>

        if( $.fn.imagesLoaded!=undefined && $.fn.isotope!=undefined ){
            var $isOriginLeft = true;
            $( '.vcex-isotope-grid' ).each( function() {
                // Get data
                var $container          = $(this),
                    $transitionDuration = $container.data( 'transition-duration' ),
                    $layoutMode         = $container.data( 'layout-mode' );
                if ( ! $transitionDuration ) {
                    $transitionDuration = '0.4'
                }
                if ( ! $layoutMode ) {
                    $layoutMode = 'masonry'
                }
                // Initialize isotope
                $container.imagesLoaded( function() {
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
                            var $filterableDiv = $(this).data( 'filter' );
                            if ( $filterableDiv !== '*' && ! $container.find($filterableDiv).length ) {
                                $(this).parent().addClass( 'hidden' );
                            }
                        } );
                        $filterLinks.css( { opacity: 1 } );
                        $filterLinks.click( function() {
                            var selector = $(this).attr( 'data-filter' );
                                $container.isotope( {
                                    filter: selector
                                } );
                                $(this).parents( 'ul' ).find( 'li' ).removeClass( 'active' );
                                $(this).parent( 'li' ).addClass( 'active' );
                            return false;
                        } );
                    }
                } );
            } );
        }

    <?php }

    /**
     * Carousels
     *
     * @since   2.0.0
     * @access  private
     */
    private function carousel() { ?>

        if($.fn.owlCarousel!=undefined){

            $(".wpex-carousel").each(function(){var a=$(this),e=a.data(),t=wpexLocalize.isRTL?!0:!1;a.owlCarousel({lazyLoad:!1,rtl:t,dots:e.dots,nav:e.nav,items:e.items,slideBy:e.slideby,center:e.center,loop:e.loop,margin:e.margin,autoplay:e.autoplay,autoplayTimeout:e.autoplayTimeout,navText:['<span class="fa fa-chevron-left"><span>','<span class="fa fa-chevron-right"></span>'],responsive:{0:{items:e.itemsMobilePortrait},480:{items:e.itemsMobileLandscape},768:{items:e.itemsTablet},960:{items:e.items}}})});

        }

    <?php }

    /**
     * iLightbox
     *
     * @since   2.0.0
     * @access  private
     */
    private function ilightbox() {

        // some bugs that need fixing..
        return; ?>


        if ( $.fn.iLightBox != undefined) {

            wpexLocalize.lightboxArrows="1"===wpexLocalize.lightboxArrows?!0:!1,wpexLocalize.lightboxThumbnails="1"===wpexLocalize.lightboxThumbnails?!0:!1,wpexLocalize.lightboxFullScreen="1"===wpexLocalize.lightboxFullScreen?!0:!1,wpexLocalize.lightboxMouseWheel="1"===wpexLocalize.lightboxMouseWheel?!0:!1,wpexLocalize.lightboxTitles="1"===wpexLocalize.lightboxTitles?!0:!1,$(".wpex-lightbox, .wpb_single_image.image-lightbox a").each(function(){var e=$(this),i=e.data(),l="undefined"!=typeof i.skin?i.skin:wpexLocalize.lightboxSkin;e.iLightBox({skin:l,controls:{fullscreen:wpexLocalize.lightboxFullScreen}})}),$(".wpex-lightbox-video, .wpb_single_image.video-lightbox a, .wpex-lightbox-autodetect, .wpex-lightbox-autodetect a").iLightBox({skin:wpexLocalize.LightboxSkin,path:"horizontal",smartRecognition:!0,show:{title:wpexLocalize.lightboxTitles},controls:{fullscreen:wpexLocalize.lightboxFullScreen,mousewheel:wpexLocalize.lightboxMouseWheel}}),$(".lightbox-group").each(function(){var e=$(this),i=e.find("a.lightbox-group-item"),l=e.data(),o="undefined"!=typeof l.skin?l.skin:wpexLocalize.lightboxSkin,t="undefined"!=typeof l.path?l.path:"horizontal",x="undefined"!=typeof l.arrows?l.arrows:wpexLocalize.lightboxArrows,a="undefined"!=typeof l.thumbnails?l.thumbnails:wpexLocalize.lightboxThumbnails;i.iLightBox({skin:o,path:t,show:{title:wpexLocalize.lightboxTitles},controls:{arrows:x,thumbnail:a,fullscreen:wpexLocalize.lightboxFullScreen,mousewheel:wpexLocalize.lightboxMouseWheel}})}),$(".wpex-lightbox-gallery").on(wpexLocalize.isMobile?"touchstart":"click",function(e){e.preventDefault();var i=$(this).data("gallery").split(",");i&&$.iLightBox(i,{skin:wpexLocalize.lightboxSkin,path:"horizontal",show:{title:wpexLocalize.lightboxTitles},controls:{arrows:wpexLocalize.lightboxArrows,thumbnail:wpexLocalize.lightboxThumbnails,fullscreen:wpexLocalize.lightboxFullScreen,mousewheel:wpexLocalize.lightboxMouseWheel}})});

        }

    <?php }

    /**
     * DataHovers
     *
     * @since   2.0.0
     * @access  private
     */
    private function data_hover() { ?>

       $(".wpex-data-hover").each(function(){var o=$(this),t=$(this).css("backgroundColor"),r=$(this).css("color"),s=$(this).attr("data-hover-background"),c=$(this).attr("data-hover-color");o.hover(function(){void 0!=CSSStyleDeclaration.prototype.setProperty?(s&&this.style.setProperty("background-color",s,"important"),c&&this.style.setProperty("color",c,"important")):(s&&o.css("background-color",s),c&&o.css("color",c))},function(){void 0!=CSSStyleDeclaration.prototype.setProperty?(s&&this.style.setProperty("background-color",t,"important"),c&&this.style.setProperty("color",r,"important")):(s&&t&&o.css("background-color",t),c&&r&&o.css("color",r))})});

    <?php }

    /**
     * EqualHeights
     *
     * @since   2.0.0
     * @access  private
     */
    private function equal_heights() { ?>

        if($.fn.matchHeight!=undefined){
            $( '.equal-height-column, .blog-grid div.blog-entry-inner, .match-height-row .match-height-content, .match-height-feature-row .match-height-feature' ).matchHeight();
        }

    <?php }

    /**
     * Slider Pro
     *
     * @since   2.0.0
     * @access  private
     */
    private function slider_pro() { ?>

        if($.fn.sliderPro!=undefined){
            
            $(".wpex-slider").each(function(){var e=$(this),i=e.data(),t="undefined"!=typeof i.animationSpeed?i.animationSpeed:600,o="undefined"!=typeof i.loop?i.loop:!1,n="undefined"!=typeof i.fade?i.fade:600,a="undefined"!=typeof i.direction?i.direction:"horizontal",d="undefined"!=typeof i.autoPlay?i.autoPlay:!0,u="undefined"!=typeof i.autoPlayDelay?i.autoPlayDelay:5e3,l="undefined"!=typeof i.touchSwipe?i.touchSwipe:!0,f="undefined"!=typeof i.buttons?i.buttons:!0,r="undefined"!=typeof i.arrows?i.arrows:!0,p="undefined"!=typeof i.fadeArrows?i.fadeArrows:!0,s="undefined"!=typeof i.shuffle?i.shuffle:!1,h="undefined"!=typeof i.fullscreen?i.fullscreen:!1,y="undefined"!=typeof i.slideDistance?i.slideDistance:0,m="undefined"!=typeof i.heightAnimationDuration?i.heightAnimationDuration:500,c="undefined"!=typeof i.thumbnailPointer?i.thumbnailPointer:!1,b="undefined"!=typeof i.thumbnailHeight?i.thumbnailHeight:70,g="undefined"!=typeof i.thumbnailWidth?i.thumbnailWidth:70,w="undefined"!=typeof i.updateHash?i.updateHash:!1,A="undefined"!=typeof i.fadeCaption?i.fadeCaption:!0,D="undefined"!=typeof i.autoHeight?i.autoHeight:!0;$(".wpex-slider-slide, .wpex-slider-thumbnails").css({opacity:1,display:"block"}),e.sliderPro({responsive:!0,width:"100%",height:"300",fade:n,touchSwipe:l,fadeDuration:t,slideAnimationDuration:t,autoHeight:D,heightAnimationDuration:m,arrows:r,fadeArrows:p,autoplay:d,autoplayDelay:u,buttons:f,shuffle:s,orientation:a,loop:o,keyboard:!1,fullScreen:h,slideDistance:y,thumbnailHeight:b,thumbnailWidth:g,thumbnailPointer:c,updateHash:w,thumbnailArrows:!1,fadeThumbnailArrows:!1,thumbnailTouchSwipe:!0,fadeCaption:A,captionFadeDuration:500,waitForLayers:!0,autoScaleLayers:!0,forceSize:"none",thumbnailPosition:"bottom",reachVideoAction:"playVideo",leaveVideoAction:"pauseVideo",endVideoAction:"nextSlide",init:function(){e.prev(".wpex-slider-preloaderimg").hide(),e.parent(".gallery-format-post-slider")&&$(".blog-masonry-grid").length&&setTimeout(function(){$(".blog-masonry-grid").isotope("layout")},m+1)},gotoSlideComplete:function(){e.parent(".gallery-format-post-slider")&&$(".blog-masonry-grid").length&&$(".blog-masonry-grid").isotope("layout")}})});

        }

    <?php }

    /**
     * Skillbar
     *
     * @since   2.0.0
     * @access  private
     */
    private function skillbar() { ?>

        $(".vcex-skillbar").each(function(){$(this).find(".vcex-skillbar-bar").animate({width:$(this).attr("data-percent")},800)});

    <?php }

    /**
     * Skillbar
     *
     * @since   2.0.0
     * @access  private
     */
    private function milestone() { ?>

        if($.fn.appear!=undefined&&$.fn.countTo!=undefined){
        
            $( '.vcex-animated-milestone' ).each( function() {
                $( this ).appear( function() {
                    $( this ).find( '.vcex-milestone-time' ).countTo( {
                        formatter: function ( value, options ) {
                            return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
                        },
                    } );
                }, {
                    accX    : 0,
                    accY    : 0
                } );
            } );

        }

    <?php }

    /**
     * Parallax
     *
     * @since   2.0.0
     * @access  private
     */
    private function parallax() { ?>
        
        if($.fn.scrolly2!=undefined){

            $( '.parallax-bg' ).each( function() {
                var $this = $( this );
                $this.scrolly2().trigger( 'scroll' );
            } );

        }

    <?php }
    

} // End Class

/**
 * Helper function runs the VCEX_Inline_JS class 
 *
 * @since 2.0.0
 */
function vcex_inline_js( $scripts ) {
    // Online needed in the front-end
    if ( ! vc_is_inline() ) {
        return;
    }
    return new VCEX_Inline_Js( $scripts );
}