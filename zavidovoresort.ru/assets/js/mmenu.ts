import Menu from 'mmenu-js';
import 'mmenu-js/dist/mmenu.css';

const menuElement = document.querySelector<HTMLElement>('.js-mobile-menu');
const menuTriggerElement = document.querySelector<HTMLElement>(
  '.js-mobile-menu-trigger'
);
if (menuElement && menuTriggerElement) {
  const menu = new Menu(menuElement, {
    slidingSubmenus: false,
    offCanvas: {
      position: 'left-front',
    },
    navbar: {
      add: false,
    },
    navbars: [
      {
        position: 'top',
        content: [
          ' <svg class="header__logo" width="171" height="41"> <use href="/assets/sprite.svg#logo"> </use> </svg>',
          'close',
        ],
      },
      {
        position: 'bottom',
        content: [
          ' <a href="tel:+79661741192" class="header__contact-link link">+7 (966) 174-11-92</a>',
        ],
      },
    ],
  });
  menuTriggerElement.addEventListener('click', () => {
    menu.open();
  });
}
