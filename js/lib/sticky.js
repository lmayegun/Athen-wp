// Sticky Plugin v1.0.0 for jQuery
// ====================================================================
// Author: Anthony Garand
// Improvements by German M. Bravo (Kronuz) and Ruud Kamphuis (ruudk)
// Improvements by Leonardo C. Daronco (daronco)
// Highly Modified by AJ Clarke (wpexplorer.com)
// Created: 2/14/2011
// Date: 2/12/2012
// Website: http://labs.anthonygarand.com/sticky

( function($) {

  var slice = Array.prototype.slice; // save ref to original slice()
  var splice = Array.prototype.splice; // save ref to original slice()

  // Defaults
  var defaults      = {
      topSpacing        : 0,
      bottomSpacing     : 0,
      className         : 'is-sticky',
      wrapperClassName  : 'sticky-wrapper',
      center            : false,
      getWidthFrom      : '',
      widthFromWrapper  : true, // works only when .getWidthFrom is empty
      responsiveWidth   : false,
      shrink            : false,
      customHeaderLogo  : false

    },

    // Main vars
    $window       = $( window ),
    $document     = $( document ),
    sticked       = ( typeof sticked != 'undefined' && sticked instanceof Array ) ? sticked : [];
    windowHeight  = $window.height(),
    siteLogo      = $( '#site-header #site-logo img' ),
    currentLogo   = siteLogo.attr( 'src' );

    // Main scroller function
    scroller = function( forceRefresh ) {

        // Retina logo
        if ( athenLocalize.retinaLogo && window.devicePixelRatio >= 2 ) {
            currentLogo = athenLocalize.retinaLogo;
        }

      // Define vars
      var scrollTop               = $window.scrollTop(),
          documentHeight          = $document.height(),
          dwh                     = documentHeight - windowHeight,
          extra                   = ( scrollTop > dwh ) ? dwh - scrollTop : 0;

      for (var i = 0; i < sticked.length; i++) {

        var s = sticked[i],
            elementTop    = s.stickyWrapper.offset().top,
            elementBottom = s.stickyWrapper.offset().top + s.stickyWrapper.outerHeight();

          // Shrink header
          if ( s.shrink === true ) {
            var etse = elementBottom - s.topSpacing - extra;
          }

          // Dont shrink header
          else {
            var etse = elementTop - s.topSpacing - extra;
          }

        if ( scrollTop <= etse ) {

          // Return logo to curret URl
          if ( s.customHeaderLogo ) {
            siteLogo.attr( 'src', currentLogo );
          }

          if ( s.currentTop !== null ) {
            s.stickyElement
              .css( 'position', '' )
              .css( 'top', '' );
            s.stickyElement.trigger('sticky-end', [s]).parent().removeClass(s.className);
            s.currentTop = null;
          }

        }
        else {
          var newTop = documentHeight - s.stickyElement.outerHeight()
            - s.topSpacing - s.bottomSpacing - scrollTop - extra;

          // Get current top value
          if ( newTop < 0 ) {
            newTop = newTop + s.topSpacing;
          } else {
            newTop = s.topSpacing;
          }

          // Fix the header
          if ( (s.currentTop != newTop) || (forceRefresh == true) ) {

            // Alter logo
            if ( s.customHeaderLogo ) {
              siteLogo.attr( 'src', s.customHeaderLogo );
            }

            // Fade in shrink header
            if ( s.shrink === true ) {
              s.stickyElement.hide().fadeIn(500);
            }

            s.stickyElement
              .css('position', 'fixed')
              .css('top', newTop);

            if (typeof s.getWidthFrom !== 'undefined') {
              s.stickyElement.css('width', $(s.getWidthFrom).width());
            }

            s.stickyElement.trigger('sticky-start', [s]).parent().addClass(s.className);
            s.currentTop = newTop;
          }


        }
      }
    },
    resizer = function() {

      windowHeight = $window.height();

      for (var i = 0; i < sticked.length; i++) {
        var s = sticked[i];
        if (typeof s.getWidthFrom !== 'undefined' && s.responsiveWidth === true) {
          s.stickyElement.css('width', $(s.getWidthFrom).width());
        }
      }
      
    },

    methods = {
      init: function(options) {
        var options = $.extend( {}, defaults, options );
        return this.each(function() {
          var stickyElement = $(this);
          var stickyId      = stickyElement.attr('id');
          var wrapperId     = stickyId ? stickyId + '-' + defaults.wrapperClassName : defaults.wrapperClassName 
          var wrapper       = $('<div></div>')
            .attr('id', stickyId + '-sticky-wrapper')
            .addClass(options.wrapperClassName);
          stickyElement.wrapAll(wrapper);

          if ( options.center ) {
            stickyElement.parent().css( {width:stickyElement.outerWidth(),marginLeft:"auto",marginRight:"auto"} );
          }

          if ( stickyElement.css( "float" ) == "right") {
            stickyElement.css( {
                "float": "none"
            } ).parent().css( {
                "float": "right"
            } );
          }

          var stickyWrapper = stickyElement.parent();

          stickyWrapper.css('height', stickyElement.outerHeight());

          sticked.push( {
            topSpacing        : options.topSpacing,
            bottomSpacing     : options.bottomSpacing,
            stickyElement     : stickyElement,
            currentTop        : null,
            stickyWrapper     : stickyWrapper,
            className         : options.className,
            getWidthFrom      : options.getWidthFrom,
            responsiveWidth   : options.responsiveWidth,
            shrink            : options.shrink,
            customHeaderLogo  : options.customHeaderLogo
          } );
        } );
      },
      update: scroller,
      unstick: function(options) {
        return this.each(function() {
          var unstickyElement = $(this);

          var removeIdx = -1;
          for (var i = 0; i < sticked.length; i++)
          {
            if (sticked[i].stickyElement.get(0) == unstickyElement.get(0))
            {
                removeIdx = i;
            }
          }
          if(removeIdx != -1)
          {
            sticked.splice(removeIdx,1);
            unstickyElement.unwrap();
            unstickyElement.removeAttr('style');
          }
        } );
      }
    };

  // should be more efficient than using $window.scroll(scroller) and $window.resize(resizer):
  if ( window.addEventListener ) {
    window.addEventListener( 'scroll', scroller, false );
    window.addEventListener( 'resize', resizer, false );
  } else if ( window.attachEvent ) {
    window.attachEvent( 'onscroll', scroller );
    window.attachEvent( 'onresize', resizer );
  }

  $.fn.sticky = function( method ) {
    if (methods[method]) {
      return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
    } else if (typeof method === 'object' || !method ) {
      return methods.init.apply( this, arguments );
    } else {
      $.error('Method ' + method + ' does not exist on jQuery.sticky');
    }
  };

  $.fn.unstick = function( method ) {
    if ( methods[method] ) {
      return methods[method].apply(this, Array.prototype.slice.call( arguments, 1 ) );
    } else if (typeof method === 'object' || !method ) {
      return methods.unstick.apply( this, arguments );
    } else {
      $.error('Method ' + method + ' does not exist on jQuery.sticky');
    }

  };
  $(function() {
    setTimeout(scroller, 0);
  } );
} )(jQuery);