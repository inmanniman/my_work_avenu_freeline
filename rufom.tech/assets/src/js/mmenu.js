import Menu from 'mmenu-js';

const menuElement = document.querySelector('.js-mobile-menu');
const menuTriggerElement = document.querySelector(
  '.js-mobile-menu-trigger'
);
const socials = document.querySelector(
  '.js-mobile-menu-socials'
);
if (menuElement && menuTriggerElement) {
  const menu = new Menu(menuElement, {
    navbar: {
      title: 'Меню',
    },
    navbars: [
      {
        content: '<a href="/"></a><img src="/custom/upline/img/logo-tiger.png?v=3" width="260" height="72" alt="logo" title="logo" class="logo-img" loading="lazy"></a>',
        position: 'top',
      },
      {
        content: [socials.content.cloneNode(true)],
        position: 'bottom',
      },
    ],
  });
  menuTriggerElement.addEventListener('click', () => {
    menu.open();
  });
}
