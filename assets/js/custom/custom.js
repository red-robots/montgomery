/**
 *	Custom jQuery Scripts
 *	Developed by: Lisa DeBona
 *  Date Modified: 02.07.2023
 */

jQuery(document).ready(function ($) {

  /* Menu Button */
  $(document).on('click','.menu-toggle, .mobile-menu-button',function(e){
    e.preventDefault();
    $('#site-navigation').toggleClass('show');
  });

  $(document).on('click','#topsearchBtn',function(e){
    e.preventDefault();
    $(this).toggleClass('show');
    $('.searchbar').toggleClass('show');
    $('.searchbar input.search-field').focus();
  });

  if( $('.repeatable-blocks').length ) {
    var divPrev = $('.repeatable-blocks').prev();
    console.log(divPrev);
    if(divPrev.hasClass('titlediv')) {
      if( $('.repeatable-blocks .repeatable').eq(0).hasClass('fullwidth') ) {
        $('.repeatable-blocks .repeatable').eq(0).addClass('first');
      }
    }
  }

  /* Slideshow */
  var swiper = new Swiper('.slideshow', {
    effect: 'fade', /* "slide", "fade", "cube", "coverflow" or "flip" */
    loop: true,
    noSwiping: true,
    simulateTouch : true,
    speed: 1000,
    autoplay: {
      delay: 4000,
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });

  /* Carousel */
  var owl = $('.owl-carousel');
  owl.owlCarousel({
    center: true,
    items:2,
    loop: true,
    margin: 10,
    autoplay: false,
    autoplayTimeout: 5000,
    responsiveClass: true,
    onInitialized:function(){
      $('.home-carousel .item-title span.arrow').on('click',function(){
        $('.home-carousel .owl-next').trigger('click');
      });
      coverCarouselItem();
    },
    onDragged:function(){
      $('.home-carousel').addClass('show-all');
      coverCarouselItem();
    },
    onChanged:function(e){
      //$('.home-carousel .owl-item.center').prev().addClass('hide-item');
      $('.home-carousel .owl-item.active').each(function(k){
        if(k==1) {
          $(this).addClass('first');
        } else {
          $(this).removeClass('first');
        }
      });
    }
  });

  $(document).on('click','.carouselNavButtons a',function(e){
    e.preventDefault();
    var action = $(this).attr('data-action');
    $(action).trigger('click');
  });

  function coverCarouselItem() {
    var first = $('.home-carousel img.helper').eq(0);
    var width = first.width();
    var height = first.height();
    $('.cover-first-item').css({
      'width':width+'px',
      'height':height+'px'
    });
  }


  /* Add Class when scroll down */
  // var prevScrollpos = window.pageYOffset;
  // window.onscroll = function () {
  //   var currentScrollPos = window.pageYOffset;
  //   if (prevScrollpos > currentScrollPos) {
  //     $("body").removeClass('scrolled');
  //   } else {
  //     $("body").addClass('scrolled');
  //   }
  //   prevScrollpos = currentScrollPos;
  // }

  var targetDiv = $('body');
  $(window).scroll(function() {
    var windowpos = $(window).scrollTop();
    // change amount here to choose distance from top to add class
    if( windowpos >= 50 ) {
      targetDiv.addClass('scrolled');
    } else {
      targetDiv.removeClass('scrolled');
    }
  });

  /* Weather conversion from Celcius to Fahrenheit */
  if( $('.wp-forecast').length && $('img.wp-forecast-curr-left').length ) {
    var weatherNum = $('.wp-forecast-curr-right').text().trim().replace('°C','');
        weatherNum = parseFloat(weatherNum);
    var fahrenheit = (weatherNum * 1.8) + 32;
        fahrenheit = fahrenheit.toFixed(2); /* two decimal points */
    var int = fahrenheit.split('.')[0];
    var decimal = fahrenheit.split('.')[1];
    var lastChar = decimal.slice(-1);
    if(decimal=='00') {
      fahrenheit = int;
    } else {
      if(lastChar==0) {
        fahrenheit = int + '.' + decimal.replace(lastChar,'');
      } 
    }
    

    var weatherDescription = $('img.wp-forecast-curr-left').attr('alt');
    //var weatherDescription = weatherDescription.toLowerCase().replace(/(?<= )[^\s]|^./g, a=>a.toUpperCase());
    var weatherDescription = weatherDescription.toLowerCase().trim();
    var basename = basename ( $('img.wp-forecast-curr-left').attr('src') );
    var extension = basename.split('.').pop();
    var iconName = 'weather-icon-' + basename.replace('.'+extension,'');
    $('.weather-icon').attr('id',iconName);
    $('.weatherInfo .fahrenheit').text(fahrenheit).attr('title',weatherDescription);
  }
  function basename (path) {
    return path.substring(path.lastIndexOf('/') + 1)
  }

  /* Accordions */
  $('.accordion .q-title').on('click',function(){
    $(this).find('a').toggleClass('active');
    $(this).parents('.q-item').toggleClass('active');
    //$(this).parents('.q-item').find('.q-text').show();
  });

  /* Tribe Events >  Single page Featured Image */
  if( $('body.single-tribe_events .hentry .tribe-events-event-image').length ) {
    var tribeImage = $('body.single-tribe_events .hentry .tribe-events-event-image img').attr('src');
    $('body.single-tribe_events .hentry .tribe-events-event-image').addClass('image-bg');
    $('body.single-tribe_events .hentry .tribe-events-event-image').css('background-image','url('+tribeImage+')');
  }

  /* Contact us page contact section (teal background) */
  if( $('.contact-form-section .fxcol.text').length ) {
    $('.contact-form-section .fxcol.text p').each(function(){
      var pstr = $(this).text().trim().replace(/\s+/g,'');
      if(pstr=='') { /* remove empty paragrap */
        $(this).remove();
      }
    });
  }


  if( $('form.search-form input.search-field').length ) {
    $('form.search-form input.search-field').attr('required',1);
  }
}); 
