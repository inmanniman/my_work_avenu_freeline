import Swiper from 'swiper';
import { Pagination, Navigation, Thumbs } from 'swiper/modules';

function initSwiper(element) {
  // eslint-disable-next-line
  const swiperBlock = element.closest('.swiper-block');
  const swiperButtonNext = swiperBlock.querySelector('.js-swiper-button-next');
  const swiperButtonPrew = swiperBlock.querySelector('.js-swiper-button-prev');
  const swiperPagination = element.querySelector('.swiper-pagination');
  const swiper = new Swiper(element, {
    modules: [Pagination, Navigation],
    slidesPerView: 2,
    rewind: true,
    spaceBetween: 8,
    navigation: {
      nextEl: swiperButtonNext,
      prevEl: swiperButtonPrew,
    },
    pagination: {
      el:  swiperPagination,
      clickable: true,
    },
    breakpoints: {
      768: {
        spaceBetween: 14,
      },
    },
  });
}

const swiperElements = document.querySelectorAll('.js-swiper');

swiperElements.forEach(initSwiper);


const productThumbs = new Swiper(".product-thumbs", {
  modules: [Thumbs],
  spaceBetween: 36,
  slidesPerView: 4,
  freeMode: true,
  watchSlidesProgress: true,
});
const productSlider = new Swiper(".product-swiper-slider", {
  modules: [Pagination, Navigation, Thumbs],
  pagination: {
    el: ".swiper-pagination",
    dynamicBullets: true,
    clickable: true
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  thumbs: {
    swiper: productThumbs,
  },
});
