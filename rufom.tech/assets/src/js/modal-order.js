function showFileName(input) {
  if (input.files && input.files.length > 0) {
    const { files } = input;
    let filesList = '';
    const maxFileSize = 9 * 1024 * 1024; // 9 MB

    for (let i = 0; i < files.length; i++) {
      // Проверяем размер каждого файла
      if (files[i].size > maxFileSize) {
        const errorContainer = document.querySelector('.error-container');
        if (errorContainer) {
          errorContainer.textContent = 'Размер файла не должен превышать 9 МБ';
        }
        return;
      }

      // Сокращаем название файла
      let fileName = files[i].name;
      if (fileName.length > 20) {
        fileName = `${fileName.substring(0, 17)}...`;
      }

      filesList += `${fileName}<br>`;
    }

    const filesText = `Выбрано ${files.length} файла(ов):<br>${filesList}`;
    const attachFileText = document.querySelector(
      '.modal-order__attach-file-text'
    );
    if (attachFileText) {
      attachFileText.innerHTML = filesText;
    }

    // Очищаем контейнер с ошибкой
    const errorContainer = document.querySelector('.error-container');
    if (errorContainer) {
      errorContainer.textContent = '';
    }
  } else {
    const attachFileText = document.querySelector(
      '.modal-order__attach-file-text'
    );
    if (attachFileText) {
      attachFileText.textContent = 'До 10 файлов (общий размер — до 9 МБ).';
    }
  }
}

window.addEventListener('load', () => {
  const inputs = document.querySelectorAll('input[type="file"]');
  inputs.forEach((input) => {
    input.addEventListener('change', () => {
      showFileName(input);
    });
  });
});
