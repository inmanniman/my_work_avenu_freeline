import Swiper, {
  EffectCoverflow,
  Navigation,
  Thumbs,
  Pagination,
} from 'swiper';

Swiper.use([EffectCoverflow, Navigation, Thumbs, Pagination]);

const thumbSwiper = new Swiper('.thumb-card-swiper', {
  spaceBetween: 16,
  slidesPerView: 4,
  freeMode: true,
  watchSlidesProgress: true,
  preventClicks: false,
  preventClicksPropagation: false,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});


if (window.innerWidth < 845) {
  const sliders = new Swiper('.js-main-slider', {
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    loop: true,
    speed: 300,
    spaceBetween: 20,
  });
}

const cardSwiper = new Swiper('.main-card-swiper', {
  spaceBetween: 2,
  thumbs: {
    swiper: thumbSwiper,
  },
});

const mainSwiper = document.querySelectorAll('.main-swiper');
if(!Array.isArray(mainSwiper) || !mainSwiper.length){
  for (let swiper of mainSwiper) {
    const swiperPagination = swiper.querySelector('.swiper-pagination');
    const mainSwiper = new Swiper(swiper, {
      spaceBetween: 1,
      loop: true,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      pagination: {
        clickable: true,
        el: swiperPagination,
      },
    });
  }
}

// Свайпер для страницы услуги
var swiperService = new Swiper('.swiper-service', {
  effect: 'coverflow',
  speed: 800,
  loop: true,
  autoplay: true,
  loopAdditionalSlides: 30,
  slidesPerView: 3,
  spaceBetween: 0,
  centeredSlides: true,
  roundLengths: true,

  coverflowEffect: {
    rotate: 0,
    // depth: 122,
    depth: 128,
    slideShadows: false,
    shiftX: 166,
  },

  breakpoints: {
    320: {
      slidesPerView: 1,
      spaceBetween: 10,
      loop: 0,
      centeredSlides: false,
      coverflowEffect: {
        depth: 0,
      },
    },

    600: {
      slidesPerView: 2,
      spaceBetween: 0,
    },

    666: {
      slidesPerView: 3,
    },

    964: {
      slidesPerView: 4,
    },
    1230: {
      slidesPerView: 4.1,
      spaceBetween: 0,
    },
  },
});
