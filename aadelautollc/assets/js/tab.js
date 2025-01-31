document.addEventListener('DOMContentLoaded', () => {
  // Получаем ссылки на элементы
  const applicationForm = document.getElementById('application-form');
  const numberForm = document.getElementById('number-form');
  const applicationContent = document.getElementById('content-application');
  const numberContent = document.getElementById('content-number');
  const tab = document.querySelector('.contact__tab');

  if (tab) {
    // Добавляем слушатель событий для переключения между формами
    applicationForm.addEventListener('change', () => {
      applicationContent.style.opacity = '1';
      numberContent.style.opacity = '0';
      setTimeout(() => {
        applicationContent.style.display = 'block';
        numberContent.style.display = 'none';
      }, 500); // Задержка равная времени анимации
    });

    numberForm.addEventListener('change', () => {
      applicationContent.style.opacity = '0';
      numberContent.style.opacity = '1';
      setTimeout(() => {
        applicationContent.style.display = 'none';
        numberContent.style.display = 'block';
      }, 500); // Задержка равная времени анимации
    });
  }
});
