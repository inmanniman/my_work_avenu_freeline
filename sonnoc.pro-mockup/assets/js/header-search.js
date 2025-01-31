const search = document.querySelector('.js-search');
const searchBtn = document.querySelector('.js-search-btn');

function enableSearch() {
  search.style.display = 'block';
  search.focus();
}

function disableSearch() {
  search.style.display = 'none';
}

function escPress(e) {
  if (e.key === 'Escape') {
    disableSearch();
  }
}

function addHeaderSearchListeners() {
  searchBtn.addEventListener('click', (e) => {
    e.preventDefault();
    enableSearch();
    document.addEventListener('keydown', escPress);
  });

  document.addEventListener('click', (e) => {
    if (!e.target.closest('.js-search-wrapper')) {
      disableSearch();
      document.removeEventListener('keydown', escPress);
    }
  });
}

if (search) {
  addHeaderSearchListeners();
}
