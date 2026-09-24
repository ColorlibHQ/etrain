/**
 * Etrain front-end behaviour, without jQuery.
 *
 * The plugin calls keep the options they always had; ColorlibUI provides
 * drop-in versions of Owl Carousel, Magnific Popup and Slick that build the
 * same markup, so the theme's stylesheets apply unchanged. Also: the fixed
 * menu, and the star rating and review form on single courses.
 */
(function () {
  'use strict';

  var UI = window.ColorlibUI;
  if (!UI) return;

  function show(el) {
    el.style.display = '';
    if (window.getComputedStyle(el).display === 'none') el.style.display = 'block';
  }

  UI.ready(function () {
    // About section's img attr removing
    UI.toElements('.learning_part .learning_img img').forEach(function (img) {
      img.removeAttribute('width');
      img.removeAttribute('height');
    });
  });

  UI.owl('.player_info_item', {
    items: 1,
    loop: true,
    dots: false,
    autoplay: true,
    margin: 40,
    autoplayHoverPause: true,
    autoplayTimeout: 5000,
    nav: true,
    navText: [
      '<img src="img/icon/left.svg" alt="">',
      '<img src="img/icon/right.svg" alt="">'
    ],
    responsive: {
      0: {
        margin: 15
      },
      600: {
        margin: 10
      },
      1000: {
        margin: 10
      }
    }
  });

  UI.magnific('.popup-youtube, .popup-vimeo', {
    // disableOn: 700,
    type: 'iframe',
    mainClass: 'mfp-fade',
    removalDelay: 160,
    preloader: false,
    fixedContentPos: false
  });

  UI.owl('.textimonial_iner', {
    items: 1,
    loop: true,
    dots: true,
    autoplay: true,
    autoplayHoverPause: true,
    autoplayTimeout: 5000,
    nav: false,
    responsive: {
      0: {
        margin: 15
      },
      600: {
        margin: 10
      },
      1000: {
        margin: 10
      }
    }
  });

  UI.enhanceSelects('select');

  // menu fixed js code
  UI.ready(function () {
    var menus = UI.toElements('.main_menu');
    window.addEventListener('scroll', function () {
      var fixed = window.pageYOffset + 1 > 50;
      menus.forEach(function (menu) {
        if (fixed) {
          menu.classList.add('menu_fixed', 'animated', 'fadeInDown');
        } else {
          menu.classList.remove('menu_fixed', 'animated', 'fadeInDown');
        }
      });
    }, { passive: true });
  });

  UI.counter('.counter', { time: 2000 });

  // Main slider and its thumbnail strip. The slide events are listened to
  // before the sliders start.
  UI.ready(function () {
    function thumbs() {
      return UI.toElements('.slider-nav-thumbnails .slick-slide');
    }
    UI.toElements('.slider').forEach(function (slider) {
      // On before slide change match active thumbnail to current slide
      slider.addEventListener('beforeChange', function (e) {
        var mySlideNumber = e.detail.nextSlide;
        thumbs().forEach(function (slide, i) {
          slide.classList.toggle('slick-active', i === mySlideNumber);
        });
      });

      slider.addEventListener('afterChange', function (e) {
        UI.toElements('.content[data-id]').forEach(function (el) { el.style.display = 'none'; });
        UI.toElements('.content[data-id="' + (e.detail.currentSlide + 1) + '"]').forEach(show);
      });
    });
  });

  UI.slick('.slider', {
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    speed: 300,
    infinite: true,
    asNavFor: '.slider-nav-thumbnails',
    autoplay: true,
    pauseOnFocus: true,
    dots: true
  });

  UI.slick('.slider-nav-thumbnails', {
    slidesToShow: 3,
    slidesToScroll: 1,
    asNavFor: '.slider',
    focusOnSelect: true,
    infinite: true,
    prevArrow: false,
    nextArrow: false,
    centerMode: true,
    responsive: [
      {
        breakpoint: 480,
        settings: {
          centerMode: false
        }
      }
    ]
  });

  // Runs after the sliders above have started (both wait for DOM ready).
  UI.ready(function () {
    // remove active class from all thumbnail slides, then set it on the first
    UI.toElements('.slider-nav-thumbnails .slick-slide').forEach(function (slide, i) {
      slide.classList.toggle('slick-active', i === 0);
    });
  });

  UI.magnific('.gallery_img', {
    type: 'image',
    gallery: {
      enabled: true
    }
  });

  /*----------------------------------------------------*/
  /* Course Star Review
  /*----------------------------------------------------*/

  function responseMessage(msg) {
    UI.fade('.success-box', 'in', 200);
    UI.toElements('.success-box div.text-message').forEach(function (el) {
      el.innerHTML = '<span>' + msg + '</span>';
    });
  }

  UI.ready(function () {
    var form = document.getElementById('reviw_submit');
    if (form) {
      form.addEventListener('submit', function (event) {
        var feedback = document.getElementById('feedback');
        var rating = document.getElementById('ratingvalue');
        var feedbackValue = feedback ? feedback.value : undefined;
        var ratingValue = rating ? rating.value : undefined;

        if (feedbackValue === '' || ratingValue === '') {
          // Stay on the page so the visitor can fix it (the form used to
          // submit to "#" anyway after the alert, reloading the page).
          event.preventDefault();
          window.alert('You must select Star and Write a Review!');
        } else {
          var ajax = document.getElementById('reviewajax');
          var userdata = new URLSearchParams(new FormData(form)).toString();

          UI.request(ajax ? ajax.value : '', {
            method: 'POST',
            data: {
              action: 'course_star_review',
              userdata: userdata
            }
          }).then(function (res) {
            if (res !== 'Error') {
              window.location.reload();
            } else {
              window.alert('You must be login user');
            }
          });

          event.preventDefault();
        }
      });
    }

    function starsOf(li) {
      return Array.prototype.filter.call(li.parentNode.children, function (child) {
        return child.matches('li.star');
      });
    }

    UI.toElements('#stars li').forEach(function (li) {
      /* 1. Visualizing things on Hover - See next part for action on click */
      li.addEventListener('mouseover', function () {
        var onStar = parseInt(li.getAttribute('data-value'), 10); // The star currently mouse on

        // Now highlight all the stars that's not after the current hovered star
        starsOf(li).forEach(function (star, e) {
          star.classList.toggle('hover', e < onStar);
        });
      });
      li.addEventListener('mouseout', function () {
        starsOf(li).forEach(function (star) {
          star.classList.remove('hover');
        });
      });

      /* 2. Action to perform on click */
      li.addEventListener('click', function () {
        var onStar = parseInt(li.getAttribute('data-value'), 10); // The star currently selected
        var stars = starsOf(li);
        var i;
        for (i = 0; i < stars.length; i++) {
          stars[i].classList.remove('selected');
        }

        for (i = 0; i < onStar && i < stars.length; i++) {
          stars[i].classList.add('selected');
        }

        // JUST RESPONSE (Not needed)
        var selected = UI.toElements('#stars li.selected');
        var last = selected[selected.length - 1];
        var ratingValue = parseInt(last ? last.getAttribute('data-value') : '', 10);
        var input = document.getElementById('ratingvalue');
        if (input) input.value = ratingValue;
        var msg = '';
        if (ratingValue === 1) {
          msg = 'Poor';
        } else if (ratingValue === 2) {
          msg = 'Fair';
        } else if (ratingValue === 3) {
          msg = 'Good';
        } else if (ratingValue === 4) {
          msg = 'Excellent';
        } else if (ratingValue === 5) {
          msg = 'Outstanding';
        }
        responseMessage(msg);
      });
    });
  });
}());
