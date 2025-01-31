const menuItems = document.querySelectorAll('.js-elem-with-dropdown');

function showDropdown(event) {
  const element = event.target.closest('.js-elem-with-dropdown');
  const dropdown = element.querySelector('.js-dropdown');
  const dropdownHeight = dropdown.scrollHeight;
  dropdown.style.height = `${dropdownHeight}px`;
}

function hideDropdown(event) {
  const element = event.target.closest('.js-elem-with-dropdown');
  const dropdown = element.querySelector('.js-dropdown');
  dropdown.style.height = 0;
}

for (const element of menuItems) {
  element.addEventListener('mouseover', showDropdown);
  element.addEventListener('mouseout', hideDropdown);
}
