document.addEventListener('DOMContentLoaded', () => {
  const handleLinkClick = (e) => {
    e.preventDefault(); // Отменяем стандартное действие ссылки

    // Получаем значение атрибута href, чтобы определить id якоря
    const targetId = e.target.getAttribute('href').substring(1);

    // Находим элемент с соответствующим id
    const targetElement = document.getElementById(targetId);

    // Плавно перемещаемся к элементу
    targetElement.scrollIntoView({
      behavior: 'smooth',
    });
  };

  // Получаем все ссылки с классом "header__item-link" и "footer__item-link"
  const links = document.querySelectorAll(
    '.header__item-link, .footer__item-link'
  );

  // Обрабатываем каждую ссылку
  links.forEach((link) => {
    // Добавляем обработчик события при клике на ссылку
    link.addEventListener('click', handleLinkClick);
  });

  const menuBtn = document.getElementById('menu-btn');
  const menuItems = document.querySelectorAll('.header__item-link');

  if (menuItems) {
    menuItems.forEach((item) => {
      item.addEventListener('click', () => {
        menuBtn.checked = false;
      });
    });
  }
});
