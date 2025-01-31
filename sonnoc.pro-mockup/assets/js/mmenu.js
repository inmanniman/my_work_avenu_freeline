import Menu from 'mmenu-js';

const menuElement = document.querySelector('.js-m-menu');

function toggleMenu(menu) {
  const menuBtnOpen = document.querySelector('.js-m-menu-btn-open');
  const menuBtnClose = document.querySelector('.js-m-menu-btn-close');
  menuBtnOpen.addEventListener('click', () => {
    menu.open();
  });
  menuBtnClose.addEventListener('click', () => {
    menu.close();
  });
}

if (menuElement) {
  const menuTopBlock = document.querySelector('#mmenu-top').content;
  const menuBottomBlock = document.querySelector('#mmenu-bottom').content;
  const menu = new Menu(menuElement, {
    offCanvas: {
      position: 'top',
    },
    theme: 'dark',
    classNames: {
      nolistview: 'NoListview',
      nopanel: 'NoPanel',
    },
    navbar: {
      add: false,
    },
    navbars: [
      {
        position: 'top',
        content: [menuTopBlock],
      },
      {
        position: 'bottom',
        content: [menuBottomBlock],
      },
    ],
  });
  toggleMenu(menu);
}
