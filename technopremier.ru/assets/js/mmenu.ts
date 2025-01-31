import Menu from 'mmenu-js';
// import 'mmenu-js/dist/mmenu.css';

const menuElement = document.querySelector<HTMLElement>('.js-mobile-menu');
const menuTriggerElement = document.querySelector<HTMLElement>(
  '.js-mobile-menu-trigger'
);
if (menuElement && menuTriggerElement && window.innerWidth < 1025) {
  const tel = menuElement.dataset.tel;
  const mailto = menuElement.dataset.mailto;
  const tg = menuElement.dataset.tg;
  const wa = menuElement.dataset.wa;
  const menu = new Menu(menuElement, {
    navbar: {
      title: 'Меню',
    },
    scrollBugFix: {
      fix: true,
    },
    "offCanvas": {
      "position": "right"
    },
    "navbars": [
      {
        "position": "bottom",
        "content": [
          `<a class='mm-menu__soc-item' target="_blank" href='tel:${tel}'><svg class='mm-menu__soc-ph mm-menu__soc-svg'><use href='/assets/sprite.svg#phone-round'></use></svg></a>`,
          `<a class='mm-menu__soc-item' target="_blank" href='mailto:${mailto}'><svg class='mm-menu__soc-env mm-menu__soc-svg'><use href='/assets/sprite.svg#email'></use></svg></a>`,
          `<a class='mm-menu__soc-item' target="_blank" href='${tg}'><svg class='mm-menu__soc-tg mm-menu__soc-svg'><use href='/assets/sprite.svg#telegram'></use></svg></a>`,
          `<a class='mm-menu__soc-item' target="_blank" href='${wa}'><svg class='mm-menu__soc-wa mm-menu__soc-svg'><use href='/assets/sprite.svg#whatsapp'></use></svg></a>`
        ]
      },
      {
        "position": "top",
        "content": [
          `<a href="/"><img src="/custom/upline/images/logo.png" width="175" height="60" alt="" title=""></a>`
        ]
      },
      {
        "position": "top",
        "content": [
          `<a href="tel:${tel}" class="mm-menu__phone">${tel}</a>`
        ]
      }
    ]
  });
  menuTriggerElement.addEventListener('click', () => {
    menu.open();
  });
}
