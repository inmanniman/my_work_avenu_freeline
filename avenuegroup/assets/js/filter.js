document.addEventListener('DOMContentLoaded', () => {
  // Получаем элементы DOM
  const filterBtn = document.querySelector('.filter__btn');
  const inRadio = document.getElementById('in');
  const outsideRadio = document.getElementById('outside');
  const nameInput = document.getElementById('name');
  const departmentInput = document.getElementById('departament');
  const dateInput = document.getElementById('datePeriod');
  const tenCheckbox = document.getElementById('ten');
  const tableRows = document.querySelectorAll('.tables tbody tr');

  // Назначаем обработчик события на кнопку фильтра
  filterBtn.addEventListener('click', () => {
    // Получаем значения из полей ввода
    const nameFilterValue = nameInput.value.toLowerCase();
    const departmentFilterValue = departmentInput.value.toLowerCase();
    const dateFilterValue = dateInput.value;

    // Проходим по каждой строке таблицы
    tableRows.forEach((row) => {
      const distance = row.dataset.distance;
      const timeString = row.children[2].textContent;
      const time = new Date(timeString);

      // Получаем значения из ячеек строки
      const fullName = row.children[0].textContent.toLowerCase();
      const department = row.children[1].textContent.toLowerCase();

      // Фильтрация по ФИО и Отделению
      const nameMatch = fullName.includes(nameFilterValue);
      const departmentMatch = department.includes(departmentFilterValue);

      // Сравнение дат с использованием объектов Date
      const dateMatch =
        dateFilterValue === '' || isDateInRange(time, dateFilterValue);

      // Фильтрация по радио-переключателю и времени
      const zoneMatch =
        (inRadio.checked && distance <= 60) ||
        (outsideRadio.checked && distance > 60) ||
        (!inRadio.checked && !outsideRadio.checked);

      // Фильтрация записей по времени
      const isBeforeTen = tenCheckbox.checked;
      const timeMatch = isBeforeTen ? time.getHours() >= 10 : true;

      // Применяем все фильтры и выводим данные в ячейке адреса
      if (nameMatch && departmentMatch && dateMatch && zoneMatch && timeMatch) {
        row.style.display = ''; // Показываем строку
      } else {
        row.style.display = 'none'; // Скрываем строку
      }
    });
  });

  // Инициализация Date Range Picker
  $('#datePeriod').daterangepicker({
    autoUpdateInput: false,
    locale: {
      cancelLabel: 'Очистить',
      applyLabel: 'Вставить',
    },
  });

  // Обновление поля ввода при выборе диапазона дат
  $('#datePeriod').on('apply.daterangepicker', (ev, picker) => {
    $(this).val(
      picker.startDate.format('YYYY-MM-DD') +
        ' - ' +
        picker.endDate.format('YYYY-MM-DD')
    );
  });

  // Очистка поля ввода при нажатии кнопки 'Очистить'
  $('#datePeriod').on('cancel.daterangepicker', function () {
    $(this).val('');
  });

  // Вспомогательная функция для проверки диапазона дат
  function isDateInRange(dateTime, dateFilter) {
    const dateFromPicker = moment(dateFilter.split(' - ')[0], 'YYYY-MM-DD');
    const dateEndPicker = moment(dateFilter.split(' - ')[1], 'YYYY-MM-DD');
    const dateToCheck = moment(dateTime);

    return (
      dateToCheck.isSameOrAfter(dateFromPicker) &&
      dateToCheck.isSameOrBefore(dateEndPicker.endOf('day'))
    );
  }

  const resetBtn = document.querySelector('.filter__btn-reset');
  resetBtn.addEventListener('click', () => {
    // Сбрасываем значения фильтров
    nameInput.value = '';
    departmentInput.value = '';
    dateInput.value = '';
    inRadio.checked = false;
    outsideRadio.checked = false;
    tenCheckbox.checked = false;

    // Переинициализируем Date Range Picker
    $('#datePeriod').data('daterangepicker').setStartDate(moment());
    $('#datePeriod').data('daterangepicker').setEndDate(moment());

    // Перебираем все строки таблицы и отображаем их
    tableRows.forEach(function (row) {
      row.style.display = '';
    });
  });
});

// фильтр для страницы редактора и добавления пользователей

document.addEventListener('DOMContentLoaded', () => {
  // Получаем элементы DOM
  const filterBtn = document.querySelector('.filter-add__btn');
  const telegramIdInput = document.getElementById('telegram-add');
  const nameInput = document.getElementById('name-add');
  const departmentInput = document.getElementById('departament-add');
  const parkInput = document.getElementById('park-add');
  const tableRows = document.querySelectorAll('.tables tbody tr');
  const noResultsMessage = document.getElementById('no-results-message');
  noResultsMessage.style.display = 'none';

  // Назначаем обработчик события на кнопку фильтра
  filterBtn.addEventListener('click', () => {
    // Получаем значения из инпутов
    const telegramIdFilterValue = telegramIdInput.value.toLowerCase();
    const nameFilterValue = nameInput.value.toLowerCase();
    const departmentFilterValue = departmentInput.value.toLowerCase();
    const parkFilterValue = parkInput.value.toLowerCase();

    // Переменная для отслеживания наличия результатов
    let hasResults = false;

    // Проходим по каждой строке таблицы
    tableRows.forEach((row) => {
      // Получаем значения из ячеек строки
      const telegramId = row.children[0].textContent.toLowerCase();
      const fullName = row.children[1].textContent.toLowerCase();
      const department = row.children[2].textContent.toLowerCase();
      const park = row.children[3].textContent.toLowerCase();

      // Фильтрация по значениям из инпутов
      const telegramIdMatch = telegramId.includes(telegramIdFilterValue);
      const nameMatch = fullName.includes(nameFilterValue);
      const departmentMatch = department.includes(departmentFilterValue);
      const parkMatch = park.includes(parkFilterValue);

      // Показываем или скрываем строку в зависимости от соответствия фильтрам
      if (telegramIdMatch && nameMatch && departmentMatch && parkMatch) {
        row.style.display = ''; // Показываем строку
        hasResults = true;
      } else {
        row.style.display = 'none'; // Скрываем строку
      }
    });

    // Показываем или скрываем сообщение о результате поиска
    if (hasResults) {
      noResultsMessage.style.display = 'none'; // Скрываем сообщение
    } else {
      noResultsMessage.style.display = 'block'; // Показываем сообщение
    }
  });
});
