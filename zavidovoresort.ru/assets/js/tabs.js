// Get references to tab buttons, content panels, and images
const tabButtons = document.querySelectorAll('.choice-of-services__btn-tabs');
const tabPanels = document.querySelectorAll('[role="tabpanel"]');
const images = document.querySelectorAll('.choice-of-services__back-img');

tabButtons.forEach((button, index) => {
  button.addEventListener('click', () => {
    // Hide all panels, deactivate all buttons, and hide all images
    tabPanels.forEach((panel) => {
      panel.setAttribute('hidden', 'true');
    });
    images.forEach((image) => {
      image.setAttribute('hidden', 'true');
    });
    tabButtons.forEach((tabButton) => {
      tabButton.setAttribute('aria-selected', 'false');
      tabButton.setAttribute('tabindex', '-1');
    });

    // Show the selected panel, activate the clicked button, and show the corresponding image
    tabPanels[index].removeAttribute('hidden');
    images[index].removeAttribute('hidden');
    button.setAttribute('aria-selected', 'true');
    button.setAttribute('tabindex', '0');
  });
});
