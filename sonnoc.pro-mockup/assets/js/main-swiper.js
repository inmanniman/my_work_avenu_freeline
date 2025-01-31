import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';

Swiper.use([Navigation, Pagination, Autoplay]);

new Swiper('.main-swiper', {
  centeredSlides: true,
  spaceBetween: 5,
  slidesPerView: 1,
  mousewheel: true,
  keyboard: true,
  autoplay: {
    delay: 3000,
  },
  pagination: {
    el: '.swiper-pagination',
    type: 'fraction',
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  breakpoints: {
    800: {
      spaceBetween: 5,
    },

    200: {
      spaceBetween: 10,
    },
  },
});
