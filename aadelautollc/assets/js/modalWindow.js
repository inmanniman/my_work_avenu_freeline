// Флаг для отслеживания состояния отправки формы
let isSubmitting = false;

// Функция для отправки данных формы без перезагрузки страницы
window.submitForm = (event) => {
  event.preventDefault(); // Предотвращаем стандартное поведение формы (перезагрузку страницы)

  if (isSubmitting) {
    return; // Если уже отправляем форму, прерываем выполнение функции
  }

  // Отмечаем, что начинаем отправку формы
  isSubmitting = true;

  const form = event.target; // Получаем форму
  const formData = new FormData(form); // Создаем объект FormData для сбора данных формы

  // Отправляем запрос AJAX
  const xhr = new XMLHttpRequest();
  xhr.open(form.method, form.action, true);
  xhr.onreadystatechange = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // Если запрос выполнен успешно, добавляем блок с сообщением
        const successBlock = document.createElement('div');
        successBlock.className = 'contact__successfully';
        successBlock.innerHTML =
          '<span class="contact__successfully-txt">Заявка отправлена</span>';
        form.parentNode.insertBefore(successBlock, form.nextSibling);

        // Скрываем блок с формой
        form.parentNode.removeChild(form);
      } else {
        // Если произошла ошибка, выводим сообщение об ошибке в консоль
        console.error('Ошибка отправки сообщения.');
      }

      // Включаем кнопку отправки формы обратно
      isSubmitting = false;
    }
  };
  xhr.send(formData); // Отправляем данные формы
};
