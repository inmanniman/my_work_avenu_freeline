const accordions = document.querySelectorAll('.characteristic');

const openAccordion = (accordion) => {
  const content = accordion.querySelector('.characteristic__content');
  accordion.classList.add('characteristic__active');
  content.style.maxHeight = content.scrollHeight + 'px';
};

const closeAccordion = (accordion) => {
  const content = accordion.querySelector('.characteristic__content');
  accordion.classList.remove('characteristic__active');
  content.style.maxHeight = null;
};

accordions.forEach((accordion) => {
  const intro = accordion.querySelector('.characteristic__btn');
  const content = accordion.querySelector('.characteristic__content');

  intro.onclick = () => {
    if (content.style.maxHeight) {
      closeAccordion(accordion);
    } else {
      accordions.forEach((accordion) => closeAccordion(accordion));
      openAccordion(accordion);
    }
  };
});
