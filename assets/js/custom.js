"use strict";

/**
 *	Custom jQuery Scripts
 *	Developed by: Lisa DeBona
 *  Date Modified: 02.07.2023
 */
jQuery(document).ready(function ($) {
  /* Menu Button */
  $('.menu-toggle').on('click', function (e) {
    e.preventDefault();
    $('#site-navigation').toggleClass('show');
  });
  $('#topsearchBtn').on('click', function (e) {
    e.preventDefault();
    $(this).toggleClass('show');
    $('.searchbar').toggleClass('show');
    $('.searchbar input.search-field').focus();
  });
  /* Slideshow */

  var swiper = new Swiper('.slideshow', {
    effect: 'fade',

    /* "slide", "fade", "cube", "coverflow" or "flip" */
    loop: true,
    noSwiping: true,
    simulateTouch: true,
    speed: 1000,
    autoplay: {
      delay: 4000
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    }
  });
  /* Carousel */

  var owl = $('.owl-carousel');
  owl.owlCarousel({
    loop: true,
    margin: 10,
    autoplay: true,
    autoplayTimeout: 5000,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
        nav: true
      },
      600: {
        items: 2,
        nav: false
      },
      1000: {
        items: 2,
        nav: true,
        loop: false,
        margin: 20
      }
    },
    onChanged: function onChanged(e) {
      $('.home-carousel .owl-item.active').each(function (k) {
        if (k == 1) {
          $(this).addClass('first');
        } else {
          $(this).removeClass('first');
        }
      });
    }
  });
  /* Add Class when scroll down */

  var prevScrollpos = window.pageYOffset;

  window.onscroll = function () {
    var currentScrollPos = window.pageYOffset;

    if (prevScrollpos > currentScrollPos) {
      $("body.home").removeClass('scrolled');
    } else {
      $("body.home").addClass('scrolled');
    }

    prevScrollpos = currentScrollPos;
  };
  /* Weather conversion from Celcius to Fahrenheit */


  if ($('.wp-forecast').length && $('img.wp-forecast-curr-left').length) {
    var weatherNum = $('.wp-forecast-curr-right').text().trim().replace('°C', '');
    weatherNum = parseFloat(weatherNum);
    var fahrenheit = weatherNum * 1.8 + 32;
    fahrenheit = fahrenheit.toFixed(2);
    /* two decimal points */

    var int = fahrenheit.split('.')[0];
    var decimal = fahrenheit.split('.')[1];
    var lastChar = decimal.slice(-1);

    if (decimal == '00') {
      fahrenheit = int;
    } else {
      if (lastChar == 0) {
        fahrenheit = int + '.' + decimal.replace(lastChar, '');
      }
    }

    var weatherDescription = $('img.wp-forecast-curr-left').attr('alt');
    var weatherDescription = weatherDescription.toLowerCase().replace(/(?<= )[^\s]|^./g, function (a) {
      return a.toUpperCase();
    });
    var basename = basename($('img.wp-forecast-curr-left').attr('src'));
    var extension = basename.split('.').pop();
    var iconName = 'weather-icon-' + basename.replace('.' + extension, '');
    $('.weather-icon').attr('id', iconName);
    $('.weatherInfo .fahrenheit').text(fahrenheit).attr('title', weatherDescription);
  }

  function basename(path) {
    return path.substring(path.lastIndexOf('/') + 1);
  }
});