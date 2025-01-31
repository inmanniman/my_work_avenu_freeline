const form = document.querySelector('.authorization__form');
const loadingOverlay = document.getElementById('loadingOverlay');

if (form) {
  form.addEventListener('submit', async (event) => {
    event.preventDefault();
    loadingOverlay.style.display = 'flex';

    await new Promise((resolve) => {
      setTimeout(() => {
        loadingOverlay.style.display = 'none';
        form.submit();
        resolve();
      }, 5000);
    });
  });
}
