$(document).ready(function () {
  $('#datePeriod').daterangepicker({
    singleDatePicker: true,
    minDate: moment().startOf('day'),
    opens: 'left',
    locale: {
      format: 'MM/DD/YYYY',
    },
  });

  // Устанавливаем начальное значение input и атрибута data-selected-date
  var initialDate = $('#datePeriod').val();
  $('#datePeriod').attr('data-selected-date', initialDate);

  // Вызываем событие apply.daterangepicker чтобы обновить атрибут data-selected-date
  $('#datePeriod').trigger('apply.daterangepicker');

  $('#datePeriod').on('apply.daterangepicker', function (ev, picker) {
    var selectedDate = picker.startDate.format('MM/DD/YYYY');
    $(this).val(selectedDate);
    $(this).attr('data-selected-date', selectedDate);
  });
});
