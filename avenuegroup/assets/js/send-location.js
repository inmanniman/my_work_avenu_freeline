document.addEventListener('DOMContentLoaded', function () {
  var form = document.querySelector('#locationForm');
  if (form) {
    form.addEventListener('submit', async (event) => {
      // ваш код обработки события submit
    });
  }
  var button = document.querySelector('.geo-tg__btn');
  if (button) {
    button.addEventListener('click', sendLocation);
  }
  function sendLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function (position) {
        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;

        // Добавьте код для отправки координат на сервер
        var formData = new FormData();
        formData.append('latitude', latitude);
        formData.append('longitude', longitude);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', window.location.href, true);
        xhr.onreadystatechange = function () {
          if (xhr.readyState == 4 && xhr.status == 200) {
            // Обновляем сообщение на странице с сервера
            document.querySelector('.geo-tg__error-done').innerText =
              xhr.responseText;
          }
        };
        xhr.send(formData);
      });
    } else {
      alert('Геолокация не поддерживается вашим браузером.');
    }
  }
});
