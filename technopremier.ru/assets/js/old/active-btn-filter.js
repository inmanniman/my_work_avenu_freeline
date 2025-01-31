const buttons = document.querySelectorAll('.rent-excavators__all-filter');
// Применяем стиль к нужной кнопке при загрузке страницы

// console.log(buttons);
if(buttons.length) {
  document.addEventListener('DOMContentLoaded', function () {
    const buttonToActivate = document.getElementById('tab-1');
    buttonToActivate.classList.add('active');
  });
// Добавляем слушатель события к каждой кнопке
  buttons.forEach(function (button) {
    button.addEventListener('click', function () {
      buttons.forEach(function (b) {
        b.classList.remove('active');
      });
      button.classList.add('active');
    });
  });
}
