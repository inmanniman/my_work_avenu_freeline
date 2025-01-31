document.addEventListener('DOMContentLoaded', () => {
  const periodInput = document.getElementById('period');
  const dateBlock = document.querySelector('.date');
  const dateInput = document.getElementById('datePeriod');
  const dateClockTxtElements = document.querySelectorAll('.date__clock-txt');
  const dateBtn = document.getElementById('dateBtn');
  const errorSpan = document.querySelector('.date__error');

  periodInput.addEventListener('click', () => {
    dateBlock.style.display = 'flex';
  });

  dateClockTxtElements.forEach((element, index) => {
    element.addEventListener('click', () => {
      const time = element.textContent.trim();
      const currentDate = dateInput.value.split(' ')[0];
      dateInput.value = currentDate + ' ' + time;
    });
  });

  dateBtn.addEventListener('click', () => {
    const dateValue = dateInput.value.trim();
    const datePattern = /^\d{2}\/\d{2}\/\d{4} \d{2}:\d{2}(am|pm)$/; // Паттерн для проверки формата даты
    if (!datePattern.test(dateValue)) {
      errorSpan.textContent = 'Выберите время';
      return; // Прекратить выполнение функции, если формат неверный
    }
    errorSpan.textContent = ''; // Очистить сообщение об ошибке, если формат верный
    periodInput.value = dateValue;
    dateBlock.style.display = 'none'; // Скрыть блок .date
  });
});

document.addEventListener('DOMContentLoaded', () => {
  // Загружаем данные из файла date.json
  fetch('/custom/functions/date.json')
    .then((response) => response.json())
    .then((jsonData) => {
      const data = jsonData; // Сохраняем данные в переменной data

      // Функция для обновления временных слотов при изменении выбранной даты
      const updateSlots = (selectedDate) => {
        // Проверяем наличие данных для выбранной даты
        if (data[selectedDate] && data[selectedDate].times) {
          const unavailableTimes = data[selectedDate].times;
          // Получаем все элементы с классом "date__clock"
          const timeSlots = document.getElementsByClassName('date__clock');
          // Проходим по каждому временному слоту и обновляем их видимость
          for (let i = 0; i < timeSlots.length; i++) {
            const time = timeSlots[i].nextElementSibling.textContent.trim();
            if (!unavailableTimes.includes(time)) {
              timeSlots[i].removeAttribute('hidden');
              timeSlots[i].nextElementSibling.removeAttribute('hidden');
            } else {
              timeSlots[i].setAttribute('hidden', 'true');
              timeSlots[i].nextElementSibling.setAttribute('hidden', 'true');
            }
          }
        } else {
          // Если для выбранной даты нет данных, показываем все временные слоты
          const timeSlots = document.getElementsByClassName('date__clock');
          for (let i = 0; i < timeSlots.length; i++) {
            timeSlots[i].removeAttribute('hidden');
            timeSlots[i].nextElementSibling.removeAttribute('hidden');
          }
        }
      };

      // Получаем элемент с атрибутом data-selected-date
      const selectedDateElement = document.getElementById('datePeriod');

      // Создаем экземпляр MutationObserver для отслеживания изменений в атрибуте data-selected-date
      const observer = new MutationObserver((mutationsList) => {
        mutationsList.forEach((mutation) => {
          if (mutation.attributeName === 'data-selected-date') {
            const selectedDate =
              selectedDateElement.getAttribute('data-selected-date');
            updateSlots(selectedDate);
          }
        });
      });

      // Начинаем отслеживать изменения в атрибуте data-selected-date
      observer.observe(selectedDateElement, {
        attributes: true,
      });

      // Вызываем функцию updateSlots при загрузке страницы
      const initialSelectedDate =
        selectedDateElement.getAttribute('data-selected-date');
      updateSlots(initialSelectedDate);
    })
    .catch((error) => console.error('Ошибка загрузки данных:', error));
});
