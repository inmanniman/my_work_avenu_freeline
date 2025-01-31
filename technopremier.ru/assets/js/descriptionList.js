const accordions = document.querySelectorAll('.description');

const openAccordion = (accordion) => {
  const content = accordion.querySelector('.description__content');
  accordion.classList.add('description__active');
  content.style.maxHeight = content.scrollHeight + 'px';
};

const closeAccordion = (accordion) => {
  const content = accordion.querySelector('.description__content');
  accordion.classList.remove('description__active');
  content.style.maxHeight = null;
};

accordions.forEach((accordion) => {
  const intro = accordion.querySelector('.description__btn');
  const content = accordion.querySelector('.description__content');

  intro.onclick = () => {
    if (content.style.maxHeight) {
      closeAccordion(accordion);
    } else {
      accordions.forEach((accordion) => closeAccordion(accordion));
      openAccordion(accordion);
    }
  };
});
