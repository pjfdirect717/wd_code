/**
 * Main JS file for Casper behaviours
 */

/* globals jQuery, document */
(function ($, undefined) {
    "use strict";

    var $document = $(document);

    $document.ready(function () {

        var $postContent = $(".post-content");
        $postContent.fitVids();

        $(".scroll-down").arctic_scroll();

        $(".menu-button, .nav-cover, .nav-close").on("click", function(e){
            e.preventDefault();
            $("body").toggleClass("nav-opened nav-closed");
        });

    });

    // Arctic Scroll by Paul Adam Davis
    // https://github.com/PaulAdamDavis/Arctic-Scroll
    $.fn.arctic_scroll = function (options) {

        var defaults = {
            elem: $(this),
            speed: 500
        },

        allOptions = $.extend(defaults, options);

        allOptions.elem.click(function (event) {
            event.preventDefault();
            var $this = $(this),
                $htmlBody = $('html, body'),
                offset = ($this.attr('data-offset')) ? $this.attr('data-offset') : false,
                position = ($this.attr('data-position')) ? $this.attr('data-position') : false,
                toMove;

            if (offset) {
                toMove = parseInt(offset);
                $htmlBody.stop(true, false).animate({scrollTop: ($(this.hash).offset().top + toMove) }, allOptions.speed);
            } else if (position) {
                toMove = parseInt(position);
                $htmlBody.stop(true, false).animate({scrollTop: toMove }, allOptions.speed);
            } else {
                $htmlBody.stop(true, false).animate({scrollTop: ($(this.hash).offset().top) }, allOptions.speed);
            }
        });
    };

    // link to top
    
    $('p.logo span').click(function(){
        scroll(0,0);
    });

    // swiper first slide reveal
    $.fn.lights_up = function () {
        // 
        
    };


    // idangerous Swiper

    var mySwiper = new Swiper('#swiper-container', {
        loop: true
    });
    $('.cards .card a').on('click tap', function ( event ) {
        event.preventDefault();
        var slideIndexNumber = $(this).attr('id');
        // console.log('wut '+slideIndexNumber);
        $('html').addClass('camera');
        // $('meta[name=viewport]').attr('content', 'width=device-width, initial-scale=1, maximum-scale=2');
        mySwiper.update();
        mySwiper.slideTo(slideIndexNumber, 0);
        setTimeout(function() { $('#swiper-container .swiper-slide a').css('display','block'); }, 1000);
    });

    if(window.innerWidth > 767) {
        $('.swiper-slide a').on('click tap', function ( event ) {
            event.preventDefault();
        });
    }

    if ("ontouchstart" in window || navigator.msMaxTouchPoints) {
        $('.swiper-button-prev, .swiper-button-next').hide();
    } else {
        $('.swiper-button-prev').on('click tap', function () {
            mySwiper.slidePrev();
        });

        $('.swiper-button-next').on('click tap', function () {
            mySwiper.slideNext();
        });
    }

    $('#swiper-close').on('click tap', function () {
        // $('meta[name=viewport]').attr('content', 'width=device-width, initial-scale=1, maximum-scale=1');
        $('html').removeClass('camera');
        mySwiper.slideTo(0);
    });

    $(document).keyup(function(e) {
      // if (e.keyCode == 13) $('.save').click();     // enter

      if (e.keyCode == 27) {   // esc
        $('html').removeClass('camera');
        mySwiper.slideTo(0);
      }

      if (e.keyCode == 37) {   // left arrow
        mySwiper.slidePrev();
      }

      if (e.keyCode == 39) {   // right arrow
        mySwiper.slideNext();
      }

    });

})(jQuery);
